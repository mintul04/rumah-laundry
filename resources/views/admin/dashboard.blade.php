@extends('layouts.main')

@section('title', 'Dashboard - RumahLaundry')
@section('page-title', 'Dashboard')

@push('styles')
    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--neutral-white);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .stat-icon.blue {
            background-color: var(--primary-light);
            color: var(--primary-blue);
        }

        .stat-icon.green {
            background-color: #d4edda;
            color: var(--accent-success);
        }

        .stat-icon.orange {
            background-color: #fff3cd;
            color: var(--accent-warning);
        }

        .stat-icon.purple {
            background-color: #e2e3e5;
            color: #6f42c1;
        }

        .stat-content h3 {
            font-size: 0.875rem;
            color: var(--neutral-dark);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .stat-number {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-blue);
        }

        .chart-card {
            background: var(--neutral-white);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .chart-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--neutral-dark);
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 1rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .stat-content h3 {
                font-size: 0.75rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-content">
                <h3>Total Pesanan</h3>
                <div class="stat-number">1,245</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>Total Pelanggan</h3>
                <div class="stat-number">320</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-concierge-bell"></i>
            </div>
            <div class="stat-content">
                <h3>Total Layanan</h3>
                <div class="stat-number">18</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fas fa-rupiah-sign"></i>
            </div>
            <div class="stat-content">
                <h3>Pendapatan Bulan Ini</h3>
                <div class="stat-number">Rp 45M</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="chart-card">
                <h5 class="chart-card-title">Grafik Pesanan (Bulan Ini)</h5>
                <canvas id="ordersChart" style="height: 300px;"></canvas>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="chart-card">
                <h5 class="chart-card-title">Status Pesanan</h5>
                <canvas id="statusChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    {{-- <script>
        // Orders Chart
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        new Chart(ordersCtx, {
            type: 'line',
            data: {
                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                datasets: [{
                    label: 'Pesanan',
                    data: [65, 85, 72, 90],
                    borderColor: '#0066cc',
                    backgroundColor: 'rgba(0, 102, 204, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#0066cc'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f0f0f0'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Proses', 'Menunggu'],
                datasets: [{
                    data: [300, 150, 100],
                    backgroundColor: ['#28a745', '#0066cc', '#ffc107'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script> --}}
@endpush
