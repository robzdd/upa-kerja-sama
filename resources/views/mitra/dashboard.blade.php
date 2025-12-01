@extends('mitra.layouts.app')

@section('title', 'Dashboard - Mitra Perusahaan')

@section('content')
<!-- Dashboard Content -->
<div class="min-h-screen bg-slate-50">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-800">Selamat Datang, {{ auth()->guard('mitra')->user()->mitraPerusahaan->nama_perusahaan ?? auth()->guard('mitra')->user()->name }}! 👋</h2>
        <p class="text-slate-500 mt-2">Berikut adalah ringkasan aktivitas rekrutmen Anda hari ini.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Lowongan Aktif -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute right-0 top-0 h-full w-1 bg-blue-500"></div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Lowongan Aktif</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $stats['lowongan_aktif'] }}</h3>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg group-hover:bg-blue-100 transition-colors">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-slate-400">
                <a href="{{ route('mitra.lowongan.index') }}" class="hover:text-blue-600 transition-colors flex items-center">
                    Lihat detail <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>

        <!-- Total Pelamar -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute right-0 top-0 h-full w-1 bg-indigo-500"></div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Pelamar</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $stats['total_pelamar'] }}</h3>
                </div>
                <div class="p-3 bg-indigo-50 rounded-lg group-hover:bg-indigo-100 transition-colors">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-slate-400">
                <span class="text-indigo-500 font-medium mr-1">Semua lowongan</span>
            </div>
        </div>

        <!-- Pelamar Baru (Pending) -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute right-0 top-0 h-full w-1 bg-yellow-500"></div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Perlu Review</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $stats['pelamar_baru'] }}</h3>
                </div>
                <div class="p-3 bg-yellow-50 rounded-lg group-hover:bg-yellow-100 transition-colors">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-slate-400">
                <a href="{{ route('mitra.pelamar.index') }}" class="text-yellow-600 hover:text-yellow-700 font-medium transition-colors flex items-center">
                    Review sekarang <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            </div>
        </div>

        <!-- Diterima -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute right-0 top-0 h-full w-1 bg-green-500"></div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Diterima Kerja</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $stats['pelamar_diterima'] }}</h3>
                </div>
                <div class="p-3 bg-green-50 rounded-lg group-hover:bg-green-100 transition-colors">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-slate-400">
                <span class="text-green-500 font-medium">Total kandidat lolos</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Applicants Table -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="text-lg font-bold text-slate-800">Pelamar Terbaru</h3>
                <a href="{{ route('mitra.pelamar.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">Kandidat</th>
                            <th class="px-6 py-4 font-semibold">Posisi</th>
                            <th class="px-6 py-4 font-semibold">Tanggal</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentPelamars as $pelamar)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-xs">
                                        {{ substr($pelamar->user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-800">{{ $pelamar->user->name }}</p>
                                        <p class="text-xs text-slate-500">{{ $pelamar->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-slate-700">{{ $pelamar->lowongan->judul }}</p>
                                <p class="text-xs text-slate-500">{{ $pelamar->lowongan->posisi }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-600">{{ $pelamar->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($pelamar->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @elseif($pelamar->status == 'diterima')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Diterima
                                    </span>
                                @elseif($pelamar->status == 'ditolak')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('mitra.pelamar.show', $pelamar->id) }}" class="text-slate-400 hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                Belum ada pelamar terbaru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions & Info -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('mitra.lowongan.create') }}" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors group">
                        <div class="w-10 h-10 bg-blue-500 text-white rounded-lg flex items-center justify-center mr-4 shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Buat Lowongan</p>
                            <p class="text-xs text-slate-500">Posting pekerjaan baru</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('mitra.profile.index') }}" class="flex items-center p-3 bg-slate-50 hover:bg-slate-100 rounded-lg transition-colors group">
                        <div class="w-10 h-10 bg-slate-700 text-white rounded-lg flex items-center justify-center mr-4 shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Edit Profil</p>
                            <p class="text-xs text-slate-500">Update info perusahaan</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="bg-gradient-to-br from-indigo-600 to-blue-700 rounded-xl shadow-lg p-6 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full blur-xl"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-white opacity-10 rounded-full blur-xl"></div>
                
                <h3 class="text-lg font-bold mb-2 relative z-10">Tips Rekrutmen</h3>
                <p class="text-blue-100 text-sm mb-4 relative z-10">Lengkapi profil perusahaan Anda dengan detail untuk menarik lebih banyak kandidat berkualitas.</p>
                <a href="{{ route('mitra.profile.index') }}" class="inline-block bg-white text-blue-600 text-xs font-bold px-4 py-2 rounded-lg hover:bg-blue-50 transition-colors relative z-10">
                    Lengkapi Profil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
