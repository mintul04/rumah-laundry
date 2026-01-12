<header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-40">
    <div class="flex items-center justify-between px-6 py-4">
        <!-- Page Title -->
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
        </div>
        
        <!-- User Dropdown (Alpine.js) -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 text-gray-800 hover:text-gray-600 focus:outline-none transition-colors" :aria-expanded="open"
            aria-haspopup="true">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-medium text-gray-700">{{ auth()->user()->nama ?? 'Manda' }}</div>
                </div>
                @if (auth()->user()->foto)
                    <img src="{{ Storage::url(auth()->user()->foto) }}" alt="Foto Profil" class="w-10 h-10 rounded-full object-cover">
                @else
                <div class="w-10 h-10 rounded-full bg-linear-to-br from-blue-700 to-blue-400 flex items-center justify-center text-white font-semibold text-sm">
                    {{ auth()->user() ? strtoupper(substr(auth()->user()->nama, 0, 1)) : 'M' }}
                </div>
                @endif
            </button>

            <!-- Dropdown Menu -->
            <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 mt-2 w-56 origin-top-right bg-white rounded-xl shadow-lg ring-1 ring-black/10 z-50 overflow-hidden" x-cloak>
                <!-- Profile -->
                <a href="{{ route('profile.index') }}"
                    class="flex items-center gap-3 px-4 py-3 text-blue-600 font-semibold hover:bg-linear-to-br hover:from-blue-50 hover:to-blue-100 transition-all duration-200">
                    <i class="fa fa-user-circle text-lg"></i>
                    Profile
                </a>

                <hr class="border-gray-200 my-1">

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full text-left flex items-center gap-3 px-4 py-3 text-red-600 font-semibold hover:bg-linear-to-br hover:from-red-50 hover:to-red-100 transition-all duration-200">
                        <i class="fa fa-sign-out-alt text-lg"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
