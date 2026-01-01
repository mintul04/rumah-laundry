@extends('layouts.main')

@section('title', 'Paket Laundry - RumahLaundry')
@section('page-title', 'Daftar Paket Laundry')

@push('styles')
    <style>
        .badge-basic {
            @apply bg-blue-100 text-blue-800;
        }

        .badge-standard {
            @apply bg-green-100 text-green-800;
        }

        .badge-premium {
            @apply bg-amber-100 text-amber-800;
        }

        .badge-custom {
            @apply bg-purple-100 text-purple-800;
        }
    </style>
@endpush

@section('content')
    <div x-data="{ searchTerm: '' }" class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-list-check"></i>
                    Paket Laundry
                </h2>
                <a href="{{ route('paket-laundry.create') }}"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-all hover:-translate-y-0.5">
                    <i class="fas fa-plus"></i>
                    Tambah Paket Laundry
                </a>
            </div>

            <!-- Search -->
            <div class="mb-6">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input x-model="searchTerm" type="text" placeholder="Cari paket..."
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>
                </div>
            </div>

            <!-- Table or Empty State -->
            @if ($paketLaundries->count() > 0)
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Jenis Paket</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Harga</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Satuan</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Waktu Pengerjaan</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($paketLaundries as $paket)
                                <tr x-show="(@js($paket->nama_paket . ' ' . $paket->satuan . ' ' . ($paket->deskripsi ?? ''))).toLowerCase().includes(searchTerm.toLowerCase())" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                        {{ $paket->jenis_paket === 'Basic' ? 'badge-basic' : '' }}
                                        {{ $paket->jenis_paket === 'Standard' ? 'badge-standard' : '' }}
                                        {{ $paket->jenis_paket === 'Premium' ? 'badge-premium' : '' }}
                                        {{ $paket->jenis_paket === 'Custom' ? 'badge-custom' : '' }}
                                    ">
                                            {{ $paket->nama_paket }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paket->satuan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paket->waktu_pengerjaan ?? '3 Hari' }}</td>
                                    <td class="px-6 py-4 max-w-xs wrap-break-word text-gray-700">
                                        {{ $paket->deskripsi ?? 'Tidak ada deskripsi' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('paket-laundry.edit', $paket->id) }}"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-100 hover:bg-amber-200 text-amber-800 font-medium rounded text-xs transition-colors">
                                                <i class="fa fa-pen text-xs"></i> Edit
                                            </a>

                                            <!-- Hidden Form for Delete -->
                                            <form id="hapus-data-{{ $paket->id }}" action="{{ route('paket-laundry.destroy', $paket->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <button type="button" onclick="konfirmasiHapusPaket({{ $paket->id }}, '{{ addslashes($paket->nama_paket) }}')"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-800 font-medium rounded text-xs transition-colors">
                                                <i class="fa fa-trash text-xs"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Empty filtered result -->
                    <div x-show="!Array.from($root.querySelectorAll('tbody tr')).some(tr => tr.style.display !== 'none')" class="text-center py-10 text-gray-500" x-cloak>
                        <i class="fas fa-search fa-2x opacity-50 mb-3"></i>
                        <p>Tidak ada paket yang cocok dengan pencarian Anda</p>
                    </div>
                </div>

                <!-- Pagination Info -->
                <div class="mt-4 text-sm text-gray-500">
                    Menampilkan {{ $paketLaundries->count() }} paket
                </div>
            @else
                <div class="text-center py-12 text-gray-500">
                    <i class="fas fa-box-open text-4xl opacity-50 mb-4"></i>
                    <p class="text-lg">Belum ada data paket laundry</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function konfirmasiHapusPaket(id, namaPaket) {
            Swal.fire({
                title: 'Hapus Paket?',
                html: `
                <div class="text-center">
                    <p class="text-slate-700 mb-2">Anda akan menghapus paket:</p>
                    <p class="text-lg font-bold text-red-600 mb-3">${namaPaket}</p>
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
                    document.getElementById('hapus-data-' + id).submit();
                }
            });
        }
    </script>
@endsection
