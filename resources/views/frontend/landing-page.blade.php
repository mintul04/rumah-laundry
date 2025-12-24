<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RumahLaundry - Layanan Laundry Offline Terpercaya</title>

    <!-- Bootstrap 5 CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="{{ asset('assets/vendor/fontawesome/all.min.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet" />

    <style>
        /* ===========================
        DESIGN SYSTEM & VARIABLES
        ========================== */

        :root {
            /* Brand Colors */
            --clr-primary: #0066FF;
            --clr-primary-light: #3385FF;
            --clr-primary-dark: #0052CC;

            /* Accent Colors */
            --clr-accent-teal: #06B6D4;
            --clr-accent-emerald: #10B981;
            --clr-accent-amber: #F59E0B;

            /* Neutral Palette */
            --clr-neutral-50: #F9FAFB;
            --clr-neutral-100: #F3F4F6;
            --clr-neutral-200: #E5E7EB;
            --clr-neutral-700: #374151;
            --clr-neutral-900: #111827;

            /* Semantic Colors */
            --clr-white: #FFFFFF;
            --clr-text-primary: #111827;
            --clr-text-secondary: #6B7280;

            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);

            /* Radius */
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;

            /* Transitions */
            --transition-base: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===========================
        BASE STYLES
        ========================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--clr-text-primary);
            background-color: var(--clr-white);
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            line-height: 1.2;
            color: var(--clr-text-primary);
        }

        /* ===========================
        NAVBAR STYLES
        ========================== */

        .navbar-landing {
            background-color: var(--clr-white);
            box-shadow: var(--shadow-sm);
            padding: 1rem 0;
            transition: var(--transition-base);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--clr-neutral-100);
        }

        .navbar-landing.navbar-scrolled {
            box-shadow: var(--shadow-md);
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
        }

        .navbar-brand-custom {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--clr-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-base);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .navbar-brand-custom:hover {
            color: var(--clr-primary-dark);
            transform: translateY(-1px);
        }

        .brand-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--clr-primary), var(--clr-accent-teal));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-md);
        }

        .brand-icon i {
            color: var(--clr-white);
            font-size: 1rem;
        }

        .nav-link-custom {
            font-weight: 500;
            color: var(--clr-text-secondary);
            position: relative;
            transition: var(--transition-base);
            margin: 0 0.5rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.95rem;
            border-radius: var(--radius-sm);
        }

        .nav-link-custom:hover {
            color: var(--clr-primary);
            background-color: var(--clr-neutral-50);
        }

        .btn-nav-outline {
            border: 1.5px solid var(--clr-neutral-200);
            color: var(--clr-text-primary);
            background: var(--clr-white);
            border-radius: var(--radius-md);
            font-weight: 600;
            padding: 0.5rem 1.25rem;
            font-size: 0.9rem;
            transition: var(--transition-base);
        }

        .btn-nav-outline:hover {
            background: var(--clr-neutral-50);
            border-color: var(--clr-neutral-300);
            color: var(--clr-text-primary);
        }

        .btn-nav-primary {
            background: var(--clr-primary);
            color: var(--clr-white);
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            padding: 0.5rem 1.25rem;
            font-size: 0.9rem;
            transition: var(--transition-base);
            box-shadow: var(--shadow-sm);
        }

        .btn-nav-primary:hover {
            background: var(--clr-primary-dark);
            color: var(--clr-white);
            box-shadow: var(--shadow-md);
            transform: translateY(-1px);
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                margin-top: 1rem;
                background: var(--clr-white);
                padding: 1rem;
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-lg);
                border: 1px solid var(--clr-neutral-100);
            }

            .nav-link-custom {
                margin: 0.25rem 0;
            }

            .navbar-cta-group {
                flex-direction: column;
                width: 100%;
                margin-top: 1rem;
            }

            .navbar-cta-group .btn {
                width: 100%;
            }
        }

        /* ===========================
        HERO SECTION
        ========================== */

        .hero-section {
            padding: 5rem 0 4rem;
            background: linear-gradient(135deg, #F0F9FF 0%, #E0F2FE 50%, #F9FAFB 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(0, 102, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--clr-text-primary);
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .hero-title-highlight {
            color: var(--clr-primary);
            position: relative;
            display: inline-block;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--clr-text-secondary);
            margin-bottom: 2rem;
            line-height: 1.7;
            max-width: 90%;
        }

        .hero-stats-wrapper {
            display: flex;
            gap: 2rem;
            margin-top: 3rem;
            flex-wrap: wrap;
        }

        .stat-card {
            background: var(--clr-white);
            border: 1px solid var(--clr-neutral-100);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            text-align: center;
            min-width: 140px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-base);
        }

        .stat-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
            border-color: var(--clr-primary);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--clr-primary);
            line-height: 1;
            margin-bottom: 0.5rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--clr-text-secondary);
            font-weight: 500;
        }

        .hero-visual {
            text-align: center;
            position: relative;
            animation: float-gentle 6s ease-in-out infinite;
        }

        .hero-visual-inner {
            background: var(--clr-white);
            border: 1px solid var(--clr-neutral-100);
            border-radius: var(--radius-xl);
            padding: 3rem;
            box-shadow: var(--shadow-xl);
            display: inline-block;
        }

        @keyframes float-gentle {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* ===========================
        LOCATION SECTION
        ========================== */

        .location-section {
            background: var(--clr-white);
            padding: 5rem 0;
        }

        .location-card-wrapper {
            background: linear-gradient(135deg, var(--clr-white) 0%, var(--clr-neutral-50) 100%);
            border: 1px solid var(--clr-neutral-200);
            border-radius: var(--radius-xl);
            padding: 3rem;
            box-shadow: var(--shadow-lg);
            transition: var(--transition-base);
            position: relative;
            overflow: hidden;
        }

        .location-card-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--clr-primary), var(--clr-accent-teal));
        }

        .location-card-wrapper:hover {
            box-shadow: var(--shadow-xl);
            transform: translateY(-8px);
        }

        .location-icon-box {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--clr-primary), var(--clr-accent-teal));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .location-icon-box i {
            font-size: 1.75rem;
            color: var(--clr-white);
        }

        .location-card-title {
            font-size: 1.75rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .location-info-list {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0;
        }

        .location-info-list li {
            padding: 0.75rem 0;
            color: var(--clr-text-secondary);
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.95rem;
            border-bottom: 1px solid var(--clr-neutral-100);
        }

        .location-info-list li:last-child {
            border-bottom: none;
        }

        .location-info-list li i {
            color: var(--clr-primary);
            width: 20px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .btn-location {
            background: var(--clr-accent-emerald);
            color: var(--clr-white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-base);
            text-decoration: none;
            font-size: 0.95rem;
            box-shadow: var(--shadow-sm);
        }

        .btn-location:hover {
            background: #059669;
            color: var(--clr-white);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        /* ===========================
        SECTION HEADER
        ========================== */

        .section-header-wrapper {
            margin-bottom: 3.5rem;
            text-align: center;
        }

        .section-title {
            font-size: 2.5rem;
            color: var(--clr-text-primary);
            margin-bottom: 1rem;
            font-weight: 800;
        }

        .section-subtitle {
            font-size: 1.15rem;
            color: var(--clr-text-secondary);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* ===========================
        FEATURES SECTION
        ========================== */

        .features-section {
            background: var(--clr-neutral-50);
            padding: 5rem 0;
        }

        .feature-card-item {
            background: var(--clr-white);
            padding: 2rem 1.5rem;
            border-radius: var(--radius-lg);
            text-align: center;
            transition: var(--transition-base);
            border: 1px solid var(--clr-neutral-200);
            height: 100%;
            box-shadow: var(--shadow-sm);
        }

        .feature-card-item:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-8px);
            border-color: var(--clr-primary);
        }

        .feature-icon-wrapper {
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .feature-icon-circle {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--clr-primary), var(--clr-accent-teal));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: var(--shadow-md);
            transition: var(--transition-base);
        }

        .feature-card-item:hover .feature-icon-circle {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-icon-circle i {
            font-size: 1.5rem;
            color: var(--clr-white);
        }

        .feature-card-title {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            font-weight: 700;
        }

        .feature-card-desc {
            color: var(--clr-text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* ===========================
        SERVICES SECTION
        ========================== */

        .services-section {
            background: var(--clr-white);
            padding: 5rem 0;
        }

        .service-card-item {
            background: var(--clr-white);
            padding: 2rem;
            border-radius: var(--radius-lg);
            border: 1px solid var(--clr-neutral-200);
            transition: var(--transition-base);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-sm);
        }

        .service-card-item:hover {
            border-color: var(--clr-primary);
            box-shadow: var(--shadow-lg);
            transform: translateY(-8px);
        }

        .service-card-item.featured {
            border-color: var(--clr-accent-amber);
            border-width: 2px;
            box-shadow: var(--shadow-md);
        }

        .service-card-item.featured:hover {
            box-shadow: var(--shadow-xl);
        }

        .badge-featured-tag {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--clr-accent-amber);
            color: var(--clr-white);
            padding: 0.375rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: var(--shadow-sm);
        }

        .service-icon-wrapper {
            margin-bottom: 1.5rem;
        }

        .service-icon-circle {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--clr-primary), var(--clr-accent-teal));
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-base);
        }

        .service-card-item.featured .service-icon-circle {
            background: linear-gradient(135deg, var(--clr-accent-amber), #EF4444);
        }

        .service-card-item:hover .service-icon-circle {
            transform: scale(1.1);
        }

        .service-icon-circle i {
            font-size: 1.25rem;
            color: var(--clr-white);
        }

        .service-card-title {
            font-size: 1.35rem;
            margin-bottom: 0.75rem;
            font-weight: 700;
        }

        .service-card-desc {
            color: var(--clr-text-secondary);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            line-height: 1.6;
            flex-grow: 1;
        }

        .service-price-text {
            color: var(--clr-primary);
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 0.5rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .service-card-item.featured .service-price-text {
            color: var(--clr-accent-amber);
        }

        .service-time-text {
            color: var(--clr-text-secondary);
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .service-time-text i {
            color: var(--clr-primary);
            font-size: 0.9rem;
        }

        .service-card-item.featured .service-time-text i {
            color: var(--clr-accent-amber);
        }

        /* ===========================
        PROCESS SECTION (CEK PESANAN)
        ========================== */

        .process-section {
            background: linear-gradient(135deg, var(--clr-primary) 0%, var(--clr-primary-dark) 100%);
            color: var(--clr-white);
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }

        .process-section::before {
            content: '';
            position: absolute;
            top: -20%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .process-section .section-title,
        .process-section .section-subtitle {
            color: var(--clr-white);
        }

        .search-form-wrapper {
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            background: var(--clr-white);
        }

        .search-form-input {
            border: none;
            padding: 1rem 1.5rem;
            font-size: 1.05rem;
            background-color: var(--clr-white);
            color: var(--clr-text-primary);
        }

        .search-form-input:focus {
            box-shadow: none;
            border-color: transparent;
            background-color: var(--clr-white);
            outline: none;
        }

        .search-form-input::placeholder {
            color: var(--clr-text-secondary);
            opacity: 0.7;
        }

        .search-form-btn {
            border: none;
            padding: 1rem 2rem;
            font-weight: 700;
            white-space: nowrap;
            transition: var(--transition-base);
            background: var(--clr-accent-emerald);
            font-size: 1.05rem;
            color: var(--clr-white);
        }

        .search-form-btn:hover {
            background: #059669;
            color: var(--clr-white);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        #statusResult {
            border-radius: var(--radius-lg);
            border: none;
            box-shadow: var(--shadow-xl);
            margin-top: 2rem;
        }

        #statusResult .alert-heading {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        #statusDetail {
            font-size: 0.95rem;
            line-height: 1.8;
        }

        #statusDetail strong {
            color: var(--clr-primary);
            font-weight: 600;
        }

        /* Process Stepper */
        .stepper-wrapper {
            margin-top: 3rem;
        }

        .stepper-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
        }

        .step-item {
            text-align: center;
            position: relative;
        }

        .step-icon-box {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: var(--clr-white);
            box-shadow: var(--shadow-md);
            transition: var(--transition-base);
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .step-item.active .step-icon-box {
            background: var(--clr-accent-emerald);
            border-color: var(--clr-accent-emerald);
            transform: scale(1.15);
            box-shadow: var(--shadow-lg);
        }

        .step-label-text {
            font-size: 0.95rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
            transition: var(--transition-base);
        }

        .step-item.active .step-label-text {
            color: var(--clr-white);
            font-weight: 700;
        }

        .step-connector-line {
            height: 3px;
            background: rgba(255, 255, 255, 0.2);
            margin: 32px 0;
            border-radius: 2px;
            overflow: hidden;
            position: relative;
            flex: 1;
        }

        .step-connector-line::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: var(--clr-accent-emerald);
            border-radius: 2px;
            transition: width 1s ease;
        }

        .step-connector-line.active::after {
            width: 100%;
        }

        /* ===========================
        FOOTER
        ========================== */

        .footer-section {
            background: var(--clr-neutral-900);
            color: var(--clr-neutral-200);
            padding: 4rem 0 1.5rem;
            position: relative;
        }

        .footer-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--clr-primary), var(--clr-accent-teal));
        }

        .footer-title {
            color: var(--clr-white);
            margin-bottom: 1.5rem;
            font-size: 1.15rem;
            font-weight: 700;
        }

        .footer-desc {
            font-size: 0.9rem;
            line-height: 1.7;
            color: var(--clr-neutral-200);
        }

        .footer-links-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links-list li {
            margin-bottom: 0.75rem;
        }

        .footer-link {
            color: var(--clr-neutral-200);
            text-decoration: none;
            transition: var(--transition-base);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-link:hover {
            color: var(--clr-primary);
            padding-left: 5px;
        }

        .social-links-group {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .social-link-item {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--clr-neutral-700);
            color: var(--clr-white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: var(--transition-base);
            text-decoration: none;
        }

        .social-link-item:hover {
            background: var(--clr-primary);
            color: var(--clr-white);
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .footer-bottom {
            color: var(--clr-neutral-200);
            font-size: 0.85rem;
            padding-top: 2rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-bottom a {
            color: var(--clr-neutral-200);
            text-decoration: none;
            transition: var(--transition-base);
        }

        .footer-bottom a:hover {
            color: var(--clr-primary);
        }

        /* ===========================
        RESPONSIVE DESIGN
        ========================== */

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
                max-width: 100%;
            }

            .hero-stats-wrapper {
                gap: 1rem;
                justify-content: center;
            }

            .stat-card {
                min-width: 120px;
                padding: 1.25rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .section-subtitle {
                font-size: 1rem;
            }

            .feature-card-item,
            .service-card-item,
            .location-card-wrapper {
                padding: 1.5rem;
            }

            .step-icon-box {
                width: 56px;
                height: 56px;
                font-size: 1.25rem;
            }

            .hero-section,
            .features-section,
            .services-section,
            .location-section,
            .process-section {
                padding: 4rem 0;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.75rem;
            }

            .search-form-btn {
                padding: 1rem 1.5rem;
                font-size: 1rem;
            }

            .stepper-row {
                flex-direction: column;
                gap: 1.5rem;
            }

            .step-connector-line {
                display: none;
            }
        }

        /* ===========================
        UTILITIES
        ========================== */

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar-landing navbar navbar-expand-lg navbar-light" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand-custom text-decoration-none" href="#home">
                @if ($pengaturan->logo)
                    <div class="brand-icon">
                        <img src="{{ Storage::url($pengaturan->logo) }}"
                            alt="Logo {{ $pengaturan->nama_laundry ?? 'RumahLaundry' }}"
                            style="width: 32px; height: 32px; object-fit: contain; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,.1);">
                    </div>
                @else
                    <div class="brand-icon">
                        <i class="fas fa-water text-white"></i>
                    </div>
                @endif
                <span>{{ $pengaturan->nama_laundry ?? 'RumahLaundry' }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link-custom text-decoration-none" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom text-decoration-none" href="#location">Lokasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom text-decoration-none" href="#features">Keunggulan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom text-decoration-none" href="#services">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom text-decoration-none" href="#process">Cek Pesanan</a>
                    </li>
                </ul>

                <div class="navbar-cta ms-3">

                    <div class="navbar-cta-group ms-lg-3 d-flex gap-2">
                        <a href="{{ Route('login') }}"><button class="btn btn-nav-primary">Login</button></a>

                    </div>
                </div>
            </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h1 class="hero-title">
                        Cuci & Setrika <span class="hero-title-highlight">Semudah</span> Pesan Makanan
                    </h1>
                    <p class="hero-subtitle">
                        Laundry offline terpercaya dengan layanan cuci & setrika yang wangi dan berkualitas tinggi untuk
                        keluarga
                        Anda.
                    </p>

                    <!-- Hero Stats -->
                    <div class="hero-stats-wrapper">
                        <div class="stat-card">
                            <div class="stat-number">10K+</div>
                            <div class="stat-label">Pelanggan Setia</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Layanan</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">99%</div>
                            <div class="stat-label">Kepuasan</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-visual">
                        <div class="hero-visual-inner">
                            <svg width="300" height="300" viewBox="0 0 300 300" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <!-- Washing Machine Illustration -->
                                <rect x="75" y="50" width="150" height="200" rx="12" fill="#F0F9FF"
                                    stroke="#0066FF" stroke-width="2" />
                                <rect x="90" y="70" width="120" height="30" rx="6" fill="#E0F2FE" />
                                <!-- Circles for buttons -->
                                <circle cx="110" cy="85" r="5" fill="#0066FF" />
                                <circle cx="130" cy="85" r="5" fill="#06B6D4" />
                                <circle cx="150" cy="85" r="5" fill="#10B981" />
                                <!-- Main drum -->
                                <circle cx="150" cy="150" r="50" fill="white" stroke="#0066FF"
                                    stroke-width="3" />
                                <circle cx="150" cy="150" r="35" fill="#E0F2FE" stroke="#0066FF"
                                    stroke-width="2" />
                                <!-- Inner details -->
                                <circle cx="150" cy="150" r="20" fill="white" stroke="#0066FF"
                                    stroke-width="1.5" />
                                <!-- Clothes -->
                                <rect x="100" y="210" width="25" height="30" rx="4" fill="#10B981"
                                    opacity="0.8" />
                                <rect x="135" y="210" width="25" height="30" rx="4" fill="#F59E0B"
                                    opacity="0.8" />
                                <rect x="170" y="210" width="25" height="30" rx="4" fill="#0066FF"
                                    opacity="0.8" />
                                <!-- Bubbles -->
                                <circle cx="120" cy="120" r="6" fill="#06B6D4" opacity="0.5" />
                                <circle cx="180" cy="130" r="5" fill="#06B6D4" opacity="0.4" />
                                <circle cx="160" cy="110" r="7" fill="#06B6D4" opacity="0.6" />
                                <!-- Sparkles -->
                                <path d="M150 40 L152 47 L159 49 L152 51 L150 58 L148 51 L141 49 L148 47 Z"
                                    fill="#F59E0B" opacity="0.7" />
                                <path d="M220 140 L222 145 L227 147 L222 149 L220 154 L218 149 L213 147 L218 145 Z"
                                    fill="#10B981" opacity="0.7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section id="location" class="location-section">
        <div class="container">
            <div class="section-header-wrapper">
                <h2 class="section-title">Lokasi Laundry Kami</h2>
                <p class="section-subtitle">Datang langsung ke outlet kami karena kami menggunakan layanan laundry
                    terpercaya
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="location-card-wrapper">
                        <div class="location-icon-box">
                            <i class="fas fa-store text-white"></i>
                        </div>
                        <h3 class="location-card-title">{{ $pengaturan->nama_laundry ?? 'RumahLaundry' }} Central</h3>
                        <p class="mb-4" style="color: var(--clr-text-secondary);">Outlet utama kami dengan fasilitas
                            lengkap dan
                            staf profesional siap melayani Anda.</p>

                        <ul class="location-info-list">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $pengaturan->alamat_laundry }}</span>
                            </li>
                            <li>
                                <i class="fas fa-clock"></i>
                                <span>Buka 24/7 jam</span>
                            </li>
                            <li>
                                <i class="fas fa-phone"></i>
                                <span>{{ $pengaturan->telepon_laundry ?? '+62 812-3456-7890' }}</span>
                            </li>
                            <li>
                                <i class="fas fa-wifi"></i>
                                <span>Free WiFi untuk pelanggan</span>
                            </li>
                            <li>
                                <i class="fas fa-parking"></i>
                                <span>Area parkir luas & aman</span>
                            </li>
                        </ul>

                        <div class="d-flex gap-3 flex-wrap mt-4">
                            <a href="https://maps.google.com" target="_blank" class="btn-location">
                                <i class="fas fa-directions"></i> Petunjuk Arah
                            </a>
                            <a href="https://wa.me/{{ $pengaturan->telepon ?? '6281234567890' }}" target="_blank"
                                class="btn"
                                style="background: var(--clr-white); color: var(--clr-text-primary); border: 1.5px solid var(--clr-neutral-200); padding: 0.75rem 1.5rem; border-radius: var(--radius-md); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: var(--transition-base);">
                                <i class="fas fa-phone"></i> Telepon Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="section-header-wrapper">
                <h2 class="section-title">Keunggulan {{ $pengaturan->nama_laundry ?? 'RumahLaundry' }}</h2>
                <p class="section-subtitle">Mengapa ribuan pelanggan mempercayai laundry kami</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card-item fade-in-up" style="animation-delay: 0.1s;">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-circle">
                                <i class="fas fa-user-shield text-white"></i>
                            </div>
                        </div>
                        <h3 class="feature-card-title">Laundry Terpercaya</h3>
                        <p class="feature-card-desc">Tim kami terdiri dari profesional yang berpengalaman dan memiliki
                            standar
                            kualitas terbaik</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card-item fade-in-up" style="animation-delay: 0.2s;">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-circle">
                                <i class="fas fa-tag text-white"></i>
                            </div>
                        </div>
                        <h3 class="feature-card-title">Harga Jelas</h3>
                        <p class="feature-card-desc">Tidak ada biaya tersembunyi, bayar sesuai berat dengan timbangan
                            digital</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card-item fade-in-up" style="animation-delay: 0.3s;">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-circle">
                                <i class="fas fa-bolt text-white"></i>
                            </div>
                        </div>
                        <h3 class="feature-card-title">Express 24 Jam</h3>
                        <p class="feature-card-desc">Layanan kilat untuk kebutuhan mendesak dengan proses maksimal 24
                            jam</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card-item fade-in-up" style="animation-delay: 0.4s;">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-circle">
                                <i class="fas fa-shield-alt text-white"></i>
                            </div>
                        </div>
                        <h3 class="feature-card-title">Laundry Aman</h3>
                        <p class="feature-card-desc">Perlakuan khusus untuk bahan-bahan sensitif dengan deterjen
                            hipoalergenik</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <div class="section-header-wrapper">
                <h2 class="section-title">Layanan Kami</h2>
                <p class="section-subtitle">Yang Paling Rekomend Buat Anda</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="service-card-item fade-in-up" style="animation-delay: 0.1s;">
                        <div class="service-icon-wrapper">
                            <div class="service-icon-circle">
                                <i class="fas fa-soap text-white"></i>
                            </div>
                        </div>
                        <img src="{{ asset('img/cuci biasa.jpg') }}" alt="Cuci Biasa"
                            style="height: 150px; width: auto; object-fit: contain; border-radius: 6px;">
                        <h3 class="service-card-title">Cuci Biasa</h3>
                        <p class="service-card-desc">Cucian standar dengan deterjen berkualitas tinggi dan pewangi
                            pilihan</p>
                        <p class="service-price-text">Mulai dari <strong>Rp 5.000/Pcs</strong></p>
                        <p class="service-time-text">
                            <i class="far fa-clock"></i> 3-4 hari kerja
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="service-card-item featured fade-in-up" style="animation-delay: 0.2s;">
                        <span class="badge-featured-tag">Paling Populer</span>
                        <div class="service-icon-wrapper">
                            <div class="service-icon-circle">
                                <i class="fas fa-star text-white"></i>
                            </div>
                        </div>
                        <img src="{{ asset('img/cuci express.png') }}" alt="Express 24 Jam"
                            style="height: 150px; width: auto; object-fit: contain; border-radius: 6px;">
                        <h3 class="service-card-title">Cuci Express/Regular</h3>
                        <p class="service-card-desc">Layanan kilat dalam 24 jam untuk kebutuhan mendesak</p>
                        <p class="service-price-text">Mulai dari <strong>Rp 10.000/kg</strong></p>
                        <p class="service-time-text">
                            <i class="far fa-clock"></i> 1 hari kerja
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="service-card-item fade-in-up" style="animation-delay: 0.3s;">
                        <div class="service-icon-wrapper">
                            <div class="service-icon-circle">
                                <i class="fas fa-tshirt text-white"></i>
                            </div>
                        </div>
                        <img src="{{ asset('img/cuci setrika.jpg') }}" alt="Cuci + Setrika"
                            style="height: 150px; width: auto; object-fit: contain; border-radius: 6px;">
                        <h3 class="service-card-title">Cuci + Setrika</h3>
                        <p class="service-card-desc">Cucian lengkap dengan setrika profesional dan lipatan rapi</p>
                        <p class="service-price-text">Mulai dari <strong>Rp 8.000/Lusin</strong></p>
                        <p class="service-time-text">
                            <i class="far fa-clock"></i> 2-3 hari kerja
                        </p>
                    </div>
                </div>
            </div>
            <section id="services" class="services-section">
                <div class="container">
                    <div class="section-header-wrapper">
                        <h2 class="section-title">Dan Masih Banyak Lainnya</h2>
                        <p class="section-subtitle">Berbagai paket laundry sesuai kebutuhan Anda</p>
                    </div>
                </div>
            </section>
    </section>

    <!-- Process Section (Cek Status) -->
    <section id="process" class="process-section">
        <div class="container">
            <div class="section-header-wrapper">
                <h2 class="section-title">Cek Status Pesanan Anda</h2>
                <p class="section-subtitle">Masukkan kode pesanan anda untuk melihat status: Baru, Diproses, Selesai, atau
                    Diambil
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <form id="statusForm" class="search-form-wrapper mb-4">
                        @csrf
                        <div class="input-group">
                            <input type="text" id="orderCode" class="form-control search-form-input"
                                placeholder="Contoh: ORD-000001" required>
                            <button class="btn search-form-btn" type="submit">
                                <i class="fas fa-search me-2"></i>Cek Status
                            </button>
                        </div>
                    </form>

                    <div id="statusResult" class="alert d-none" role="alert">
                        <h5 class="alert-heading">Status Pesanan: <span id="statusText"></span></h5>
                        <p id="statusDetail" class="mb-0"></p>
                    </div>
                </div>
            </div>

            <div class="stepper-wrapper">
                <div class="stepper-row">
                    <div class="step-item">
                        <div class="step-icon-box">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="step-label-text">Baru</div>
                    </div>
                    <div class="step-connector-line"></div>
                    <div class="step-item">
                        <div class="step-icon-box">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="step-label-text">Diproses</div>
                    </div>
                    <div class="step-connector-line"></div>
                    <div class="step-item">
                        <div class="step-icon-box">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="step-label-text">Selesai</div>
                    </div>
                    <div class="step-connector-line"></div>
                    <div class="step-item">
                        <div class="step-icon-box">
                            <i class="fas fa-hand-holding"></i>
                        </div>
                        <div class="step-label-text">Diambil</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer" class="footer-section">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <h5 class="footer-title">{{ $pengaturan->nama_laundry ?? 'RumahLaundry' }}</h5>
                    <p class="footer-desc">Layanan laundry offline terpercaya dengan standar kebersihan tinggi dan
                        pelayanan
                        maksimal untuk seluruh keluarga Anda.</p>
                    <div class="social-links-group">
                        <a href="#" class="social-link-item" title="Facebook"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link-item" title="Instagram"><i
                                class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link-item" title="WhatsApp"><i
                                class="fab fa-whatsapp"></i></a>
                        <a href="#" class="social-link-item" title="Maps"><i
                                class="fas fa-map-marker-alt"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5 class="footer-title">Layanan</h5>
                    <ul class="footer-links-list">
                        <li><a href="#services" class="footer-link">Cuci Biasa</a></li>
                        <li><a href="#services" class="footer-link">Cuci + Setrika</a></li>
                        <li><a href="#services" class="footer-link">Express 24 Jam</a></li>
                        <li><a href="#services" class="footer-link">Layanan Khusus</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="footer-title">Kontak & Lokasi</h5>
                    <p class="footer-desc"><i class="fas fa-map-marker-alt me-2"></i>
                        {{ $pengaturan->alamat_laundry ?? ' Jl. Laundry No. 123, Jakarta' }}</p>
                    <p class="footer-desc"><i class="fas fa-phone me-2"></i>
                        +{{ $pengaturan->telepon_laundry ?? '62 812-3456-7890' }}</p>
                    <p class="footer-desc"><i class="fas fa-envelope me-2"></i>
                        {{ $pengaturan->email_laundry ?? 'info@rumahlaundry.id' }}</p>
                    <p class="footer-desc"><i class="fas fa-clock me-2"></i> Buka 24/7</p>
                </div>
            </div>
            <div class="footer-bottom text-center">
                <p>&copy; 2025 RumahLaundry. Semua hak dilindungi. | <a href="#">Kebijakan Privasi</a> | <a
                        href="#">Syarat
                        Layanan</a> | <a href="{{ Route('login') }}">Admin Area</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/fontawesome/all.min.js') }}"></script>

    <script>
        /**
         * RumahLaundry Landing Page - JavaScript
         * Professional, production-ready code
         */

        (function() {
            'use strict';

            // ===========================
            // NAVBAR SCROLL EFFECT
            // ===========================

            const navbar = document.getElementById('mainNavbar');
            let lastScrollTop = 0;

            function handleNavbarScroll() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 50) {
                    navbar.classList.add('navbar-scrolled');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                }

                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
            }

            window.addEventListener('scroll', handleNavbarScroll, {
                passive: true
            });

            // ===========================
            // SMOOTH SCROLL NAVIGATION
            // ===========================

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');

                    if (href === '#' || href === '#') {
                        return;
                    }

                    const target = document.querySelector(href);

                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                        // Close mobile menu if open
                        const navbarCollapse = document.getElementById('navbarContent');
                        if (navbarCollapse.classList.contains('show')) {
                            const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                                toggle: true
                            });
                        }
                    }
                });
            });

            // ===========================
            // ORDER STATUS CHECK FORM
            // ===========================

            const statusForm = document.getElementById('statusForm');
            const orderCodeInput = document.getElementById('orderCode');
            const statusResult = document.getElementById('statusResult');
            const statusText = document.getElementById('statusText');
            const statusDetail = document.getElementById('statusDetail');
            const stepItems = document.querySelectorAll('.step-item');
            const stepConnectors = document.querySelectorAll('.step-connector-line');

            statusForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const noOrder = orderCodeInput.value.trim();

                if (!noOrder) {
                    showStatusResult('warning', 'Peringatan', 'Silakan masukkan nomor order yang valid.');
                    return;
                }

                const submitBtn = statusForm.querySelector('button[type="submit"]');
                const originalHTML = submitBtn.innerHTML;

                // Show loading state
                submitBtn.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                submitBtn.disabled = true;

                try {
                    const csrfToken = document.querySelector('input[name="_token"]').value;

                    const response = await fetch('{{ route('cek.status') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            no_order: noOrder
                        })
                    });

                    if (!response.ok) {
                        let errorMessage = `Server Error (${response.status})`;
                        try {
                            const errorData = await response.json();
                            errorMessage = errorData.message || errorMessage;
                        } catch (e) {
                            errorMessage = await response.text() || errorMessage;
                        }
                        throw new Error(errorMessage);
                    }

                    const result = await response.json();

                    if (result.success) {
                        const data = result.data;
                        const statusOrderText = data.status_order.charAt(0).toUpperCase() + data
                            .status_order.slice(1);

                        // Build detail HTML with required data
                        const detailHTML = `
                            <strong>Nama:</strong> ${data.nama_pelanggan}<br>
                            <strong>Tanggal Terima:</strong> ${data.tanggal_terima}<br>
                            <strong>Tanggal Selesai:</strong> ${data.tanggal_selesai}<br>
                            <strong>Total Bayar:</strong> ${data.total}<br>
                            <strong>Status Pembayaran:</strong> ${data.pembayaran}
                        `;

                        // Determine alert class based on status
                        let alertClass = 'alert-info';
                        switch (data.status_order) {
                            case 'baru':
                                alertClass = 'alert-warning';
                                break;
                            case 'diproses':
                                alertClass = 'alert-info';
                                break;
                            case 'selesai':
                                alertClass = 'alert-success';
                                break;
                            case 'diambil':
                                alertClass = 'alert-primary';
                                break;
                        }

                        showStatusResult(alertClass.replace('alert-', ''), statusOrderText, detailHTML);
                        updateStepperProgress(data.status_order);

                    } else {
                        showStatusResult('danger', 'Gagal', result.message || 'Status tidak ditemukan.');
                        resetStepper();
                    }

                } catch (error) {
                    console.error('Fetch Error:', error);
                    showStatusResult('danger', 'Error', `Terjadi kesalahan: ${error.message}`);
                    resetStepper();
                } finally {
                    submitBtn.innerHTML = originalHTML;
                    submitBtn.disabled = false;
                }
            });

            // Helper: Show status result
            function showStatusResult(type, title, detail) {
                statusResult.className = `alert alert-${type} d-block`;
                statusText.textContent = title;
                statusDetail.innerHTML = detail;
            }

            // Helper: Update stepper progress
            function updateStepperProgress(status) {
                const statusMap = {
                    'baru': 0,
                    'diproses': 1,
                    'selesai': 2,
                    'diambil': 3
                };

                const activeIndex = statusMap[status] !== undefined ? statusMap[status] : -1;

                // Reset all steps
                stepItems.forEach(item => item.classList.remove('active'));
                stepConnectors.forEach(connector => connector.classList.remove('active'));

                // Activate steps up to current status
                for (let i = 0; i <= activeIndex && i < stepItems.length; i++) {
                    stepItems[i].classList.add('active');
                    if (i < stepConnectors.length) {
                        stepConnectors[i].classList.add('active');
                    }
                }
            }

            // Helper: Reset stepper
            function resetStepper() {
                stepItems.forEach(item => item.classList.remove('active'));
                stepConnectors.forEach(connector => connector.classList.remove('active'));
            }

            // ===========================
            // ANIMATION ON SCROLL
            // ===========================

            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const fadeInObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.fade-in-up').forEach(el => {
                fadeInObserver.observe(el);
            });

            // ===========================
            // INITIALIZE ON LOAD
            // ===========================

            document.addEventListener('DOMContentLoaded', () => {
                console.log('RumahLaundry Landing Page loaded');
            });

        })();
    </script>
</body>

</html>
