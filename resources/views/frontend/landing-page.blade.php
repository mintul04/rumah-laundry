<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LaundryHub - Layanan Laundry Online Modern</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet" />

    <!-- Navbar CSS -->
    <link rel="stylesheet" href="assets/css/navbar.css" />
    <style>
        /* ===========================
        NAVBAR STYLES
        ========================== */

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar.navbar-scrolled {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0d6efd !important;
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand svg {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-3px);
            }
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: #333 !important;
            position: relative;
            transition: color 0.3s ease;
            margin: 0 0.5rem;
        }

        .navbar-nav .nav-link:hover {
            color: #0d6efd !important;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #0d6efd;
            transition: width 0.3s ease;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        /* CTA Buttons in Navbar */
        .navbar-cta {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .navbar-cta .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .navbar-cta .btn-outline-primary {
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .navbar-cta .btn-outline-primary:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        }

        .navbar-cta .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            box-shadow: 0 2px 8px rgba(13, 110, 253, 0.25);
        }

        .navbar-cta .btn-primary:hover {
            background-color: #0a58ca;
            border-color: #0a58ca;
            box-shadow: 0 4px 16px rgba(13, 110, 253, 0.4);
        }

        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                margin-top: 1rem;
            }

            .navbar-nav {
                flex-direction: column;
            }

            .navbar-nav .nav-link {
                padding: 0.5rem 0;
                margin: 0 !important;
            }

            .navbar-nav .nav-link::after {
                display: none;
            }

            .navbar-cta {
                flex-direction: column;
                width: 100%;
                margin-top: 1rem;
            }

            .navbar-cta .btn {
                width: 100%;
            }

            .navbar-toggler {
                border: 1px solid #0d6efd;
            }

            .navbar-toggler:focus {
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            }
        }

        /* Sticky navbar scroll effect */
        .navbar-light.navbar-scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>

    <!-- Page CSS -->
    <link rel="stylesheet" href="assets/css/index.css" />
    <style>
        /* ===========================
   PAGE STYLES - LAUNDRY LANDING
   ========================== */

        /* *** COLOR PALETTE ***
   Primary Blue: #0d6efd
   Light Blue: #66b2ff
   Neutral Gray: #f6f7fb
   Accent Yellow: #fbbf24
   Accent Green: #10b981
   Accent Red: #ef4444
   Dark Text: #1a1a1a
   Light Text: #666
*/

        :root {
            --color-primary: #0d6efd;
            --color-primary-light: #66b2ff;
            --color-primary-dark: #0a58ca;
            --color-neutral: #f6f7fb;
            --color-neutral-dark: #e9ecef;
            --color-accent-yellow: #fbbf24;
            --color-accent-green: #10b981;
            --color-accent-red: #ef4444;
            --color-text-dark: #1a1a1a;
            --color-text-light: #666;
            --color-white: #ffffff;
            --color-shadow: rgba(0, 0, 0, 0.08);
            --transition-base: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--color-text-dark);
            background-color: var(--color-white);
            line-height: 1.6;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            line-height: 1.2;
        }

        /* ===========================
   HERO SECTION
   ========================== */

        .hero-section {
            padding: 5rem 0;
            background: linear-gradient(135deg, #f0f7ff 0%, var(--color-neutral) 100%);
        }

        .hero-title {
            font-size: 3.5rem;
            color: var(--color-text-dark);
            font-weight: 700;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--color-text-light);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        /* Hero Form */
        .hero-form {
            margin-top: 2rem;
        }

        .hero-search {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(13, 110, 253, 0.15);
        }

        .hero-search .form-control {
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            background-color: var(--color-white);
        }

        .hero-search .form-control:focus {
            box-shadow: none;
            border-color: transparent;
            background-color: var(--color-white);
        }

        .hero-search .btn {
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            white-space: nowrap;
            transition: var(--transition-base);
        }

        .hero-search .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
        }

        /* Trust Indicators */
        .trust-indicators {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
        }

        .indicator {
            display: flex;
            flex-direction: column;
        }

        .indicator strong {
            font-size: 1.5rem;
            color: var(--color-primary);
        }

        .indicator span {
            font-size: 0.9rem;
            color: var(--color-text-light);
        }

        /* Hero Image */
        .hero-image {
            text-align: center;
            animation: bounce 3s ease-in-out infinite;
        }

        .hero-image svg {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 10px 30px rgba(13, 110, 253, 0.1));
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        /* ===========================
   FEATURES SECTION
   ========================== */

        .features-section {
            background-color: var(--color-white);
        }

        .section-header {
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            color: var(--color-text-dark);
            margin-bottom: 0.5rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--color-text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Feature Card */
        .feature-card {
            background-color: var(--color-neutral);
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            transition: var(--transition-base);
            border: 2px solid transparent;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            border-color: var(--color-primary);
            box-shadow: 0 12px 24px rgba(13, 110, 253, 0.15);
        }

        .feature-icon {
            margin-bottom: 1.5rem;
            animation: fadeInScale 0.6s ease-out;
        }

        .feature-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--color-text-dark);
        }

        .feature-card p {
            color: var(--color-text-light);
            font-size: 0.95rem;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* ===========================
   SERVICES SECTION
   ========================== */

        .services-section {
            background-color: var(--color-neutral);
            padding: 5rem 0;
        }

        /* Service Card */
        .service-card {
            background-color: var(--color-white);
            padding: 2rem;
            border-radius: 12px;
            border: 2px solid var(--color-neutral-dark);
            transition: var(--transition-base);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .service-card:hover {
            border-color: var(--color-primary);
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.15);
            transform: translateY(-5px);
        }

        .service-card.featured {
            border-color: var(--color-accent-yellow);
            box-shadow: 0 6px 20px rgba(251, 191, 36, 0.15);
            transform: scale(1.02);
        }

        .badge-featured {
            position: absolute;
            top: -12px;
            right: 20px;
            background-color: var(--color-accent-yellow);
            color: var(--color-text-dark);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .service-icon {
            margin-bottom: 1.5rem;
        }

        .service-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--color-text-dark);
        }

        .service-desc {
            color: var(--color-text-light);
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .service-price {
            color: var(--color-primary);
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .service-time {
            color: var(--color-text-light);
            font-size: 0.85rem;
            font-style: italic;
            margin-top: auto;
        }

        /* ===========================
   PROCESS SECTION
   ========================== */

        .process-section {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            color: var(--color-white);
            padding: 5rem 0;
        }

        .process-section .section-header h2,
        .process-section .section-subtitle {
            color: var(--color-white);
        }

        .process-stepper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 3rem;
        }

        .process-step {
            flex: 1;
            min-width: 200px;
            text-align: center;
            position: relative;
        }

        .step-number {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--color-accent-yellow);
            color: var(--color-text-dark);
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
            transition: var(--transition-base);
        }

        .process-step:hover .step-number {
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(251, 191, 36, 0.4);
        }

        .process-step h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .process-step p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
        }

        .step-connector {
            flex: 1;
            height: 2px;
            background: rgba(255, 255, 255, 0.3);
            margin: 0 1rem;
            min-width: 40px;
        }

        @media (max-width: 768px) {
            .process-stepper {
                flex-direction: column;
                gap: 2rem;
            }

            .step-connector {
                height: 40px;
                width: 2px;
                margin: 1rem 0;
            }
        }

        /* ===========================
   TESTIMONIALS SECTION
   ========================== */

        .testimonials-section {
            background-color: var(--color-white);
            padding: 5rem 0;
        }

        .testimonial-slider {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .testimonial-card {
            background-color: var(--color-neutral);
            padding: 2rem;
            border-radius: 12px;
            border-left: 4px solid var(--color-primary);
            transition: var(--transition-base);
        }

        .testimonial-card:hover {
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.15);
            transform: translateY(-5px);
        }

        .testimonial-stars {
            color: var(--color-accent-yellow);
            font-size: 1rem;
            margin-bottom: 1rem;
            letter-spacing: 0.1em;
        }

        .testimonial-text {
            color: var(--color-text-dark);
            font-size: 1rem;
            font-style: italic;
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .testimonial-author strong {
            display: block;
            color: var(--color-text-dark);
            margin-bottom: 0.25rem;
        }

        .testimonial-author span {
            color: var(--color-text-light);
            font-size: 0.9rem;
        }

        /* ===========================
   CTA SECTION
   ========================== */

        .cta-section {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            color: var(--color-white);
            padding: 5rem 0;
            text-align: center;
        }

        .cta-content h2 {
            font-size: 2.5rem;
            color: var(--color-white);
            margin-bottom: 1rem;
        }

        .cta-content>p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-section .btn-lg {
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            background-color: var(--color-accent-yellow);
            border-color: var(--color-accent-yellow);
            color: var(--color-text-dark);
            transition: var(--transition-base);
            box-shadow: 0 4px 16px rgba(251, 191, 36, 0.3);
        }

        .cta-section .btn-lg:hover {
            background-color: #f0a500;
            border-color: #f0a500;
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(251, 191, 36, 0.4);
        }

        .cta-content .mt-3 {
            color: rgba(255, 255, 255, 0.9);
        }

        /* ===========================
   FOOTER SECTION
   ========================== */

        .footer-section {
            background-color: #1a1a1a;
            color: #ccc;
            padding: 3rem 0 1rem;
        }

        .footer-section h5 {
            color: var(--color-white);
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .footer-section p {
            font-size: 0.9rem;
            line-height: 1.8;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: #aaa;
            text-decoration: none;
            transition: var(--transition-base);
            font-size: 0.9rem;
        }

        .footer-links a:hover {
            color: var(--color-primary);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--color-primary);
            color: var(--color-white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            transition: var(--transition-base);
            text-decoration: none;
        }

        .social-links a:hover {
            background-color: var(--color-accent-yellow);
            color: var(--color-text-dark);
            transform: translateY(-3px);
        }

        .footer-bottom {
            color: #888;
            font-size: 0.85rem;
        }

        .footer-bottom a {
            color: #aaa;
            text-decoration: none;
        }

        .footer-bottom a:hover {
            color: var(--color-primary);
        }

        /* ===========================
   RESPONSIVE DESIGN
   ========================== */

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .trust-indicators {
                flex-direction: column;
                gap: 1rem;
            }

            .trust-indicators .indicator {
                flex-direction: row;
                justify-content: flex-start;
                gap: 1rem;
            }

            .cta-content h2 {
                font-size: 1.8rem;
            }

            .hero-section {
                padding: 3rem 0;
            }

            .features-section,
            .services-section,
            .process-section,
            .testimonials-section,
            .cta-section {
                padding: 3rem 0;
            }
        }

        /* ===========================
   ANIMATIONS
   ========================== */

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .feature-card,
        .service-card,
        .testimonial-card {
            animation: fadeIn 0.6s ease-out;
        }

        /* Utility: Text Balance for Better Typography */
        h1,
        h2,
        h3 {
            text-wrap: balance;
        }

        p {
            text-wrap: pretty;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#home">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="16" cy="16" r="14" stroke="#0d6efd" stroke-width="2" />
                    <path d="M12 16c0-2.2 1.8-4 4-4s4 1.8 4 4" stroke="#0d6efd" stroke-width="2"
                        stroke-linecap="round" />
                </svg>
                <span class="ms-2">RumahLaundry</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-1">
                </ul>
                <div class="navbar-cta ms-3">
                    <a class="nav-link" href="#">Lihat Pesanan</a>
                    <a href="{{ Route('login') }}"><button class="btn btn-primary">Login</button></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h1 class="hero-title mb-3">Cuci & Setrika Semudah Pesan Makanan</h1>
                    <p class="hero-subtitle mb-4">Jemput dari rumah Anda, kami proses dengan aman, diantar kembali dalam
                        kondisi sempurna.</p>

                    <!-- Hero Form -->
                    <form id="heroForm" class="hero-form mb-4">
                        <div class="input-group hero-search">
                        </div>
                    </form>

                    <!-- Trust Indicators -->
                    <div class="trust-indicators">
                        <div class="indicator">
                        </div>
                        <div class="indicator">
                        </div>
                        <div class="indicator">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Laundry Basket Illustration -->
                            <circle cx="200" cy="200" r="180" fill="#f0f7ff" stroke="#66b2ff"
                                stroke-width="2" />
                            <rect x="100" y="120" width="200" height="180" rx="10" fill="#0d6efd"
                                opacity="0.1" />
                            <path d="M120 140 L280 140 L260 280 L140 280 Z" fill="#66b2ff" stroke="#0d6efd"
                                stroke-width="2" />
                            <circle cx="160" cy="180" r="15" fill="#10b981" />
                            <circle cx="200" cy="160" r="15" fill="#fbbf24" />
                            <circle cx="240" cy="190" r="15" fill="#ef4444" />
                            <path d="M100 140 Q100 80 200 60 Q300 80 300 140" stroke="#0d6efd" stroke-width="2"
                                fill="none" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2>Keunggulan RumahLaundry</h2>
                <p class="section-subtitle">Mengapa ribuan pelanggan mempercayai kami</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="24" r="22" stroke="#0d6efd" stroke-width="2" />
                                <path d="M16 24h16M24 16v16" stroke="#0d6efd" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3>Jemput & Antar</h3>
                        <p>Kami jemput langsung dari rumah Anda tanpa biaya tambahan</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="24" r="22" stroke="#10b981" stroke-width="2" />
                                <path d="M18 24l4 4 10-10" stroke="#10b981" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3>Harga Transparan</h3>
                        <p>Tidak ada biaya tersembunyi, bayar sesuai berat pakaian</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="24" r="22" stroke="#fbbf24" stroke-width="2" />
                                <path d="M24 14v20M16 22h16" stroke="#fbbf24" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3>Express 24 Jam</h3>
                        <p>Layanan kilat untuk kebutuhan mendesak Anda</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="24" r="22" stroke="#ef4444" stroke-width="2" />
                                <path d="M24 18v12M18 24h12" stroke="#ef4444" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3>Laundry Aman</h3>
                        <p>Perlakuan khusus untuk bahan-bahan sensitif Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2>Layanan Kami</h2>
                <p class="section-subtitle">Berbagai paket sesuai kebutuhan Anda</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <circle cx="20" cy="20" r="18" stroke="#0d6efd" stroke-width="2" />
                                <path d="M14 20h12M20 14v12" stroke="#0d6efd" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3>Cuci Biasa</h3>
                        <p class="service-desc">Cucian standar dengan deterjen berkualitas</p>
                        <p class="service-price">Mulai dari <strong>Rp 8.000/kg</strong></p>
                        <p class="service-time">3-4 hari kerja</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="service-card featured">
                        <span class="badge-featured">Populer</span>
                        <div class="service-icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <circle cx="20" cy="20" r="18" stroke="#fbbf24" stroke-width="2" />
                                <path d="M14 20h12M20 14v12" stroke="#fbbf24" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3>Cuci + Setrika</h3>
                        <p class="service-desc">Cucian lengkap dengan setrika profesional</p>
                        <p class="service-price">Mulai dari <strong>Rp 12.000/kg</strong></p>
                        <p class="service-time">2-3 hari kerja</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <circle cx="20" cy="20" r="18" stroke="#10b981" stroke-width="2" />
                                <path d="M14 20h12M20 14v12" stroke="#10b981" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3>Express Service</h3>
                        <p class="service-desc">Layanan kilat dalam 24 jam</p>
                        <p class="service-price">Mulai dari <strong>Rp 15.000/kg</strong></p>
                        <p class="service-time">1 hari kerja</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="process-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2>Bagaimana Cara Kerjanya</h2>
                <p class="section-subtitle">Proses sederhana dalam 4 langkah mudah</p>
            </div>

            <div class="process-stepper">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h3>Pesan</h3>
                    <p>Buka aplikasi, pilih layanan, dan atur jadwal penjemputan</p>
                </div>
                <div class="step-connector"></div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h3>Dijemput</h3>
                    <p>Kurir kami datang sesuai jadwal yang Anda tentukan</p>
                </div>
                <div class="step-connector"></div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h3>Diproses</h3>
                    <p>Baju Anda diproses dengan standar kebersihan tinggi</p>
                </div>
                <div class="step-connector"></div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h3>Diantar</h3>
                    <p>Pakaian Anda diantar kembali dalam kondisi sempurna</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2>Apa Kata Pelanggan Kami</h2>
                <p class="section-subtitle">Ribuan pelanggan puas telah mempercayai kami</p>
            </div>

            <div class="testimonial-slider">
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">"LaundryHub benar-benar menghemat waktu saya! Kurirnya ramah dan
                        pakaian saya selalu bersih sempurna."</p>
                    <div class="testimonial-author">
                        <strong>Siti Nurhaliza</strong>
                        <span>Jakarta</span>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">"Harga transparan dan tidak ada biaya tersembunyi. Layanan express-nya
                        sangat membantu untuk kebutuhan mendesak."</p>
                    <div class="testimonial-author">
                        <strong>Ahmad Gunawan</strong>
                        <span>Bandung</span>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">"Pertama kali pakai dan langsung ketagihan. Kurirnya tepat waktu,
                        komunikasi bagus, dan hasil mencuci yang sempurna."</p>
                    <div class="testimonial-author">
                        <strong>Dewi Lestari</strong>
                        <span>Surabaya</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->

    <!-- Footer -->
    <footer id="footer" class="footer-section">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <h5>RumahLaundry</h5>
                    <p>Layanan laundry online terpercaya untuk seluruh keluarga Anda.</p>
                    <div class="social-links">
                        <a href="#" title="Facebook">f</a>
                        <a href="#" title="Instagram">📷</a>
                        <a href="#" title="Twitter">𝕏</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>Layanan</h5>
                    <ul class="footer-links">
                        <li><a href="#services">Cuci Biasa</a></li>
                        <li><a href="#services">Cuci + Setrika</a></li>
                        <li><a href="#services">Express 24 Jam</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Kontak</h5>
                    <p>Email: info@laundryapp.id</p>
                    <p>Telepon: +62 812-3456-7890</p>
                    <p>Jam: 24/7</p>
                </div>
            </div>
            <div class="footer-bottom text-center border-top pt-4">
                <p>&copy; 2025 RumahLaundry. Semua hak dilindungi. | <a href="#">Privasi</a> | <a
                        href="#">Syarat Layanan</a></p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Page JS -->
    <script src="assets/js/index.js"></script>

    <script>
        /**
         * LaundryHub Landing Page - JavaScript
         * Handles interactivity, form validation, and animations
         */

        // ===========================
        // FORM VALIDATION
        // ===========================

        const heroForm = document.getElementById('heroForm');
        const locationInput = document.getElementById('locationInput');

        heroForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const address = locationInput.value.trim();

            if (!address) {
                showAlert('Masukkan alamat Anda terlebih dahulu', 'warning');
                locationInput.focus();
                return;
            }

            if (address.length < 5) {
                showAlert('Alamat terlalu pendek. Masukkan alamat lengkap', 'warning');
                return;
            }

            // Success feedback
            console.log('[v0] Form submitted with address:', address);
            showAlert(`Kami akan menjemput dari: ${address}`, 'success');

            // Simulate success action - can be replaced with actual API call
            setTimeout(() => {
                console.log('[v0] Redirecting to booking page...');
                // In real app: window.location.href = '/booking';
            }, 1500);
        });

        // ===========================
        // NAVBAR SCROLL EFFECT
        // ===========================

        const navbar = document.getElementById('navbar');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.scrollY;

            if (currentScroll > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }

            lastScroll = currentScroll;
        });

        // ===========================
        // CTA BUTTON HANDLER
        // ===========================

        function handleCTA() {
            console.log('[v0] CTA button clicked');
            showAlert('Terima kasih! Segera mendaftar...', 'info');
            // In real app: window.location.href = '/signup';
        }

        // ===========================
        // ALERT/NOTIFICATION SYSTEM
        // ===========================

        function showAlert(message, type = 'info') {
            // Remove existing alerts
            const existingAlerts = document.querySelectorAll('.custom-alert');
            existingAlerts.forEach((alert) => alert.remove());

            // Create alert element
            const alertDiv = document.createElement('div');
            alertDiv.className = `custom-alert alert alert-${type}`;
            alertDiv.innerHTML = `
        <div style="max-width: 600px; margin: 0 auto; padding: 1rem; border-radius: 8px; background: ${getAlertColor(type)}; color: white; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            ${message}
        </div>
    `;

            document.body.insertBefore(alertDiv, document.body.firstChild);

            // Auto remove after 3 seconds
            setTimeout(() => {
                alertDiv.style.opacity = '0';
                alertDiv.style.transition = 'opacity 0.3s ease';
                setTimeout(() => alertDiv.remove(), 300);
            }, 3000);
        }

        function getAlertColor(type) {
            const colors = {
                success: '#10b981',
                warning: '#fbbf24',
                error: '#ef4444',
                info: '#0d6efd',
            };
            return colors[type] || colors['info'];
        }

        // ===========================
        // SMOOTH SCROLL NAVIGATION
        // ===========================

        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                // Skip if href is just '#'
                if (href === '#' || href === '#') return;

                e.preventDefault();
                const target = document.querySelector(href);

                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                    });
                }
            });
        });

        // ===========================
        // INTERSECTION OBSERVER - LAZY ANIMATIONS
        // ===========================

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px',
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeIn 0.6s ease-out forwards';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe feature cards, service cards, and testimonials
        document.querySelectorAll('.feature-card, .service-card, .testimonial-card, .process-step').forEach((el) => {
            observer.observe(el);
        });

        // ===========================
        // KEYBOARD ACCESSIBILITY
        // ===========================

        // Make buttons keyboard accessible
        document.querySelectorAll('.btn, a, [role="button"]').forEach((element) => {
            element.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });

        // ===========================
        // INITIALIZE ON LOAD
        // ===========================

        document.addEventListener('DOMContentLoaded', () => {
            console.log('[v0] LaundryHub landing page loaded successfully');

            // Add loading animation indicator
            const preloader = document.createElement('div');
            preloader.style.display = 'none';
            document.body.appendChild(preloader);
        });

        // ===========================
        // PERFORMANCE: Debounce function
        // ===========================

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Debounced scroll event for better performance
        const debouncedScroll = debounce(() => {
            console.log('[v0] Scroll event (debounced)');
        }, 250);

        window.addEventListener('scroll', debouncedScroll);
    </script>
</body>

</html>
