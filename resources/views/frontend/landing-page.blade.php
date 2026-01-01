<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RumahLaundry - Layanan Laundry Offline Terpercaya</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />

    {{-- Font Awesome --}}
    <link href="{{ asset('assets/vendor/fontawesome/all.min.css') }}" rel="stylesheet">

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
    </style>

    @stack('styles')
</head>

<body class="font-sans text-gray-800 bg-white antialiased overflow-x-hidden">
    <div x-data="{ mobileMenuOpen: false }">
        <!-- Navbar -->
        <nav x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 50)" :class="{ 'shadow-md bg-white/95 backdrop-blur-sm': scrolled }" class="sticky top-0 z-50 w-full bg-white py-4 transition-all duration-300">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between">
                    <!-- Brand -->
                    <a href="#home" class="flex items-center gap-2 text-blue-600 font-extrabold text-lg no-underline">
                        @if ($pengaturan->logo)
                            <div class="w-8 h-8 rounded bg-linear-to-br from-blue-600 to-cyan-500 shadow-md flex items-center justify-center">
                                <img src="{{ Storage::url($pengaturan->logo) }}" alt="Logo" class="w-full h-full object-contain rounded-sm">
                            </div>
                        @else
                            <div class="w-8 h-8 rounded bg-linear-to-br from-blue-600 to-cyan-500 shadow-md flex items-center justify-center">
                                <i class="fas fa-water text-white text-sm"></i>
                            </div>
                        @endif
                        <span>{{ $pengaturan->nama_laundry ?? 'RumahLaundry' }}</span>
                    </a>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-gray-600 hover:text-blue-600 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <!-- Desktop Menu -->
                    <div class="hidden lg:flex items-center gap-2">
                        <a href="#home" class="px-4 py-2 font-medium text-gray-600 hover:text-blue-600 transition-colors">Beranda</a>
                        <a href="#location" class="px-4 py-2 font-medium text-gray-600 hover:text-blue-600 transition-colors">Lokasi</a>
                        <a href="#features" class="px-4 py-2 font-medium text-gray-600 hover:text-blue-600 transition-colors">Keunggulan</a>
                        <a href="#services" class="px-4 py-2 font-medium text-gray-600 hover:text-blue-600 transition-colors">Layanan</a>
                        <a href="#process" class="px-4 py-2 font-medium text-gray-600 hover:text-blue-600 transition-colors">Cek Pesanan</a>
                        <a href="{{ route('login') }}" class="ml-4 px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition-all">
                            Login
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="lg:hidden mt-4 py-4 px-4 bg-white rounded-xl shadow-lg border border-gray-200" x-cloak>
                    <div class="flex flex-col gap-3">
                        <a href="#home" class="px-4 py-2 font-medium text-gray-600 hover:text-blue-600 transition-colors">Beranda</a>
                        <a href="#location" class="px-4 py-2 font-medium text-gray-600 hover:text-blue-600 transition-colors">Lokasi</a>
                        <a href="#features" class="px-4 py-2 font-medium text-gray-600 hover:text-blue-600 transition-colors">Keunggulan</a>
                        <a href="#services" class="px-4 py-2 font-medium text-gray-600 hover:text-blue-600 transition-colors">Layanan</a>
                        <a href="#process" class="px-4 py-2 font-medium text-gray-600 hover:text-blue-600 transition-colors">Cek Pesanan</a>
                        <a href="{{ route('login') }}" class="mt-2 px-5 py-2 bg-blue-600 text-center text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition-all">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="home" class="relative py-20 md:py-24 bg-linear-to-br from-blue-50 via-cyan-50 to-gray-50 overflow-hidden">
            <div class="absolute top-[-10%] right-[-5%] w-150 h-150 rounded-full bg-[radial-linear(circle,rgba(0,102,255,0.08)_0%,transparent_70%)]"></div>
            <div class="container mx-auto px-4">
                <div class="flex flex-col lg:flex-row items-center gap-10">
                    <div class="lg:w-1/2">
                        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                            Cuci & Setrika <span class="text-blue-600">Semudah</span> Pesan Makanan
                        </h1>
                        <p class="mt-4 text-lg text-gray-600 max-w-lg">
                            Laundry offline terpercaya dengan layanan cuci & setrika yang wangi dan berkualitas tinggi untuk keluarga Anda.
                        </p>

                        <!-- Stats -->
                        <div class="mt-10 flex flex-wrap gap-6">
                            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-blue-500 transition-all hover:-translate-y-1">
                                <div class="text-2xl md:text-3xl font-extrabold text-blue-600">10K+</div>
                                <div class="text-gray-600 text-sm font-medium">Pelanggan Setia</div>
                            </div>
                            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-blue-500 transition-all hover:-translate-y-1">
                                <div class="text-2xl md:text-3xl font-extrabold text-blue-600">24/7</div>
                                <div class="text-gray-600 text-sm font-medium">Layanan</div>
                            </div>
                            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-blue-500 transition-all hover:-translate-y-1">
                                <div class="text-2xl md:text-3xl font-extrabold text-blue-600">99%</div>
                                <div class="text-gray-600 text-sm font-medium">Kepuasan</div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2 flex justify-center">
                        <div class="bg-white rounded-2xl shadow-xl p-8 animate-float">
                            <!-- SVG Washing Machine -->
                            <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="75" y="50" width="150" height="200" rx="12" fill="#F0F9FF" stroke="#0066FF" stroke-width="2" />
                                <rect x="90" y="70" width="120" height="30" rx="6" fill="#E0F2FE" />
                                <circle cx="110" cy="85" r="5" fill="#0066FF" />
                                <circle cx="130" cy="85" r="5" fill="#06B6D4" />
                                <circle cx="150" cy="85" r="5" fill="#10B981" />
                                <circle cx="150" cy="150" r="50" fill="white" stroke="#0066FF" stroke-width="3" />
                                <circle cx="150" cy="150" r="35" fill="#E0F2FE" stroke="#0066FF" stroke-width="2" />
                                <circle cx="150" cy="150" r="20" fill="white" stroke="#0066FF" stroke-width="1.5" />
                                <rect x="100" y="210" width="25" height="30" rx="4" fill="#10B981" opacity="0.8" />
                                <rect x="135" y="210" width="25" height="30" rx="4" fill="#F59E0B" opacity="0.8" />
                                <rect x="170" y="210" width="25" height="30" rx="4" fill="#0066FF" opacity="0.8" />
                                <circle cx="120" cy="120" r="6" fill="#06B6D4" opacity="0.5" />
                                <circle cx="180" cy="130" r="5" fill="#06B6D4" opacity="0.4" />
                                <circle cx="160" cy="110" r="7" fill="#06B6D4" opacity="0.6" />
                                <path d="M150 40 L152 47 L159 49 L152 51 L150 58 L148 51 L141 49 L148 47 Z" fill="#F59E0B" opacity="0.7" />
                                <path d="M220 140 L222 145 L227 147 L222 149 L220 154 L218 149 L213 147 L218 145 Z" fill="#10B981" opacity="0.7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Location Section -->
        <section id="location" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-2xl mx-auto mb-14">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Lokasi Laundry Kami</h2>
                    <p class="mt-3 text-lg text-gray-600">
                        Datang langsung ke outlet kami karena kami menggunakan layanan laundry terpercaya
                    </p>
                </div>
                <div class="max-w-4xl mx-auto">
                    <div class="relative bg-linear-to-br from-white to-gray-50 rounded-2xl p-8 border border-gray-200 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all">
                        <div class="absolute top-0 left-0 w-full h-1 bg-linear-to-r from-blue-600 to-cyan-500 rounded-t-2xl"></div>
                        <div class="flex justify-center mb-6">
                            <div class="w-16 h-16 rounded-lg bg-linear-to-br from-blue-600 to-cyan-500 flex items-center justify-center shadow-md">
                                <i class="fas fa-store text-white text-xl"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-center mb-4">{{ $pengaturan->nama_laundry ?? 'RumahLaundry' }} Central</h3>
                        <p class="text-gray-600 text-center mb-6">
                            Outlet utama kami dengan fasilitas lengkap dan staf profesional siap melayani Anda.
                        </p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-map-marker-alt text-blue-600 mt-0.5"></i>
                                <span>{{ $pengaturan->alamat_laundry }}</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-clock text-blue-600 mt-0.5"></i>
                                <span>Buka 24/7 jam</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-phone text-blue-600 mt-0.5"></i>
                                <span>{{ $pengaturan->telepon_laundry ?? '+62 812-3456-7890' }}</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-wifi text-blue-600 mt-0.5"></i>
                                <span>Free WiFi untuk pelanggan</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-parking text-blue-600 mt-0.5"></i>
                                <span>Area parkir luas & aman</span>
                            </li>
                        </ul>
                        <div class="flex flex-wrap gap-4 justify-center">
                            <a href="https://maps.google.com" target="_blank"
                                class="flex items-center gap-2 px-5 py-2.5 bg-emerald-500 text-white font-semibold rounded-lg shadow hover:bg-emerald-600 transition-all">
                                <i class="fas fa-directions"></i> Petunjuk Arah
                            </a>
                            <a href="https://wa.me/{{ $pengaturan->telepon ?? '6281234567890' }}" target="_blank"
                                class="flex items-center gap-2 px-5 py-2.5 bg-white text-gray-800 font-semibold rounded-lg border border-gray-300 shadow hover:bg-gray-50 transition-all">
                                <i class="fas fa-phone"></i> Telepon Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-2xl mx-auto mb-14">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                        Keunggulan {{ $pengaturan->nama_laundry ?? 'RumahLaundry' }}
                    </h2>
                    <p class="mt-3 text-lg text-gray-600">Mengapa ribuan pelanggan mempercayai laundry kami</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php($features = [['icon' => 'fa-user-shield', 'title' => 'Laundry Terpercaya', 'desc' => 'Tim kami terdiri dari profesional yang berpengalaman dan memiliki standar kualitas terbaik'], ['icon' => 'fa-tag', 'title' => 'Harga Jelas', 'desc' => 'Tidak ada biaya tersembunyi, bayar sesuai berat dengan timbangan digital'], ['icon' => 'fa-bolt', 'title' => 'Express 24 Jam', 'desc' => 'Layanan kilat untuk kebutuhan mendesak dengan proses maksimal 24 jam'], ['icon' => 'fa-shield-alt', 'title' => 'Laundry Aman', 'desc' => 'Perlakuan khusus untuk bahan-bahan sensitif dengan deterjen hipoalergenik']])
                    @foreach ($features as $index => $f)
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all fade-in-up"
                            style="animation-delay: {{ ($index + 1) * 0.1 }}s">
                            <div class="flex justify-center mb-4">
                                <div class="w-14 h-14 rounded-full bg-linear-to-br from-blue-600 to-cyan-500 flex items-center justify-center shadow-md">
                                    <i class="fas {{ $f['icon'] }} text-white text-lg"></i>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-center mb-2">{{ $f['title'] }}</h3>
                            <p class="text-gray-600 text-sm text-center">{{ $f['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-2xl mx-auto mb-14">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Layanan Kami</h2>
                    <p class="mt-3 text-lg text-gray-600">Yang Paling Rekomend Buat Anda</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    <!-- Cuci Biasa -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all fade-in-up" style="animation-delay: 0.1s;">
                        <div class="flex justify-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-linear-to-br from-blue-600 to-cyan-500 flex items-center justify-center shadow-sm">
                                <i class="fas fa-soap text-white"></i>
                            </div>
                        </div>
                        <img src="{{ asset('img/cuci biasa.jpg') }}" alt="Cuci Biasa" class="w-full h-40 object-contain rounded mb-4">
                        <h3 class="text-xl font-bold mb-2">Cuci Biasa</h3>
                        <p class="text-gray-600 text-sm mb-3">Cucian standar dengan deterjen berkualitas tinggi dan pewangi pilihan</p>
                        <p class="text-blue-600 font-bold mb-2">Mulai dari <strong>Rp 5.000/Pcs</strong></p>
                        <p class="text-gray-500 text-sm flex items-center gap-1">
                            <i class="far fa-clock"></i> 3-4 hari kerja
                        </p>
                    </div>

                    <!-- Cuci Express (Featured) -->
                    <div class="bg-white p-6 rounded-xl border-2 border-amber-400 shadow-md relative hover:shadow-xl hover:-translate-y-1 transition-all fade-in-up" style="animation-delay: 0.2s;">
                        <span class="absolute top-4 right-4 bg-amber-400 text-white text-xs font-bold px-3 py-1 rounded-full shadow">Paling Populer</span>
                        <div class="flex justify-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-linear-to-br from-amber-500 to-red-500 flex items-center justify-center shadow-sm">
                                <i class="fas fa-star text-white"></i>
                            </div>
                        </div>
                        <img src="{{ asset('img/cuci express.png') }}" alt="Express 24 Jam" class="w-full h-40 object-contain rounded mb-4">
                        <h3 class="text-xl font-bold mb-2">Cuci Express/Regular</h3>
                        <p class="text-gray-600 text-sm mb-3">Layanan kilat dalam 24 jam untuk kebutuhan mendesak</p>
                        <p class="text-amber-500 font-bold mb-2">Mulai dari <strong>Rp 10.000/kg</strong></p>
                        <p class="text-gray-500 text-sm flex items-center gap-1">
                            <i class="far fa-clock"></i> 1 hari kerja
                        </p>
                    </div>

                    <!-- Cuci + Setrika -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all fade-in-up" style="animation-delay: 0.3s;">
                        <div class="flex justify-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-linear-to-br from-blue-600 to-cyan-500 flex items-center justify-center shadow-sm">
                                <i class="fas fa-tshirt text-white"></i>
                            </div>
                        </div>
                        <img src="{{ asset('img/cuci setrika.jpg') }}" alt="Cuci + Setrika" class="w-full h-40 object-contain rounded mb-4">
                        <h3 class="text-xl font-bold mb-2">Cuci + Setrika</h3>
                        <p class="text-gray-600 text-sm mb-3">Cucian lengkap dengan setrika profesional dan lipatan rapi</p>
                        <p class="text-blue-600 font-bold mb-2">Mulai dari <strong>Rp 8.000/Lusin</strong></p>
                        <p class="text-gray-500 text-sm flex items-center gap-1">
                            <i class="far fa-clock"></i> 2-3 hari kerja
                        </p>
                    </div>
                </div>

                <!-- Dan Masih Banyak Lainnya -->
                <div class="text-center">
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Dan Masih Banyak Lainnya</h2>
                    <p class="mt-3 text-lg text-gray-600">Berbagai paket laundry sesuai kebutuhan Anda</p>
                </div>
            </div>
        </section>

        <!-- Cek Status Section -->
        <section id="process" class="py-20 bg-linear-to-br from-blue-600 to-blue-800 text-white relative overflow-hidden">
            <div class="absolute top-[-20%] left-[-10%] w-150 h-150 rounded-full bg-[radial-linear(circle,rgba(255,255,255,0.1)_0%,transparent_70%)]"></div>
            <div class="container mx-auto px-4 relative">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <h2 class="text-3xl md:text-4xl font-extrabold">Cek Status Pesanan Anda</h2>
                    <p class="mt-3 text-lg opacity-90">
                        Masukkan kode pesanan anda untuk melihat status: Baru, Diproses, Selesai, atau Diambil
                    </p>
                </div>
                <div class="max-w-lg mx-auto">
                    <form id="statusForm" class="bg-white rounded-xl shadow-xl overflow-hidden mb-8">
                        @csrf
                        <div class="flex">
                            <input type="text" id="orderCode" placeholder="Contoh: ORD-000001" class="flex-1 px-6 py-4 text-gray-800 focus:outline-none" required>
                            <button type="submit" class="bg-emerald-500 text-white px-6 py-4 font-bold hover:bg-emerald-600 transition-colors whitespace-nowrap">
                                <i class="fas fa-search me-2"></i>Cek Status
                            </button>
                        </div>
                    </form>

                    <div id="statusResult" class="hidden bg-white text-gray-800 rounded-xl shadow-xl p-6 mb-10">
                        <h5 class="text-lg font-bold mb-3">Status Pesanan: <span id="statusText"></span></h5>
                        <p id="statusDetail" class="text-sm leading-relaxed"></p>
                    </div>

                    <!-- Stepper -->
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-6 sm:gap-0">
                        @php($steps = [['icon' => 'fa-shopping-bag', 'label' => 'Baru'], ['icon' => 'fa-cogs', 'label' => 'Diproses'], ['icon' => 'fa-check-circle', 'label' => 'Selesai'], ['icon' => 'fa-hand-holding', 'label' => 'Diambil']])
                        @foreach ($steps as $i => $step)
                            <div id="step-{{ $i }}" class="text-center">
                                <div class="w-16 h-16 rounded-full bg-white/20 border-2 border-white/30 flex items-center justify-center mb-2 text-xl">
                                    <i class="fas {{ $step['icon'] }}"></i>
                                </div>
                                <div class="text-sm font-medium opacity-80">{{ $step['label'] }}</div>
                            </div>
                            @if (!$loop->last)
                                <div id="connector-{{ $i }}" class="h-1 w-12 bg-white/20 rounded relative hidden sm:block">
                                    <div class="absolute top-0 left-0 h-full bg-emerald-400 rounded" style="width: 0%; transition: width 1s ease;"></div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer id="footer" class="bg-gray-900 text-gray-300 pt-16 pb-8 relative">
            <div class="absolute top-0 left-0 right-0 h-1 bg-linear-to-r from-blue-600 to-cyan-500"></div>
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                    <div>
                        <h5 class="text-white text-lg font-bold mb-4">{{ $pengaturan->nama_laundry ?? 'RumahLaundry' }}</h5>
                        <p class="text-sm mb-4">
                            Layanan laundry offline terpercaya dengan standar kebersihan tinggi dan pelayanan maksimal untuk seluruh keluarga Anda.
                        </p>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition-colors">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-emerald-600 transition-colors">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 transition-colors">
                                <i class="fas fa-map-marker-alt"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h5 class="text-white text-lg font-bold mb-4">Layanan</h5>
                        <ul class="space-y-2">
                            <li><a href="#services" class="hover:text-blue-400 transition-colors">Cuci Biasa</a></li>
                            <li><a href="#services" class="hover:text-blue-400 transition-colors">Cuci + Setrika</a></li>
                            <li><a href="#services" class="hover:text-blue-400 transition-colors">Express 24 Jam</a></li>
                            <li><a href="#services" class="hover:text-blue-400 transition-colors">Layanan Khusus</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="text-white text-lg font-bold mb-4">Kontak & Lokasi</h5>
                        <p class="text-sm flex items-start gap-2 mb-2">
                            <i class="fas fa-map-marker-alt mt-0.5"></i>
                            {{ $pengaturan->alamat_laundry ?? 'Jl. Laundry No. 123, Jakarta' }}
                        </p>
                        <p class="text-sm flex items-center gap-2 mb-2">
                            <i class="fas fa-phone"></i>
                            +{{ $pengaturan->telepon_laundry ?? '62 812-3456-7890' }}
                        </p>
                        <p class="text-sm flex items-center gap-2 mb-2">
                            <i class="fas fa-envelope"></i>
                            {{ $pengaturan->email_laundry ?? 'info@rumahlaundry.id' }}
                        </p>
                        <p class="text-sm flex items-center gap-2">
                            <i class="fas fa-clock"></i> Buka 24/7
                        </p>
                    </div>
                </div>
                <div class="pt-6 mt-8 border-t border-gray-800 text-center text-sm">
                    <p>
                        &copy; 2025 RumahLaundry. Semua hak dilindungi. |
                        <a href="#" class="hover:text-blue-400">Kebijakan Privasi</a> |
                        <a href="#" class="hover:text-blue-400">Syarat Layanan</a> |
                        <a href="{{ route('login') }}" class="hover:text-blue-400">Admin Area</a>
                    </p>
                </div>
            </div>
        </footer>
    </div>

    {{-- SweetAlert --}}
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    {{-- Fontawesome --}}
    <script src="{{ asset('assets/vendor/fontawesome/all.min.js') }}"></script>

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
                    // Close mobile menu
                    if (window.innerWidth < 1024) {
                        const mobileMenu = document.querySelector('[x-data*="mobileMenuOpen"]');
                        if (mobileMenu) mobileMenu.__x.$data.mobileMenuOpen = false;
                    }
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

        // Float animation (hero SVG)
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
            btn.innerHTML = '<span class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin me-2"></span>Memproses...';
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
                        <strong>Nama:</strong> ${d.nama_pelanggan}<br>
                        <strong>Tanggal Terima:</strong> ${d.tanggal_terima}<br>
                        <strong>Tanggal Selesai:</strong> ${d.tanggal_selesai}<br>
                        <strong>Total Bayar:</strong> ${d.total}<br>
                        <strong>Status Pembayaran:</strong> ${d.pembayaran}
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
                    for (let i = 0; i < 4; i++) {
                        const step = document.getElementById(`step-${i}`);
                        const conn = document.getElementById(`connector-${i}`);
                        if (i <= idx && step) {
                            step.querySelector('.rounded-full').classList.replace('bg-white/20', 'bg-emerald-400');
                            step.querySelector('.opacity-80').classList.replace('opacity-80', 'text-white font-bold');
                        }
                        if (conn && i < idx) {
                            conn.querySelector('div').style.width = '100%';
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
                    step.querySelector('.rounded-full').classList.replace('bg-emerald-400', 'bg-white/20');
                    step.querySelector('.text-white').classList.replace('text-white', 'opacity-80');
                    step.querySelector('.font-bold').classList.remove('font-bold');
                }
                if (conn) conn.querySelector('div').style.width = '0%';
            }
        }
    </script>

    @stack('scripts')
</body>

</html>
