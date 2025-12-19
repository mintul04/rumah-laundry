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
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 overflow-hidden" aria-labelledby="userDropdown" style="min-width: 200px;">
                <li>
                    <a class="dropdown-item d-flex align-items-center px-3 py-2 text-primary fw-semibold" href="{{ route('profile.index') }}"
                        onmouseover="this.style.background='linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%)'; this.style.transform='translateX(4px)';"
                        onmouseout="this.style.background=''; this.style.transform='';" style="transition: all .25s ease;">
                        <i class="fa fa-user-circle me-2"></i> Profile
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider mx-3 my-1">
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center w-100 px-3 py-2 text-danger fw-semibold border-0 bg-transparent"
                            onmouseover="this.style.background='linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%)'; this.style.transform='translateX(4px)';"
                            onmouseout="this.style.background=''; this.style.transform='';" style="transition: all .25s ease;">
                            <i class="fa fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
