@extends('alumni.layouts.app')

@section('title', 'Detail Lamaran - ' . $application->lowongan->judul)

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Back Button -->
    <a href="{{ route('alumni.applications') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 mb-6 transition">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Aplikasi Saya
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content (Left) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Job Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-start mb-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                            @if($application->lowongan->mitra->logo)
                                <img src="{{ asset('storage/' . $application->lowongan->mitra->logo) }}" alt="Logo" class="w-full h-full object-cover rounded-lg">
                            @else
                                <span class="text-2xl font-bold text-gray-400">{{ substr($application->lowongan->mitra->nama_perusahaan, 0, 2) }}</span>
                            @endif
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">{{ $application->lowongan->judul }}</h1>
                            <p class="text-gray-600 font-medium">{{ $application->lowongan->mitra->nama_perusahaan }}</p>
                            <div class="flex items-center space-x-2 mt-2 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $application->lowongan->lokasi ?? 'Lokasi tidak tersedia' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'interview' => 'bg-blue-100 text-blue-800 border-blue-200',
                            'diterima' => 'bg-green-100 text-green-800 border-green-200',
                            'ditolak' => 'bg-red-100 text-red-800 border-red-200',
                        ];
                        $statusLabel = ucfirst($application->status);
                        $colorClass = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                    @endphp
                    <span class="px-4 py-2 rounded-full text-sm font-semibold border {{ $colorClass }}">
                        {{ $statusLabel }}
                    </span>
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h3 class="font-semibold text-gray-800 mb-3">Pesan Lamaran Anda</h3>
                    <div class="bg-gray-50 rounded-lg p-4 text-gray-700 leading-relaxed text-sm">
                        {{ $application->pesan_lamaran }}
                    </div>
                </div>
            </div>

            <!-- Application Timeline (Optional - visual enhancement) -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-800 mb-6">Status Perjalanan Lamaran</h3>
                <div class="relative">
                    <!-- Vertical line -->
                    <div class="absolute left-4 top-0 h-full w-0.5 bg-gray-200"></div>

                    <!-- Step 1: Applied -->
                    <div class="relative flex items-start mb-8 ml-4 pl-8">
                        <div class="absolute -left-2 bg-blue-500 rounded-full w-4 h-4 mt-1.5 border-4 border-white shadow-sm"></div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Lamaran Terkirim</h4>
                            <p class="text-xs text-gray-500 mb-1">{{ $application->created_at->format('d F Y, H:i') }}</p>
                            <p class="text-sm text-gray-600">Lamaran Anda telah berhasil dikirim ke perusahaan.</p>
                        </div>
                    </div>

                    <!-- Step 2: Current Status -->
                    @if($application->status != 'pending')
                    <div class="relative flex items-start ml-4 pl-8">
                        <div class="absolute -left-2 {{ $application->status == 'ditolak' ? 'bg-red-500' : ($application->status == 'diterima' ? 'bg-green-500' : 'bg-blue-500') }} rounded-full w-4 h-4 mt-1.5 border-4 border-white shadow-sm"></div>
                        <div>
                            <h4 class="font-semibold text-gray-800">
                                @if($application->status == 'interview') Tahap Interview
                                @elseif($application->status == 'diterima') Diterima
                                @elseif($application->status == 'ditolak') Ditolak
                                @endif
                            </h4>
                            <p class="text-xs text-gray-500 mb-1">{{ $application->updated_at->format('d F Y, H:i') }}</p>
                            <p class="text-sm text-gray-600">
                                @if($application->status == 'interview') Perusahaan mengundang Anda untuk interview. Cek email atau notifikasi untuk detailnya.
                                @elseif($application->status == 'diterima') Selamat! Anda diterima bekerja.
                                @elseif($application->status == 'ditolak') Mohon maaf, Anda belum lolos untuk tahap selanjutnya.
                                @endif
                            </p>
                        </div>
                    </div>
                    @else
                    <!-- Pending Placeholder -->
                    <div class="relative flex items-start ml-4 pl-8 opacity-50">
                        <div class="absolute -left-2 bg-gray-300 rounded-full w-4 h-4 mt-1.5 border-4 border-white"></div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Menunggu Review</h4>
                            <p class="text-sm text-gray-600">Perusahaan sedang mereview lamaran Anda.</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar (Right) -->
        <div class="space-y-6">
            <!-- Action Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Aksi</h3>
                @if($application->status == 'pending')
                    <form action="{{ route('alumni.applications.cancel', $application->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan lamaran ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-50 text-red-600 font-semibold py-3 rounded-lg hover:bg-red-100 transition border border-red-200">
                            Batalkan Lamaran
                        </button>
                    </form>
                    <p class="text-xs text-gray-500 mt-3 text-center">Anda hanya dapat membatalkan lamaran yang masih berstatus Pending.</p>
                @else
                    <button disabled class="w-full bg-gray-100 text-gray-400 font-semibold py-3 rounded-lg cursor-not-allowed border border-gray-200">
                        Batalkan Lamaran
                    </button>
                    <p class="text-xs text-gray-400 mt-3 text-center">Lamaran yang sudah diproses tidak dapat dibatalkan.</p>
                @endif
            </div>

            <!-- Job Details Link -->
            <div class="bg-blue-50 rounded-xl border border-blue-100 p-6">
                <h3 class="font-semibold text-blue-900 mb-2">Detail Lowongan</h3>
                <p class="text-sm text-blue-700 mb-4">Lihat kembali detail lengkap lowongan yang Anda lamar.</p>
                <a href="{{ route('alumni.lowongan.details', $application->lowongan->id) }}" class="block w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition text-center shadow-md">
                    Lihat Lowongan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
