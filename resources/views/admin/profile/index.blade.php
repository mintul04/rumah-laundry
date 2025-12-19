@extends('layouts.main')

@section('page-title', 'Profil Saya')

@section('content')
    <div class="admin-content">
        <div class="card">
            <div class="card-header border-0 pb-3 mb-3">
                <h3 class="card-title mb-0">Profil Saya</h3>
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
                                    <div class="avatar-wrapper rounded-circle bg-primary d-flex align-items-center justify-content-center overflow-hidden shadow-sm" style="width: 120px; height: 120px;">
                                        @if (auth()->user()->foto)
                                            <img src="{{ Storage::url(auth()->user()->foto) }}" alt="{{ auth()->user()->nama }}" class="w-100 h-100 object-fit-cover">
                                        @else
                                            <span class="text-white fw-bold fs-2">
                                                {{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="foto" class="form-label d-block fw-medium">Ganti Foto Profil</label>
                                    <input type="file" name="foto" id="foto" class="form-control form-control-sm" accept="image/*">
                                    <small class="text-muted">Maks. 2MB (JPG, PNG, GIF)</small>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Form Fields (Right) -->
                        <div class="col-lg-9">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                        value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}" required>
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Username</label>
                                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', auth()->user()->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}"
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
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
                        <h5 class="mb-4 fw-semibold">Ubah Password</h5>
                        <form action="{{ route('profile.password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Password Saat Ini</label>
                                <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">Password Baru</label>
                                <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" required>
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-warning px-4 text-white">
                                <i class="fas fa-key me-1"></i> Ubah Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style scoped>
        .avatar-wrapper {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 2px solid #fff;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: none;
        }

        .card-header {
            padding-bottom: 1rem;
        }
    </style>
@endsection
