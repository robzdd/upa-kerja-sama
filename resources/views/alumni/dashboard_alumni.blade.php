@extends('alumni.layouts.app')

@section('title', 'Beranda - Portal Kerja POLINDRA')

@section('content')
    <!-- Header Section with Interactive Grid Background -->
    <div class="relative bg-slate-900 text-white pb-32 overflow-hidden" id="hero-section">
        <!-- Interactive Grid Background -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <!-- Canvas for Interactive Grid -->
            <canvas id="grid-canvas" class="absolute inset-0 w-full h-full"></canvas>
            
            <!-- Glowing Orbs that follow mouse -->
            <div id="mouse-glow" class="absolute w-96 h-96 bg-blue-500/30 rounded-full blur-[128px] pointer-events-none transition-all duration-300 ease-out" style="transform: translate(-50%, -50%);"></div>
            
            <!-- Static Glowing Orbs -->
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/20 rounded-full blur-[128px] animate-pulse-slow"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-600/20 rounded-full blur-[128px] animate-pulse-slow delay-1000"></div>
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-slate-900/50 to-slate-900 pointer-events-none"></div>
        </div>

        <!-- Hero Content -->
        <div class="container mx-auto px-6 py-20 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Portal Kerja Polindra Label -->
                <div class="inline-block mb-8 animate-fade-in-down">
                    <span class="text-sm font-semibold bg-white/10 backdrop-blur-md px-6 py-2 rounded-full border border-white/20 shadow-[0_0_15px_rgba(59,130,246,0.5)]">
                        Portal Karir Polindra
                    </span>
                </div>
                <!-- Main Heading -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight bg-clip-text text-transparent bg-gradient-to-r from-blue-200 via-white to-purple-200 animate-fade-in-up">
                    Temukan Pekerjaan Impian<br>
                    Sesuai Dengan Skill dan<br>
                    Passion Anda
                </h1>
                <!-- Subheading -->
                <p class="text-lg md:text-xl text-gray-300 mb-10 animate-fade-in-up delay-100">
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
        
        let mouseX = 0;
        let mouseY = 0;
        let targetX = 0;
        let targetY = 0;
        const gridSize = 60;
        const influenceRadius = 150;
        const maxDisplacement = 20;
        
        // Set canvas size
        function resizeCanvas() {
            canvas.width = heroSection.offsetWidth;
            canvas.height = heroSection.offsetHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);
        
        // Track mouse position
        heroSection.addEventListener('mousemove', (e) => {
            const rect = heroSection.getBoundingClientRect();
            targetX = e.clientX - rect.left;
            targetY = e.clientY - rect.top;
            
            // Move the glow effect
            mouseGlow.style.left = targetX + 'px';
            mouseGlow.style.top = targetY + 'px';
        });
        
        // Smooth mouse following
        function lerp(start, end, factor) {
            return start + (end - start) * factor;
        }
        
        // Calculate displacement based on mouse distance
        function getDisplacement(px, py, mx, my) {
            const dx = px - mx;
            const dy = py - my;
            const distance = Math.sqrt(dx * dx + dy * dy);
            
            if (distance > influenceRadius) return { x: 0, y: 0 };
            
            const force = (1 - distance / influenceRadius) * maxDisplacement;
            const angle = Math.atan2(dy, dx);
            
            return {
                x: Math.cos(angle) * force,
                y: Math.sin(angle) * force
            };
        }
        
        // Draw interactive grid
        function drawGrid() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            // Smooth mouse movement
            mouseX = lerp(mouseX, targetX, 0.1);
            mouseY = lerp(mouseY, targetY, 0.1);
            
            // Create gradient mask
            const gradient = ctx.createRadialGradient(
                canvas.width / 2, 0, 0,
                canvas.width / 2, 0, canvas.height * 0.8
            );
            gradient.addColorStop(0, 'rgba(79, 79, 79, 0.25)');
            gradient.addColorStop(0.7, 'rgba(79, 79, 79, 0.15)');
            gradient.addColorStop(1, 'rgba(79, 79, 79, 0)');
            
            ctx.strokeStyle = gradient;
            ctx.lineWidth = 1;
            
            // Draw vertical lines
            for (let x = 0; x <= canvas.width + gridSize; x += gridSize) {
                ctx.beginPath();
                for (let y = 0; y <= canvas.height; y += 5) {
                    const displacement = getDisplacement(x, y, mouseX, mouseY);
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
                    const displacement = getDisplacement(x, y, mouseX, mouseY);
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
            for (let x = 0; x <= canvas.width + gridSize; x += gridSize) {
                for (let y = 0; y <= canvas.height + gridSize; y += gridSize) {
                    const displacement = getDisplacement(x, y, mouseX, mouseY);
                    const distance = Math.sqrt(
                        Math.pow(x - mouseX, 2) + Math.pow(y - mouseY, 2)
                    );
                    
                    if (distance < influenceRadius) {
                        const opacity = (1 - distance / influenceRadius) * 0.8;
                        const size = (1 - distance / influenceRadius) * 4 + 1;
                        
                        ctx.beginPath();
                        ctx.arc(
                            x + displacement.x,
                            y + displacement.y,
                            size,
                            0,
                            Math.PI * 2
                        );
                        ctx.fillStyle = `rgba(59, 130, 246, ${opacity})`;
                        ctx.fill();
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
                @for ($i = 0; $i < 2; $i++)
                <div class="flex items-center space-x-16 px-8">
                    @for ($j = 0; $j < 5; $j++)
                        <div class="flex items-center space-x-3 text-gray-600 flex-shrink-0">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/>
                            </svg>
                            <span class="font-bold text-xl whitespace-nowrap">PERTAMINA</span>
                        </div>
                    @endfor
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