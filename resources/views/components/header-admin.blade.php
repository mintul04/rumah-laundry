<header class="admin-header">
    <div class="header-top">
        <div class="header-title">
            <h1>@yield('page-title', 'Dashboard')</h1>
        </div>

        <div class="header-user dropdown">
            <a class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-info me-2">
                    <span class="user-role">{{ auth()->user()->nama ?? 'Manda' }}</span>
                </div>
                <div class="user-avatar">
                    {{ auth()->user() ? strtoupper(substr(auth()->user()->nama, 0, 2)) : 'M' }}
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.index') }}">
                        <i class="fa fa-user me-2"></i> Profile
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center w-100">
                            <i class="fa fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
