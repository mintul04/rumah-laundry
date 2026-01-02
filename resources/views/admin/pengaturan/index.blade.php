@extends('layouts.main')

@section('title', 'Pengaturan Aplikasi')
@section('page-title', 'Pengaturan Aplikasi')

@section('content')
    <div x-data="settingsForm({
        currentLogo: '{{ $pengaturan?->logo ? Storage::url($pengaturan->logo) : '' }}'
    })" class="mx-auto px-4 py-3">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <!-- Header -->
            <div class="bg-linear-to-r from-cyan-600 to-teal-700 px-6 py-6">
                <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-cog"></i>
                    Pengaturan Aplikasi
                </h1>
            </div>

            <div class="p-6">
                <form action="{{ route('pengaturan.update', $pengaturan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- 1. Logo Instansi -->
                    <div class="mb-10">
                        <h2 class="text-xl font-bold text-gray-800 mb-5 flex items-center gap-2">
                            <i class="fas fa-image text-cyan-600"></i>
                            Logo Instansi
                        </h2>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="flex flex-col items-center">
                                <p class="text-sm font-medium text-gray-600 mb-3">Logo Saat Ini</p>
                                <template x-if="currentLogo">
                                    <img :src="currentLogo" class="w-32 h-32 object-contain rounded-xl border border-gray-200 shadow-sm" alt="Logo saat ini">
                                </template>
                                <template x-if="!currentLogo">
                                    <div class="w-32 h-32 flex items-center justify-center bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl text-gray-500">
                                        <i class="fas fa-image text-2xl"></i>
                                    </div>
                                </template>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Logo Baru</label>
                                <div class="flex flex-col gap-4">
                                    <label
                                        class="flex flex-col items-center justify-center w-32 h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition bg-gray-50">
                                        <div x-show="!previewUrl" class="text-center">
                                            <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-1"></i>
                                            <p class="text-sm text-gray-500">Klik untuk pilih gambar</p>
                                        </div>
                                        <img :src="previewUrl" x-show="previewUrl" class="w-full h-full object-contain rounded-xl" alt="Preview logo">
                                        <input type="file" name="logo" x-ref="fileInput" class="hidden" accept=".jpg,.jpeg,.png" @change="handleFileSelect">
                                    </label>
                                    <p class="text-xs text-gray-500">Format: JPG, PNG, JPEG (maks 2MB)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Informasi Instansi -->
                    <div class="mb-10 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-5 flex items-center gap-2">
                            <i class="fas fa-store text-emerald-600"></i>
                            Informasi Instansi
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Laundry</label>
                                <input type="text" name="nama_laundry" value="{{ old('nama_laundry', $pengaturan?->nama_laundry ?? 'Arrabia Laundry') }}" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Telepon Laundry</label>
                                <input type="text" name="telepon_laundry" value="{{ old('telepon_laundry', $pengaturan?->telepon_laundry ?? '6281234567890') }}" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Laundry</label>
                                <input type="email" name="email_laundry" value="{{ old('email_laundry', $pengaturan?->email_laundry ?? 'arrablialaundry@gmail.com') }}" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                            </div>
                        </div>
                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Laundry</label>
                            <textarea name="alamat_laundry" rows="3" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition resize-none">{{ old('alamat_laundry', $pengaturan?->alamat_laundry ?? "Kamisari's Polisi Bambang Suprapio No.24, Bodno, Koc Gondokusuman, Koto Yogakarta, L.") }}</textarea>
                        </div>
                    </div>

                    <!-- 3. Informasi Pemilik -->
                    <div class="mb-10">
                        <h2 class="text-xl font-bold text-gray-800 mb-5 flex items-center gap-2">
                            <i class="fas fa-user text-amber-600"></i>
                            Informasi Pemilik
                        </h2>
                        <div class="max-w-md">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik', $pengaturan?->nama_pemilik ?? 'Uchiha Madara') }}" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                        </div>
                    </div>

                    <!-- 4. Action Buttons -->
                    <div class="flex flex-wrap gap-3 justify-end pt-4 border-t border-gray-200">
                        <button type="reset" class="inline-flex items-center gap-2 px-5 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 font-medium transition">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-linear-to-r from-cyan-600 to-teal-700 text-white font-medium rounded-lg shadow-md hover:from-cyan-700 hover:to-teal-800 transition shadow-cyan-100">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function settingsForm({
            currentLogo
        }) {
            return {
                currentLogo,
                previewUrl: null,

                openFilePicker() {
                    this.$refs.fileInput.click();
                },

                handleFileSelect(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.previewUrl = URL.createObjectURL(file);
                    }
                },
            };
        }
    </script>
@endsection
