@extends('layouts.main')

@section('title', 'Detail Transaksi - ' . $transaksi->no_order)

@section('content')
    <div class="min-h-screen pb-12 bg-gray-50/50" x-data="{ loading: false }">
        <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4 px-1">
            <div>
                <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm font-medium text-gray-500">
                        <li class="inline-flex items-center"><a href="#" class="hover:text-indigo-600">Dashboard</a></li>
                        <li><i class="fas fa-chevron-right text-[10px] mx-1"></i></li>
                        <li class="text-indigo-600 font-semibold">Detail Transaksi</li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Invoice <span class="text-indigo-600">#{{ $transaksi->no_order }}</span></h1>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('transaksi.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-xl font-semibold shadow-sm hover:bg-gray-50 transition-all active:scale-95">
                    <i class="fas fa-arrow-left text-xs"></i> Kembali
                </a>
                <button @click="window.print()" class="p-2.5 bg-white border border-gray-200 text-gray-600 rounded-xl hover:text-indigo-600 shadow-sm transition-all">
                    <i class="fas fa-print"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    @php
                        $statuses = ['baru', 'diproses', 'selesai', 'diambil'];
                        $currentIdx = array_search($transaksi->status_order, $statuses);
                        $isKadaluarsa = $transaksi->status_order === 'kadaluarsa';
                    @endphp

                    <div class="relative flex justify-between">
                        <div class="absolute top-5 left-0 w-full h-1 bg-gray-100 z-0"></div>
                        @if (!$isKadaluarsa)
                            <div class="absolute top-5 left-0 h-1 bg-indigo-500 transition-all duration-500 z-0" style="width: {{ ($currentIdx / 3) * 100 }}%"></div>
                        @endif

                        @foreach ($statuses as $index => $status)
                            <div class="relative z-10 flex flex-col items-center">
                                <div
                                    class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 {{ $index <= $currentIdx && !$isKadaluarsa ? 'bg-indigo-600 text-white ring-4 ring-indigo-100' : 'bg-white border-2 border-gray-200 text-gray-400' }}">
                                    <i
                                        class="fas {{ $index < $currentIdx ? 'fa-check' : ($status == 'baru' ? 'fa-plus' : ($status == 'diproses' ? 'fa-spinner fa-spin' : ($status == 'selesai' ? 'fa-flag-checkered' : 'fa-hand-holding-heart'))) }} text-sm"></i>
                                </div>
                                <span class="mt-2 text-xs font-bold uppercase tracking-tighter {{ $index <= $currentIdx && !$isKadaluarsa ? 'text-indigo-600' : 'text-gray-400' }}">
                                    {{ $status }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center bg-linear-to-r from-white to-indigo-50/30">
                        <h3 class="font-bold text-gray-800 flex items-center gap-3">
                            <span class="p-2 bg-indigo-600 rounded-lg text-white"><i class="fas fa-concierge-bell"></i></span>
                            Rincian Pesanan
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50">
                                    <th class="px-8 py-4 text-xs font-bold uppercase text-gray-500 tracking-widest">Item Layanan</th>
                                    <th class="px-8 py-4 text-xs font-bold uppercase text-gray-500 tracking-widest text-center">Qty / Berat</th>
                                    <th class="px-8 py-4 text-xs font-bold uppercase text-gray-500 tracking-widest text-right">Harga</th>
                                    <th class="px-8 py-4 text-xs font-bold uppercase text-gray-500 tracking-widest text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach ($transaksi->details as $item)
                                    <tr class="group hover:bg-indigo-50/30 transition-colors">
                                        <td class="px-8 py-5">
                                            <p class="font-bold text-gray-800 group-hover:text-indigo-600 transition-colors">{{ $item->paket->nama_paket }}</p>
                                            <p class="text-xs text-gray-400 font-medium">Kategori: {{ $item->paket->satuan }}</p>
                                        </td>
                                        <td class="px-8 py-5 text-center font-semibold text-gray-700">
                                            {{ $item->berat }} <span class="text-xs text-gray-400">{{ $item->paket->satuan }}</span>
                                        </td>
                                        <td class="px-8 py-5 text-right text-gray-600">
                                            Rp {{ number_format($item->paket->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-8 py-5 text-right font-bold text-gray-900">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-8 bg-gray-50/50 border-t border-gray-100">
                        <div class="flex flex-col gap-3 max-w-xs ml-auto">
                            <div class="flex justify-between text-gray-500 font-medium">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($transaksi->details->sum('subtotal'), 0, ',', '.') }}</span>
                            </div>
                            @if ($transaksi->jatuh_tempo_at)
                                @php
                                    $hari_terlambat = max(
                                        0,
                                        \Carbon\Carbon::parse($transaksi->jatuh_tempo_at)
                                            ->startOfDay()
                                            ->diffInDays(now()->startOfDay(), false),
                                    );
                                    $total_denda = $hari_terlambat >= 4 ? 35000 : $hari_terlambat * 5000;
                                @endphp
                                <div class="flex justify-between text-rose-500 font-medium italic">
                                    <span>Denda Terlambat ({{ $hari_terlambat }} hari)</span>
                                    <span>+ Rp {{ number_format($total_denda, 0, ',', '.') }}</span>
                                </div>
                            @endif
                            <div class="pt-3 border-t border-gray-200 flex justify-between items-center text-xl font-black text-indigo-600">
                                <span>Total</span>
                                <span>Rp {{ number_format($transaksi->total + ($total_denda ?? 0), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-linear-to-br from-indigo-600 to-violet-700 rounded-3xl shadow-xl p-8 text-white relative overflow-hidden group">
                    <i class="fas fa-circle-nodes absolute -right-10 -top-10 text-9xl text-white/10 group-hover:rotate-45 transition-transform duration-700"></i>

                    <h3 class="text-indigo-100 text-xs font-bold uppercase tracking-widest mb-6 flex items-center gap-2">
                        <i class="fas fa-user-circle"></i> Informasi Pelanggan
                    </h3>
                    <div class="space-y-4 relative z-10">
                        <div>
                            <p class="text-2xl font-black">{{ $transaksi->pelanggan->nama ?? '-' }}</p>
                            <p class="text-indigo-200 text-sm italic">{{ $transaksi->pelanggan->no_telp ?? 'No. Telp Tidak Ada' }}</p>
                        </div>
                        <div class="pt-4 border-t border-white/20 grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-[10px] uppercase font-bold text-indigo-200">Terima</p>
                                <p class="text-sm font-semibold">{{ \Carbon\Carbon::parse($transaksi->tanggal_terima)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase font-bold text-indigo-200">Selesai</p>
                                <p class="text-sm font-semibold">{{ $transaksi->tanggal_selesai ? \Carbon\Carbon::parse($transaksi->tanggal_selesai)->format('d M Y') : '---' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Update Status Order</label>
                        <form action="{{ route('transaksi.update-status', $transaksi->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="relative">
                                <select name="status_order" onchange="this.form.submit()"
                                    class="w-full pl-4 pr-10 py-3 bg-gray-50 border-none rounded-xl font-bold text-gray-700 appearance-none focus:ring-2 focus:ring-indigo-500 transition-all cursor-pointer {{ $transaksi->status_order == 'diambil' ? 'opacity-50' : '' }}"
                                    {{ $transaksi->status_order == 'diambil' ? 'disabled' : '' }}>
                                    <option value="baru" {{ $transaksi->status_order == 'baru' ? 'selected' : '' }}>🆕 Pesanan Baru</option>
                                    <option value="diproses" {{ $transaksi->status_order == 'diproses' ? 'selected' : '' }}>⚙️ Sedang Diproses</option>
                                    <option value="selesai" {{ $transaksi->status_order == 'selesai' ? 'selected' : '' }}>✅ Sudah Selesai</option>
                                    <option value="diambil" {{ $transaksi->status_order == 'diambil' ? 'selected' : '' }}>📦 Sudah Diambil</option>
                                    <option disabled value="kadaluarsa" {{ $transaksi->status_order == 'kadaluarsa' ? 'selected' : '' }}>⚠️ Kadaluarsa</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Status Pembayaran</label>
                        <form action="{{ route('transaksi.update-pembayaran', $transaksi->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="grid grid-cols-2 gap-2 bg-gray-50 p-1.5 rounded-2xl">
                                <button name="pembayaran" value="dp"
                                    class="py-2.5 rounded-xl text-sm font-bold transition-all {{ $transaksi->pembayaran == 'dp' ? 'bg-white text-amber-600 shadow-sm' : 'text-gray-400 hover:text-gray-600' }}">
                                    DP
                                </button>
                                <button name="pembayaran" value="lunas"
                                    class="py-2.5 rounded-xl text-sm font-bold transition-all {{ $transaksi->pembayaran == 'lunas' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-400 hover:text-gray-600' }}">
                                    Lunas
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="pt-4 space-y-3">
                        <a href="{{ route('preview.invoice.pdf', $transaksi->id) }}" target="_blank"
                            class="flex items-center justify-center gap-2 w-full py-3 bg-blue-50 text-blue-600 rounded-xl font-bold hover:bg-blue-100 transition-all">
                            <i class="fas fa-eye"></i> Preview Invoice
                        </a>
                        <a href="{{ route('export.invoice.pdf', $transaksi->id) }}"
                            class="flex items-center justify-center gap-2 w-full py-3 bg-emerald-50 text-emerald-600 rounded-xl font-bold hover:bg-emerald-100 transition-all">
                            <i class="fas fa-cloud-download-alt"></i> Download PDF
                        </a>

                        <button type="button" onclick="konfirmasiHapusTransaksi({{ $transaksi->id }}, '{{ $transaksi->no_order }}')"
                            class="flex items-center justify-center gap-2 w-full py-3 text-rose-500 font-bold hover:bg-rose-50 rounded-xl transition-all">
                            <i class="fas fa-trash-alt"></i> Hapus Transaksi
                        </button>
                        <form id="hapus-transaksi-{{ $transaksi->id }}" action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="hidden">
                            @csrf @method('DELETE')
                        </form>
                    </div>
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
