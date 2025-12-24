@extends('layouts.main')

@section('page-title', 'Profil Saya')

@section('content')
    <div class="container-fluid px-4 py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card profile-card">
                    <div class="card-header border-0 pb-3 mb-3">
                        <h3 class="card-title mb-0 fw-bold text-dark">
                            <i class="fas fa-user-circle me-2 text-primary"></i>
                            Profil Saya
                        </h3>
                    </div>
                    <div class="card-body pt-0">
                        <!-- Update Profile Form -->
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                <!-- Avatar Section (Left) -->
                                <div class="col-lg-3">
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block">
                                            <div
                                                class="avatar-wrapper rounded-circle bg-gradient-primary d-flex align-items-center justify-content-center overflow-hidden shadow-lg">
                                                @if (auth()->user()->foto)
                                                    <img src="{{ Storage::url(auth()->user()->foto) }}"
                                                        alt="{{ auth()->user()->nama }}"
                                                        class="w-100 h-100 object-fit-cover">
                                                @else
                                                    <span class="text-white fw-bold fs-2">
                                                        {{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <label for="foto" class="form-label d-block fw-medium text-dark">Ganti Foto
                                                Profil</label>
                                            <input type="file" name="foto" id="foto"
                                                class="form-control form-control-sm" accept="image/*">
                                            <small class="text-muted d-block mt-1">Maks. 2MB (JPG, PNG, GIF)</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Form Fields (Right) -->
                                <div class="col-lg-9">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                                class="form-control form-control-lg @error('nama_lengkap') is-invalid @enderror"
                                                value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}" required>
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="nama" class="form-label">Username</label>
                                            <input type="text" name="nama" id="nama"
                                                class="form-control form-control-lg @error('nama') is-invalid @enderror"
                                                value="{{ old('nama', auth()->user()->nama) }}" required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" id="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                value="{{ old('email', auth()->user()->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg px-5 py-2">
                                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Divider -->
                        <hr class="my-5">

                        <!-- Change Password Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-4 fw-semibold text-dark">
                                    <i class="fas fa-key me-2 text-warning"></i> Ubah Password
                                </h5>
                                <form action="{{ route('profile.password') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Password Saat Ini</label>
                                        <input type="password" name="current_password" id="current_password"
                                            class="form-control form-control-lg @error('current_password') is-invalid @enderror"
                                            required>
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Password Baru</label>
                                        <input type="password" name="new_password" id="new_password"
                                            class="form-control form-control-lg @error('new_password') is-invalid @enderror"
                                            required>
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label">Konfirmasi Password
                                            Baru</label>
                                        <input type="password" name="new_password_confirmation"
                                            id="new_password_confirmation" class="form-control form-control-lg" required>
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-lg px-5 py-2 text-white">
                                        <i class="fas fa-sync-alt me-2"></i> Ubah Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style scoped>
        /* Modern, non-flat card design */
        .profile-card {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: none;
            background: #ffffff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            padding: 1.5rem 1.5rem 1rem;
        }

        .card-title {
            font-size: 1.75rem;
        }

        .card-body {
            padding: 0 1.5rem 1.5rem;
        }

        /* Avatar with depth */
        .avatar-wrapper {
            width: 120px;
            height: 120px;
            border: 3px solid #ffffff;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
            transition: transform 0.25s ease;
        }

        .avatar-wrapper:hover {
            transform: scale(1.03);
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
        }

        /* Form elements */
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .form-control.form-control-lg {
            padding: 0.875rem 1.25rem;
            font-size: 1.05rem;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .form-control.form-control-lg:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
        }

        .btn-lg {
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 0.85rem 1.75rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(13, 110, 253, 0.35);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107, #ffca2c);
            border: none;
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.25);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 193, 7, 0.35);
        }

        /* Divider */
        hr {
            opacity: 0.2;
            border-color: #dee2e6;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .profile-card {
                border-radius: 12px;
            }

            .avatar-wrapper {
                width: 100px;
                height: 100px;
            }

            .card-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .container-fluid {
                padding: 1rem;
            }

            .card-body {
                padding: 0 1rem 1rem;
            }

            .btn-lg {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection
