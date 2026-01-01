@extends('layouts.main')

@section('title', 'Paket Laundry - RumahLaundry')
@section('page-title', 'Daftar Paket Laundry')

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
            font-size: 0.9rem;
            transition: background-color 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
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

        /* Tambahkan style untuk kolom No */
        th:first-child, td:first-child {
            width: 60px;
            text-align: center;
            font-weight: 600;
        }

        tbody tr {
            transition: background-color 0.15s ease;
        }

        tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
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
            color: #e65100;
        }

        .badge-custom {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }

        .price {
            font-weight: 600;
            color: var(--neutral-dark);
            white-space: nowrap;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .btn-edit,
        .btn-delete {
            padding: 0.45rem 0.9rem;
            border: 1px solid;
            border-radius: 0.375rem;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-edit {
            background-color: #fff8e1;
            color: #ef6c00;
            border-color: #ffcc80;
        }

        .btn-edit:hover {
            background-color: #ff9800;
            color: white;
            border-color: #ff9800;
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

        .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--neutral-gray);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.7;
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
            font-size: 0.9rem;
            color: var(--neutral-gray);
        }


        @media (max-width: 768px) {
            .table-header {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                justify-content: flex-start;
            }

            .search-input {
                min-width: auto;
                flex: 1;
            }

            .action-buttons {
                flex-direction: row;
            }

            .price,
            th,
            td {
                font-size: 0.875rem;
                padding: 0.6rem 0.75rem;
            }

            th:first-child, td:first-child {
                width: 50px;
                padding: 0.6rem 0.5rem;
            }

            .badge {
                font-size: 0.8rem;
                padding: 0.2rem 0.6rem;
            }

            .btn-edit,
            .btn-delete {
                padding: 0.35rem 0.7rem;
                font-size: 0.8rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="table-container">
        <div class="table-header">
            <h5><i class="fas fa-list-check"></i> Paket Laundry</h5>
            <a href="{{ route('paket-laundry.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Paket Laundry
            </a>
        </div>

        <div class="table-header" style="margin-bottom: 1.5rem;">
            <div class="search-box">
                <input type="text" class="search-input" placeholder="Cari paket...">
                <button class="btn-primary">Cari</button>
            </div>
        </div>

        @if ($paketLaundries->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Paket</th>
                        <th>Harga</th>
                        <th>Satuan</th>
                        <th>Waktu Pengerjaan</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paketLaundries as $paket)
                        <tr>
                            <td>{{ ($paketLaundries->currentPage() - 1) * $paketLaundries->perPage() + $loop->iteration }}</td>
                            
                            <td>
                                <span class="badge badge-{{ strtolower($paket->jenis_paket ?? 'basic') }}">
                                    {{ $paket->nama_paket }}
                                </span>
                            </td>
                            <td class="price">Rp {{ number_format($paket->harga, 0, ',', '.') }}</td>
                            <td>{{ $paket->satuan }}</td>
                            <td>{{ $paket->waktu_pengerjaan ?? '3 Hari' }}</td>
                            <td style="max-width: 200px; word-wrap: break-word;">
                                {{ $paket->deskripsi ?? 'Tidak ada deskripsi' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('paket-laundry.edit', $paket->id) }}"
                                        class="btn-edit text-decoration-none"><i class="fa fa-pen"></i> Edit</a>
                                    <form action="{{ route('paket-laundry.destroy', $paket->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus paket ini?')"><i
                                                class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $paketLaundries->onEachSide(0)->links('pagination::simple-bootstrap-5') }}

        @else
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <p>Belum ada data paket laundry</p>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelector('.search-input').addEventListener('input', function() {
            const term = this.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
            });
        });

        document.querySelector('.btn-primary').addEventListener('click', function() {
            document.querySelector('.search-input').dispatchEvent(new Event('input'));
        });
    </script>
@endpush