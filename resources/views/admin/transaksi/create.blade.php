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
                @if ($errors->any())
                    <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg">
                        <strong>Perbaiki kesalahan berikut:</strong>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf

                    <!-- Nomor Order & Nama Pelanggan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">No. Order</label>
                            <input type="text" name="no_order" value="{{ $lastOrderNumber }}"
                                class="w-full px-4 py-3 bg-gray-100 text-gray-800 font-medium rounded-lg border border-gray-300 cursor-not-allowed"
                                readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Pelanggan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <!-- Input Pencarian -->
                                <input type="text" x-model="searchQuery" @input.debounce.300ms="searchCustomers()"
                                    @keydown.down.prevent="highlight(1)" @keydown.up.prevent="highlight(-1)"
                                    @keydown.enter.prevent="selectHighlighted()"
                                    @blur="setTimeout(() => showDropdown = false, 150)"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                    placeholder="Cari atau tambah pelanggan (nama / no telp)" autocomplete="off">
                                <!-- Hidden ID -->
                                <input type="hidden" name="id_pelanggan" x-model="selectedId" required>

                                <!-- Dropdown Hasil -->
                                <div x-cloak x-show="showDropdown && customers.length > 0" x-transition
                                    class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                    <template x-for="(cust, index) in customers" :key="cust.id">
                                        <div @click="selectCustomer(cust)"
                                            :class="highlightedIndex === index ? 'bg-blue-50' : 'bg-white'"
                                            class="px-4 py-2 cursor-pointer hover:bg-blue-50 border-b border-gray-100 last:border-b-0">
                                            <div class="font-medium text-gray-800" x-text="cust.nama"></div>
                                            <div class="text-sm text-gray-500" x-text="cust.no_telp"></div>
                                        </div>
                                    </template>
                                </div>

                                <!-- Tombol Tambah di Samping -->
                                <button type="button" @click="openModal()"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-600 hover:text-blue-800"
                                    title="Tambah pelanggan baru">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Terima & Selesai -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Terima <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_terima" x-model="tanggalTerima"
                                @change="updateTanggalSelesai()" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Selesai <span class="text-slate-500">(opsional)</span>
                            </label>
                            <input type="date" name="tanggal_selesai" x-model="tanggalSelesai"
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
                                <option value="">- Pembayaran -</option>
                                <option value="dp" {{ old('pembayaran') == 'dp' ? 'selected' : '' }}>DP</option>
                                <option value="lunas" {{ old('pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
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
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paket
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Berat
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(item, index) in items" :key="index">
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-4 py-3 text-gray-700" x-text="index + 1"></td>
                                            <td class="px-4 py-3">
                                                <select :name="`items[${index}][paket_id]`" x-model="item.paketId"
                                                    @change="updateTanggalSelesai()"
                                                    class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                                    required>
                                                    <option value="">- Pilih Paket -</option>
                                                    @foreach ($pakets as $paket)
                                                        <option value="{{ $paket->id }}" data-harga="{{ $paket->harga }}"
                                                            data-waktu="{{ $paket->waktu ?? 2 }}">
                                                            {{ $paket->nama_paket }} - Rp
                                                            {{ number_format($paket->harga, 0, ',', '.') }} |
                                                            {{ $paket->satuan }} |
                                                            {{ $paket->waktu_pengerjaan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>~
                                            <td class="px-4 py-3">
                                                <input type="number" :name="`items[${index}][berat]`"
                                                    x-model.number="item.berat" step="0.1" min="0.1" required
                                                    class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                            </td>
                                            <td class="px-4 py-3 font-medium text-gray-800"
                                                x-text="formatRupiah(getSubtotal(item))"></td>
                                            <td class="px-4 py-3">
                                                <button type="button" @click="removeItem(index)"
                                                    class="text-red-600 hover:text-red-800 p-1.5 rounded hover:bg-red-50"
                                                    :disabled="items.length === 1">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <button type="button" @click="addItem()"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition">
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
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                                    min="0">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Total Akhir</label>
                                <input type="hidden" name="total" :value="totalAkhir">
                                <input type="text" :value="formatRupiah(totalAkhir)"
                                    class="w-full px-4 py-3 bg-gray-100 font-bold text-lg text-gray-800 rounded-lg border border-gray-300 cursor-not-allowed"
                                    readonly>
                            </div>
                        </div>

                        <!-- Jumlah DP (conditional) -->
                        <div x-show="pembayaran === 'dp'" x-cloak class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah DP (Rp)</label>
                            <input type="number" name="jumlah_dp" x-model.number="jumlahDp" :max="totalAkhir"
                                min="0"
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

                <!-- Modal Tambah Pelanggan -->
                <div x-cloak x-show="modalOpen" x-transition.opacity
                    class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
                    <div x-show="modalOpen" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        class="bg-linear-to-br from-white to-gray-50 rounded-2xl shadow-2xl w-full max-w-md p-6 border border-gray-200">
                        <!-- Header -->
                        <div class="flex items-center justify-between mb-5">
                            <h3
                                class="text-xl font-extrabold bg-linear-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                Tambah Pelanggan Baru
                            </h3>
                            <button @click="closeModal()"
                                class="text-gray-400 hover:text-red-500 transition transform hover:scale-110">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>

                        <!-- Form -->
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" x-model="newCustomer.nama" placeholder="Misal: Andi Prasetyo"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor WhatsApp</label>
                                <input type="text" x-model="newCustomer.no_telp" placeholder="0812 3456 7890"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition shadow-sm">
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3 justify-end mt-6">
                            <button type="button" @click="closeModal()"
                                class="px-5 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl font-semibold transition shadow hover:shadow-md">
                                Batal
                            </button>
                            <button type="button" @click="addNewCustomer()"
                                :disabled="!newCustomer.nama || !newCustomer.no_telp"
                                class="px-5 py-2.5 bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-semibold transition shadow-lg hover:shadow-indigo-300 disabled:opacity-50 disabled:cursor-not-allowed">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function transactionForm() {
            return {
                // --- State transaksi ---
                pembayaran: '',
                diskon: 0,
                jumlahDp: 0,
                tanggalTerima: '{{ date('Y-m-d') }}',

                items: [{
                    paketId: '',
                    berat: 1
                }],

                // --- State pelanggan (dari customerSearch) ---
                searchQuery: '',
                customers: [],
                selectedId: null,
                showDropdown: false,
                highlightedIndex: -1,
                modalOpen: false,
                newCustomer: {
                    nama: '',
                    no_telp: ''
                },

                // --- Fungsi transaksi ---
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
                },

                // --- Fungsi pelanggan ---
                searchCustomers() {
                    if (!this.searchQuery.trim()) {
                        this.customers = [];
                        this.showDropdown = false;
                        return;
                    }
                    fetch(`{{ route('pelanggan.cari') }}?q=${encodeURIComponent(this.searchQuery)}`)
                        .then(res => res.json())
                        .then(data => {
                            this.customers = data;
                            this.showDropdown = data.length > 0;
                            this.highlightedIndex = -1;
                        });
                },
                selectCustomer(customer) {
                    this.searchQuery = customer.nama;
                    this.selectedId = customer.id;
                    this.showDropdown = false;
                    this.highlightedIndex = -1;
                },
                selectHighlighted() {
                    if (this.highlightedIndex >= 0 && this.customers[this.highlightedIndex]) {
                        this.selectCustomer(this.customers[this.highlightedIndex]);
                    }
                },
                highlight(direction) {
                    if (this.customers.length === 0) return;
                    this.highlightedIndex += direction;
                    if (this.highlightedIndex < 0) this.highlightedIndex = this.customers.length - 1;
                    if (this.highlightedIndex >= this.customers.length) this.highlightedIndex = 0;
                    this.showDropdown = true;
                },
                openModal() {
                    this.modalOpen = true;
                    this.newCustomer = {
                        nama: '',
                        no_telp: ''
                    };
                },
                closeModal() {
                    this.modalOpen = false;
                },
                addNewCustomer() {
                    fetch('{{ route('pelanggan.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.newCustomer)
                        })
                        .then(res => res.json())
                        .then(customer => {
                            this.selectCustomer(customer);
                            this.closeModal();
                        })
                        .catch(err => {
                            alert('Gagal menambah pelanggan. Nomor mungkin sudah terdaftar.');
                        });
                }
            };
        }
    </script>
@endsection
