@extends('alumni.layouts.app')

@section('title', 'List Perusahaan - Portal Kerja POLINDRA')

@section('content')
    <!-- Hero Section with Banner -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900 text-white py-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">List Perusahaan Mitra</h1>
                <p class="text-xl">Temukan perusahaan impianmu</p>
            </div>

            <!-- Search Bar -->
            <div class="container mx-auto px-6">
                <div class="bg-white rounded-lg shadow-xl p-4 -mb-28 relative z-10">
                    <form action="{{ route('alumni.list_perusahaan') }}" method="GET" class="grid grid-cols-1 md:grid-cols-11 gap-4 items-center">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Nama perusahaan..."
                            class="w-full col-span-5 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800"
                        >
                        <select name="sektor" class="w-full col-span-4 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                            <option value="">Semua Sektor</option>
                            @foreach($sectors as $sector)
                                <option value="{{ $sector }}" {{ request('sektor') == $sector ? 'selected' : '' }}>{{ $sector }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-full col-span-2 bg-gradient-to-r from-blue-900 to-purple-700 text-white px-6 py-3 rounded-lg hover:from-blue-800 hover:to-purple-600 transition flex items-center justify-center space-x-2">
                            <span>Cari</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12 pt-32">
        <!-- Total Companies -->
        <div class="mb-8">
            <p class="text-gray-700 font-semibold">Total Perusahaan: {{ $totalCompanies }}</p>
        </div>

        <!-- Companies Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($companies as $company)
                <div class="company-card bg-white rounded-xl shadow-md p-6 cursor-pointer border border-gray-200 hover:shadow-lg transition" onclick="window.location='{{ route('alumni.detail_perusahaan', $company->id) }}'">
                    <div class="flex flex-col items-center text-center">
                        <!-- Company Logo -->
                        <div class="company-logo w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-4 overflow-hidden">
                            @if($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->nama_perusahaan }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-3xl font-bold text-gray-400">{{ substr($company->nama_perusahaan, 0, 2) }}</span>
                            @endif
                        </div>

                        <!-- Company Name -->
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $company->nama_perusahaan }}</h3>

                        <!-- Company Type -->
                        <p class="text-sm text-gray-600 mb-4">{{ $company->sektor ?? 'Sektor belum diisi' }}</p>

                        <!-- Company Website -->
                        <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                            </svg>
                            <span class="truncate">{{ $company->website ?? 'Belum ada website' }}</span>
                        </div>

                        <!-- Job Count -->
                        <div class="flex items-center space-x-2 text-sm text-blue-600 font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>Jumlah lowongan: aktif {{ $company->lowongan_count }}</span>
                        </div>
                        
                        <div class="mt-4 w-full">
                            <a href="{{ route('alumni.cari_lowongan', ['perusahaan' => $company->id]) }}" class="block w-full py-2 px-4 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition font-medium text-sm">
                                Lihat Lowongan
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak ada perusahaan ditemukan</h3>
                    <p class="text-gray-600">Coba ubah filter pencarian Anda</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $companies->withQueryString()->links() }}
        </div>
    </div>
@endsection
