<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Portal Kerja POLINDRA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header/Navbar -->
    <nav class="bg-gradient-to-r from-blue-900 via-purple-800 to-purple-900 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <img src="{{ Storage::url('images/polindra_logo.png') }}" alt="Logo" class="w-10 h-10">
                    <span class="text-xl font-bold">Portal Kerja POLINDRA</span>
                </div>

                <!-- Navigation Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="hover:text-gray-200 transition">Beranda</a>
                    <a href="#" class="hover:text-gray-200 transition">Artikel</a>
                    <a href="#" class="hover:text-gray-200 transition">Cari Lowongan</a>
                    <a href="#" class="hover:text-gray-200 transition">List Perusahaan</a>
                    <a href="#" class="hover:text-gray-200 transition">Tentang Kami</a>
                </div>

                <!-- User Profile -->
                <div class="flex items-center space-x-4">
                    <button class="relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-gray-700 font-semibold">U</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Banner -->
    <div class="bg-gradient-to-r from-blue-900 via-purple-800 to-purple-900 text-white py-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">We're Hiring!</h1>
                <p class="text-xl">Temukan pekerjaan impianmu</p>
            </div>

            <!-- Search Bar -->
            <div class="max-w-5xl mx-auto">
                <div class="bg-white rounded-lg shadow-xl p-4">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <input type="text" placeholder="Posisi" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                        <input type="text" placeholder="Perusahaan" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                        <input type="text" placeholder="Lokasi" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                            <option>Jurusan</option>
                            <option>Teknik Informatika</option>
                            <option>Teknik Mesin</option>
                            <option>Akuntansi</option>
                        </select>
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                            <option>Jenjang Pendidikan</option>
                            <option>D3</option>
                            <option>D4</option>
                            <option>S1</option>
                        </select>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-8 py-2 rounded-lg hover:from-blue-800 hover:to-purple-600 transition flex items-center space-x-2">
                            <span>Cari</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- AI Recommendation Button -->
            <div class="max-w-5xl mx-auto mt-6">
                <button class="w-full bg-gradient-to-r from-blue-700 to-purple-700 text-white py-4 rounded-lg font-semibold hover:from-blue-600 hover:to-purple-600 transition shadow-lg flex items-center justify-center space-x-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                    <span>Coba rekomendasi pekerjaan menggunakan AI</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Side - Job Listings -->
            <div class="lg:w-2/3">
                <!-- Date Filter -->
                <div class="mb-4 text-sm text-gray-600">
                    Posisi tanggal: 500 | Total Juli 2025
                </div>

                <!-- Job Cards -->
                <div class="space-y-4">
                    <!-- Job Card 1 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition cursor-pointer border-l-4 border-blue-600">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-1">UI/UX DESIGNER</h3>
                                <p class="text-gray-600">PT. Mencari Cinta Sejati</p>
                            </div>
                            <span class="text-sm text-blue-600 font-semibold">Simpan ♥</span>
                        </div>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Kabupaten 3, Indonesia Jawa</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Contract (Kontrak Kerja)</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">Fresh Graduate</span>
                        </div>
                    </div>

                    <!-- Job Card 2 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition cursor-pointer border-l-4 border-purple-600">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-1">UI/UX DESIGNER</h3>
                                <p class="text-gray-600">PT. Mencari Cinta Sejati HRD</p>
                            </div>
                            <span class="text-sm text-blue-600 font-semibold">Simpan ♥</span>
                        </div>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Kabupaten 3, Indonesia Jawa</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Contract (Kontrak Kerja)</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs">Fresh Graduate</span>
                        </div>
                    </div>

                    <!-- Job Card 3 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition cursor-pointer border-l-4 border-blue-600">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-1">UI/UX DESIGNER</h3>
                                <p class="text-gray-600">PT. Mencari Cinta Sejati HRD</p>
                            </div>
                            <span class="text-sm text-blue-600 font-semibold">Simpan ♥</span>
                        </div>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Kabupaten 3, Indonesia Jawa</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Contract (Kontrak Kerja)</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">Fresh Graduate</span>
                        </div>
                    </div>

                    <!-- Job Card 4 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition cursor-pointer border-l-4 border-purple-600">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-1">UI/UX DESIGNER</h3>
                                <p class="text-gray-600">PT. Mencari Cinta Sejati HRD</p>
                            </div>
                            <span class="text-sm text-blue-600 font-semibold">Simpan ♥</span>
                        </div>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Kabupaten 3, Indonesia Jawa</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Contract (Kontrak Kerja)</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs">Fresh Graduate</span>
                        </div>
                    </div>

                    <!-- Job Card 5 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition cursor-pointer border-l-4 border-blue-600">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-1">UI/UX DESIGNER</h3>
                                <p class="text-gray-600">PT. Mencari Cinta Sejati HRD</p>
                            </div>
                            <span class="text-sm text-blue-600 font-semibold">Simpan ♥</span>
                        </div>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Kabupaten 3, Indonesia Jawa</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Contract (Kontrak Kerja)</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">Fresh Graduate</span>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center items-center space-x-2 mt-8">
                    <button class="w-8 h-8 rounded-full bg-blue-900 text-white flex items-center justify-center">1</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center">2</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center">3</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center">...</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center">10</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center">→</button>
                </div>
            </div>

            <!-- Right Side - Job Detail -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-6">
                    <!-- Company Logo -->
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-2xl font-bold text-gray-400">PT</span>
                        </div>
                        <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-6 py-2 rounded-lg hover:from-blue-800 hover:to-purple-600 transition text-sm font-semibold">
                            Pagi: Time
                        </button>
                    </div>

                    <!-- Job Title -->
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">UI/UX DESIGNER</h2>
                    <p class="text-gray-600 mb-4">PT. Mencari Cinta Sejati</p>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs">Fresh Graduate</span>
                    </div>

                    <!-- Apply Button -->
                    <button class="w-full bg-gradient-to-r from-blue-900 to-purple-700 text-white py-3 rounded-lg hover:from-blue-800 hover:to-purple-600 transition font-semibold mb-6">
                        Daftar Sekarang
                    </button>

                    <!-- Job Details -->
                    <div class="space-y-4 mb-6">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-gray-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-800">Pendidikan</h4>
                                <p class="text-sm text-gray-600">Jurusan Pendidikan: S1 TI</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-gray-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-800">Lokasi</h4>
                                <p class="text-sm text-gray-600">Lokasi: Tapin, Kalimantan Selatan, Indonesia Kalimantan Selatan</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-gray-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-800">Persyaratan Dokumen</h4>
                                <ul class="text-sm text-gray-600 list-disc list-inside">
                                    <li>Identitas</li>
                                    <li>Sertifikat</li>
                                </ul>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-gray-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-800">Tanggal Penutup</h4>
                                <p class="text-sm text-gray-600">Penerimaan lamaran: 31 Januari 2025</p>
                                <p class="text-sm text-gray-600">Pengumuman: 28 Desember 2024</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="border-t pt-6">
                        <h3 class="font-bold text-gray-800 mb-3">Rincian Lowongan</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Massa id cursus natus vel ligula sed amet sagittis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-16">
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
                        <li><a href="#" class="hover:text-white transition">Cari Lamaran</a></li>
                        <li><a href="#" class="hover:text-white transition">Cari tentang Kami</a></li>