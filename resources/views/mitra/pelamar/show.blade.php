@extends('mitra.layouts.app')

@section('title', 'Detail Pelamar')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('mitra.pelamar.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar Pelamar
            </a>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg">
            <div class="flex">
                <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Profile Summary -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-4">
                            {{ substr($pelamar->user->name, 0, 1) }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $pelamar->user->name }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $pelamar->user->email }}</p>
                        
                        @if($alumni->no_hp)
                        <div class="flex items-center justify-center text-sm text-gray-600 mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $alumni->no_hp }}
                        </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="mb-4">
                            @if($pelamar->status == 'pending')
                            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu Review
                            </span>
                            @elseif($pelamar->status == 'diterima')
                            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                Diterima
                            </span>
                            @else
                            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                Ditolak
                            </span>
                            @endif
                        </div>

                        <p class="text-xs text-gray-500">Melamar {{ $pelamar->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <!-- Update Status Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h4 class="font-bold text-gray-900 mb-4">Update Status</h4>
                    <form method="POST" action="{{ route('mitra.pelamar.update-status', $pelamar->id) }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status Lamaran</label>
                                <select name="status" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="pending" {{ $pelamar->status == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                                    <option value="diterima" {{ $pelamar->status == 'diterima' ? 'selected' : '' }}>Terima</option>
                                    <option value="ditolak" {{ $pelamar->status == 'ditolak' ? 'selected' : '' }}>Tolak</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                                <textarea name="catatan" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Tambahkan catatan..."></textarea>
                            </div>

                            <button type="submit" class="w-full px-4 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                Update Status
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h4 class="font-bold text-gray-900 mb-4">Ringkasan Profil</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Riwayat Pendidikan</span>
                            <span class="font-semibold text-gray-900">{{ $alumni->riwayatPendidikan->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Pengalaman Kerja</span>
                            <span class="font-semibold text-gray-900">{{ $alumni->pengalamanKerja->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Sertifikasi</span>
                            <span class="font-semibold text-gray-900">{{ $alumni->sertifikasi->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Dokumen</span>
                            <span class="font-semibold text-gray-900">{{ $alumni->dokumenPendukung->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Detailed Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Lowongan Info -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Lamaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Posisi yang Dilamar</label>
                            <p class="text-gray-900 font-semibold mt-1">{{ $pelamar->lowongan->judul }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Lokasi</label>
                            <p class="text-gray-900 mt-1">{{ $pelamar->lowongan->lokasi }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Tanggal Melamar</label>
                            <p class="text-gray-900 mt-1">{{ $pelamar->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Tipe Pekerjaan</label>
                            <p class="text-gray-900 mt-1">{{ $pelamar->lowongan->tipe_pekerjaan }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tentang Saya -->
                @if($alumni->tentang_saya)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Tentang Saya</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $alumni->tentang_saya }}</p>
                </div>
                @endif

                <!-- Riwayat Pendidikan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Riwayat Pendidikan</h3>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                            {{ $alumni->riwayatPendidikan->count() }} Data
                        </span>
                    </div>

                    @if($alumni->riwayatPendidikan->count() > 0)
                    <div class="space-y-4">
                        @foreach($alumni->riwayatPendidikan as $pendidikan)
                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                            <h4 class="font-semibold text-gray-900">{{ $pendidikan->strata }}</h4>
                            <p class="text-gray-700 mt-1">{{ $pendidikan->nama_sekolah }}</p>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ \Carbon\Carbon::parse($pendidikan->tahun_masuk)->format('Y') }} - 
                                {{ $pendidikan->tahun_lulus ? \Carbon\Carbon::parse($pendidikan->tahun_lulus)->format('Y') : 'Sekarang' }}
                            </p>
                            @if($pendidikan->deskripsi)
                            <p class="text-sm text-gray-600 mt-2">{{ $pendidikan->deskripsi }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500 text-center py-4">Belum ada data riwayat pendidikan</p>
                    @endif
                </div>

                <!-- Pengalaman Kerja -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Pengalaman Kerja & Organisasi</h3>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                            {{ $alumni->pengalamanKerja->count() }} Data
                        </span>
                    </div>

                    @if($alumni->pengalamanKerja->count() > 0)
                    <div class="space-y-4">
                        @foreach($alumni->pengalamanKerja as $pengalaman)
                        <div class="border-l-4 border-green-500 pl-4 py-2">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $pengalaman->posisi }}</h4>
                                    <p class="text-gray-700 mt-1">{{ $pengalaman->perusahaan_organisasi }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $pengalaman->type == 'organisasi' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ ucfirst($pengalaman->type) }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ \Carbon\Carbon::parse($pengalaman->mulai_kerja)->format('M Y') }} - 
                                {{ $pengalaman->selesai_kerja ? \Carbon\Carbon::parse($pengalaman->selesai_kerja)->format('M Y') : 'Sekarang' }}
                            </p>
                            @if($pengalaman->deskripsi_piri)
                            <p class="text-sm text-gray-600 mt-2">{{ $pengalaman->deskripsi_piri }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500 text-center py-4">Belum ada data pengalaman kerja</p>
                    @endif
                </div>

                <!-- Sertifikasi -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Lisensi & Sertifikasi</h3>
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-medium">
                            {{ $alumni->sertifikasi->count() }} Data
                        </span>
                    </div>

                    @if($alumni->sertifikasi->count() > 0)
                    <div class="space-y-4">
                        @foreach($alumni->sertifikasi as $cert)
                        <div class="border-l-4 border-purple-500 pl-4 py-2">
                            <h4 class="font-semibold text-gray-900">{{ $cert->nama_sertifikasi }}</h4>
                            <p class="text-gray-700 mt-1">{{ $cert->lembaga_sertifikasi }}</p>
                            <div class="flex items-center space-x-2 mt-1">
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($cert->mulai_berlaku)->format('M Y') }}
                                    @if($cert->selesai_berlaku)
                                        - {{ \Carbon\Carbon::parse($cert->selesai_berlaku)->format('M Y') }}
                                    @endif
                                </p>
                                @if(!$cert->selesai_berlaku)
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                                    Tidak Kadaluarsa
                                </span>
                                @endif
                            </div>
                            @if($cert->deskripsi)
                            <p class="text-sm text-gray-600 mt-2">{{ $cert->deskripsi }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500 text-center py-4">Belum ada data sertifikasi</p>
                    @endif
                </div>

                <!-- Skills -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Keahlian & Kompetensi</h3>
                    
                    @if($alumni->keahlian || $alumni->soft_skills)
                    <div class="space-y-4">
                        @if($alumni->keahlian)
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Hard Skills</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $alumni->keahlian) as $skill)
                                <span class="px-3 py-1.5 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                    {{ trim($skill) }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if($alumni->soft_skills)
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Soft Skills</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $alumni->soft_skills) as $skill)
                                <span class="px-3 py-1.5 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                    {{ trim($skill) }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    @else
                    <p class="text-gray-500 text-center py-4">Belum ada data skills</p>
                    @endif
                </div>

                <!-- Dokumen Pendukung -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Dokumen Pendukung</h3>
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium">
                            {{ $alumni->dokumenPendukung->count() }} Dokumen
                        </span>
                    </div>

                    @if($alumni->dokumenPendukung->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($alumni->dokumenPendukung as $dokumen)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate">{{ $dokumen->nama_dokumen }}</p>
                                    <p class="text-sm text-gray-500 mt-1">{{ ucfirst($dokumen->tipe_dokumen) }}</p>
                                    <a href="{{ Storage::url($dokumen->path_file) }}" target="_blank" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 mt-2">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Lihat Dokumen
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500 text-center py-4">Belum ada dokumen pendukung</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection