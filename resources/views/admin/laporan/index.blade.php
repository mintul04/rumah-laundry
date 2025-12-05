@extends('layouts.main')

@section('title', 'Laporan - RumahLaundry')
@section('page-title', 'Laporan')

@push('styles')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #3b82f6, #6366f1);
            --secondary-gradient: linear-gradient(135deg, #8b5cf6, #ec4899);
            --success-gradient: linear-gradient(135deg, #10b981, #06b6d4);
            --warning-gradient: linear-gradient(135deg, #f59e0b, #f97316);
            --info-gradient: linear-gradient(135deg, #0ea5e9, #06b6d4);
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-light: #e2e8f0;
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.1);
        }

        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .container-xl {
            max-width: 1400px;
            padding: 2rem 1.5rem;
        }

        .page-header {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            padding: 1.75rem 2rem;
            margin-bottom: 2.5rem;
            border-left: 4px solid #3b82f6;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .stat-card.bg-primary::before {
            background: var(--primary-gradient);
        }

        .stat-card.bg-success::before {
            background: var(--success-gradient);
        }

        .stat-card.bg-info::before {
            background: var(--info-gradient);
        }

        .stat-card.bg-warning::before {
            background: var(--warning-gradient);
        }

        .stat-card .card-body {
            padding: 1.5rem;
        }

        .stat-card h5 {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        .stat-card h2 {
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0;
            color: var(--text-primary);
        }

        .analysis-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .analysis-card:hover {
            box-shadow: var(--shadow-lg);
        }

        .analysis-card .card-header {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 1.25rem 1.5rem;
            font-weight: 700;
        }

        .analysis-card .list-group-item {
            background: transparent;
            border: 1px solid var(--border-light);
            padding: 1rem 1.25rem;
            transition: all 0.2s ease;
        }

        .analysis-card .list-group-item:hover {
            background-color: #f1f5f9;
        }

        .detail-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .detail-card .card-header {
            background: linear-gradient(135deg, var(--text-primary), #334155);
            color: white;
            border: none;
            padding: 1.25rem 1.5rem;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .detail-card .card-body {
            padding: 1.5rem;
        }

        .table-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8fafc;
            color: var(--text-primary);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            border: none;
            padding: 1rem 1.25rem;
        }

        .table tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-top: 1px solid var(--border-light);
            color: var(--text-secondary);
        }

        .table tbody tr:hover {
            background-color: #f1f5f9;
        }

        .table .total-row {
            background-color: #f0f9ff !important;
            font-weight: 700;
            color: var(--text-primary);
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.5rem 0.75rem;
            font-weight: 600;
            border-radius: 8px;
        }

        .badge.bg-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge.bg-danger {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .badge.bg-warning {
            background-color: #fef3c7;
            color: #92400e;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
        }

        .export-buttons {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            padding: 1.25rem 1.5rem;
            margin-top: 2rem;
        }

        .export-btn {
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .btn-pdf {
            background-color: #ef4444;
            color: white;
        }

        .btn-pdf:hover {
            background-color: #dc2626;
        }

        .btn-excel {
            background-color: #22c55e;
            color: white;
        }

        .btn-excel:hover {
            background-color: #16a34a;
        }

        .btn-print {
            background-color: #3b82f6;
            color: white;
        }

        .btn-print:hover {
            background-color: #2563eb;
        }

        .btn i {
            font-size: 1.1rem;
        }

        .table-responsive {
            border-radius: 12px;
        }

        @media (max-width: 768px) {
            .container-xl {
                padding: 1rem;
            }

            .page-header {
                padding: 1.25rem 1.5rem;
            }

            .stat-card h2 {
                font-size: 1.5rem;
            }

            .analysis-card .card-header,
            .detail-card .card-header {
                font-size: 1rem;
            }

            .table th,
            .table td {
                padding: 0.75rem 1rem;
                font-size: 0.85rem;
            }

            .export-buttons {
                padding: 1rem;
            }

            .export-btn {
                padding: 0.65rem 1rem;
                font-size: 0.9rem;
                width: 100%;
                margin-bottom: 0.5rem;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-xl">
        <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div>
                <h1 class="h2 mb-1"><i class="fas fa-chart-line me-2 text-primary"></i>Laporan Transaksi Laundry</h1>
                <p class="text-muted mb-0">Ringkasan kinerja dan analisis data transaksi</p>
            </div>
            <div class="mt-2 mt-md-0">
                <small class="text-muted"><i class="far fa-calendar me-1"></i>Periode: {{ $periode }}</small>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="stat-card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="text-white"><i class="fas fa-exchange-alt me-1"></i>Total Transaksi</h5>
                                <h2 class="text-white">{{ number_format($totalTransactions, 0, ',', '.') }}</h2>
                            </div>
                            <div class="bg-opacity-20 p-3 rounded-circle">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="stat-card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="text-white"><i class="fas fa-money-bill-wave me-1"></i>Total Pendapatan</h5>
                                <h2 class="text-white">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                            </div>
                            <div class="bg-opacity-20 p-3 rounded-circle">
                                <i class="fas fa-coins fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="stat-card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="text-white"><i class="fas fa-calculator me-1"></i>Rata-rata/Transaksi</h5>
                                <h2 class="text-white">Rp {{ number_format($rataRata, 0, ',', '.') }}</h2>
                            </div>
                            <div class="bg-opacity-20 p-3 rounded-circle">
                                <i class="fas fa-percentage fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="stat-card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="text-white"><i class="fas fa-users me-1"></i>Pelanggan Aktif</h5>
                                <h2 class="text-white">{{ $topCustomers->count() }}</h2>
                            </div>
                            <div class="bg-opacity-20 p-3 rounded-circle">
                                <i class="fas fa-user-friends fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analisis Tambahan -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="analysis-card">
                    <div class="card-header">
                        <i class="fas fa-calendar-day me-2"></i>Transaksi per Tanggal
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @forelse ($transaksiPerTanggal as $tanggal => $data)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM YYYY') }}</span>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="fas fa-receipt me-1"></i>{{ $data['jumlah'] }} transaksi
                                        </span>
                                        <div class="small mt-1">Rp {{ number_format($data['total'], 0, ',', '.') }}</div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p class="mb-0">Tidak ada data transaksi</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="analysis-card">
                    <div class="card-header">
                        <i class="fas fa-credit-card me-2"></i>Status Pembayaran
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @forelse ($statusPembayaran as $status => $jumlah)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                                    </div>
                                    <span class="text-white badge {{ $status == 'lunas' ? 'bg-success' : ($status == 'belum_lunas' ? 'bg-danger' : 'bg-warning') }} rounded-pill">
                                        <i class="fas fa-{{ $status == 'lunas' ? 'check-circle' : ($status == 'belum_lunas' ? 'times-circle' : 'money-bill-wave') }} me-1"></i>{{ $jumlah }}
                                        transaksi
                                    </span>
                                </li>
                            @empty
                                <li class="list-group-item text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p class="mb-0">Tidak ada data status</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Detail Transaksi -->
        <div class="detail-card mb-4">
            <div class="card-header">
                <div>
                    <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Detail Transaksi</h5>
                    <small class="opacity-75">Daftar semua transaksi laundry</small>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    @if (count($transactions) > 0)
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
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
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $transaction->no_order }}</strong></td>
                                        <td>{{ $transaction->nama_pelanggan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->tanggal_terima)->isoFormat('D MMM YYYY') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->tanggal_selesai)->isoFormat('D MMM YYYY') }}</td>
                                        <td>
                                            <span class="text-white badge {{ $transaction->pembayaran == 'lunas' ? 'bg-success' : ($transaction->pembayaran == 'belum_lunas' ? 'bg-danger' : 'bg-warning') }}">
                                                <i
                                                    class="fas fa-{{ $transaction->pembayaran == 'lunas' ? 'check-circle' : ($transaction->pembayaran == 'belum_lunas' ? 'times-circle' : 'money-bill-wave') }} me-1"></i>{{ ucfirst(str_replace('_', ' ', $transaction->pembayaran)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $transaction->status_order)) }}</span>
                                        </td>
                                        <td><strong>Rp {{ number_format($transaction->total, 0, ',', '.') }}</strong></td>
                                    </tr>
                                @endforeach
                                <!-- Total Row -->
                                <tr class="total-row">
                                    <td colspan="6" class="text-end"><strong>TOTAL PENDAPATAN:</strong></td>
                                    <td colspan="2"><strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-light text-center mb-0" role="alert">
                            <i class="fas fa-info-circle fa-2x text-info mb-3"></i>
                            <h6 class="alert-heading">Tidak Ada Data</h6>
                            <p class="mb-0">Belum ada transaksi yang dicatat untuk periode ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tombol Export -->
        <div class="export-buttons text-center">
            <h6 class="mb-3 text-muted"><i class="fas fa-download me-2"></i>Ekspor Laporan</h6>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="{{ route('admin.laporan.export.pdf') }}" class="btn btn-pdf export-btn">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
                <a href="{{ route('admin.laporan.export.excel') }}" class="btn btn-excel export-btn">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
                <a href="javascript:window.print()" class="btn btn-print export-btn">
                    <i class="fas fa-print"></i> Cetak
                </a>
            </div>
        </div>

    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2500,
                    showConfirmButton: false
                });
            });
        </script>
    @endif
@endsection

@push('scripts')
    <script>
        // Efek halus saat card di-hover
        document.querySelectorAll('.stat-card, .analysis-card, .detail-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
            });
        });
    </script>
@endpush
