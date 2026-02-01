@extends('layouts.main')

@section('title', 'Dashboard - RumahLaundry')
@section('page-title', 'Beranda')

@section('content')
    <div x-data="dashboard()" class="space-y-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5" x-ref="stats">
            <!-- Total Paket -->
            <div class="rounded-2xl p-5 shadow-sm hover:shadow-md transition bg-linear-to-br from-blue-700 to-blue-400">
                <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-blue-50 text-blue-600">
                    <i class="fas fa-layer-group text-xl"></i>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-white">TOTAL PAKET</p>
                    <p class="text-2xl font-extrabold text-white mt-1">{{ $totalPaket ?? 0 }}</p>
                </div>
            </div>

            <!-- Total Pelanggan -->
            <div
                class="rounded-2xl p-5 shadow-sm hover:shadow-md transition bg-linear-to-br  from-emerald-400 to-emerald-500">
                <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-green-50 text-green-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-white">TOTAL PELANGGAN</p>
                    <p class="text-2xl font-extrabold text-white mt-1">{{ $totalPelanggan ?? 0 }}</p>
                </div>
            </div>

            <!-- Total Pesanan -->
            <div class="rounded-2xl p-5 shadow-sm hover:shadow-md transition bg-linear-to-br from-yellow-400 to-yellow-500">
                <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-yellow-50 text-yellow-600">
                    <i class="fas fa-shopping-cart text-xl"></i>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-white">TOTAL PESANAN</p>
                    <p class="text-2xl font-extrabold text-white mt-1">{{ $totalPesanan ?? 0 }}</p>
                </div>
            </div>

            <!-- Pendapatan -->
            <div class="rounded-2xl p-5 shadow-sm hover:shadow-md transition bg-linear-to-br from-cyan-700 to-cyan-400">
                <div class="flex items-center justify-center w-14 h-14 rounded-xl bg-cyan-50 text-cyan-600">
                    <i class="fas fa-rupiah-sign text-xl"></i>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-white">PENDAPATAN BULAN INI</p>
                    <p class="text-2xl font-extrabold text-white mt-1">{{ $pendapatanFormatted ?? '0' }}</p>
                </div>
            </div>
        </div>

        <!-- Address & Welcome -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5" x-ref="header">
            <!-- Address -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[linear-gradient(135deg,#4f6ae4_0%,#6a5af9_100%)]"></div>
                <h3 class="text-xl font-extrabold text-blue-600 mb-1">RumahLaundry</h3>
                <p class="text-gray-600 flex items-start gap-1">
                    <i class="fas fa-map-marker-alt mt-0.5 text-blue-600"></i>
                    Jalan Mawar No.123, Kec. Kutorejo, Kab. Mojokerto, Jawa Timur 55225
                </p>
            </div>

            <!-- Welcome -->
            <div
                class="bg-[linear-gradient(135deg,#4f6ae4_0%,#6a5af9_100%)] rounded-xl shadow-md p-6 text-white relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
                <h2 class="text-lg md:text-xl font-extrabold relative z-10">
                    Selamat Datang,
                    @if (auth()->user()->role == 'admin')
                        Administrator <i class="fas fa-star ms-1"></i>
                    @else
                        Karyawan <i class="fas fa-star ms-1"></i>
                    @endif
                </h2>
                <p class="mt-2 text-white/90 relative z-10">
                    Anda login sebagai
                    @if (auth()->user()->role == 'admin')
                        Admin
                    @else
                        Karyawan
                    @endif RumahLaundry
                </p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5" x-ref="charts">
            <!-- Sales Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                <div class="mb-4">
                    <h3 class="font-bold text-gray-800">Penjualan 7 Hari Terakhir</h3>
                    <p class="text-sm text-gray-500">Data transaksi harian (lunas)</p>
                </div>
                <div class="h-60">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Status Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                <div class="mb-4">
                    <h3 class="font-bold text-gray-800">Status Pesanan</h3>
                    <p class="text-sm text-gray-500">Distribusi status order saat ini</p>
                </div>
                <div class="h-60">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Paket -->
        <div x-ref="topPaket">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-[linear-gradient(135deg,#4f6ae4_0%,#6a5af9_100%)] px-5 py-4 text-white relative">
                    <h3 class="font-bold flex items-center gap-2">
                        <i class="fas fa-trophy"></i>
                        5 Paket Laundry Terlaris (1 Bulan Terakhir)
                    </h3>
                    <i class="fas fa-coins absolute top-4 right-4 opacity-30 text-2xl"></i>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($topPaketLaris as $index => $paket)
                        @php
                            $rank = $index + 1;

                            $badgeColor = match ($rank) {
                                1 => 'bg-amber-100 text-amber-800 border-amber-300',
                                2 => 'bg-gray-100 text-gray-800 border-gray-300',
                                3 => 'bg-amber-50 text-amber-700 border-amber-200',
                                default => 'bg-slate-100 text-slate-800 border-slate-300',
                            };

                            $glowColor = match ($rank) {
                                1 => 'shadow-[0_0_12px_-4px_rgba(251,191,36,0.4)]',
                                2 => 'shadow-[0_0_12px_-4px_rgba(156,163,175,0.3)]',
                                3 => 'shadow-[0_0_12px_-4px_rgba(251,191,36,0.2)]',
                                default => '',
                            };

                            $medalColor = match ($rank) {
                                1 => 'amber-600',
                                2 => 'gray-600',
                                3 => 'amber-700',
                                default => '',
                            };
                        @endphp

                        <div class="p-4 flex items-center hover:bg-gray-50 transition-colors">
                            <div class="me-4">
                                <div
                                    class="w-10 h-10 rounded-full flex items-center justify-center
                                            font-bold text-sm border shadow-sm
                                            {{ $badgeColor }} {{ $glowColor }}">
                                    {{ $rank }}<i class="fa fa-medal text-{{ $medalColor }}"></i>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-medium text-gray-800">
                                    {{ $paket->nama_paket }}
                                </h4>
                                <p class="text-xs text-gray-500">
                                    {{ number_format($paket->total_transaksi ?? 0) }}x transaksi
                                </p>
                            </div>

                            <span class="ms-auto bg-green-50 text-green-700 font-bold px-3 py-1.5 rounded-full text-sm">
                                {{ 'Rp ' . number_format($paket->total_pendapatan, 0, ',', '.') }}
                            </span>
                        </div>

                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-box-open text-3xl opacity-50 mb-2"></i>
                            <p>Tidak ada paket yang terjual dalam 1 bulan terakhir</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .stat-card {
            @apply bg-white rounded-xl p-5 shadow-sm border border-gray-200 transition-transform hover:-translate-y-0.5 hover:shadow-md;
        }

        .badge-rank {
            @apply w-11 h-11 rounded-full flex items-center justify-center font-extrabold text-sm shadow-sm border-2 border-white;
        }
    </style>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/chartjs/chart.js') }}"></script>
    <script>
        function dashboard() {
            return {
                init() {
                    // Animasi fade-in saat elemen masuk viewport
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('animate-fade-in');
                                observer.unobserve(entry.target);
                            }
                        });
                    }, {
                        threshold: 0.1
                    });

                    ['stats', 'header', 'charts', 'topPaket'].forEach(ref => {
                        if (this.$refs[ref]) {
                            if (Array.from(this.$refs[ref].children).length) {
                                Array.from(this.$refs[ref].children).forEach(el => observer.observe(el));
                            } else {
                                observer.observe(this.$refs[ref]);
                            }
                        }
                    });

                    // Init Chart.js
                    this.initCharts();
                },

                initCharts() {
                    // Sales Chart
                    const salesCtx = document.getElementById('salesChart');
                    if (salesCtx) {
                        const salesLabels = @json($salesLast7Days['labels']);
                        const salesData = @json($salesLast7Days['sales']);
                        new Chart(salesCtx, {
                            type: 'line',
                            data: {
                                labels: salesLabels,
                                datasets: [{
                                    label: 'Pendapatan (Rp)',
                                    data: salesData,
                                    borderColor: '#4f6ae4',
                                    backgroundColor: 'rgba(79, 106, 228, 0.1)',
                                    borderWidth: 3,
                                    tension: 0.3,
                                    fill: true,
                                    pointRadius: 5,
                                    pointBackgroundColor: '#ffffff',
                                    pointBorderColor: '#4f6ae4',
                                    pointBorderWidth: 3,
                                    pointHoverRadius: 7,
                                    pointHoverBackgroundColor: '#4f6ae4',
                                    pointHoverBorderColor: '#ffffff',
                                    pointHoverBorderWidth: 3,
                                    cubicInterpolationMode: 'monotone'
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    tooltip: {
                                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                                        titleColor: '#212529',
                                        bodyColor: '#495057',
                                        borderColor: '#dee2e6',
                                        borderWidth: 1,
                                        padding: 10,
                                        callbacks: {
                                            label: function(context) {
                                                let value = context.raw;
                                                if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(
                                                    1) + 'JT';
                                                if (value >= 1000) return 'Rp ' + (value / 1000).toFixed(0) +
                                                    'RB';
                                                return 'Rp ' + value.toLocaleString('id-ID');
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: {
                                            display: false
                                        },
                                        ticks: {
                                            color: '#6c757d',
                                            font: {
                                                size: 11
                                            }
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            color: '#6c757d',
                                            font: {
                                                size: 10
                                            },
                                            callback: function(value) {
                                                if (value >= 1000000) return (value / 1000000).toFixed(1) +
                                                    'JT';
                                                if (value >= 1000) return (value / 1000).toFixed(0) + 'RB';
                                                return value;
                                            }
                                        },
                                        grid: {
                                            color: 'rgba(0,0,0,0.04)'
                                        }
                                    }
                                },
                                interaction: {
                                    intersect: false,
                                    mode: 'index'
                                }
                            }
                        });
                    }

                    // Status Chart
                    const statusCtx = document.getElementById('statusChart');
                    if (statusCtx) {
                        const statusLabels = @json($statusData['labels']);
                        const statusData = @json($statusData['data']);
                        const statusColors = @json($statusData['colors']);
                        new Chart(statusCtx, {
                            type: 'doughnut',
                            data: {
                                labels: statusLabels,
                                datasets: [{
                                    data: statusData,
                                    backgroundColor: statusColors,
                                    borderWidth: 0,
                                    borderRadius: 8,
                                    spacing: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            padding: 15,
                                            usePointStyle: true,
                                            font: {
                                                size: 12
                                            }
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return context.label + ': ' + context.raw + ' pesanan';
                                            }
                                        }
                                    }
                                },
                                cutout: '65%'
                            }
                        });
                    }
                }
            }
        }

        // Animasi CSS
        document.head.insertAdjacentHTML('beforeend', `
        <style>
        .animate-fade-in {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        </style>
    `);
    </script>
@endpush
