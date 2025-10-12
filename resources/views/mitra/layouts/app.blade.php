<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mitra Perusahaan - Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    @include('components.mitra.sidebar_mitra')

    <!-- Topbar -->
    @include('components.mitra.topbar')

    <!-- Main Content -->
    <main class="ml-64 mt-16 p-4 lg:p-8 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumb -->
            @if(isset($breadcrumbs))
                <nav class="flex mb-6" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        @foreach($breadcrumbs as $breadcrumb)
                            @if($loop->last)
                                <li class="inline-flex items-center">
                                    <span class="text-gray-600 text-sm font-medium">{{ $breadcrumb['label'] }}</span>
                                </li>
                            @else
                                <li class="inline-flex items-center">
                                    <a href="{{ $breadcrumb['url'] }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        {{ $breadcrumb['label'] }}
                                    </a>
                                    <svg class="w-4 h-4 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
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
                <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 flex items-start space-x-3">
                    <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-green-800">Berhasil</h3>
                        <p class="text-sm text-green-700 mt-1">{{ $message }}</p>
                    </div>
                    <button onclick="this.parentElement.style.display='none'" class="text-green-600 hover:text-green-800">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            @endif

            @if($message = Session::get('error'))
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 flex items-start space-x-3">
                    <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-red-800">Terjadi Kesalahan</h3>
                        <p class="text-sm text-red-700 mt-1">{{ $message }}</p>
                    </div>
                    <button onclick="this.parentElement.style.display='none'" class="text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            @endif

            @if($message = Session::get('warning'))
                <div class="mb-6 p-4 rounded-lg bg-yellow-50 border border-yellow-200 flex items-start space-x-3">
                    <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-yellow-800">Perhatian</h3>
                        <p class="text-sm text-yellow-700 mt-1">{{ $message }}</p>
                    </div>
                    <button onclick="this.parentElement.style.display='none'" class="text-yellow-600 hover:text-yellow-800">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200">
                    <h3 class="text-sm font-medium text-red-800 mb-2">Terdapat {{ $errors->count() }} kesalahan:</h3>
                    <ul class="text-sm text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="flex items-center space-x-2">
                                <span class="inline-block w-1.5 h-1.5 bg-red-600 rounded-full"></span>
                                <span>{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </main>

    {{-- <!-- Footer -->
    @include('mitra.components.footer') --}}

    <!-- Scripts -->
    <script>
        // Auto-hide flash messages setelah 5 detik
        document.querySelectorAll('[data-auto-hide]').forEach(element => {
            setTimeout(() => {
                element.style.display = 'none';
            }, 5000);
        });
    </script>

    @stack('scripts')
</body>
</html>
