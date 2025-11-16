@extends('layouts.main')

@section('title', 'Edit Layanan - RumahLaundry')
@section('page-title', 'Edit Layanan')

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

        .price-input-group::before {
            content: 'Rp';
            position: absolute;
            left: 0.75rem;
            top: 2.75rem;
            font-weight: 600;
            color: var(--neutral-dark);
            pointer-events: none;
        }

        .price-input-group .form-control {
            padding-left: 2rem;
        }

        .form-warning {
            background-color: #fff3cd;
            border-left: 4px solid var(--accent-warning);
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: #856404;
        }

        .form-warning i {
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
        <div class="form-warning">
            <i class="fas fa-pencil"></i>
            Perbarui informasi layanan sesuai kebutuhan
        </div>

        <form action="{{ route('layanan.update', $layanan['id'] ?? 1) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">
                    Nama Layanan <span class="required">*</span>
                </label>
                <input type="text" name="nama_layanan" class="form-control" placeholder="Contoh: Cuci Reguler"
                    value="{{ old('nama_layanan', $layanan['nama_layanan'] ?? '') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Tipe Layanan <span class="required">*</span>
                </label>
                <select name="tipe" class="form-control" required>
                    <option value="">-- Pilih Tipe --</option>
                    <option value="express" @if (old('tipe', $layanan['tipe'] ?? '') === 'express') selected @endif>Express (1 Hari)</option>
                    <option value="regular" @if (old('tipe', $layanan['tipe'] ?? '') === 'regular') selected @endif>Regular (3 Hari)</option>
                    <option value="economy" @if (old('tipe', $layanan['tipe'] ?? '') === 'economy') selected @endif>Economy (5 Hari)</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Harga (per kg) <span class="required">*</span>
                </label>
                <div class="price-input-group">
                    <input type="number" name="harga" class="form-control" placeholder="50000"
                        value="{{ old('harga', $layanan['harga'] ?? '') }}" min="0" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Deskripsi <span class="required">*</span>
                </label>
                <textarea name="deskripsi" class="form-control" placeholder="Jelaskan detail layanan ini..." required>{{ old('deskripsi', $layanan['deskripsi'] ?? '') }}</textarea>
            </div>

            <div class="form-actions">
                <a href="{{ route('layanan.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Perbarui Layanan
                </button>
            </div>
        </form>
    </div>
@endsection
