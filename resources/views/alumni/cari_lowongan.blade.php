<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Lowongan - Portal Kerja POLINDRA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .job-card {
            transition: all 0.3s ease;
            position: relative;
        }
        .job-card.active {
            box-shadow: 0 0 0 3px transparent;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(to bottom, #1e3a8a, #7c3aed) border-box;
            border: 3px solid transparent;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header Section with Gradient Background -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900 text-white pb-32 relative">
        <!-- Navbar -->
        @include('components.navbar')
        <!-- Hero Content -->
        <div class="container mx-auto px-6 py-8 relative z-10">
            <div class="text-left max-w-2xl">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">
                    Temukan pekerjaan impianmu
                </h1>
            </div>
        </div>

        <!-- Decorative "We're Hiring!" text -->
        <div class="absolute right-10 top-10 opacity-10 font-bold text-8xl md:text-9xl pointer-events-none">
            We're<br>HIRING!
        </div>
    </div>

    <!-- Search Section (Overlapping) -->
    <div class="container mx-auto px-6 -mt-20 relative z-30 mb-8">
        <div class="bg-white rounded-xl shadow-2xl p-6">
            <!-- Search Filters -->
            <div class="grid grid-cols-2 md:grid-cols-6 gap-3 mb-4">
                <input 
                    type="text" 
                    placeholder="Posisi" 
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 text-sm"
                >
                <input 
                    type="text" 
                    placeholder="Perusahaan" 
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 text-sm"
                >
                <input 
                    type="text" 
                    placeholder="Lokasi" 
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 text-sm"
                >
                <select class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 text-sm">
                    <option>Jurusan</option>
                    <option>Teknik Informatika</option>
                    <option>Teknik Mesin</option>
                </select>
                <select class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 text-sm">
                    <option>Jenjang Pendidikan</option>
                    <option>D3</option>
                    <option>D4</option>
                </select>
                <div class="flex gap-2 col-span-2 md:col-span-1">
                    <button class="px-3 text-gray-600 hover:text-gray-800 transition font-semibold text-sm">
                        Clear
                    </button>
                    <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-4 py-3 rounded-lg hover:from-blue-800 hover:to-purple-600 transition flex items-center justify-center flex-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>

        </div>
        <!-- AI Recommendation Button -->
        <button class="w-full bg-gradient-to-r from-blue-700 to-purple-700 text-white py-4 rounded-lg font-semibold hover:from-blue-600 hover:to-purple-600 transition shadow-lg flex items-center justify-center space-x-3 mt-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
            </svg>
            <span>Coba rekomendasi pekerjaan menggunakan AI</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
            </svg>
        </button>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-6 pb-16">
        <!-- Stats -->
        <div class="mb-6 flex justify-between items-center">
            <p class="text-gray-700 text-sm">Posisi tersedia: 500 | Total Juli: 3000</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <!-- Left Side - Job Listings (40%) -->
            <div class="lg:col-span-2 space-y-4">
                <!-- Job Card 1 - Active -->
                <div class="job-card active bg-white rounded-lg shadow-md p-5 hover:shadow-lg transition cursor-pointer" onclick="selectJob(this)">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-800 mb-1">UI/UX DESIGNER</h3>
                            <p class="text-gray-600 text-sm mb-3">PT. Mencari Cinta Sejati HRD</p>
                        </div>
                        <button class="text-blue-600 text-sm font-semibold">Simpan ♥</button>
                    </div>
                    
                    <div class="flex flex-wrap gap-3 text-xs text-gray-600 mb-3">
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
                <div class="job-card bg-white rounded-lg shadow-md p-5 hover:shadow-lg transition cursor-pointer border-l-4 border-transparent" onclick="selectJob(this)">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-800 mb-1">UI/UX DESIGNER</h3>
                            <p class="text-gray-600 text-sm mb-3">PT. Mencari Cinta Sejati HRD</p>
                        </div>
                        <button class="text-blue-600 text-sm font-semibold">Simpan ♥</button>
                    </div>
                    
                    <div class="flex flex-wrap gap-3 text-xs text-gray-600 mb-3">
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
                <div class="job-card bg-white rounded-lg shadow-md p-5 hover:shadow-lg transition cursor-pointer border-l-4 border-transparent" onclick="selectJob(this)">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-800 mb-1">UI/UX DESIGNER</h3>
                            <p class="text-gray-600 text-sm mb-3">PT. Mencari Cinta Sejati HRD</p>
                        </div>
                        <button class="text-blue-600 text-sm font-semibold">Simpan ♥</button>
                    </div>
                    
                    <div class="flex flex-wrap gap-3 text-xs text-gray-600 mb-3">
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
                <div class="job-card bg-white rounded-lg shadow-md p-5 hover:shadow-lg transition cursor-pointer border-l-4 border-transparent" onclick="selectJob(this)">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-800 mb-1">UI/UX DESIGNER</h3>
                            <p class="text-gray-600 text-sm mb-3">PT. Mencari Cinta Sejati HRD</p>
                        </div>
                        <button class="text-blue-600 text-sm font-semibold">Simpan ♥</button>
                    </div>
                    
                    <div class="flex flex-wrap gap-3 text-xs text-gray-600 mb-3">
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
                <div class="job-card bg-white rounded-lg shadow-md p-5 hover:shadow-lg transition cursor-pointer border-l-4 border-transparent" onclick="selectJob(this)">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-800 mb-1">UI/UX DESIGNER</h3>
                            <p class="text-gray-600 text-sm mb-3">PT. Mencari Cinta Sejati HRD</p>
                        </div>
                        <button class="text-blue-600 text-sm font-semibold">Simpan ♥</button>
                    </div>
                    
                    <div class="flex flex-wrap gap-3 text-xs text-gray-600 mb-3">
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

                <!-- Pagination -->
                <div class="flex justify-center items-center space-x-2 mt-8">
                    <button class="w-8 h-8 rounded-full bg-blue-900 text-white flex items-center justify-center text-sm">1</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center text-sm">2</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center text-sm">3</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center text-sm">...</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center text-sm">100</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center text-sm">→</button>
                </div>
            </div>

            <!-- Right Side - Job Detail (60%) -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg shadow-lg p-8 sticky top-6">
                    <!-- Company Logo Placeholder -->
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-2xl font-bold text-gray-400">PT</span>
                        </div>
                        <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-5 py-2 rounded-lg hover:from-blue-800 hover:to-purple-600 transition text-sm font-semibold">
                            Part-Time
                        </button>
                    </div>

                    <!-- Posisi & Peringatan -->
                    <div class="mb-4">
                        <span class="text-xs text-red-500">1 Posisi - 500 Pelamar</span>
                    </div>

                    <!-- Job Title -->
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">UI/UX DESIGNER</h2>
                    <p class="text-gray-600 mb-4">PT. Mencari Cinta Sejati HRD</p>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">Desain Lowongan</span>
                    </div>

                    <!-- Apply Button -->
                    <button class="w-full bg-gradient-to-r from-blue-900 to-purple-700 text-white py-3 rounded-lg hover:from-blue-800 hover:to-purple-600 transition font-semibold mb-6">
                        Daftar Sekarang
                    </button>

                    <!-- Job Details -->
                    <div class="space-y-5 mb-6">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-gray-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Pendidikan</h4>
                                <p class="text-sm text-gray-600">Jenjang Pendidikan: S1, TI</p>
                                <p class="text-sm text-gray-600">Jurusan: Teknik Informatika, Sistem Informasi, Rekayasa Perangkat Lunak</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-gray-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Persyaratan Dokumen</h4>
                                <ul class="text-sm text-gray-600">
                                    <li>• Portfolio</li>
                                    <li>• Portfolio</li>
                                    <li>• Sertifikat</li>
                                    <li>• Sertifikat</li>
                                </ul>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-gray-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Tanggal Penting</h4>
                                <p class="text-sm text-gray-600">• Penerimaan lamaran: 28 Januari 2025</p>
                                <p class="text-sm text-gray-600">• Pengumuman waktu: 28 Desember 2025</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="border-t pt-6">
                        <h3 class="font-bold text-gray-800 mb-3">Rincian Lowongan</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Lorem ipsum dolor sit amet consectetur. Leo massa purus maecenas vestibulum nibh placeat minima et iste fuga. Officia totam et ratione mollitia, consequatur, enim ex vero explicabo blanditiis voluptate. Maecenas cursus tempor suspendisse. Massa id cursus natus vel ligula sed amet sagittis.
                        </p>
                    </div>
                </div>
            </div>
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

    <script>
        function selectJob(element) {
            // Remove active class from all job cards
            document.querySelectorAll('.job-card').forEach(card => {
                card.classList.remove('active');
            });
            
            // Add active class to clicked card
            element.classList.add('active');
        }
    </script>
</body>
</html>