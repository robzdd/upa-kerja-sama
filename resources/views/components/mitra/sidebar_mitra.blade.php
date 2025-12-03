<!-- Sidebar Component -->
<aside class="fixed left-0 top-0 h-screen w-64 bg-slate-900 text-white shadow-xl z-50 flex flex-col transition-all duration-300">
    <!-- Logo/Brand -->
    <div class="p-6 border-b border-slate-800 flex items-center space-x-3">
        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
            <span class="text-white font-bold text-lg">M</span>
        </div>
        <div>
            <h2 class="font-bold text-lg tracking-wide">Mitra Panel</h2>
            <p class="text-xs text-slate-400">Partner Portal</p>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1 custom-scrollbar">
        <!-- Dashboard Section -->
        <div class="mb-6">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Utama</p>
            <a href="{{ route('mitra.dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('mitra.dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200 group">
                <svg class="w-5 h-5 {{ request()->routeIs('mitra.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>
        </div>

        <!-- Recruitment Section -->
        <div class="mb-6">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Rekrutmen</p>
            
            <!-- Buat Lowongan -->
            <a href="{{ route('mitra.lowongan.create') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('mitra.lowongan.create') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200 group mb-1">
                <svg class="w-5 h-5 {{ request()->routeIs('mitra.lowongan.create') ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="font-medium">Pasang Lowongan</span>
            </a>

            <!-- Kelola Lowongan -->
            <a href="{{ route('mitra.lowongan.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('mitra.lowongan.index') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200 group mb-1">
                <svg class="w-5 h-5 {{ request()->routeIs('mitra.lowongan.index') ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span class="font-medium">Kelola Lowongan</span>
            </a>

            <!-- Pelamar -->
            <a href="{{ route('mitra.pelamar.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('mitra.pelamar.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200 group">
                <div class="relative">
                    <svg class="w-5 h-5 {{ request()->routeIs('mitra.pelamar.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z"></path>
                    </svg>
                    @php
                        $pendingCount = 0;
                        if(auth()->guard('mitra')->check() && auth()->guard('mitra')->user()->mitraPerusahaan) {
                            $pendingCount = \App\Models\Pelamar::whereHas('lowongan', function($q) {
                                $q->where('mitra_id', auth()->guard('mitra')->user()->mitraPerusahaan->id);
                            })->where('status', 'pending')->count();
                        }
                    @endphp
                    @if($pendingCount > 0)
                        <span class="absolute -top-1 -right-1 flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                        </span>
                    @endif
                </div>
                <span class="font-medium flex-1">Kandidat Pelamar</span>
                @if($pendingCount > 0)
                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                @endif
            </a>
        </div>

        <!-- Settings Section -->
        <div class="mb-6">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Pengaturan</p>
            
            <a href="{{ route('mitra.profile.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('mitra.profile.index') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200 group mb-1">
                <svg class="w-5 h-5 {{ request()->routeIs('mitra.profile.index') ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span class="font-medium">Profil Perusahaan</span>
            </a>

            <a href="{{ route('mitra.settings.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('mitra.settings.index') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200 group">
                <svg class="w-5 h-5 {{ request()->routeIs('mitra.settings.index') ? 'text-white' : 'text-slate-400 group-hover:text-white' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="font-medium">Pengaturan Akun</span>
            </a>
        </div>
    </nav>

    <!-- User Profile Summary -->
    <div class="p-4 border-t border-slate-800 bg-slate-900">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold overflow-hidden">
                @if(auth()->guard('mitra')->check() && auth()->guard('mitra')->user()->mitraPerusahaan && auth()->guard('mitra')->user()->mitraPerusahaan->logo)
                    <img src="{{ asset('storage/' . auth()->guard('mitra')->user()->mitraPerusahaan->logo) }}" alt="Logo" class="w-full h-full object-cover">
                @else
                    <span>{{ substr(auth()->guard('mitra')->user()->name ?? 'M', 0, 1) }}</span>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ auth()->guard('mitra')->user()->name ?? 'Mitra User' }}</p>
                <p class="text-xs text-slate-400 truncate">{{ auth()->guard('mitra')->user()->email ?? 'email@mitra.com' }}</p>
            </div>
            <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
    class="text-slate-400 hover:text-red-400 transition-colors" title="Logout">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
    </svg>
</button>
        </div>
    </div>
</aside>
<!-- Logout Form -->
<form id="logout-form" action="{{ route('mitra.logout') }}" method="POST" class="hidden">
    @csrf
</form>
