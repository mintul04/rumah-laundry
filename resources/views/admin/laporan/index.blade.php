@extends('layouts.main')

@section('title', 'Laporan - RumahLaundry')
@section('page-title', 'Laporan')

@push('styles')
    <style>
         /* Complete redesign with premium modern styling and wider layout */
        
        /* Color Variables - Soft Blue Premium Theme */
        :root {
            --primary-blue: #3b82f6;
            --primary-dark: #1e40af;
            --primary-light: #eff6ff;
            --secondary-cyan: #06b6d4;
            --secondary-light: #ecfdf5;
            --accent-amber: #f59e0b;
            --accent-light: #fffbeb;
            --neutral-dark: #0f172a;
            --neutral-gray: #475569;
            --neutral-light: #f8fafc;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 25px rgba(59, 130, 246, 0.1);
            --shadow-xl: 0 20px 40px rgba(59, 130, 246, 0.12);
        }

        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #ffffff 100%);
            min-height: 100vh;
        }

        /* Container - Wider Layout */
        .container {
            max-width: 1400px !important;
            padding: 2.5rem 3rem !important;
        }

        /* Header Section */
        .container > .d-flex {
            margin-bottom: 3.5rem !important;
            padding: 0 0 2.5rem 0;
            border-bottom: 2px solid var(--border-color);
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        .container > .d-flex h1 {
            font-size: 2.25rem !important;
            font-weight: 800 !important;
            color: var(--neutral-dark) !important;
            margin: 0 !important;
            letter-spacing: -0.5px;
        }

        .container > .d-flex .text-end {
            color: var(--neutral-gray) !important;
            font-weight: 600;
            font-size: 1.05rem;
        }

        /* Stat Cards Container */
        .row.mb-4:first-of-type {
            gap: 1.5rem !important;
            margin-bottom: 3rem !important;
        }

        .row.mb-4:first-of-type .col-md-3 {
            display: flex;
        }

        /* Stat Cards */
        .row.mb-4:first-of-type .card {
            width: 100%;
            background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 16px !important;
            box-shadow: var(--shadow-md) !important;
            padding: 0 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            cursor: pointer;
            overflow: hidden;
            position: relative;
        }

        .row.mb-4:first-of-type .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue) 0%, var(--secondary-cyan) 100%);
        }

        .row.mb-4:first-of-type .card:hover {
            transform: translateY(-8px) !important;
            box-shadow: var(--shadow-xl) !important;
            border-color: var(--primary-blue) !important;
        }

        .row.mb-4:first-of-type .card.bg-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
            border: none !important;
            color: white !important;
        }

        .row.mb-4:first-of-type .card.bg-primary::before {
            display: none;
        }

        .row.mb-4:first-of-type .card.bg-success {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%) !important;
            border: none !important;
            color: white !important;
        }

        .row.mb-4:first-of-type .card.bg-success::before {
            display: none;
        }

        .row.mb-4:first-of-type .card.bg-info {
            background: linear-gradient(135deg, #1976d2 0%, #1d4ed8 100%) !important;
            border: none !important;
            color: white !important;
        }

        .row.mb-4:first-of-type .card.bg-info::before {
            display: none;
        }

        .row.mb-4:first-of-type .card.bg-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
            border: none !important;
            color: white !important;
        }

        .row.mb-4:first-of-type .card.bg-warning::before {
            display: none;
        }

        .row.mb-4:first-of-type .card-body {
            padding: 2rem !important;
        }

        .row.mb-4:first-of-type .card-body h5 {
            font-size: 0.95rem !important;
            font-weight: 700 !important;
            opacity: 0.95 !important;
            margin-bottom: 1rem !important;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .row.mb-4:first-of-type .card-body h2 {
            font-size: 2rem !important;
            font-weight: 800 !important;
            margin: 0 !important;
            letter-spacing: -0.5px;
        }

        /* Analysis Cards */
        .row.mb-4:last-of-type {
            gap: 1.5rem !important;
            margin-bottom: 3rem !important;
        }

        .row.mb-4:last-of-type .col-md-6 {
            display: flex;
        }

        .row.mb-4:last-of-type .card {
            width: 100%;
            background: linear-gradient(to bottom right, #ffffff, #f8fbff) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 16px !important;
            box-shadow: var(--shadow-md) !important;
            overflow: hidden;
            transition: all 0.3s ease !important;
        }

        .row.mb-4:last-of-type .card:hover {
            box-shadow: var(--shadow-lg) !important;
            border-color: var(--primary-blue) !important;
        }

        .row.mb-4:last-of-type .card-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%) !important;
            border: none !important;
            padding: 1.75rem 2rem !important;
            position: relative;
        }

        .row.mb-4:last-of-type .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        }

        .row.mb-4:last-of-type .card-header h5 {
            font-size: 1.1rem !important;
            font-weight: 800 !important;
            margin: 0 !important;
            letter-spacing: 0.3px;
        }

        .row.mb-4:last-of-type .card-body {
            padding: 1.75rem 2rem !important;
        }

        .row.mb-4:last-of-type .list-group-item {
            background: transparent !important;
            border: 1px solid var(--border-color) !important;
            padding: 1.25rem 1.5rem !important;
            border-radius: 10px !important;
            margin-bottom: 0.75rem !important;
            transition: all 0.2s ease !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        .row.mb-4:last-of-type .list-group-item:last-child {
            margin-bottom: 0 !important;
        }

        .row.mb-4:last-of-type .list-group-item:hover {
            background: var(--primary-light) !important;
            border-color: var(--primary-blue) !important;
            transform: translateX(4px);
        }

        .row.mb-4:last-of-type .list-group-item span:first-child {
            font-weight: 700;
            color: var(--neutral-dark);
            font-size: 1rem;
        }

        .row.mb-4:last-of-type .badge {
            font-size: 0.85rem !important;
            padding: 0.5rem 1rem !important;
            border-radius: 24px !important;
            font-weight: 700 !important;
            white-space: nowrap;
        }

        /* Detail Transaction Card */
        .card.mb-4 {
            background: linear-gradient(to bottom right, #ffffff, #f8fbff) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 16px !important;
            box-shadow: var(--shadow-md) !important;
            overflow: hidden;
            margin-bottom: 3rem !important;
        }

        .card.mb-4 > .card-header {
            background: linear-gradient(135deg, var(--neutral-dark) 0%, var(--primary-dark) 50%, var(--secondary-cyan) 100%) !important;
            border: none !important;
            padding: 2rem !important;
            position: relative;
        }

        .card.mb-4 > .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        }

        .card.mb-4 > .card-header h5 {
            font-size: 1.25rem !important;
            font-weight: 800 !important;
            margin: 0 !important;
            letter-spacing: 0.3px;
        }

        .card.mb-4 > .card-body {
            padding: 2rem !important;
        }

        /* Table Responsive */
        .table-responsive {
            border-radius: 10px !important;
            overflow: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--border-color) transparent;
        }

        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: transparent;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 3px;
        }

        .table {
            margin-bottom: 0 !important;
            border-collapse: collapse;
        }

        .table thead.table-dark th {
            background: #f1f5f9 !important;
            color: var(--neutral-dark) !important;
            font-weight: 800 !important;
            font-size: 0.9rem !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1.25rem 1.5rem !important;
            border: none !important;
            border-bottom: 2px solid var(--border-color) !important;
        }

        .table tbody td {
            padding: 1.25rem 1.5rem !important;
            color: var(--neutral-dark) !important;
            font-size: 0.98rem !important;
            border-bottom: 1px solid var(--border-color) !important;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: background-color 0.2s ease !important;
        }

        .table tbody tr:hover {
            background: var(--primary-light) !important;
        }

        .table tbody tr strong {
            color: var(--primary-blue);
            font-weight: 800;
        }

        /* Total Row */
        .table-success {
            background: linear-gradient(90deg, var(--primary-light), transparent) !important;
            border-top: 2px solid var(--primary-blue) !important;
            border-bottom: 2px solid var(--primary-blue) !important;
        }

        .table-success td {
            padding: 1.5rem 1.5rem !important;
            font-weight: 800 !important;
            color: var(--neutral-dark) !important;
            border: none !important;
            font-size: 1.05rem;
        }

        /* Badge Enhanced */
        .badge {
            font-size: 0.85rem !important;
            padding: 0.5rem 1rem !important;
            border-radius: 24px !important;
            font-weight: 800 !important;
            letter-spacing: 0.2px;
        }

        .badge.bg-success {
            background: #d1fae5 !important;
            color: #065f46 !important;
        }

        .badge.bg-danger {
            background: #fee2e2 !important;
            color: #991b1b !important;
        }

        .badge.bg-warning {
            background: #fef3c7 !important;
            color: #92400e !important;
        }

        /* Alert */
        .alert {
            border: none !important;
            border-radius: 12px !important;
            background: var(--accent-light) !important;
            color: #92400e !important;
            padding: 1.5rem 2rem !important;
            font-weight: 600;
            border-left: 4px solid var(--accent-amber);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .container {
                padding: 2rem 2.5rem !important;
            }

            .row.mb-4:first-of-type .col-md-3 {
                flex: 0 0 calc(50% - 0.75rem);
            }

            .row.mb-4:first-of-type {
                gap: 1.5rem !important;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1.5rem 1.25rem !important;
            }

            .container > .d-flex {
                flex-direction: column;
                gap: 1.5rem;
                margin-bottom: 2.5rem !important;
            }

            .container > .d-flex h1 {
                font-size: 1.75rem !important;
            }

            .row.mb-4:first-of-type,
            .row.mb-4:last-of-type {
                gap: 1rem !important;
            }

            .row.mb-4:first-of-type .col-md-3,
            .row.mb-4:last-of-type .col-md-6 {
                flex: 0 0 100% !important;
            }

            .row.mb-4:first-of-type .card-body,
            .row.mb-4:last-of-type .card-body {
                padding: 1.5rem !important;
            }

            .table thead.table-dark th,
            .table tbody td {
                padding: 0.9rem 0.75rem !important;
                font-size: 0.85rem !important;
            }

            .table-success td {
                font-size: 0.9rem !important;
            }

            .badge {
                font-size: 0.75rem !important;
                padding: 0.35rem 0.75rem !important;
            }
        }
    </style>
