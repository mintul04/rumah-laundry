<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('assets/vendor/fontawesome/all.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.min.css') }}">
    <title>{{ $pengaturan->nama_laundry ?? 'RumahLaundry' }} - Login</title>

    {{-- Background pattern untuk card --}}
    <style>
        .login-card::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, rgba(13, 110, 253, 0.04) 0%, transparent 70%);
            border-radius: 0 0 0 100px;
            z-index: 0;
        }

        .login-card::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(13, 110, 253, 0.03) 0%, transparent 70%);
            border-radius: 0 100px 0 0;
            z-index: 0;
        }

        .form-content {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body class="font-sans bg-linear-to-br from-blue-50 to-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md relative">
        <!-- Subtle floating dots (opsional, bisa dihapus jika terlalu banyak) -->
        <div class="absolute -top-6 -left-6 w-4 h-4 rounded-full bg-blue-200 opacity-30 animate-pulse"></div>
        <div class="absolute -bottom-8 -right-8 w-3 h-3 rounded-full bg-blue-300 opacity-40"></div>

        <div class="login-card bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 relative">
            <!-- Accent top bar -->
            <div class="h-1.5 bg-blue-600 w-full"></div>

            <div class="form-content p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    @if ($pengaturan->logo)
                        <div class="mb-5 flex justify-center">
                            <img src="{{ Storage::url($pengaturan->logo) }}" alt="Logo {{ $pengaturan->nama_laundry }}" class="h-20 object-contain drop-shadow-sm">
                        </div>
                    @else
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 mb-5">
                            <i class="fas fa-wind text-blue-600 text-2xl"></i>
                        </div>
                    @endif
                    <h1 class="text-2xl font-bold text-gray-800">Welcome Back</h1>
                    <p class="text-gray-500 text-sm mt-1">Sign in to manage your laundry</p>
                </div>

                <!-- Alert container -->
                <div id="alertContainer" class="mb-6"></div>

                <!-- Form -->
                <form id="loginForm" action="{{ route('loginProses') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="mb-6">
                        <label class="flex items-center gap-2 text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">
                            <i class="fas fa-envelope text-blue-600"></i> Email Address
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-envelope text-sm"></i>
                            </span>
                            <input type="email" name="email"
                                class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition placeholder:text-gray-400"
                                placeholder="your@email.com" required autocomplete="email">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-7">
                        <label class="flex items-center gap-2 text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">
                            <i class="fas fa-lock text-blue-600"></i> Password
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-lock text-sm"></i>
                            </span>
                            <input type="password" name="password" id="passwordInput"
                                class="w-full pl-12 pr-12 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition placeholder:text-gray-400"
                                placeholder="••••••••" required autocomplete="current-password">
                            <button type="button" class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-blue-600" onclick="togglePasswordVisibility()"
                                aria-label="Toggle password visibility">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 px-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </button>
                </form>
            </div>
        </div>

        <!-- Optional subtle footer -->
        <p class="text-center text-gray-400 text-xs mt-6">
            © {{ date('Y') }} {{ $pengaturan->nama_laundry ?? 'RumahLaundry' }}. All rights reserved.
        </p>
    </div>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/fontawesome/all.min.js') }}"></script>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('passwordInput');
            const icon = event.target.closest('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.querySelector('input[name="email"]');
            const password = document.querySelector('input[name="password"]');

            if (!email.value.trim()) {
                e.preventDefault();
                showAlert('Silakan masukkan alamat email Anda.', 'danger');
                email.focus();
                return;
            }

            if (!password.value) {
                e.preventDefault();
                showAlert('Silakan masukkan kata sandi Anda.', 'danger');
                password.focus();
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                e.preventDefault();
                showAlert('Silakan masukkan alamat email yang valid.', 'danger');
                email.focus();
                return;
            }
        });

        function showAlert(message, type = 'danger') {
            const alertContainer = document.getElementById('alertContainer');
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.innerHTML = `
                <i class="fas fa-${type === 'danger' ? 'exclamation-circle' : 'check-circle'}"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            alertContainer.innerHTML = '';
            alertContainer.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.classList.remove('show');
                setTimeout(() => alertDiv.remove(), 300);
            }, 5000);
        }

        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && e.target.name === 'password') {
                document.getElementById('loginForm').dispatchEvent(new Event('submit'));
            }
        });
    </script>

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
</body>

</html>
