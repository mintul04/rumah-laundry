@extends('layouts.main')

@section('title', 'Pengaturan Aplikasi')
@section('page-title', 'Pengaturan Aplikasi')

@push('styles')
    <style>
        :root {
            --primary: #4361ee;
            --primary-hover: #3a56d4;
            --secondary: #6c757d;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --border: #e2e8f0;
            --text: #1e293b;
            --text-muted: #64748b;
            --radius: 0.75rem;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 6px 16px rgba(0, 0, 0, 0.08);
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: var(--text);
        }

        .settings-container {
            width: 100%;
            padding: 0 1rem;
        }

        .card {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            background: var(--card-bg);
            overflow: hidden;
            transition: all 0.25s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-hover);
        }

        .card-header {
            background: transparent;
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid var(--border);
        }

        .card-header h1 {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-section {
            margin-bottom: 1.75rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text);
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text);
        }

        .form-control,
        .form-select {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 0.625rem 0.875rem;
            font-size: 1rem;
            transition: all 0.2s ease;
            background-color: #fff;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.12);
            outline: none;
        }

        .img-thumbnail {
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
            max-height: 140px;
            width: auto;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .logo-placeholder {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f1f5f9;
            border-radius: var(--radius);
            border: 1px dashed #cbd5e1;
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        .form-text {
            font-size: 0.8125rem;
            color: var(--text-muted);
        }

        .btn {
            border-radius: var(--radius);
            padding: 0.625rem 1.25rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        }

        .btn-secondary {
            background-color: #e2e8f0;
            color: var(--text);
            border: none;
        }

        .btn-secondary:hover {
            background-color: #cbd5e1;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
        }

        @media (max-width: 576px) {
            .settings-container {
                margin: 1.5rem auto;
            }

            .card-body {
                padding: 1.25rem;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .d-flex.justify-content-end>.btn {
                width: auto;
            }
        }
    </style>
@endpush

@section('content')
    <div class="settings-container">
        <div class="card">
            <div class="card-header">
                <h1><i class="fas fa-cog"></i> Pengaturan Aplikasi</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('pengaturan.update', $pengaturan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- 1. Logo Instansi -->
                    <div class="form-section">
                        <h2 class="section-title"><i class="fas fa-image"></i> Logo Instansi</h2>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                @if ($pengaturan?->logo)
                                    <div class="mb-3 text-center">
                                        <p class="text-muted small mb-2">Logo Saat Ini:</p>
                                        <img src="{{ Storage::url($pengaturan->logo) }}" alt="Logo Instansi" class="img-thumbnail">
                                    </div>
                                @else
                                    <div class="mb-3 text-center">
                                        <p class="text-muted small mb-2">Logo Saat Ini:</p>
                                        <div class="logo-placeholder">
                                            <i class="fas fa-image me-2"></i> Belum ada logo
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Upload Logo Baru</label>
                                    <input type="file" class="form-control" id="logo" name="logo" accept=".jpg,.jpeg,.png">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Informasi Instansi -->
                    <div class="form-section">
                        <h2 class="section-title"><i class="fas fa-store"></i> Informasi Instansi</h2>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nama_laundry" class="form-label">Nama Laundry</label>
                                <input type="text" class="form-control" id="nama_laundry" name="nama_laundry" value="{{ old('nama_laundry', $pengaturan?->nama_laundry ?? 'Arrabia Laundry') }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="telepon_laundry" class="form-label">Telepon Laundry</label>
                                <input type="text" class="form-control" id="telepon_laundry" name="telepon_laundry" value="{{ old('telepon_laundry', $pengaturan?->telepon_laundry ?? '6281234567890') }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="email_laundry" class="form-label">Email Laundry</label>
                                <input type="email" class="form-control" id="email_laundry" name="email_laundry" value="{{ old('email_laundry', $pengaturan?->email_laundry ?? 'arrablialaundry@gmail.com') }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="alamat_laundry" class="form-label">Alamat Laundry</label>
                                <textarea class="form-control" id="alamat_laundry" name="alamat_laundry" rows="2" required>{{ old('alamat_laundry', $pengaturan?->alamat_laundry ?? "Kamisari's Polisi Bambang Suprapio No.24, Bodno, Koc Gondokusuman, Koto Yogakarta, L.") }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Informasi Pemilik -->
                    <div class="form-section">
                        <h2 class="section-title"><i class="fas fa-user"></i> Informasi Pemilik</h2>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                                <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" value="{{ old('nama_pemilik', $pengaturan?->nama_pemilik ?? 'Uchiha Madara') }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Action Buttons -->
                    <div class="d-flex justify-content-end gap-3 mt-3 pt-2">
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-redo me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection