@extends('alumni.layouts.app')

@section('title', 'Beranda - Portal Kerja POLINDRA')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900 text-white overflow-hidden" id="hero-section">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 -right-4 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
            <canvas id="grid-canvas" class="absolute inset-0 w-full h-full opacity-40"></canvas>
        </div>

        <div class="container mx-auto px-6 pt-16 pb-24 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 text-center lg:text-left">


                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 animate-fade-in-up">
                        Membangun Masa Depan <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">Karir Profesional</span> Anda
                    </h1>

                    <p class="text-lg text-blue-100 mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed animate-fade-in-up delay-100">
                        Jembatan penghubung antara talenta terbaik Politeknik Indramayu dengan mitra industri terkemuka. Temukan peluang karir yang sesuai dengan passion dan keahlian Anda.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start animate-fade-in-up delay-200">
                        <a href="{{ route('alumni.cari_lowongan') }}" class="w-full sm:w-auto px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition-all shadow-lg shadow-blue-600/30 flex items-center justify-center gap-2 group">
                            Cari Lowongan
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                        <a href="#stats-section" class="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 text-white rounded-xl font-semibold backdrop-blur-sm border border-white/10 transition-all flex items-center justify-center">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <div class="lg:w-1/2 relative animate-fade-in-up delay-300">
                    <div class="relative z-10 bg-white/5 backdrop-blur-md rounded-2xl p-6 border border-white/10 shadow-2xl transform rotate-2 hover:rotate-0 transition-all duration-500">
                        <div class="flex items-center gap-4 mb-6 border-b border-white/10 pb-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-xl font-bold">P</div>
                            <div>
                                <h3 class="font-semibold text-lg">Lowongan Terbaru</h3>
                                <p class="text-sm text-blue-200">Update Real-time</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @foreach($latest_jobs->take(3) as $job)
                            <div class="flex items-center gap-4 p-3 rounded-xl bg-white/5 hover:bg-white/10 transition-colors cursor-pointer group">
                                <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center overflow-hidden shrink-0">
                                    @if($job->mitra && $job->mitra->logo)
                                        <img src="{{ asset('storage/' . $job->mitra->logo) }}" alt="{{ $job->mitra->nama_perusahaan }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-gray-500 font-bold text-xs">{{ substr($job->mitra->nama_perusahaan ?? 'C', 0, 2) }}</span>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium truncate group-hover:text-blue-300 transition-colors">{{ $job->posisi }}</h4>
                                    <p class="text-xs text-blue-200 truncate">{{ $job->mitra->nama_perusahaan ?? 'Perusahaan' }} • {{ $job->lokasi }}</p>
                                </div>
                                <div class="text-xs px-2 py-1 rounded-md bg-blue-500/20 text-blue-300 border border-blue-500/30">
                                    {{ $job->jenis_pekerjaan }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Decorative elements behind the card -->
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-yellow-400/20 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-blue-400/20 rounded-full blur-2xl"></div>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="relative -mt-1">
        <!-- paste SVG multi-layer di sini -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
    <path fill="#f9fafb" fill-opacity="0.7"
        d="M0,224L48,218.7C96,213,192,203,288,208C384,213,480,235,576,250.7C672,267,768,277,864,266.7C960,256,1056,224,1152,213.3C1248,203,1344,213,1392,218.7L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
    </path>

    <path fill="#f9fafb" fill-opacity="0.5"
        d="M0,192L60,181.3C120,171,240,149,360,138.7C480,128,600,128,720,154.7C840,181,960,235,1080,256C1200,277,1320,267,1380,261.3L1440,256L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
    </path>

    <path fill="#ffffff" fill-opacity="0.3"
        d="M0,160L80,149.3C160,139,320,117,480,122.7C640,128,800,160,960,176C1120,192,1280,192,1360,192L1440,192L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
    </path>
</svg>
        </div>


    </div>

    <!-- Stats Section -->
    <div id="stats-section" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 text-center group">
                    <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-4xl font-bold text-gray-800 mb-2 counter" data-target="{{ $counts['jobs'] }}">0</h3>
                    <p class="text-gray-500 font-medium">Lowongan Aktif</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 text-center group">
                    <div class="w-16 h-16 mx-auto bg-purple-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-4xl font-bold text-gray-800 mb-2 counter" data-target="{{ $counts['partners'] }}">0</h3>
                    <p class="text-gray-500 font-medium">Mitra Perusahaan</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 text-center group">
                    <div class="w-16 h-16 mx-auto bg-green-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-4xl font-bold text-gray-800 mb-2 counter" data-target="{{ $counts['alumni'] }}">0</h3>
                    <p class="text-gray-500 font-medium">Alumni Terdaftar</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Jobs Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <span class="text-blue-600 font-semibold tracking-wider uppercase text-sm">Peluang Karir</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Lowongan Terbaru</h2>
                </div>
                <a href="{{ route('alumni.cari_lowongan') }}" class="hidden md:flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                    Lihat Semua Lowongan
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($latest_jobs as $job)
                <div class="group bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-xl hover:border-blue-100 transition-all duration-300 flex flex-col h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center p-2 group-hover:bg-white group-hover:shadow-md transition-all">
                            @if($job->mitra && $job->mitra->logo)
                                <img src="{{ asset('storage/' . $job->mitra->logo) }}" alt="{{ $job->mitra->nama_perusahaan }}" class="w-full h-full object-contain">
                            @else
                                <span class="text-xl font-bold text-gray-400">{{ substr($job->mitra->nama_perusahaan ?? 'C', 0, 1) }}</span>
                            @endif
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $job->jenis_pekerjaan == 'Full Time' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ $job->jenis_pekerjaan }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-1 group-hover:text-blue-600 transition-colors">{{ $job->posisi }}</h3>
                    <p class="text-sm text-gray-500 mb-4 line-clamp-1">{{ $job->mitra->nama_perusahaan ?? 'Perusahaan' }}</p>

                    <div class="space-y-2 mb-6 flex-1">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $job->lokasi }}
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                        </div>
                    </div>

                    <a href="{{ route('alumni.cari_lowongan') }}" class="block w-full py-3 px-4 bg-gray-50 hover:bg-blue-600 text-gray-700 hover:text-white text-center rounded-xl font-medium transition-all duration-300">
                        Lihat Detail
                    </a>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada lowongan aktif</h3>
                    <p class="text-gray-500">Silakan cek kembali nanti.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('alumni.cari_lowongan') }}" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                    Lihat Semua Lowongan
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="py-16 bg-gray-50 overflow-hidden">
        <div class="container mx-auto px-6 mb-10 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Mitra Industri Kami</h2>
            <p class="text-gray-600 mt-2">Bekerja sama dengan perusahaan terkemuka</p>
        </div>

        <div class="relative w-full">
            <div class="flex animate-scroll whitespace-nowrap">
                <!-- First Loop -->
                <div class="flex items-center space-x-12 px-6">
                    @foreach($partners as $partner)
                    <div class="flex flex-col items-center justify-center w-40 h-24 grayscale hover:grayscale-0 transition-all duration-300 opacity-60 hover:opacity-100">
                        @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->nama_perusahaan }}" class="max-w-full max-h-16 object-contain">
                        @else
                            <div class="flex items-center gap-2">
                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/></svg>
                                <span class="font-bold text-gray-600">{{ $partner->nama_perusahaan }}</span>
                            </div>
                        @endif
                    </div>
                    @endforeach
                    <!-- Fallback if no partners -->
                    @if($partners->count() == 0)
                        @for($i=0; $i<10; $i++)
                        <div class="flex items-center justify-center w-40 h-24 opacity-40">
                            <span class="font-bold text-xl text-gray-400">MITRA {{ $i+1 }}</span>
                        </div>  
                        @endfor
                    @endif
                </div>

                <!-- Duplicate for seamless loop -->
                <div class="flex items-center space-x-12 px-6">
                    @foreach($partners as $partner)
                    <div class="flex flex-col items-center justify-center w-40 h-24 grayscale hover:grayscale-0 transition-all duration-300 opacity-60 hover:opacity-100">
                        @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->nama_perusahaan }}" class="max-w-full max-h-16 object-contain">
                        @else
                            <div class="flex items-center gap-2">
                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/></svg>
                                <span class="font-bold text-gray-600">{{ $partner->nama_perusahaan }}</span>
                            </div>
                        @endif
                    </div>
                    @endforeach
                     @if($partners->count() == 0)
                        @for($i=0; $i<5; $i++)
                        <div class="flex items-center justify-center w-40 h-24 opacity-40">
                            <span class="font-bold text-xl text-gray-400">MITRA {{ $i+1 }}</span>
                        </div>
                        @endfor
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Articles Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-blue-600 font-semibold tracking-wider uppercase text-sm">Berita & Artikel</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Wawasan Karir Terbaru</h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Tips, trik, dan informasi terbaru seputar dunia kerja dan pengembangan karir.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latest_articles as $article)
                <article class="group flex flex-col h-full">
                    <div class="relative overflow-hidden rounded-2xl mb-4 aspect-video">
                        @if($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-lg text-xs font-bold text-blue-600 shadow-sm">
                            {{ $article->kategori->nama ?? 'Umum' }}
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col">
                        <div class="flex items-center gap-3 text-sm text-gray-500 mb-3">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ $article->published_at ? $article->published_at->format('d M Y') : 'Draft' }}
                            </span>
                            <span>•</span>
                            <span>{{ $article->reading_time ?? '5' }} min read</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2">
                            <a href="#">{{ $article->judul }}</a>
                        </h3>
                        <p class="text-gray-600 mb-4 line-clamp-3 flex-1">
                            {{ $article->excerpt }}
                        </p>
                        <a href="#" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </article>
                @empty
                <div class="col-span-full text-center py-8 text-gray-500">
                    Belum ada artikel terbaru.
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-blue-900 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-purple-600 rounded-full mix-blend-overlay filter blur-3xl opacity-30"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500 rounded-full mix-blend-overlay filter blur-3xl opacity-30"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Siap Memulai Karir Impian Anda?</h2>
            <p class="text-blue-100 text-lg mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan alumni Politeknik Indramayu lainnya dan temukan peluang karir terbaik dari mitra perusahaan kami.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('alumni.register') }}" class="px-8 py-4 bg-white text-blue-900 rounded-xl font-bold hover:bg-blue-50 transition-colors shadow-lg">
                    Daftar Sekarang
                </a>
                <a href="{{ route('alumni.login') }}" class="px-8 py-4 bg-transparent border border-white/30 text-white rounded-xl font-bold hover:bg-white/10 transition-colors">
                    Masuk Akun
                </a>
            </div>
        </div>
    </section>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-scroll {
            animation: scroll 40s linear infinite;
        }
        .animate-scroll:hover {
            animation-play-state: paused;
        }
        .counter {
            font-variant-numeric: tabular-nums;
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Canvas Animation (Simplified for performance)
        const canvas = document.getElementById('grid-canvas');
        if(canvas) {
            const ctx = canvas.getContext('2d');
            let width, height;

            function resize() {
                width = canvas.width = canvas.parentElement.offsetWidth;
                height = canvas.height = canvas.parentElement.offsetHeight;
            }

            window.addEventListener('resize', resize);
            resize();

            // Simple grid drawing
            function draw() {
                ctx.clearRect(0, 0, width, height);
                ctx.strokeStyle = 'rgba(255, 255, 255, 0.1)';
                ctx.lineWidth = 1;

                const step = 50;

                for(let x = 0; x < width; x += step) {
                    ctx.beginPath();
                    ctx.moveTo(x, 0);
                    ctx.lineTo(x, height);
                    ctx.stroke();
                }

                for(let y = 0; y < height; y += step) {
                    ctx.beginPath();
                    ctx.moveTo(0, y);
                    ctx.lineTo(width, y);
                    ctx.stroke();
                }
            }

            draw();
        }

        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.getAttribute('data-target'));
                    const duration = 2000; // 2 seconds
                    const start = 0;
                    const startTime = performance.now();

                    function update(currentTime) {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);

                        // Ease out quart
                        const ease = 1 - Math.pow(1 - progress, 4);

                        const current = Math.floor(start + (target - start) * ease);
                        entry.target.innerText = current;

                        if (progress < 1) {
                            requestAnimationFrame(update);
                        } else {
                            entry.target.innerText = target; // Ensure final value is exact
                        }
                    }

                    requestAnimationFrame(update);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));
    });
    </script>
@endsection
