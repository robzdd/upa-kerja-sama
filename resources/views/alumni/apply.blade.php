

@extends('alumni.layouts.app')

@section('title', 'Lamar Pekerjaan - ' . $lowongan->judul)

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('alumni.lowongan.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Lowongan
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Lamar Pekerjaan</h1>
            <p class="text-gray-600 mt-2">Lengkapi form di bawah untuk melamar pekerjaan ini</p>
        </div>

        @if(!$isProfileComplete)
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Profil Belum Lengkap</h3>
                <div class="mt-2 text-sm text-red-700">
                    <p>Mohon lengkapi data berikut:</p>
                    <ul class="list-disc ml-5 mt-2">
                        @if(empty($alumni->user->name)) <li>Nama</li> @endif
                        @if(empty($alumni->no_hp)) <li>Nomor HP</li> @endif
                        @if(empty($alumni->tempat_lahir)) <li>Tempat Lahir</li> @endif
                        @if(empty($alumni->tanggal_lahir)) <li>Tanggal Lahir</li> @endif
                        @if(empty($alumni->jenis_kelamin)) <li>Jenis Kelamin</li> @endif
                        @if(empty($alumni->alamat)) <li>Alamat</li> @endif
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left: Job Info Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                    <div class="text-center mb-4">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <span class="text-2xl font-bold text-white">{{ substr($lowongan->mitra->nama_perusahaan, 0, 2) }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">{{ $lowongan->judul }}</h3>
                        <p class="text-sm text-gray-600">{{ $lowongan->mitra->nama_perusahaan }}</p>
                    </div>
                    
                    <div class="border-t pt-4 space-y-3">
                        <div class="flex items-center text-sm">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                            <span class="text-gray-700">{{ $lowongan->lokasi }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-700">{{ $lowongan->jenis_pekerjaan }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span class="text-gray-700">{{ $lowongan->jenjang_pendidikan }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-4 border-t">
                        <div class="flex items-center justify-between text-sm mb-2">
                            <span class="text-gray-600">Total Pelamar</span>
                            <span class="font-semibold text-gray-800">{{ $lowongan->jumlah_pelamar }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Batas Lamaran</span>
                            <span class="font-semibold text-red-600">
                                {{ \Carbon\Carbon::parse($lowongan->tanggal_penerimaan_lamaran)->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Application Form -->
            <div class="lg:col-span-2">
                <form action="{{ route('alumni.lowongan.apply.submit', $lowongan->id) }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
                    @csrf
                    
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Form Lamaran</h2>
                    
                    <!-- Profile Summary -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h3 class="text-sm font-semibold text-blue-900 mb-3">Data Diri Anda</h3>
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <span class="text-gray-600">Nama:</span>
                                <span class="font-medium text-gray-800 ml-2">{{ $alumni->user->name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Email:</span>
                                <span class="font-medium text-gray-800 ml-2">{{ $alumni->user->email }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">No HP:</span>
                                <span class="font-medium text-gray-800 ml-2">{{ $alumni->no_hp ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Pendidikan:</span>
                                <span class="font-medium text-gray-800 ml-2">{{ $alumni->dataAkademik->jenjang_pendidikan ?? '-' }}</span>
                            </div>
                        </div>
                        <a href="{{ route('alumni.profile.edit') }}" class="text-xs text-blue-600 hover:text-blue-700 mt-2 inline-block">
                            Edit Profil →
                        </a>
                    </div>
                    
                    <!-- Cover Letter / Pesan Lamaran -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pesan Lamaran / Cover Letter *
                        </label>
                        <textarea 
                            name="pesan_lamaran" 
                            rows="8" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('pesan_lamaran') border-red-500 @enderror"
                            placeholder="Jelaskan mengapa Anda tertarik dengan posisi ini dan mengapa Anda adalah kandidat yang tepat. (Minimal 50 karakter)"
                        >{{ old('pesan_lamaran') }}</textarea>
                        @error('pesan_lamaran')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Minimal 50 karakter, maksimal 1000 karakter</p>
                    </div>
                    
                    <!-- Terms and Conditions -->
                    <div class="mb-6">
                        <label class="flex items-start">
                            <input 
                                type="checkbox" 
                                name="agree_terms" 
                                value="1" 
                                required
                                class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            >
                            <span class="ml-3 text-sm text-gray-700">
                                Saya menyetujui bahwa data yang saya berikan adalah benar dan dapat dipertanggungjawabkan. 
                                Saya juga memahami bahwa informasi ini akan digunakan untuk proses seleksi.
                            </span>
                        </label>
                        @error('agree_terms')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex space-x-4">
                        <button 
                            type="submit" 
                            class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-6 rounded-lg hover:from-blue-700 hover:to-blue-800 font-semibold transition-all shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                            @if(!$isProfileComplete) disabled @endif
                        >
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Kirim Lamaran
                            </span>
                        </button>
                        <a href="{{ route('alumni.lowongan.index') }}" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-semibold transition-all">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- FILE: resources/views/alumni/applications/index.blade.php --}}

@extends('alumni.layouts.app')

@section('title', 'Status Lamaran Saya')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Status Lamaran Saya</h1>
            <p class="text-gray-600">Pantau status lamaran pekerjaan yang Anda ajukan</p>
        </div>

        @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
            <div class="flex">
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <p class="ml-3 text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- Applications List -->
        @if($applications->count() > 0)
            <div class="space-y-4">
                @foreach($applications as $application)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $application->lowongan->judul }}</h3>
                                <p class="text-gray-600 mb-2">{{ $application->lowongan->mitra->nama_perusahaan }}</p>
                                <div class="flex flex-wrap gap-3 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        </svg>
                                        {{ $application->lowongan->lokasi }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $application->lowongan->jenis_pekerjaan }}
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4">
                                {!! $application->status_badge !!}
                            </div>
                        </div>
                        
                        <div class="border-t pt-4">
                            <div class="flex items-center justify-between text-sm">
                                <div>
                                    <span class="text-gray-500">Tanggal Melamar:</span>
                                    <span class="font-medium text-gray-800 ml-2">{{ $application->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('alumni.lowongan.index') }}" class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition">
                                        Lihat Detail
                                    </a>
                                    @if($application->status === 'pending')
                                    <form action="{{ route('alumni.applications.cancel', $application->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan lamaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition">
                                            Batalkan
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @if($application->pesan_lamaran)
                        <div class="mt-4 pt-4 border-t">
                            <p class="text-sm text-gray-600 font-medium mb-2">Pesan Lamaran:</p>
                            <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded">{{ Str::limit($application->pesan_lamaran, 200) }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $applications->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Lamaran</h3>
                <p class="text-gray-600 mb-6">Anda belum melamar pekerjaan apapun</p>
                <a href="{{ route('alumni.lowongan.index') }}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-8 rounded-lg hover:from-blue-700 hover:to-blue-800 font-semibold transition-all">
                    Cari Lowongan Pekerjaan
                </a>
            </div>
        @endif
    </div>
</div>
@endsection