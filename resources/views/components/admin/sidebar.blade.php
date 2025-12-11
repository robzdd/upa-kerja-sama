<aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <div class="p-6 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                <img src="{{ asset('images/logo/polindra_logo.png') }}" alt="UPA ADMIN" class="w-8 h-8 object-cover">
            </div>
            <span class="text-xl font-bold text-gray-800">UPA ADMIN</span>
        </div>
        <!-- Mobile Close Button -->
        <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <nav class="px-4 space-y-1 overflow-y-auto h-[calc(100vh-80px)] custom-scrollbar">
        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu</p>

        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-chart-pie w-5 text-center"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('admin.artikel.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg relative {{ request()->routeIs('admin.artikel.*') ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-chart-bar w-5 text-center"></i>
            <span class="font-medium">Artikel</span>
        </a>

        <a href="{{ route('admin.dokumen-publik.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dokumen-publik.*') || request()->routeIs('admin.kategori-dokumen.*') ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-file-download w-5 text-center"></i>
            <span class="font-medium">Dokumen Publik</span>
        </a>

        @php
            $pendingMitraCount = \App\Models\MitraRegistrationRequest::pending()->count();
        @endphp
        <a href="{{ route('admin.mitra-requests.index') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('admin.mitra-requests.*') ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center space-x-3">
                <i class="fas fa-user-check w-5 text-center"></i>
                <span class="font-medium">Request Mitra</span>
            </div>
            @if($pendingMitraCount > 0)
                <span class="px-2 py-1 bg-red-500 text-white text-xs font-bold rounded-full animate-pulse">
                    {{ $pendingMitraCount > 99 ? '99+' : $pendingMitraCount }}
                </span>
            @endif
        </a>

        <a href="{{ route('admin.program-studi.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.program-studi.*') ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-graduation-cap w-5 text-center"></i>
            <span class="font-medium">Program Studi</span>
        </a>

        <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-users w-5 text-center"></i>
            <span class="font-medium">Pengguna</span>
        </a>

        <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.reports.index') ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-file-alt w-5 text-center"></i>
            <span class="font-medium">Laporan & Statistik</span>
        </a>

        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-8 mb-3">Lainnya</p>

        <form method="POST" action="{{ route('admin.logout') }}" class="mt-4 border-t pt-4">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span class="font-medium">Keluar</span>
            </button>
        </form>
    </nav>
</aside>
