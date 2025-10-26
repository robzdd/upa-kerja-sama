@extends('alumni.layouts.app')

@section('title', 'Preview CV')

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
                    <h3 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ auth()->user()->email }}</p>
                </div>
                <!-- Edit Profile Button -->
                <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all mb-4">
                    Ubah Profil
                </button>

                <!-- Divider -->
                <hr class="my-4">

                <!-- Menu Items -->
                <nav class="space-y-2">
                    <a href="{{ route('alumni.cv.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-blue-50 border-l-4 border-blue-600 text-blue-700 transition-colors">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="text-sm font-semibold">Curriculum Vitae</span>
                    </a>
                    <a href="{{ route('alumni.applications') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors text-gray-700">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <span class="text-sm font-medium">Status Lamaran</span>
                    </a>
                    <a href="{{ route('alumni.certificates') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors text-gray-700">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        <span class="text-sm font-medium">Sertifikat Magang</span>
                    </a>
                    <a href="{{ route('alumni.security.settings') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors text-gray-700">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span class="text-sm font-medium">Pengaturan Keamanan</span>
                    </a>

                    <form method="POST" action="{{ route('alumni.logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-red-50 transition-colors text-red-600 w-full text-left">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="text-sm font-medium">Keluar</span>
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Main Content Right -->
        <div class="lg:col-span-2">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Preview CV</h1>
                        <p class="text-gray-600">Pratinjau CV Anda sebelum dipublikasikan</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('alumni.cv.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 text-sm">
                            Kembali
                        </a>
                        <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                            Print
                        </button>
                    </div>
                </div>
            </div>

            <!-- CV Preview -->
            <div class="bg-white rounded-lg shadow-lg p-8 print:shadow-none">
                <!-- CV Header -->
                <div class="text-center mb-8 border-b border-gray-200 pb-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $alumni->nama_lengkap ?? auth()->user()->name }}</h1>
                    <p class="text-lg text-gray-600 mb-2">{{ auth()->user()->email }}</p>
                    <p class="text-gray-500">{{ $alumni->no_hp ?? '-' }} | {{ $alumni->alamat ?? '-' }}</p>
                </div>

                <!-- Personal Information -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Informasi Pribadi</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="font-medium text-gray-700">Nama Lengkap:</span>
                            <span class="text-gray-900">{{ $alumni->nama_lengkap ?? auth()->user()->name }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Email:</span>
                            <span class="text-gray-900">{{ auth()->user()->email }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">No Handphone:</span>
                            <span class="text-gray-900">{{ $alumni->no_hp ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Alamat:</span>
                            <span class="text-gray-900">{{ $alumni->alamat ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Education -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Pendidikan</h2>
                    <div class="space-y-4">
                        <div class="border-l-4 border-blue-500 pl-4">
                            <h3 class="font-semibold text-gray-900">Universitas ABC</h3>
                            <p class="text-gray-600">Teknik Informatika - S1</p>
                            <p class="text-sm text-gray-500">2020 - 2024</p>
                        </div>
                    </div>
                </div>

                <!-- Experience -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Pengalaman Kerja</h2>
                    <div class="space-y-4">
                        <div class="border-l-4 border-green-500 pl-4">
                            <h3 class="font-semibold text-gray-900">Software Developer Intern</h3>
                            <p class="text-gray-600">PT Teknologi Maju</p>
                            <p class="text-sm text-gray-500">Jan 2024 - Mar 2024</p>
                            <p class="text-gray-700 mt-2">Mengembangkan aplikasi web menggunakan Laravel dan React</p>
                        </div>
                    </div>
                </div>

                <!-- Skills -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Keahlian</h2>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Laravel</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">PHP</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">JavaScript</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">React</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">MySQL</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .print\\:shadow-none {
        box-shadow: none !important;
    }
}
</style>
@endsection
