@extends('admin.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto animate-fade-in">
    <!-- Breadcrumb -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 transition">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('admin.artikel.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Artikel</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail Artikel</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header with Thumbnail -->
    @if($artikel->thumbnail)
        <div class="relative h-96 rounded-2xl overflow-hidden mb-6 shadow-2xl">
            <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                <div class="flex items-center space-x-3 mb-4">
                    @if($artikel->status === 'published')
                        <span class="px-3 py-1 bg-green-500/90 backdrop-blur-sm rounded-full text-xs font-semibold">Published</span>
                    @elseif($artikel->status === 'draft')
                        <span class="px-3 py-1 bg-gray-500/90 backdrop-blur-sm rounded-full text-xs font-semibold">Draft</span>
                    @else
                        <span class="px-3 py-1 bg-yellow-500/90 backdrop-blur-sm rounded-full text-xs font-semibold">Scheduled</span>
                    @endif
                    
                    @if($artikel->is_featured)
                        <span class="px-3 py-1 bg-yellow-500/90 backdrop-blur-sm rounded-full text-xs font-semibold flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            Unggulan
                        </span>
                    @endif
                    
                    <span class="px-3 py-1 bg-blue-500/90 backdrop-blur-sm rounded-full text-xs font-semibold">
                        {{ $artikel->kategori->nama ?? 'Uncategorized' }}
                    </span>
                </div>
                <h1 class="text-4xl font-bold mb-2">{{ $artikel->judul }}</h1>
                <div class="flex items-center text-sm text-gray-200 space-x-4">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ $artikel->user->name ?? 'Unknown' }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $artikel->created_at->format('d M Y') }}
                    </span>
                    @if($artikel->reading_time)
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $artikel->reading_time }} min read
                        </span>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-6 text-white">
            <div class="flex items-center space-x-3 mb-4">
                @if($artikel->status === 'published')
                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs font-semibold">Published</span>
                @elseif($artikel->status === 'draft')
                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs font-semibold">Draft</span>
                @else
                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs font-semibold">Scheduled</span>
                @endif
                
                @if($artikel->is_featured)
                    <span class="px-3 py-1 bg-yellow-500/90 backdrop-blur-sm rounded-full text-xs font-semibold flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        Unggulan
                    </span>
                @endif
            </div>
            <h1 class="text-4xl font-bold mb-2">{{ $artikel->judul }}</h1>
            <div class="flex items-center text-sm text-blue-100 space-x-4">
                <span>{{ $artikel->user->name ?? 'Unknown' }}</span>
                <span>•</span>
                <span>{{ $artikel->created_at->format('d M Y') }}</span>
                @if($artikel->reading_time)
                    <span>•</span>
                    <span>{{ $artikel->reading_time }} min read</span>
                @endif
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex items-center justify-end space-x-3 mb-6">
        <a href="{{ route('admin.artikel.edit', $artikel->id) }}"
           class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Artikel
        </a>
        <a href="{{ route('admin.artikel.index') }}"
           class="px-6 py-3 border-2 border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-100 transition-all duration-200">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Excerpt -->
            @if($artikel->excerpt)
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-6">
                    <p class="text-lg text-gray-700 italic">{{ $artikel->excerpt }}</p>
                </div>
            @endif

            <!-- Content -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="prose prose-lg max-w-none">
                    {!! $artikel->konten !!}
                </div>
            </div>

            <!-- Tags -->
            @if($artikel->tags && count($artikel->tags) > 0)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($artikel->tags as $tag)
                            <span class="px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100 text-blue-700 rounded-full text-sm font-medium">
                                #{{ trim($tag) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Article Info -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Artikel</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Kategori</p>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                            {{ $artikel->kategori->nama ?? '-' }}
                        </span>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Status</p>
                        @if($artikel->status === 'published')
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Published</span>
                        @elseif($artikel->status === 'draft')
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-semibold">Draft</span>
                        @else
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">Scheduled</span>
                        @endif
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Penulis</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $artikel->user->name ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Tanggal Dibuat</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $artikel->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    
                    @if($artikel->published_at)
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Tanggal Publikasi</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $artikel->published_at->format('d M Y, H:i') }}</p>
                        </div>
                    @endif
                    
                    @if($artikel->reading_time)
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Waktu Baca</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $artikel->reading_time }} menit</p>
                        </div>
                    @endif
                    
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Slug</p>
                        <p class="text-sm font-mono text-gray-900 bg-gray-50 px-2 py-1 rounded">{{ $artikel->slug }}</p>
                    </div>
                </div>
            </div>

            <!-- SEO Info -->
            @if($artikel->meta_description)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        SEO
                    </h3>
                    <div>
                        <p class="text-sm text-gray-600 mb-2">Meta Description</p>
                        <p class="text-sm text-gray-900">{{ $artikel->meta_description }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out;
    }
    .prose img {
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
