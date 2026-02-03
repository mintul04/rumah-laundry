<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $pengaturan->nama_laundry ?? 'RumahLaundry' }} - Layanan Laundry Offline Terpercaya</title>

    {{-- Google Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet" />

    {{-- Font Awesome --}}
    <link href="{{ asset('assets/vendor/fontawesome/all.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/vendor/fontawesome/all.min.js') }}"></script>
    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.min.css') }}">
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>

    {{-- Tailwind (compiled) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-in-up.appear {
            opacity: 1;
            transform: translateY(0);
        }

        /* Added modern linear overlays and enhanced visual effects */
        .accent-badge {
            position: relative;
            overflow: hidden;
        }

        .accent-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-linear(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .accent-badge:hover::before {
            left: 100%;
        }

        .icon-linear {
            background: linear-linear(135deg, currentColor 0%, currentColor 100%);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans text-gray-800 bg-white antialiased overflow-x-hidden">
    <div x-data="{ mobileMenuOpen: false }">
        <!-- Enhanced navbar with modern styling and color accents -->
        <nav x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 50)"
            :class="{ 'shadow-xl bg-white/95 backdrop-blur-md border-b border-gray-200/50': scrolled }"
            class="sticky top-0 z-50 w-full bg-white py-4 transition-all duration-300">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between">
                    <!-- Brand with enhanced styling -->
                    <a href="#home"
                        class="flex items-center gap-3 text-blue-600 font-extrabold text-lg no-underline group">
                        @if ($pengaturan->logo)
                            <div
                                class="w-10 h-10 rounded-lg shadow-lg flex items-center justify-center group-hover:shadow-xl transition-shadow bg-linear-to-br from-blue-600 via-cyan-500 to-emerald-500">
                                <img src="{{ Storage::url($pengaturan->logo) }}" alt="Logo"
                                    class="w-full h-full object-contain rounded">
                            </div>
                        @else
                            <div
                                class="w-10 h-10 rounded-lg shadow-lg flex items-center justify-center group-hover:shadow-xl transition-shadow bg-linear-to-br from-blue-600 via-cyan-500 to-emerald-500">
                                <i class="fas fa-water text-white text-sm font-bold"></i>
                            </div>
                        @endif
                        <span class="hidden sm:inline">{{ $pengaturan->nama_laundry ?? 'RumahLaundry' }}</span>
                    </a>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="lg:hidden text-gray-600 hover:text-blue-600 focus:outline-none transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <!-- Desktop Menu -->
                    <div class="hidden lg:flex items-center gap-1">
                        <a href="#home"
                            class="px-4 py-2 font-medium text-gray-600 hover:text-blue-600 transition-colors">Beranda</a>
                        <a href="#location"
                            class="px-4 py-2 font-medium text-gray-600 hover:text-emerald-600 transition-colors">Lokasi</a>
                        <a href="#features"
                            class="px-4 py-2 font-medium text-gray-600 hover:text-rose-600 transition-colors">Keunggulan</a>
                        <a href="#services"
                            class="px-4 py-2 font-medium text-gray-600 hover:text-amber-600 transition-colors">Layanan</a>
                        <a href="#process"
                            class="px-4 py-2 font-medium text-gray-600 hover:text-cyan-600 transition-colors">Cek
                            Pesanan</a>
                        <a href="{{ route('login') }}"
                            class="ml-2 px-6 py-2.5 bg-linear-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-blue-800 transition-all">
                            Login
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false"
                    class="lg:hidden mt-4 py-4 px-4 bg-white rounded-2xl shadow-xl border border-gray-200" x-cloak>
                    <div class="flex flex-col gap-2">
                        <a href="#home"
                            class="px-4 py-3 font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">Beranda</a>
                        <a href="#location"
                            class="px-4 py-3 font-medium text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Lokasi</a>
                        <a href="#features"
                            class="px-4 py-3 font-medium text-gray-600 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">Keunggulan</a>
                        <a href="#services"
                            class="px-4 py-3 font-medium text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">Layanan</a>
                        <a href="#process"
                            class="px-4 py-3 font-medium text-gray-600 hover:text-cyan-600 hover:bg-cyan-50 rounded-lg transition-colors">Cek
                            Pesanan</a>
                        <a href="{{ route('login') }}"
                            class="mt-3 px-5 py-3 bg-linear-to-r from-blue-600 to-blue-700 text-center text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Enhanced hero section with improved linear background and modern card styling -->
        <section id="home"
            class="relative py-24 md:py-20 bg-linear-to-br from-blue-50 via-white to-cyan-50 overflow-hidden">
            <div class="absolute top-[-15%] right-[-8%] w-96 h-96 rounded-full bg-blue-100/40 blur-3xl"></div>
            <div class="absolute bottom-[-10%] left-[-5%] w-80 h-80 rounded-full bg-cyan-100/30 blur-3xl"></div>
            <div class="container mx-auto px-4 relative z-10">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <div class="lg:w-1/2">
                        <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                            Cuci & Setrika <span
                                class="bg-linear-to-r from-blue-600 via-cyan-500 to-emerald-500 bg-clip-text text-transparent">Semudah</span>
                            Pesan Makanan
                        </h1>
                        <p class="mt-6 text-xl text-gray-600 max-w-lg leading-relaxed">
                            Laundry offline terpercaya dengan layanan cuci & setrika yang wangi dan berkualitas tinggi
                            untuk keluarga Anda.
                        </p>

                        <!-- Enhanced stats cards with color diversity -->
                        <div class="mt-12 flex flex-wrap gap-6">
                            <div
                                class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200/80 card-hover accent-badge hover:border-blue-300">
                                <div class="text-3xl md:text-4xl font-extrabold text-blue-600">10K+</div>
                                <div class="text-gray-600 text-sm font-semibold mt-2">Pelanggan Setia</div>
                            </div>
                            <div
                                class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200/80 card-hover accent-badge hover:border-emerald-300">
                                <div class="text-3xl md:text-4xl font-extrabold text-emerald-600">24/7</div>
                                <div class="text-gray-600 text-sm font-semibold mt-2">Layanan Aktif</div>
                            </div>
                            <div
                                class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200/80 card-hover accent-badge hover:border-rose-300">
                                <div class="text-3xl md:text-4xl font-extrabold text-rose-600">99%</div>
                                <div class="text-gray-600 text-sm font-semibold mt-2">Kepuasan Pelanggan</div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2 flex justify-center">
                        <div class="bg-white rounded-3xl shadow-2xl p-10 card-hover relative">
                            <div
                                class="absolute inset-0 bg-linear-to-br from-blue-50 to-cyan-50 rounded-3xl opacity-50">
                            </div>
                            <!-- SVG Washing Machine with enhanced colors -->
                            <svg width="320" height="320" viewBox="0 0 300 300" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="relative z-10">
                                <rect x="75" y="50" width="150" height="200" rx="12" fill="#F0F9FF"
                                    stroke="#0066FF" stroke-width="2.5" />
                                <rect x="90" y="70" width="120" height="30" rx="6" fill="#E0F2FE"
                                    stroke="#06B6D4" stroke-width="1.5" />
                                <circle cx="110" cy="85" r="5" fill="#0066FF" />
                                <circle cx="130" cy="85" r="5" fill="#06B6D4" />
                                <circle cx="150" cy="85" r="5" fill="#10B981" />
                                <circle cx="150" cy="150" r="50" fill="white" stroke="#0066FF"
                                    stroke-width="3.5" />
                                <circle cx="150" cy="150" r="35" fill="#E0F2FE" stroke="#06B6D4"
                                    stroke-width="2.5" />
                                <circle cx="150" cy="150" r="20" fill="white" stroke="#0066FF"
                                    stroke-width="2" />
                                <rect x="100" y="210" width="25" height="30" rx="4" fill="#10B981"
                                    opacity="0.9" stroke="#059669" stroke-width="1.5" />
                                <rect x="135" y="210" width="25" height="30" rx="4" fill="#F59E0B"
                                    opacity="0.9" stroke="#D97706" stroke-width="1.5" />
                                <rect x="170" y="210" width="25" height="30" rx="4" fill="#0066FF"
                                    opacity="0.9" stroke="#0052CC" stroke-width="1.5" />
                                <circle cx="120" cy="120" r="6" fill="#06B6D4" opacity="0.6" />
                                <circle cx="180" cy="130" r="5" fill="#06B6D4" opacity="0.5" />
                                <circle cx="160" cy="110" r="7" fill="#06B6D4" opacity="0.7" />
                                <path d="M150 40 L152 47 L159 49 L152 51 L150 58 L148 51 L141 49 L148 47 Z"
                                    fill="#F59E0B" opacity="0.8" />
                                <path d="M220 140 L222 145 L227 147 L222 149 L220 154 L218 149 L213 147 L218 145 Z"
                                    fill="#10B981" opacity="0.8" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Enhanced location section with modern card design and color accents -->
        <section id="location" class="py-24 bg-linear-to-b from-white to-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900">Lokasi Laundry Kami</h2>
                    <p class="mt-4 text-lg text-gray-600">
                        Kunjungi outlet kami dengan fasilitas modern dan pelayanan terbaik
                    </p>
                </div>
                <div class="max-w-4xl mx-auto">
                    <div
                        class="relative bg-white rounded-3xl p-10 border-2 border-gray-200/50 shadow-xl card-hover overflow-hidden">
                        <div
                            class="absolute top-0 left-0 w-full h-1.5 bg-linear-to-r from-blue-600 via-cyan-500 to-emerald-500">
                        </div>
                        <div class="absolute -top-20 -right-20 w-48 h-48 bg-blue-100/30 rounded-full blur-3xl"></div>

                        <div class="flex justify-center mb-8 relative z-10">
                            <div
                                class="w-20 h-20 rounded-2xl shadow-xl flex items-center justify-center bg-linear-to-br from-blue-600 to-cyan-500">
                                <i class="fas fa-store text-white text-2xl"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-center mb-4 text-gray-900">
                            {{ $pengaturan->nama_laundry ?? 'RumahLaundry' }} Central</h3>
                        <p class="text-gray-600 text-center mb-8 text-lg">
                            Outlet utama kami dengan fasilitas lengkap dan staf profesional siap melayani Anda.
                        </p>
                        <ul class="space-y-4 mb-10">
                            <li class="flex items-start gap-4 text-gray-700 group">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-map-marker-alt text-blue-600 group-hover:text-white"></i>
                                </div>
                                <span class="pt-1">{{ $pengaturan->alamat_laundry }}</span>
                            </li>
                            <li class="flex items-start gap-4 text-gray-700 group">
                                <div
                                    class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-clock text-emerald-600 group-hover:text-white"></i>
                                </div>
                                <span class="pt-1">Buka 24/7 jam, setiap hari</span>
                            </li>
                            <li class="flex items-start gap-4 text-gray-700 group">
                                <div
                                    class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center shrink-0 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-phone text-rose-600 group-hover:text-white"></i>
                                </div>
                                <span class="pt-1">{{ $pengaturan->telepon_laundry ?? '+62 812-3456-7890' }}</span>
                            </li>
                            <li class="flex items-start gap-4 text-gray-700 group">
                                <div
                                    class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center shrink-0 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-wifi text-amber-600 group-hover:text-white"></i>
                                </div>
                                <span class="pt-1">Free WiFi berkecepatan tinggi untuk pelanggan</span>
                            </li>
                            <li class="flex items-start gap-4 text-gray-700 group">
                                <div
                                    class="w-10 h-10 rounded-full bg-cyan-100 flex items-center justify-center shrink-0 group-hover:bg-cyan-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-parking text-cyan-600 group-hover:text-white"></i>
                                </div>
                                <span class="pt-1">Area parkir luas, aman & gratis</span>
                            </li>
                        </ul>
                        <div class="flex flex-wrap gap-4 justify-center">
                            <a href="https://maps.google.com" target="_blank"
                                class="flex items-center gap-2 px-7 py-3 bg-linear-to-r from-emerald-500 to-emerald-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:from-emerald-600 hover:to-emerald-700 transition-all">
                                <i class="fas fa-directions"></i> Petunjuk Arah
                            </a>
                            <a href="https://wa.me/{{ $pengaturan->telepon ?? '6281234567890' }}" target="_blank"
                                class="flex items-center gap-2 px-7 py-3 bg-white text-gray-800 font-bold rounded-xl border-2 border-gray-300 shadow-md hover:border-emerald-500 hover:shadow-lg hover:bg-emerald-50 transition-all">
                                <i class="fab fa-whatsapp"></i> Chat WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced features section with 4-color design and improved card layouts -->
        <section id="features" class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900">
                        Keunggulan {{ $pengaturan->nama_laundry ?? 'RumahLaundry' }}
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">Mengapa ribuan pelanggan mempercayai laundry kami</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @php($features = [['icon' => 'fa-user-shield', 'title' => 'Laundry Terpercaya', 'desc' => 'Tim profesional dengan standar kualitas internasional', 'color' => 'blue', 'bgColor' => 'bg-blue-50'], ['icon' => 'fa-tag', 'title' => 'Harga Jelas', 'desc' => 'Transparansi harga tanpa biaya tersembunyi', 'color' => 'emerald', 'bgColor' => 'bg-emerald-50'], ['icon' => 'fa-bolt', 'title' => 'Express 24 Jam', 'desc' => 'Layanan kilat untuk kebutuhan mendesak', 'color' => 'amber', 'bgColor' => 'bg-amber-50'], ['icon' => 'fa-shield-alt', 'title' => 'Laundry Aman', 'desc' => 'Perlakuan khusus untuk bahan sensitif', 'color' => 'rose', 'bgColor' => 'bg-rose-50']])
                    @foreach ($features as $index => $f)
                        <div class="{{ $f['bgColor'] }} p-8 rounded-3xl border-2 border-gray-200/50 shadow-lg card-hover fade-in-up"
                            style="animation-delay: {{ ($index + 1) * 0.1 }}s">
                            <div class="flex justify-center mb-6">
                                <div
                                    class="w-16 h-16 rounded-2xl bg-{{ $f['color'] }}-600 flex items-center justify-center shadow-lg">
                                    <i class="fas {{ $f['icon'] }} text-white text-2xl"></i>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-center mb-3 text-gray-900">{{ $f['title'] }}</h3>
                            <p class="text-gray-600 text-center text-base">{{ $f['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Enhanced services section with premium card styling and diverse colors -->
        <section id="services" class="py-24 bg-linear-to-b from-white via-blue-50/20 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900">Layanan Kami</h2>
                    <p class="mt-4 text-lg text-gray-600">Pilihan paket laundry berkualitas untuk keluarga Anda</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
                    <!-- Cuci Biasa -->
                    <div class="bg-white p-8 rounded-3xl border-2 border-gray-200/50 shadow-lg card-hover fade-in-up"
                        style="animation-delay: 0.1s;">
                        <div class="flex justify-center mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-blue-600 flex items-center justify-center shadow-lg">
                                <i class="fas fa-soap text-white text-xl"></i>
                            </div>
                        </div>
                        <div
                            class="w-full h-48 bg-linear-to-br from-blue-100 to-cyan-100 rounded-2xl mb-6 flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('img/cucibiasa.png') }}" alt="Cuci Biasa" class="w-full h-full object-cover rounded-2xl">
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">Cuci Regular</h3>
                        <p class="text-gray-600 text-base mb-4">Cucian standar dengan deterjen berkualitas tinggi dan
                                pewangi premium</p>
                        <div class="flex items-baseline gap-2 mb-3">
                            <span class="text-3xl font-bold text-blue-600">Rp 7k</span>
                            <span class="text-gray-600 text-sm">/Piece</span>
                        </div>
                    </div>

                    <!-- Cuci Express (Featured) -->
                    <div class="relative lg:col-span-1 md:col-span-2">
                        <div
                            class="absolute inset-0 bg-linear-to-br from-amber-400 to-rose-400 rounded-3xl blur-xl opacity-30">
                        </div>
                        <div class="relative bg-white p-8 rounded-3xl border-3 border-amber-400 shadow-2xl card-hover fade-in-up"
                            style="animation-delay: 0.2s;">
                            <span
                                class="absolute -top-4 right-6 bg-linear-to-r from-amber-500 to-rose-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg">⭐
                                Paling Populer</span>
                            <div class="flex justify-center mb-6 mt-2">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-linear-to-br from-amber-500 to-rose-500 flex items-center justify-center shadow-lg">
                                    <i class="fas fa-star text-white text-xl"></i>
                                </div>
                            </div>
                            <div
                                class="w-full h-48 bg-linear-to-br from-amber-100 to-rose-100 rounded-2xl mb-6 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('img/drycleaning.jpeg') }}" alt="Cuci Express"
                                    class="w-full h-full object-cover rounded-2xl">
                            </div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-900">Dry Cleaning</h3>
                            <p class="text-gray-600 text-base mb-4">Dry cleaning adalah layanan laundry khusus yang membersihkan pakaian tanpa air, tapi pakai cairan kimia (solvent) tertentu.</p>
                            <div class="flex items-baseline gap-2 mb-3">
                                <span class="text-3xl font-bold text-amber-600">Rp 25K</span>
                                <span class="text-gray-600 text-sm">/Kg</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cuci + Setrika -->
                    <div class="bg-white p-8 rounded-3xl border-2 border-gray-200/50 shadow-lg card-hover fade-in-up"
                        style="animation-delay: 0.3s;">
                        <div class="flex justify-center mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-rose-600 flex items-center justify-center shadow-lg">
                                <i class="fas fa-tshirt text-white text-xl"></i>
                            </div>
                        </div>
                        <div
                                class="w-full h-48 bg-linear-to-br from-amber-100 to-rose-100 rounded-2xl mb-6 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('img/cucisetrika.jpg') }}" alt="Cuci Express"
                                    class="w-full h-full object-cover rounded-2xl">
                            </div>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">Cuci + Setrika</h3>
                        <p class="text-gray-600 text-base mb-4">Paket lengkap dengan setrika profesional dan lipatan
                            sempurna</p>
                        <div class="flex items-baseline gap-2 mb-3">
                            <span class="text-3xl font-bold text-rose-600">Rp 8K</span>
                            <span class="text-gray-600 text-sm">/Lusin</span>
                        </div>
                    </div>
                </div>

                <!-- More Services CTA -->
                <div
                    class="text-center bg-linear-to-r from-blue-50 to-cyan-50 rounded-3xl p-12 border-2 border-blue-200/50">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Dan Masih Banyak Lainnya</h2>
                    <p class="text-lg text-gray-600 mb-8">Berbagai paket laundry spesial sesuai kebutuhan dan budget
                        Anda</p>
                    <a href="#location"
                        class="inline-flex items-center gap-2 px-8 py-3 bg-linear-to-r from-blue-600 to-cyan-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all">
                        <i class="fas fa-arrow-down"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </section>

        <!-- Enhanced process section with modern linear and improved stepper design -->
        <section id="process"
            class="py-24 bg-linear-to-br from-blue-600 via-cyan-600 to-emerald-600 text-white relative overflow-hidden">
            <div class="absolute top-[-15%] left-[-10%] w-96 h-96 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute bottom-[-10%] right-[-5%] w-80 h-80 rounded-full bg-white/5 blur-3xl"></div>
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-4xl md:text-5xl font-extrabold">Cek Status Pesanan Anda</h2>
                    <p class="mt-4 text-lg opacity-95">
                        Pantau pesanan Anda secara real-time: Baru, Diproses, Selesai, atau Diambil
                    </p>
                </div>
                <div class="max-w-lg mx-auto">
                    <form id="statusForm"
                        class="bg-white/95 rounded-2xl shadow-2xl overflow-hidden mb-10 backdrop-blur-sm">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-0">
                            <input type="text" id="orderCode" placeholder="Masukkan nomor order (ORD-000001)"
                                class="flex-1 px-6 py-4 text-gray-800 focus:outline-none text-base sm:text-lg">
                            <button type="submit"
                                class="bg-linear-to-r from-emerald-500 to-emerald-600 text-white px-8 py-4 font-bold hover:from-emerald-600 hover:to-emerald-700 transition-all whitespace-nowrap shadow-lg hover:shadow-xl">
                                <i class="fas fa-search me-2"></i><span class="hidden sm:inline">Cek</span> Status
                            </button>
                        </div>
                    </form>

                    <div id="statusResult"
                        class="hidden bg-white/95 text-gray-800 rounded-2xl shadow-2xl p-8 mb-12 backdrop-blur-sm">
                        <h5 class="text-xl font-bold mb-4">Status Pesanan: <span id="statusText"
                                class="text-emerald-600"></span></h5>
                        <div id="statusDetail" class="text-base leading-relaxed space-y-2 text-gray-700"></div>
                    </div>

                    <!-- Enhanced stepper with modern design and multiple color indicators -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-6 sm:gap-0">
                        @php($steps = [['icon' => 'fa-shopping-bag', 'label' => 'Baru', 'color' => 'blue'], ['icon' => 'fa-cogs', 'label' => 'Diproses', 'color' => 'amber'], ['icon' => 'fa-check-circle', 'label' => 'Selesai', 'color' => 'emerald'], ['icon' => 'fa-hand-holding', 'label' => 'Diambil', 'color' => 'rose']])
                        @foreach ($steps as $i => $step)
                            <div id="step-{{ $i }}" class="text-center flex flex-col items-center">
                                <div
                                    class="w-20 h-20 rounded-full bg-white/20 border-3 border-white/40 flex items-center justify-center mb-3 text-2xl shadow-lg transition-all duration-500">
                                    <i class="fas {{ $step['icon'] }}"></i>
                                </div>
                                <div class="text-sm font-semibold opacity-90">{{ $step['label'] }}</div>
                            </div>
                            @if (!$loop->last)
                                <div id="connector-{{ $i }}"
                                    class="h-1.5 w-12 sm:w-16 bg-white/20 rounded-full relative hidden sm:block"
                                    style="margin: 0;">
                                    <div class="absolute top-0 left-0 h-full bg-white rounded-full shadow-lg"
                                        style="width: 0%; transition: width 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>


        <!-- Enhanced footer with modern design and improved icon colors -->
        <footer id="footer" class="bg-gray-900 text-gray-300 pt-20 pb-10 relative">
            <div class="absolute top-0 left-0 right-0 h-1 bg-linear-to-r from-blue-600 via-cyan-500 to-emerald-500">
            </div>
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div
                                class="w-10 h-10 rounded-lg bg-linear-to-br from-blue-500 to-cyan-500 flex items-center justify-center">
                                <i class="fas fa-water text-white font-bold"></i>
                            </div>
                            <h5 class="text-white text-xl font-bold">{{ $pengaturan->nama_laundry ?? 'RumahLaundry' }}
                            </h5>
                        </div>
                        <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                            Layanan laundry terpercaya dengan standar kebersihan tinggi dan pelayanan maksimal untuk
                            keluarga Anda.
                        </p>
                        <div class="flex gap-3">
                            <a href="#"
                                class="w-11 h-11 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 transition-all shadow-lg hover:shadow-xl">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#"
                                class="w-11 h-11 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition-all shadow-lg hover:shadow-xl">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#"
                                class="w-11 h-11 rounded-full bg-gray-800 flex items-center justify-center hover:bg-emerald-600 transition-all shadow-lg hover:shadow-xl">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#"
                                class="w-11 h-11 rounded-full bg-gray-800 flex items-center justify-center hover:bg-rose-600 transition-all shadow-lg hover:shadow-xl">
                                <i class="fas fa-map-marker-alt"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h5 class="text-white text-lg font-bold mb-5">Layanan</h5>
                        <ul class="space-y-3">
                            <li><a href="#services" class="hover:text-blue-400 transition-colors text-gray-400">Cuci
                                    Biasa</a></li>
                            <li><a href="#services"
                                    class="hover:text-emerald-400 transition-colors text-gray-400">Cuci + Setrika</a>
                            </li>
                            <li><a href="#services"
                                    class="hover:text-amber-400 transition-colors text-gray-400">Express 24 Jam</a>
                            </li>
                            <li><a href="#services"
                                    class="hover:text-rose-400 transition-colors text-gray-400">Layanan Khusus</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="text-white text-lg font-bold mb-5">Kontak & Lokasi</h5>
                        <div class="space-y-3 text-sm text-gray-400">
                            <p class="flex items-start gap-3">
                                <i class="fas fa-map-marker-alt mt-0.5 text-blue-500"></i>
                                <span>{{ $pengaturan->alamat_laundry ?? 'Jl. Laundry No. 123, Jakarta' }}</span>
                            </p>
                            <p class="flex items-center gap-3">
                                <i class="fas fa-phone text-emerald-500"></i>
                                <span>+{{ $pengaturan->telepon_laundry ?? '62 812-3456-7890' }}</span>
                            </p>
                            <p class="flex items-center gap-3">
                                <i class="fas fa-envelope text-rose-500"></i>
                                <span>{{ $pengaturan->email_laundry ?? 'info@rumahlaundry.id' }}</span>
                            </p>
                            <p class="flex items-center gap-3">
                                <i class="fas fa-clock text-amber-500"></i> Buka 24/7
                            </p>
                        </div>
                    </div>
                </div>
                <div class="pt-8 mt-10 border-t border-gray-800 text-center text-sm text-gray-500">
                    <p>
                        &copy; 2025 RumahLaundry. Semua hak dilindungi. |
                        <a href="#" class="hover:text-blue-400 transition-colors">Kebijakan Privasi</a> |
                        <a href="#" class="hover:text-blue-400 transition-colors">Syarat Layanan</a> |
                        <a href="{{ route('login') }}" class="hover:text-blue-400 transition-colors">Admin Area</a>
                    </p>
                </div>
            </div>
        </footer>
    </div>

    {{-- Core JS (vanilla) --}}
    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#' || !href.startsWith('#')) return;
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Fade-in on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('appear');
                }
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));

        // Float animation
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-20px); }
            }
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
        `;
        document.head.appendChild(style);

        // Cek Status Form
        document.getElementById('statusForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const noOrder = document.getElementById('orderCode').value.trim();
            if (!noOrder) {
                Swal.fire('Peringatan', 'Silakan masukkan nomor order yang valid.', 'warning');
                return;
            }

            const btn = this.querySelector('button');
            const original = btn.innerHTML;
            btn.innerHTML =
                '<span class="inline-block w-4 h-4 border-2 border-emerald-600 border-t-transparent rounded-full animate-spin me-2"></span>Memproses...';
            btn.disabled = true;

            try {
                const res = await fetch('{{ route('cek.status') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        no_order: noOrder
                    })
                });
                const data = await res.json();

                const resultDiv = document.getElementById('statusResult');
                const statusText = document.getElementById('statusText');
                const statusDetail = document.getElementById('statusDetail');

                if (data.success) {
                    const d = data.data;
                    const title = d.status_order.charAt(0).toUpperCase() + d.status_order.slice(1);
                    statusText.textContent = title;
                    statusDetail.innerHTML = `
                        <div><strong class="text-gray-900">Nama:</strong> ${d.nama_pelanggan }</div>
                        <div><strong class="text-gray-900">Tanggal Terima:</strong> ${d.tanggal_terima}</div>
                        <div><strong class="text-gray-900">Tanggal Selesai:</strong> ${d.tanggal_selesai}</div>
                        <div><strong class="text-gray-900">Total Bayar:</strong> <span class="text-emerald-600 font-bold">${d.total}</span></div>
                        <div><strong class="text-gray-900">Status Pembayaran:</strong> ${d.pembayaran}</div>
                    `;
                    resultDiv.classList.remove('hidden');

                    // Update stepper
                    const statusMap = {
                        'baru': 0,
                        'diproses': 1,
                        'selesai': 2,
                        'diambil': 3
                    };
                    const idx = statusMap[d.status_order] ?? -1;
                    const colors = ['bg-blue-500', 'bg-amber-500', 'bg-emerald-500', 'bg-rose-500'];
                    for (let i = 0; i < 4; i++) {
                        const step = document.getElementById(`step-${i}`);
                        const conn = document.getElementById(`connector-${i}`);
                        if (i <= idx && step) {
                            step.querySelector('.rounded-full').className =
                                `w-20 h-20 rounded-full ${colors[i]} border-3 border-white flex items-center justify-center mb-3 text-2xl shadow-lg transition-all duration-500`;
                            step.querySelector('.opacity-90').className = 'text-sm font-bold text-white';
                        }
                        if (conn && i < idx) {
                            conn.querySelector('div').style.width = '100%';
                            conn.querySelector('div').style.backgroundColor = colors[i];
                        }
                    }
                } else {
                    Swal.fire('Gagal', data.message || 'Status tidak ditemukan.', 'error');
                    resetStepper();
                }
            } catch (err) {
                console.error(err);
                Swal.fire('Error', `Terjadi kesalahan: ${err.message}`, 'error');
                resetStepper();
            } finally {
                btn.innerHTML = original;
                btn.disabled = false;
            }
        });

        function resetStepper() {
            document.getElementById('statusResult').classList.add('hidden');
            for (let i = 0; i < 4; i++) {
                const step = document.getElementById(`step-${i}`);
                const conn = document.getElementById(`connector-${i}`);
                if (step) {
                    step.querySelector('.rounded-full').className =
                        'w-20 h-20 rounded-full bg-white/20 border-3 border-white/40 flex items-center justify-center mb-3 text-2xl shadow-lg transition-all duration-500';
                    step.querySelector('.font-semibold').className = 'text-sm font-semibold opacity-90';
                }
                if (conn) conn.querySelector('div').style.width = '0%';
            }
        }
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

    @stack('scripts')
</body>

</html>
