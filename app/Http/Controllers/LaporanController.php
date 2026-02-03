<?php

namespace App\Http\Controllers;

use App\Exports\LaporanTransaksiExport;
use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Default values
        $filter = $request->filter ?? 'bulanan';
        $tahun = $request->tahun ?? now()->year;
        $bulan = $request->bulan ?? now()->month;

        // Set periode berdasarkan filter
        switch ($filter) {
            case 'tahunan':
                $start = Carbon::create($tahun)->startOfYear();
                $end = Carbon::create($tahun)->endOfYear();
                $periode = "Tahun " . $tahun;
                break;

            case 'mingguan':
                // Jika ada tanggal spesifik dari request, gunakan itu
                if ($request->has('tanggal_awal')) {
                    $start = Carbon::parse($request->tanggal_awal)->startOfWeek();
                    $end = Carbon::parse($request->tanggal_awal)->endOfWeek();
                } else {
                    $start = now()->startOfWeek();
                    $end = now()->endOfWeek();
                }
                $periode = "Minggu " . $start->translatedFormat('d M Y') . " - " . $end->translatedFormat('d M Y');
                break;

            case 'harian':
                // Jika ada tanggal spesifik dari request, gunakan itu
                if ($request->has('tanggal_awal')) {
                    $start = Carbon::parse($request->tanggal_awal)->startOfDay();
                    $end = Carbon::parse($request->tanggal_awal)->endOfDay();
                } else {
                    $start = now()->startOfDay();
                    $end = now()->endOfDay();
                }
                $periode = "Hari " . $start->translatedFormat('d F Y');
                break;

            default: // bulanan
                $start = Carbon::create($tahun, $bulan)->startOfMonth();
                $end = Carbon::create($tahun, $bulan)->endOfMonth();
                $periode = Carbon::createFromDate($tahun, $bulan, 1)
                    ->locale('id')
                    ->translatedFormat('F Y');
        }

        // Query transaksi
        $transaksis = Transaksi::with('pelanggan')
            ->whereBetween('tanggal_terima', [$start, $end])
            ->orderBy('tanggal_terima', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Hitung statistik
        $totalTransactions = Transaksi::whereBetween('tanggal_terima', [$start, $end])->count();

        $totalPendapatan = Transaksi::whereBetween('tanggal_terima', [$start, $end])
            ->where('pembayaran', 'lunas')
            ->sum('total');

        $rataRata = $totalTransactions > 0 ? $totalPendapatan / $totalTransactions : 0;

        $totalPendapatanHalaman = $transaksis
            ->getCollection()
            ->where('pembayaran', 'lunas')
            ->sum('total');

        // Pelanggan aktif
        $pelangganAktif = Pelanggan::whereHas('transaksi', function ($q) use ($start, $end) {
            $q->whereBetween('tanggal_terima', [$start, $end]);
        })
            ->withCount('transaksi')
            ->having('transaksi_count', '>=', 3)
            ->count();

        // Analisis per tanggal
        $transaksiPerTanggal = Transaksi::whereBetween('tanggal_terima', [$start, $end])
            ->get()
            ->groupBy(fn($t) => Carbon::parse($t->tanggal_terima)->format('Y-m-d'))
            ->map(fn($items) => [
                'jumlah' => $items->count(),
                'total' => $items->sum('total')
            ])
            ->sortByDesc('total');

        // Analisis status pembayaran
        $statusPembayaran = Transaksi::whereBetween('tanggal_terima', [$start, $end])
            ->get()
            ->groupBy('pembayaran')
            ->map->count();

        // Top customers
        $topCustomers = Pelanggan::withCount([
            'transaksi' => fn($q) =>
            $q->whereBetween('tanggal_terima', [$start, $end])
                ->where('pembayaran', 'lunas')
        ])
            ->withSum([
                'transaksi as transaksi_sum_total' => fn($q) =>
                $q->whereBetween('tanggal_terima', [$start, $end])
                    ->where('pembayaran', 'lunas')
            ], 'total')
            ->having('transaksi_count', '>', 0)
            ->orderByDesc('transaksi_count')
            ->take(7)
            ->get()
            ->map(function ($p) {
                return [
                    'nama' => $p->nama,
                    'jumlah' => $p->transaksi_count,
                    'total' => $p->transaksi_sum_total
                ];
            });

        return view('admin.laporan.index', [
            'transactions' => $transaksis,
            'totalTransactions' => $totalTransactions,
            'totalPendapatan' => $totalPendapatan,
            'totalPendapatanHalaman' => $totalPendapatanHalaman,
            'rataRata' => $rataRata,
            'pelangganAktif' => $pelangganAktif,
            'transaksiPerTanggal' => $transaksiPerTanggal,
            'statusPembayaran' => $statusPembayaran,
            'topCustomers' => $topCustomers,
            'tahun' => $tahun,
            'bulan' => $bulan,
            'periode' => $periode,
            'filter' => $filter,
            'startDate' => $start,
            'endDate' => $end,
        ]);
    }

    public function exportLaporanPdf(Request $request)
    {
        $transaksis = Transaksi::with('pelanggan')
            ->orderBy('tanggal_terima', 'desc')
            ->orderBy('tanggal_selesai', 'desc')
            ->get();

        $totalTransactions = $transaksis->count();
        $totalPendapatan = $transaksis->where('pembayaran', 'lunas')->sum('total');
        $rataRata = $totalTransactions > 0 ? $totalPendapatan / $totalTransactions : 0;

        $pelangganAktif = Pelanggan::whereHas('transaksi', function ($q) {
            $q->where('tanggal_terima', '>=', Carbon::now()->subDays(30));
        })
            ->withCount('transaksi')
            ->having('transaksi_count', '>', 2)
            ->count();

        $transaksiPerTanggal = $transaksis->groupBy('tanggal_terima')
            ->map(function ($items) {
                return [
                    'jumlah' => $items->count(),
                    'total' => $items->sum('total')
                ];
            })
            ->sortByDesc('total');

        $statusPembayaran = $transaksis->groupBy('pembayaran')
            ->map(function ($items) {
                return $items->count();
            });

        $topCustomers = Pelanggan::withCount([
            'transaksi' => function ($q) {
                $q->where('pembayaran', 'lunas');
            }
        ])
            ->withSum([
                'transaksi as transaksi_sum_total' => function ($q) {
                    $q->where('pembayaran', 'lunas');
                }
            ], 'total')
            ->having('transaksi_count', '>', 0)
            ->orderByDesc('transaksi_count')
            ->take(7)
            ->get()
            ->map(function ($pelanggan) {
                return [
                    'nama' => $pelanggan->nama,
                    'jumlah' => $pelanggan->transaksi_count,
                    'total' => $pelanggan->transaksi_sum_total
                ];
            });

        // Buat view PDF
        $pdf = Pdf::loadView('admin.laporan.pdf.laporan-pdf', [
            'transactions' => $transaksis,
            'totalTransactions' => $totalTransactions,
            'totalPendapatan' => $totalPendapatan,
            'rataRata' => $rataRata,
            'pelangganAktif' => $pelangganAktif,
            'transaksiPerTanggal' => $transaksiPerTanggal,
            'statusPembayaran' => $statusPembayaran,
            'topCustomers' => $topCustomers,
            'periode' => Carbon::now()->locale('id')->isoFormat('MMMM YYYY')
        ]);

        return $pdf->download('laporan_transaksi_laundry_' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    public function exportLaporanExcel(Request $request)
    {
        return Excel::download(new LaporanTransaksiExport, 'laporan_transaksi_laundry_' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }
}
