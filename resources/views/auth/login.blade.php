<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap 5 CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="{{ asset('assets/vendor/fontawesome/all.min.css') }}" rel="stylesheet">
    <title>Login - Modern Authentication</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background-color: #52a0ee;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Clean background with subtle pattern */
        

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .login-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background-color: #ffffff;
            padding: 40px 20px 20px;
            text-align: center;
        }

        .login-title {
            color: #0d6efd;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .login-subtitle {
            color: #6c757d;
            font-size: 15px;
            margin: 10px 0 0;
            font-weight: 400;
        }

        .card-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label i {
            color: #0d6efd;
            font-size: 16px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #ffffff;
            color: #333;
        }

        .form-control:focus {
            border-color: #0d6efd;
            background: white;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
            outline: none;
        }

        .form-control::placeholder {
            color: #6c757d;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 48px;
            cursor: pointer;
            color: #6c757d;
            background: none;
            border: none;
            padding: 4px 8px;
            transition: color 0.2s;
        }

        .password-toggle:hover {
            color: #0d6efd;
        }

        .btn-login {
            width: 100%;
            padding: 14px 20px;
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 16px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(13, 110, 253, 0.25);
        }

        .btn-login:hover {
            background-color: #0a58ca;
            border-color: #0a58ca;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(13, 110, 253, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-login.loading {
            pointer-events: none;
        }

        .spinner-border-sm {
            width: 14px;
            height: 14px;
            margin-right: 8px;
        }

        .form-footer {
            margin-top: 30px;
            padding-top: 24px;
            border-top: 1px solid #f0f0f0;
            text-align: center;
        }

        .form-footer-text {
            color: #6c757d;
            font-size: 14px;
            margin: 0;
        }

        .form-footer-link {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .form-footer-link:hover {
            color: #0a58ca;
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 24px;
            animation: slideIn 0.3s ease;
            padding: 12px 16px;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-left: 4px solid #dc3545;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border-left: 4px solid #28a745;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-container {
                max-width: 100%;
            }

            .card-body {
                padding: 25px 20px;
            }

            .login-title {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Clean header with title -->
            <div class="card-header">
                <img src="{{ asset('img/rumah.png') }}" alt="Logo rumah" style="width: 200px; height: auto;">
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Sign in to your account</p>
            </div>

            <div class="card-body">
                <!-- Error message container -->
                <div id="alertContainer"></div>

                <!-- Form structure -->
                <form id="loginForm" action="{{ Route('loginProses') }}" method="POST">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i>Email Address
                        </label>
                        <input type="email" name="email" class="form-control" placeholder="your@email.com" required
                            autocomplete="email">
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i>Password
                        </label>
                        <div style="position: relative;">
                            <input type="password" name="password" id="passwordInput" class="form-control"
                                placeholder="••••••••" required autocomplete="current-password">
                            <button type="button" class="password-toggle" onclick="togglePasswordVisibility()"
                                aria-label="Toggle password visibility">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>Sign In
                    </button>
                </form>

                <!-- Footer with signup link -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/fontawesome/all.min.js') }}"></script>

    <!-- JavaScript for interactivity -->
    <script>
        // Toggle password visibility
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

        // Form validation and submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.querySelector('input[name="email"]');
            const password = document.querySelector('input[name="password"]');

            // Basic validation
            if (!email.value.trim()) {
                e.preventDefault();
                showAlert('Please enter your email address', 'danger');
                email.focus();
                return;
            }

            if (!password.value) {
                e.preventDefault();
                showAlert('Please enter your password', 'danger');
                password.focus();
                return;
            }

            // Email format validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                e.preventDefault();
                showAlert('Please enter a valid email address', 'danger');
                email.focus();
                return;
            }
        });

        // Show alert messages
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

            // Auto-dismiss after 5 seconds
            setTimeout(() => {
                alertDiv.classList.remove('show');
                setTimeout(() => alertDiv.remove(), 300);
            }, 5000);
        }

        // Keyboard navigation
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && e.target.name === 'password') {
                document.getElementById('loginForm').dispatchEvent(new Event('submit'));
            }
        });
    </script>
</body>

</html>