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
    <h3>Edit Transaksi</h3>

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">No Order</label>
            <input type="text" class="form-control" name="no_order"
                value="{{ old('no_order', $transaksi->no_order) }}" readonly>
            @error('no_order')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Pelanggan</label>
            <select name="pelanggan_id" class="form-control" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach ($pelanggans as $p)
                    <option value="{{ $p->id }}"
                        {{ old('pelanggan_id', $transaksi->pelanggan_id) == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_pelanggan }}
                    </option>
                @endforeach
            </select>
            @error('pelanggan_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi"
                class="form-control"
                value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi) }}" required>
            @error('tanggal_transaksi')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Pembayaran</label>
            <select name="pembayaran" class="form-control" required>
                <option value="lunas" {{ old('pembayaran', $transaksi->pembayaran) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="belum lunas" {{ old('pembayaran', $transaksi->pembayaran) == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                <option value="dp" {{ old('pembayaran', $transaksi->pembayaran) == 'dp' ? 'selected' : '' }}>DP</option>
            </select>
            @error('pembayaran')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Status Order</label>
            <select name="status_order" class="form-control" required>
                <option value="baru" {{ old('status_order', $transaksi->status_order) == 'baru' ? 'selected' : '' }}>Baru</option>
                <option value="diproses" {{ old('status_order', $transaksi->status_order) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ old('status_order', $transaksi->status_order) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="diambil" {{ old('status_order', $transaksi->status_order) == 'diambil' ? 'selected' : '' }}>Diambil</option>
            </select>
            @error('status_order')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Total (Rp)</label>
            <input type="number" name="total" class="form-control"
                value="{{ old('total', $transaksi->total) }}" readonly>
            @error('total')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('transaksi.index') }}" class="btn-cancel">
                <i class="fas fa-arrow-left"></i> Batal
            </a>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Update Transaksi
            </button>
        </div>
    </form>
</div>
@endsection