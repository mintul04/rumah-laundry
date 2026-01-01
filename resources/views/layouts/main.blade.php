<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RumahLaundry - Admin Panel')</title>

    {{-- Tailwind CSS & Alpine.js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/all.min.css') }}">
    <script src="{{ asset('assets/vendor/fontawesome/all.min.js') }}"></script>

    {{-- SweetAlert2 --}}
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.min.css') }}">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-700 font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen">
        <!-- Sidebar -->
        @include('components.sidebar-admin')

        <!-- Overlay (mobile) -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden" x-cloak></div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 ml-0 lg:ml-64 transition-all duration-300 ease-in-out">
            <!-- Header -->
            @include('components.header-admin')

            <!-- Page Content -->
            <main class="p-6 pt-4 lg:pt-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- SweetAlert Flash Messages -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "{{ session('success') }}",
                position: "top-end",
                toast: true,
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-lg shadow-lg'
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: "{{ session('error') }}",
                position: "top-end",
                toast: true,
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-lg shadow-lg'
                }
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: "{{ session('info') }}",
                position: "top-end",
                toast: true,
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-lg shadow-lg'
                }
            });
        </script>
    @endif

    @stack('scripts')
</body>

</html>
