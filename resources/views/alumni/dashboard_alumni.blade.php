@extends('alumni.layouts.app')

@section('title', 'Beranda - Portal Kerja POLINDRA')

@section('content')
    <!-- Header Section with Gradient Background -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900 text-white pb-32">
        <!-- Hero Content -->
        <div class="container mx-auto px-6 py-20 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Portal Kerja Polindra Label -->
                <div class="inline-block mb-8">
                    <span class="text-sm font-semibold bg-white/20 backdrop-blur-sm px-6 py-2 rounded-full border border-white/30">
                        Portal Karir Polindra
                    </span>
                </div>
                <!-- Main Heading -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    Temukan Pekerjaan Impian<br>
                    Sesuai Dengan Skill dan<br>
                    Passion Anda
                </h1>
                <!-- Subheading -->
                <p class="text-lg md:text-xl text-white/90 mb-10">
                    Temukan dan daftar pekerjaan dengan mudah
                </p>
                <!-- CTA Button -->
                <a href="#" class="inline-block bg-white text-blue-900 px-12 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                    Temukan Pekerjaan
                </a>
            </div>
        </div>
    </div>
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
