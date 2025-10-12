@extends('alumni.layouts.app')

@section('title', 'Profil Alumni')

@section('content')
<div class="max-w-7xl mx-auto mt-8 mb-12 px-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar Left -->
        <div class="lg:col-span-1">
            <!-- Profile Card -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <!-- Profile Avatar -->
                <div class="text-center mb-6">
                    <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ $user->email }}</p>
                </div>
                <!-- Edit Profile Button -->
                <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all mb-4">
                    Ubah Profil
                </button>

                <!-- Divider -->
                <hr class="my-4">

                <!-- Menu Items -->
                <nav class="space-y-2">
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors text-gray-700">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="text-sm font-medium">Curriculum Vitae</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors text-gray-700">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium">Status Lamaran</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors text-gray-700">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium">Sertifikat Magang</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors text-gray-700">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium">Pengaturan Keamanan</span>
                    </a>

                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors text-red-600">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="text-sm font-medium">Keluar</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content Right -->
        <div class="lg:col-span-2">
            <!-- Curriculum Vitae Section -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Curriculum Vitae</h2>
                        <p class="text-sm text-gray-600">Menampilkan riwayat pribadi informasi profil dan pencapaian dalam memberikan dan menunjukkan tentang diri Anda.</p>
                    </div>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Detil</a>
                </div>

                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-700">Progress CV</span>
                        <span class="text-sm font-semibold text-gray-800">88%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-cyan-400 to-blue-600 h-2 rounded-full" style="width: 88%"></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 flex-wrap">
                    <a href="#" class="px-4 py-2 bg-cyan-400 text-white font-medium rounded-lg hover:bg-cyan-500 transition-colors text-sm">
                        Unduhan CV
                    </a>
                    <a href="#" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors text-sm">
                        Lihat CV
                    </a>
                </div>

                <!-- Edit CV Link -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <a href="#" class="text-sm text-gray-700 hover:text-gray-900">
                        <span class="text-gray-500">📝</span> Edit URI Unik Anda
                    </a>
                </div>
            </div>


            <!-- Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <div class="flex space-x-6">
                    <button class="pb-3 px-1 border-b-2 border-blue-600 text-blue-600 font-semibold text-sm">
                        Data Pribadi
                    </button>
                    <button class="pb-3 px-1 text-gray-600 hover:text-gray-800 font-medium text-sm">
                        Data Akademik
                    </button>
                    <button class="pb-3 px-1 text-gray-600 hover:text-gray-800 font-medium text-sm">
                        Data Keluarga
                    </button>
                    <button class="pb-3 px-1 text-gray-600 hover:text-gray-800 font-medium text-sm">
                        Dokumen
                    </button>
                </div>
            </div>

            <!-- Data Pribadi Content -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Data Pribadi</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Tentang Saya</label>
                            <p class="text-gray-800 mt-1">Halo Saya Programmer</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Nama Lengkap</label>
                            <p class="text-gray-800 mt-1">{{ $user->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">NIK</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->nim ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Jenis Kelamin</label>
                            <p class="text-gray-800 mt-1">Laki-laki</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Email</label>
                            <p class="text-gray-800 mt-1">{{ $user->email }}</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Nama Bank</label>
                            <p class="text-gray-800 mt-1">{{ $user->alumni->nama_bank }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">No Rekening</label>
                            <p class="text-gray-800 mt-1">{{ $user->alumni->no_rekening }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Alamat Tempat Tinggal</label>
                            <p class="text-gray-800 mt-1">{{ $user->alumni->alamat }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Tempat Lahir</label>
                            <p class="text-gray-800 mt-1">{{ $user->alumni->tempat_lahir }}, {{ $user->alumni->tanggal_lahir }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">No Handphone</label>
                            <p class="text-gray-800 mt-1">{{ $user->alumni->no_hp }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