@endpush


@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>📊 Laporan Transaksi Laundry</h1>
            <div class="text-end">
                <small class="text-muted">Periode: {{ $periode }}</small>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5>Total Transaksi</h5>
                        <h2>{{ $totalTransactions }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5>Total Pendapatan</h5>
                        <h2>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5>Rata-rata/Transaksi</h5>
                        <h2>Rp {{ number_format($rataRata, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5>Pelanggan Aktif</h5>
                        <h2>{{ $topCustomers->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analisis Tambahan -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">📅 Transaksi per Tanggal</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($transaksiPerTanggal as $tanggal => $data)
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>{{ $tanggal }}</span>
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $data['jumlah'] }} transaksi (Rp
                                        {{ number_format($data['total'], 0, ',', '.') }})
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">💰 Status Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($statusPembayaran as $status => $jumlah)
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>{{ $status }}</span>

                                    <span class="badge {{ $status == 'Lunas' ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                        {{ $jumlah }} transaksi
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Detail Transaksi -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">📋 Detail Transaksi</h5>
            </div>
            <div class="card-body">
                @if (count($transactions) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
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
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $transaction->no_order }}</strong></td>
                                        <td>{{ $transaction->nama_pelanggan }}</td>
                                        <td>{{ $transaction->tanggal_terima }}</td>
                                        <td>{{ $transaction->tanggal_selesai }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $transaction->pembayaran == 'Lunas' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $transaction->pembayaran }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning">{{ $transaction->status_order }}</span>
                                        </td>
                                        <td><strong>Rp {{ number_format($transaction->total, 0, ',', '.') }}</strong></td>
                                    </tr>
                                @endforeach
                                <!-- Total Row -->
                                <tr class="table-success">
                                    <td colspan="6" class="text-end"><strong>TOTAL PENDAPATAN:</strong></td>
                                    <td><strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning">
                        Tidak ada data transaksi untuk ditampilkan.
                    </div>
                @endif
            </div>
        </div>

        {{-- <!-- Export Options -->
    <div class="text-end mb-4">
        <a href="{{ route('laporan.export.pdf') }}" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <a href="{{ route('laporan.export.excel') }}" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <a href="javascript:window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Print
        </a>
    </div> --}}
    </div>

    <!-- Tambahkan Font Awesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}'
            });
        </script>
    @endif
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth interactions and animations
        });
    </script>
@endpush
