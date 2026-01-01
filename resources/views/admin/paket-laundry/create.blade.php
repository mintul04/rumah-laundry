@extends('layouts.main')

@section('title', 'Tambah Paket Laundry - RumahLaundry')
@section('page-title', 'Tambah Paket Laundry Baru')

@section('content')
    <div x-data="{
        hargaDisplay: @js(old('harga') ? number_format((int) old('harga'), 0, ',', '.') : ''),
        hargaRaw: @js(old('harga', '')),
        formatHarga() {
            if (this.hargaRaw) {
                this.hargaDisplay = parseInt(this.hargaRaw).toLocaleString('id-ID');
            } else {
                this.hargaDisplay = '';
            }
        }
    }" x-init="$nextTick(() => formatHarga())" class="mx-auto">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-linear-to-r from-blue-600 to-blue-700 px-6 py-5">
                <h1 class="text-xl md:text-2xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Paket Laundry Baru
                </h1>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded mb-6 text-blue-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    Lengkapi semua informasi paket laundry di bawah ini. Pastikan data yang dimasukkan sudah benar.
                </div>

                <form action="{{ route('paket-laundry.store') }}" method="POST">
                    @csrf

                    <!-- Row 1 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Nama Paket -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                Jenis Paket <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_paket" value="{{ old('nama_paket') }}" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                placeholder="Masukkan nama paket">
                            @error('nama_paket')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                Harga (Rp) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">Rp</span>
                                </div>
                                <input x-model="hargaDisplay" x-on:input="hargaRaw = $event.target.value.replace(/[^\d]/g, ''); formatHarga()" x-on:blur="formatHarga()" type="text"
                                    placeholder="Contoh: 15.000" required
                                    class="w-full pl-12 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                                <input type="hidden" name="harga" x-bind:value="hargaRaw">
                            </div>
                            @error('harga')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Satuan -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                Satuan <span class="text-red-500">*</span>
                            </label>
                            <select name="satuan" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition appearance-none bg-[url('data:image/svg+xml,%3csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 20 20%22%3e%3cpath stroke=%22%236b7280%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%221.5%22 d=%22m6 8 4 4 4-4%22/%3e%3c/svg%3e')] bg-right bg-no-repeat bg-size-[1.25em_1.25em] pr-10">
                                <option value="">Pilih Satuan</option>
                                <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kg - Kilogram</option>
                                <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pcs - Piece</option>
                                <option value="lusin" {{ old('satuan') == 'lusin' ? 'selected' : '' }}>Lusin</option>
                            </select>
                            @error('satuan')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Waktu Pengerjaan -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                Waktu Pengerjaan <span class="text-red-500">*</span>
                            </label>
                            <select name="waktu_pengerjaan" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition appearance-none bg-[url('data:image/svg+xml,%3csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 20 20%22%3e%3cpath stroke=%22%236b7280%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%221.5%22 d=%22m6 8 4 4 4-4%22/%3e%3c/svg%3e')] bg-right bg-no-repeat bg-size-[1.25em_1.25em] pr-10">
                                <option value="">Pilih Waktu Pengerjaan</option>
                                <option value="express" {{ old('waktu_pengerjaan') == 'express' ? 'selected' : '' }}>Express (24 Jam)</option>
                                <option value="regular" {{ old('waktu_pengerjaan') == 'regular' ? 'selected' : '' }}>Regular (2-3 Hari)</option>
                                <option value="ekonomi" {{ old('waktu_pengerjaan') == 'ekonomi' ? 'selected' : '' }}>Ekonomi (4-5 Hari)</option>
                            </select>
                            @error('waktu_pengerjaan')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-8">
                        <label class="block text-gray-700 font-medium mb-2">
                            Deskripsi Paket <span class="text-red-500">*</span>
                        </label>
                        <textarea name="deskripsi" rows="4" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="Masukkan deskripsi paket laundry">{{ old('deskripsi') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Jelaskan detail layanan yang termasuk dalam paket ini.</p>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('paket-laundry.index') }}"
                            class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-5 py-2.5 bg-linear-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg shadow hover:shadow-md hover:-translate-y-0.5 transition transform focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-save mr-2"></i> Simpan Paket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Auto-focus
            document.querySelector('input[name="nama_paket"]')?.focus();

            // Validasi visual saat blur
            document.querySelectorAll('input, select, textarea').forEach(el => {
                el.addEventListener('blur', function() {
                    if (this.value.trim() === '') {
                        this.classList.remove('border-gray-300', 'focus:border-blue-500');
                        this.classList.add('border-red-500');
                    } else {
                        this.classList.remove('border-red-500');
                        this.classList.add('border-gray-300');
                    }
                });
            });
        });
    </script>
@endsection
