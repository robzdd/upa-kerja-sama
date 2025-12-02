<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mitra - Portal Kerja POLINDRA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900 flex items-center justify-center p-4">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    <!-- Login Card -->
    <div class="relative w-full max-w-md">
        <!-- Logo/Header -->
        <div class="text-center mb-8 animate-fade-in">
            <div class="inline-block p-4 bg-white/10 backdrop-blur-md rounded-2xl mb-4">
                <i class="fas fa-handshake text-5xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Portal Mitra</h1>
            <p class="text-blue-200">UPA Kerjasama POLINDRA</p>
        </div>

        <!-- Login Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 backdrop-blur-lg animate-slide-up">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Masuk ke Akun Anda</h2>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4 animate-shake">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <p class="text-sm text-red-800">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('mitra.login.submit') }}" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-2"></i>Email Perusahaan
                    </label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           class="w-full px-4 py-3 border-2 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 outline-none @error('email') border-red-500 @else border-gray-200 @enderror" 
                           placeholder="nama@perusahaan.com"
                           required 
                           autofocus>
                </div>

                <!-- Password Input -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="w-full px-4 py-3 border-2 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 outline-none pr-12 @error('password') border-red-500 @else border-gray-200 @enderror" 
                               placeholder="••••••••"
                               required>
                        <button type="button" 
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 transition">
                        <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-800 transition">Ingat saya</span>
                    </label>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium transition">Lupa password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3.5 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200 flex items-center justify-center space-x-2">
                    <span>Masuk</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">Belum punya akun?</span>
                </div>
            </div>

            <!-- Register Link -->
            <a href="{{ route('mitra.register') }}" 
               class="block w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold py-3.5 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200 text-center">
                <i class="fas fa-user-plus mr-2"></i>
                Daftar Sebagai Mitra
            </a>

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-700 transition inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6 text-blue-100 text-sm">
            <p>&copy; 2025 UPA Kerjasama POLINDRA. All rights reserved.</p>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
        .animate-slide-up {
            animation: slide-up 0.6s ease-out;
        }
        .animate-shake {
            animation: shake 0.4s ease-in-out;
        }
    </style>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
