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
                    <img src="{{ Storage::url('images/polindra_logo.png') }}" alt="Logo" class="w-10 h-10">
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

                <!-- User Profile -->
                <div class="flex items-center space-x-4">
                    <button class="relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-gray-700 font-semibold">U</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Spacer to prevent content from going under fixed navbar -->
<div class="h-[72px]"></div>
