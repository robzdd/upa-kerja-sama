<aside class="w-64 bg-white shadow-lg flex-shrink-0">
    <div class="p-6">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                <img src="{{ asset('images/logo/polindra_logo.png') }}" alt="UPA ADMIN" class="w-8 h-8 object-cover">
            </div>
            <span class="text-xl font-bold text-gray-800">UPA ADMIN</span>
        </div>
    </div>

    <nav class="px-4 space-y-1">
        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu</p>

        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-chart-pie"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('admin.artikel.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg relative {{ request()->routeIs('admin.artikel.index') ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-chart-bar"></i>
            <span class="font-medium">Artikel</span>
        </a>

        <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-users"></i>
            <span class="font-medium">Pengguna</span>
        </a>

        <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.reports.index') ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-file-alt"></i>
            <span class="font-medium">Laporan & Statistik</span>
        </a>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50">
                <i class="fas fa-sign-out-alt"></i>
                <span class="font-medium">Keluar</span>
            </button>
        </form>
    </nav>
</aside>
