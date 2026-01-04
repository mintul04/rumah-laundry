<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\PaketLaundry;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $transaksis = Transaksi::with('pelanggan')->latest()->get();
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
    public function store(Request $request)
    {
        // Validasi data input termasuk items
        $request->validate([
            'id_pelanggan' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'tanggal_selesai' => 'required|date',
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
            }, 'pelanggan'
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

    public function updateStatus(Request $request, $id)
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
        $transaksi = Transaksi::findOrFail($id);

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
                Rule::in(['belum_lunas', 'dp', 'lunas']),
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
            }
        ])->findOrFail($id);

        // Buat view PDF untuk invoice
        $pdf = Pdf::loadView('admin.transaksi.pdf.invoice-pdf', [
            'transaksi' => $transaksi,
        ]);

        // Download PDF
        return $pdf->download('invoice_' . $transaksi->no_order . '_' . \Carbon\Carbon::now()->format('Y-m-d') . '.pdf');
    }
}
