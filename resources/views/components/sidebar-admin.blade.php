<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <i class="fas fa-soap" style="font-size: 1.5rem;"></i>
        <span class="sidebar-brand-text">RumahLaundry</span>
    </div>

    <nav>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard-admin') }}" class="@if (request()->routeIs('dashboard-admin')) active @endif">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('layanan.index') }}" class="@if (request()->routeIs('layanan.*')) active @endif">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Data Kategori</span>
                </a>
            </li>
            <li>
                <a href="{{ route('paket-laundry.index') }}" class="@if (request()->routeIs('paket-laundry.*')) active @endif">
                    <i class="fas fa-list-check"></i>
                    <span>Paket Laundry</span>
                </a>
            </li>
            <li>
                <a href="#" class="">
                    <i class="fas fa-users"></i>
                    <span>Pelanggan</span>
                </a>
            </li>
            <li>
                <li>
                    <a href="#" class="">
                        <i class="fas fa-cog"></i>
                        <span>Transaksi</span>
                    </a>
                </li>
                <a href="#" class="">
                    <i class="fas fa-file-invoice"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <li style="margin-top: 2rem; border-top: 1px solid rgba(255, 255, 255, 0.2); padding-top: 2rem;">
                <a href="#" class="">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
