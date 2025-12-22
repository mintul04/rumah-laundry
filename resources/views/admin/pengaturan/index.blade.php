@extends('layouts.main')

@section('title', 'Pengaturan Aplikasi')
@section('page-title', 'Pengaturan Aplikasi')

@push('styles')
    <style>
        .sidebar {
            background-color: #f8f9fa;
            min-height: calc(100vh - 56px);
            padding-top: 20px;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        .main-content {
            padding: 20px;
            background-color: #fff;
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .border-bottom {
            border-bottom: 2px solid #dee2e6 !important;
        }

        .form-control,
        .form-select {
            border-radius: 0.375rem;
            border: 1px solid #ced4da;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .btn {
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .alert {
            border-radius: 0.375rem;
            border: none;
        }

        .img-thumbnail {
            padding: 0.25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="fas fa-cog"></i> Pengaturan Aplikasi</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                      <form action="{{ route('pengaturan.update', $pengaturan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- 1. Logo Instansi -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">
                                    <i class="fas fa-image"></i> Logo Instansi
                                </h5>

                                <div class="row">
                                    <div class="col-md-4">
                                        @if ($pengaturan && $pengaturan->logo)
                                            <div class="mb-3">
                                                <p class="text-muted">Logo Saat Ini:</p>
                                                <img src="{{ asset('storage/' . $pengaturan->logo) }}" alt="Logo Laundry"
                                                    class="img-thumbnail" style="max-height: 150px;">
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label for="logo" class="form-label">Ubah Logo:</label>
                                            <input type="file" class="form-control" id="logo" name="logo"
                                                accept=".jpg,.jpeg,.png">
                                            <div class="form-text">
                                                Format: JPG, PNG. Maksimal 2MB.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Informasi Instansi -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">
                                    <i class="fas fa-store"></i> Informasi Instansi
                                </h5>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_laundry" class="form-label">Nama Laundry *</label>
                                        <input type="text" class="form-control" id="nama_laundry" name="nama_laundry"
                                            value="{{ old('nama_laundry', $pengaturan->nama_laundry ?? 'Arrabia Laundry') }}"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email_laundry" class="form-label">Email Laundry *</label>
                                        <input type="email" class="form-control" id="email_laundry" name="email_laundry"
                                            value="{{ old('email_laundry', $pengaturan->email_laundry ?? 'armalialaundry@gmail.com') }}"
                                            required>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="alamat_laundry" class="form-label">Alamat Laundry *</label>
                                        <textarea class="form-control" id="alamat_laundry" name="alamat_laundry" rows="3" required>{{ old('alamat_laundry', $pengaturan->alamat_laundry ?? "Kamisari's Polisi Bambang Suprapio No.24, Bodno, Koc Gondokusuman, Koto Yogakarta, L.") }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- 3. Informasi Pemilik -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">
                                    <i class="fas fa-user"></i> Informasi Pemilik
                                </h5>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_pemilik" class="form-label">Nama Pemilik *</label>
                                        <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik"
                                            value="{{ old('nama_pemilik', $pengaturan->nama_pemilik ?? 'Uchina Madara') }}"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- 4. Action Buttons -->
                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fas fa-redo"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
