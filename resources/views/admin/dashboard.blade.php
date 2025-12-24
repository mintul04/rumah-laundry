@extends('layouts.main')

@section('title', 'Dashboard - RumahLaundry')
@section('page-title', 'Beranda')

@push('styles')
    <style>
        :root {
            --primary: #4f6ae4;
            --primary-light: #6a7bec;
            --primary-gradient: linear-gradient(135deg, #4f6ae4 0%, #6a5af9 100%);
            --success: #28a745;
            --warning: #ffc107;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #343a40;
            --border: #e9ecef;
            --shadow-sm: 0 2px 6px rgba(0, 0, 0, 0.06);
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fb;
        }

        /* === Fade-in Animation === */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
        }

        /* === Stats Card Modern === */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
            opacity: 0.8;
        }

        .stat-icon-box {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 1rem;
            background: rgba(79, 106, 228, 0.12);
            color: var(--primary);
        }

        .stat-content h3 {
            font-size: 0.95rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary);
            line-height: 1.2;
        }

        /* === Address & Welcome === */
        .header-address {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            margin-bottom: 1.8rem;
            position: relative;
            overflow: hidden;
        }

        .header-address::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary-gradient);
        }

        .laundry-name {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.4rem;
        }

        .welcome-section {
            background: var(--primary-gradient);
            border-radius: 12px;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .welcome-section::after {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .welcome-title {
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 0.6rem;
            position: relative;
            z-index: 2;
        }

        .welcome-subtitle {
            font-size: 1rem;
            opacity: 0.95;
            margin-bottom: 1.2rem;
            position: relative;
            z-index: 2;
            line-height: 1.6;
        }

        /* === Chart Cards === */
        .chart-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            height: 100%;
            transition: var(--transition);
        }

        .chart-card:hover {
            box-shadow: var(--shadow);
        }

        .chart-header {
            padding: 1.25rem 1.5rem 0;
        }

        .chart-title {
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }

        .chart-subtitle {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .chart-body {
            padding: 0 1.5rem 1.5rem;
            height: 250px;
        }

        /* === Top Paket Card === */
        .top-paket-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .top-paket-header {
            background: var(--primary-gradient);
            padding: 1.25rem 1.5rem;
            color: white;
            position: relative;
        }

        .top-paket-header i {
            opacity: 0.3;
            font-size: 2rem;
            position: absolute;
            top: 8px;
            right: 16px;
        }

        .paket-item {
            padding: 1.1rem 1.5rem;
            transition: var(--transition);
            border-bottom: 1px solid var(--border);
        }

        .paket-item:last-child {
            border-bottom: none;
        }

        .paket-item:hover {
            background-color: #f9fbff;
        }

        .badge-rank {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.15rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border: 2px solid white;
        }

        .gold {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #212529;
        }

        .silver {
            background: linear-gradient(135deg, #E6E6E6, #C0C0C0);
            color: #212529;
        }

        .bronze {
            background: linear-gradient(135deg, #D2B48C, #CD853F);
            color: white;
        }

        .other {
            background: #e9ecef;
            color: #495057;
        }

        .paket-name {
            font-weight: 600;
            color: var(--dark);
            font-size: 1.05rem;
        }

        .paket-amount {
            background: #e8f5e9;
            color: var(--success);
            font-weight: 700;
        }

        /* === Responsif === */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr !important;
            }

            .welcome-title {
                font-size: 1.3rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .chart-body {
                height: 220px;
            }
        }
    </style>
@endpush

@section('content')

    <div class="row stats-grid animate-fade-in" style="animation-delay: 0.1s;">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon-box" style="background: rgba(79, 106, 228, 0.12); color: var(--primary);">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="stat-content">
                    <h3>TOTAL PAKET</h3>
                    <div class="stat-number">{{ $totalPaket ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon-box" style="background: rgba(40, 167, 69, 0.12); color: #28a745;">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>TOTAL PELANGGAN</h3>
                    <div class="stat-number">{{ $totalPelanggan ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon-box" style="background: rgba(255, 193, 7, 0.12); color: #ffc107;">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-content">
                    <h3>TOTAL PESANAN</h3>
                    <div class="stat-number">{{ $totalPesanan ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon-box" style="background: rgba(23, 162, 184, 0.12); color: #17a2b8;">
                    <i class="fas fa-rupiah-sign"></i>
                </div>
                <div class="stat-content">
                    <h3>PENDAPATAN BULAN INI</h3>
                    <div class="stat-number">{{ $pendapatanFormatted ?? '0' }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row animate-fade-in mt-3" style="animation-delay: 0.2s;">
        <div class="col-md-6">
            <div class="header-address">
                <div class="laundry-name">RumahLaundry</div>
                <div class="laundry-address">
                    <i class="fas fa-map-marker-alt me-1"></i>
                    Jalan Mawar No.123, Kec. Kutorejo, Kab. Mojokerto, Jawa Timur 55225
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="welcome-section">
                <h2 class="welcome-title">
                    Selamat Datang,
                    @if (Auth::user()->role == 'admin')
                        Administrator
                    @else
                        Karyawan
                    @endif
                    <i class="fas fa-star ms-1"></i>
                </h2>
                <p class="welcome-subtitle">
                    Anda login sebagai
                    @if (Auth::user()->role == 'admin')
                        Admin
                    @else
                        Karyawan
                    @endif RumahLaundry
                </p>
            </div>
        </div>
    </div>

    <div class="row animate-fade-in" style="animation-delay: 0.3s;">
        <div class="col-md-6 mb-4">
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">Penjualan 7 Hari Terakhir</h5>
                    <p class="chart-subtitle">Data transaksi harian (lunas)</p>
                </div>
                <div class="chart-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">Status Pesanan</h5>
                    <p class="chart-subtitle">Distribusi status order saat ini</p>
                </div>
                <div class="chart-body">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row animate-fade-in" style="animation-delay: 0.4s;">
        <div class="col-md-12">
            <div class="top-paket-card">
                <div class="top-paket-header">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-trophy me-2"></i> 5 Paket Laundry Terlaris (1 Bulan Terakhir)
                    </h5>
                    <i class="fas fa-coins"></i>
                </div>
                <div class="card-body p-0">
                    @forelse($topPaketLaris as $index => $paket)
                        <div class="paket-item d-flex align-items-center">
                            <div class="me-4">
                                @if ($index == 0)
                                    <div class="badge-rank gold">1</div>
                                @elseif($index == 1)
                                    <div class="badge-rank silver">2</div>
                                @elseif($index == 2)
                                    <div class="badge-rank bronze">3</div>
                                @else
                                    <div class="badge-rank other">{{ $index + 1 }}</div>
                                @endif
                            </div>
                            <div class="">
                                <h6 class="paket-name mb-0">{{ $paket->nama_paket }}</h6>
                            </div>
                            <div class="ms-auto">
                                <span class="badge paket-amount px-3 py-2 rounded-pill">
                                    {{ 'Rp ' . number_format($paket->total_pendapatan, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-box-open fa-2x mb-2 opacity-50"></i>
                            <p class="mb-0">Tidak ada paket yang terjual dalam 1 bulan terakhir</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/chartjs/chart.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan animasi delay
            document.querySelectorAll('.animate-fade-in').forEach((el, i) => {
                el.style.animationDelay = (i * 0.1) + 's';
            });

            // === SALES CHART (Line Chart dengan Point Styling) ===
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
                            tension: 0.3, // Kurva lembut
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
                                        if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(1) + 'JT';
                                        if (value >= 1000) return 'Rp ' + (value / 1000).toFixed(0) + 'RB';
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
                                        if (value >= 1000000) return (value / 1000000).toFixed(1) + 'JT';
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

            // === STATUS CHART (tetap doughnut) ===
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
        });
    </script>
@endpush
