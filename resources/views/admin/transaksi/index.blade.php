@extends('layouts.main')

@section('title', 'Transaksi Laundry - RumahLaundry')
@section('page-title', 'Daftar Transaksi Laundry')

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

            .btn-info {
                background-color: #17a2b8;
                border-color: #17a2b8;
            }

            .btn-info:hover {
                background-color: #138496;
                border-color: #117a8b;
            }

            .action-buttons {
                display: flex;
                gap: 0.25rem;
                flex-wrap: wrap;
            }
        }
    </style>
@endpush

@section('content')
    <div class="table-container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Daftar Transaksi</h3>
            <a href="{{ route('transaksi.create') }}" class="btn-add">+ Tambah Transaksi</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>No Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Terima</th>
                        <th>Tanggal Selesai</th>
                        <th>Pembayaran</th>
                        <th>Status Order</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->no_order }}</td>
                            <td>{{ $item->nama_pelanggan }}</td>
                            <td>{{ $item->tanggal_terima }}</td>
                            <td>{{ $item->tanggal_selesai }}</td>

                            <td>
                                @if ($item->pembayaran == 'lunas')
                                    <span class="badge bg-success text-white">Lunas</span>
                                @elseif ($item->pembayaran == 'dp')
                                    <span class="badge bg-danger text-white">Belum Lunas</span>
                                    {{-- @else
                            <span class="badge-status bg-warning">DP</span> --}}
                                @endif
                            </td>

                            <td>
                                @if ($item->status_order == 'baru')
                                    <span class="badge bg-primary text-white">Baru</span>
                                @elseif ($item->status_order == 'diproses')
                                    <span class="badge bg-info text-dark">Diproses</span>
                                @elseif ($item->status_order == 'selesai')
                                    <span class="badge bg-success text-white">Selesai</span>
                                @else
                                    <span class="badge bg-secondary text-white">Diambil</span>
                                @endif
                            </td>

                            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>

                            <td>
                                <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-sm btn-info text-white">
                                    👁️ Detail
                                </a>

                                <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
