@extends('layouts.main')

@section('title', 'Tambah Transaksi Laundry - RumahLaundry')
@section('page-title', 'Tambah Transaksi Laundry Baru')

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

        .form-control {
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

        .form-control:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
            background-color: var(--neutral-white);
        }

        .form-control:hover {
            border-color: #adb5bd;
        }

        .form-control::placeholder {
            color: #6c757d;
            opacity: 0.7;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
            line-height: 1.5;
            padding: 1rem;
        }

        select.form-control {
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

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 2rem 0 1.5rem;
            color: var(--neutral-dark);
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--border-color);
        }

        .table {
            margin-bottom: 1.5rem;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
        }

        .table th {
            background-color: var(--neutral-gray);
            font-weight: 600;
            color: var(--neutral-dark);
        }

        .table td .form-control {
            padding: 0.625rem 0.75rem;
            font-size: 0.95rem;
        }

        .btn-primary-sm {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            font-size: 0.95rem;
            border-radius: 0.375rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary-sm:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
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

            .form-control {
                padding: 0.75rem;
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
                            <i class="fas fa-receipt"></i>
                            Tambah Transaksi Laundry Baru
                        </h2>
                    </div>

                    <!-- Form Content -->
                    <div class="form-content">
                        <div class="form-info">
                            <i class="fas fa-info-circle"></i>
                            Isi data transaksi dengan lengkap. Nomor order akan digenerate otomatis.
                        </div>

                        <form action="{{ route('transaksi.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <!-- No. Order -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">No. Order</label>
                                        <input type="text" class="form-control" name="no_order" value="{{ $lastOrderNumber }}" readonly style="background-color: #f8f9fa; font-weight: 600;">
                                    </div>
                                </div>

                                <!-- Nama Pelanggan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nama Pelanggan <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="nama_pelanggan" required placeholder="Masukkan nama pelanggan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Tanggal Terima -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Terima <span class="required">*</span></label>
                                        <input type="date" name="tanggal_terima" class="form-control" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>

                                <!-- Tanggal Selesai -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Selesai <span class="required">*</span></label>
                                        <input type="date" name="tanggal_selesai" class="form-control" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Status Pembayaran -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Status Pembayaran <span class="required">*</span></label>
                                        <select name="pembayaran" class="form-control" required>
                                            <option value="">-- Pilih Status Pembayaran --</option>
                                            <option value="dp">DP</option>
                                            <option value="lunas">Lunas</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Jumlah DP (conditional) -->
                                <div class="col-md-6" id="dp-input-container" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Jumlah DP</label>
                                        <input type="number" class="form-control" name="jumlah_dp" id="jumlah_dp" placeholder="Masukkan jumlah DP" min="0">
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Pesanan -->
                            <div class="section-title">
                                <i class="fas fa-list"></i> Detail Pesanan
                            </div>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Paket</th>
                                        <th>Berat</th>
                                        <th>Subtotal</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody id="items-container">
                                    <tr class="item-row">
                                        <td>1</td>
                                        <td>
                                            <select name="items[0][paket_id]" class="form-control paket-select" required>
                                                <option value="">-- Pilih Paket --</option>
                                                @foreach ($pakets as $paket)
                                                    <option value="{{ $paket->id }}" data-harga="{{ $paket->harga }}">
                                                        {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }} / {{ $paket->satuan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="items[0][berat]" class="form-control berat-input" step="0.1" min="0.1" value="1" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control subtotal-input" value="Rp 0" readonly style="background-color: #f8f9fa; font-weight: 600;">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove-item" disabled>
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row justify-content-start mb-3">
                                <div class="col-md-6">
                                    <button type="button" class="btn-primary-sm" id="add-item">
                                        <i class="fas fa-plus"></i> Tambah Item
                                    </button>
                                </div>
                            </div>

                            <!-- Total & Pembayaran -->
                            <div class="section-title">
                                <i class="fas fa-calculator"></i> Total & Pembayaran
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Diskon (Rp)</label>
                                        <input type="number" name="diskon" class="form-control" id="diskon-input" value="0" min="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Total Akhir</label>
                                        <input type="number" name="total" class="form-control" id="total-final-display" value="0" readonly
                                            style="background-color: #f8f9fa; font-weight: 600; font-size: 1.1rem;">
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden Status Order -->
                            <input type="hidden" name="status_order" value="baru">

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <a href="{{ route('transaksi.index') }}" class="btn-cancel">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-save"></i> Simpan Transaksi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tetap gunakan script asli tanpa perubahan logika --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let itemCount = 1;

            document.getElementById('add-item').addEventListener('click', function() {
                const newRow = document.createElement('tr');
                newRow.className = 'item-row';
                newRow.innerHTML = `
                <td>${itemCount + 1}</td>
                <td>
                    <select name="items[${itemCount}][paket_id]" class="form-control paket-select" required>
                        <option value="">-- Pilih Paket --</option>
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket->id }}" data-harga="{{ $paket->harga }}">
                                {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }} / {{ $paket->satuan }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][berat]" class="form-control berat-input" 
                        step="0.1" min="0.1" value="1" required>
                </td>
                <td>
                    <input type="text" class="form-control subtotal-input" value="Rp 0" readonly
                        style="background-color: #f8f9fa; font-weight: 600;">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-item">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
                document.getElementById('items-container').appendChild(newRow);
                itemCount++;

                document.querySelectorAll('.remove-item').forEach((btn, index) => {
                    btn.disabled = index === 0;
                });

                attachEventListeners(newRow);
                calculateTotal();
            });

            function calculateTotal() {
                let subtotalItems = 0;

                document.querySelectorAll('.item-row').forEach(row => {
                    const paketSelect = row.querySelector('.paket-select');
                    const beratInput = row.querySelector('.berat-input');
                    const subtotalInput = row.querySelector('.subtotal-input');

                    if (paketSelect.value && beratInput.value) {
                        const harga = parseFloat(paketSelect.selectedOptions[0].dataset.harga);
                        const berat = parseFloat(beratInput.value);
                        const itemSubtotal = harga * berat;

                        subtotalItems += itemSubtotal;
                        subtotalInput.value = 'Rp ' + itemSubtotal.toLocaleString('id-ID');
                    } else {
                        subtotalInput.value = 'Rp 0';
                    }
                });

                const diskon = parseFloat(document.getElementById('diskon-input').value) || 0;
                const totalAkhir = subtotalItems - diskon;

                document.querySelector('input[name="total"]').value = totalAkhir;
                document.getElementById('total-final-display').value = totalAkhir;
            }

            document.querySelector('select[name="pembayaran"]').addEventListener('change', function() {
                const dpContainer = document.getElementById('dp-input-container');
                const dpInput = document.getElementById('jumlah_dp');
                if (this.value === 'dp') {
                    dpContainer.style.display = 'block';
                    dpInput.setAttribute('required', 'required');
                } else {
                    dpContainer.style.display = 'none';
                    dpInput.removeAttribute('required');
                    dpInput.value = '';
                }
            });

            function attachEventListeners(row) {
                row.querySelector('.paket-select').addEventListener('change', calculateTotal);
                row.querySelector('.berat-input').addEventListener('input', calculateTotal);
                row.querySelector('.remove-item').addEventListener('click', function() {
                    if (!this.disabled) {
                        row.remove();
                        calculateTotal();
                    }
                });
            }

            attachEventListeners(document.querySelector('.item-row'));
            document.getElementById('diskon-input').addEventListener('input', calculateTotal);
        });
    </script>
@endsection
