@extends('alumni.layouts.app')

@section('title', $artikel->judul . ' - Portal Kerja POLINDRA')

@section('content')
    <!-- Progress Bar -->
    <div class="fixed top-0 left-0 w-full h-1 z-50 bg-gray-200">
        <div class="h-full bg-blue-600 transition-all duration-150" id="scrollProgress" style="width: 0%"></div>
    </div>

    <!-- Hero Section -->
    <div class="relative bg-gray-900 min-h-[60vh] flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            @if($artikel->thumbnail)
                <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover opacity-40 blur-sm scale-105">
            @else
                <div class="w-full h-full bg-gradient-to-br from-blue-900 to-purple-900 opacity-80"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
        </div>

        <!-- Content -->
        <div class="container mx-auto px-4 md:px-6 relative z-10 pt-20 pb-12 text-center max-w-4xl">
            <div class="mb-6 animate-fade-in-up">
                <span class="inline-block px-4 py-1.5 rounded-full bg-blue-600/90 backdrop-blur-sm text-white text-sm font-bold shadow-lg mb-4">
                    {{ $artikel->kategori->nama ?? 'Umum' }}
                </span>
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6 drop-shadow-lg">
                    {{ $artikel->judul }}
                </h1>
            </div>

            <!-- Meta Info -->
            <div class="flex flex-wrap items-center justify-center gap-6 text-gray-300 text-sm md:text-base animate-fade-in-up delay-100">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($artikel->user->name) }}&background=random" 
                         alt="{{ $artikel->user->name }}" class="w-10 h-10 rounded-full border-2 border-white/20 mr-3">
                    <div class="text-left">
                        <p class="font-semibold text-white flex items-center">
                            {{ $artikel->user->name }}
                            @if($artikel->user->hasRole('admin') || $artikel->user->hasRole('mitra'))
                                <svg class="w-4 h-4 text-blue-400 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                        </p>
                        <p class="text-xs opacity-80">Penulis</p>
                    </div>
                </div>
                <div class="hidden md:block w-1.5 h-1.5 bg-gray-500 rounded-full"></div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $artikel->published_at->format('d F Y') }}
                </div>
                <div class="hidden md:block w-1.5 h-1.5 bg-gray-500 rounded-full"></div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $artikel->reading_time ?? '5' }} menit baca
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="container mx-auto px-4 md:px-6 relative z-20 -mt-20">
        <div class="max-w-4xl mx-auto">
            <!-- Article Body -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12 animate-fade-in-up delay-200">
                <!-- Main Image (Clear) -->
                @if($artikel->thumbnail)
                    <div class="w-full h-64 md:h-96 relative">
                        <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="p-8 md:p-12">
                    <!-- Share Buttons (Mobile) -->
                    <div class="flex md:hidden gap-4 mb-8 justify-center border-b pb-6">
                        <button class="p-2 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </button>
                        <button class="p-2 rounded-full bg-blue-100 text-blue-800 hover:bg-blue-200 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </button>
                        <button class="p-2 rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </button>
                    </div>

                    <!-- Article Content -->
                    <article class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed">
                        {!! $artikel->konten !!}
                    </article>

                    <!-- Tags (if any) -->
                    <div class="mt-12 pt-8 border-t border-gray-100">
                        <div class="flex flex-wrap gap-2">
                            @if($artikel->kategori)
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">
                                    #{{ $artikel->kategori->nama }}
                                </span>
                            @endif
                            
                            {{-- tags adalah array, bukan relasi --}}
                            @if($artikel->tags && is_array($artikel->tags))
                                @foreach ($artikel->tags as $tag)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">
                                        #{{ $tag }}
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            @if(isset($related) && $related->count() > 0)
            <div class="mb-16">
                <h3 class="text-2xl font-bold text-gray-800 mb-8 border-l-4 border-blue-600 pl-4">Artikel Terkait</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($related as $item)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : 'https://via.placeholder.com/800x400' }}" 
                                 alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute top-3 left-3">
                                <span class="bg-white/90 backdrop-blur-sm text-xs font-bold px-2 py-1 rounded text-gray-800">
                                    {{ $item->kategori->nama }}
                                </span>
                            </div>
                        </div>
                        <div class="p-5">
                            <h4 class="font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-600 transition">
                                <a href="{{ route('artikel.detail', $item->slug) }}">{{ $item->judul }}</a>
                            </h4>
                            <div class="flex items-center text-xs text-gray-500 mt-3">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $item->published_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Back Button -->
            <div class="text-center pb-12">
                <a href="{{ route('artikel.page') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar Artikel
                </a>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fade-in-up 0.8s ease-out forwards; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        
        /* Typography enhancements */
        .prose h2 { color: #1e3a8a; font-weight: 700; margin-top: 2em; }
        .prose h3 { color: #1f2937; font-weight: 600; margin-top: 1.5em; }
        .prose p { margin-bottom: 1.5em; line-height: 1.8; }
        .prose blockquote { border-left-color: #3b82f6; background: #f9fafb; padding: 1rem; border-radius: 0 0.5rem 0.5rem 0; font-style: italic; }
        .prose img { border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
        .prose a { color: #2563eb; text-decoration: none; border-bottom: 2px solid #bfdbfe; transition: all 0.2s; }
        .prose a:hover { color: #1d4ed8; border-bottom-color: #2563eb; }
    </style>

    <script>
        // Scroll Progress Bar
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("scrollProgress").style.width = scrolled + "%";
        };
    </script>
@endsection
