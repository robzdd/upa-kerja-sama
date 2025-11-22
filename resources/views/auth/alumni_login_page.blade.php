<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Kerja POLINDRA</title>
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
                <h2 class="text-3xl font-bold mb-2">Dekatkan dirimu dengan</h2>
                <h2 class="text-3xl font-bold">kesuksesan</h2>
            </div>
        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-8">
                <h1 class="text-2xl font-bold text-blue-900">UPA KERJASAMA POLINDRA</h1>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat datang di</h1>
                    <h2 class="text-3xl font-bold text-blue-900 mb-2">Portal Kerja POLINDRA</h2>
                    <p class="text-gray-500 text-sm">Temukan pekerjaan idamanmu disini!</p>
                </div>

                <!-- Alerts -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Berhasil!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if (session('info'))
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Info!</strong>
                        <span class="block sm:inline">{{ session('info') }}</span>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Perhatian!</strong>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="" method="POST">
                    @csrf
                    <!-- Email Input -->
                    <div class="mb-4">
                        <input
                            type="email"
                            name="email"
                            placeholder="Email"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        >
                    </div>

                    <!-- Password Input -->
                    <div class="mb-2">
                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        >
                    </div>

                    <!-- Forgot Password Link -->
                    <div class="text-right mb-6">
                        <a href="#" class="text-sm text-gray-600 hover:text-blue-900 transition">Lupa Password?</a>
                    </div>

                    <!-- Login Button -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-blue-900 to-purple-700 text-white py-3 rounded-lg font-semibold hover:from-blue-800 hover:to-purple-600 transition duration-300 shadow-lg hover:shadow-xl"
                    >
                        Masuk
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center my-6">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="px-4 text-sm text-gray-500">OR</span>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                <!-- Google Login Button -->

                <a href="{{ route('google.login') }}" class="btn btn-danger">
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
                        Masuk dengan Google
                    </button>
                </a>


                <!-- Register Link -->
                <div class="text-center mt-6">
                    <span class="text-gray-600 text-sm">Belum punya akun? </span>
                    <a href="{{ route('alumni.register') }}" class="text-blue-900 text-sm font-semibold hover:underline">Daftar disini</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
