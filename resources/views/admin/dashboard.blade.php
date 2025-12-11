@extends('layouts.main')

@section('title', 'Dashboard - RumahLaundry')
@section('page-title', 'Beranda')

@push('styles')
    <style>
        /* Menambah style untuk header beranda */
        .beranda-header {
            background: #fbfbfe;
            padding: 1.5rem;
            border-radius: 0.75rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-md);
            color: rgb(55, 72, 250);
        }

        .beranda-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .beranda-icon {
            font-size: 1.5rem;
            margin-right: 0.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 6px;
            color: black;
        }

        .beranda-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            color: black;
        }

        .beranda-breadcrumb {
            font-size: 0.95rem;
            opacity: 0.9;
            color: black;
        }

        .beranda-breadcrumb a {
            color: black;
            text-decoration: none;
            opacity: 0.8;
        }

        .beranda-breadcrumb a:hover {
            opacity: 1;
        }

        .beranda-breadcrumb span {
            margin: 0 0.5rem;
            opacity: 0.7;
            color: black;
        }

        @media (max-width: 768px) {
            .beranda-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .beranda-title {
                font-size: 1.5rem;
            }

            .beranda-breadcrumb {
                font-size: 0.85rem;
                margin-top: 1rem;
            }
        }

        .header-address {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
            border-left: 4px solid var(--primary-blue);
        }

        .laundry-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .laundry-address {
            font-size: 0.95rem;
            color: var(--neutral-dark);
            line-height: 1.5;
        }

        .laundry-address i {
            color: var(--primary-blue);
            margin-right: 8px;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, #4f6ae4 0%, #4e5fe5 100%);
            border-radius: 0.75rem;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: white;
        }

        .welcome-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .welcome-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .welcome-badge i {
            margin-right: 0.5rem;
        }

        /* Stats Grid (existing code) */
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
            background-color: #e0f7fa;
            color: #00838f;
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

        @media (max-width: 768px) {
            .header-address {
                padding: 1rem;
            }

            .laundry-name {
                font-size: 1.25rem;
            }

            .laundry-address {
                font-size: 0.85rem;
            }

            .welcome-section {
                padding: 1.5rem;
            }

            .welcome-title {
                font-size: 1.25rem;
            }

            .welcome-subtitle {
                font-size: 0.9rem;
            }

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
    <div class="beranda-header">
        <div class="beranda-left">
            <div class="beranda-icon">
                <i class="fas fa-home"></i>
            </div>
            <h1 class="beranda-title">Beranda</h1>
        </div>
        <div class="beranda-breadcrumb">
            <a href="#"><i class="fas fa-home"></i></a>
            <span>/</span>
            <span>Beranda</span>
        </div>
    </div>

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

    <div class="header-address">
        <div class="laundry-name">RumahLaundry</div>
        <div class="laundry-address">
            <i class="fas fa-map-marker-alt"></i>
            Alamat: Jalan Mawar No:123 Kec. Kutorejo Kab. Mojokerto
            Prov Jawa Timur kode 55225
        </div>
    </div>

    <div class="welcome-section">
        <div class="welcome-content">
            <h2 class="welcome-title">
                Selamat Datang
                @if (Auth::user()->role == 'admin')
                    Administrator
                @else
                    Karyawan
                @endif
                ✨
            </h2>
            <p class="welcome-subtitle">
                Anda login sebagai
                @if (Auth::user()->role == 'admin')
                    Admin RumahLaundry
                @else
                    Karyawan RumahLaundry
                @endif
            </p>
        </div>
    </div>
@endsection
