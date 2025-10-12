@extends('mitra.layouts.app')

@section('title', 'Dashboard - Mitra Perusahaan')

@section('content')
<!-- Dashboard Content -->
<div class="min-h-screen bg-gray-50">
    <!-- Welcome Section -->
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-2">Selamat datang kembali!</h2>
        <p class="text-lg text-gray-600">Kelola lowongan dan pantau pelamar dengan mudah</p>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Lowongan Aktif</p>
                    <p class="text-3xl font-bold text-blue-600">12</p>
                    <p class="text-xs text-gray-500 mt-1">↑ 2 minggu terakhir</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Pelamar Baru</p>
                    <p class="text-3xl font-bold text-green-600">28</p>
                    <p class="text-xs text-gray-500 mt-1">↑ 5 hari terakhir</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Dalam Review</p>
                    <p class="text-3xl font-bold text-yellow-600">15</p>
                    <p class="text-xs text-gray-500 mt-1">Status proses</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Total Hire</p>
                    <p class="text-3xl font-bold text-purple-600">8</p>
                    <p class="text-xs text-gray-500 mt-1">Bulan ini</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Applications -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Lamaran Terbaru</h3>
                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat semua</a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-semibold text-sm">AJ</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Ahmad Junaedi</p>
                        <p class="text-sm text-gray-600">Software Developer</p>
                    </div>
                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Review</span>
                </div>
                <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <span class="text-green-600 font-semibold text-sm">SM</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Sarah Maharani</p>
                        <p class="text-sm text-gray-600">UI/UX Designer</p>
                    </div>
                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Diterima</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Aksi Cepat</h3>
            <div class="space-y-4">
                <a href="#" class="flex items-center space-x-4 p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Buat Lowongan Baru</p>
                        <p class="text-sm text-gray-600">Posting lowongan kerja terbaru</p>
                    </div>
                </a>
                <a href="#" class="flex items-center space-x-4 p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Kelola Pelamar</p>
                        <p class="text-sm text-gray-600">Review dan kelola kandidat</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>


@endsection
