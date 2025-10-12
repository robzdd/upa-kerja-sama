<!-- Topbar Component -->
<nav class="fixed top-0 left-0 right-0 h-16 bg-white border-b border-gray-200 shadow-sm ml-64 z-40">
    <div class="h-full flex items-center justify-between px-8">
        <!-- Left Section -->
        <div class="flex items-center space-x-4">
            <h1 class="text-xl font-bold text-gray-800">Dashboard Mitra</h1>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-6">
            <!-- Search Bar -->
            <div class="hidden md:flex items-center bg-gray-100 rounded-lg px-4 py-2 max-w-xs">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" placeholder="Cari lowongan, kandidat..." class="bg-gray-100 ml-2 outline-none text-sm text-gray-700 w-full placeholder-gray-500">
            </div>

            <!-- Notifications -->
            <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors" title="Notifikasi">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="absolute top-1 right-1 inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">3</span>
            </button>

            <!-- Divider -->
            <div class="h-6 w-px bg-gray-300"></div>

            <!-- User Profile Dropdown -->
            <div class="relative group">
                <button class="flex items-center space-x-3 p-2 hover:bg-gray-100 rounded-lg transition-colors focus:outline-none">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-medium text-gray-800">PT. Mitra Jaya</p>
                        <p class="text-xs text-gray-500">Admin</p>
                    </div>
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200">
                </button>

                <!-- Dropdown Menu -->
                <div class="hidden group-hover:block absolute right-0 mt-0 w-56 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100">
                    <!-- User Info -->
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-semibold text-gray-800">PT. Mitra Jaya</p>
                        <p class="text-xs text-gray-500 mt-1">admin@mitra.com</p>
                    </div>
                    <!-- Logout -->
                    <button onclick="document.getElementById('logout-form').submit()" class="w-full flex items-center space-x-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>🚪 Logout</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Logout Form (Hidden) -->
<form id="logout-form" action="#logout" method="POST" style="display: none;">
    @csrf
</form>
