@extends('alumni.layouts.app')

@section('title', 'Curriculum Vitae')

@section('content')
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 mx-4 mt-4">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 mx-4 mt-4">
    {{ session('error') }}
</div>
@endif

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
                <a href="{{ route('alumni.profile') }}" class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all mb-4 inline-block text-center">
                    Ubah Profil
                </a>

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
            <!-- Curriculum Vitae Section -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Curriculum Vitae</h2>
                        <p class="text-sm text-gray-600">Menampilkan riwayat pribadi informasi profil dan pencapaian dalam memberikan dan menunjukkan tentang diri Anda.</p>
                    </div>
                    <button onclick="showDetailModal()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Detail</button>
                </div>

                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-700">Progress CV</span>
                        <span class="text-sm font-semibold text-gray-800">{{ $progressPercentage }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-cyan-400 to-blue-600 h-2 rounded-full" style="width: {{ $progressPercentage }}%"></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 flex-wrap">
                    <form method="POST" action="{{ route('alumni.cv.generate') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 {{ $alumni && $alumni->cv_generated ? 'bg-blue-600 hover:bg-blue-700' : 'bg-green-600 hover:bg-green-700' }} text-white font-medium rounded-lg transition-colors text-sm">
                            {{ $alumni && $alumni->cv_generated ? 'Regenerate CV' : 'Generate CV' }}
                        </button>
                    </form>
                    <a href="{{ route('alumni.cv.preview') }}" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors text-sm">
                        Preview CV
                    </a>
                    @if($alumni && $alumni->cv_uri)
                    <a href="{{ route('cv.public', $alumni->cv_uri) }}" target="_blank" class="px-4 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors text-sm">
                        Lihat CV Publik
                    </a>
                    <form method="POST" action="{{ route('alumni.cv.toggle-public') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 {{ $alumni->cv_public ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-600 hover:bg-gray-700' }} text-white font-medium rounded-lg transition-colors text-sm">
                            {{ $alumni->cv_public ? 'CV Publik' : 'Buat Publik' }}
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            <!-- Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <div class="flex space-x-6">
                    <button class="pb-3 px-1 border-b-2 border-blue-600 text-blue-600 font-semibold text-sm" onclick="showTab('data-pribadi')">
                        Data Pribadi
                    </button>
                    <button class="pb-3 px-1 text-gray-600 hover:text-gray-800 font-medium text-sm" onclick="showTab('data-akademik')">
                        Data Akademik
                    </button>
                    <button class="pb-3 px-1 text-gray-600 hover:text-gray-800 font-medium text-sm" onclick="showTab('data-keluarga')">
                        Data Keluarga
                    </button>
                    <button class="pb-3 px-1 text-gray-600 hover:text-gray-800 font-medium text-sm" onclick="showTab('dokumen')">
                        Dokumen
                    </button>
                </div>
            </div>

            <!-- Data Pribadi Content -->
            <div id="data-pribadi" class="tab-content bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Data Pribadi</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Tentang Saya</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->tentang_saya ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Nama Lengkap</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->nama_lengkap ?? auth()->user()->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">NIK</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->nim ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Jenis Kelamin</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->jenis_kelamin ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Email</label>
                            <p class="text-gray-800 mt-1">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Nama Bank</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->nama_bank ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">No Rekening</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->no_rekening ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Alamat Tempat Tinggal</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Tempat Lahir</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->tempat_lahir ?? '-' }}, {{ $alumni->tanggal_lahir ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">No Handphone</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->no_hp ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Akademik Content -->
            <div id="data-akademik" class="tab-content bg-white rounded-lg shadow p-6 hidden">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Data Akademik</h3>

                @if($alumni && $alumni->dataAkademik)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">NIM</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->dataAkademik->nim ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Program Studi</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->dataAkademik->program_studi ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Tahun Masuk</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->dataAkademik->tahun_masuk ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Tahun Lulus</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->dataAkademik->tahun_lulus ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">IPK</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->dataAkademik->ipk ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Universitas</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->dataAkademik->universitas ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Hard Skills Section -->
                @if($alumni->keahlian)
                <div class="mt-6">
                    <label class="text-sm font-medium text-gray-600 mb-3 block">Hard Skills</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $alumni->keahlian) as $skill)
                            @if(trim($skill))
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                {{ trim($skill) }}
                            </span>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Soft Skills Section -->
                @if($alumni->soft_skills)
                <div class="mt-4">
                    <label class="text-sm font-medium text-gray-600 mb-3 block">Soft Skills</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $alumni->soft_skills) as $skill)
                            @if(trim($skill))
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                {{ trim($skill) }}
                            </span>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Data akademik belum diisi</p>
                    <a href="{{ route('alumni.profile') }}" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 inline-block">Tambah Data Akademik</a>
                </div>
                @endif
            </div>

            <!-- Data Keluarga Content -->
            <div id="data-keluarga" class="tab-content bg-white rounded-lg shadow p-6 hidden">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Data Keluarga</h3>

                @if($alumni && $alumni->dataKeluarga)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Nama Ayah</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->dataKeluarga->nama_ayah ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Pekerjaan Ayah</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->dataKeluarga->pekerjaan_ayah ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Nama Ibu</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->dataKeluarga->nama_ibu ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Pekerjaan Ibu</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->dataKeluarga->pekerjaan_ibu ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Jumlah Saudara</label>
                            <p class="text-gray-800 mt-1">{{ $alumni->dataKeluarga->jumlah_saudara ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Data keluarga belum diisi</p>
                    <a href="{{ route('alumni.profile') }}" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 inline-block">Tambah Data Keluarga</a>
                </div>
                @endif
            </div>

            <!-- Dokumen Content -->
            <div id="dokumen" class="tab-content bg-white rounded-lg shadow p-6 hidden">
                <h3 class="text-lg font-bold text-gray-800 mb-6">Dokumen Pendukung</h3>

                <!-- Document Types -->
                <div class="space-y-6">
                    <!-- CV Document -->
                    <div>
                        <h4 class="text-lg font-bold text-gray-800 mb-3">CV</h4>
                        @php
                            $cvDocument = $alumni && $alumni->dokumenPendukung ? $alumni->dokumenPendukung->where('tipe_dokumen', 'cv')->first() : null;
                        @endphp
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"></path>
                                    </svg>
                                    <div>
                                        @if($cvDocument)
                                            <p class="font-medium text-gray-800">{{ $cvDocument->nama_dokumen }}</p>
                                            <p class="text-sm text-gray-500">{{ $cvDocument->created_at->format('Y-m-d H:i:s') }}</p>
                                        @else
                                            <p class="text-gray-500">Dokumen belum diupload</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    @if($cvDocument)
                                        <a href="{{ route('alumni.documents.view', $cvDocument->id) }}" target="_blank" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Lihat file</a>
                                        <form method="POST" action="{{ route('alumni.documents.delete', $cvDocument->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus dokumen ini?')">Delete</button>
                                        </form>
                                    @else
                                        <button onclick="showUploadModal('cv')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Upload file</button>
                                        <button onclick="showUrlModal('cv')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Input URL</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KTP Document -->
                    <div>
                        <h4 class="text-lg font-bold text-gray-800 mb-3">KTP</h4>
                        @php
                            $ktpDocument = $alumni && $alumni->dokumenPendukung ? $alumni->dokumenPendukung->where('tipe_dokumen', 'ktp')->first() : null;
                        @endphp
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"></path>
                                    </svg>
                                    <div>
                                        @if($ktpDocument)
                                            <p class="font-medium text-gray-800">{{ $ktpDocument->nama_dokumen }}</p>
                                            <p class="text-sm text-gray-500">{{ $ktpDocument->created_at->format('Y-m-d H:i:s') }}</p>
                                        @else
                                            <p class="text-gray-500">Dokumen belum diupload</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    @if($ktpDocument)
                                        <a href="{{ route('alumni.documents.view', $ktpDocument->id) }}" target="_blank" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Lihat file</a>
                                        <form method="POST" action="{{ route('alumni.documents.delete', $ktpDocument->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus dokumen ini?')">Delete</button>
                                        </form>
                                    @else
                                        <button onclick="showUploadModal('ktp')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Upload file</button>
                                        <button onclick="showUrlModal('ktp')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Input URL</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ijazah Document -->
                    <div>
                        <h4 class="text-lg font-bold text-gray-800 mb-3">Ijazah/SKL</h4>
                        @php
                            $ijazahDocument = $alumni && $alumni->dokumenPendukung ? $alumni->dokumenPendukung->where('tipe_dokumen', 'ijazah')->first() : null;
                        @endphp
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"></path>
                                    </svg>
                                    <div>
                                        @if($ijazahDocument)
                                            <p class="font-medium text-gray-800">{{ $ijazahDocument->nama_dokumen }}</p>
                                            <p class="text-sm text-gray-500">{{ $ijazahDocument->created_at->format('Y-m-d H:i:s') }}</p>
                                        @else
                                            <p class="text-gray-500">Dokumen belum diupload</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    @if($ijazahDocument)
                                        <a href="{{ route('alumni.documents.view', $ijazahDocument->id) }}" target="_blank" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Lihat file</a>
                                        <form method="POST" action="{{ route('alumni.documents.delete', $ijazahDocument->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus dokumen ini?')">Delete</button>
                                        </form>
                                    @else
                                        <button onclick="showUploadModal('ijazah')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Upload file</button>
                                        <button onclick="showUrlModal('ijazah')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Input URL</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transkrip Document -->
                    <div>
                        <h4 class="text-lg font-bold text-gray-800 mb-3">Transkrip Nilai</h4>
                        @php
                            $transkripDocument = $alumni && $alumni->dokumenPendukung ? $alumni->dokumenPendukung->where('tipe_dokumen', 'transkrip')->first() : null;
                        @endphp
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"></path>
                                    </svg>
                                    <div>
                                        @if($transkripDocument)
                                            <p class="font-medium text-gray-800">{{ $transkripDocument->nama_dokumen }}</p>
                                            <p class="text-sm text-gray-500">{{ $transkripDocument->created_at->format('Y-m-d H:i:s') }}</p>
                                        @else
                                            <p class="text-gray-500">Dokumen belum diupload</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    @if($transkripDocument)
                                        <a href="{{ route('alumni.documents.view', $transkripDocument->id) }}" target="_blank" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Lihat file</a>
                                        <form method="POST" action="{{ route('alumni.documents.delete', $transkripDocument->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus dokumen ini?')">Delete</button>
                                        </form>
                                    @else
                                        <button onclick="showUploadModal('transkrip')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Upload file</button>
                                        <button onclick="showUrlModal('transkrip')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Input URL</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sertifikat Document -->
                    <div>
                        <h4 class="text-lg font-bold text-gray-800 mb-3">Sertifikat</h4>
                        @php
                            $sertifikatDocument = $alumni && $alumni->dokumenPendukung ? $alumni->dokumenPendukung->where('tipe_dokumen', 'sertifikat')->first() : null;
                        @endphp
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"></path>
                                    </svg>
                                    <div>
                                        @if($sertifikatDocument)
                                            <p class="font-medium text-gray-800">{{ $sertifikatDocument->nama_dokumen }}</p>
                                            <p class="text-sm text-gray-500">{{ $sertifikatDocument->created_at->format('Y-m-d H:i:s') }}</p>
                                        @else
                                            <p class="text-gray-500">Dokumen belum diupload</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    @if($sertifikatDocument)
                                        <a href="{{ route('alumni.documents.view', $sertifikatDocument->id) }}" target="_blank" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Lihat file</a>
                                        <form method="POST" action="{{ route('alumni.documents.delete', $sertifikatDocument->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus dokumen ini?')">Delete</button>
                                        </form>
                                    @else
                                        <button onclick="showUploadModal('sertifikat')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Upload file</button>
                                        <button onclick="showUrlModal('sertifikat')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Input URL</button>
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>

                    <!-- Portofolio Document -->
                    <div>
                        <h4 class="text-lg font-bold text-gray-800 mb-3">Portofolio</h4>
                        @php
                            $portofolioDocument = $alumni && $alumni->dokumenPendukung ? $alumni->dokumenPendukung->where('tipe_dokumen', 'portofolio')->first() : null;
                        @endphp
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"></path>
                                    </svg>
                                    <div>
                                        @if($portofolioDocument)
                                            <p class="font-medium text-gray-800">{{ $portofolioDocument->nama_dokumen }}</p>
                                            <p class="text-sm text-gray-500">{{ $portofolioDocument->created_at->format('Y-m-d H:i:s') }}</p>
                                        @else
                                            <p class="text-gray-500">Dokumen belum diupload</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    @if($portofolioDocument)
                                        <a href="{{ route('alumni.documents.view', $portofolioDocument->id) }}" target="_blank" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Lihat file</a>
                                        <form method="POST" action="{{ route('alumni.documents.delete', $portofolioDocument->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus dokumen ini?')">Delete</button>
                                        </form>
                                    @else
                                        <button onclick="showUploadModal('portofolio')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Upload file</button>
                                        <button onclick="showUrlModal('portofolio')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Input URL</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen Lainnya -->
                    <div>
                        <h4 class="text-lg font-bold text-gray-800 mb-3">Dokumen Lainnya</h4>
                        @php
                            $lainnyaDocuments = $alumni && $alumni->dokumenPendukung ? $alumni->dokumenPendukung->whereNotIn('tipe_dokumen', ['cv', 'ktp', 'ijazah', 'transkrip', 'sertifikat', 'portofolio']) : collect();
                        @endphp
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"></path>
                                    </svg>
                                    <div>
                                        @if($lainnyaDocuments->count() > 0)
                                            <p class="font-medium text-gray-800">{{ $lainnyaDocuments->count() }} dokumen lainnya</p>
                                            <p class="text-sm text-gray-500">Terakhir diupdate: {{ $lainnyaDocuments->sortByDesc('created_at')->first()->created_at->format('Y-m-d H:i:s') }}</p>
                                        @else
                                            <p class="text-gray-500">Dokumen belum diupload</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    @if($lainnyaDocuments->count() > 0)
                                        <button onclick="showOtherDocuments()" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Lihat semua</button>
                                    @else
                                        <button onclick="showUploadModal('lainnya')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Upload file</button>
                                        <button onclick="showUrlModal('lainnya')" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 text-sm font-medium">Input URL</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        </div>
                    </div>
                </div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Detail Progress CV</h3>
                <button onclick="hideDetailModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                        </button>
            </div>

            <div class="space-y-4">
                <!-- Data Pribadi -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-800 mb-3">Data Pribadi</h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Nama Lengkap</span>
                            <span class="text-sm {{ $alumni && $alumni->nama_lengkap ? 'text-green-600' : 'text-red-600' }}">
                                {{ $alumni && $alumni->nama_lengkap ? '✓ Lengkap' : '✗ Belum diisi' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Email</span>
                            <span class="text-sm {{ auth()->user()->email ? 'text-green-600' : 'text-red-600' }}">
                                {{ auth()->user()->email ? '✓ Lengkap' : '✗ Belum diisi' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">No Handphone</span>
                            <span class="text-sm {{ $alumni && $alumni->no_hp ? 'text-green-600' : 'text-red-600' }}">
                                {{ $alumni && $alumni->no_hp ? '✓ Lengkap' : '✗ Belum diisi' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Alamat</span>
                            <span class="text-sm {{ $alumni && $alumni->alamat ? 'text-green-600' : 'text-red-600' }}">
                                {{ $alumni && $alumni->alamat ? '✓ Lengkap' : '✗ Belum diisi' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Data Akademik -->
                        <div class="border border-gray-200 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-800 mb-3">Data Akademik</h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Program Studi</span>
                            <span class="text-sm {{ $alumni && $alumni->dataAkademik && $alumni->dataAkademik->program_studi ? 'text-green-600' : 'text-red-600' }}">
                                {{ $alumni && $alumni->dataAkademik && $alumni->dataAkademik->program_studi ? '✓ Lengkap' : '✗ Belum diisi' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Universitas</span>
                            <span class="text-sm {{ $alumni && $alumni->dataAkademik && $alumni->dataAkademik->universitas ? 'text-green-600' : 'text-red-600' }}">
                                {{ $alumni && $alumni->dataAkademik && $alumni->dataAkademik->universitas ? '✓ Lengkap' : '✗ Belum diisi' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Tahun Masuk</span>
                            <span class="text-sm {{ $alumni && $alumni->dataAkademik && $alumni->dataAkademik->tahun_masuk ? 'text-green-600' : 'text-red-600' }}">
                                {{ $alumni && $alumni->dataAkademik && $alumni->dataAkademik->tahun_masuk ? '✓ Lengkap' : '✗ Belum diisi' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Tahun Lulus</span>
                            <span class="text-sm {{ $alumni && $alumni->dataAkademik && $alumni->dataAkademik->tahun_lulus ? 'text-green-600' : 'text-red-600' }}">
                                {{ $alumni && $alumni->dataAkademik && $alumni->dataAkademik->tahun_lulus ? '✓ Lengkap' : '✗ Belum diisi' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Data Keluarga -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-800 mb-3">Data Keluarga</h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Nama Ayah</span>
                            <span class="text-sm {{ $alumni && $alumni->dataKeluarga && $alumni->dataKeluarga->nama_ayah ? 'text-green-600' : 'text-red-600' }}">
                                {{ $alumni && $alumni->dataKeluarga && $alumni->dataKeluarga->nama_ayah ? '✓ Lengkap' : '✗ Belum diisi' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Nama Ibu</span>
                            <span class="text-sm {{ $alumni && $alumni->dataKeluarga && $alumni->dataKeluarga->nama_ibu ? 'text-green-600' : 'text-red-600' }}">
                                {{ $alumni && $alumni->dataKeluarga && $alumni->dataKeluarga->nama_ibu ? '✓ Lengkap' : '✗ Belum diisi' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Dokumen Pendukung -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-800 mb-3">Dokumen Pendukung</h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Jumlah Dokumen</span>
                            <span class="text-sm {{ $alumni && $alumni->dokumenPendukung && $alumni->dokumenPendukung->count() > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $alumni && $alumni->dokumenPendukung ? $alumni->dokumenPendukung->count() . ' dokumen' : '✗ Belum ada dokumen' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button onclick="hideDetailModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tab contents
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => {
        content.classList.add('hidden');
    });

    // Remove active class from all tab buttons
    const tabButtons = document.querySelectorAll('button[onclick^="showTab"]');
    tabButtons.forEach(button => {
        button.classList.remove('border-b-2', 'border-blue-600', 'text-blue-600', 'font-semibold');
        button.classList.add('text-gray-600', 'font-medium');
    });

    // Show selected tab content
    const selectedContent = document.getElementById(tabName);
    if (selectedContent) {
        selectedContent.classList.remove('hidden');
    }

    // Add active class to selected tab button
    const selectedButton = document.querySelector(`button[onclick="showTab('${tabName}')"]`);
    if (selectedButton) {
        selectedButton.classList.add('border-b-2', 'border-blue-600', 'text-blue-600', 'font-semibold');
        selectedButton.classList.remove('text-gray-600', 'font-medium');
    }
}

// Initialize with data-pribadi tab active
document.addEventListener('DOMContentLoaded', function() {
    showTab('data-pribadi');
});

function showDetailModal() {
    document.getElementById('detailModal').classList.remove('hidden');
}

function hideDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

function showUploadModal(documentType) {
    // Create upload modal dynamically
    const modal = document.createElement('div');
    modal.id = 'uploadModal';
    modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50';
    modal.innerHTML = `
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Upload Dokumen ${documentType.toUpperCase()}</h3>
                    <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('alumni.documents.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tipe_dokumen" value="${documentType}">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File</label>
                        <input type="file" name="file" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Maksimal 10MB. Format: PDF, JPG, PNG, DOC, DOCX</p>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeUploadModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
}

function showUrlModal(documentType) {
    // Create URL modal dynamically
    const modal = document.createElement('div');
    modal.id = 'urlModal';
    modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50';
    modal.innerHTML = `
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Input URL Dokumen ${documentType.toUpperCase()}</h3>
                    <button onclick="closeUrlModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('alumni.documents.upload') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tipe_dokumen" value="${documentType}">
                    <input type="hidden" name="upload_type" value="url">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">URL Dokumen</label>
                        <input type="url" name="document_url" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="https://example.com/document.pdf">
                        <p class="text-xs text-gray-500 mt-1">Masukkan URL lengkap dokumen yang ingin diupload</p>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeUrlModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan URL</button>
                    </div>
                </form>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
}

function closeUploadModal() {
    const modal = document.getElementById('uploadModal');
    if (modal) {
        modal.remove();
    }
}

function closeUrlModal() {
    const modal = document.getElementById('urlModal');
    if (modal) {
        modal.remove();
    }
}

function showOtherDocuments() {
    // Show all other documents in a modal
    const modal = document.createElement('div');
    modal.id = 'otherDocumentsModal';
    modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50';
    modal.innerHTML = `
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Dokumen Lainnya</h3>
                    <button onclick="closeOtherDocumentsModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="space-y-4">
                    @if($alumni && $alumni->dokumenPendukung)
                        @php
                            $otherDocuments = $alumni->dokumenPendukung->whereNotIn('tipe_dokumen', ['cv', 'ktp', 'ijazah', 'transkrip', 'sertifikat', 'portofolio']);
                        @endphp
                        @if($otherDocuments->count() > 0)
                            @foreach($otherDocuments as $dokumen)
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"></path>
                                    </svg>
                                    <div>
                                        <h4 class="font-medium text-gray-800">{{ ucfirst(str_replace('_', ' ', $dokumen->tipe_dokumen)) }}</h4>
                                        <p class="text-sm text-gray-600">{{ $dokumen->nama_dokumen }}</p>
                                        <p class="text-xs text-gray-500">{{ $dokumen->created_at->format('Y-m-d H:i:s') }}</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('alumni.documents.view', $dokumen->id) }}" target="_blank" class="px-3 py-1 bg-blue-100 text-blue-700 rounded text-sm hover:bg-blue-200">Lihat</a>
                                    <a href="{{ route('alumni.documents.download', $dokumen->id) }}" class="px-3 py-1 bg-green-100 text-green-700 rounded text-sm hover:bg-green-200">Download</a>
                                    <form method="POST" action="{{ route('alumni.documents.delete', $dokumen->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded text-sm hover:bg-red-200" onclick="return confirm('Yakin ingin menghapus dokumen ini?')">Hapus</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-500">Tidak ada dokumen lainnya</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
}

function closeOtherDocumentsModal() {
    const modal = document.getElementById('otherDocumentsModal');
    if (modal) {
        modal.remove();
    }
}

// Close modal when clicking outside
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideDetailModal();
    }
});
</script>
@endsection
