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
        <h5><i class="fas fa-concierge-bell"></i> Edit Pesanan</h5>
        <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kode_pesanan">Kode Pesanan</label>
                <input type="text" class="form-control @error('kode_pesanan') is-invalid @enderror" id="kode_pesanan"
                    name="kode_pesanan" value="{{ old('kode_pesanan', $pesanan->kode_pesanan) }}" required readonly>
                @error('kode_pesanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_layanan">Layanan</label>
                <select class="form-control @error('id_layanan') is-invalid @enderror" id="id_layanan" name="id_layanan"
                    required>
                    <option value="">Pilih Layanan</option>
                    @foreach ($layananList as $layanan)
                        <option value="{{ $layanan->id }}"
                            {{ old('id_layanan', $pesanan->id_layanan) == $layanan->id ? 'selected' : '' }}>
                            {{ $layanan->nama_layanan }} - Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('id_layanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_pelanggan">Pelanggan</label>
                <select class="form-control @error('id_pelanggan') is-invalid @enderror" id="id_pelanggan"
                    name="id_pelanggan" required>
                    <option value="">Pilih Pelanggan</option>
                    @foreach ($pelangganList as $pelanggan)
                        <option value="{{ $pelanggan->id }}"
                            {{ old('id_pelanggan', $pesanan->id_pelanggan) == $pelanggan->id ? 'selected' : '' }}>
                            {{ $pelanggan->nama }} - {{ $pelanggan->telepon }}
                        </option>
                    @endforeach
                </select>
                @error('id_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipe">Tipe Layanan</label>
                <select class="form-control @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required>
                    <option value="express" {{ old('tipe', $pesanan->tipe) == 'express' ? 'selected' : '' }}>Express
                    </option>
                    <option value="regular" {{ old('tipe', $pesanan->tipe) == 'regular' ? 'selected' : '' }}>Regular
                    </option>
                    <option value="kilat" {{ old('tipe', $pesanan->tipe) == 'kilat' ? 'selected' : '' }}>Kilat</option>
                </select>
                @error('tipe')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="berat">Berat (kg)</label>
                <input type="number" step="0.1" class="form-control @error('berat') is-invalid @enderror"
                    id="berat" name="berat" value="{{ old('berat', $pesanan->berat) }}" required>
                @error('berat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                    name="jumlah" value="{{ old('jumlah', $pesanan->jumlah) }}" required>
                @error('jumlah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="total_harga">Total Harga</label>
                <input type="number" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga"
                    name="total_harga" value="{{ old('total_harga', $pesanan->total_harga) }}" required>
                @error('total_harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="dipending" {{ old('status', $pesanan->status) == 'dipending' ? 'selected' : '' }}>
                        Dipending</option>
                    <option value="dijemput" {{ old('status', $pesanan->status) == 'dijemput' ? 'selected' : '' }}>Dijemput
                    </option>
                    <option value="diproses" {{ old('status', $pesanan->status) == 'diproses' ? 'selected' : '' }}>Diproses
                    </option>
                    <option value="dipacking" {{ old('status', $pesanan->status) == 'dipacking' ? 'selected' : '' }}>
                        Dipacking</option>
                    <option value="diantar" {{ old('status', $pesanan->status) == 'diantar' ? 'selected' : '' }}>Diantar
                    </option>
                    <option value="selesai" {{ old('status', $pesanan->status) == 'selesai' ? 'selected' : '' }}>Selesai
                    </option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="3">{{ old('catatan', $pesanan->catatan) }}</textarea>
                @error('catatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
@endsection
