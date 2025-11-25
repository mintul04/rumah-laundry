@extends('layouts.main')

@section('title', 'Detail Transaksi - RumahLaundry')
@section('page-title', 'Detail Transaksi Laundry')

@push('styles')
    <style>
        .detail-container {
            background: var(--neutral-white);
            border-radius: 0.75rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }

        .back-button {
            background-color: var(--neutral-light);
            color: var(--neutral-dark);
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .back-button:hover {
            background-color: var(--border-color);
            transform: translateY(-1px);
        }

        .info-card {
            background: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-blue);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-label {
            font-size: 0.875rem;
            color: var(--neutral-gray);
            font-weight: 500;
        }

        .info-value {
            font-size: 1rem;
            color: var(--neutral-dark);
            font-weight: 600;
        }

        .badge {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-success {
            background-color: #e8f5e8;
            color: #2e7d32;
        }

        .badge-primary {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .badge-warning {
            background-color: #fff3e0;
            color: #f57c00;
        }

        .badge-danger {
            background-color: #ffebee;
            color: #d32f2f;
        }

        .table-container {
            background: white;
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .table-header {
            background: #f8f9fa;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .table-header h5 {
            margin: 0;
            color: var(--neutral-dark);
            font-size: 1.125rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem 1.5rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: var(--neutral-dark);
        }

        .total-section {
            display: flex;
            justify-content: flex-end;
            padding: 1.5rem;
            background: #f8f9fa;
            border-top: 1px solid var(--border-color);
        }

        .total-row {
            width: 300px;
        }

        .total-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            padding: 0.5rem 0;
        }

        .total-final {
            font-weight: 700;
            font-size: 1.125rem;
            color: var(--neutral-dark);
            border-top: 2px solid var(--border-color);
            padding-top: 1rem;
            margin-top: 0.5rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background-color: var(--primary-blue);
            color: white;
        }

        .btn-edit:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-print {
            background-color: #28a745;
            color: white;
        }

        .btn-print:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .total-row {
                width: 100%;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .header-section {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
        }
    </style>
@endpush

@section('content')
    <div class="detail-container">
        <div class="header-section">
            <div>
                <h2 class="mb-1">Detail Transaksi</h2>
                <p class="text-muted mb-0">No. Order: {{ $transaksi->no_order }}</p>
            </div>
            <a href="{{ route('transaksi.index') }}" class="back-button">
                ← Kembali ke Daftar
            </a>
        </div>

        <!-- Informasi Transaksi -->
        <div class="info-card">
            <h5 class="mb-3">Informasi Transaksi</h5>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">No. Order</span>
                    <span class="info-value">{{ $transaksi->no_order }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Pelanggan</span>
                    <span class="info-value">{{ $transaksi->nama_pelanggan }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal Transaksi</span>
                    <span class="info-value">{{ $transaksi->tanggal_transaksi }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Metode Pembayaran</span>
                    <span class="info-value">
                        @if($transaksi->pembayaran == 'lunas')
                            <span class="badge badge-success">LUNAS</span>
                        @elseif($transaksi->pembayaran == 'dp')
                            <span class="badge badge-warning">DP</span>
                        @else
                            <span class="badge badge-danger">BELUM LUNAS</span>
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status Order</span>
                    <span class="info-value">
                        @if($transaksi->status_order == 'baru')
                            <span class="badge badge-primary">BARU</span>
                        @elseif($transaksi->status_order == 'diproses')
                            <span class="badge badge-warning">DIPROSES</span>
                        @elseif($transaksi->status_order == 'selesai')
                            <span class="badge badge-success">SELESAI</span>
                        @else
                            <span class="badge badge-secondary">DIAMBIL</span>
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Total</span>
                    <span class="info-value">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Detail Produk/Layanan -->
        <div class="table-container">
            <div class="table-header">
                <h5>Detail Layanan</h5>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Layanan</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailProduk as $item)
                    <tr>
                        <td>{{ $item->nama_produk }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
                </tbody>
            </table>
            
            <div class="total-section">
                <div class="total-row">
                    <div class="total-item">
                        <span>Subtotal:</span>
                        <span>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="total-item">
                        <span>Diskon:</span>
                        <span>Rp 0</span>
                    </div>
                    <div class="total-item">
                        <span>Pajak:</span>
                        <span>Rp 0</span>
                    </div>
                    <div class="total-item total-final">
                        <span>Total:</span>
                        <span>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="action-buttons">
            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                    🗑️ Hapus Transaksi
                </button>
            </form>
            <button class="btn btn-print" onclick="window.print()">
                🖨️ Cetak Invoice
            </button>
            <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-edit">
                ✏️ Edit Transaksi
            </a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Tambahkan fungsi JavaScript jika diperlukan
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Detail transaksi loaded');
        });
    </script>
@endpush
