@extends('layouts.main')

@section('title', 'Laporan - RumahLaundry')
@section('page-title', 'Laporan')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Page Header -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 px-6 py-5 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="fas fa-chart-line text-blue-600"></i>
                        Laporan Transaksi Laundry
                    </h1>
                    <p class="text-gray-600 mt-1">Ringkasan kinerja dan analisis data transaksi</p>
                </div>
                <div class="text-gray-500 text-sm bg-gray-50 px-3 py-2 rounded-lg">
                    <i class="far fa-calendar mr-1"></i> Periode: {{ $periode }}
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white p-5 rounded-2xl shadow border border-gray-100 mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-filter text-blue-500"></i> Filter Laporan
            </h3>
            <form method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Pilih Periode -->
                    <div>
                        <label class="text-sm font-medium text-gray-600">Jenis Periode</label>
                        <select name="filter" id="filter-select"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="harian" {{ $filter == 'harian' ? 'selected' : '' }}>Harian</option>
                            <option value="mingguan" {{ $filter == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                            <option value="bulanan" {{ $filter == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                            <option value="tahunan" {{ $filter == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        </select>
                    </div>

                    <!-- Tahun (Muncul untuk Bulanan dan Tahunan) -->
                    <div id="tahun-field" class="{{ in_array($filter, ['bulanan', 'tahunan']) ? '' : 'hidden' }}">
                        <label class="text-sm font-medium text-gray-600">Tahun</label>
                        <select name="tahun" class="w-full mt-1 rounded-lg border-gray-300">
                            @for ($y = now()->year; $y >= 2020; $y--)
                                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Bulan (Hanya muncul untuk Bulanan) -->
                    <div id="bulan-field" class="{{ $filter == 'bulanan' ? '' : 'hidden' }}">
                        <label class="text-sm font-medium text-gray-600">Bulan</label>
                        <select name="bulan" class="w-full mt-1 rounded-lg border-gray-300">
                            @foreach (range(1, 12) as $m)
                                @php
                                    $carbonMonth = \Carbon\Carbon::create()->month($m);
                                @endphp
                                <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                                    {{ $carbonMonth->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Awal (Untuk Harian dan Mingguan) -->
                    <div id="tanggal-field" class="{{ in_array($filter, ['harian', 'mingguan']) ? '' : 'hidden' }}">
                        <label class="text-sm font-medium text-gray-600">
                            @if ($filter == 'harian')
                                Pilih Tanggal
                            @else
                                Pilih Minggu (Tanggal Awal)
                            @endif
                        </label>
                        <input type="date" name="tanggal_awal"
                            value="{{ request('tanggal_awal', now()->format('Y-m-d')) }}"
                            class="w-full mt-1 rounded-lg border-gray-300">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-xl hover:from-blue-700 hover:to-cyan-700 font-medium shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                        <i class="fas fa-search"></i> Tampilkan Laporan
                    </button>
                </div>
            </form>
        </div>

        <!-- Informasi Filter Aktif -->
        <div class="mb-6">
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <i class="fas fa-info-circle text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-blue-800">
                            <span class="font-semibold">Filter aktif:</span>
                            {{ $filter == 'tahunan' ? 'Tahunan' : ($filter == 'bulanan' ? 'Bulanan' : ($filter == 'mingguan' ? 'Mingguan' : 'Harian')) }}
                            • {{ $periode }}
                        </p>
                        <p class="text-xs text-blue-600 mt-1">
                            Rentang: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} -
                            {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            <!-- Total Transaksi -->
            <div
                class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                <div class="p-5">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-semibold text-gray-600 flex items-center gap-1">
                                <i class="fas fa-exchange-alt"></i> Total Transaksi
                            </p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">
                                {{ number_format($totalTransactions, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-xl text-blue-600">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pendapatan -->
            <div
                class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="h-1 bg-gradient-to-r from-emerald-500 to-teal-600"></div>
                <div class="p-5">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-semibold text-gray-600 flex items-center gap-1">
                                <i class="fas fa-money-bill-wave"></i> Total Pendapatan
                            </p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">Rp
                                {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-3 bg-emerald-100 rounded-xl text-emerald-600">
                            <i class="fas fa-coins fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rata-rata per Transaksi -->
            <div
                class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="h-1 bg-gradient-to-r from-sky-500 to-cyan-600"></div>
                <div class="p-5">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-semibold text-gray-600 flex items-center gap-1">
                                <i class="fas fa-calculator"></i> Rata-rata/Transaksi
                            </p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">Rp {{ number_format($rataRata, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-3 bg-sky-100 rounded-xl text-sky-600">
                            <i class="fas fa-percentage fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pelanggan Aktif -->
            <div
                class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="h-1 bg-gradient-to-r from-amber-500 to-orange-600"></div>
                <div class="p-5">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-semibold text-gray-600 flex items-center gap-1">
                                <i class="fas fa-users"></i> Pelanggan Aktif
                            </p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $pelangganAktif }}</p>
                        </div>
                        <div class="p-3 bg-amber-100 rounded-xl text-amber-600">
                            <i class="fas fa-user-friends fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analisis Tambahan -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Transaksi per Tanggal -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-5 py-4 text-white">
                    <h3 class="font-bold text-lg flex items-center gap-2">
                        <i class="fas fa-calendar-day"></i> Transaksi per Tanggal
                    </h3>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse ($transaksiPerTanggal->take(5) as $tanggal => $data)
                        <div class="px-5 py-4 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-start">
                                <span class="font-medium text-gray-800">
                                    {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d, D F Y') }}
                                </span>
                                <div class="text-right">
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-sm font-medium">
                                        <i class="fas fa-receipt"></i> {{ $data['jumlah'] }} transaksi
                                    </span>
                                    <div class="text-sm text-gray-600 mt-1">Rp
                                        {{ number_format($data['total'], 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-5 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-2xl opacity-60 mb-2"></i>
                            <p>Tidak ada data transaksi</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Status Pembayaran -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-600 to-teal-700 px-5 py-4 text-white">
                    <h3 class="font-bold text-lg flex items-center gap-2">
                        <i class="fas fa-credit-card"></i> Status Pembayaran
                    </h3>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse ($statusPembayaran as $status => $jumlah)
                        <div class="px-5 py-4 hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-medium text-gray-800">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium
                            {{ $status == 'lunas' ? 'bg-emerald-100 text-emerald-800' : ($status == 'belum_lunas' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800') }}">
                                <i
                                    class="fas fa-{{ $status == 'lunas' ? 'check-circle' : ($status == 'belum_lunas' ? 'times-circle' : 'money-bill-wave') }}"></i>
                                {{ $jumlah }} transaksi
                            </span>
                        </div>
                    @empty
                        <div class="px-5 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-2xl opacity-60 mb-2"></i>
                            <p>Tidak ada data status</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Detail Transaksi -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-5 py-4 text-white">
                <div>
                    <h3 class="font-bold text-lg flex items-center gap-2">
                        <i class="fas fa-clipboard-list"></i> Detail Transaksi
                    </h3>
                    <p class="text-gray-300 text-sm mt-1">Daftar semua transaksi laundry</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                @if ($transactions->isNotEmpty())
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Order</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pelanggan
                                </th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Terima
                                </th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Selesai
                                </th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pembayaran</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($transactions as $transaction)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        {{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-5 py-4 font-mono font-medium text-gray-800">{{ $transaction->no_order }}
                                    </td>
                                    <td class="px-5 py-4 text-gray-700">{{ $transaction->pelanggan->nama ?? '-' }}</td>
                                    <td class="px-5 py-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($transaction->tanggal_terima)->isoFormat('D MMM YYYY') }}
                                    </td>
                                    <td class="px-5 py-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($transaction->tanggal_selesai)->isoFormat('D MMM YYYY') }}
                                    </td>
                                    <td class="px-5 py-4">
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded text-xs font-medium
                                        {{ $transaction->pembayaran == 'lunas' ? 'bg-emerald-100 text-emerald-800' : ($transaction->pembayaran == 'belum_lunas' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800') }}">
                                            <i
                                                class="fas fa-{{ $transaction->pembayaran == 'lunas' ? 'check-circle' : ($transaction->pembayaran == 'belum_lunas' ? 'times-circle' : 'money-bill-wave') }}"></i>
                                            {{ ucfirst(str_replace('_', ' ', $transaction->pembayaran)) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded bg-blue-100 text-blue-800 text-xs font-medium">
                                            {{ ucfirst(str_replace('_', ' ', $transaction->status_order)) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 font-bold text-gray-800">Rp
                                        {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <!-- Total Row -->
                            <tr class="bg-blue-50 font-bold">
                                <td colspan="6" class="px-5 py-4 text-right text-gray-800">TOTAL PENDAPATAN:</td>
                                <td colspan="2" class="px-5 py-4 text-gray-800">Rp
                                    {{ number_format($totalPendapatanHalaman, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    @if ($transactions->hasPages())
                        <div class="border-t border-slate-200/30 px-6 py-4 bg-slate-50/50">
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                                <p class="text-sm text-slate-600 text-center sm:text-left">
                                    Menampilkan <span
                                        class="font-bold text-slate-800">{{ $transactions->firstItem() }}</span>–
                                    <span class="font-bold text-slate-800">{{ $transactions->lastItem() }}</span> dari
                                    <span class="font-bold text-slate-800">{{ $transactions->total() }}</span> hasil
                                </p>
                                <div class="flex gap-2">
                                    @if ($transactions->onFirstPage())
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-lg text-sm bg-slate-100 text-slate-400 cursor-not-allowed font-medium">
                                            <i class="fa-solid fa-chevron-left mr-1 text-xs"></i> Sebelumnya
                                        </span>
                                    @else
                                        <a href="{{ $transactions->previousPageUrl() }}"
                                            class="inline-flex items-center px-4 py-2 rounded-lg text-sm bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-medium shadow-sm hover:shadow transition-colors">
                                            <i class="fa-solid fa-chevron-left mr-1 text-xs"></i> Sebelumnya
                                        </a>
                                    @endif

                                    @if ($transactions->hasMorePages())
                                        <a href="{{ $transactions->nextPageUrl() }}"
                                            class="inline-flex items-center px-4 py-2 rounded-lg text-sm bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-medium shadow-md hover:shadow-lg hover:from-blue-700 hover:to-cyan-700 transition-all">
                                            Selanjutnya <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                                        </a>
                                    @else
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-lg text-sm bg-slate-100 text-slate-400 cursor-not-allowed font-medium">
                                            Selanjutnya <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="px-5 py-12 text-center text-gray-500">
                        <i class="fas fa-info-circle text-3xl text-blue-500 mb-3"></i>
                        <h6 class="font-semibold text-lg text-gray-700">Tidak Ada Data</h6>
                        <p>Belum ada transaksi yang dicatat untuk periode ini.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Top 7 Pelanggan Berdasarkan Transaksi -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-purple-600 to-fuchsia-700 px-5 py-4 text-white">
                <h3 class="font-bold text-lg flex items-center gap-2">
                    <i class="fas fa-crown"></i> 7 Pelanggan Teraktif
                </h3>
                <p class="text-gray-200 text-sm mt-1">Berdasarkan jumlah transaksi</p>
            </div>
            <div class="overflow-x-auto">
                @if ($topCustomers->isNotEmpty())
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pelanggan
                                </th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah
                                    Transaksi</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Transaksi
                                    (Rp)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($topCustomers as $index => $customer)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-4">
                                        <span
                                            class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-purple-100 text-purple-700 font-bold text-sm">
                                            {{ $index + 1 }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 font-medium text-gray-800">{{ $customer['nama'] }}</td>
                                    <td class="px-5 py-4 text-gray-700">{{ $customer['jumlah'] }}</td>
                                    <td class="px-5 py-4 font-semibold text-gray-800">Rp
                                        {{ number_format($customer['total'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="px-5 py-10 text-center text-gray-500">
                        <i class="fas fa-user-slash text-2xl opacity-60 mb-2"></i>
                        <p>Belum ada pelanggan dengan transaksi</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tombol Export -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 text-center">
            <h3 class="text-gray-600 font-medium mb-4 flex items-center justify-center gap-2">
                <i class="fas fa-download"></i> Ekspor Laporan
            </h3>
            <a href="{{ route('admin.laporan.export.pdf', request()->query()) }}"
                class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-xl">
                <i class="fas fa-file-pdf"></i> PDF
            </a>

            {{-- <a href="{{ route('admin.laporan.export.excel') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-emerald-500 to-green-600 text-white font-medium rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                    <i class="fas fa-file-excel"></i> Excel
                </a> --}}
            <a href="javascript:window.print()"
                class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                <i class="fas fa-print"></i> Cetak
            </a>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterSelect = document.getElementById('filter-select');
            const tahunField = document.getElementById('tahun-field');
            const bulanField = document.getElementById('bulan-field');
            const tanggalField = document.getElementById('tanggal-field');

            function toggleFields() {
                const value = filterSelect.value;

                // Reset semua field
                tahunField.classList.add('hidden');
                bulanField.classList.add('hidden');
                tanggalField.classList.add('hidden');

                // Tampilkan field sesuai dengan pilihan
                if (value === 'tahunan') {
                    tahunField.classList.remove('hidden');
                } else if (value === 'bulanan') {
                    tahunField.classList.remove('hidden');
                    bulanField.classList.remove('hidden');
                } else if (value === 'mingguan' || value === 'harian') {
                    tanggalField.classList.remove('hidden');

                    // Update label tanggal
                    const label = tanggalField.querySelector('label');
                    if (value === 'harian') {
                        label.textContent = 'Pilih Tanggal';
                    } else {
                        label.textContent = 'Pilih Minggu (Tanggal Awal)';
                    }
                }
            }

            if (filterSelect) {
                filterSelect.addEventListener('change', toggleFields);
                toggleFields(); // Initial call
            }
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2500,
                    showConfirmButton: false
                });
            });
        </script>
    @endif
@endpush
