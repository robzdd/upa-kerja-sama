@extends('alumni.layouts.app')

@section('title', $lowongan->judul . ' - ' . $lowongan->mitra->nama_perusahaan)

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ url()->previous() == url()->current() ? route('alumni.cari_lowongan') : url()->previous() }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Company Logo & Type -->
            <div class="flex justify-between items-start mb-6">
                <div class="w-20 h-20 bg-white border rounded-lg flex items-center justify-center p-2">
                    @if($lowongan->mitra->logo)
                        <img src="{{ asset('storage/' . $lowongan->mitra->logo) }}" alt="{{ $lowongan->mitra->nama_perusahaan }}" class="w-full h-full object-contain">
                    @else
                        <span class="text-2xl font-bold text-gray-400">{{ substr($lowongan->mitra->nama_perusahaan, 0, 2) }}</span>
                    @endif
                </div>
                <span class="bg-blue-100 text-blue-800 px-4 py-1.5 rounded-full text-sm font-semibold">
                    {{ $lowongan->jenis_pekerjaan }}
                </span>
            </div>

            <!-- Job Title & Company -->
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $lowongan->judul }}</h1>
            <p class="text-xl text-gray-600 mb-6">{{ $lowongan->mitra->nama_perusahaan }}</p>

            <!-- Tags -->
            <div class="flex flex-wrap gap-3 mb-8">
                <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm flex items-center">
                    <i class="fas fa-map-marker-alt mr-2 text-gray-500"></i> {{ $lowongan->lokasi }}
                </span>
                <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm flex items-center">
                    <i class="fas fa-money-bill-wave mr-2 text-gray-500"></i> Rp {{ number_format($lowongan->gaji, 0, ',', '.') }}
                </span>
                <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm flex items-center">
                    <i class="fas fa-graduation-cap mr-2 text-gray-500"></i> {{ $lowongan->jenjang_pendidikan }}
                </span>
            </div>

            <!-- Apply Button -->
            @auth
                <a href="{{ route('alumni.lowongan.apply', $lowongan->id) }}" class="block w-full bg-blue-600 text-white py-4 rounded-xl hover:bg-blue-700 transition font-bold text-lg text-center mb-8 shadow-lg shadow-blue-200">
                    Lamar Sekarang
                </a>
            @endauth

            <!-- Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Requirements -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-list-check mr-2 text-blue-600"></i> Persyaratan
                    </h3>
                    <ul class="space-y-3 text-gray-600">
                        @if($lowongan->pengalaman_minimal)
                            <li class="flex items-start">
                                <span class="mr-2">•</span> Pengalaman: {{ $lowongan->pengalaman_minimal }}
                            </li>
                        @endif
                        @if($lowongan->prodi_diizinkan)
                            <li class="flex items-start">
                                <span class="mr-2">•</span> Prodi: {{ implode(', ', $lowongan->prodi_diizinkan) }}
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Documents -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-file-alt mr-2 text-blue-600"></i> Dokumen Diperlukan
                    </h3>
                    <ul class="space-y-3 text-gray-600">
                        @foreach($lowongan->persyaratan_dokumen ?? [] as $doc)
                            <li class="flex items-start">
                                <span class="mr-2">•</span> {{ $doc }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Description -->
            <div class="border-t pt-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Deskripsi Pekerjaan</h3>
                <div class="prose max-w-none text-gray-600 leading-relaxed">
                    {!! nl2br(e($lowongan->rincian_lowongan)) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
