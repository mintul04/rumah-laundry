<header class="admin-header">
    <div class="header-top">
        <div class="header-title">
            <h1>@yield('page-title', 'Dashboard')</h1>
        </div>

        <div class="header-user">
            <div class="user-info">
                <span class="user-role">{{ auth()->user()->nama ?? 'Manda' }}</span>
            </div>
            <div class="user-avatar">
                {{ auth()->user() ? strtoupper(substr(auth()->user()->nama, 0, 2)) : 'M' }}
            </div>
        </div>
    </div>
</header>
