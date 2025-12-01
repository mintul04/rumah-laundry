@extends('layouts.main')

@section('title', 'Laporan - RumahLaundry')
@section('page-title', 'Laporan')

@push('styles')
    <style>
        .table-container {
            background: var(--neutral-white);
            border-radius: 0.75rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .table-header h5 {
            font-size: 1.25rem;
            color: var(--neutral-dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-add {
            background-color: var(--primary-blue);
            color: var(--neutral-white);
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .search-box {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .search-input {
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            font-size: 0.95rem;
        }

        .btn-primary {
            background-color: var(--primary-blue);
            color: var(--neutral-white);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: var(--neutral-dark);
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .badge-basic {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .badge-standard {
            background-color: #e8f5e8;
            color: #2e7d32;
        }

        .badge-premium {
            background-color: #fff3e0;
            color: #f57c00;
        }

        .badge-custom {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }

        .price {
            font-weight: 600;
            color: var(--neutral-dark);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-edit,
        .btn-delete {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background-color: #fff3e0;
            color: #f57c00;
            border: 1px solid #f57c00;
        }

        .btn-edit:hover {
            background-color: #f57c00;
            color: white;
        }

        .btn-delete {
            background-color: #ffebee;
            color: #d32f2f;
            border: 1px solid #d32f2f;
        }

        .btn-delete:hover {
            background-color: #d32f2f;
            color: white;
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .pagination-controls {
            display: flex;
            gap: 0.5rem;
        }

        .pagination-btn {
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--border-color);
            background: white;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pagination-btn.active {
            background-color: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
        }

        .pagination-btn:hover:not(.active) {
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .table-header {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                justify-content: space-between;
            }

            .action-buttons {
                flex-direction: column;
            }

            table {
                font-size: 0.875rem;
            }

            th,
            td {
                padding: 0.5rem;
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
                    <div class="card-header bg-secondary text-white">
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
                    <div class="card-header bg-secondary text-white">
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
