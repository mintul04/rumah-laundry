@extends('layouts.main')

@section('title', 'Edit User - RumahLaundry')
@section('page-title', 'Edit User')

@push('styles')
    <style>
        :root {
            --primary-blue: #0d6efd;
            --primary-dark: #0a58ca;
            --primary-light: #e3f2fd;
            --neutral-white: #ffffff;
            --neutral-gray: #f8f9fa;
            --neutral-dark: #333333;
            --accent-danger: #dc3545;
            --border-color: #dee2e6;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            background: var(--neutral-white);
            border-radius: 0.75rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary-blue), #0a58ca);
            color: var(--neutral-white);
            padding: 1.5rem 2rem;
            border-radius: 0.75rem 0.75rem 0 0;
            margin-bottom: 2rem;
        }

        .form-header h2 {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .form-header h2 i {
            font-size: 1.5rem;
        }

        .form-content {
            padding: 0 2rem 2rem;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -1rem;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 1rem;
        }

        .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0 1rem;
        }

        .form-group {
            margin-bottom: 1.75rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--neutral-dark);
            margin-bottom: 0.75rem;
            font-size: 1rem;
            letter-spacing: 0.3px;
        }

        .form-label .required {
            color: var(--accent-danger);
            margin-left: 4px;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
            background-color: var(--neutral-white);
            color: var(--neutral-dark);
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
            background-color: var(--neutral-white);
        }

        .form-control:hover,
        .form-select:hover {
            border-color: #adb5bd;
        }

        .form-control::placeholder {
            color: #6c757d;
            opacity: 0.7;
        }

        select.form-select {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 1rem center;
            background-repeat: no-repeat;
            background-size: 1.25em 1.25em;
            padding-right: 3rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .current-photo {
            display: inline-block;
            margin-bottom: 0.75rem;
        }

        .current-photo img {
            border-radius: 50%;
            border: 3px solid var(--border-color);
            width: 80px;
            height: 80px;
            object-fit: cover;
            box-shadow: var(--shadow-sm);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid var(--border-color);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
            color: var(--neutral-white);
            border: none;
            padding: 0.875rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: var(--shadow-md);
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-blue));
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-cancel {
            background-color: var(--neutral-gray);
            color: var(--neutral-dark);
            border: 2px solid var(--border-color);
            padding: 0.875rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-cancel:hover {
            background-color: #e9ecef;
            border-color: #adb5bd;
            transform: translateY(-2px);
        }

        .text-danger {
            color: var(--accent-danger);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .text-danger::before {
            content: "⚠";
            font-size: 0.875rem;
        }

        .form-note {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        .form-info {
            background-color: var(--primary-light);
            border-left: 4px solid var(--primary-blue);
            padding: 1.25rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
            font-size: 0.95rem;
            color: #004085;
            line-height: 1.6;
        }

        .form-info i {
            margin-right: 0.75rem;
            color: var(--primary-blue);
            font-size: 1.1rem;
        }

        @media (max-width: 992px) {
            .form-content {
                padding: 0 1.5rem 1.5rem;
            }

            .form-header {
                padding: 1.25rem 1.5rem;
            }

            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .form-actions {
                flex-direction: column-reverse;
                gap: 0.75rem;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                justify-content: center;
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {
            .form-container {
                border-radius: 0.5rem;
            }

            .form-header h2 {
                font-size: 1.5rem;
            }

            .form-content {
                padding: 0 1rem 1rem;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-control,
            .form-select {
                padding: 0.75rem;
            }

            .current-photo img {
                width: 70px;
                height: 70px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="form-container">
                    <!-- Form Header -->
                    <div class="form-header">
                        <h2>
                            <i class="fas fa-user-edit"></i>
                            Edit User: {{ $user->nama }}
                        </h2>
                    </div>

                    <!-- Form Content -->
                    <div class="form-content">
                        <div class="form-info">
                            <i class="fas fa-info-circle"></i>
                            Perbarui data user. Biarkan password atau foto kosong jika tidak ingin diubah.
                        </div>

                        <form action="{{ route('manajemen-user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                                        <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                                        @error('nama_lengkap')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Username <span class="required">*</span></label>
                                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required>
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <small class="form-note">*Biarkan kosong jika tidak ingin mengubah password.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Role <span class="required">*</span></label>
                                        <select name="role" class="form-select" required>
                                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="karyawan" {{ old('role', $user->role) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                                        </select>
                                        @error('role')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Jenis Kelamin <span class="required">*</span></label>
                                        <select name="jenis_kelamin" class="form-select" required>
                                            <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Foto Profil</label>
                                @if ($user->foto)
                                    <div class="current-photo">
                                        <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto saat ini">
                                    </div>
                                @endif
                                <input type="file" name="foto" class="form-control" accept="image/*">
                                <small class="form-note">Biarkan kosong jika tidak ingin mengubah foto.</small>
                                @error('foto')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-actions">
                                <a href="{{ route('manajemen-user.index') }}" class="btn-cancel">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-save"></i> Update User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
