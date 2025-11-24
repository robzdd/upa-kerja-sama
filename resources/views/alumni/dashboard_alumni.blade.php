@extends('alumni.layouts.app')

@section('title', 'Beranda - Portal Kerja POLINDRA')

@section('content')
    <!-- Header Section with Interactive Grid Background -->
    <div class="relative bg-gradient-to-r from-blue-900 via-indigo-800 to-purple-900 text-white pb-32 overflow-hidden -mb-1" id="hero-section">
        <!-- Interactive Grid Background -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <!-- Canvas for Interactive Grid -->
            <canvas id="grid-canvas" class="absolute inset-0 w-full h-full"></canvas>
            
            <!-- Glowing Orbs that follow mouse -->
            <div id="mouse-glow" class="absolute w-80 h-80 rounded-full pointer-events-none transition-opacity duration-300" 
                 style="background: radial-gradient(circle, rgba(59,130,246,0.4) 0%, rgba(147,51,234,0.2) 40%, transparent 70%); 
                        transform: translate(-50%, -50%); 
                        filter: blur(40px);
                        opacity: 0;"></div>
            
            <!-- Floating Particles -->
            <div id="particles-container" class="absolute inset-0 pointer-events-none overflow-hidden"></div>
            
            <!-- Static Glowing Orbs -->
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-400/20 rounded-full blur-[128px] animate-pulse-slow"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-400/20 rounded-full blur-[128px] animate-pulse-slow delay-1000"></div>
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-blue-900/30 to-blue-900/50 pointer-events-none"></div>
            
            <!-- Seamless Wave Divider -->
            <div class="absolute bottom-0 left-0 w-full z-[3] pointer-events-none">
                <svg class="w-full h-auto" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <path d="M0,60 C360,120 720,0 1080,60 C1260,90 1380,80 1440,70 L1440,120 L0,120 Z" fill="rgba(249,250,251,0.3)"/>
                    <path d="M0,80 C240,40 480,100 720,80 C960,60 1200,100 1440,60 L1440,120 L0,120 Z" fill="rgba(249,250,251,0.5)"/>
                    <path d="M0,100 C180,80 360,110 540,95 C720,80 900,110 1080,95 C1260,80 1380,100 1440,90 L1440,120 L0,120 Z" fill="#ffffff"/>
                </svg>
            </div>
        </div>

        <!-- Hero Content -->
        <div class="container mx-auto px-6 py-20 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Portal Kerja Polindra Label -->
                <div class="inline-block mb-8 animate-fade-in-down">
                    <span class="text-sm font-semibold bg-white/15 backdrop-blur-md px-6 py-2 rounded-full border border-white/30 shadow-[0_0_15px_rgba(59,130,246,0.5)]">
                        Portal Karir Polindra
                    </span>
                </div>
                <!-- Main Heading -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight text-white drop-shadow-[0_2px_10px_rgba(0,0,0,0.3)] animate-fade-in-up">
                    Temukan Pekerjaan Impian<br>
                    Sesuai Dengan Skill dan<br>
                    Passion Anda
                </h1>
                <!-- Subheading -->
                <p class="text-lg md:text-xl text-blue-50 mb-10 animate-fade-in-up delay-100 drop-shadow-[0_2px_8px_rgba(0,0,0,0.2)]">
                    Temukan dan daftar pekerjaan dengan mudah
                </p>
                <!-- CTA Button -->
                <a href="{{ route('alumni.cari_lowongan') }}" class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-12 py-4 rounded-full font-bold text-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-[0_0_20px_rgba(59,130,246,0.5)] hover:shadow-[0_0_30px_rgba(59,130,246,0.7)] transform hover:-translate-y-1 animate-bounce-subtle">
                    Temukan Pekerjaan
                </a>
            </div>
        </div>
    </div>

    <style>
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.1); }
        }
        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounce-subtle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        @keyframes float-particle {
            0%, 100% { transform: translate(0, 0) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translate(100px, -100vh) rotate(360deg); opacity: 0; }
        }
        .animate-pulse-slow { animation: pulse-slow 6s ease-in-out infinite; }
        .animate-fade-in-down { animation: fade-in-down 0.8s ease-out forwards; }
        .animate-fade-in-up { animation: fade-in-up 0.8s ease-out forwards; }
        .animate-bounce-subtle { animation: bounce-subtle 3s infinite ease-in-out; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-1000 { animation-delay: 1s; }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('grid-canvas');
        const ctx = canvas.getContext('2d');
        const heroSection = document.getElementById('hero-section');
        const mouseGlow = document.getElementById('mouse-glow');
        const particlesContainer = document.getElementById('particles-container');
        
        let mouseX = -1000;
        let mouseY = -1000;
        let targetX = -1000;
        let targetY = -1000;
        let isMouseInHero = false;
        const gridSize = 60;
        const influenceRadius = 150;
        const maxDisplacement = 20;
        const waveAmplitude = 3;
        const waveSpeed = 0.002;
        let time = 0;
        
        // Set canvas size
        function resizeCanvas() {
            canvas.width = heroSection.offsetWidth;
            canvas.height = heroSection.offsetHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);
        
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
                animation:float-particle ${Math.random()*10+10}s linear infinite;
                animation-delay:${Math.random()*-20}s;
            `;
            particlesContainer.appendChild(p);
        }
        
        // Track mouse position
        heroSection.addEventListener('mousemove', (e) => {
            const rect = heroSection.getBoundingClientRect();
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
        
        heroSection.addEventListener('mouseleave', () => {
            isMouseInHero = false;
            mouseGlow.style.opacity = '0';
        });
        
        // Smooth mouse following
        function lerp(start, end, factor) {
            return start + (end - start) * factor;
        }
        
        // Calculate displacement based on mouse distance
        function getDisplacement(px, py, mx, my, t) {
            const dx = px - mx;
            const dy = py - my;
            const distance = Math.sqrt(dx * dx + dy * dy);
            
            // Wave effect
            const wave = Math.sin(px * 0.02 + t) * waveAmplitude + 
                        Math.cos(py * 0.02 + t * 0.7) * waveAmplitude;
            
            // Calculate edge dampening factor - completely disable near edges
            const edgeMargin = 150; // pixels from edge
            const leftEdgeFactor = Math.min(px / edgeMargin, 1);
            const rightEdgeFactor = Math.min((canvas.width - px) / edgeMargin, 1);
            const topEdgeFactor = Math.min(py / edgeMargin, 1);
            const bottomEdgeFactor = Math.min((canvas.height - py) / edgeMargin, 1);
            const edgeDampening = Math.min(leftEdgeFactor, rightEdgeFactor, topEdgeFactor, bottomEdgeFactor);
            
            // Only apply mouse effect if in center area
            if (distance > influenceRadius || !isMouseInHero) {
                return { x: wave * 0.5, y: wave * 0.5 };
            }
            
            const force = (1 - distance / influenceRadius) * maxDisplacement * edgeDampening;
            const angle = Math.atan2(dy, dx);
            
            return {
                x: Math.cos(angle) * force + wave,
                y: Math.sin(angle) * force + wave
            };
        }
        
        // Draw interactive grid
        function drawGrid() {
            time += waveSpeed;
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            // Smooth mouse movement
            mouseX = lerp(mouseX, targetX, 0.1);
            mouseY = lerp(mouseY, targetY, 0.1);
            
            // Create gradient for grid lines
            const gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
            gradient.addColorStop(0, 'rgba(147, 197, 253, 0.15)');
            gradient.addColorStop(0.5, 'rgba(196, 181, 253, 0.12)');
            gradient.addColorStop(1, 'rgba(147, 197, 253, 0.1)');
            
            ctx.strokeStyle = gradient;
            ctx.lineWidth = 1;
            
            // Draw vertical lines
            for (let x = 0; x <= canvas.width + gridSize; x += gridSize) {
                ctx.beginPath();
                for (let y = 0; y <= canvas.height; y += 5) {
                    const displacement = getDisplacement(x, y, mouseX, mouseY, time);
                    const newX = x + displacement.x;
                    const newY = y + displacement.y;
                    
                    if (y === 0) {
                        ctx.moveTo(newX, newY);
                    } else {
                        ctx.lineTo(newX, newY);
                    }
                }
                ctx.stroke();
            }
            
            // Draw horizontal lines
            for (let y = 0; y <= canvas.height + gridSize; y += gridSize) {
                ctx.beginPath();
                for (let x = 0; x <= canvas.width; x += 5) {
                    const displacement = getDisplacement(x, y, mouseX, mouseY, time);
                    const newX = x + displacement.x;
                    const newY = y + displacement.y;
                    
                    if (x === 0) {
                        ctx.moveTo(newX, newY);
                    } else {
                        ctx.lineTo(newX, newY);
                    }
                }
                ctx.stroke();
            }
            
            // Draw highlight points at intersections near mouse
            if (isMouseInHero) {
                for (let x = 0; x <= canvas.width + gridSize; x += gridSize) {
                    for (let y = 0; y <= canvas.height + gridSize; y += gridSize) {
                        const displacement = getDisplacement(x, y, mouseX, mouseY, time);
                        const distance = Math.sqrt(
                            Math.pow(x - mouseX, 2) + Math.pow(y - mouseY, 2)
                        );
                        
                        if (distance < influenceRadius) {
                            const opacity = (1 - distance / influenceRadius) * 0.8;
                            const size = (1 - distance / influenceRadius) * 4 + 1;
                            
                            // Calculate edge dampening for highlights too
                            const edgeMargin = 150;
                            const leftEdgeFactor = Math.min(x / edgeMargin, 1);
                            const rightEdgeFactor = Math.min((canvas.width - x) / edgeMargin, 1);
                            const topEdgeFactor = Math.min(y / edgeMargin, 1);
                            const bottomEdgeFactor = Math.min((canvas.height - y) / edgeMargin, 1);
                            const edgeDampening = Math.min(leftEdgeFactor, rightEdgeFactor, topEdgeFactor, bottomEdgeFactor);
                            
                            const finalOpacity = opacity * edgeDampening;
                            const finalSize = size * (0.5 + edgeDampening * 0.5);
                            
                            // Glow
                            ctx.beginPath();
                            ctx.arc(x + displacement.x, y + displacement.y, finalSize + 3, 0, Math.PI * 2);
                            ctx.fillStyle = `rgba(147, 197, 253, ${finalOpacity * 0.3})`;
                            ctx.fill();
                            
                            // Core
                            ctx.beginPath();
                            ctx.arc(
                                x + displacement.x,
                                y + displacement.y,
                                finalSize,
                                0,
                                Math.PI * 2
                            );
                            ctx.fillStyle = `rgba(255, 255, 255, ${finalOpacity})`;
                            ctx.fill();
                        }
                    }
                }
            }
            
            requestAnimationFrame(drawGrid);
        }
        
        drawGrid();
    });
    </script>

    <!-- Partner Logos & Steps & Footer -->
    <div class="bg-white py-6 border-y border-gray-200 overflow-hidden">
        <style>
            @keyframes scroll {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .animate-scroll { animation: scroll 30s linear infinite; }
            .logo-track:hover .animate-scroll { animation-play-state: paused; }
        </style>
        <div class="logo-track">
            <div class="flex animate-scroll">
                @for ($i = 0; $i < 10; $i++)
                <div class="flex items-center space-x-8 px-4">
                    @foreach ($mitra as $item)
                        <div class="flex items-center justify-center h-16 w-32 grayscale hover:grayscale-0 transition duration-300">
                            @if($item->logo)
                                <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->nama_perusahaan }}" class="max-h-full max-w-full object-contain rounded-lg">
                            @else
                                <span class="text-gray-400 font-bold">{{ $item->nama_perusahaan }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Steps Section -->
    <div class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-16">
                Langkah Mudah Daftar Kerja
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach(range(1, 5) as $step)
                <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all hover:-translate-y-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-900 to-purple-700 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        {{ $step }}
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">
                        @if($step === 1) Daftar Akun
                        @elseif($step === 2) Lengkapi Profil
                        @elseif($step === 3) Cari Lowongan
                        @elseif($step === 4) Kirim Lamaran
                        @elseif($step === 5) Diterima Kerja
                        @endif
                    </h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur. Vitae faucibus integer purus malesuada.
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection