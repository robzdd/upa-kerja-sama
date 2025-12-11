<!-- Topbar Component -->
<nav class="fixed top-0 left-0 right-0 h-16 bg-white border-b border-gray-200 shadow-sm z-40 transition-all duration-300"
     :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-64'">
    <div class="h-full flex items-center justify-between px-4 lg:px-6">
        <!-- Left Section -->
        <div class="flex items-center space-x-4">
            <!-- Hamburger Menu (Mobile) -->
            <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <h1 class="text-xl font-bold text-gray-800 tracking-tight">
                @yield('title', 'Dashboard')
            </h1>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <!-- Search Bar -->
            <div class="hidden md:flex items-center bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 w-64 focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-transparent transition-all">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" placeholder="Cari..." class="bg-transparent ml-2 outline-none text-sm text-gray-700 w-full placeholder-gray-400">
            </div>

            <!-- Notifications -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="relative p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500" title="Notifikasi">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    @if(auth()->guard('mitra')->user()->unreadNotifications->count() > 0)
                        <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                        </span>
                    @endif
                </button>

                <!-- Notification Dropdown -->
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50" style="display: none;">
                    <div class="px-4 py-2 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-gray-800">Notifikasi</h3>
                        @if(auth()->guard('mitra')->user()->unreadNotifications->count() > 0)
                            <form action="{{ route('mitra.notifications.markAsRead') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs text-blue-600 hover:text-blue-800">Tandai sudah dibaca</button>
                            </form>
                        @endif
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        @forelse(auth()->guard('mitra')->user()->unreadNotifications as $notification)
                            <a href="{{ route('mitra.pelamar.show', $notification->data['pelamar_id']) }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0">
                                <p class="text-sm text-gray-800 font-medium">{{ $notification->data['message'] }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                            </a>
                        @empty
                            <div class="px-4 py-6 text-center text-gray-500 text-sm">
                                Tidak ada notifikasi baru
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Alpine.js for dropdown -->
<script src="//unpkg.com/alpinejs" defer></script>

<!-- Logout Form (Hidden) -->
<form id="logout-form" action="#logout" method="POST" style="display: none;">
    @csrf
</form>
