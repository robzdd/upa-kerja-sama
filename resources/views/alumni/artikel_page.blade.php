<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel - Portal Kerja POLINDRA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Include Navbar -->
    @include('components.navbar')

    <!-- Hero Section with Search -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900 text-white py-20">
        <div class="container mx-auto px-6">
            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-lg shadow-xl flex items-center">
                    <input 
                        type="text" 
                        placeholder="Cari artikel..." 
                        class="flex-1 px-6 py-4 text-gray-800 rounded-l-lg focus:outline-none"
                    >
                    <button class="px-4 py-4 text-gray-500 hover:text-gray-700 transition">
                        <span class="text-sm font-semibold">Clear</span>
                    </button>
                    <button class="bg-blue-900 px-6 py-4 rounded-r-lg hover:bg-blue-800 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12">
        <!-- Total Articles -->
        <div class="mb-8">
            <p class="text-gray-700 font-semibold">Total Artikel: 300</p>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <!-- Article Card 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <!-- Image Placeholder -->
                <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-600"></div>
                
                <!-- Content -->
                <div class="p-5">
                    <span class="text-xs text-blue-600 font-semibold">Pengembangan Karir</span>
                    <h3 class="text-lg font-bold text-gray-800 mt-2 mb-3 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur Nunc et massa elementum...
                    </h3>
                    <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:from-blue-800 hover:to-purple-600 transition">
                        Selengkapnya
                    </button>
                </div>
            </div>

            <!-- Article Card 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-600"></div>
                <div class="p-5">
                    <span class="text-xs text-blue-600 font-semibold">Pengembangan Karir</span>
                    <h3 class="text-lg font-bold text-gray-800 mt-2 mb-3 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur Nunc et massa elementum...
                    </h3>
                    <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:from-blue-800 hover:to-purple-600 transition">
                        Selengkapnya
                    </button>
                </div>
            </div>

            <!-- Article Card 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-600"></div>
                <div class="p-5">
                    <span class="text-xs text-blue-600 font-semibold">Pengembangan Karir</span>
                    <h3 class="text-lg font-bold text-gray-800 mt-2 mb-3 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur Nunc et massa elementum...
                    </h3>
                    <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:from-blue-800 hover:to-purple-600 transition">
                        Selengkapnya
                    </button>
                </div>
            </div>

            <!-- Article Card 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-600"></div>
                <div class="p-5">
                    <span class="text-xs text-blue-600 font-semibold">Pengembangan Karir</span>
                    <h3 class="text-lg font-bold text-gray-800 mt-2 mb-3 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur Nunc et massa elementum...
                    </h3>
                    <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:from-blue-800 hover:to-purple-600 transition">
                        Selengkapnya
                    </button>
                </div>
            </div>

            <!-- Article Card 5 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-600"></div>
                <div class="p-5">
                    <span class="text-xs text-blue-600 font-semibold">Pengembangan Karir</span>
                    <h3 class="text-lg font-bold text-gray-800 mt-2 mb-3 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur Nunc et massa elementum...
                    </h3>
                    <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:from-blue-800 hover:to-purple-600 transition">
                        Selengkapnya
                    </button>
                </div>
            </div>

            <!-- Article Card 6 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-600"></div>
                <div class="p-5">
                    <span class="text-xs text-blue-600 font-semibold">Pengembangan Karir</span>
                    <h3 class="text-lg font-bold text-gray-800 mt-2 mb-3 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur Nunc et massa elementum...
                    </h3>
                    <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:from-blue-800 hover:to-purple-600 transition">
                        Selengkapnya
                    </button>
                </div>
            </div>

            <!-- Article Card 7 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-600"></div>
                <div class="p-5">
                    <span class="text-xs text-blue-600 font-semibold">Pengembangan Karir</span>
                    <h3 class="text-lg font-bold text-gray-800 mt-2 mb-3 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur Nunc et massa elementum...
                    </h3>
                    <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:from-blue-800 hover:to-purple-600 transition">
                        Selengkapnya
                    </button>
                </div>
            </div>

            <!-- Article Card 8 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-600"></div>
                <div class="p-5">
                    <span class="text-xs text-blue-600 font-semibold">Pengembangan Karir</span>
                    <h3 class="text-lg font-bold text-gray-800 mt-2 mb-3 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur Nunc et massa elementum...
                    </h3>
                    <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:from-blue-800 hover:to-purple-600 transition">
                        Selengkapnya
                    </button>
                </div>
            </div>

            <!-- Article Card 9 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-600"></div>
                <div class="p-5">
                    <span class="text-xs text-blue-600 font-semibold">Pengembangan Karir</span>
                    <h3 class="text-lg font-bold text-gray-800 mt-2 mb-3 line-clamp-2">
                        Lorem ipsum dolor sit amet consectetur Nunc et massa elementum...
                    </h3>
                    <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:from-blue-800 hover:to-purple-600 transition">
                        Selengkapnya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
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
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>© 2025 POLINDRA. All rights reserved</p>
            </div>
        </div>
    </footer>
</body>
</html>