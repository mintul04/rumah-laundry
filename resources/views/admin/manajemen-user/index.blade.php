@extends('layouts.main')

@section('title', 'Manajemen User - RumahLaundry')
@section('page-title', 'Daftar User')

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

        .badge-admin {
            background-color: #ffebee;
            color: #c62828;
        }

        .badge-karyawan {
            background-color: #e3f2fd;
            color: #1565c0;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid var(--border-color);
            vertical-align: middle;
            margin-right: 0.5rem;
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

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--neutral-gray);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.6;
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
                gap: 0.25rem;
            }

            table {
                font-size: 0.85rem;
            }

            th,
            td {
                padding: 0.5rem;
            }

            .user-avatar {
                width: 32px;
                height: 32px;
            }

            .btn-edit,
            .btn-delete {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="table-container">
        <div class="table-header">
            <h5><i class="fas fa-users"></i> Manajemen User</h5>
            <a href="{{ route('manajemen-user.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>

        <div class="search-box">
            <input type="text" class="search-input" placeholder="Cari user...">
            <button class="btn-primary">Cari</button>
        </div>

        @if ($user->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <td>
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="user-avatar">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=random" alt="Avatar" class="user-avatar">
                                @endif
                                <strong>{{ $item->nama }}</strong>
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email ?? '-' }}</td>
                            <td>
                                <span class="badge badge-{{ $item->role == 'admin' ? 'admin' : 'karyawan' }}">
                                    {{ ucfirst($item->role) }}
                                </span>
                            </td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>
                                <div class="action-buttons">
                                    @if ($item->role == 'admin')
                                        <a href="{{ route('manajemen-user.edit', $item->id) }}" class="btn-edit text-decoration-none"><i class="fa fa-pen"></i> Edit</a>
                                    @else
                                        <a href="{{ route('manajemen-user.edit', $item->id) }}" class="btn-edit text-decoration-none"><i class="fa fa-pen"></i> Edit</a>
                                        <button class="btn-delete" onclick="openDeleteModal({{ $item->id }}, '{{ addslashes($item->nama) }}')">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <i class="fas fa-user-group"></i>
                <p>Belum ada data user</p>
            </div>
        @endif
    </div>

    <div class="modal-backdrop" id="deleteModal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1050; justify-content: center; align-items: center;">
        <div class="modal-content-custom" style="background: var(--neutral-white); border-radius: 0.75rem; padding: 2rem; max-width: 500px; width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
            <h5 style="font-size: 1.25rem; font-weight: 700; color: var(--neutral-dark); margin-bottom: 1.5rem;">
                <i class="fas fa-exclamation-triangle" style="color: var(--accent-danger);"></i> Konfirmasi Hapus
            </h5>
            <p id="deleteMessage">Apakah Anda yakin ingin menghapus user ini?</p>
            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1.5rem;">
                <button style="background: #dee2e6; border: none; padding: 0.6rem 1.2rem; border-radius: 0.375rem; cursor: pointer;" onclick="closeDeleteModal()">Batal</button>
                <button style="background: var(--accent-danger); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 0.375rem; cursor: pointer;" onclick="confirmDelete()">Hapus</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let deleteId = null;

        function openDeleteModal(id, nama) {
            deleteId = id;
            document.getElementById('deleteMessage').textContent = `Apakah Anda yakin ingin menghapus user "${nama}"?`;
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
            deleteId = null;
        }

        function confirmDelete() {
            if (deleteId) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/manajemen-user/${deleteId}`;
                form.style.display = 'none';

                const csrf = document.createElement('input');
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                csrf.type = 'hidden';

                const method = document.createElement('input');
                method.name = '_method';
                method.value = 'DELETE';
                method.type = 'hidden';

                form.append(csrf, method);
                document.body.appendChild(form);
                form.submit();
            }
        }

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

        // Tutup modal saat klik luar
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });
    </script>
@endpush
