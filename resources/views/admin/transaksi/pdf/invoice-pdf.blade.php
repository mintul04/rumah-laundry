<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $transaksi->no_order }}</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
            background-color: #ffffff;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #1e40af;
            font-weight: bold;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #64748b;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .info-box {
            border: 1px solid #e2e8f0;
            padding: 10px;
            border-radius: 4px;
            background-color: #f8fafc;
            flex: 1;
            margin: 0 5px;
        }

        .info-label {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 12px;
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

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
            color: #6c757d;
        }

        .invoice-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #1e3a8a;
            margin-bottom: 5px;
        }

        .invoice-subtitle {
            text-align: center;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>RumahLaundry</h1>
        <p>Alamat: Jl. Mawar No. 123, Kota, Provinsi</p>
        <p>Telepon: (021) 12345678 | Email: info@rumahlaundry.com</p>
    </div>

    <div class="invoice-title">INVOICE</div>
    <div class="invoice-subtitle">No. Order: {{ $transaksi->no_order }}</div>

    <div class="info-section">
        <div class="info-box">
            <div class="info-label">Tanggal Terima</div>
            <div class="info-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_terima)->isoFormat('D MMMM Y') }}</div>
        </div>
        <div class="info-box">
            <div class="info-label">Tanggal Selesai</div>
            <div class="info-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_selesai)->isoFormat('D MMMM Y') }}</div>
        </div>
        <div class="info-box">
            <div class="info-label">Pelanggan</div>
            <div class="info-value">{{ $transaksi->nama_pelanggan }}</div>
        </div>
        <div class="info-box">
            <div class="info-label">Status Pembayaran</div>
            <div class="info-value">
                @if ($transaksi->pembayaran == 'lunas')
                    Lunas
                @elseif($transaksi->pembayaran == 'dp')
                    DP
                @else
                    Belum Lunas
                @endif
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Layanan</th>
                <th>Harga Satuan</th>
                <th>Berat</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi->details as $item)
                <tr>
                    <td>{{ $item->paket->nama_paket }}</td>
                    <td>Rp {{ number_format($item->paket->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->berat }} {{ $item->paket->satuan }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada layanan.</td>
                </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="2" class="text-end"><strong>Subtotal:</strong></td>
                <td></td>
                <td><strong>Rp {{ number_format($transaksi->details->sum('subtotal'), 0, ',', '.') }}</strong></td>
            </tr>
            <tr class="total-row">
                <td colspan="2" class="text-end"><strong>Diskon:</strong></td>
                <td></td>
                <td><strong>Rp 0</strong></td>
            </tr>
            <tr class="total-row">
                <td colspan="2" class="text-end"><strong>Pajak:</strong></td>
                <td></td>
                <td><strong>Rp 0</strong></td>
            </tr>
            <tr class="total-row">
                <td colspan="2" class="text-end"><strong>Total Akhir:</strong></td>
                <td></td>
                <td><strong>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Terima kasih atas kepercayaan Anda!<br>
        Dicetak pada: {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y HH:mm:ss') }}
    </div>
</body>

</html>
