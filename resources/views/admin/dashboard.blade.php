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
                <h3>Total Paket Lundry</h3>
                <div class="stat-number">{{ $totalPaket ?? 0 }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>Total Pelanggan</h3>
                <div class="stat-number">{{ $totalPelanggan ?? 0 }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-concierge-bell"></i>
            </div>
            <div class="stat-content">
                <h3>Total Layanan</h3>
                <div class="stat-number">{{ $totalPesanan ?? 0 }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fas fa-rupiah-sign"></i>
            </div>
            <div class="stat-content">
                <h3>Pendapatan Bulan Ini</h3>
                <div class="stat-number">{{ $pendapatanFormatted ?? '0' }}</div>
            </div>
        </div>
    </div>
@endsection
