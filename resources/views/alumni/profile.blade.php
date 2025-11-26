@extends('alumni.layouts.app')

@section('title', 'Profil Alumni')

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
                    <h3 class="text-xl font-bold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ $user->email }}</p>
                </div>
                <!-- Edit Profile Button -->
                <a href="{{ route('alumni.profile.edit') }}" class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all mb-4 inline-block text-center">
                    Edit Profil
                </a>

                <!-- Divider -->
                <hr class="my-4">

                <!-- Menu Items -->
                <nav class="space-y-2">
                    <a href="{{ route('alumni.cv.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors text-gray-700">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="text-sm font-medium">Curriculum Vitae</span>
                    </a>
                    <a href="{{ route('alumni.applications') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors text-gray-700">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <span class="text-sm font-medium">Status Lamaran</span>
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
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Profil Alumni</h1>
                <p class="text-gray-600">Informasi lengkap profil Anda</p>
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
                            <p class="text-gray-800 mt-1">{{ $alumni->nama_lengkap ?? $user->name }}</p>
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
                            <p class="text-gray-800 mt-1">{{ $user->email }}</p>
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
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Data Akademik</h3>
                    <a href="{{ route('alumni.profile.edit') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
                        Edit Data Akademik
                    </a>
                </div>

                <!-- Program Studi Utama -->
                <div class="mb-8 p-4 bg-blue-50 rounded-lg border border-blue-100">
                    <label class="text-xs font-bold text-blue-600 uppercase tracking-wide block mb-1">Program Studi</label>
                    <p class="text-gray-900 font-bold text-lg">
                        {{ $alumni->programStudi->program_studi ?? '-' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-8">
                        <!-- Riwayat Pendidikan -->
                        <div>
                            <h4 class="text-md font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                </svg>
                                Riwayat Pendidikan
                            </h4>
                            @if($alumni->riwayatPendidikan && $alumni->riwayatPendidikan->count() > 0)
                                <div class="space-y-4">
                                    @foreach($alumni->riwayatPendidikan as $pendidikan)
                                    <div class="relative pl-4 border-l-2 border-gray-200">
                                        <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-blue-400"></div>
                                        <h5 class="font-bold text-gray-900">{{ $pendidikan->strata }} - {{ $pendidikan->nama_sekolah }}</h5>
                                        @if($pendidikan->program_studi)
                                        <p class="text-sm text-blue-600 font-medium">{{ $pendidikan->program_studi }}</p>
                                        @endif
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ \Carbon\Carbon::parse($pendidikan->tahun_masuk)->format('Y') }} - 
                                            {{ $pendidikan->tahun_lulus ? \Carbon\Carbon::parse($pendidikan->tahun_lulus)->format('Y') : 'Sekarang' }}
                                        </p>
                                        @if($pendidikan->deskripsi)
                                        <p class="text-sm text-gray-600 mt-1">{{ $pendidikan->deskripsi }}</p>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 italic text-sm">Belum ada riwayat pendidikan</p>
                            @endif
                        </div>

                        <!-- Lisensi & Sertifikasi -->
                        <div>
                            <h4 class="text-md font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                                Lisensi & Sertifikasi
                            </h4>
                            @if($alumni->sertifikasi && $alumni->sertifikasi->count() > 0)
                                <div class="space-y-4">
                                    @foreach($alumni->sertifikasi as $cert)
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <h5 class="font-bold text-gray-900">{{ $cert->nama_sertifikasi }}</h5>
                                        <p class="text-sm text-gray-600">{{ $cert->lembaga_sertifikasi }}</p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ \Carbon\Carbon::parse($cert->mulai_berlaku)->format('M Y') }} - 
                                            {{ $cert->selesai_berlaku ? \Carbon\Carbon::parse($cert->selesai_berlaku)->format('M Y') : 'Seumur Hidup' }}
                                        </p>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 italic text-sm">Belum ada lisensi atau sertifikasi</p>
                            @endif
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-8">
                        <!-- Pengalaman Kerja -->
                        <div>
                            <h4 class="text-md font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Pengalaman Kerja & Organisasi
                            </h4>
                            @if($alumni->pengalamanKerja && $alumni->pengalamanKerja->count() > 0)
                                <div class="space-y-4">
                                    @foreach($alumni->pengalamanKerja as $pengalaman)
                                    <div class="relative pl-4 border-l-2 border-gray-200">
                                        <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-green-400"></div>
                                        <h5 class="font-bold text-gray-900">{{ $pengalaman->posisi }}</h5>
                                        <p class="text-sm text-gray-800 font-medium">{{ $pengalaman->perusahaan_organisasi }}</p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $pengalaman->type == 'organisasi' ? 'Organisasi' : 'Perusahaan' }} • 
                                            {{ \Carbon\Carbon::parse($pengalaman->mulai_kerja)->format('M Y') }} - 
                                            {{ $pengalaman->selesai_kerja ? \Carbon\Carbon::parse($pengalaman->selesai_kerja)->format('M Y') : 'Sekarang' }}
                                        </p>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 italic text-sm">Belum ada pengalaman kerja atau organisasi</p>
                            @endif
                        </div>

                        <!-- Skills -->
                        <div>
                            <h4 class="text-md font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                Keahlian & Kompetensi
                            </h4>
                            
                            <!-- Hard Skills -->
                            <div class="mb-4">
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide block mb-2">Hard Skills</label>
                                @if($alumni->keahlian)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(explode(',', $alumni->keahlian) as $skill)
                                            @if(trim($skill))
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">{{ trim($skill) }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 italic text-sm">-</p>
                                @endif
                            </div>

                            <!-- Soft Skills -->
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide block mb-2">Soft Skills</label>
                                @if($alumni->soft_skills)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(explode(',', $alumni->soft_skills) as $skill)
                                            @if(trim($skill))
                                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">{{ trim($skill) }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 italic text-sm">-</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Keluarga Content -->
            <div id="data-keluarga" class="tab-content bg-white rounded-lg shadow p-6 hidden">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Data Keluarga</h3>

                @if($dataKeluarga)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Nama Ayah</label>
                            <p class="text-gray-800 mt-1">{{ $dataKeluarga->nama_ayah ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Pekerjaan Ayah</label>
                            <p class="text-gray-800 mt-1">{{ $dataKeluarga->pekerjaan_ayah ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Nama Ibu</label>
                            <p class="text-gray-800 mt-1">{{ $dataKeluarga->nama_ibu ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Pekerjaan Ibu</label>
                            <p class="text-gray-800 mt-1">{{ $dataKeluarga->pekerjaan_ibu ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Jumlah Saudara</label>
                            <p class="text-gray-800 mt-1">{{ $dataKeluarga->jumlah_saudara ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                @if($dataKeluarga->alamat_keluarga)
                <div class="mt-6">
                    <label class="text-sm font-medium text-gray-600">Alamat Keluarga</label>
                    <p class="text-gray-800 mt-1">{{ $dataKeluarga->alamat_keluarga }}</p>
                </div>
                @endif
                @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Data keluarga belum diisi</p>
                    <a href="{{ route('alumni.profile.edit') }}" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 inline-block">Tambah Data Keluarga</a>
                </div>
                @endif
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
</script>
@endsection
