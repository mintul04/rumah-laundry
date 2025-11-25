@extends('layouts.main')

@section('title', 'Detail Transaksi - RumahLaundry')
@section('page-title', 'Detail Transaksi Laundry')

@push('styles')
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --primary-dark: #3a56d4;
            --success: #4cc9f0;
            --success-bg: #e6f7ff;
            --warning: #f72585;
            --warning-bg: #fff0f6;
            --danger: #e63946;
            --light-bg: #fafbfd;
            --border: #e9ecef;
            --text: #212529;
            --text-muted: #6c757d;
            --white: #ffffff;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            --radius: 12px;
        }

        .transaction-detail-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            padding: 2rem;
            margin-bottom: 2rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .transaction-detail-card:hover {
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--border);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .back-link:hover {
            color: var(--primary);
            background: #f0f4ff;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
        }

        .info-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text);
        }

        /* Status badges with soft background & rounded */
        .status-badge {
            display: inline-block;
            padding: 0.375rem 0.875rem;
            border-radius: 50px;
            font-size: 0.8125rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-lunas {
            background: #e8f9f0;
            color: #0d8a4c;
        }

        .badge-dp {
            background: #fff8e6;
            color: #d48806;
        }

        .badge-belum-lunas {
            background: #fff0f0;
            color: #c53030;
        }

        .badge-baru {
            background: #e6f0ff;
            color: #1a56db;
        }

        .badge-diproses {
            background: #fff2e8;
            color: #d46b08;
        }

        .badge-selesai {
            background: #e8f9f0;
            color: #0d8a4c;
        }

        .badge-diambil {
            background: #f0f4ff;
            color: #4361ee;
        }

        /* Table styling */
        .table-container {
            background: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
        }

        .table-header {
            padding: 1.25rem 1.5rem;
            background: var(--light-bg);
            border-bottom: 1px solid var(--border);
        }

        .table-header h5 {
            margin: 0;
            font-weight: 600;
            color: var(--text);
        }

        .table th,
        .table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .table thead th {
            background: var(--light-bg);
            font-weight: 600;
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        /* Total section */
        .total-section {
            padding: 1.5rem;
            background: var(--light-bg);
            border-top: 1px solid var(--border);
        }

        .total-row {
            max-width: 320px;
            margin-left: auto;
        }

        .total-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            font-size: 0.9375rem;
        }

        .total-item.total-final {
            font-weight: 700;
            color: var(--text);
            border-top: 1px solid var(--border);
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            font-size: 1.125rem;
        }

        /* Action buttons */
        .action-buttons {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.9375rem;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: var(--primary);
            color: white;
        }

        .btn-edit:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-print {
            background: #0d9e6a;
            color: white;
        }

        .btn-print:hover {
            background: #0b7f56;
            transform: translateY(-1px);
        }

        .btn-delete {
            background: var(--danger);
            color: white;
        }

        .btn-delete:hover {
            background: #c53030;
            transform: translateY(-1px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .header-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }

            .total-row {
                max-width: 100%;
            }

            .transaction-detail-card {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .table thead {
                display: none;
            }

            .table,
            .table tbody,
            .table tr,
            .table td {
                display: block;
                width: 100%;
            }

            .table tr {
                margin-bottom: 1.25rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid var(--border);
            }

            .table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .table td::before {
                content: attr(data-label) ": ";
                position: absolute;
                left: 0;
                width: 45%;
                font-weight: 600;
                color: var(--text-muted);
                text-align: left;
            }
        }
    </style>
@endpush

@section('content')
    <div class="transaction-detail-card">
        <div class="header-section">
            <div>
                <h2 class="h4 mb-1">Detail Transaksi</h2>
                <p class="text-muted mb-0">No. Order: <strong>{{ $transaksi->no_order }}</strong></p>
            </div>
            <a href="{{ route('transaksi.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <!-- Informasi Transaksi -->
        <div class="mb-4 p-4 bg-light rounded-3">
            <h5 class="mb-3 fw-bold">Informasi Transaksi</h5>
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
                    <span class="info-label">Tanggal</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->locale('id')->isoFormat('D MMMM Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Pembayaran</span>
                    <span class="info-value">
                        @if ($transaksi->pembayaran == 'lunas')
                            <span class="status-badge badge-lunas">Lunas</span>
                        @elseif($transaksi->pembayaran == 'dp')
                            <span class="status-badge badge-dp">DP</span>
                        @else
                            <span class="status-badge badge-belum-lunas">Belum Lunas</span>
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status</span>
                    <span class="info-value">
                        @if ($transaksi->status_order == 'baru')
                            <span class="status-badge badge-baru">Baru</span>
                        @elseif($transaksi->status_order == 'diproses')
                            <span class="status-badge badge-diproses">Diproses</span>
                        @elseif($transaksi->status_order == 'selesai')
                            <span class="status-badge badge-selesai">Selesai</span>
                        @else
                            <span class="status-badge badge-diambil">Diambil</span>
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Total</span>
                    <span class="info-value">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Detail Layanan -->
        <div class="table-container">
            <div class="table-header">
                <h5 class="mb-0">Detail Layanan</h5>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailProduk as $item)
                            <tr>
                                <td data-label="Layanan">{{ $item->nama_produk }}</td>
                                <td data-label="Harga">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td data-label="Jumlah">{{ $item->jumlah }}</td>
                                <td data-label="Subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="total-section">
                <div class="total-row">
                    <div class="total-item">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="total-item">
                        <span>Diskon</span>
                        <span>Rp 0</span>
                    </div>
                    <div class="total-item">
                        <span>Pajak</span>
                        <span>Rp 0</span>
                    </div>
                    <div class="total-item total-final">
                        <span>Total Akhir</span>
                        <span>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <form action="{{ route('transaksi.update-status', $transaksi->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <select name="status_order" class="form-select d-inline-block w-auto" onchange="this.form.submit()">
                    <option value="baru" {{ $transaksi->status_order == 'baru' ? 'selected' : '' }}>Baru</option>
                    <option value="diproses" {{ $transaksi->status_order == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ $transaksi->status_order == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="diambil" {{ $transaksi->status_order == 'diambil' ? 'selected' : '' }}>Diambil</option>
                </select>
            </form>
            <button class="btn-action btn-print" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak Invoice
            </button>
            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Yakin ingin menghapus transaksi ini? Data tidak bisa dikembalikan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action btn-delete">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Opsional: tambahkan animasi ringan atau logika lain
        });
    </script>
@endpush
