<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class LaporanTransaksiExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    protected $transaksis;

    public function __construct()
    {
        $this->transaksis = Transaksi::with('pelanggan')->orderBy('tanggal_terima', 'desc')
            ->orderBy('tanggal_selesai', 'desc')
            ->get();
    }

    public function collection()
    {
        return $this->transaksis;
    }

    public function headings(): array
    {
        return [
            'No',
            'No Order',
            'Nama Pelanggan',
            'Tanggal Terima',
            'Tanggal Selesai',
            'Pembayaran',
            'Status Order',
            'Total (Rp)'
        ];
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->id,
            $transaksi->no_order,
            $transaksi->pelanggan->nama ?? '-',
            $transaksi->tanggal_terima,
            $transaksi->tanggal_selesai ?? '-',
            ucfirst(str_replace('_', ' ', $transaksi->pembayaran)),
            ucfirst(str_replace('_', ' ', $transaksi->status_order)),
            $transaksi->total,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => '1e40af'],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'dbeafe'],
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Ambil worksheet
                $sheet = $event->sheet->getDelegate();

                // Tambahkan judul dan periode di atas tabel
                $sheet->setCellValue('A1', 'Laporan Transaksi Laundry');
                $sheet->mergeCells('A1:H1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $periode = \Carbon\Carbon::now()->locale('id')->isoFormat('MMMM YYYY');
                $sheet->setCellValue('A2', "Periode: {$periode}");
                $sheet->mergeCells('A2:H2');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'italic' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Set lebar kolom otomatis
                foreach (range('A', 'H') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Set format angka untuk kolom Total (mulai dari baris 3 karena baris 1 dan 2 adalah judul)
                $lastDataRow = $this->collection()->count() + 2; // +2 karena ada 2 baris judul di atas
                $sheet->getStyle('H3:H' . $lastDataRow)
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

                // Tambahkan baris total di akhir
                $totalRow = $lastDataRow + 1;
                $sheet->setCellValue('G' . $totalRow, 'TOTAL PENDAPATAN:');
                $sheet->setCellValue('H' . $totalRow, '=SUM(H3:H' . $lastDataRow . ')');

                // Format baris total
                $sheet->getStyle('G' . $totalRow . ':H' . $totalRow)->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'e0f2fe'],
                    ],
                ]);

                // Format angka total
                $sheet->getStyle('H' . $totalRow)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            },
        ];
    }
}
