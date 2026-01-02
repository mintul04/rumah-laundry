@extends('layouts.main')

@section('title', 'Tambah Transaksi Laundry - RumahLaundry')
@section('page-title', 'Tambah Transaksi Laundry Baru')

@section('content')
    <div x-data="transactionForm()" class="mx-auto px-4 py-3">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <!-- Header -->
            <div class="bg-linear-to-r from-blue-600 to-indigo-700 px-6 py-6">
                <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-receipt"></i>
                    Tambah Transaksi Laundry Baru
                </h1>
            </div>

            <div class="p-6">
                <!-- Info Box -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg mb-8 text-blue-800">
                    <div class="flex items-start gap-2">
                        <i class="fas fa-info-circle mt-0.5 text-blue-600"></i>
                        <span>Isi data transaksi dengan lengkap. Nomor order akan digenerate otomatis.</span>
                    </div>
                </div>

                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf

                    <!-- Nomor Order & Nama Pelanggan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">No. Order</label>
                            <input type="text" name="no_order" value="{{ $lastOrderNumber }}"
                                class="w-full px-4 py-3 bg-gray-100 text-gray-800 font-medium rounded-lg border border-gray-300 cursor-not-allowed" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Pelanggan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_pelanggan" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                placeholder="Masukkan nama pelanggan">
                        </div>
                    </div>

                    <!-- Tanggal Terima & Selesai -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Terima <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_terima" required value="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Selesai <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_selesai" required value="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        </div>
                    </div>

                    <!-- Status Pembayaran -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Status Pembayaran <span class="text-red-500">*</span>
                            </label>
                            <select name="pembayaran" x-model="pembayaran" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition appearance-none bg-[url('data:image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3e%3cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27/%3e%3c/svg%3e')] bg-no-repeat bg-position-[1.25em_1.25em] pr-10">
                                <option value="">-- Pilih Status Pembayaran --</option>
                                <option value="dp">DP</option>
                                <option value="lunas">Lunas</option>
                            </select>
                        </div>
                    </div>

                    <!-- Detail Pesanan -->
                    <div class="mb-8">
                        <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-list text-indigo-600"></i>
                            Detail Pesanan
                        </h2>

                        <div class="overflow-x-auto rounded-lg border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paket</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Berat</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(item, index) in items" :key="index">
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-4 py-3 text-gray-700" x-text="index + 1"></td>
                                            <td class="px-4 py-3">
                                                <select :name="`items[${index}][paket_id]`" x-model="item.paketId"
                                                    class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none" required>
                                                    <option value="">-- Pilih Paket --</option>
                                                    @foreach ($pakets as $paket)
                                                        <option value="{{ $paket->id }}" data-harga="{{ $paket->harga }}">
                                                            {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }} / {{ $paket->satuan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="px-4 py-3">
                                                <input type="number" :name="`items[${index}][berat]`" x-model.number="item.berat" step="0.1" min="0.1" required
                                                    class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                            </td>
                                            <td class="px-4 py-3 font-medium text-gray-800" x-text="formatRupiah(getSubtotal(item))"></td>
                                            <td class="px-4 py-3">
                                                <button type="button" @click="removeItem(index)" class="text-red-600 hover:text-red-800 p-1.5 rounded hover:bg-red-50" :disabled="items.length === 1">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <button type="button" @click="addItem()" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition">
                                <i class="fas fa-plus"></i> Tambah Item
                            </button>
                        </div>
                    </div>

                    <!-- Total & Pembayaran -->
                    <div class="mb-8">
                        <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-calculator text-emerald-600"></i>
                            Total & Pembayaran
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Diskon (Rp)</label>
                                <input type="number" name="diskon" x-model.number="diskon"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition" min="0">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Total Akhir</label>
                                <input type="hidden" name="total" :value="totalAkhir">
                                <input type="text" :value="formatRupiah(totalAkhir)"
                                    class="w-full px-4 py-3 bg-gray-100 font-bold text-lg text-gray-800 rounded-lg border border-gray-300 cursor-not-allowed" readonly>
                            </div>
                        </div>

                        <!-- Jumlah DP (conditional) -->
                        <div x-show="pembayaran === 'dp'" x-cloak class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah DP (Rp)</label>
                            <input type="number" name="jumlah_dp" x-model.number="jumlahDp" :max="totalAkhir" min="0"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                            <p class="mt-1 text-sm text-amber-700 font-medium" x-show="totalAkhir > 0">
                                Sisa pembayaran: <span x-text="formatRupiah(totalAkhir - jumlahDp)"></span>
                            </p>
                        </div>
                    </div>

                    <!-- Hidden Status Order -->
                    <input type="hidden" name="status_order" value="baru">

                    <!-- Actions -->
                    <div class="flex flex-wrap gap-3 justify-end pt-6 border-t border-gray-200">
                        <a href="{{ route('transaksi.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 font-medium transition">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-linear-to-r from-blue-600 to-indigo-700 text-white font-medium rounded-lg shadow-md hover:from-blue-700 hover:to-indigo-800 transition shadow-blue-200">
                            <i class="fas fa-save"></i> Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function transactionForm() {
            return {
                pembayaran: '',
                diskon: 0,
                jumlahDp: 0,
                items: [{
                    paketId: '',
                    berat: 1
                }],

                addItem() {
                    this.items.push({
                        paketId: '',
                        berat: 1
                    });
                },

                removeItem(index) {
                    if (this.items.length > 1) {
                        this.items.splice(index, 1);
                    }
                },

                getSubtotal(item) {
                    if (!item.paketId || !item.berat) return 0;
                    const option = document.querySelector(`option[value="${item.paketId}"]`);
                    if (!option) return 0;
                    const harga = parseFloat(option.dataset.harga);
                    return harga * parseFloat(item.berat);
                },

                get totalAkhir() {
                    const subtotal = this.items.reduce((sum, item) => sum + this.getSubtotal(item), 0);
                    return Math.max(0, subtotal - (this.diskon || 0));
                },

                formatRupiah(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(value);
                }
            };
        }
    </script>
@endsection
