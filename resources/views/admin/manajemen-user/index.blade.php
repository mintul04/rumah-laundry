@extends('layouts.main')

@section('title', 'Manajemen User - RumahLaundry')
@section('page-title', 'Daftar User')

@section('content')
    <div x-data="{ searchTerm: '' }" class="max-w-7xl mx-auto px-4 py-6">
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-5 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-users text-indigo-600"></i>
                    Manajemen User
                </h2>
                <a href="{{ route('manajemen-user.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm hover:from-indigo-700 hover:to-purple-700 transition-all hover:-translate-y-0.5">
                    <i class="fas fa-plus"></i> Tambah User
                </a>
            </div>

            <!-- Search -->
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input x-model="searchTerm" type="text" placeholder="Cari user..."
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                </div>
            </div>

            <!-- Table or Empty State -->
            @if ($user->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($user as $item)
                                <tr x-show="(@js($item->nama . ' ' . $item->email)).toLowerCase().includes(searchTerm.toLowerCase())" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            @if ($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="w-10 h-10 rounded-full object-cover border">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=random" alt="Avatar" class="w-10 h-10 rounded-full border">
                                            @endif
                                            <span class="font-medium text-gray-800">{{ $item->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">{{ $item->nama }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $item->email ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        @if ($item->role === 'admin')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-rose-100 text-rose-800 text-xs font-medium">
                                                {{ ucfirst($item->role) }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-medium">
                                                {{ ucfirst($item->role) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">{{ $item->jenis_kelamin }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('manajemen-user.edit', $item->id) }}"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-100 hover:bg-amber-200 text-amber-800 font-medium rounded text-xs transition-colors">
                                                <i class="fa fa-pen text-xs"></i> Edit
                                            </a>

                                            @if ($item->role !== 'admin')
                                                <form id="hapus-user-{{ $item->id }}" action="{{ route('manajemen-user.destroy', $item->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <button onclick="konfirmasiHapusUser({{ $item->id }}, '{{ addslashes($item->nama) }}')" type="button"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-800 font-medium rounded text-xs transition-colors">
                                                    <i class="fa fa-trash text-xs"></i> Hapus
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Empty filtered state -->
                    <div x-show="!Array.from($root.querySelectorAll('tbody tr')).some(tr => tr.style.display !== 'none')" class="px-6 py-12 text-center text-gray-500" x-cloak>
                        <i class="fas fa-search fa-2x opacity-50 mb-3"></i>
                        <p>Tidak ada user yang cocok</p>
                    </div>
                </div>
            @else
                <div class="px-6 py-16 text-center text-gray-500">
                    <i class="fas fa-user-group text-4xl opacity-60 mb-4"></i>
                    <p class="text-lg font-medium">Belum ada data user</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function konfirmasiHapusUser(id, nama) {
            Swal.fire({
                title: 'Hapus User?',
                html: `
                    <div class="text-center">
                        <p class="text-slate-700 mb-2">Anda akan menghapus User:</p>
                        <p class="text-lg font-bold text-red-600 mb-3">${nama}</p>
                        <p class="text-sm text-slate-500">Tindakan ini tidak dapat dibatalkan</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa-solid fa-trash mr-2"></i>Ya, Hapus',
                cancelButtonText: '<i class="fa-solid fa-times mr-2"></i>Batal',
                reverseButtons: true,
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-2',
                    cancelButton: 'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('hapus-user-' + id).submit();
                }
            });
        }
    </script>
@endsection
