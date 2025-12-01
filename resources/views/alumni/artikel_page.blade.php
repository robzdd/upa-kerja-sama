@extends('alumni.layouts.app')

@section('title', 'Artikel & Berita - Portal Kerja POLINDRA')

@section('content')
    <!-- Header Section with Interactive Grid -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900 text-white relative overflow-hidden -mb-1" id="hero-section">
        <!-- Interactive Canvas Grid -->
        <canvas id="grid-canvas" class="absolute inset-0 w-full h-full z-0"></canvas>
        
        <!-- Mouse Glow Effect -->
        <div id="mouse-glow" class="absolute w-80 h-80 rounded-full pointer-events-none z-[1] transition-opacity duration-300" 
             style="background: radial-gradient(circle, rgba(59,130,246,0.4) 0%, rgba(147,51,234,0.2) 40%, transparent 70%); 
                    transform: translate(-50%, -50%); 
                    filter: blur(40px);
                    opacity: 0;"></div>
        
        <!-- Floating Particles -->
        <div id="particles-container" class="absolute inset-0 z-[1] pointer-events-none overflow-hidden"></div>
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-blue-900/30 to-blue-900/50 z-[2] pointer-events-none"></div>
        
        <!-- Seamless Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full z-[3] pointer-events-none">
            <!-- Multiple layered waves for depth -->
            <svg class="w-full h-auto" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <!-- Back wave - subtle -->
                <path d="M0,60 C360,120 720,0 1080,60 C1260,90 1380,80 1440,70 L1440,120 L0,120 Z" fill="rgba(249,250,251,0.3)"/>
                <!-- Middle wave -->
                <path d="M0,80 C240,40 480,100 720,80 C960,60 1200,100 1440,60 L1440,120 L0,120 Z" fill="rgba(249,250,251,0.5)"/>
                <!-- Front wave - main -->
                <path d="M0,100 C180,80 360,110 540,95 C720,80 900,110 1080,95 C1260,80 1380,100 1440,90 L1440,120 L0,120 Z" fill="#f9fafb"/>
            </svg>
        </div>
        
        <!-- Bottom gradient fade -->
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-gray-50 to-transparent z-[2] pointer-events-none"></div>
        
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
            <div class="max-w-2xl mx-auto relative animate-fade-in-up delay-200 px-4 pb-8">
                <form action="{{ route('artikel.page') }}" method="GET" class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari artikel menarik..." 
                           class="w-full px-6 py-4 rounded-full text-gray-800 focus:outline-none focus:ring-4 focus:ring-blue-500/30 shadow-lg pl-14 pr-28 text-sm md:text-base">
                    <svg class="w-6 h-6 text-gray-400 absolute left-6 top-1/2 transform -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    @if(request('search'))
                        <a href="{{ route('artikel.page') }}" class="absolute right-24 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    @endif
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 text-white px-5 md:px-6 py-2.5 rounded-full hover:bg-blue-700 transition font-semibold text-sm md:text-base">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('grid-canvas');
        const ctx = canvas.getContext('2d');
        const hero = document.getElementById('hero-section');
        const mouseGlow = document.getElementById('mouse-glow');
        const particlesContainer = document.getElementById('particles-container');
        
        let mouseX = -1000, mouseY = -1000;
        let targetX = -1000, targetY = -1000;
        let isMouseInHero = false;
        
        const cfg = {
            gridSize: 50,
            influenceRadius: 180,
            maxDisplacement: 25,
            waveAmplitude: 3,
            waveSpeed: 0.002
        };
        
        let time = 0;
        
        function resize() {
            canvas.width = hero.offsetWidth;
            canvas.height = hero.offsetHeight;
        }
        resize();
        window.addEventListener('resize', resize);
        
        // Create floating particles
        for (let i = 0; i < 20; i++) {
            const p = document.createElement('div');
            p.style.cssText = `
                position:absolute;
                width:${Math.random()*4+2}px;
                height:${Math.random()*4+2}px;
                background:rgba(255,255,255,${Math.random()*0.3+0.1});
                border-radius:50%;
                left:${Math.random()*100}%;
                top:${Math.random()*100}%;
                animation:float-p ${Math.random()*10+10}s linear infinite;
                animation-delay:${Math.random()*-20}s;
            `;
            particlesContainer.appendChild(p);
        }
        
        hero.addEventListener('mousemove', (e) => {
            const rect = hero.getBoundingClientRect();
            targetX = e.clientX - rect.left;
            targetY = e.clientY - rect.top;
            
            // Calculate if mouse is in center area (not near edges)
            const edgeThreshold = 150; // pixels from edge
            const isInCenterArea = 
                targetX > edgeThreshold && 
                targetX < canvas.width - edgeThreshold &&
                targetY > edgeThreshold && 
                targetY < canvas.height - edgeThreshold;
            
            isMouseInHero = isInCenterArea;
            
            // Move the glow effect - fade based on distance from edges
            const leftDist = targetX;
            const rightDist = canvas.width - targetX;
            const topDist = targetY;
            const bottomDist = canvas.height - targetY;
            const minDist = Math.min(leftDist, rightDist, topDist, bottomDist);
            
            // Calculate opacity based on distance from nearest edge
            let glowOpacity = 0;
            if (minDist > edgeThreshold) {
                glowOpacity = 1;
            } else if (minDist > 0) {
                glowOpacity = minDist / edgeThreshold; // Fade from 0 to 1
            }
            
            mouseGlow.style.opacity = glowOpacity.toString();
            mouseGlow.style.left = targetX + 'px';
            mouseGlow.style.top = targetY + 'px';
        });
        
        hero.addEventListener('mouseleave', () => {
            isMouseInHero = false;
            mouseGlow.style.opacity = '0';
        });
        
        function lerp(a, b, t) { return a + (b - a) * t; }
        
        function getDisplacement(px, py, mx, my, t) {
            const dx = px - mx, dy = py - my;
            const dist = Math.sqrt(dx*dx + dy*dy);
            const wave = Math.sin(px*0.02+t)*cfg.waveAmplitude + Math.cos(py*0.02+t*0.7)*cfg.waveAmplitude;
            
            // Calculate edge dampening factor - completely disable near edges
            const edgeMargin = 150; // pixels from edge
            const leftEdgeFactor = Math.min(px / edgeMargin, 1);
            const rightEdgeFactor = Math.min((canvas.width - px) / edgeMargin, 1);
            const topEdgeFactor = Math.min(py / edgeMargin, 1);
            const bottomEdgeFactor = Math.min((canvas.height - py) / edgeMargin, 1);
            const edgeDampening = Math.min(leftEdgeFactor, rightEdgeFactor, topEdgeFactor, bottomEdgeFactor);
            
            // Only apply mouse effect if in center area
            if (dist > cfg.influenceRadius || !isMouseInHero) return { x: wave*0.5, y: wave*0.5 };
            
            const force = (1 - dist/cfg.influenceRadius) * cfg.maxDisplacement * edgeDampening;
            const angle = Math.atan2(dy, dx);
            return { x: Math.cos(angle)*force + wave, y: Math.sin(angle)*force + wave };
        }
        
        function draw() {
            time += cfg.waveSpeed;
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            mouseX = lerp(mouseX, targetX, 0.08);
            mouseY = lerp(mouseY, targetY, 0.08);
            
            const grad = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
            grad.addColorStop(0, 'rgba(147,197,253,0.15)');
            grad.addColorStop(0.5, 'rgba(196,181,253,0.12)');
            grad.addColorStop(1, 'rgba(147,197,253,0.08)');
            
            ctx.strokeStyle = grad;
            ctx.lineWidth = 1;
            
            for (let x = 0; x <= canvas.width + cfg.gridSize; x += cfg.gridSize) {
                ctx.beginPath();
                for (let y = 0; y <= canvas.height; y += 4) {
                    const d = getDisplacement(x, y, mouseX, mouseY, time);
                    y === 0 ? ctx.moveTo(x+d.x, y+d.y) : ctx.lineTo(x+d.x, y+d.y);
                }
                ctx.stroke();
            }
            
            for (let y = 0; y <= canvas.height + cfg.gridSize; y += cfg.gridSize) {
                ctx.beginPath();
                for (let x = 0; x <= canvas.width; x += 4) {
                    const d = getDisplacement(x, y, mouseX, mouseY, time);
                    x === 0 ? ctx.moveTo(x+d.x, y+d.y) : ctx.lineTo(x+d.x, y+d.y);
                }
                ctx.stroke();
            }
            
            if (isMouseInHero) {
                for (let x = 0; x <= canvas.width + cfg.gridSize; x += cfg.gridSize) {
                    for (let y = 0; y <= canvas.height + cfg.gridSize; y += cfg.gridSize) {
                        const d = getDisplacement(x, y, mouseX, mouseY, time);
                        const dist = Math.sqrt((x-mouseX)**2 + (y-mouseY)**2);
                        
                        if (dist < cfg.influenceRadius) {
                            const opacity = (1 - dist/cfg.influenceRadius) * 0.9;
                            const size = (1 - dist/cfg.influenceRadius) * 5 + 1;
                            
                            // Calculate edge dampening for highlights too
                            const edgeMargin = 150;
                            const leftEdgeFactor = Math.min(x / edgeMargin, 1);
                            const rightEdgeFactor = Math.min((canvas.width - x) / edgeMargin, 1);
                            const topEdgeFactor = Math.min(y / edgeMargin, 1);
                            const bottomEdgeFactor = Math.min((canvas.height - y) / edgeMargin, 1);
                            const edgeDampening = Math.min(leftEdgeFactor, rightEdgeFactor, topEdgeFactor, bottomEdgeFactor);
                            
                            const finalOpacity = opacity * edgeDampening;
                            const finalSize = size * (0.5 + edgeDampening * 0.5);
                            
                            ctx.beginPath();
                            ctx.arc(x+d.x, y+d.y, finalSize+3, 0, Math.PI*2);
                            ctx.fillStyle = `rgba(147,197,253,${finalOpacity*0.3})`;
                            ctx.fill();
                            
                            ctx.beginPath();
                            ctx.arc(x+d.x, y+d.y, finalSize, 0, Math.PI*2);
                            ctx.fillStyle = `rgba(255,255,255,${finalOpacity})`;
                            ctx.fill();
                        }
                    }
                }
            }
            requestAnimationFrame(draw);
        }
        draw();
    });
    </script>

    <style>
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes float-p {
            0%, 100% { transform: translate(0,0) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translate(100px,-100vh) rotate(360deg); opacity: 0; }
        }
        .animate-fade-in-up { animation: fade-in-up 0.6s ease-out forwards; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        
        /* Seamless transition fix */
        #hero-section { margin-bottom: -1px; }
        .bg-gray-50 { position: relative; z-index: 1; }
    </style>

    <!-- Main Content -->
    <div class="bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 md:px-6 py-10 md:py-14">
            
            @php
                $hasAnyArticle = (isset($featured) && $featured->count() > 0) || (isset($artikels) && $artikels->count() > 0);
                $isSearching = request('search') || request('category');
            @endphp

            <!-- Search Result Info -->
            @if(request('search'))
                <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Hasil pencarian untuk</p>
                            <p class="font-semibold text-gray-800">"{{ request('search') }}"</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-500">
                            Ditemukan <span class="font-semibold text-blue-600">{{ $artikels->total() ?? 0 }}</span> artikel
                        </span>
                        <a href="{{ route('artikel.page') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition text-sm font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reset
                        </a>
                    </div>
                </div>
            @endif

            @if(!$hasAnyArticle)
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center max-w-lg mx-auto">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    @if($isSearching)
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Artikel tidak ditemukan</h3>
                        <p class="text-gray-500 mb-6">Tidak ada artikel yang cocok dengan pencarian Anda. Coba kata kunci lain.</p>
                        <a href="{{ route('artikel.page') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition font-semibold">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Lihat Semua Artikel
                        </a>
                    @else
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada artikel</h3>
                        <p class="text-gray-500">Silakan kembali lagi nanti untuk update terbaru.</p>
                    @endif
                </div>
            @else
                <!-- Featured Articles -->
                @if(isset($featured) && $featured->count() > 0 && !$isSearching)
                <div class="mb-10 md:mb-14">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800 flex items-center">
                            <span class="w-1.5 h-7 bg-blue-600 rounded-full mr-3"></span>
                            Artikel Pilihan
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($featured as $item)
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl overflow-hidden transform hover:-translate-y-1 transition duration-300 group flex flex-col">
                            <div class="relative h-48 overflow-hidden flex-shrink-0">
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                         alt="{{ $item->judul }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                        <svg class="w-14 h-14 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                <div class="absolute top-3 left-3 flex gap-2">
                                    <span class="bg-yellow-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Pilihan
                                    </span>
                                </div>
                                <div class="absolute bottom-3 left-3">
                                    <span class="bg-white/90 backdrop-blur-sm text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                                        {{ $item->kategori->nama ?? 'Umum' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 flex-1 flex flex-col">
                                <div class="flex items-center text-xs text-gray-500 mb-3 gap-3">
                                    <span class="flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                                    </span>
                                    @if(isset($item->reading_time))
                                    <span class="flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $item->reading_time }} menit
                                    </span>
                                    @endif
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-600 transition leading-snug">
                                    <a href="{{ route('artikel.detail', $item->slug) }}">{{ $item->judul }}</a>
                                </h3>
                                <p class="text-gray-500 text-sm mb-4 line-clamp-2 flex-1">
                                    {{ $item->excerpt ?? Str::limit(strip_tags($item->konten ?? ''), 100) }}
                                </p>
                                
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                    <div class="flex items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item->user->name ?? 'U') }}&background=random&size=32" 
                                             alt="{{ $item->user->name ?? 'Unknown' }}" 
                                             class="w-7 h-7 rounded-full mr-2 border border-gray-200">
                                        <span class="text-xs font-medium text-gray-700 flex items-center">
                                            {{ Str::limit($item->user->name ?? 'Unknown', 12) }}
                                            @if(isset($item->user) && $item->user && ($item->user->hasRole('admin') || $item->user->hasRole('mitra')))
                                                <svg class="w-3.5 h-3.5 text-blue-500 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                        </span>
                                    </div>
                                    <a href="{{ route('artikel.detail', $item->slug) }}" class="text-blue-600 text-sm font-semibold hover:text-blue-700 flex items-center group/btn">
                                        Baca
                                        <svg class="w-4 h-4 ml-1 transform group-hover/btn:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- All Articles -->
                @if(isset($artikels) && $artikels->count() > 0)
                <div>
                    @if(!$isSearching)
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800 flex items-center">
                            <span class="w-1.5 h-7 bg-blue-600 rounded-full mr-3"></span>
                            Semua Artikel
                        </h2>
                        <span class="text-sm text-gray-500">{{ $artikels->total() }} artikel</span>
                    </div>
                    @endif
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($artikels as $artikel)
                        <article class="bg-white rounded-xl shadow-sm hover:shadow-lg overflow-hidden transition duration-300 flex flex-col h-full border border-gray-100 group">
                            <div class="relative h-44 overflow-hidden flex-shrink-0">
                                @if($artikel->thumbnail)
                                    <img src="{{ asset('storage/' . $artikel->thumbnail) }}" 
                                         alt="{{ $artikel->judul }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-3 right-3">
                                    <span class="bg-white/95 backdrop-blur-sm text-gray-700 text-xs font-medium px-2.5 py-1 rounded-full shadow-sm">
                                        {{ $artikel->kategori->nama ?? 'Umum' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-5 flex-1 flex flex-col">
                                <div class="flex items-center text-xs text-gray-400 mb-3">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $artikel->published_at ? $artikel->published_at->format('d M Y') : '-' }}
                                </div>

                                <h3 class="text-base font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-600 transition leading-snug">
                                    <a href="{{ route('artikel.detail', $artikel->slug) }}">{{ $artikel->judul }}</a>
                                </h3>
                                
                                <p class="text-gray-500 text-sm mb-4 line-clamp-2 flex-1">
                                    {{ $artikel->excerpt ?? Str::limit(strip_tags($artikel->konten ?? ''), 100) }}
                                </p>

                                <div class="flex items-center justify-between pt-3 border-t border-gray-100 mt-auto">
                                    <div class="flex items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($artikel->user->name ?? 'U') }}&background=random&size=28" 
                                             alt="{{ $artikel->user->name ?? 'Unknown' }}" 
                                             class="w-6 h-6 rounded-full mr-2">
                                        <span class="text-xs text-gray-600 flex items-center">
                                            {{ Str::limit($artikel->user->name ?? 'Unknown', 10) }}
                                            @if(isset($artikel->user) && $artikel->user && ($artikel->user->hasRole('admin') || $artikel->user->hasRole('mitra')))
                                                <svg class="w-3 h-3 text-blue-500 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                        </span>
                                    </div>
                                    <a href="{{ route('artikel.detail', $artikel->slug) }}" class="text-blue-600 text-xs font-semibold hover:text-blue-700 flex items-center group/btn">
                                        Selengkapnya
                                        <svg class="w-3.5 h-3.5 ml-1 transform group-hover/btn:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($artikels->hasPages())
                    <div class="mt-10 flex justify-center">
                        <nav class="inline-flex items-center gap-1 bg-white px-4 py-3 rounded-xl shadow-sm border border-gray-100">
                            {{ $artikels->withQueryString()->links() }}
                        </nav>
                    </div>
                    @endif
                </div>
                @endif
            @endif
        </div>
    </div>
@endsection