<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RumahLaundry - Admin Panel')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="{{ asset('assets/vendor/fontawesome/all.min.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css" rel="stylesheet">

    <link href="{{ asset('assets/vendor/sweetalert/sweetalert.min.css') }}" rel="stylesheet">

    <style>
        /* === Color Palette === */
        :root {
            --primary-blue: #0066cc;
            --primary-dark: #004ba3;
            --primary-light: #e6f2ff;
            --neutral-white: #ffffff;
            --neutral-light: #f8f9fa;
            --neutral-gray: #e9ecef;
            --neutral-dark: #495057;
            --accent-success: #28a745;
            --accent-warning: #ffc107;
            --accent-danger: #dc3545;
            --accent-info: #17a2b8;
            --border-color: #dee2e6;
            --shadow-sm: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --shadow-md: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--neutral-light);
            color: var(--neutral-dark);
        }

        /* === Layout Structure === */
        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 260px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            color: var(--neutral-white);
            box-shadow: var(--shadow-md);
        }

        .admin-main {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .admin-header {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .admin-content {
            flex: 1;
            padding: 2rem;
        }

        /* === Sidebar Styles === */
        .sidebar-brand {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .sidebar-brand-text {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0 0.5rem;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .sidebar-menu a:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: var(--neutral-white);
            transform: translateX(4px);
        }

        .sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.25);
            color: var(--neutral-white);
            font-weight: 600;
            border-left: 3px solid var(--neutral-white);
            padding-left: calc(1rem - 3px);
        }

        .sidebar-menu i {
            width: 20px;
            text-align: center;
        }

        /* === Header Styles === */
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin: 0;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--neutral-white);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info span {
            display: block;
        }

        .user-name {
            font-weight: 600;
            color: var(--neutral-dark);
            font-size: 0.9rem;
        }

        .user-role {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* === Scrollbar === */
        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .admin-sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* === Responsive === */
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 0;
                left: -260px;
                transition: left 0.3s ease;
            }

            .admin-sidebar.show {
                left: 0;
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-content {
                padding: 1.5rem;
            }

            .header-title h1 {
                font-size: 1.25rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="admin-container">
        @include('components.sidebar-admin')

        <div class="admin-main">
            @include('components.header-admin')

            <div class="admin-content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                position: "top-end",
                toast: true,
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-xl'
                }
            });
        </script>
    @endif

    {{-- Error --}}
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ session('error') }}',
                timer: 3000,
                position: "top-end",
                toast: true,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-xl'
                }
            });
        </script>
    @endif

    {{-- Info --}}
    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: '{{ session('info') }}',
                position: "top-end",
                toast: true,
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-xl'
                }
            });
        </script>
    @endif

    @stack('scripts')
</body>

</html>
