<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Laundry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #1e40af;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 12px;
            color: #64748b;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }

        .info-item {
            border: 1px solid #e2e8f0;
            padding: 8px;
            border-radius: 4px;
            background-color: #f8fafc;
        }

        .info-label {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 14px;
            font-weight: bold;
            color: #1e3a8a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 11px;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f1f5f9;
            font-weight: bold;
            color: #475569;
        }

        .total-row {
            background-color: #f0f9ff !important;
            font-weight: bold;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #1e40af;
            margin-top: 15px;
            margin-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 3px;
        }

        .list-group-item {
            border: 1px solid #e2e8f0;
            padding: 6px 8px;
            margin-bottom: 2px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Transaksi Laundry</h1>
        <p>Periode: {{ $periode }}</p>
    </div>

    <div class="info-grid">
        <div class="info-item">
            <span class="info-label">Total Transaksi</span>
            <span class="info-value">{{ $totalTransactions }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Total Pendapatan</span>
            <span class="info-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Rata-rata/Transaksi</span>
            <span class="info-value">Rp {{ number_format($rataRata, 0, ',', '.') }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Pelanggan Aktif</span>
            <span class="info-value">{{ $topCustomers->count() }}</span>
        </div>
    </div>

    <div class="section-title">Transaksi per Tanggal</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah Transaksi</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksiPerTanggal as $tanggal => $data)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($tanggal)->isoFormat('D MMM YYYY') }}</td>
                    <td>{{ $data['jumlah'] }}</td>
                    <td>Rp {{ number_format($data['total'], 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">Status Pembayaran</div>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Jumlah Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($statusPembayaran as $status => $jumlah)
                <tr>
                    <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                    <td>{{ $jumlah }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">Detail Transaksi</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Order</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Terima</th>
                <th>Tanggal Selesai</th>
                <th>Pembayaran</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->no_order }}</td>
                    <td>{{ $transaction->pelanggan->nama ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->tanggal_terima)->isoFormat('D MMM YYYY') }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->tanggal_selesai)->isoFormat('D MMM YYYY') }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $transaction->pembayaran)) }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $transaction->status_order)) }}</td>
                    <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada data transaksi</td>
                </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="6" class="text-end"><strong>TOTAL PENDAPATAN:</strong></td>
                <td colspan="2"><strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div style="position: fixed; bottom: 20px; width: 100%; text-align: center; font-size: 10px; color: #6c757d;">
        Halaman <span class="page"></span>
    </div>
</body>

</html>
