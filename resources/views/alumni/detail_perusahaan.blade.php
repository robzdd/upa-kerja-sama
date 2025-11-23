@extends('alumni.layouts.app')

@section('title', $company->nama_perusahaan . ' - Portal Kerja POLINDRA')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900 text-white pt-12 pb-32">
        <div class="container mx-auto px-6">
            <!-- Breadcrumb -->
            <nav class="flex mb-8 text-sm text-blue-200" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('alumni.beranda') }}" class="inline-flex items-center hover:text-white transition">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('alumni.list_perusahaan') }}" class="ml-1 hover:text-white transition md:ml-2">List Perusahaan</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-white md:ml-2 font-medium">{{ $company->nama_perusahaan }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                <!-- Logo -->
                <div class="w-32 h-32 bg-white rounded-2xl shadow-xl flex items-center justify-center overflow-hidden flex-shrink-0">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->nama_perusahaan }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-4xl font-bold text-gray-400">{{ substr($company->nama_perusahaan, 0, 2) }}</span>
                    @endif
                </div>
                
                <!-- Info -->
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-2">
                        <h1 class="text-3xl md:text-4xl font-bold">{{ $company->nama_perusahaan }}</h1>
                        @if($company->sektor)
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm border border-white/30">
                                {{ $company->sektor }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-6 text-blue-100 mt-4">
                        @if($company->tautan)
                            <a href="{{ $company->tautan }}" target="_blank" class="flex items-center hover:text-white transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                </svg>
                                {{ parse_url($company->tautan, PHP_URL_HOST) ?? $company->tautan }}
                            </a>
                        @endif
                        
                        @if($company->kontak)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ $company->kontak }}
                            </div>
                        @endif

                        @if($company->mulai_kerjasama)
                            <div class="flex items-center" title="Periode Kerjasama">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ \Carbon\Carbon::parse($company->mulai_kerjasama)->format('Y') }} - 
                                {{ $company->akhir_kerjasama ? \Carbon\Carbon::parse($company->akhir_kerjasama)->format('Y') : 'Sekarang' }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-6 -mt-20 relative z-10 pb-20">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Lowongan Tersedia</h2>
                <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full font-semibold text-sm">
                    {{ $company->lowongan->count() }} Lowongan Aktif
                </span>
            </div>

            @if($company->lowongan->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($company->lowongan as $job)
                        <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition group bg-white">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition mb-2">{{ $job->judul }}</h3>
                                    <div class="flex flex-wrap gap-2 text-sm text-gray-600">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            {{ $job->lokasi }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $job->jenis_pekerjaan }}
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('alumni.lowongan.apply', $job->id) }}" class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-sm font-semibold whitespace-nowrap">
                                    Lihat Detail
                                </a>
                            </div>
                            
                            <div class="flex flex-wrap gap-2 mt-4">
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">{{ $job->jenjang_pendidikan }}</span>
                                @if($job->pengalaman_minimal)
                                    <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs">{{ $job->pengalaman_minimal }}</span>
                                @endif
                                <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-full text-xs">
                                    {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Belum ada lowongan aktif</h3>
                    <p class="text-gray-600">Perusahaan ini belum membuka lowongan pekerjaan saat ini.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
