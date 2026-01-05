@extends('layouts.main')

@section('title', 'Transaksi Laundry - RumahLaundry')
@section('page-title', 'Daftar Transaksi Laundry')

@push('styles')
    <style>
        .badge-lunas {
            @apply bg-green-100 text-green-800;
        }

        .badge-belum-lunas {
            @apply bg-red-100 text-red-800;
        }

        .badge-baru {
            @apply bg-blue-100 text-blue-800;
        }

        .badge-diproses {
            @apply bg-sky-100 text-sky-800;
        }

        .badge-selesai {
            @apply bg-emerald-100 text-emerald-800;
        }

        .badge-diambil {
            @apply bg-gray-100 text-gray-800;
        }
    </style>
@endpush

@section('content')
    <div x-data="{ searchTerm: '' }" class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-shopping-cart"></i>
                    Daftar Transaksi
                </h2>
                <a href="{{ route('transaksi.create') }}"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-all hover:-translate-y-0.5">
                    <i class="fas fa-plus"></i>
                    Tambah Transaksi
                </a>
            </div>

            <!-- Search -->
            <div class="mb-6">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input x-model="searchTerm" type="text" placeholder="Cari pelanggan..."
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>
                </div>
            </div>

            <!-- Table or Empty State -->
            @if ($transaksis->count() > 0)
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">No</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">No Order</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Nama Pelanggan</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Tanggal Terima</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Pembayaran</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Status Order</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($transaksis as $item)
                                <tr x-show="(@js($item->no_order . ' ' . $item->pelanggan?->nama ?? '-')).toLowerCase().includes(searchTerm.toLowerCase())" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $item->no_order }}</td>
                                    <td class="px-6 py-4">{{ $item->pelanggan->nama ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->tanggal_terima }}</td>
                                    <td class="px-6 py-4">
                                        @if ($item->pembayaran === 'dp')
                                            <div class="flex items-center gap-2">
                                                <span class="badge-lunas">DP</span>
                                                <span class="text-sm text-gray-600">
                                                    {{ number_format($item->jumlah_dp, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        @elseif ($item->pembayaran === 'lunas')
                                            <span class="badge-lunas">Lunas</span>
                                        @else
                                            <span class="badge-belum-lunas">Belum Bayar</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($item->status_order == 'baru')
                                            <span class="badge-baru">Baru</span>
                                        @elseif ($item->status_order == 'diproses')
                                            <span class="badge-diproses">Diproses</span>
                                        @elseif ($item->status_order == 'selesai')
                                            <span class="badge-selesai">Selesai</span>
                                        @else
                                            <span class="badge-diambil">Diambil</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('transaksi.show', $item->id) }}"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-800 font-medium rounded text-xs transition-colors">
                                                <i class="fa fa-eye text-xs"></i> Detail
                                            </a>

                                            <!-- Hidden Form for Delete -->
                                            <form id="hapus-transaksi-{{ $item->id }}" action="{{ route('transaksi.destroy', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <button type="button" onclick="konfirmasiHapusTransaksi({{ $item->id }}, '{{ addslashes($item->no_order) }}')"
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
                        <p>Tidak ada transaksi yang cocok</p>
                    </div>
                </div>

                <!-- Pagination -->
                @if ($transaksis->hasPages())
                    <div class="border-t border-slate-200/30 px-6 py-4 bg-slate-50/50">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                            <p class="text-sm text-slate-600 text-center sm:text-left">
                                Menampilkan <span class="font-bold text-slate-800">{{ $transaksis->firstItem() }}</span>–
                                <span class="font-bold text-slate-800">{{ $transaksis->lastItem() }}</span> dari
                                <span class="font-bold text-slate-800">{{ $transaksis->total() }}</span> hasil
                            </p>
                            <div class="flex gap-2">
                                @if ($transaksis->onFirstPage())
                                    <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm bg-slate-100 text-slate-400 cursor-not-allowed font-medium">
                                        <i class="fa-solid fa-chevron-left mr-1 text-xs"></i> Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $transaksis->previousPageUrl() }}"
                                        class="inline-flex items-center px-4 py-2 rounded-lg text-sm bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-medium shadow-sm hover:shadow transition-colors">
                                        <i class="fa-solid fa-chevron-left mr-1 text-xs"></i> Sebelumnya
                                    </a>
                                @endif

                                @if ($transaksis->hasMorePages())
                                    <a href="{{ $transaksis->nextPageUrl() }}"
                                        class="inline-flex items-center px-4 py-2 rounded-lg text-sm bg-linear-to-r from-blue-600 to-cyan-600 text-white font-medium shadow-md hover:shadow-lg hover:from-blue-700 hover:to-cyan-700 transition-all">
                                        Selanjutnya <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                                    </a>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm bg-slate-100 text-slate-400 cursor-not-allowed font-medium">
                                        Selanjutnya <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-12 text-gray-500">
                    <i class="fas fa-receipt text-4xl opacity-50 mb-4"></i>
                    <p class="text-lg">Belum ada data transaksi</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function konfirmasiHapusTransaksi(id, noOrder) {
            Swal.fire({
                title: 'Hapus Transaksi?',
                html: `
                    <div class="text-center">
                        <p class="text-slate-700 mb-2">Anda akan menghapus transaksi:</p>
                        <p class="text-lg font-bold text-red-600 mb-3">${noOrder}</p>
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
                    document.getElementById('hapus-transaksi-' + id).submit();
                }
            });
        }
    </script>
@endsection
