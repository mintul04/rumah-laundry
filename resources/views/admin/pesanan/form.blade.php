@extends('layouts.main')

@section('title', 'Tambah Pesanan - RumahLaundry')
@section('page-title', 'Tambah Pesanan Baru')

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
        <h5><i class="fas fa-concierge-bell"></i> Tambah Pesanan Baru</h5>
        <form action="{{ route('pesanan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="kode_pesanan">Kode Pesanan</label>
                <input type="text" class="form-control @error('kode_pesanan') is-invalid @enderror" id="kode_pesanan"
                    name="kode_pesanan" value="{{ old('kode_pesanan', 'PSN-' . date('YmdHis')) }}" required>
                @error('kode_pesanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama_layanan">Nama Layanan</label>
                <input type="text" class="form-control" placeholder="Pilih nama layanan">
            </div>
            
            <div class="form-group">
            <label for="nama_paket">Nama Paket</label>
            <select name="nama_layanan" id="nama_layanan" class="form-select" required>
                <option value="">-- Pilih Paket --</option>
                <?php
                if (isset($layanan) && !empty($layanan)) {
                    foreach ($layanan as $item) {
                        $selected = isset($_POST['nama_layanan']) && $_POST['nama_layanan'] == $item['id_layanan'] ? 'selected' : '';
                        echo "<option value='{$item['id_layanan']}' $selected>{$item['nama_layanan']}</option>";
                    }
                } else {
                    echo "<option value='' disabled>-- Data layanan tidak tersedia --</option>";
                }
                ?>
            </select>
            </div>

            <div class="form-group">
                <label for="total_harga">Harga</label>
                <input type="number" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga"
                    name="total_harga" value="{{ old('total_harga') }}" required>
                @error('total_harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('layanan.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Layanan
                </button>
            </div>
        @endsection
