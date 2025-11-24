@extends('alumni.layouts.app')

@section('title', 'Dokumen Publik - Portal Kerja POLINDRA')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-900 via-indigo-800 to-purple-900 text-white py-20">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-blue-900/30 to-blue-900/50"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <!-- Breadcrumb -->
                <nav class="flex mb-6 text-sm text-blue-200" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}" class="inline-flex items-center hover:text-white transition">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <a href="{{ route('alumni.tentang_kami') }}" class="ml-1 hover:text-white transition md:ml-2">Tentang Kami</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-white md:ml-2 font-medium">Dokumen Publik</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <h1 class="text-4xl md:text-5xl font-bold mb-4">Dokumen Publik</h1>
                <p class="text-xl text-blue-100">
                    Akses dokumen penting dan panduan dari UPA Kerjasama POLINDRA
                </p>
            </div>
        </div>
    </div>

    <!-- Kategori Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="text-blue-600 font-semibold tracking-wide uppercase text-sm">Kategori Dokumen</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">Pilih Kategori</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($kategoris as $kategori)
                    <a href="{{ route('dokumen.category', $kategori->id) }}" 
                       class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                        <div class="flex items-start space-x-4">
                            @php
                                $colorMap = [
                                    'blue' => ['bg' => '#DBEAFE', 'text' => '#2563EB'],
                                    'green' => ['bg' => '#D1FAE5', 'text' => '#059669'],
                                    'purple' => ['bg' => '#E9D5FF', 'text' => '#9333EA'],
                                    'red' => ['bg' => '#FEE2E2', 'text' => '#DC2626'],
                                    'yellow' => ['bg' => '#FEF3C7', 'text' => '#D97706'],
                                    'indigo' => ['bg' => '#E0E7FF', 'text' => '#4F46E5'],
                                    'pink' => ['bg' => '#FCE7F3', 'text' => '#DB2777'],
                                    'orange' => ['bg' => '#FFEDD5', 'text' => '#EA580C'],
                                ];
                                $color = $kategori->color ?? 'blue';
                                $bgColor = $colorMap[$color]['bg'] ?? $colorMap['blue']['bg'];
                                $textColor = $colorMap[$color]['text'] ?? $colorMap['blue']['text'];
                            @endphp
                            <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition" 
                                 style="background-color: {{ $bgColor }}; color: {{ $textColor }};">
                                <i class="fas {{ $kategori->icon ?? 'fa-folder' }} text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition">
                                    {{ $kategori->nama }}
                                </h3>
                                @if($kategori->deskripsi)
                                    <p class="text-sm text-gray-600 mb-3">{{ $kategori->deskripsi }}</p>
                                @endif
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $kategori->dokumen_count }} dokumen
                                </div>
                            </div>
                            <div class="text-gray-400 group-hover:text-blue-600 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-500 font-medium">Belum ada kategori dokumen tersedia</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
