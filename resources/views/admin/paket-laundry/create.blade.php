@extends('layouts.main')

@section('title', 'Tambah Paket Laundry - RumahLaundry')
@section('page-title', 'Tambah Paket Laundry Baru')

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

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group-text {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            background-color: var(--neutral-gray);
            border: 2px solid var(--border-color);
            border-right: none;
            border-radius: 0.5rem 0 0 0.5rem;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            color: var(--neutral-dark);
            z-index: 2;
        }

        .input-group .form-control {
            padding-left: 3.5rem;
            border-left: none;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
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

        /* Responsive Design */
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

            .form-control {
                padding: 0.75rem;
            }
        }

        /* Animation for form elements */
        .form-group {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stagger animation for form groups */
        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
        .form-group:nth-child(6) { animation-delay: 0.6s; }
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
                            <i class="fas fa-plus-circle"></i>
                            Tambah Paket Laundry Baru
                        </h2>
                    </div>

                    <!-- Form Content -->
                    <div class="form-content">
                        <div class="form-info">
                            <i class="fas fa-info-circle"></i>
                            Lengkapi semua informasi paket laundry di bawah ini. Pastikan data yang dimasukkan sudah benar.
                        </div>

                        <form action="{{ route('paket-laundry.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <!-- Jenis Paket -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Jenis Paket <span class="required">*</span>
                                        </label>
                                        <input type="text" name="nama_paket" class="form-control" 
                                               placeholder="Masukkan nama paket"
                                               value="{{ old('nama_paket') }}" required>
                                        @error('nama_paket')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Harga -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Harga (Rp.) <span class="required">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="harga" class="form-control" 
                                                   value="{{ old('harga') }}"
                                                   placeholder="Masukkan harga" required min="0" step="500">
                                        </div>
                                        @error('harga')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Satuan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Satuan <span class="required">*</span>
                                        </label>
                                        <select name="satuan" class="form-control" required>
                                            <option value="">Pilih Satuan</option>
                                            <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>
                                                Kg - Kilogram
                                            </option>
                                            <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>
                                                Pcs - Piece (Per Potong)
                                            </option>
                                            <option value="lusin" {{ old('satuan') == 'lusin' ? 'selected' : '' }}>
                                                Lusin
                                            </option>
                                        </select>
                                        @error('satuan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Waktu Pengerjaan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Waktu Pengerjaan <span class="required">*</span>
                                        </label>
                                        <select name="waktu_pengerjaan" class="form-control" required>
                                            <option value="">Pilih Waktu Pengerjaan</option>
                                            <option value="express" {{ old('waktu_pengerjaan') == 'express' ? 'selected' : '' }}>
                                                Express (24 Jam)
                                            </option>
                                            <option value="regular" {{ old('waktu_pengerjaan') == 'regular' ? 'selected' : '' }}>
                                                Regular (2-3 Hari)
                                            </option>
                                            <option value="ekonomi" {{ old('waktu_pengerjaan') == 'ekonomi' ? 'selected' : '' }}>
                                                Ekonomi (4-5 Hari)
                                            </option>
                                        </select>
                                        @error('waktu_pengerjaan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi Paket -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Deskripsi Paket <span class="required">*</span>
                                        </label>
                                        <textarea name="deskripsi" class="form-control" 
                                                  placeholder="Masukkan deskripsi paket laundry" 
                                                  rows="4" required>{{ old('deskripsi') }}</textarea>
                                        <div class="form-text">
                                            Jelaskan detail layanan yang termasuk dalam paket ini.
                                        </div>
                                        @error('deskripsi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <a href="{{ route('paket-laundry.index') }}" class="btn-cancel">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-save"></i> Simpan Paket
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Format currency input
        document.querySelector('input[name="harga"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            if (value) {
                e.target.value = parseInt(value).toLocaleString('id-ID');
            }
        });

        // Remove formatting on form submit
        document.querySelector('form').addEventListener('submit', function(e) {
            let hargaInput = document.querySelector('input[name="harga"]');
            let value = hargaInput.value.replace(/[^\d]/g, '');
            hargaInput.value = value;
        });

        // Auto-focus first input
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('input[name="nama_paket"]').focus();
        });

        // Add input validation feedback
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.style.borderColor = 'var(--accent-danger)';
                } else {
                    this.style.borderColor = 'var(--border-color)';
                }
            });

            input.addEventListener('input', function() {
                this.style.borderColor = 'var(--primary-blue)';
            });
        });
    </script>
@endpush