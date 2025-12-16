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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />

    <style>
        /* ===========================
        NAVBAR STYLES - MODIFIED
        ========================== */

        .navbar {
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar.navbar-scrolled {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 800;
            color: #2d8cff !important;
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            color: #1a73e8 !important;
        }

        .navbar-brand svg {
            animation: float 3s ease-in-out infinite;
            filter: drop-shadow(0 2px 4px rgba(45, 140, 255, 0.3));
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            color: #444 !important;
            position: relative;
            transition: all 0.3s ease;
            margin: 0 0.75rem;
            padding: 0.5rem 0;
            font-size: 1rem;
        }

        .navbar-nav .nav-link:hover {
            color: #2d8cff !important;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #2d8cff, #6ab0ff);
            border-radius: 2px;
            transition: width 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        /* CTA Buttons in Navbar */
        .navbar-cta {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .navbar-cta .btn {
            border-radius: 10px;
            font-weight: 700;
            padding: 0.6rem 1.5rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-cta .btn-outline-primary {
            border: 2px solid #2d8cff;
            color: #2d8cff;
            background: transparent;
        }

        .navbar-cta .btn-outline-primary:hover {
            background: linear-gradient(135deg, #2d8cff, #6ab0ff);
            border-color: transparent;
            color: #fff;
            box-shadow: 0 6px 20px rgba(45, 140, 255, 0.4);
            transform: translateY(-3px);
        }

        .navbar-cta .btn-primary {
            background: linear-gradient(135deg, #2d8cff, #1a73e8);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(45, 140, 255, 0.35);
        }

        .navbar-cta .btn-primary:hover {
            background: linear-gradient(135deg, #1a73e8, #2d8cff);
            box-shadow: 0 6px 25px rgba(45, 140, 255, 0.5);
            transform: translateY(-3px);
        }

        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                margin-top: 1.5rem;
                background: white;
                padding: 1.5rem;
                border-radius: 12px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            }

            .navbar-nav {
                flex-direction: column;
                gap: 0.5rem;
            }

            .navbar-nav .nav-link {
                padding: 0.75rem 1rem;
                margin: 0 !important;
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .navbar-nav .nav-link:hover {
                background: rgba(45, 140, 255, 0.1);
                transform: translateX(5px);
            }

            .navbar-cta {
                flex-direction: column;
                width: 100%;
                margin-top: 1.5rem;
                gap: 1rem;
            }

            .navbar-cta .btn {
                width: 100%;
            }

            .navbar-toggler {
                border: 2px solid #2d8cff;
                padding: 0.5rem 0.75rem;
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .navbar-toggler:hover {
                background: rgba(45, 140, 255, 0.1);
                transform: rotate(90deg);
            }

            .navbar-toggler:focus {
                box-shadow: 0 0 0 0.35rem rgba(45, 140, 255, 0.25);
            }
        }

        /* Sticky navbar scroll effect */
        .navbar-light.navbar-scrolled {
            background-color: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* ===========================
   PAGE STYLES - LAUNDRY OFFLINE LANDING
   ========================== */

        /* *** COLOR PALETTE ***
   Primary Blue: #2d8cff
   Secondary Blue: #6ab0ff
   Accent Teal: #20c997
   Accent Orange: #fd7e14
   Neutral: #f8f9fa
   Dark: #212529
*/

        :root {
            --color-primary: #2d8cff;
            --color-primary-light: #6ab0ff;
            --color-primary-dark: #1a73e8;
            --color-accent-teal: #20c997;
            --color-accent-orange: #fd7e14;
            --color-neutral: #f8f9fa;
            --color-neutral-dark: #e9ecef;
            --color-text-dark: #212529;
            --color-text-light: #6c757d;
            --color-white: #ffffff;
            --color-shadow: rgba(0, 0, 0, 0.08);
            --transition-base: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            overflow-x: hidden;
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
   HERO SECTION - MODIFIED FOR OFFLINE LAUNDRY
   ========================== */

        .hero-section {
            padding: 6rem 0 5rem;
            background: linear-gradient(135deg, #f0f8ff 0%, #e6f2ff 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 60%;
            height: 200%;
            background: linear-gradient(45deg, rgba(45, 140, 255, 0.05) 0%, rgba(106, 176, 255, 0.1) 100%);
            transform: rotate(30deg);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }

        .hero-title {
            font-size: 3.5rem;
            color: var(--color-text-dark);
            font-weight: 800;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
            line-height: 1.1;
            position: relative;
            display: inline-block;
        }

        .hero-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 120px;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-accent-teal));
            border-radius: 3px;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--color-text-light);
            margin-bottom: 2.5rem;
            line-height: 1.7;
            max-width: 90%;
        }

        .highlight-text {
            color: var(--color-primary);
            font-weight: 700;
            position: relative;
            display: inline-block;
        }

        .highlight-text::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            width: 100%;
            height: 8px;
            background: rgba(45, 140, 255, 0.2);
            z-index: -1;
            border-radius: 4px;
        }

        /* Hero Stats */
        .hero-stats {
            display: flex;
            gap: 3rem;
            margin-top: 3rem;
            flex-wrap: wrap;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.5rem;
            background: var(--color-white);
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            transition: var(--transition-base);
            min-width: 150px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .stat-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-accent-teal));
        }

        .stat-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.12);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--color-primary);
            line-height: 1;
            margin-bottom: 0.5rem;
            font-family: 'Poppins', sans-serif;
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--color-text-light);
            text-align: center;
            font-weight: 500;
        }

        /* Hero Image */
        .hero-image {
            text-align: center;
            position: relative;
            animation: float3D 6s ease-in-out infinite;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .hero-image svg {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 20px 40px rgba(45, 140, 255, 0.2));
            transform: translateZ(20px);
        }

        @keyframes float3D {

            0%,
            100% {
                transform: translateY(0) rotateX(0) rotateY(0);
            }

            25% {
                transform: translateY(-15px) rotateX(5deg) rotateY(2deg);
            }

            75% {
                transform: translateY(-10px) rotateX(-3deg) rotateY(-1deg);
            }
        }

        /* ===========================
   LOCATION SECTION - NEW FOR OFFLINE LAUNDRY
   ========================== */

        .location-section {
            background: var(--color-white);
            padding: 5rem 0;
        }

        .location-card {
            background: linear-gradient(135deg, var(--color-white) 0%, var(--color-neutral) 100%);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(45, 140, 255, 0.1);
            position: relative;
            overflow: hidden;
            transition: var(--transition-base);
        }

        .location-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(45, 140, 255, 0.15);
            border-color: rgba(45, 140, 255, 0.3);
        }

        .location-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-accent-teal));
        }

        .location-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 20px rgba(45, 140, 255, 0.3);
        }

        .location-icon i {
            font-size: 2rem;
            color: white;
        }

        .location-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--color-text-dark);
        }

        .location-info {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0;
        }

        .location-info li {
            padding: 0.5rem 0;
            color: var(--color-text-light);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .location-info li i {
            color: var(--color-primary);
            width: 20px;
        }

        .location-btn {
            background: linear-gradient(135deg, var(--color-accent-teal), #17a589);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-base);
            text-decoration: none;
        }

        .location-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(32, 201, 151, 0.3);
            color: white;
        }

        /* ===========================
   FEATURES SECTION - MODIFIED
   ========================== */

        .features-section {
            background: var(--color-neutral);
            padding: 5rem 0;
            position: relative;
        }

        .section-header {
            margin-bottom: 4rem;
            text-align: center;
            position: relative;
        }

        .section-header h2 {
            font-size: 2.8rem;
            color: var(--color-text-dark);
            margin-bottom: 1rem;
            display: inline-block;
        }

        .section-header h2::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-accent-teal));
            margin: 0.5rem auto;
            border-radius: 2px;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--color-text-light);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Feature Card - Enhanced */
        .feature-card {
            background: var(--color-white);
            padding: 2.5rem 2rem;
            border-radius: 20px;
            text-align: center;
            transition: var(--transition-base);
            border: 2px solid transparent;
            height: 100%;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-accent-teal));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-12px);
            border-color: var(--color-primary-light);
            box-shadow: 0 20px 40px rgba(45, 140, 255, 0.15);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-icon {
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }

        .feature-icon svg {
            filter: drop-shadow(0 4px 8px rgba(45, 140, 255, 0.2));
            transition: transform 0.5s ease;
        }

        .feature-card:hover .feature-icon svg {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-card h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: var(--color-text-dark);
            position: relative;
            display: inline-block;
        }

        .feature-card h3::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 3px;
            background: var(--color-primary);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .feature-card:hover h3::after {
            width: 80px;
        }

        .feature-card p {
            color: var(--color-text-light);
            font-size: 1rem;
            line-height: 1.7;
        }

        /* ===========================
   SERVICES SECTION - MODIFIED
   ========================== */

        .services-section {
            background: var(--color-white);
            padding: 5rem 0;
        }

        /* Service Card - Enhanced */
        .service-card {
            background: var(--color-white);
            padding: 2.5rem;
            border-radius: 20px;
            border: 2px solid var(--color-neutral-dark);
            transition: var(--transition-base);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(45, 140, 255, 0.05) 0%, rgba(106, 176, 255, 0.02) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .service-card:hover {
            border-color: var(--color-primary);
            box-shadow: 0 20px 40px rgba(45, 140, 255, 0.15);
            transform: translateY(-8px);
        }

        .service-card:hover::before {
            opacity: 1;
        }

        .service-card.featured {
            border-color: var(--color-accent-orange);
            box-shadow: 0 12px 32px rgba(253, 126, 20, 0.15);
            transform: scale(1.02);
        }

        .service-card.featured:hover {
            transform: scale(1.02) translateY(-8px);
            box-shadow: 0 20px 50px rgba(253, 126, 20, 0.2);
        }

        .badge-featured {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--color-accent-orange), #fd9843);
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(253, 126, 20, 0.3);
            z-index: 2;
        }

        .service-icon {
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }

        .service-icon svg {
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
            transition: transform 0.5s ease;
        }

        .service-card:hover .service-icon svg {
            transform: scale(1.1);
        }

        .service-card h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: var(--color-text-dark);
            position: relative;
            display: inline-block;
        }

        .service-card h3::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--color-primary);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .service-card:hover h3::after {
            width: 80px;
        }

        .service-card.featured h3::after {
            background: var(--color-accent-orange);
        }

        .service-desc {
            color: var(--color-text-light);
            font-size: 1rem;
            margin-bottom: 1.5rem;
            line-height: 1.7;
            flex-grow: 1;
        }

        .service-price {
            color: var(--color-primary);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            font-family: 'Poppins', sans-serif;
        }

        .service-card.featured .service-price {
            color: var(--color-accent-orange);
        }

        .service-time {
            color: var(--color-text-light);
            font-size: 0.9rem;
            font-style: italic;
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .service-time i {
            color: var(--color-primary);
        }

        .service-card.featured .service-time i {
            color: var(--color-accent-orange);
        }

        /* ===========================
   PROCESS SECTION - MODIFIED
   ========================== */

        .process-section {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            color: var(--color-white);
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }

        .process-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -20%;
            width: 60%;
            height: 200%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.1) 100%);
            transform: rotate(-30deg);
            border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
        }

        .process-section .section-header h2,
        .process-section .section-subtitle {
            color: var(--color-white);
            position: relative;
            z-index: 2;
        }

        .process-section .section-header h2::after {
            background: var(--color-white);
        }

        .hero-search {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            background: white;
            position: relative;
            z-index: 2;
        }

        .hero-search .form-control {
            border: none;
            padding: 1rem 1.5rem;
            font-size: 1.1rem;
            background-color: var(--color-white);
            color: var(--color-text-dark);
        }

        .hero-search .form-control:focus {
            box-shadow: none;
            border-color: transparent;
            background-color: var(--color-white);
        }

        .hero-search .form-control::placeholder {
            color: var(--color-text-light);
            opacity: 0.8;
        }

        .hero-search .btn {
            border: none;
            padding: 1rem 2.5rem;
            font-weight: 700;
            white-space: nowrap;
            transition: var(--transition-base);
            background: linear-gradient(135deg, var(--color-accent-teal), #17a589);
            font-size: 1.1rem;
        }

        .hero-search .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(32, 201, 151, 0.4);
            background: linear-gradient(135deg, #17a589, var(--color-accent-teal));
        }

        #statusResult {
            border-radius: 16px;
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
            margin-top: 2rem;
        }

        #statusResult .alert-heading {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        #statusResult .alert-heading::before {
            content: '📦';
            font-size: 1.5rem;
        }

        #statusDetail {
            font-size: 1rem;
            line-height: 1.8;
        }

        #statusDetail strong {
            color: var(--color-primary);
            font-weight: 600;
        }

        /* Process Stepper - Enhanced */
        .process-stepper {
            position: relative;
            z-index: 2;
        }

        .process-step {
            position: relative;
            text-align: center;
        }

        .step-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.8rem;
            color: white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: var(--transition-base);
            position: relative;
            z-index: 2;
        }

        .step-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            margin-top: 0.5rem;
            transition: var(--transition-base);
        }

        .process-step.active .step-icon {
            transform: scale(1.15);
            box-shadow: 0 12px 30px rgba(255, 255, 255, 0.3);
        }

        .process-step.active .step-label {
            color: var(--color-accent-teal);
            font-weight: 700;
        }

        .step-connector {
            position: relative;
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
            margin: 35px 0;
            border-radius: 2px;
            overflow: hidden;
        }

        .step-connector::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, var(--color-accent-teal), #6effc9);
            border-radius: 2px;
            transition: width 1.5s ease;
        }

        .process-step.active~.step-connector::after {
            width: 100%;
        }

        /* ===========================
   FOOTER - MODIFIED
   ========================== */

        .footer-section {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #ccc;
            padding: 4rem 0 1.5rem;
            position: relative;
        }

        .footer-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-accent-teal));
        }

        .footer-section h5 {
            color: white;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
            font-weight: 700;
            position: relative;
            display: inline-block;
        }

        .footer-section h5::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--color-primary);
            border-radius: 2px;
        }

        .footer-section p {
            font-size: 0.95rem;
            line-height: 1.8;
            color: #aaa;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: #bbb;
            text-decoration: none;
            transition: var(--transition-base);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a::before {
            content: '→';
            opacity: 0;
            transform: translateX(-5px);
            transition: var(--transition-base);
        }

        .footer-links a:hover {
            color: var(--color-primary);
            padding-left: 5px;
        }

        .footer-links a:hover::before {
            opacity: 1;
            transform: translateX(0);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-links a {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: var(--transition-base);
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(45, 140, 255, 0.3);
        }

        .social-links a:hover {
            background: linear-gradient(135deg, var(--color-accent-teal), #17a589);
            transform: translateY(-5px) rotate(10deg);
            box-shadow: 0 8px 25px rgba(32, 201, 151, 0.4);
            color: white;
        }

        .footer-bottom {
            color: #888;
            font-size: 0.9rem;
            padding-top: 2rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-bottom a {
            color: #aaa;
            text-decoration: none;
            transition: var(--transition-base);
        }

        .footer-bottom a:hover {
            color: var(--color-primary);
            text-decoration: underline;
        }

        /* ===========================
   RESPONSIVE DESIGN
   ========================== */

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-title::after {
                width: 80px;
            }

            .hero-subtitle {
                font-size: 1.1rem;
                max-width: 100%;
            }

            .hero-stats {
                gap: 1.5rem;
                justify-content: center;
            }

            .stat-item {
                min-width: 120px;
                padding: 1rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .section-header h2 {
                font-size: 2.2rem;
            }

            .section-subtitle {
                font-size: 1.1rem;
            }

            .feature-card,
            .service-card,
            .location-card {
                padding: 2rem 1.5rem;
            }

            .location-info li {
                font-size: 0.95rem;
            }

            .hero-search .btn {
                padding: 1rem 1.5rem;
                font-size: 1rem;
            }

            .step-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .step-label {
                font-size: 1rem;
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

            .section-header h2 {
                font-size: 1.8rem;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }

            .navbar-cta .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }

        /* ===========================
   ANIMATIONS
   ========================== */

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

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .feature-card,
        .service-card,
        .location-card,
        .stat-item {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            animation-delay: calc(var(--animation-order, 0) * 0.1s);
        }

        .pulse-animation {
            animation: pulse 2s infinite ease-in-out;
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

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="18" cy="18" r="16" stroke="#2d8cff" stroke-width="2.5" />
                    <path d="M13.5 18c0-2.485 2.015-4.5 4.5-4.5s4.5 2.015 4.5 4.5" stroke="#2d8cff" stroke-width="2.5" stroke-linecap="round" />
                    <circle cx="18" cy="18" r="3" fill="#2d8cff" opacity="0.3" />
                </svg>
                <span class="ms-2">RumahLaundry</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#location">Lokasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Keunggulan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#process">Cek Pesanan</a>
                    </li>
                </ul>
                <div class="navbar-cta ms-3">
                    
                    <a href="{{ Route('login') }}"><button class="btn btn-primary">Login Admin</button></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h1 class="hero-title mb-4">Cuci & Setrika Semudah Pesan Makanan</h1>
                    <p class="hero-subtitle mb-4">Laundry offline terpercaya dengan <span class="highlight-text">layanan cuci & setrika Yang Wangi Dan Berkualitas</span>.</p>

                    <!-- Hero Stats -->
                    <div class="hero-stats">
                        <div class="stat-item" style="--animation-order: 1;">
                            <div class="stat-number">10K+</div>
                            <div class="stat-label">Pelanggan Setia</div>
                        </div>
                        <div class="stat-item" style="--animation-order: 2;">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Layanan</div>
                        </div>
                        <div class="stat-item" style="--animation-order: 3;">
                            <div class="stat-number">99%</div>
                            <div class="stat-label">Kepuasan</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <svg viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Modern Laundry Illustration -->
                            <circle cx="250" cy="250" r="220" fill="#f0f8ff" stroke="#6ab0ff" stroke-width="3" stroke-dasharray="10 5" />
                            <rect x="150" y="150" width="200" height="200" rx="20" fill="white" stroke="#2d8cff" stroke-width="3" />
                            <path d="M170 170h160v160H170z" fill="#e6f2ff" stroke="#6ab0ff" stroke-width="2" />
                            
                            <!-- Washing Machine -->
                            <circle cx="250" cy="220" r="40" fill="#2d8cff" opacity="0.1" stroke="#2d8cff" stroke-width="2" />
                            <circle cx="250" cy="220" r="25" fill="#6ab0ff" stroke="#2d8cff" stroke-width="2" />
                            <circle cx="250" cy="220" r="15" fill="white" stroke="#2d8cff" stroke-width="1" />
                            
                            <!-- Clothes -->
                            <rect x="200" y="280" width="30" height="40" rx="5" fill="#20c997" opacity="0.8" />
                            <rect x="240" y="280" width="30" height="40" rx="5" fill="#fd7e14" opacity="0.8" />
                            <rect x="280" y="280" width="30" height="40" rx="5" fill="#2d8cff" opacity="0.8" />
                            
                            <!-- Bubbles -->
                            <circle cx="180" cy="190" r="8" fill="#6ab0ff" opacity="0.6" />
                            <circle cx="320" cy="200" r="6" fill="#6ab0ff" opacity="0.6" />
                            <circle cx="290" cy="170" r="10" fill="#6ab0ff" opacity="0.4" />
                            <circle cx="210" cy="160" r="7" fill="#6ab0ff" opacity="0.5" />
                            
                            <!-- Sparkles -->
                            <path d="M250 150l5 10 10-5-5-10z" fill="#fd7e14" opacity="0.7" />
                            <path d="M320 250l7-7 5 5-7 7z" fill="#20c997" opacity="0.7" />
                            <path d="M180 300l-5-8 8 5-3 3z" fill="#2d8cff" opacity="0.7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section id="location" class="location-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2>Lokasi Laundry Kami</h2>
                <p class="section-subtitle">Datang langsung ke outlet kami Karena Kita Menggunakan Laundry Terpercaya</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="location-card">
                        <div class="location-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <h3>RumahLaundry Central</h3>
                        <p class="mb-4">Outlet utama kami dengan fasilitas lengkap dan staf profesional siap melayani Anda.</p>
                        
                        <ul class="location-info">
                            <li><i class="fas fa-map-marker-alt"></i> Jl. Laundry No. 123, Kota Anda</li>
                            <li><i class="fas fa-clock"></i> Buka 24/7 jam</li>
                            <li><i class="fas fa-phone"></i> +62 812-3456-7890</li>
                            <li><i class="fas fa-wifi"></i> Free WiFi untuk pelanggan</li>
                            <li><i class="fas fa-parking"></i> Area parkir luas & aman</li>
                        </ul>
                        
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="https://maps.google.com" target="_blank" class="location-btn">
                                <i class="fas fa-directions me-2"></i> Petunjuk Arah
                            </a>
                            <a href="tel:+6281234567890" class="btn btn-outline-primary">
                                <i class="fas fa-phone me-2"></i> Telepon Sekarang
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
            <div class="section-header text-center mb-5">
                <h2>Keunggulan RumahLaundry</h2>
                <p class="section-subtitle">Mengapa ribuan pelanggan mempercayai laundry kami</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card" style="--animation-order: 1;">
                        <div class="feature-icon">
                            <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                                <circle cx="28" cy="28" r="26" stroke="#2d8cff" stroke-width="2.5" />
                                <path d="M20 28h16M28 20v16" stroke="#2d8cff" stroke-width="2.5" stroke-linecap="round" />
                                <path d="M24 32l8-8 8 8" stroke="#2d8cff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3>Laundry Terpercaya</h3>
                        <p>Tim kami terdiri dari profesional yang berpengalaman dan memiliki standar kualitas terbaik</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card" style="--animation-order: 2;">
                        <div class="feature-icon">
                            <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                                <circle cx="28" cy="28" r="26" stroke="#20c997" stroke-width="2.5" />
                                <path d="M22 28l4 4 10-10" stroke="#20c997" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M34 22l-12 12" stroke="#20c997" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3>Harga Jelas</h3>
                        <p>Tidak ada biaya tersembunyi, bayar sesuai berat dengan timbangan digital</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card" style="--animation-order: 3;">
                        <div class="feature-icon">
                            <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                                <circle cx="28" cy="28" r="26" stroke="#fd7e14" stroke-width="2.5" />
                                <path d="M28 20v24M20 28h16" stroke="#fd7e14" stroke-width="2.5" stroke-linecap="round" />
                                <circle cx="28" cy="28" r="8" stroke="#fd7e14" stroke-width="2" fill="none" />
                            </svg>
                        </div>
                        <h3>Express 24 Jam</h3>
                        <p>Layanan kilat untuk kebutuhan mendesak dengan proses maksimal 24 jam</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card" style="--animation-order: 4;">
                        <div class="feature-icon">
                            <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                                <circle cx="28" cy="28" r="26" stroke="#6f42c1" stroke-width="2.5" />
                                <path d="M28 24v8M24 28h8" stroke="#6f42c1" stroke-width="2.5" stroke-linecap="round" />
                                <path d="M22 34h12" stroke="#6f42c1" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <h3>Laundry Aman</h3>
                        <p>Perlakuan khusus untuk bahan-bahan sensitif dengan deterjen hipoalergenik</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2>Layanan Kami</h2>
                <p class="section-subtitle">Berbagai paket laundry sesuai kebutuhan Anda</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="service-card" style="--animation-order: 1;">
                        <div class="service-icon">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="24" r="22" stroke="#2d8cff" stroke-width="2.5" />
                                <path d="M18 24h12M24 18v12" stroke="#2d8cff" stroke-width="2.5" stroke-linecap="round" />
                                <path d="M20 28l4-4 4 4" stroke="#2d8cff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3>Cuci Biasa</h3>
                        <p class="service-desc">Cucian standar dengan deterjen berkualitas tinggi dan pewangi pilihan</p>
                        <p class="service-price">Mulai dari <strong>Rp 8.000/kg</strong></p>
                        <p class="service-time"><i class="far fa-clock"></i> 3-4 hari kerja</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="service-card featured" style="--animation-order: 2;">
                        <span class="badge-featured">Paling Populer</span>
                        <div class="service-icon">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="24" r="22" stroke="#fd7e14" stroke-width="2.5" />
                                <path d="M18 24h12M24 18v12" stroke="#fd7e14" stroke-width="2.5" stroke-linecap="round" />
                                <path d="M20 30l8-8 8 8" stroke="#fd7e14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3>Cuci + Setrika</h3>
                        <p class="service-desc">Cucian lengkap dengan setrika profesional dan lipatan rapi</p>
                        <p class="service-price">Mulai dari <strong>Rp 12.000/kg</strong></p>
                        <p class="service-time"><i class="far fa-clock"></i> 2-3 hari kerja</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="service-card" style="--animation-order: 3;">
                        <div class="service-icon">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="24" r="22" stroke="#20c997" stroke-width="2.5" />
                                <path d="M18 24h12M24 18v12" stroke="#20c997" stroke-width="2.5" stroke-linecap="round" />
                                <circle cx="24" cy="24" r="6" stroke="#20c997" stroke-width="2" fill="none" />
                            </svg>
                        </div>
                        <h3>Express Service</h3>
                        <p class="service-desc">Layanan kilat dalam 24 jam untuk kebutuhan mendesak</p>
                        <p class="service-price">Mulai dari <strong>Rp 15.000/kg</strong></p>
                        <p class="service-time"><i class="far fa-clock"></i> 1 hari kerja</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="process-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2>Cek Status Pesanan Anda</h2>
                <p class="section-subtitle">Masukkan kode pesanan untuk melihat status: Baru, Diproses, Selesai, atau Diambil</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <form id="statusForm" class="hero-search mb-4">
                        @csrf
                        <div class="input-group">
                            <input type="text" id="orderCode" class="form-control" placeholder="Contoh: ORD-000001" required>
                            <button class="btn btn-primary" type="submit">
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

            <div class="process-stepper mt-5">
                <div class="row g-0 justify-content-center">
                    <div class="col-auto">
                        <div class="process-step">
                            <div class="step-icon bg-secondary">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div class="step-label">Baru</div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="step-connector"></div>
                    </div>
                    <div class="col-auto">
                        <div class="process-step">
                            <div class="step-icon bg-secondary">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div class="step-label">Diproses</div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="step-connector"></div>
                    </div>
                    <div class="col-auto">
                        <div class="process-step">
                            <div class="step-icon bg-secondary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="step-label">Selesai</div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="step-connector"></div>
                    </div>
                    <div class="col-auto">
                        <div class="process-step">
                            <div class="step-icon bg-secondary">
                                <i class="fas fa-hand-holding"></i>
                            </div>
                            <div class="step-label">Diambil</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('statusForm');
                const orderCodeInput = document.getElementById('orderCode');
                const statusResult = document.getElementById('statusResult');
                const statusText = document.getElementById('statusText');
                const statusDetail = document.getElementById('statusDetail');
                const steps = document.querySelectorAll('.process-step');
                const connectors = document.querySelectorAll('.step-connector');

                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const noOrder = orderCodeInput.value.trim();
                    if (!noOrder) {
                        statusResult.className = 'alert alert-warning d-block';
                        statusText.textContent = 'Peringatan';
                        statusDetail.textContent = 'Silakan masukkan nomor order yang valid.';
                        return;
                    }

                    const submitBtn = form.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Memproses...';
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
                            statusText.textContent = result.data.status_order.charAt(0).toUpperCase() + result.data.status_order.slice(1);

                            let detailHTML = `
                        <strong>Nama:</strong> ${result.data.nama_pelanggan}<br>
                        <strong>Tanggal Terima:</strong> ${result.data.tanggal_terima}<br>
                        <strong>Tanggal Selesai:</strong> ${result.data.tanggal_selesai}<br>
                        <strong>Total Bayar:</strong> ${result.data.total}<br>
                        <strong>Status Pembayaran:</strong> ${result.data.pembayaran}
                    `;

                            statusDetail.innerHTML = detailHTML;

                            let alertClass = 'alert-info';
                            switch (result.data.status_order) {
                                case 'baru':
                                    alertClass = 'alert-warning';
                                    break;
                                case 'diproses':
                                    alertClass = 'alert-secondary';
                                    break;
                                case 'selesai':
                                    alertClass = 'alert-success';
                                    break;
                                case 'diambil':
                                    alertClass = 'alert-info';
                                    break;
                            }

                            statusResult.className = `alert ${alertClass} d-block`;

                            updateStepper(result.data.status_order);

                        } else {
                            statusResult.className = 'alert alert-danger d-block';
                            statusText.textContent = 'Gagal';
                            statusDetail.textContent = result.message || 'Status tidak ditemukan.';
                        }

                    } catch (error) {
                        console.error('JavaScript Fetch Error:', error);
                        statusResult.className = 'alert alert-danger d-block';
                        statusText.textContent = 'Error';
                        statusDetail.textContent = `Terjadi kesalahan: ${error.message}`;
                    } finally {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                        orderCodeInput.focus();
                    }
                });

                function updateStepper(status) {
                    steps.forEach(step => step.classList.remove('active'));
                    connectors.forEach(connector => connector.classList.remove('active'));

                    steps.forEach((step, index) => {
                        const icon = step.querySelector('.step-icon');
                        icon.className = icon.className.replace(/bg-\w+/g, '');
                        icon.classList.add('bg-secondary');
                    });

                    let activeIndex = 0;
                    switch (status) {
                        case 'baru':
                            activeIndex = 0;
                            break;
                        case 'diproses':
                            activeIndex = 1;
                            break;
                        case 'selesai':
                            activeIndex = 2;
                            break;
                        case 'diambil':
                            activeIndex = 3;
                            break;
                    }

                    for (let i = 0; i <= activeIndex; i++) {
                        if (i < steps.length) {
                            steps[i].classList.add('active');
                            const icon = steps[i].querySelector('.step-icon');
                            icon.classList.remove('bg-secondary');
                            
                            let bgClass = 'bg-primary';
                            if (i === 1) bgClass = 'bg-warning';
                            if (i === 2) bgClass = 'bg-success';
                            if (i === 3) bgClass = 'bg-info';
                            
                            icon.classList.add(bgClass);
                        }
                        if (i < connectors.length) {
                            connectors[i].classList.add('active');
                        }
                    }
                }
            });
        </script>
    </section>

    <!-- Footer -->
    <footer id="footer" class="footer-section">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <h5>RumahLaundry</h5>
                    <p>Layanan laundry offline terpercaya dengan standar kebersihan tinggi dan pelayanan maksimal untuk seluruh keluarga Anda.</p>
                    <div class="social-links">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" title="Maps"><i class="fas fa-map-marker-alt"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Layanan</h5>
                    <ul class="footer-links">
                        <li><a href="#services"><i class="fas fa-tshirt me-2"></i>Cuci Biasa</a></li>
                        <li><a href="#services"><i class="fas fa-iron me-2"></i>Cuci + Setrika</a></li>
                        <li><a href="#services"><i class="fas fa-bolt me-2"></i>Express 24 Jam</a></li>
                        <li><a href="#services"><i class="fas fa-star me-2"></i>Layanan Khusus</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Kontak & Lokasi</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Laundry No. 123, Kota Anda</p>
                    <p><i class="fas fa-phone me-2"></i> +62 812-3456-7890</p>
                    <p><i class="fas fa-envelope me-2"></i> info@rumahlaundry.id</p>
                    <p><i class="fas fa-clock me-2"></i> Buka 24/7</p>
                </div>
            </div>
            <div class="footer-bottom text-center">
                <p>&copy; 2025 RumahLaundry. Semua hak dilindungi. | <a href="#">Kebijakan Privasi</a> | <a href="#">Syarat Layanan</a> | <a href="{{ Route('login') }}">Admin Area</a></p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/fontawesome/all.min.js') }}"></script>

    <script>
        /**
         * RumahLaundry Landing Page - JavaScript
         */

        // ===========================
        // NAVBAR SCROLL EFFECT
        // ===========================

        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // ===========================
        // SMOOTH SCROLL NAVIGATION
        // ===========================

        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
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
        // ANIMATION ON SCROLL
        // ===========================

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px',
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .service-card, .location-card, .stat-item').forEach((el, index) => {
            el.style.setProperty('--animation-order', index);
            observer.observe(el);
        });

        // ===========================
        // INITIALIZE ON LOAD
        // ===========================

        document.addEventListener('DOMContentLoaded', () => {
            console.log('RumahLaundry - Layanan Laundry Offline loaded');
            
            // Add animation delay to elements
            const animatedElements = document.querySelectorAll('.feature-card, .service-card');
            animatedElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // ===========================
        // FORM SUBMISSION FEEDBACK
        // ===========================

        function showAlert(message, type = 'info') {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
            alertDiv.style.zIndex = '1050';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
                alertDiv.classList.remove('show');
                setTimeout(() => alertDiv.remove(), 150);
            }, 3000);
        }

        // ===========================
        // DEBOUNCE FUNCTION FOR PERFORMANCE
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

        // Debounced scroll event
        const debouncedScroll = debounce(() => {
            // Performance optimization
        }, 100);

        window.addEventListener('scroll', debouncedScroll);
    </script>
</body>

</html>