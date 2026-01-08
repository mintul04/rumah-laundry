@extends('layouts.main')

@section('title', 'Detail Transaksi - RumahLaundry')
@section('page-title', 'Detail Transaksi Laundry')

@section('content')
    <div x-data="{ openPrint: false }" class="mx-auto px-4 py-3">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-6 border-b border-gray-200 bg-linear-to-r from-indigo-50 to-blue-50">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Detail Transaksi</h1>
                        <p class="text-gray-600 mt-1">No. Order: <span
                                class="font-mono font-semibold text-indigo-700">{{ $transaksi->no_order }}</span></p>
                    </div>
                    <a href="{{ route('transaksi.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-indigo-700 bg-white hover:bg-indigo-50 rounded-lg border border-gray-300 transition-all duration-200 shadow-sm hover:shadow-md">
                        <i class="fas fa-arrow-left text-sm"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <!-- Informasi Transaksi -->
            <div class="px-6 py-6 bg-linear-to-br from-gray-50 to-white border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2">
                    <i class="fas fa-info-circle text-indigo-600"></i>
                    Informasi Transaksi
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    <!-- No Order -->
                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">No. Order</p>
                        <p class="mt-1 font-mono text-lg font-bold text-gray-800">{{ $transaksi->no_order }}</p>
                    </div>

                    <!-- Pelanggan -->
                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pelanggan</p>
                        <p class="mt-1 text-lg font-bold text-gray-800">{{ $transaksi->pelanggan->nama ?? '-' }}</p>
                    </div>

                    <!-- Tanggal Terima -->
                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Terima</p>
                        <p class="mt-1 text-lg font-bold text-gray-800">
                            {{ \Carbon\Carbon::parse($transaksi->tanggal_terima)->locale('id')->isoFormat('D MMMM Y') }}
                        </p>
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Selesai</p>
                        <p class="mt-1 text-lg font-bold text-gray-800">
                            {{ $transaksi->tanggal_selesai ? \Carbon\Carbon::parse($transaksi->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') : '-' }}
                        </p>
                    </div>

                    <!-- Status Pembayaran -->
                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pembayaran</p>
                        <div class="mt-1">
                            @if ($transaksi->pembayaran == 'lunas')
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-sm font-semibold">
                                    <i class="fas fa-check-circle"></i> Lunas
                                </span>
                            @elseif($transaksi->pembayaran == 'dp')
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-sm font-semibold">
                                    <i class="fas fa-coins"></i> DP
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-100 text-red-800 text-sm font-semibold">
                                    <i class="fas fa-times-circle"></i> Belum Bayar
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Status Order -->
                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</p>
                        <div class="mt-1">
                            @if ($transaksi->status_order == 'baru')
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold">
                                    <i class="fas fa-clock"></i> Baru
                                </span>
                            @elseif($transaksi->status_order == 'diproses')
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 text-sm font-semibold">
                                    <i class="fas fa-cog"></i> Diproses
                                </span>
                            @elseif($transaksi->status_order == 'selesai')
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-sm font-semibold">
                                    <i class="fas fa-check"></i> Selesai
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-purple-100 text-purple-800 text-sm font-semibold">
                                    <i class="fas fa-check-double"></i> Diambil
                                </span>
                            @endif
                        </div>
                    </div>

                    @if ($transaksi->pembayaran == 'dp')
                        <div
                            class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Jumlah DP</p>
                            <p class="mt-1 text-lg font-bold text-amber-700">Rp
                                {{ number_format($transaksi->jumlah_dp, 0, ',', '.') }}</p>
                        </div>
                        <div
                            class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Sisa</p>
                            <p class="mt-1 text-lg font-bold text-red-600">Rp
                                {{ number_format($transaksi->total - $transaksi->jumlah_dp, 0, ',', '.') }}</p>
                        </div>
                    @endif

                    <!-- Total -->
                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</p>
                        <p class="mt-1 text-xl font-bold text-gray-800">Rp
                            {{ number_format($transaksi->total, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Layanan -->
            <div class="px-6 py-6 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2">
                    <i class="fas fa-list-ul text-indigo-600"></i>
                    Detail Layanan
                </h2>

                @if ($transaksi->details->isNotEmpty())
                    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Layanan</th>
                                    <th
                                        class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Harga Satuan</th>
                                    <th
                                        class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Berat</th>
                                    <th
                                        class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($transaksi->details as $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-5 py-4 font-medium text-gray-800">{{ $item->paket->nama_paket }}</td>
                                        <td class="px-5 py-4 text-gray-700">Rp
                                            {{ number_format($item->paket->harga, 0, ',', '.') }}</td>
                                        <td class="px-5 py-4 text-gray-700">{{ $item->berat }} {{ $item->paket->satuan }}
                                        </td>
                                        <td class="px-5 py-4 font-semibold text-gray-800">Rp
                                            {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Ringkasan Total -->
                    <div
                        class="mt-6 bg-linear-to-r from-gray-50 to-gray-100 rounded-xl p-5 border border-gray-200 max-w-md ml-auto">
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">Rp
                                    {{ number_format($transaksi->details->sum('subtotal'), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Diskon</span>
                                <span class="font-medium">Rp 0</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pajak</span>
                                <span class="font-medium">Rp 0</span>
                            </div>
                            <div
                                class="border-t border-gray-300 pt-3 mt-2 flex justify-between text-lg font-bold text-gray-800">
                                <span>Total Akhir</span>
                                <span>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-inbox text-3xl opacity-60 mb-2"></i>
                        <p>Tidak ada detail layanan.</p>
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="px-6 py-6 bg-gray-50">
                <div class="flex flex-wrap gap-3 items-center justify-end">
                    <!-- Status Order Dropdown -->
                    <form action="{{ route('transaksi.update-status', $transaksi->id) }}" method="POST"
                        class="inline-block">
                        @csrf @method('PUT')
                        <select name="status_order"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                            onchange="this.form.submit()"
                            {{ $transaksi->status_order == 'diambil' ? 'disabled' : '' }}>
                            <option value="baru" {{ $transaksi->status_order == 'baru' ? 'selected' : '' }}>Status: Baru
                            </option>
                            <option value="diproses" {{ $transaksi->status_order == 'diproses' ? 'selected' : '' }}>Status:
                                Diproses</option>
                            <option value="selesai" {{ $transaksi->status_order == 'selesai' ? 'selected' : '' }}>Status:
                                Selesai</option>
                            <option value="diambil" {{ $transaksi->status_order == 'diambil' ? 'selected' : '' }}>Status:
                                Diambil</option>
                        </select>
                    </form>

                    <!-- Pembayaran Dropdown -->
                    <form action="{{ route('transaksi.update-pembayaran', $transaksi->id) }}" method="POST"
                        class="inline-block">
                        @csrf @method('PUT')
                        <select name="pembayaran"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all"
                            onchange="this.form.submit()"
                            {{ $transaksi->pembayaran == 'lunas' ? 'disabled' : '' }}>
                            <option value="dp" {{ $transaksi->pembayaran == 'dp' ? 'selected' : '' }}>Pembayaran: DP
                            </option>
                            <option value="lunas" {{ $transaksi->pembayaran == 'lunas' ? 'selected' : '' }}>Pembayaran:
                                Lunas</option>
                        </select>
                    </form>

                    {{-- Button untuk preview --}}
                    <a href="{{ route('preview.invoice.pdf', $transaksi->id) }}" target="_blank"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-500 px-5 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-blue-600 transition-all hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <i class="fas fa-eye"></i> Preview Invoice
                    </a>

                    {{-- Button untuk download --}}
                    <a href="{{ route('export.invoice.pdf', $transaksi->id) }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-emerald-500 px-5 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-emerald-600 transition-all hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-400">
                        <i class="fas fa-download"></i> Download PDF
                    </a>

                    <!-- Delete Button -->
                    <form id="hapus-transaksi-{{ $transaksi->id }}"
                        action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="button"
                            onclick="konfirmasiHapusTransaksi({{ $transaksi->id }}, '{{ $transaksi->no_order }}')"
                            class="inline-flex items-center gap-2 rounded-lg bg-linear-to-r from-red-500 to-rose-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md hover:from-red-600 hover:to-rose-700 transition-all hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-400">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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
@endpush
