@extends('layouts.main')

@section('title', 'Tambah Transaksi Laundry - RumahLaundry')
@section('page-title', 'Tambah Transaksi Laundry Baru')

@push('styles')
<style>
        /* CSS dari kode sebelumnya */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }
        
        h1 {
            color: #2c3e50;
            font-size: 24px;
        }
        
        .back-button {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        
        .back-button:hover {
            background-color: #5a6268;
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 20px;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .card-title {
            font-size: 18px;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .info-item {
            margin-bottom: 15px;
        }
        
        .info-label {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 5px;
        }
        
        .info-value {
            font-size: 16px;
            font-weight: 500;
        }
        
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        .product-table th {
            background-color: #f8f9fa;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 1px solid #dee2e6;
        }
        
        .product-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .total-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #dee2e6;
        }
        
        .total-row {
            width: 300px;
        }
        
        .total-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .total-final {
            font-weight: 700;
            font-size: 18px;
            color: #2c3e50;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
            margin-top: 10px;
        }
        
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-edit {
            background-color: #007bff;
            color: white;
        }
        
        .btn-edit:hover {
            background-color: #0069d9;
        }
        
        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Detail Transaksi</h1>
            <a href="{{ url('/transactions') }}" class="back-button">
                ← Kembali ke Daftar
            </a>
        </header>
        
        <div class="card">
            <div class="card-header">
                <div class="card-title">Informasi Transaksi</div>
                <div class="status-badge status-approved">{{ $transaction->status }}</div>
            </div>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Nomor Order</div>
                    <div class="info-value">{{ $transaction->order_number }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Pelanggan</div>
                    <div class="info-value">{{ $transaction->customer_name }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Tanggal</div>
                    <div class="info-value">{{ $transaction->transaction_date }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Metode Pembayaran</div>
                    <div class="info-value">{{ $transaction->payment_method }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Status Order</div>
                    <div class="info-value">{{ $transaction->status }}</div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <div class="card-title">Detail Produk</div>
            </div>
            
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Produk A</td>
                        <td>Rp 10.000</td>
                        <td>2</td>
                        <td>Rp 20.000</td>
                    </tr>
                    <!-- Data produk bisa dari database nanti -->
                </tbody>
            </table>
            
            <div class="total-section">
                <div class="total-row">
                    <div class="total-item">
                        <span>Subtotal:</span>
                        <span>Rp 20.000</span>
                    </div>
                    <div class="total-item">
                        <span>Pajak:</span>
                        <span>Rp 0</span>
                    </div>
                    <div class="total-item">
                        <span>Biaya Pengiriman:</span>
                        <span>Rp 0</span>
                    </div>
                    <div class="total-item total-final">
                        <span>Total:</span>
                        <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="{{ url('/transactions') }}" class="btn btn-cancel">Tutup</a>
            <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-edit">Edit Transaksi</a>
        </div>
    </div>
@endsection