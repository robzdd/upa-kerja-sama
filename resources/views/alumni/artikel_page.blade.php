@extends('alumni.layouts.app')

@section('title', 'Artikel & Berita - Portal Kerja POLINDRA')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900 text-white pb-32 md:pb-40 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        
        <!-- Navbar -->
        @include('components.navbar')

        <!-- Hero Content -->
        <div class="container mx-auto px-6 py-12 md:py-16 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-4 md:mb-6 animate-fade-in-up leading-tight">
                Wawasan Karir & Berita Kampus
            </h1>
            <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto mb-8 md:mb-10 animate-fade-in-up delay-100 px-4">
                Dapatkan informasi terbaru seputar dunia kerja, tips karir, dan update kegiatan alumni Politeknik Negeri Indramayu.
            </p>
            
            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto relative animate-fade-in-up delay-200 px-4">
                <form action="{{ route('artikel.page') }}" method="GET">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel menarik..." 
                        class="w-full px-6 py-4 rounded-full text-gray-800 focus:outline-none focus:ring-4 focus:ring-blue-500/30 shadow-lg pl-14 text-sm md:text-base">
                    <svg class="w-6 h-6 text-gray-400 absolute left-8 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <button type="submit" class="absolute right-2 top-2 bottom-2 bg-blue-600 text-white px-4 md:px-6 rounded-full hover:bg-blue-700 transition font-semibold text-sm md:text-base">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 md:px-6 -mt-16 relative z-20 pb-20">
        
        @php
            // Gabungkan semua artikel untuk pengecekan
            $hasAnyArticle = (isset($featured) && $featured->count() > 0) || (isset($artikels) && $artikels->count() > 0);
            $isSearching = request('search') || request('category');
        @endphp

        @if(!$hasAnyArticle)
            <!-- Empty State - Tidak ada artikel sama sekali -->
            <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                @if($isSearching)
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Artikel tidak ditemukan</h3>
                    <p class="text-gray-600 mb-6">Tidak ada artikel yang cocok dengan pencarian "{{ request('search') }}"</p>
                    <a href="{{ route('artikel.page') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Lihat Semua Artikel
                    </a>
                @else
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada artikel</h3>
                    <p class="text-gray-600">Silakan kembali lagi nanti untuk update terbaru.</p>
                @endif
            </div>
        @else
            <!-- Featured Articles -->
            @if(isset($featured) && $featured->count() > 0 && !$isSearching)
            <div class="mb-12 md:mb-16">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="w-1 h-8 bg-blue-600 rounded-full mr-3"></span>
                    Artikel Pilihan
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach($featured as $item)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:-translate-y-2 transition duration-300 group flex flex-col">
                        <div class="relative h-48 md:h-56 overflow-hidden flex-shrink-0">
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                     alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                    {{ $item->kategori->nama ?? 'Umum' }}
                                </span>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    Featured
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center text-xs text-gray-500 mb-3 space-x-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                                </span>
                                @if(isset($item->reading_time))
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $item->reading_time }} min baca
                                </span>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition">
                                <a href="{{ route('artikel.detail', $item->slug) }}">{{ $item->judul }}</a>
                            </h3>
                            <p class="text-gray-600 mb-4 line-clamp-3 text-sm flex-1">
                                {{ $item->excerpt ?? Str::limit(strip_tags($item->konten), 150) }}
                            </p>
                            
                            <!-- Author Info -->
                            <div class="flex items-center justify-between border-t pt-4 mt-auto">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden mr-3 flex-shrink-0">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item->user->name ?? 'Unknown') }}&background=random" alt="{{ $item->user->name ?? 'Unknown' }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-800 flex items-center">
                                            {{ $item->user->name ?? 'Pengguna Tidak Dikenal' }}
                                            @if(isset($item->user) && $item->user && ($item->user->hasRole('admin') || $item->user->hasRole('mitra')))
                                                <svg class="w-3 h-3 text-blue-500 ml-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                                </svg>
                                            @endif
                                        </p>
                                        <p class="text-[10px] text-gray-500">Penulis</p>
                                    </div>
                                </div>
                                <a href="{{ route('artikel.detail', $item->slug) }}" class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center group/link">
                                    Baca
                                    <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Articles List -->
            @if(isset($artikels) && $artikels->count() > 0)
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="w-1 h-8 bg-blue-600 rounded-full mr-3"></span>
                    @if($isSearching)
                        Hasil Pencarian
                        <span class="ml-2 text-sm font-normal text-gray-500">({{ $artikels->total() }} artikel)</span>
                    @else
                        Semua Artikel
                    @endif
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach($artikels as $artikel)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 flex flex-col h-full border border-gray-100">
                            <div class="relative h-48 md:h-52 overflow-hidden flex-shrink-0">
                                @if($artikel->thumbnail)
                                    <img src="{{ asset('storage/' . $artikel->thumbnail) }}" 
                                         alt="{{ $artikel->judul }}" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <span class="bg-white/90 backdrop-blur-sm text-blue-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                        {{ $artikel->kategori->nama ?? 'Umum' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-5 flex-1 flex flex-col">
                                <div class="flex items-center text-xs text-gray-500 mb-3">
                                    <span class="flex items-center bg-gray-100 px-2 py-1 rounded">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $artikel->published_at ? $artikel->published_at->format('d M Y') : '-' }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold text-gray-800 mb-3 line-clamp-2 hover:text-blue-600 transition leading-snug">
                                    <a href="{{ route('artikel.detail', $artikel->slug) }}">{{ $artikel->judul }}</a>
                                </h3>
                                
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-1 leading-relaxed">
                                    {{ $artikel->excerpt ?? Str::limit(strip_tags($artikel->konten), 120) }}
                                </p>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                    <div class="flex items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($artikel->user->name ?? 'Unknown') }}&background=random" 
                                             alt="{{ $artikel->user->name ?? 'Unknown' }}" class="w-8 h-8 rounded-full mr-2 border-2 border-white shadow-sm flex-shrink-0">
                                        <div>
                                            <p class="text-xs font-semibold text-gray-800 flex items-center">
                                                {{ Str::limit($artikel->user->name ?? 'Unknown', 15) }}
                                                @if(isset($artikel->user) && $artikel->user && ($artikel->user->hasRole('admin') || $artikel->user->hasRole('mitra')))
                                                    <svg class="w-3 h-3 text-blue-500 ml-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ route('artikel.detail', $artikel->slug) }}" class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center group/link whitespace-nowrap">
                                        Baca
                                        <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Pagination -->
            @if($artikels->hasPages())
            <div class="mt-8">
                {{ $artikels->withQueryString()->links() }}
            </div>
            @endif
            @endif
        @endif
    </div>

    <style>
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fade-in-up 0.8s ease-out forwards; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        
        /* Custom line clamp */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection