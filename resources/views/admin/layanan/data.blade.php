@extends('layouts.main')

@section('title', 'Kelola Layanan - RumahLaundry')
@section('page-title', 'Kelola Layanan')

@push('styles')
    <style>
        .table-container {
            background: var(--neutral-white);
            border-radius: 0.75rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .table-header h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--neutral-dark);
            margin: 0;
        }

        .btn-add {
            background-color: var(--primary-blue);
            color: var(--neutral-white);
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-add:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background-color: var(--neutral-light);
        }

        .table th {
            font-weight: 600;
            color: var(--neutral-dark);
            border: none;
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 1rem 1.5rem;
            border: none;
            border-bottom: 1px solid var(--border-color);
            color: var(--neutral-dark);
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: var(--primary-light);
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .badge-tipe {
            display: inline-block;
            padding: 0.4rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-express {
            background-color: #e7f3ff;
            color: #0066cc;
        }

        .badge-regular {
            background-color: #f0f9ff;
            color: #0284c7;
        }

        .badge-economy {
            background-color: #f0f4e8;
            color: #65a30d;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            padding: 0.5rem 0.75rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .btn-edit {
            background-color: var(--accent-info);
            color: var(--neutral-white);
        }

        .btn-edit:hover {
            background-color: #138496;
        }

        .btn-delete {
            background-color: var(--accent-danger);
            color: var(--neutral-white);
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
            color: #999;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .modal-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-backdrop.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content-custom {
            background: var(--neutral-white);
            border-radius: 0.75rem;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            box-shadow: var(--shadow-md);
        }

        .modal-content-custom h5 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--neutral-dark);
            margin-bottom: 1.5rem;
        }

        .modal-content-custom p {
            color: #666;
            margin-bottom: 2rem;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn-cancel {
            background-color: var(--neutral-gray);
            color: var(--neutral-dark);
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            background-color: #dee2e6;
        }

        .btn-confirm {
            background-color: var(--accent-danger);
            color: var(--neutral-white);
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-confirm:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .table-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .table {
                font-size: 0.85rem;
            }

            .table th,
            .table td {
                padding: 0.75rem;
            }

            .action-buttons {
                flex-wrap: wrap;
            }

            .btn-action {
                padding: 0.4rem 0.6rem;
                font-size: 0.75rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="table-container">
        <div class="table-header">
            <h5><i class="fas fa-concierge-bell"></i> Data Layanan</h5>
            <a href="{{ route('layanan.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Layanan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Tipe</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($layanan ?? [] as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $item['nama_layanan'] }}</strong></td>
                            <td>
                                <span class="badge-tipe badge-{{ strtolower($item['tipe']) }}">
                                    {{ ucfirst($item['tipe']) }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                            <td>{{ substr($item['deskripsi'], 0, 40) }}...</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('layanan.edit', $item['id']) }}" class="btn-action btn-edit">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>
                                    <button class="btn-action btn-delete"
                                        onclick="openDeleteModal({{ $item['id'] }}, '{{ $item['nama_layanan'] }}')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada data layanan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal-backdrop" id="deleteModal">
        <div class="modal-content-custom">
            <h5><i class="fas fa-exclamation-triangle" style="color: var(--accent-danger);"></i> Konfirmasi Hapus</h5>
            <p id="deleteMessage">Apakah Anda yakin ingin menghapus layanan ini?</p>
            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeDeleteModal()">Batal</button>
                <button class="btn-confirm" onclick="confirmDelete()">Hapus</button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        let deleteId = null;

        function openDeleteModal(id, nama) {
            deleteId = id;
            document.getElementById('deleteMessage').textContent = `Apakah Anda yakin ingin menghapus layanan "${nama}"?`;
            document.getElementById('deleteModal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
            deleteId = null;
        }

        function confirmDelete() {
            if (deleteId) {
                // Redirect to delete route (dalam implementasi real, gunakan AJAX atau form submission)
                window.location.href = `/layanan/${deleteId}/delete`;
            }
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
@endpush
