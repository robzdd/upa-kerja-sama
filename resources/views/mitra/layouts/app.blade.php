<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mitra Perusahaan - Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased" x-data="{ sidebarOpen: false }">
    <!-- Sidebar -->
    @include('components.mitra.sidebar_mitra')

    <!-- Topbar -->
    @include('components.mitra.topbar')

    <!-- Main Content -->
    <main class="pt-16 min-h-screen transition-all duration-300" :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-64'">
        <div class="p-4 lg:p-8 max-w-7xl mx-auto">
            <!-- Breadcrumb -->
            @if(isset($breadcrumbs))
                <nav class="flex mb-6" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        @foreach($breadcrumbs as $breadcrumb)
                            @if($loop->last)
                                <li class="inline-flex items-center">
                                    <span class="text-slate-500 text-sm font-medium">{{ $breadcrumb['label'] }}</span>
                                </li>
                            @else
                                <li class="inline-flex items-center">
                                    <a href="{{ $breadcrumb['url'] }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                                        {{ $breadcrumb['label'] }}
                                    </a>
                                    <svg class="w-4 h-4 mx-2 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            @endif

            <!-- Flash Messages -->
            @if($message = Session::get('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 flex items-start space-x-3 shadow-sm" data-auto-hide>
                    <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-green-900">Berhasil</h3>
                        <p class="text-sm text-green-700 mt-1">{{ $message }}</p>
                    </div>
                    <button onclick="this.parentElement.style.display='none'" class="text-green-500 hover:text-green-700 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            @endif

            @if($message = Session::get('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 flex items-start space-x-3 shadow-sm" data-auto-hide>
                    <div class="flex-shrink-0 w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-red-900">Terjadi Kesalahan</h3>
                        <p class="text-sm text-red-700 mt-1">{{ $message }}</p>
                    </div>
                    <button onclick="this.parentElement.style.display='none'" class="text-red-500 hover:text-red-700 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </main>

    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden"
         style="display: none;">
    </div>

    <!-- Logout Form (Hidden) -->
    <form id="logout-form" action="{{ route('mitra.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Scripts -->
    <script>
        // Auto-hide flash messages
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('[data-auto-hide]');
            alerts.forEach(element => {
                setTimeout(() => {
                    element.style.opacity = '0';
                    element.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        element.style.display = 'none';
                    }, 500);
                }, 5000);
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
