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
    <h2>Tambah Paket Laundry Baru</h2>
    
    <form action="{{ route('paket-laundry.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Jenis Paket *</label>
            <select name="nama_paket" class="form-control" required>
                <option value="">Pilih Jenis Paket</option>
                <option value="Paket Basic" {{ old('nama_paket') == 'Paket Basic' ? 'selected' : '' }}>Paket Basic</option>
                <option value="Paket Standard" {{ old('nama_paket') == 'Paket Standard' ? 'selected' : '' }}>Paket Standard</option>
                <option value="Paket Premium" {{ old('nama_paket') == 'Paket Premium' ? 'selected' : '' }}>Paket Premium</option>
                <option value="Paket Express" {{ old('nama_paket') == 'Paket Express' ? 'selected' : '' }}>Paket Express</option>
                <option value="Paket Kilat" {{ old('nama_paket') == 'Paket Kilat' ? 'selected' : '' }}>Paket Kilat</option>
                <option value="Paket Hemat" {{ old('nama_paket') == 'Paket Hemat' ? 'selected' : '' }}>Paket Hemat</option>
            </select>
            @error('nama_paket')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Harga *</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" placeholder="Masukkan harga" required>
            @error('harga')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Waktu Pengerjaan *</label>
            <select name="waktu_pengerjaan" class="form-control" required>
                <option value="">Pilih Waktu Pengerjaan</option>
                <option value="3 Jam" {{ old('waktu_pengerjaan') == '3 Jam' ? 'selected' : '' }}>3 Jam (Express)</option>
                <option value="6 Jam" {{ old('waktu_pengerjaan') == '6 Jam' ? 'selected' : '' }}>6 Jam (Kilat)</option>
                <option value="1 Hari" {{ old('waktu_pengerjaan') == '1 Hari' ? 'selected' : '' }}>1 Hari</option>
                <option value="2 Hari" {{ old('waktu_pengerjaan') == '2 Hari' ? 'selected' : '' }}>2 Hari</option>
                <option value="3 Hari" {{ old('waktu_pengerjaan') == '3 Hari' ? 'selected' : '' }}>3 Hari (Standard)</option>
                <option value="5 Hari" {{ old('waktu_pengerjaan') == '5 Hari' ? 'selected' : '' }}>5 Hari</option>
                <option value="7 Hari" {{ old('waktu_pengerjaan') == '7 Hari' ? 'selected' : '' }}>7 Hari</option>
            </select>
            @error('waktu_pengerjaan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi Paket *</label>
            <textarea name="deskripsi" class="form-control" placeholder="Masukkan deskripsi paket laundry" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('paket-laundry.index') }}" class="btn-cancel">
                <i class="fas fa-arrow-left"></i> Batal
            </a>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Paket
            </button>
        </div>
    </form>
</div>
@endsection