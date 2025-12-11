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

        th, td {
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

        .badge-basic { background-color: #e3f2fd; color: #1976d2; }
        .badge-standard { background-color: #e8f5e8; color: #2e7d32; }
        .badge-premium { background-color: #fff3e0; color: #f57c00; }
        .badge-custom { background-color: #f3e5f5; color: #7b1fa2; }

        .price {
            font-weight: 600;
            color: var(--neutral-dark);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-edit, .btn-delete {
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
            
            th, td {
                padding: 0.5rem;
            }
        }
    </style>
    @endpush

    @section('content')
    <div class="table-container">
        <div class="table-header">
            <h5><i class="fas fa-shopping-cart"></i> Data Paket Laundry</h5>
            <a href="{{ route('paket-laundry.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Paket Laundry
            </a>
        </div>

        <div class="table-container">
            <div class="table-header">
                <div class="search-box">
                    <input type="text" class="search-input" placeholder="Cari paket...">
                    <button class="btn-primary">Cari</button>
                </div>
            </div>

            @if($paketLaundries->count() > 0)
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Jenis Paket</th>
                        <th>Harga</th>
                        <th>Satuan</th>
                        <th>Waktu Pengerjaan</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paketLaundries as $paket)
                    <tr>
                        <td>
                            <span class="badge badge-{{ strtolower($paket->jenis_paket ?? 'basic') }}">
                                {{ $paket->nama_paket }}
                            </span>
                        </td>
                        <td class="price">Rp {{ number_format($paket->harga, 0, ',', '.') }}</td>
                        <td>{{ $paket->satuan }}</td>
                        <td>{{ $paket->waktu_pengerjaan ?? '3 Hari' }}</td>
                        <td>{{ $paket->deskripsi ?? 'Tidak ada deskripsi' }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('paket-laundry.edit', $paket->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('paket-laundry.destroy', $paket->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus paket ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                <div class="pagination-info">
                    Menampilkan {{ $paketLaundries->count() }} paket
                </div>
            </div>
            @else
            <div style="text-align: center; padding: 2rem; color: var(--neutral-gray);">
                <i class="fas fa-box-open" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <p>Belum ada data paket laundry</p>
            </div>
            @endif
        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
        // Fungsi pencarian sederhana
        document.querySelector('.search-input').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Fungsi untuk tombol cari
        document.querySelector('.btn-primary').addEventListener('click', function() {
            const searchInput = document.querySelector('.search-input');
            searchInput.dispatchEvent(new Event('input'));
        });
    </script>
    @endpush