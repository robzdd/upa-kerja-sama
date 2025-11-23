@extends('alumni.layouts.app')

@section('title', 'Tentang Kami - Portal Kerja POLINDRA')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-blue-900 text-white py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('images/bg/polindra.png') }}" alt="Background" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900 via-blue-800 to-transparent opacity-90"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    Membangun Jembatan <br> <span class="text-blue-300">Karir & Industri</span>
                </h1>
                <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                    Unit Penunjang Akademik (UPA) Kerjasama Politeknik Negeri Indramayu hadir sebagai mitra strategis dalam menghubungkan talenta terbaik dengan dunia industri global.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#visi-misi" class="bg-white text-blue-900 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition shadow-lg">
                        Visi & Misi
                    </a>
                    <a href="#kontak" class="bg-blue-700 text-white px-8 py-3 rounded-full font-semibold hover:bg-blue-600 transition shadow-lg border border-blue-500">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Introduction Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-blue-100 rounded-full z-0"></div>
                    <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-purple-100 rounded-full z-0"></div>
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                         alt="Collaboration" 
                         class="relative z-10 rounded-2xl shadow-2xl w-full object-cover h-96">
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Siapa Kami?</h2>
                    <p class="text-gray-600 leading-relaxed mb-6 text-lg">
                        UPA Kerjasama adalah unit kerja di lingkungan Politeknik Negeri Indramayu yang berfokus pada pengembangan jejaring kerjasama, baik dengan institusi pendidikan, pemerintah, maupun dunia usaha dan industri (DUDI).
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        Kami berkomitmen untuk memfasilitasi lulusan POLINDRA dalam meraih karir impian mereka serta membantu industri menemukan talenta vokasi yang kompeten dan siap kerja.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="border-l-4 border-blue-500 pl-4">
                            <h4 class="text-2xl font-bold text-blue-900 mb-1">500+</h4>
                            <p class="text-sm text-gray-500">Mitra Industri</p>
                        </div>
                        <div class="border-l-4 border-purple-500 pl-4">
                            <h4 class="text-2xl font-bold text-purple-900 mb-1">1000+</h4>
                            <p class="text-sm text-gray-500">Alumni Terserap</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi Section -->
    <section id="visi-misi" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-blue-600 font-semibold tracking-wide uppercase text-sm">Arah & Tujuan</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">Visi & Misi</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Visi Card -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-blue-500">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Visi</h3>
                    <p class="text-gray-600 leading-relaxed italic">
                        "Menjadi pusat pengembangan karir dan kerjasama industri terkemuka yang menjembatani lulusan vokasi berkualitas dengan kebutuhan pasar kerja global."
                    </p>
                </div>

                <!-- Misi Card -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-purple-500">
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Misi</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Memfasilitasi penyerapan lulusan ke dunia kerja.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Membangun kemitraan strategis dengan industri nasional & internasional.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Menyediakan layanan bimbingan karir dan pengembangan soft skills.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-purple-600 font-semibold tracking-wide uppercase text-sm">Layanan Kami</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">Apa yang Kami Tawarkan?</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="p-6 rounded-2xl bg-gray-50 hover:bg-white hover:shadow-xl transition duration-300 group">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Job Portal</h3>
                    <p class="text-gray-600 text-sm">Platform eksklusif lowongan kerja dari mitra industri terpercaya khusus untuk alumni POLINDRA.</p>
                </div>

                <!-- Service 2 -->
                <div class="p-6 rounded-2xl bg-gray-50 hover:bg-white hover:shadow-xl transition duration-300 group">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Campus Hiring</h3>
                    <p class="text-gray-600 text-sm">Fasilitas rekrutmen langsung di kampus, memudahkan alumni bertemu HRD perusahaan.</p>
                </div>

                <!-- Service 3 -->
                <div class="p-6 rounded-2xl bg-gray-50 hover:bg-white hover:shadow-xl transition duration-300 group">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-green-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tracer Study</h3>
                    <p class="text-gray-600 text-sm">Pemantauan karir alumni untuk evaluasi kurikulum dan peningkatan kualitas pendidikan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Public Documents Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-10">
                <div>
                    <span class="text-blue-600 font-semibold tracking-wide uppercase text-sm">Unduhan</span>
                    <h2 class="text-3xl font-bold text-gray-800 mt-2">Dokumen Publik</h2>
                </div>
                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-2 mt-4 md:mt-0">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Doc 1 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 bg-red-50 text-red-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-xs font-medium bg-gray-100 text-gray-600 px-2 py-1 rounded">PDF</span>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Panduan Kerjasama Industri</h3>
                    <p class="text-sm text-gray-500 mb-4">Dokumen panduan lengkap untuk mitra industri yang ingin bekerjasama.</p>
                    <a href="#" class="w-full block text-center bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium py-2 rounded-lg transition text-sm">
                        Download
                    </a>
                </div>

                <!-- Doc 2 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <span class="text-xs font-medium bg-gray-100 text-gray-600 px-2 py-1 rounded">DOCX</span>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Formulir Pendaftaran Mitra</h3>
                    <p class="text-sm text-gray-500 mb-4">Formulir isian data perusahaan untuk registrasi mitra baru.</p>
                    <a href="#" class="w-full block text-center bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium py-2 rounded-lg transition text-sm">
                        Download
                    </a>
                </div>

                <!-- Doc 3 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 bg-green-50 text-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V9a2 2 0 00-2-2z"></path></svg>
                        </div>
                        <span class="text-xs font-medium bg-gray-100 text-gray-600 px-2 py-1 rounded">XLSX</span>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Laporan Serapan Alumni 2023</h3>
                    <p class="text-sm text-gray-500 mb-4">Data statistik penyerapan alumni di berbagai sektor industri.</p>
                    <a href="#" class="w-full block text-center bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium py-2 rounded-lg transition text-sm">
                        Download
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="kontak" class="py-20 bg-gradient-to-br from-blue-900 to-purple-900 text-white text-center">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Berkolaborasi?</h2>
            <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan jaringan mitra kami atau temukan karir impian Anda bersama UPA Kerjasama POLINDRA.
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="{{ route('alumni.register') }}" class="bg-white text-blue-900 px-8 py-3 rounded-full font-bold hover:bg-blue-50 transition shadow-lg">
                    Daftar Sebagai Alumni
                </a>
                <a href="#" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white/10 transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection
