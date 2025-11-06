@extends('alumni.layouts.app')

@section('title', 'Artikel - Portal Kerja POLINDRA')

@section('content')
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
            <p class="text-gray-700 font-semibold">Total Artikel: {{ $artikels->total() }}</p>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($artikels as $artikel)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    @if($artikel->thumbnail)
                        <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="Thumbnail" class="h-48 w-full object-cover">
                    @else
                        <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-600"></div>
                    @endif
                    <div class="p-5">
                        <span class="text-xs text-blue-600 font-semibold">{{ $artikel->kategori->nama ?? '-' }}</span>
                        <h3 class="text-lg font-bold text-gray-800 mt-2 mb-3 line-clamp-2">
                            {{ $artikel->judul }}
                        </h3>
                        <a href="#" class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:from-blue-800 hover:to-purple-600 transition">
                            Selengkapnya
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-12">
                    Tidak ada artikel ditemukan.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $artikels->links() }}
        </div>
    </div>
@endsection
