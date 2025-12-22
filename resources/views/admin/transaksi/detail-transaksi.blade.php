@extends('layouts.main')
@section('title', 'Detail Transaksi - RumahLaundry')
@section('page-title', 'Detail Transaksi Laundry')
@push('styles')
    <style>
        /* Base spacing improvements */
        .transaction-detail-card {
            background: linear-gradient(to bottom right, #ffffff, #f8faff);
            border: none !important;
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.10) !important;
            padding: 2.5rem !important;
            border-radius: 16px !important;
            margin-bottom: 2rem !important;
        }

        /* Header section dengan spacing lebih baik */
        .header-section {
            display: flex !important;
            justify-content: space-between !important;
            align-items: flex-start !important;
            margin-bottom: 3rem !important;
            padding-bottom: 1.5rem !important;
            border-bottom: 2px solid #e8eef9 !important;
        }

        .header-section h2 {
            font-weight: 700;
            color: #1e3a8a !important;
            font-size: 1.75rem !important;
            margin-bottom: 0.5rem !important;
        }

        .header-section p {
            color: #64748b !important;
            font-size: 0.95rem !important;
        }

        /* Info section dengan background soft blue */
        .bg-light {
            background: linear-gradient(135deg, #f0f4ff 0%, #f8faff 100%) !important;
            border-radius: 14px !important;
            padding: 2rem !important;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.08) !important;
            margin-bottom: 3rem !important;
            border: 1px solid #e0e7ff !important;
        }

        .bg-light h5 {
            color: #1e3a8a !important;
            font-weight: 700 !important;
            margin-bottom: 1.8rem !important;
            font-size: 1.1rem !important;
        }

        /* Grid untuk info items */
        .info-grid {
            display: grid !important;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
            gap: 2rem !important;
        }

        .info-item {
            display: flex !important;
            flex-direction: column !important;
            gap: 0.6rem !important;
            padding: 1.2rem !important;
            background: #ffffff !important;
            border-radius: 10px !important;
            border: 1px solid #e8eef9 !important;
            transition: all 0.3s ease !important;
        }

        .info-item:hover {
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.12) !important;
            border-color: #dbeafe !important;
        }

        /* Label dan Value */
        .info-label {
            color: #64748b !important;
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        .info-value {
            font-size: 1.1rem !important;
            font-weight: 700 !important;
            color: #1e3a8a !important;
        }

        /* Badge status dengan warna soft blue */
        .status-badge {
            display: inline-block !important;
            padding: 8px 16px !important;
            font-size: 0.75rem !important;
            border-radius: 30px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        .badge-lunas {
            background: #dbeafe !important;
            color: #0c4a6e !important;
            border: 1px solid #bfdbfe !important;
        }

        .badge-dp {
            background: #e0e7ff !important;
            color: #312e81 !important;
            border: 1px solid #c7d2fe !important;
        }

        .badge-belum-lunas {
            background: #fef3c7 !important;
            color: #78350f !important;
            border: 1px solid #fde68a !important;
        }

        .badge-baru {
            background: #dbeafe !important;
            color: #0c4a6e !important;
            border: 1px solid #bfdbfe !important;
        }

        .badge-diproses {
            background: #e0e7ff !important;
            color: #312e81 !important;
            border: 1px solid #c7d2fe !important;
        }

        .badge-selesai {
            background: #d1fae5 !important;
            color: #065f46 !important;
            border: 1px solid #a7f3d0 !important;
        }

        .badge-diambil {
            background: #f3e8ff !important;
            color: #6b21a8 !important;
            border: 1px solid #e9d5ff !important;
        }

        /* Table container dengan spacing lebih baik */
        .table-container {
            border-radius: 14px !important;
            overflow: hidden;
            border: 1px solid #e8eef9 !important;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.08) !important;
            margin-bottom: 2rem !important;
        }

        .table-header {
            background: linear-gradient(135deg, #f0f4ff 0%, #f8faff 100%) !important;
            padding: 1.8rem !important;
            border-bottom: 2px solid #e0e7ff !important;
        }

        .table-header h5 {
            color: #1e3a8a !important;
            font-weight: 700 !important;
            font-size: 1.1rem !important;
            margin: 0 !important;
        }

        .table th {
            background: #f8faff !important;
            color: #475569 !important;
            font-size: 0.8rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            padding: 1.2rem !important;
            border-bottom: 2px solid #e0e7ff !important;
        }

        .table td {
            font-size: 0.95rem !important;
            color: #334155 !important;
            padding: 1.2rem !important;
        }

        .table tbody tr {
            border-bottom: 1px solid #f0f4ff !important;
            transition: background-color 0.3s ease !important;
        }

        /* Hover effect baris */
        .table tbody tr:hover {
            background: linear-gradient(90deg, #f0f4ff 0%, #ffffff 100%) !important;
        }

        /* Total section dengan warna soft blue */
        .total-section {
            background: linear-gradient(135deg, #f8faff 0%, #f0f4ff 100%) !important;
            border-top: 2px solid #e0e7ff !important;
            padding: 2rem !important;
        }

        .total-row {
            display: flex !important;
            flex-direction: column !important;
            gap: 1rem !important;
        }

        .total-item {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            padding: 1rem 0 !important;
            color: #475569 !important;
            font-weight: 500 !important;
            font-size: 0.95rem !important;
            border-bottom: 1px solid #e8eef9 !important;
        }

        .total-item:last-child {
            border-bottom: none !important;
        }

        .total-item.total-final {
            font-size: 1.35rem !important;
            color: #1e3a8a !important;
            font-weight: 700 !important;
            padding: 1.5rem 0 !important;
            margin-top: 0.5rem !important;
            border-top: 2px solid #dbeafe !important;
            border-bottom: none !important;
        }

        /* Action buttons section */
        .action-buttons {
            display: flex !important;
            gap: 1.2rem !important;
            flex-wrap: wrap !important;
            margin-top: 2.5rem !important;
            padding-top: 2rem !important;
            border-top: 2px solid #e8eef9 !important;
        }

        /* Tombol dengan styling soft blue */
        .btn-action {
            font-weight: 600 !important;
            padding: 0.8rem 1.6rem !important;
            border-radius: 10px !important;
            border: none !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            font-size: 0.95rem !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.6rem !important;
        }

        .btn-action:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 6px 16px rgba(67, 97, 238, 0.2) !important;
        }

        .btn-print {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%) !important;
            color: #0c4a6e !important;
            border: 1px solid #7dd3fc !important;
        }

        .btn-print:hover {
            background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 100%) !important;
            color: #0a3a52 !important;
        }

        .btn-delete {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%) !important;
            color: #7f1d1d !important;
            border: 1px solid #fca5a5 !important;
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #fecaca 0%, #fda29b 100%) !important;
            color: #5a0f0f !important;
        }

        /* Dropdown status */
        select.form-select {
            border-radius: 10px !important;
            padding: 0.75rem 1.2rem !important;
            border: 1px solid #dbeafe !important;
            background: #ffffff !important;
            color: #1e3a8a !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 2px 4px rgba(67, 97, 238, 0.08) !important;
        }

        select.form-select:hover {
            border-color: #7dd3fc !important;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.12) !important;
        }

        select.form-select:focus {
            outline: none !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        }

        /* Link kembali */
        .back-link {
            font-weight: 600 !important;
            color: #64748b !important;
            text-decoration: none !important;
            padding: 0.6rem 1.2rem !important;
            border-radius: 8px !important;
            transition: all 0.3s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            font-size: 0.95rem !important;
        }

        .back-link:hover {
            color: #0c4a6e !important;
            background: #dbeafe !important;
            text-decoration: none !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .transaction-detail-card {
                padding: 1.5rem !important;
            }

            .header-section {
                flex-direction: column !important;
                gap: 1rem !important;
            }

            .info-grid {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }

            .action-buttons {
                flex-direction: column !important;
            }

            .btn-action,
            select.form-select {
                width: 100% !important;
            }

            .total-item {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 0.5rem !important;
            }
        }
    </style>
@endpush
@section('content')
    <div class="transaction-detail-card">
        <div class="header-section">
            <div>
                <h2 class="mb-1">Detail Transaksi</h2>
                <p class="mb-0">No. Order: <strong>{{ $transaksi->no_order }}</strong></p>
            </div>
            <a href="{{ route('transaksi.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <!-- Informasi Transaksi -->
        <div class="bg-light">
            <h5>Informasi Transaksi</h5>
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
                    <span class="info-label">Tanggal Terima</span>
                    <span
                        class="info-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_terima)->locale('id')->isoFormat('D MMMM Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal Selesai</span>
                    <span
                        class="info-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') }}</span>
                </div>
                <!-- Di bagian informasi transaksi -->
                <div class="info-item">
                    <span class="info-label">Pembayaran</span>
                    <span class="info-value">
                        @if ($transaksi->pembayaran == 'lunas')
                            <span class="status-badge badge-lunas">Lunas</span>
                        @elseif($transaksi->pembayaran == 'dp')
                            <span class="status-badge badge-dp">DP</span>
                        @else
                            <span class="status-badge badge-belum-lunas">Belum Bayar</span>
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

                @if ($transaksi->pembayaran == 'dp')
                    <div class="info-item">
                        <span class="info-label">Jumlah DP</span>
                        <span class="info-value">Rp {{ number_format($transaksi->jumlah_dp, 0, ',', '.') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Sisa</span>
                        <span class="info-value">Rp {{ number_format($transaksi->total - $transaksi->jumlah_dp, 0, ',', '.') }}</span>
                    </div>
                @endif

                <div class="info-item">
                    <span class="info-label">Total</span>
                    <span class="info-value">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Detail Layanan -->
        <div class="table-container">
            <div class="table-header">
                <h5>Detail Layanan</h5>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Harga Satuan</th>
                            <th>Berat</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi->details as $item)
                            <tr>
                                <td data-label="Layanan">{{ $item->paket->nama_paket }}</td>
                                <td data-label="Harga Satuan">Rp {{ number_format($item->paket->harga, 0, ',', '.') }}</td>
                                <td data-label="Jumlah">{{ $item->berat }} {{ $item->paket->satuan }}</td>
                                <td data-label="Subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada detail layanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="total-section">
                <div class="total-row">
                    <div class="total-item">
                        <span>Subtotal (Jumlah dari Detail)</span>
                        <span>Rp {{ number_format($transaksi->details->sum('subtotal'), 0, ',', '.') }}</span>
                    </div>
                    <div class="total-item">
                        <span>Diskon</span>
                        <span>Rp 0</span> <!-- Jika diskon disimpan di transaksi, gunakan $transaksi->diskon -->
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
                    <option value="diproses" {{ $transaksi->status_order == 'diproses' ? 'selected' : '' }}>Diproses
                    </option>
                    <option value="selesai" {{ $transaksi->status_order == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="diambil" {{ $transaksi->status_order == 'diambil' ? 'selected' : '' }}>Diambil</option>
                </select>
            </form>

            <form action="{{ route('transaksi.update-pembayaran', $transaksi->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <select name="pembayaran" class="form-select d-inline-block w-auto" onchange="this.form.submit()">
                    <option value="dp" {{ $transaksi->pembayaran == 'dp' ? 'selected' : '' }}>DP</option>
                    <option value="lunas" {{ $transaksi->pembayaran == 'lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
            </form>

            <a href="{{ route('export.invoice.pdf', $transaksi->id) }}" class="btn-action btn-print text-decoration-none">
                <i class="fas fa-print"></i> Cetak Invoice
            </a>
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
