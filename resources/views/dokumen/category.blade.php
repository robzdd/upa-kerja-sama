@extends('alumni.layouts.app')

@section('title', $kategori->nama . ' - Dokumen Publik')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-900 via-indigo-800 to-purple-900 text-white py-16">
        <div class="container mx-auto px-6 relative z-10">
            <!-- Breadcrumb -->
            <nav class="flex mb-8 text-sm text-blue-200" aria-label="Breadcrumb">
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
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('dokumen.index') }}" class="ml-1 hover:text-white transition md:ml-2">Dokumen</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-white md:ml-2 font-medium">{{ $kategori->nama }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center">
                    <i class="fas {{ $kategori->icon ?? 'fa-folder' }} text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-4xl font-bold">{{ $kategori->nama }}</h1>
                    @if($kategori->deskripsi)
                        <p class="text-blue-100 mt-2">{{ $kategori->deskripsi }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Documents Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($dokumens as $dokumen)
                    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 {{ $dokumen->file_type == 'PDF' ? 'bg-red-50 text-red-500' : 'bg-green-50 text-green-500' }} rounded-lg flex items-center justify-center">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-medium bg-gray-100 text-gray-600 px-3 py-1 rounded-full">{{ $dokumen->file_type }}</span>
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2 text-lg">{{ $dokumen->judul }}</h3>
                        @if($dokumen->deskripsi)
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $dokumen->deskripsi }}</p>
                        @endif
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                            <span>{{ $dokumen->file_size_formatted }}</span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                {{ $dokumen->download_count }}x
                            </span>
                        </div>
                        <a href="{{ route('dokumen.download', $dokumen->id) }}" 
                           class="w-full block text-center bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-medium py-3 rounded-lg transition shadow-md hover:shadow-lg transform hover:scale-105">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-500 font-medium">Belum ada dokumen dalam kategori ini</p>
                        <a href="{{ route('dokumen.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-700 font-medium">
                            ← Kembali ke Kategori
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($dokumens->hasPages())
                <div class="mt-8">
                    {{ $dokumens->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
