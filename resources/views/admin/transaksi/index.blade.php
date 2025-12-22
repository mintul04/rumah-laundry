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

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header h3 {
            font-size: 1.25rem;
            color: var(--neutral-dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
        }

        .btn-add {
            background-color: var(--primary-blue);
            color: var(--neutral-white);
            padding: 0.625rem 1.25rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }

        .btn-add:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
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
            min-width: 200px;
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

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        th,
        td {
            padding: 0.875rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: var(--neutral-dark);
            white-space: nowrap;
        }

        tbody tr {
            transition: background-color 0.15s ease;
        }

        tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        /* Custom badge system — consistent with paket laundry */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .badge-lunas {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .badge-belum-lunas {
            background-color: #ffebee;
            color: #c62828;
        }

        .badge-baru {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .badge-diproses {
            background-color: #e1f5fe;
            color: #0288d1;
        }

        .badge-selesai {
            background-color: #e8f5e8;
            color: #2e7d32;
        }

        .badge-diambil {
            background-color: #f5f5f5;
            color: #616161;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .btn-info,
        .btn-delete {
            padding: 0.45rem 0.9rem;
            border: 1px solid;
            border-radius: 0.375rem;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-info {
            background-color: #e3f2fd;
            color: #0288d1;
            border-color: #90caf9;
        }

        .btn-info:hover {
            background-color: #1976d2;
            color: white;
            border-color: #1976d2;
        }

        .btn-delete {
            background-color: #ffebee;
            color: #d32f2f;
            border-color: #ffcdd2;
        }

        .btn-delete:hover {
            background-color: #f44336;
            color: white;
            border-color: #f44336;
        }

        .empty-row td {
            text-align: center;
            color: var(--neutral-gray);
            font-style: italic;
            padding: 2rem 0;
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                justify-content: flex-start;
            }

            th,
            td {
                padding: 0.6rem 0.75rem;
                font-size: 0.875rem;
            }

            .badge {
                font-size: 0.8rem;
                padding: 0.2rem 0.6rem;
            }

            .btn-info,
            .btn-delete {
                padding: 0.35rem 0.7rem;
                font-size: 0.8rem;
            }

            .action-buttons {
                flex-wrap: wrap;
                gap: 0.25rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="table-container">
        <div class="page-header">
            <h3><i class="fas fa-shopping-cart"></i> Daftar Transaksi</h3>
            <a href="{{ route('transaksi.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Transaksi
            </a>
        </div>

        <div class="search-box">
            <input type="text" class="search-input" placeholder="Cari user...">
            <button class="btn-primary">Cari</button>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Terima</th>
                        <th>Pembayaran</th>
                        <th>Status Order</th>
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
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if ($item->pembayaran === 'dp')
                                        <span class="badge bg-primary">DP</span>
                                        <small class="text-muted">
                                            {{ number_format($item->jumlah_dp, 0, ',', '.') }}
                                        </small>
                                    @elseif ($item->pembayaran === 'lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-secondary">Belum Bayar</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if ($item->status_order == 'baru')
                                    <span class="badge badge-baru">Baru</span>
                                @elseif ($item->status_order == 'diproses')
                                    <span class="badge badge-diproses">Diproses</span>
                                @elseif ($item->status_order == 'selesai')
                                    <span class="badge badge-selesai">Selesai</span>
                                @else
                                    <span class="badge badge-diambil">Diambil</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('transaksi.show', $item->id) }}" class="btn-info"><i
                                            class="fa fa-eye"></i> Detail</a>
                                    <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus transaksi ini?')"><i
                                                class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="7">Belum ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Pencarian sederhana
        document.querySelector('.search-input').addEventListener('input', function() {
            const term = this.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(term) ? '' : 'none';
            });
        });

        document.querySelector('.btn-primary').addEventListener('click', function() {
            document.querySelector('.search-input').dispatchEvent(new Event('input'));
        });

        // <!-- Tidak ada script khusus selain confirm(), sudah inline -->
    </script>
@endpush
