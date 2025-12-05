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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">No. Order</label>
                                    <input type="text" class="form-control" name="no_order" value="{{ $lastOrderNumber }}" readonly style="background-color: #f8f9fa; font-weight: 600;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control" name="nama_pelanggan" required placeholder="Masukkan nama pelanggan">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tanggal Terima</label>
                            <input type="date" name="tanggal_terima" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status Pembayaran</label>
                                    <select name="pembayaran" class="form-control" required>
                                        <option value="">-- Pilih Status Pembayaran --</option>
                                        <option value="lunas">Lunas</option>
                                        <option value="dp">DP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6" id="dp-input-container" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label">Jumlah DP</label>
                                    <input type="number" class="form-control" name="jumlah_dp" id="jumlah_dp" placeholder="Masukkan jumlah DP" min="0">
                                </div>
                            </div>
                        </div>

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
                                <button type="button" class="btn btn-primary btn-sm" id="add-item">
                                    <i class="fas fa-plus"></i> Tambah Item
                                </button>
                            </div>
                        </div>

                        <div class="section-title fw-bold mb-2 fs-5">Total & Pembayaran</div>

                        <!-- Input Subtotal Dihapus dari sini -->

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

                        <div class="form-group" style="display: none;">
                            <label class="form-label">Status Order</label>
                            <input type="hidden" name="status_order" value="baru">
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

            // Hitung total
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

                // Update field input tersembunyi (name="total") untuk dikirim ke server
                document.querySelector('input[name="total"]').value = totalAkhir;

                // Update field tampilan (id="total-final-display") untuk user
                document.getElementById('total-final-display').value = totalAkhir;
            }

            // Tampilkan / sembunyikan input DP
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
