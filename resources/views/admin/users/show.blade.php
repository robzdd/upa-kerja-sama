@extends('admin.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto animate-fade-in">
    <!-- Breadcrumb -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 transition">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('admin.users.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Manajemen User</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail User</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-6 text-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <div class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-4xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $user->name }}</h1>
                    <p class="text-blue-100 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        {{ $user->email }}
                    </p>
                    <div class="mt-3">
                        @if($user->alumni)
                            <span class="px-4 py-1.5 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                                👨‍🎓 Alumni
                            </span>
                        @elseif($user->mitraPerusahaan)
                            <span class="px-4 py-1.5 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                                🏢 Mitra Perusahaan
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex flex-col space-y-3">
                <a href="{{ route('admin.users.edit', $user->id) }}"
                   class="px-6 py-3 bg-white text-blue-600 rounded-xl font-medium hover:bg-blue-50 transition-all duration-200 transform hover:scale-105 shadow-lg text-center">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit User
                </a>
                <a href="{{ route('admin.users.index') }}"
                   class="px-6 py-3 bg-white/10 backdrop-blur-sm text-white rounded-xl font-medium hover:bg-white/20 transition-all duration-200 text-center">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Basic Information -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </span>
                Informasi Dasar
            </h3>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="w-32 text-sm font-medium text-gray-600">Nama Lengkap</div>
                    <div class="flex-1 text-sm text-gray-900 font-semibold">{{ $user->name }}</div>
                </div>
                <div class="flex items-start">
                    <div class="w-32 text-sm font-medium text-gray-600">Email</div>
                    <div class="flex-1 text-sm text-gray-900">{{ $user->email }}</div>
                </div>
                <div class="flex items-start">
                    <div class="w-32 text-sm font-medium text-gray-600">Tanggal Daftar</div>
                    <div class="flex-1 text-sm text-gray-900">{{ $user->created_at->format('d M Y, H:i') }} WIB</div>
                </div>
                <div class="flex items-start">
                    <div class="w-32 text-sm font-medium text-gray-600">Terakhir Update</div>
                    <div class="flex-1 text-sm text-gray-900">{{ $user->updated_at->format('d M Y, H:i') }} WIB</div>
                </div>
            </div>
        </div>

        <!-- Profile Specific Information -->
        @if($user->alumni)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <span class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        </svg>
                    </span>
                    Informasi Alumni
                </h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="w-32 text-sm font-medium text-gray-600">NIM</div>
                        <div class="flex-1 text-sm text-gray-900 font-semibold">{{ $user->alumni->nim ?? '-' }}</div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-32 text-sm font-medium text-gray-600">No. HP</div>
                        <div class="flex-1 text-sm text-gray-900">{{ $user->alumni->no_hp ?? '-' }}</div>
                    </div>
                </div>
            </div>
        @elseif($user->mitraPerusahaan)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <span class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </span>
                    Informasi Mitra
                </h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="w-32 text-sm font-medium text-gray-600">Nama Perusahaan</div>
                        <div class="flex-1 text-sm text-gray-900 font-semibold">{{ $user->mitraPerusahaan->nama_perusahaan ?? '-' }}</div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-32 text-sm font-medium text-gray-600">Sektor</div>
                        <div class="flex-1 text-sm text-gray-900">{{ $user->mitraPerusahaan->sektor ?? '-' }}</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out;
    }
</style>
@endsection
