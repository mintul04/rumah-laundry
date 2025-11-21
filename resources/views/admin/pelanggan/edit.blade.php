@extends('layouts.main')

@section('title', 'Tambah Paket Laundry - RumahLaundry')
@section('page-title', 'Tambah Paket Laundry Baru')

@push('styles')
    <style>
        .form-container {
            background: var(--neutral-white);
            border-radius: 0.75rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--neutral-dark);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-label .required {
            color: var(--accent-danger);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            font-size: 0.95rem;
            transition: border-color 0.2s ease;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        select.form-control {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .btn-submit {
            background-color: var(--primary-blue);
            color: var(--neutral-white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-submit:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-cancel {
            background-color: var(--neutral-gray);
            color: var(--neutral-dark);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-cancel:hover {
            background-color: #dee2e6;
        }

        .price-input-group {
            position: relative;
        }

        .form-info {
            background-color: var(--primary-light);
            border-left: 4px solid var(--primary-blue);
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: #004ba3;
        }

        .form-info i {
            margin-right: 0.5rem;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 1.5rem;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <div class="form-container">
        <h2>Edit Data Pelanggan</h2>

        <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Pelanggan --}}
            <div class="form-group">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control"
                    value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                @error('nama_pelanggan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ old('email', $pelanggan->email) }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tanggal Lahir --}}
            <div class="form-group">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control"
                    value="{{ old('tanggal_lahir', $pelanggan->tanggal_lahir) }}" required>
                @error('tanggal_lahir')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Pekerjaan --}}
            <div class="form-group">
                <label class="form-label">Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control"
                    value="{{ old('pekerjaan', $pelanggan->pekerjaan) }}">
                @error('pekerjaan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Telepon --}}
            <div class="form-group">
                <label class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control"
                    value="{{ old('telepon', $pelanggan->telepon) }}" required>
                @error('telepon')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                @error('alamat')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div class="form-group">
                <label class="form-label">Jenis Kelamin</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="jenis_kelamin_L" name="jenis_kelamin" value="L"
                            {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'L' ? 'checked' : '' }} required>
                        <label for="jenis_kelamin_L">Laki-laki</label>
                    </div>

                    <div class="radio-option">
                        <input type="radio" id="jenis_kelamin_P" name="jenis_kelamin" value="P"
                            {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'P' ? 'checked' : '' }} required>
                        <label for="jenis_kelamin_P">Perempuan</label>
                    </div>
                </div>

                @error('jenis_kelamin')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('pelanggan.index') }}" class="btn-cancel">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Update Pelanggan
                </button>
            </div>

        </form>
    </div>
@endsection