<aside :class="{ '-translate-x-full': !sidebarOpen }"
    class="fixed top-0 left-0 z-30 h-screen w-64
           bg-[linear-gradient(135deg,#0066cc_0%,#004ba3_100%)]
           text-white shadow-lg
           transform transition-transform duration-300 ease-in-out
           overflow-y-auto
           lg:translate-x-0">
    <!-- Header: Logo + Nama + Role -->
    <div class="flex items-center gap-3 px-5 py-4 border-b border-white/20 shrink-0">
        @if ($pengaturan->logo)
            <img src="{{ Storage::url($pengaturan->logo) }}" alt="Logo {{ $pengaturan->nama_laundry }}" class="h-8 w-auto object-contain rounded">
        @else
            <div class="flex items-center justify-center w-10 h-10 rounded bg-white/20">
                <i class="fas fa-wind text-lg"></i>
            </div>
        @endif
        <div>
            <div class="font-bold text-base">{{ $pengaturan->nama_laundry ?? 'RumahLaundry' }}</div>
            <div class="text-xs opacity-80">
                {{ auth()->user()->role == 'admin' ? 'Admin' : 'Karyawan' }}
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="px-3 py-4">
        <ul class="space-y-1">
            {{-- Dashboard --}}
            <li>
                <a href="{{ route('dashboard-admin') }}"
                    class="{{ request()->routeIs('dashboard-admin') ? 'bg-blue-700 text-white font-semibold border-l-4 border-white pl-3' : 'text-white/90 hover:bg-blue-800' }} flex items-center gap-3 px-3 py-2.5 rounded transition-colors">
                    <i class="fa-solid fa-house w-5 text-center"></i>
                    <span>Beranda</span>
                </a>
            </li>

            {{-- Paket Laundry (Admin only) --}}
            @if (auth()->user()->role == 'admin')
                <li>
                    <a href="{{ route('paket-laundry.index') }}"
                        class="{{ request()->routeIs('paket-laundry.*') ? 'bg-blue-700 text-white font-semibold border-l-4 border-white pl-3' : 'text-white/90 hover:bg-blue-800' }} flex items-center gap-3 px-3 py-2.5 rounded transition-colors">
                        <i class="fas fa-list-check w-5 text-center"></i>
                        <span>Paket Laundry</span>
                    </a>
                </li>
            @endif

            {{-- Transaksi --}}
            <li>
                <a href="{{ route('transaksi.index') }}"
                    class="{{ request()->routeIs('transaksi.*') ? 'bg-blue-700 text-white font-semibold border-l-4 border-white pl-3' : 'text-white/90 hover:bg-blue-800' }} flex items-center gap-3 px-3 py-2.5 rounded transition-colors">
                    <i class="fas fa-shopping-cart w-5 text-center"></i>
                    <span>Transaksi</span>
                </a>
            </li>

            {{-- Laporan --}}
            <li>
                <a href="{{ route('admin.laporan.index') }}"
                    class="{{ request()->routeIs('admin.laporan.*') ? 'bg-blue-700 text-white font-semibold border-l-4 border-white pl-3' : 'text-white/90 hover:bg-blue-800' }} flex items-center gap-3 px-3 py-2.5 rounded transition-colors">
                    <i class="fas fa-chart-line w-5 text-center"></i>
                    <span>Laporan</span>
                </a>
            </li>

            {{-- Admin-Only Section Divider --}}
            @if (auth()->user()->role == 'admin')
                <li class="mt-6 pt-4 border-t border-white/20">
                    <a href="{{ route('manajemen-user.index') }}"
                        class="{{ request()->routeIs('manajemen-user.*') ? 'bg-blue-700 text-white font-semibold border-l-4 border-white pl-3' : 'text-white/90 hover:bg-blue-800' }} flex items-center gap-3 px-3 py-2.5 rounded transition-colors">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span>Manajemen User</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pengaturan.index') }}"
                        class="{{ request()->routeIs('pengaturan.*') ? 'bg-blue-700 text-white font-semibold border-l-4 border-white pl-3' : 'text-white/90 hover:bg-blue-800' }} flex items-center gap-3 px-3 py-2.5 rounded transition-colors">
                        <i class="fas fa-gear w-5 text-center"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</aside>
