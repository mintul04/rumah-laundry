@extends('layouts.main')

@section('title', 'Tambah Transaksi Laundry - RumahLaundry')
@section('page-title', 'Tambah Transaksi Laundry Baru')

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
    <div class="container">
        <div class="row justify-content-center">
            <div class="card shadow">
                <div class="card-body">
                    <h3>Tambah Transaksi Baru</h3>

                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf

                        {{-- Informasi Transaksi --}}
                        <div class="section-title">Informasi Transaksi</div>

                        <div class="row">
                            <div class="col-md-6">
                                {{-- No Order --}}
                                <div class="form-group">
                                    <label class="form-label">No. Order</label>
                                    <input type="text" class="form-control" name="no_order"
                                        value="{{ 'LO' . str_pad(($lastOrderNumber ?? 0) + 1, 3, '0', STR_PAD_LEFT) }}"
                                        readonly style="background-color: #f8f9fa; font-weight: 600;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- Status Pembayaran --}}
                                <div class="form-group">
                                    <label class="form-label">Status Pembayaran</label>
                                    <select name="pembayaran" class="form-control" required>
                                        <option value="">-- Pilih Status Pembayaran --</option>
                                        <option value="lunas">Lunas</option>
                                        <option value="belum lunas">Belum Lunas</option>
                                        <option value="dp">DP</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Data Pelanggan --}}
                        <div class="section-title">Data Pelanggan</div>

                        <div class="form-group">
                            <label class="form-label">Nama Pelanggan</label>
                            <select name="pelanggan_id" class="form-control" required id="pelanggan-select">
                                <option value="">-- Pilih Nama Pelanggan --</option>
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id }}" data-phone="{{ $p->telepon }}"
                                        data-address="{{ $p->alamat }}">
                                        {{ $p->nama_pelanggan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="pelanggan-phone" readonly
                                        style="background-color: #f8f9fa;" placeholder="Pilih pelanggan terlebih dahulu">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" id="pelanggan-address" readonly style="background-color: #f8f9fa; height: 80px;"
                                        placeholder="Pilih pelanggan terlebih dahulu"></textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Detail Pesanan --}}
                        <div class="section-title">Detail Pesanan</div>

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
                                {{-- Item akan ditambahkan secara dinamis --}}
                                <tr class="item-row">
                                    <td>1</td>
                                    <td>
                                        <select name="items[0][paket_id]" class="form-control paket-select" required>
                                            <option value="">-- Pilih Paket --</option>
                                            @foreach ($pakets as $paket)
                                                <option value="{{ $paket->id }}" data-harga="{{ $paket->harga }}">
                                                    {{ $paket->nama_paket }} - Rp
                                                    {{ number_format($paket->harga, 0, ',', '.') }} / Kg
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="items[0][berat]" class="form-control berat-input"
                                            step="0.1" min="0.1" value="1" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control subtotal-input" value="Rp 0" readonly
                                            style="background-color: #f8f9fa; font-weight: 600;">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-item" disabled>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-primary btn-sm" id="add-item">
                            <i class="fas fa-plus"></i> Tambah Item
                        </button>

                        {{-- Total & Diskon --}}
                        <div class="section-title">Total & Pembayaran</div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Subtotal</label>
                                    <input type="text" class="form-control" id="subtotal-total" value="Rp 0" readonly
                                        style="background-color: #f8f9fa; font-weight: 600;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Diskon (Rp)</label>
                                    <input type="number" name="diskon" class="form-control" id="diskon-input"
                                        value="0" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Total Akhir</label>
                            <input type="number" name="total" class="form-control" id="total-final" value="0"
                                readonly style="background-color: #f8f9fa; font-weight: 600; font-size: 1.1rem;">
                        </div>

                        {{-- Tanggal Transaksi --}}
                        <div class="form-group" style="display: none;">
                            <label class="form-label">Tanggal Transaksi</label>
                            <input type="date" name="tanggal_transaksi" class="form-control"
                                value="{{ date('Y-m-d') }}" required>
                        </div>

                        {{-- Status Order --}}
                        <div class="form-group" style="display: none;">
                            <label class="form-label">Status Order</label>
                            <select name="status_order" class="form-control" required>
                                <option value="baru">Baru</option>
                            </select>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('transaksi.index') }}" class="btn-cancel">
                                <i class="fas fa-arrow-left"></i> Batal
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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let itemCount = 1;

            // Update info pelanggan
            document.getElementById('pelanggan-select').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                document.getElementById('pelanggan-phone').value = selectedOption.dataset.phone || '';
                document.getElementById('pelanggan-address').value = selectedOption.dataset.address || '';
            });

            // Tambah item
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
                            {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }} / Kg
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

                // Enable remove button untuk semua item kecuali pertama
                document.querySelectorAll('.remove-item').forEach((btn, index) => {
                    btn.disabled = index === 0;
                });

                attachEventListeners(newRow);
                calculateTotal();
            });

            // Hitung total
            function calculateTotal() {
                let subtotal = 0;

                document.querySelectorAll('.item-row').forEach(row => {
                    const paketSelect = row.querySelector('.paket-select');
                    const beratInput = row.querySelector('.berat-input');
                    const subtotalInput = row.querySelector('.subtotal-input');

                    if (paketSelect.value && beratInput.value) {
                        const harga = parseFloat(paketSelect.selectedOptions[0].dataset.harga);
                        const berat = parseFloat(beratInput.value);
                        const itemSubtotal = harga * berat;

                        subtotal += itemSubtotal;
                        subtotalInput.value = 'Rp ' + itemSubtotal.toLocaleString('id-ID');
                    }
                });

                const diskon = parseFloat(document.getElementById('diskon-input').value) || 0;
                const totalAkhir = subtotal - diskon;

                document.getElementById('subtotal-total').value = 'Rp ' + subtotal.toLocaleString('id-ID');
                document.getElementById('total-final').value = totalAkhir > 0 ? totalAkhir : 0;
            }

            // Attach event listeners untuk row baru
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

            // Event listeners untuk item pertama
            attachEventListeners(document.querySelector('.item-row'));

            // Event listener untuk diskon
            document.getElementById('diskon-input').addEventListener('input', calculateTotal);
        });
    </script>
@endsection
