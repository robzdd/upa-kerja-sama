@extends('alumni.layouts.app')

@section('title', 'Beranda - Portal Kerja POLINDRA')

@section('content')
    <!-- Header Section with Animated Grid Background -->
    <div class="relative bg-slate-900 text-white pb-32 overflow-hidden">
        <!-- Animated Grid Background -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <!-- Moving Grid -->
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#4f4f4f2e_1px,transparent_2px),linear-gradient(to_bottom,#4f4f4f2e_1px,transparent_2px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_0%,#000_70%,transparent_100%)] animate-grid-move"></div>
            
            <!-- Glowing Orbs -->
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/20 rounded-full blur-[128px] animate-pulse-slow"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-600/20 rounded-full blur-[128px] animate-pulse-slow delay-1000"></div>
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-slate-900/50 to-slate-900"></div>
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

        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-blue-600/20 blur-[100px]"></div>
            <div class="absolute top-[20%] -right-[10%] w-[40%] h-[40%] rounded-full bg-purple-600/20 blur-[100px]"></div>
        </div>
    </div>

    <style>
        @keyframes grid-move {
            0% { transform: translateY(0); }
            100% { transform: translateY(4rem); }
        }
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
        .animate-grid-move { animation: grid-move 3s linear infinite; }
        .animate-pulse-slow { animation: pulse-slow 6s ease-in-out infinite; }
        .animate-fade-in-down { animation: fade-in-down 0.8s ease-out forwards; }
        .animate-fade-in-up { animation: fade-in-up 0.8s ease-out forwards; }
        .animate-bounce-subtle { animation: bounce-subtle 3s infinite ease-in-out; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-1000 { animation-delay: 1s; }
    </style>
    <!-- Partner Logos & Steps & Footer, dst... -->
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
                <!-- partner logo markup etc, not changed here ... -->
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
            <!-- Steps grid, markup etc... -->
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
                        Lorem ipsum dolor sit amet consectetur. Vitae faucibus integer purus malesuada. Praesent ullamcorper in quis cursus tempus. Sagittis et venenatis ut lectus ornare eget sed.
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
