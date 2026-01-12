<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\PaketLaundry;
use App\Models\Pelanggan;
use App\Services\FonnteService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $transaksis = Transaksi::with('pelanggan')->latest()->paginate(10);
        // dd($transaksis);

        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pakets = PaketLaundry::all();

        $lastOrderNumber = Transaksi::generateNoOrder();

        return view('admin.transaksi.create', compact('pakets', 'lastOrderNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FonnteService $fonnteService)
    {
        // Validasi data input termasuk items
        $request->validate([
            'id_pelanggan' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'tanggal_selesai' => 'nullable|date',
            'pembayaran' => 'required|in:lunas,dp',
            'status_order' => 'required|in:baru,diproses,selesai,diambil',
            'jumlah_dp' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.paket_id' => 'required|exists:paket_laundries,id',
            'items.*.berat' => 'required|numeric|min:0.1',
            'diskon' => 'nullable|numeric|min:0'
        ], [
            'id_pelanggan.required' => 'Nama pelanggan wajib dipilih.',
            'tanggal_terima.required' => 'Tanggal terima wajib diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
            'pembayaran.required' => 'Status pembayaran wajib dipilih.',
            'pembayaran.in' => 'Status pembayaran harus salah satu dari: lunas atau dp.',
            'status_order.required' => 'Status order wajib dipilih.',
            'status_order.in' => 'Status order harus salah satu dari: baru, diproses, selesai, diambil.',
            'jumlah_dp.numeric' => 'Jumlah DP harus berupa angka.',
            'jumlah_dp.min' => 'Jumlah DP tidak boleh kurang dari 0.',
            'total.required' => 'Total transaksi wajib diisi.',
            'total.numeric' => 'Total transaksi harus berupa angka.',
            'total.min' => 'Total transaksi tidak boleh kurang dari 0.',
            'items.required' => 'Detail item laundry wajib diisi minimal satu.',
            'items.array' => 'Detail item laundry harus berupa array.',
            'items.min' => 'Detail item laundry minimal harus ada satu item.',
            'items.*.paket_id.required' => 'Paket laundry wajib dipilih untuk setiap item.',
            'items.*.paket_id.exists' => 'Paket laundry yang dipilih tidak valid.',
            'items.*.berat.required' => 'Berat wajib diisi untuk setiap item.',
            'items.*.berat.numeric' => 'Berat harus berupa angka.',
            'items.*.berat.min' => 'Berat minimal harus 0.1 kg.',
            'diskon.numeric' => 'Diskon harus berupa angka.',
            'diskon.min' => 'Diskon tidak boleh kurang dari 0.',
        ]);

        // Validasi khusus untuk DP
        if ($request->pembayaran === 'dp') {
            // kirim pesan wa
            $pelanggan = Pelanggan::findOrFail($request->id_pelanggan);
            $namaPelanggan = $pelanggan->nama;
            $dp = $request->jumlah_dp;
            $total = $request->total;
            $sisa = $total - $dp;
            $noTelp = $pelanggan->no_telp;
            $diskon = $request->diskon ?? 0;
            $totalAwal = $total + $diskon;

            $daftarPesanan = '';
            foreach ($request->items as $item) {
                $paket = PaketLaundry::find($item['paket_id']);
                $daftarPesanan .= '• ' . $paket->nama_paket . ' (' . $item['berat'] . " kg)\n";
            }

            $diskonText = '';
            $totalAwalText = '';

            if ($diskon > 0) {
                $diskonText =
                    "🎁 *Diskon*\n" .
                    "Potongan harga: Rp " . number_format($diskon, 0, ',', '.') . "\n\n";
                $totalAwalText =
                    "Total sebelum diskon: Rp " .
                    number_format($totalAwal, 0, ',', '.') . "\n\n";
            }

            $message =
                "Halo *{$namaPelanggan}* 👋\n\n" .
                "Terima kasih telah melakukan transaksi di *RumahLaundry*.\n\n" .
                "🧺 *Detail Pesanan*\n" .
                $daftarPesanan . "\n" .
                "Total transaksi: Rp " . number_format($total, 0, ',', '.') . "\n\n" .
                $diskonText .
                $totalAwalText .
                "💰 *Pembayaran*\n" .
                "DP dibayarkan: Rp " . number_format($dp, 0, ',', '.') . "\n" .
                "Sisa pembayaran: Rp " . number_format($sisa, 0, ',', '.') . "\n\n" .
                "Pesanan Anda sedang kami proses. Kami akan menghubungi Anda kembali ketika laundry telah selesai.\n\n" .
                "Terima kasih 🙏\n" .
                "*RumahLaundry*";

            $response = $fonnteService->send($noTelp, $message);
            if (isset($response['error'])) {
                // Log error Fonnte
                Log::error('Fonnte API Error', [
                    'target' => $noTelp,
                    'message' => $message,
                    'error' => $response['error'],
                ]);
                return redirect()->back()->withErrors(['dp' => $response['error']]);
            }

            $request->validate([
                'jumlah_dp' => [
                    'required',
                    'numeric',
                    'min:1000', // Minimal DP 1000
                    'max:' . $request->total
                ],
            ], [
                'jumlah_dp.max' => 'Jumlah DP tidak boleh melebihi total transaksi',
                'jumlah_dp.min' => 'Jumlah DP minimal Rp 1.000',
            ]);
        }
        // Mulai transaksi database untuk memastikan konsistensi data
        DB::beginTransaction();

        try {
            // Simpan data ke tabel transaksis
            $transaksi = Transaksi::create([
                'no_order' => Transaksi::generateNoOrder(), // Pastikan fungsi ini ada di model
                'id_pelanggan' => $request->id_pelanggan,
                'tanggal_terima' => $request->tanggal_terima,
                'tanggal_selesai' => $request->tanggal_selesai,
                'pembayaran' => $request->pembayaran,
                'jumlah_dp' => $request->pembayaran === 'dp' ? $request->jumlah_dp : null,
                'status_order' => $request->status_order,
                'down_payment' => $request->down_payment,
                'total' => $request->total,
            ]);

            // Simpan detail transaksi ke tabel transaksi_details
            foreach ($request->items as $item) {
                // Ambil harga paket untuk validasi atau perhitungan ulang jika diperlukan
                $paket = PaketLaundry::findOrFail($item['paket_id']);
                $subtotal = $paket->harga * $item['berat'];

                $transaksi->details()->create([
                    'paket_id' => $item['paket_id'],
                    'berat' => $item['berat'],
                    'subtotal' => $subtotal,
                ]);
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan transaksi. Silakan coba lagi.'])->withInput();
        }
    }

    public function show($id)
    {
        $transaksi = Transaksi::with([
            'details' => function ($query) {
                $query->with('paket'); // Ambil data paket untuk setiap detail
            },
            'pelanggan'
        ])->findOrFail($id);

        return view('admin.transaksi.detail-transaksi', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data dari database
        Transaksi::findOrFail($id)->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }

    public function updateStatus(Request $request, $id, FonnteService $fonnteService)
    {
        // Validasi input
        $request->validate([
            'status_order' => [
                'required',
                'string',
                Rule::in(['diproses', 'selesai', 'diambil']), // 'baru' dihapus sesuai permintaan
            ],
        ]);

        // Temukan transaksi
        $transaksi = Transaksi::with('pelanggan', 'details')->findOrFail($id);

        // Default
        $namaPelanggan = $transaksi->pelanggan->nama;
        $noTelp = $transaksi->pelanggan->no_telp;
        $total = $transaksi->total;
        $diskon = $transaksi->diskon;
        $dp = $transaksi->jumlah_dp;
        $sisa = $total - $dp;
        $totalAwal = $total + $diskon;

        $diskonText = '';
        $totalAwalText = '';
        if ($diskon > 0) {
            $diskonText =
                "🎁 *Diskon*\n" .
                "Potongan harga: Rp " . number_format($diskon, 0, ',', '.') . "\n\n";
            $totalAwalText =
                "Total sebelum diskon: Rp " .
                number_format($totalAwal, 0, ',', '.') . "\n\n";
        }

        $dpText = '';
        $sisaText = '';
        if ($transaksi->pembayaran == 'dp') {
            $dpText =
                "Sisa pembayaran: Rp " . number_format($sisa, 0, ',', '.') . "\n\n";
            $sisaText =
                "Sisa pembayaran: Rp " . number_format($sisa, 0, ',', '.') . "\n\n";
        }

        $daftarPesanan = '';
        foreach ($transaksi->details as $item) {
            $paket = PaketLaundry::find($item['paket_id']);
            $daftarPesanan .= '• ' . $paket->nama_paket . ' (' . $item['berat'] . " kg)\n";
        }

        $messageProses =
            "Halo *{$namaPelanggan}* 👋\n\n" .
            "Pesanan laundry Anda di *RumahLaundry* telah kami proses.\n\n" .
            "🧺 *Detail Pesanan*\n" .
            $daftarPesanan . "\n" .
            "Total transaksi: Rp " . number_format($total, 0, ',', '.') . "\n\n" .
            $diskonText .
            $totalAwalText .
            $dpText .
            "Pesanan Anda sedang kami proses.\n" .
            "Terima kasih 🙏\n" .
            "*RumahLaundry*";
        $messageSelesai =
            "Halo *{$namaPelanggan}* 👋\n\n" .
            "Kabar baik 🎉\n" .
            "Pesanan laundry Anda di *RumahLaundry* telah *selesai*.\n\n" .
            "🧺 *Ringkasan Pesanan*\n" .
            $daftarPesanan . "\n" .
            $sisaText .
            "Silakan datang untuk pengambilan laundry.\n" .
            "Terima kasih 🙏\n" .
            "*RumahLaundry*";
        $messageDiambil =
            "Halo *{$namaPelanggan}* 👋\n\n" .
            "Terima kasih telah mengambil laundry Anda di *RumahLaundry*.\n\n" .
            "Kami harap hasil laundry kami memuaskan 😊\n" .
            "Jika berkenan, silakan gunakan layanan kami kembali.\n\n" .
            "Terima kasih 🙏\n" .
            "*RumahLaundry*";

        if ($request->status_order == 'diproses') {
            $response = $fonnteService->send($noTelp, $messageProses);
        } elseif ($request->status_order == 'selesai') {
            Transaksi::where('id', $id)->update([
                'tanggal_selesai' => now(),
            ]);
            $response = $fonnteService->send($noTelp, $messageSelesai);
        } elseif ($request->status_order == 'diambil') {
            Transaksi::where('id', $id)->update([
                'pembayaran' => 'lunas',
            ]);
            $response = $fonnteService->send($noTelp, $messageDiambil);
        }


        // Update status
        $transaksi->update([
            'status_order' => $request->status_order,
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }

    public function updatePembayaran(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'pembayaran' => [
                'required',
                'string',
                Rule::in(['dp', 'lunas']),
            ],
        ]);

        // Temukan transaksi
        $transaksi = Transaksi::findOrFail($id);

        // Update status
        $transaksi->update([
            'pembayaran' => $request->pembayaran,
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }

    public function exportInvoicePdf($id)
    {
        // Ambil data transaksi beserta details dan paketnya
        $transaksi = Transaksi::with([
            'details' => function ($query) {
                $query->with('paket');
            },
            'pelanggan'
        ])->findOrFail($id);

        // Buat view PDF untuk invoice
        $pdf = Pdf::loadView('admin.transaksi.pdf.invoice-pdf', [
            'transaksi' => $transaksi,
        ]);

        // Download PDF
        return $pdf->download('invoice_' . $transaksi->no_order . '_' . \Carbon\Carbon::now()->format('Y-m-d') . '.pdf');
    }

    public function previewInvoice($id)
    {
        // Ambil data transaksi beserta details dan paketnya
        $transaksi = Transaksi::with([
            'details' => function ($query) {
                $query->with('paket');
            },
            'pelanggan'
        ])->findOrFail($id);

        // Kembalikan view HTML untuk preview
        return view('admin.transaksi.pdf.invoice-pdf', [
            'transaksi' => $transaksi,
        ]);
    }
}
