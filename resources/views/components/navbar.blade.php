<!-- Navigation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var header = document.getElementById('sticky-nav');
        var scrollClass = 'scroll-nav';

        window.onscroll = function() {
            if (window.pageYOffset > 50) {
                header.classList.add(scrollClass);
            } else {
                header.classList.remove(scrollClass);
            }
        };
    });
</script>

<style>
    .scroll-nav {
        @apply bg-gradient-to-r from-blue-900 via-purple-800 to-purple-900 shadow-lg bg-opacity-95 backdrop-blur-sm;
    }
    #sticky-nav {
        transition: all 0.3s ease;
    }
</style>

<header class="fixed top-0 left-0 w-full z-50" id="sticky-nav">
    <nav class="text-white bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900 transition-all duration-300">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo/polindra_logo.png') }}" alt="Logo" class="w-10 h-10">
                    <span class="text-xl font-bold">Portal Kerja POLINDRA</span>
                </div>

                <!-- Navigation Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('alumni.dashboard') }}"
                        class="hover:text-gray-200 transition {{ request()->routeIs('dashboard.alumni') ? 'font-semibold border-b-2 border-white pb-1' : '' }}">Beranda</a>
                    <a href="{{ route('artikel.page') }}"
                        class="hover:text-gray-200 transition {{ request()->routeIs('artikel.page') ? 'font-semibold border-b-2 border-white pb-1' : '' }}">Artikel</a>
                    <a href="{{ route('alumni.cari_lowongan') }}" class="hover:text-gray-200 transition">Cari Lowongan</a>
                    <a href="{{ route('alumni.list_perusahaan') }}" class="hover:text-gray-200 transition">List Perusahaan</a>
                    <a href="{{ route('alumni.tentang_kami') }}" class="hover:text-gray-200 transition">Tentang Kami</a>
                </div>

                <!-- User Profile Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    @php
                        $user = Auth::user() ?? Auth::guard('mitra')->user();
                        $foto = $user->foto ?? null;
                    @endphp

                    <!-- Box Profil -->
                    <button @click="open = !open"
                            class="flex items-center w-44 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl px-3 py-2 focus:outline-none transition group">
                        <!-- Foto atau Inisial -->
                        @if ($foto)
                            <img src="{{ asset('storage/' . $foto) }}"
                                 alt="Profile Photo"
                                 class="w-9 h-9 rounded-lg object-cover border border-white/30">
                        @else
                            <div class="w-9 h-9 bg-gray-300 rounded-lg flex items-center justify-center border border-white/30">
                                <span class="text-gray-700 font-semibold text-lg">
                                    {{ Str::upper(substr($user->name ?? 'U', 0, 1)) }}
                                </span>
                            </div>
                        @endif

                        <!-- Nama -->
                        <div class="ml-3 flex-1 min-w-0">
                            <p class="truncate text-sm font-medium text-white">
                                {{ $user->name ?? 'User' }}
                            </p>
                        </div>

                        <!-- Icon dropdown -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false"
                         class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50 py-2"
                         x-transition>
                        <a href="{{ route('alumni.cv.index') }}"
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ Auth::user() ? route('alumni.logout') : route('mitra.logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Spacer to prevent content from going under fixed navbar -->
<div class="h-[72px]"></div>

<script src="//unpkg.com/alpinejs" defer></script>
