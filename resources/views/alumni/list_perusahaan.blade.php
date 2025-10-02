<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Perusahaan - Portal Kerja POLINDRA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .company-card {
            transition: all 0.3s ease;
        }
        .company-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .company-card:hover .company-logo {
            transform: scale(1.1);
        }
        .company-logo {
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Include Navbar -->
    @include('components.navbar')

    <!-- Hero Section with Banner -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900 text-white py-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">List Perusahaan Mitra</h1>
                <p class="text-xl">Temukan perusahaan impianmu</p>
            </div>

            <!-- Search Bar -->
            <div class="container mx-auto px-6">
                <div class="bg-white rounded-lg shadow-xl p-4 -mb-28 relative z-10">
                    <div class="grid grid-cols-1 md:grid-cols-11 gap-4 items-center">
                        <input 
                            type="text" 
                            placeholder="Nama perusahaan..." 
                            class="w-full col-span-5 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800"
                        >
                        <select class="w-full col-span-4 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                            <option>Pilih sektor</option>
                            <option>Teknologi</option>
                            <option>Keuangan</option>
                            <option>Manufaktur</option>
                            <option>Kesehatan</option>
                        </select>
                        <button class="w-full col-span-2 bg-gradient-to-r from-blue-900 to-purple-700 text-white px-6 py-3 rounded-lg hover:from-blue-800 hover:to-purple-600 transition flex items-center justify-center space-x-2">
                            <span>Cari</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12 pt-32">
        <!-- Total Companies -->
        <div class="mb-8">
            <p class="text-gray-700 font-semibold">Total Perusahaan: 360</p>
        </div>

        <!-- Companies Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <!-- Company Card 1 -->
            <div class="company-card bg-white rounded-xl shadow-md p-6 cursor-pointer border border-gray-200">
                <div class="flex flex-col items-center text-center">
                    <!-- Company Logo -->
                    <div class="company-logo w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                        <span class="text-3xl font-bold text-gray-400">PT</span>
                    </div>
                    
                    <!-- Company Name -->
                    <h3 class="text-lg font-bold text-gray-800 mb-2">PT Mencari Cinta Sejati Tbk</h3>
                    
                    <!-- Company Type -->
                    <p class="text-sm text-gray-600 mb-4">Jasa Teknologi</p>
                    
                    <!-- Company Website -->
                    <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        <span class="truncate">perusahaanpertama.polindra.com</span>
                    </div>
                    
                    <!-- Job Count -->
                    <div class="flex items-center space-x-2 text-sm text-blue-600 font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>Jumlah lowongan: aktif 1/100</span>
                    </div>
                </div>
            </div>

            <!-- Company Card 2 -->
            <div class="company-card bg-white rounded-xl shadow-md p-6 cursor-pointer border border-gray-200">
                <div class="flex flex-col items-center text-center">
                    <div class="company-logo w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                        <span class="text-3xl font-bold text-gray-400">PT</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">PT Mencari Cinta Sejati Tbk</h3>
                    <p class="text-sm text-gray-600 mb-4">Jasa Teknologi</p>
                    <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        <span class="truncate">perusahaankedua.polindra.com</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-blue-600 font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>Jumlah lowongan: aktif 5/100</span>
                    </div>
                </div>
            </div>

            <!-- Company Card 3 -->
            <div class="company-card bg-white rounded-xl shadow-md p-6 cursor-pointer border border-gray-200">
                <div class="flex flex-col items-center text-center">
                    <div class="company-logo w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                        <span class="text-3xl font-bold text-gray-400">PT</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">PT Mencari Cinta Sejati Tbk</h3>
                    <p class="text-sm text-gray-600 mb-4">Jasa Teknologi</p>
                    <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        <span class="truncate">perusahaanketiga.polindra.com</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-blue-600 font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>Jumlah lowongan: aktif 3/100</span>
                    </div>
                </div>
            </div>

            <!-- Company Card 4 -->
            <div class="company-card bg-white rounded-xl shadow-md p-6 cursor-pointer border border-gray-200">
                <div class="flex flex-col items-center text-center">
                    <div class="company-logo w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                        <span class="text-3xl font-bold text-gray-400">PT</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">PT Mencari Cinta Sejati Tbk</h3>
                    <p class="text-sm text-gray-600 mb-4">Jasa Teknologi</p>
                    <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        <span class="truncate">perusahaankeempat.polindra.com</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-blue-600 font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>Jumlah lowongan: aktif 8/100</span>
                    </div>
                </div>
            </div>

            <!-- Company Card 5 -->
            <div class="company-card bg-white rounded-xl shadow-md p-6 cursor-pointer border border-gray-200">
                <div class="flex flex-col items-center text-center">
                    <div class="company-logo w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                        <span class="text-3xl font-bold text-gray-400">PT</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">PT Mencari Cinta Sejati Tbk</h3>
                    <p class="text-sm text-gray-600 mb-4">Jasa Teknologi</p>
                    <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        <span class="truncate">perusahaankelima.polindra.com</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-blue-600 font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>Jumlah lowongan: aktif 12/100</span>
                    </div>
                </div>
            </div>

            <!-- Company Card 6 -->
            <div class="company-card bg-white rounded-xl shadow-md p-6 cursor-pointer border border-gray-200">
                <div class="flex flex-col items-center text-center">
                    <div class="company-logo w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                        <span class="text-3xl font-bold text-gray-400">PT</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">PT Mencari Cinta Sejati Tbk</h3>
                    <p class="text-sm text-gray-600 mb-4">Jasa Teknologi</p>
                    <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        <span class="truncate">perusahaankeenam.polindra.com</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-blue-600 font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>Jumlah lowongan: aktif 7/100</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-2">
            <button class="w-10 h-10 rounded-full bg-blue-900 text-white flex items-center justify-center font-semibold">1</button>
            <button class="w-10 h-10 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center font-semibold">2</button>
            <button class="w-10 h-10 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center font-semibold">3</button>
            <button class="w-10 h-10 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center font-semibold">4</button>
            <button class="w-10 h-10 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center font-semibold">...</button>
            <button class="w-10 h-10 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center font-semibold">100</button>
            <button class="w-10 h-10 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
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