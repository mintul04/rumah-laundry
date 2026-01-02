@extends('layouts.main')

@section('title', 'Tambah User Baru - RumahLaundry')
@section('page-title', 'Tambah User Baru')

@section('content')
    <div x-data="userForm()" class="mx-auto px-4 py-3">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <!-- Header -->
            <div class="bg-linear-to-r from-blue-600 to-indigo-700 px-6 py-6">
                <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-user-plus"></i>
                    Tambah User Baru
                </h1>
            </div>

            <div class="p-6">
                <!-- Info Box -->
                <div class="bg-indigo-50 border-l-4 border-indigo-500 p-4 rounded-r-lg mb-8 text-indigo-800">
                    <div class="flex items-start gap-2">
                        <i class="fas fa-info-circle mt-0.5 text-indigo-600"></i>
                        <span>Isi data user baru dengan lengkap. Password wajib diisi, foto bersifat opsional.</span>
                    </div>
                </div>

                <form action="{{ route('manajemen-user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Lengkap & Username -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                            @error('nama_lengkap')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Username <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Email & Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Role & Jenis Kelamin -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Role <span class="text-red-500">*</span>
                            </label>
                            <select name="role" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition appearance-none bg-[url('image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3e%3cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27/%3e%3c/svg%3e')] bg-no-repeat bg-position-[1.25em_1.25em] pr-10">
                                <option value="" selected disabled>-- Pilih Role --</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_kelamin" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition appearance-none bg-[url('image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3e%3cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27/%3e%3c/svg%3e')] bg-no-repeat bg-position-[1.25em_1.25em] pr-10">
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki - Laki" {{ old('jenis_kelamin') == 'Laki - Laki' ? 'selected' : '' }}>Laki - Laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Foto Profil -->
                    <div class="mb-10">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Profil (opsional)</label>
                        <div class="flex items-center gap-4">
                            <label class="flex flex-col items-center justify-center w-32 h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition bg-gray-50">
                                <div x-show="!previewUrl" class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-400"></i>
                                    <p class="text-xs text-gray-500 mt-1">Klik untuk pilih gambar</p>
                                </div>
                                <img :src="previewUrl" x-show="previewUrl" class="w-full h-full object-cover rounded-xl" alt="Preview">
                                <input type="file" name="foto" class="hidden" accept="image/*" @change="handleFileSelect">
                            </label>
                            <div class="text-sm text-gray-600 max-w-md">
                                <p class="font-medium">Format: JPG, PNG, JPEG</p>
                                <p>Maksimal ukuran: 2MB</p>
                            </div>
                        </div>
                        @error('foto')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-wrap gap-3 justify-end pt-6 border-t border-gray-200">
                        <a href="{{ route('manajemen-user.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 font-medium transition">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-linear-to-r from-blue-600 to-indigo-700 text-white font-medium rounded-lg shadow-md hover:from-blue-700 hover:to-indigo-800 transition shadow-indigo-100">
                            <i class="fas fa-save"></i> Simpan User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function userForm() {
            return {
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
