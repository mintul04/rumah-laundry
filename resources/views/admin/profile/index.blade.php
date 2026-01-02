@extends('layouts.main')

@section('page-title', 'Profil Saya')

@section('content')
    <div x-data="profileForm({
        currentPhoto: '{{ auth()->user()->foto ? Storage::url(auth()->user()->foto) : null }}',
        initials: '{{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}'
    })" class="mx-auto px-4 py-3">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden hover:shadow-2xl transition-shadow duration-300">
            <div class="px-6 py-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <i class="fas fa-user-circle text-indigo-600"></i>
                    Profil Saya
                </h1>
            </div>

            <div class="p-6">
                <!-- Update Profile Form -->
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Avatar Section (Left) -->
                        <div class="lg:col-span-1">
                            <div class="flex flex-col items-center">
                                <!-- Avatar Preview -->
                                <div class="relative group">
                                    <div
                                        class="w-32 h-32 rounded-full bg-linear-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg border-4 border-white transition-transform duration-300 group-hover:scale-105">
                                        <template x-if="previewUrl || currentPhoto">
                                            <img :src="previewUrl || currentPhoto" class="w-full h-full object-cover rounded-full" alt="Foto profil">
                                        </template>
                                        <template x-if="!previewUrl && !currentPhoto">
                                            <span class="text-white text-2xl font-bold" x-text="initials"></span>
                                        </template>
                                    </div>
                                </div>

                                <div class="mt-6 w-full">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti Foto Profil</label>
                                    <label
                                        class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition bg-gray-50">
                                        <div class="text-center">
                                            <i class="fas fa-cloud-upload-alt text-gray-400 text-lg mb-1"></i>
                                            <p class="text-xs text-gray-500">Klik untuk upload</p>
                                        </div>
                                        <input type="file" name="foto" x-ref="fileInput" class="hidden" accept="image/*" @change="handleFileSelect">
                                    </label>
                                    <p class="mt-2 text-xs text-gray-500 text-center">Maks. 2MB (JPG, PNG, GIF)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Form Fields (Right) -->
                        <div class="lg:col-span-2 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}" required
                                        class="w-full px-4 py-3.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                                    @error('nama_lengkap')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                                    <input type="text" name="nama" value="{{ old('nama', auth()->user()->nama) }}" required
                                        class="w-full px-4 py-3.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                                    @error('nama')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                        class="w-full px-4 py-3.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="pt-2">
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-linear-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-indigo-700 transition-transform hover:-translate-y-0.5 hover:shadow-xl">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Divider -->
                <hr class="my-10 border-gray-200">

                <!-- Change Password Section -->
                <div class="max-w-2xl">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-key text-amber-500"></i>
                        Ubah Password
                    </h2>
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini</label>
                                <input type="password" name="current_password" required
                                    class="w-full px-4 py-3.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                                <input type="password" name="new_password" required
                                    class="w-full px-4 py-3.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                                @error('new_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" required
                                    class="w-full px-4 py-3.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                            </div>

                            <div class="pt-2">
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-linear-to-r from-amber-500 to-orange-500 text-white font-semibold rounded-xl shadow-lg hover:from-amber-600 hover:to-orange-600 transition-transform hover:-translate-y-0.5 hover:shadow-xl">
                                    <i class="fas fa-sync-alt"></i> Ubah Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function profileForm({
            currentPhoto,
            initials
        }) {
            return {
                currentPhoto,
                previewUrl: null,
                initials,

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
