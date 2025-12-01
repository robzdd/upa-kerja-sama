<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Portal Kerja POLINDRA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex">
    <!-- Left Side - Image Section -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
        <!-- Background Image -->
        <img
            src="{{ asset('images/bg/polindra.png') }}"
            alt="POLINDRA Background"
            class="absolute inset-0 w-full h-full object-cover"
        >

        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/80 via-blue-800/70 to-blue-700/60"></div>

        <div class="relative z-10 flex flex-col justify-between p-12 text-white w-full">
            <!-- Logo/Brand -->
            <div>
                <h1 class="text-2xl font-bold mb-2">UPA KERJASAMA<br/>POLINDRA</h1>
            </div>


            <!-- Bottom Text -->
            <div>
                <h2 class="text-3xl font-bold mb-2">Bergabunglah dengan</h2>
                <h2 class="text-3xl font-bold">Jaringan Alumni</h2>
            </div>
        </div>
    </div>

    <!-- Right Side - Register Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-8">
                <h1 class="text-2xl font-bold text-blue-900">UPA KERJASAMA POLINDRA</h1>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun Baru</h1>
                    <p class="text-gray-500 text-sm">Mulai karirmu bersama kami!</p>
                </div>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('alumni.register.submit') }}" method="POST">
                    @csrf
                    
                    @if(isset($googleData))
                        <input type="hidden" name="google_id" value="{{ $googleData['google_id'] }}">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Silakan lengkapi pendaftaran Anda menggunakan akun Google.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Name Input -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Lengkap</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $googleData['name'] ?? '') }}"
                            placeholder="Nama Lengkap"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        >
                    </div>

                    <!-- Email Input -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email', $googleData['email'] ?? '') }}"
                            placeholder="Email"
                            required
                            {{ isset($googleData) ? 'readonly' : '' }}
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition {{ isset($googleData) ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                        >
                    </div>

                    @if(!isset($googleData))
                        <!-- Password Input -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Password"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            >
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Konfirmasi Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                placeholder="Ulangi Password"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            >
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-blue-900 to-purple-700 text-white py-3 rounded-lg font-semibold hover:from-blue-800 hover:to-purple-600 transition duration-300 shadow-lg hover:shadow-xl mb-6"
                    >
                        {{ isset($googleData) ? 'Selesaikan Pendaftaran' : 'Daftar' }}
                    </button>
                </form>

                @if(!isset($googleData))
                    <!-- Divider -->
                    <div class="flex items-center mb-6">
                        <div class="flex-1 border-t border-gray-300"></div>
                        <span class="px-4 text-sm text-gray-500">ATAU</span>
                        <div class="flex-1 border-t border-gray-300"></div>
                    </div>

                    <!-- Google Register Button -->
                    <a href="{{ route('google.login', ['type' => 'register']) }}" class="block mb-6">
                        <button
                            type="button"
                            class="w-full flex items-center justify-center gap-3 bg-white border-2 border-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-50 hover:border-gray-400 transition duration-300"
                        >
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            Daftar dengan Google
                        </button>
                    </a>
                @endif

                <!-- Login Link -->
                <div class="text-center">
                    <span class="text-gray-600 text-sm">Sudah punya akun? </span>
                    <a href="{{ route('alumni.login') }}" class="text-blue-900 text-sm font-semibold hover:underline">Masuk disini</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
