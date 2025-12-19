<aside class="admin-sidebar">
    <div class="sidebar-brand" style="display: flex; align-items: center; gap: 10px;">
        {{-- <img src="{{ asset('img/rumah.png') }}" alt="Logo rumah" style="width: 35px; height: auto;"> --}}
        <i class="fas fa-wind" style="font-size: 1.5rem;"></i>
        <div>
            <span class="sidebar-brand-text">RumahLaundry</span>
            <div style="font-size: 0.9rem; opacity: 0.8;">{{ auth()->user()->role == 'admin' ? 'Admin' : 'Karyawan' }}</div>
        </div>
    </div>

    <nav>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard-admin') }}" class="@if (request()->routeIs('dashboard-admin')) active @endif">
                    <i class="fa-solid fa-house"></i>
                    <span>Beranda</span>
                </a>
            </li>

            @if (auth()->user()->role == 'admin')
                <li>
                    <a href="{{ route('paket-laundry.index') }}" class="@if (request()->routeIs('paket-laundry.*')) active @endif">
                        <i class="fas fa-list-check"></i>
                        <span>Paket Laundry</span>
                    </a>
                </li>
            @endif

            <li>
                <a href="{{ route('transaksi.index') }}" class="@if (request()->routeIs('transaksi.*')) active @endif">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Transaksi</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.laporan.index') }}" class="@if (request()->routeIs('admin.laporan.*')) active @endif">
                    <i class="fas fa-chart-line"></i>
                    <span>Laporan</span>
                </a>
            </li>

            @if (auth()->user()->role == 'admin')
                <li style="margin-top: 2rem; border-top: 1px solid rgba(255, 255, 255, 0.2); padding-top: 2rem;">
                    <a href="{{ route('manajemen-user.index') }}" class="@if (request()->routeIs('manajemen-user.*')) active @endif">
                        <i class="fas fa-gear"></i>
                        <span>Manajemen User</span>
                    </a>
                </li>
            @endif
            </li>
        </ul>
    </nav>
</aside>
