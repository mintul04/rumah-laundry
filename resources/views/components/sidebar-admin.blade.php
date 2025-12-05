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
                    <span>Beranda</span>
                </a>
            </li>
            <li>
                <a href="{{ route('paket-laundry.index') }}" class="@if (request()->routeIs('admin.paket-laundry.*')) active @endif">
                    <i class="fas fa-list-check"></i>
                    <span>Paket Laundry</span>
                </a>
            </li>

            <li style="margin-top: 2rem; border-top: 1px solid rgba(255, 255, 255, 0.2); padding-top: 2rem;">
                <a href="{{ route('transaksi.index') }}" class="@if (request()->routeIs('admin.transaksi.*')) active @endif">
                    <i class="fas fa-cog"></i>
                    <span>Transaksi</span>
                </a>
            </li>


            <li style="margin-top: 2rem; border-top: 1px solid rgba(255, 255, 255, 0.2); padding-top: 2rem;">
                <a href="{{ route('admin.laporan.index') }}" class="@if (request()->routeIs('admin.laporan.*')) active @endif">
                    <i class="fas fa-file-invoice"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <li style="margin-top: 2rem; border-top: 1px solid rgba(255, 255, 255, 0.2); padding-top: 2rem;">
                <a href="#">
                    <i class="fas fa-file-gear"></i>
                    <span>Pengaturan</span>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    style="display: flex; align-items: center; gap: 10px; color: inherit; text-decoration: none;">

                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</aside>
