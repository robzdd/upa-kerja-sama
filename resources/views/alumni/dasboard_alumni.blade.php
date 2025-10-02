<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Portal Kerja POLINDRA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header Section with Gradient Background -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900 text-white pb-32">
        <!-- Navbar -->
        @include('components.navbar')

        <!-- Hero Content -->
        <div class="container mx-auto px-6 py-20 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Portal Kerja Polindra Label -->
                <div class="inline-block mb-8">
                    <span class="text-sm font-semibold bg-white/20 backdrop-blur-sm px-6 py-2 rounded-full border border-white/30">
                        Portal Karir Polindra
                    </span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    Temukan Pekerjaan Impian<br>
                    Sesuai Dengan Skill dan<br>
                    Passion Anda
                </h1>

                <!-- Subheading -->
                <p class="text-lg md:text-xl text-white/90 mb-10">
                    Temukan dan daftar pekerjaan dengan mudah
                </p>

                <!-- CTA Button -->
                <a href="#" class="inline-block bg-white text-blue-900 px-12 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                    Temukan Pekerjaan
                </a>
            </div>
        </div>
    </div>

    <!-- Partner Logos Section with Animation -->
    <div class="bg-white py-6 border-y border-gray-200 overflow-hidden">
        <style>
            @keyframes scroll {
                0% {
                    transform: translateX(0);
                }
                100% {
                    transform: translateX(-50%);
                }
            }
            .animate-scroll {
                animation: scroll 30s linear infinite;
            }
            .logo-track:hover .animate-scroll {
                animation-play-state: paused;
            }
        </style>
        
        <div class="logo-track">
            <div class="flex animate-scroll">
                <!-- First Set of Logos -->
                <div class="flex items-center space-x-16 px-8">
                    <div class="flex items-center space-x-3 text-gray-600 flex-shrink-0">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/>
                        </svg>
                        <span class="font-bold text-xl whitespace-nowrap">PERTAMINA</span>
                    </div>
                    
                    <div class="flex items-center space-x-3 text-gray-600 flex-shrink-0">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/>
                        </svg>
                        <span class="font-bold text-xl whitespace-nowrap">PERTAMINA</span>
                    </div>
                    
                    <div class="flex items-center space-x-3 text-gray-600 flex-shrink-0">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/>
                        </svg>
                        <span class="font-bold text-xl whitespace-nowrap">PERTAMINA</span>
                    </div>
                    
                    <div class="flex items-center space-x-3 text-gray-600 flex-shrink-0">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/>
                        </svg>
                        <span class="font-bold text-xl whitespace-nowrap">PERTAMINA</span>
                    </div>
                    
                    <div class="flex items-center space-x-3 text-gray-600 flex-shrink-0">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/>
                        </svg>
                        <span class="font-bold text-xl whitespace-nowrap">PERTAMINA</span>
                    </div>
                </div>
                
                <!-- Duplicate Set for Seamless Loop -->
                <div class="flex items-center space-x-16 px-8">
                    <div class="flex items-center space-x-3 text-gray-600 flex-shrink-0">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/>
                        </svg>
                        <span class="font-bold text-xl whitespace-nowrap">PERTAMINA</span>
                    </div>
                    
                    <div class="flex items-center space-x-3 text-gray-600 flex-shrink-0">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/>
                        </svg>
                        <span class="font-bold text-xl whitespace-nowrap">PERTAMINA</span>
                    </div>
                    
                    <div class="flex items-center space-x-3 text-gray-600 flex-shrink-0">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/>
                        </svg>
                        <span class="font-bold text-xl whitespace-nowrap">PERTAMINA</span>
                    </div>
                    
                    <div class="flex items-center space-x-3 text-gray-600 flex-shrink-0">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/>
                        </svg>
                        <span class="font-bold text-xl whitespace-nowrap">PERTAMINA</span>
                    </div>
                    
                    <div class="flex items-center space-x-3 text-gray-600 flex-shrink-0">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/>
                        </svg>
                        <span class="font-bold text-xl whitespace-nowrap">PERTAMINA</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Steps Section -->
    <div class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-16">
                Langkah Mudah Daftar Kerja
            </h2>

            <!-- Steps Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <!-- Step 1 -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all hover:-translate-y-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-900 to-purple-700 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Daftar Akun</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur. Vitae faucibus integer purus malesuada. Praesent ullamcorper in quis cursus tempus. Sagittis et venenatis ut lectus ornare eget sed.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all hover:-translate-y-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-900 to-purple-700 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Lengkapi Profil</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur. Vitae faucibus integer purus malesuada. Praesent ullamcorper in quis cursus tempus. Sagittis et venenatis ut lectus ornare eget sed.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all hover:-translate-y-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-900 to-purple-700 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Cari Lowongan</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur. Vitae faucibus integer purus malesuada. Praesent ullamcorper in quis cursus tempus. Sagittis et venenatis ut lectus ornare eget sed.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all hover:-translate-y-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-900 to-purple-700 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        4
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Kirim Lamaran</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur. Vitae faucibus integer purus malesuada. Praesent ullamcorper in quis cursus tempus. Sagittis et venenatis ut lectus ornare eget sed.
                    </p>
                </div>

                <!-- Step 5 -->
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all hover:-translate-y-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-900 to-purple-700 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        5
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Diterima Kerja</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur. Vitae faucibus integer purus malesuada. Praesent ullamcorper in quis cursus tempus. Sagittis et venenatis ut lectus ornare eget sed.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- UPA-KERJASAMA -->
                <div>
                    <h3 class="text-xl font-bold mb-4">UPA-KERJASAMA</h3>
                </div>

                <!-- Karir -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Karir</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition">Cari lowongan</a></li>
                        <li><a href="#" class="hover:text-white transition">Cari artikel</a></li>
                        <li><a href="#" class="hover:text-white transition">Daftar Perusahaan</a></li>
                    </ul>
                </div>

                <!-- Tentang Portal Karir -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Tentang Portal Karir</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition">Tentang kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Dokumen publik</a></li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 pt-8 text-center text-gray-400 text-sm">
                <p>© 2025 POLINDRA. All rights reserved</p>
            </div>
        </div>
    </footer>
</body>
</html>