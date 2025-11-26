@extends('alumni.layouts.app')
@section('title', 'Edit Profil')

@section('content')
<!-- Success/Error Messages -->
@if(session('success'))
<div class="fixed top-4 right-4 z-50 bg-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg shadow-lg animate-slide-in">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
</div>
@endif

@if(session('error'))
<div class="fixed top-4 right-4 z-50 bg-red-100 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg shadow-lg animate-slide-in">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <span class="font-medium">{{ session('error') }}</span>
    </div>
</div>
@endif

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Sidebar Left -->
            <div class="lg:col-span-1">
                <!-- Profile Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6 sticky top-6">
                    <!-- Profile Avatar -->
                    <div class="text-center mb-6">
                        <div class="relative inline-block">
                            <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center ring-4 ring-blue-50">
                                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                                </svg>
                            </div>
                            <div class="absolute bottom-3 right-0 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ auth()->user()->email }}</p>
                        @if($alumni->programStudi)
                        <span class="inline-block mt-2 px-3 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded-full">
                            {{ $alumni->programStudi->program_studi }}
                        </span>
                        @endif
                    </div>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-xs">
                            <span class="px-2 bg-white text-gray-500 font-medium">MENU</span>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <nav class="space-y-1">
                        <a href="{{ route('alumni.cv.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-50 transition-all duration-200 text-gray-700 hover:text-blue-700 group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="text-sm font-medium">Curriculum Vitae</span>
                        </a>
                        
                        <a href="{{ route('alumni.applications') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-50 transition-all duration-200 text-gray-700 hover:text-blue-700 group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            <span class="text-sm font-medium">Status Lamaran</span>
                        </a>
                        

                        
                        <a href="{{ route('alumni.security.settings') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-50 transition-all duration-200 text-gray-700 hover:text-blue-700 group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span class="text-sm font-medium">Pengaturan Keamanan</span>
                        </a>

                        <div class="pt-2 mt-2 border-t border-gray-200">
                            <form method="POST" action="{{ route('alumni.logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-red-50 transition-all duration-200 text-red-600 hover:text-red-700 w-full text-left group">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Keluar</span>
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Profil</h1>
                    <p class="text-gray-600">Pastikan data benar untuk mempermudah proses pendaftaran</p>
                </div>

                <!-- Tabs -->
                <div class="bg-white rounded-t-xl shadow-sm border border-gray-100 border-b-0">
                    <div class="flex space-x-1 p-2">
                        <button class="tab-button flex-1 py-3 px-6 text-sm font-semibold rounded-lg transition-all duration-200 bg-blue-600 text-white" data-tab="data-pribadi">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Data Pribadi</span>
                            </div>
                        </button>
                        <button class="tab-button flex-1 py-3 px-6 text-sm font-semibold rounded-lg transition-all duration-200 text-gray-600 hover:bg-gray-50" data-tab="data-akademik">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <span>Data Akademik</span>
                            </div>
                        </button>
                        <button class="tab-button flex-1 py-3 px-6 text-sm font-semibold rounded-lg transition-all duration-200 text-gray-600 hover:bg-gray-50" data-tab="data-keluarga">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span>Data Keluarga</span>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Tab Contents -->
                <!-- Data Pribadi -->
                <div id="data-pribadi" class="tab-content bg-white rounded-b-xl shadow-sm border border-gray-100 p-8">
                    <form method="POST" action="{{ route('alumni.profile.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="form_type" value="data_pribadi">

                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Data Pribadi</h3>
                                <p class="text-sm text-gray-500 mt-1">Informasi dasar tentang diri Anda</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama (Username) -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama (Username) <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Nama Lengkap -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $alumni->nama_lengkap) }}" required 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                    placeholder="Nama lengkap sesuai KTP">
                                @error('nama_lengkap') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- No Handphone -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">No Handphone</label>
                                <input type="text" name="no_hp" value="{{ old('no_hp', $alumni->no_hp) }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                    placeholder="08xxxxxxxxxx">
                                @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- NIK -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">NIK</label>
                                <input type="text" name="nik" value="{{ old('nik', $alumni->nik) }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                    placeholder="16 digit NIK">
                                @error('nik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Tempat Lahir -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $alumni->tempat_lahir) }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('tempat_lahir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $alumni->tanggal_lahir) }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('tanggal_lahir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $alumni->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $alumni->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Kota -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kota</label>
                                <input type="text" name="kota" value="{{ old('kota', $alumni->kota) }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('kota') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Provinsi -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Provinsi</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi', $alumni->provinsi) }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('provinsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Kode Pos -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Pos</label>
                                <input type="text" name="kode_pos" value="{{ old('kode_pos', $alumni->kode_pos) }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('kode_pos') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Nama Bank -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Bank</label>
                                <input type="text" name="nama_bank" value="{{ old('nama_bank', $alumni->nama_bank) }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                    placeholder="Contoh: BCA, Mandiri">
                                @error('nama_bank') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- No Rekening -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">No Rekening</label>
                                <input type="text" name="no_rekening" value="{{ old('no_rekening', $alumni->no_rekening) }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('no_rekening') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea name="alamat" rows="3" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                placeholder="Masukkan alamat lengkap Anda">{{ old('alamat', $alumni->alamat) }}</textarea>
                            @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Tentang Saya -->
                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tentang Saya</label>
                            <textarea name="tentang_saya" rows="4" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                placeholder="Ceritakan tentang diri Anda...">{{ old('tentang_saya', $alumni->tentang_saya) }}</textarea>
                            @error('tentang_saya') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200">
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                                Simpan Data Pribadi
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Data Akademik -->
                <div id="data-akademik" class="tab-content hidden bg-white rounded-b-xl shadow-sm border border-gray-100 p-8">
                    <form method="POST" action="{{ route('alumni.profile.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="form_type" value="data_akademik">

                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Data Akademik</h3>
                                <p class="text-sm text-gray-500 mt-1">Riwayat pendidikan dan keahlian Anda</p>
                            </div>
                        </div>

                        <!-- Info Akademik -->
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded">
                            <p class="text-sm text-blue-800">Pastikan informasi akademik terisi dengan benar untuk mempermudah proses pendaftaran</p>
                        </div>

                        <!-- Program Studi -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Program Studi
                            </label>
                            <select name="program_studi_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                <option value="">Pilih Program Studi</option>
                                @foreach($programStudis as $prodi)
                                    <option value="{{ $prodi->id }}" {{ old('program_studi_id', $alumni->program_studi_id) == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->program_studi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('program_studi_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>


                        {{-- Riwayat Pendidikan --}}
                        <div class="mt-10">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                    </svg>
                                    <h4 class="text-lg font-bold text-gray-800">Riwayat Pendidikan</h4>
                                </div>
                                <button type="button" onclick="openPendidikanModal()" 
                                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span>Tambah Pendidikan</span>
                                </button>
                            </div>

                            <div id="pendidikan-list" class="space-y-3 mb-8">
                                @if(isset($riwayatPendidikan) && $riwayatPendidikan->count() > 0)
                                    @foreach($riwayatPendidikan as $pendidikan)
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h5 class="font-semibold text-gray-900">{{ $pendidikan->strata }} di {{ $pendidikan->nama_sekolah }}</h5>
                                                @if($pendidikan->program_studi)
                                                <p class="text-sm text-gray-600">{{ $pendidikan->program_studi }}</p>
                                                @endif
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ \Carbon\Carbon::parse($pendidikan->mulai_berlaku)->format('Y') }} - 
                                                    {{ $pendidikan->selesai_berlaku ? \Carbon\Carbon::parse($pendidikan->selesai_berlaku)->format('Y') : 'Sekarang' }}
                                                </p>
                                                @if($pendidikan->deskripsi)
                                                <p class="text-sm text-gray-600 mt-2">{{ $pendidikan->deskripsi }}</p>
                                                @endif
                                            </div>
                                            <div class="flex space-x-2 ml-4">
                                                <button type="button" onclick="editPendidikan({{ $pendidikan->id }})" 
                                                    class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </button>
                                                <button type="button" onclick="deletePendidikan({{ $pendidikan->id }})" 
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <p class="text-gray-500 text-center py-8">Belum ada riwayat pendidikan yang ditambahkan.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Pengalaman Kerja/Organisasi Section -->
                        <div class="mt-10">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <h4 class="text-lg font-bold text-gray-800">Pengalaman Kerja & Organisasi</h4>
                                </div>
                                <button type="button" onclick="openPengalamanModal()" 
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span>Tambah Pengalaman</span>
                                </button>
                            </div>

                            <div id="pengalaman-list" class="space-y-3 mb-8">
                                @if(isset($pengalamanKerja) && $pengalamanKerja->count() > 0)
                                    @foreach($pengalamanKerja as $pengalaman)
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h5 class="font-semibold text-gray-900">{{ $pengalaman->posisi }}</h5>
                                                <p class="text-sm text-gray-600">{{ $pengalaman->perusahaan_organisasi }}</p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    <span class="font-medium">{{ $pengalaman->type == 'organisasi' ? 'Organisasi' : 'Perusahaan' }}</span> • 
                                                    {{ \Carbon\Carbon::parse($pengalaman->mulai_kerja)->format('M Y') }} - 
                                                    {{ $pengalaman->selesai_kerja ? \Carbon\Carbon::parse($pengalaman->selesai_kerja)->format('M Y') : 'Sekarang' }}
                                                </p>
                                                @if($pengalaman->deskripsi_piri)
                                                <p class="text-sm text-gray-600 mt-2">{{ Str::limit($pengalaman->deskripsi_piri, 100) }}</p>
                                                @endif
                                            </div>
                                            <div class="flex space-x-2 ml-4">
                                                <button type="button" onclick="editPengalaman({{ $pengalaman->id }})" 
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </button>
                                                <button type="button" onclick="deletePengalaman({{ $pengalaman->id }})" 
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                <div class="text-center py-8 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-gray-500 text-sm">Belum ada pengalaman kerja atau organisasi</p>
                                    <p class="text-gray-400 text-xs mt-1">Klik tombol "Tambah Pengalaman" untuk menambahkan</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Lisensi dan Sertifikasi Section -->
                        <div class="mt-10">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                    <h4 class="text-lg font-bold text-gray-800">Lisensi & Sertifikasi</h4>
                                </div>
                                <button type="button" onclick="openSertifikasiModal()" 
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span>Tambah Sertifikasi</span>
                                </button>
                            </div>

                            <div id="sertifikasi-list" class="space-y-3 mb-8">
                                @if(isset($sertifikasi) && $sertifikasi->count() > 0)
                                    @foreach($sertifikasi as $cert)
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h5 class="font-semibold text-gray-900">{{ $cert->nama_sertifikasi }}</h5>
                                                <p class="text-sm text-gray-600">{{ $cert->lembaga_sertifikasi }}</p>
                                                <div class="flex items-center space-x-3 mt-2 text-xs text-gray-500">
                                                    <span>{{ \Carbon\Carbon::parse($cert->mulai_berlaku)->format('M Y') }}</span>
                                                    @if($cert->selesai_berlaku)
                                                    <span>-</span>
                                                    <span>{{ \Carbon\Carbon::parse($cert->selesai_berlaku)->format('M Y') }}</span>
                                                    @else
                                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Tidak Kadaluarsa</span>
                                                    @endif
                                                </div>
                                                @if($cert->deskripsi)
                                                <p class="text-sm text-gray-600 mt-2">{{ Str::limit($cert->deskripsi, 100) }}</p>
                                                @endif
                                            </div>
                                            <div class="flex space-x-2 ml-4">
                                                <button type="button" onclick="editSertifikasi({{ $cert->id }})" 
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </button>
                                                <button type="button" onclick="deleteSertifikasi({{ $cert->id }})" 
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                <div class="text-center py-8 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                    <p class="text-gray-500 text-sm">Belum ada lisensi atau sertifikasi</p>
                                    <p class="text-gray-400 text-xs mt-1">Klik tombol "Tambah Sertifikasi" untuk menambahkan</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Keahlian Section -->
                        <div class="mt-10">
                            <div class="flex items-center space-x-2 mb-6">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                <h4 class="text-lg font-bold text-gray-800">Keahlian & Kompetensi</h4>
                            </div>

                            <!-- Hard Skills -->
                            <div class="mb-8">
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    Hard Skills
                                    <span class="text-xs font-normal text-gray-500 ml-2">(Keahlian teknis yang Anda kuasai)</span>
                                </label>
                                <div class="space-y-3" id="hard-skills-container">
                                    @if($alumni->keahlian && trim($alumni->keahlian))
                                        @php
                                            $hardSkills = array_filter(array_map('trim', explode(',', $alumni->keahlian)));
                                        @endphp
                                        @foreach($hardSkills as $skill)
                                        <div class="flex items-center space-x-2 skill-item">
                                            <input type="text" name="hard_skills[]" value="{{ $skill }}" 
                                                class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                                placeholder="Contoh: Laravel, React, UI/UX Design">
                                            <button type="button" onclick="removeSkill(this)" 
                                                class="px-4 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center space-x-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </div>
                                        @endforeach
                                    @else
                                    <div class="flex items-center space-x-2 skill-item">
                                        <input type="text" name="hard_skills[]" 
                                            class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                            placeholder="Contoh: Laravel, React, UI/UX Design">
                                        <button type="button" onclick="removeSkill(this)" 
                                            class="px-4 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            <span>Hapus</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <button type="button" onclick="addHardSkill()" 
                                    class="mt-3 px-5 py-2.5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span>Tambah Hard Skill</span>
                                </button>
                            </div>

                            <!-- Soft Skills -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    Soft Skills
                                    <span class="text-xs font-normal text-gray-500 ml-2">(Kemampuan interpersonal Anda)</span>
                                </label>
                                <div class="space-y-3" id="soft-skills-container">
                                    @if($alumni->soft_skills && trim($alumni->soft_skills))
                                        @php
                                            $softSkills = array_filter(array_map('trim', explode(',', $alumni->soft_skills)));
                                        @endphp
                                        @foreach($softSkills as $skill)
                                        <div class="flex items-center space-x-2 skill-item">
                                            <input type="text" name="soft_skills[]" value="{{ $skill }}" 
                                                class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                                placeholder="Contoh: Komunikasi, Kerja Tim, Problem Solving">
                                            <button type="button" onclick="removeSkill(this)" 
                                                class="px-4 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center space-x-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </div>
                                        @endforeach
                                    @else
                                    <div class="flex items-center space-x-2 skill-item">
                                        <input type="text" name="soft_skills[]" 
                                            class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                            placeholder="Contoh: Komunikasi, Kerja Tim, Problem Solving">
                                        <button type="button" onclick="removeSkill(this)" 
                                            class="px-4 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            <span>Hapus</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <button type="button" onclick="addSoftSkill()" 
                                    class="mt-3 px-5 py-2.5 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span>Tambah Soft Skill</span>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200">
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                                Simpan Data Akademik
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Data Keluarga -->
                <div id="data-keluarga" class="tab-content hidden bg-white rounded-b-xl shadow-sm border border-gray-100 p-8">
                    <form method="POST" action="{{ route('alumni.profile.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="form_type" value="data_keluarga">

                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Data Keluarga</h3>
                                <p class="text-sm text-gray-500 mt-1">Informasi tentang keluarga Anda</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Ayah -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ayah</label>
                                <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $dataKeluarga->nama_ayah ?? '') }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('nama_ayah') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Pekerjaan Ayah -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $dataKeluarga->pekerjaan_ayah ?? '') }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('pekerjaan_ayah') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Nama Ibu -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ibu</label>
                                <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $dataKeluarga->nama_ibu ?? '') }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('nama_ibu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Pekerjaan Ibu -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $dataKeluarga->pekerjaan_ibu ?? '') }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('pekerjaan_ibu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Nama Wali -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Wali
                                    <span class="text-xs font-normal text-gray-500">(Opsional)</span>
                                </label>
                                <input type="text" name="nama_wali" value="{{ old('nama_wali', $dataKeluarga->nama_wali ?? '') }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('nama_wali') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Pekerjaan Wali -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Pekerjaan Wali
                                    <span class="text-xs font-normal text-gray-500">(Opsional)</span>
                                </label>
                                <input type="text" name="pekerjaan_wali" value="{{ old('pekerjaan_wali', $dataKeluarga->pekerjaan_wali ?? '') }}" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('pekerjaan_wali') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Jumlah Saudara -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Saudara Kandung</label>
                                <input type="number" name="jumlah_saudara" value="{{ old('jumlah_saudara', $dataKeluarga->jumlah_saudara ?? '') }}" 
                                    min="0" max="20"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                @error('jumlah_saudara') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Alamat Keluarga -->
                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Keluarga</label>
                            <textarea name="alamat_keluarga" rows="3" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                placeholder="Masukkan alamat lengkap keluarga">{{ old('alamat_keluarga', $dataKeluarga->alamat_keluarga ?? '') }}</textarea>
                            @error('alamat_keluarga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200">
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                                Simpan Data Keluarga
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal riwayat pendidikan --}}
<div id="pendidikanModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between rounded-t-xl">
            <h3 id="modalTitle" class="text-xl font-bold text-gray-900">Tambah Riwayat Pendidikan</h3>
            <button type="button" onclick="closePendidikanModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="pendidikanForm" method="POST" action="{{ route('alumni.pendidikan.store') }}" class="p-6">
            @csrf
            <input type="hidden" id="pendidikan_id" name="pendidikan_id">
            <input type="hidden" id="form_method" name="_method" value="POST">
            
            <div class="space-y-4">
                {{-- Nama Sekolah/Universitas --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Sekolah/Universitas <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_sekolah" id="nama_sekolah" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        placeholder="Contoh: Universitas Indonesia">
                </div>

                {{-- Program Studi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Program Studi / Jurusan
                    </label>
                    <input type="text" name="program_studi" id="program_studi_pendidikan"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        placeholder="Contoh: Teknik Informatika">
                </div>

                {{-- Strata Pendidikan --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Strata Pendidikan <span class="text-red-500">*</span>
                    </label>
                    <select name="strata" id="strata" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">Pilih Strata Pendidikan</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">Sarjana (S1)</option>
                        <option value="S2">Magister (S2)</option>
                        <option value="S3">Doktor (S3)</option>
                    </select>
                </div>

                {{-- Tanggal Mulai dan Selesai --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tahun Masuk <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tahun_masuk" id="tahun_masuk" required 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tahun Lulus / Selesai
                        </label>
                        <input type="date" name="tahun_lulus" id="tahun_lulus" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika masih bersekolah</p>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        placeholder="Jelaskan jurusan, prestasi, atau kegiatan yang diikuti..."></textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                <button type="button" onclick="closePendidikanModal()" 
                    class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                    Batal
                </button>
                <button type="submit" 
                    class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Pengalaman Kerja/Organisasi -->
<div id="pengalamanModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between rounded-t-xl">
            <h3 class="text-xl font-bold text-gray-900">Tambah Pengalaman Kerja/Organisasi</h3>
            <button type="button" onclick="closePengalamanModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <form id="pengalamanForm" method="POST" action="{{ route('alumni.pengalaman.store') }}" class="p-6">
            @csrf
            <input type="hidden" id="pengalaman_id" name="pengalaman_id">
            
            <div class="space-y-4">
                <!-- Type -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tipe <span class="text-red-500">*</span>
                    </label>
                    <select name="type" id="pengalaman_type" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Tipe</option>
                        <option value="organisasi">Organisasi</option>
                        <option value="perusahaan">Perusahaan</option>
                    </select>
                </div>

                <!-- Perusahaan/Organisasi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Perusahaan/Organisasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="perusahaan_organisasi" id="perusahaan_organisasi" required 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh: PT Teknologi Indonesia / HMTI">
                </div>

                <!-- Posisi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Posisi/Jabatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="posisi" id="posisi" required 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh: Web Developer / Ketua Divisi">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Mulai Kerja -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Mulai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="mulai_kerja" id="mulai_kerja" required 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Selesai Kerja -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Selesai
                        </label>
                        <input type="date" name="selesai_kerja" id="selesai_kerja" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <label class="flex items-center mt-2">
                            <input type="checkbox" id="masih_bekerja" class="rounded text-blue-600 mr-2">
                            <span class="text-sm text-gray-600">Masih bekerja/aktif di sini</span>
                        </label>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Pekerjaan</label>
                    <textarea name="deskripsi_piri" id="deskripsi_piri" rows="4" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Jelaskan tanggung jawab dan pencapaian Anda..."></textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                <button type="button" onclick="closePengalamanModal()" 
                    class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                    Batal
                </button>
                <button type="submit" 
                    class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors">
                    Simpan Pengalaman
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Sertifikasi -->
<div id="sertifikasiModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between rounded-t-xl">
            <h3 class="text-xl font-bold text-gray-900">Tambah Lisensi/Sertifikasi</h3>
            <button type="button" onclick="closeSertifikasiModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <form id="sertifikasiForm" method="POST" action="{{ route('alumni.sertifikasi.store') }}" class="p-6">
            @csrf
            <input type="hidden" id="sertifikasi_id" name="sertifikasi_id">
            
            <div class="space-y-4">
                <!-- Nama Sertifikasi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Sertifikasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_sertifikasi" id="nama_sertifikasi" required 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh: AWS Certified Solutions Architect">
                </div>

                <!-- Lembaga Sertifikasi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Lembaga Penerbit <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="lembaga_sertifikasi" id="lembaga_sertifikasi" required 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh: Amazon Web Services">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Mulai Berlaku -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Terbit <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="mulai_berlaku" id="mulai_berlaku" required 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Selesai Berlaku -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Kadaluarsa
                        </label>
                        <input type="date" name="selesai_berlaku" id="selesai_berlaku" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <label class="flex items-center mt-2">
                            <input type="checkbox" id="tidak_kadaluarsa" class="rounded text-blue-600 mr-2">
                            <span class="text-sm text-gray-600">Tidak memiliki tanggal kadaluarsa</span>
                        </label>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi_sertifikasi" rows="4" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Jelaskan tentang sertifikasi ini..."></textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeSertifikasiModal()" 
                    class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                    Batal
                </button>
                <button type="submit" 
                    class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors">
                    Simpan Sertifikasi
                </button>
            </div>
        </form>
    </div>
</div>

<style>
@keyframes slide-in {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.animate-slide-in {
    animation: slide-in 0.3s ease-out;
}

.skill-item {
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
// Tab Switching
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.dataset.tab;

            // Remove active classes from all buttons
            tabButtons.forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('text-gray-600', 'hover:bg-gray-50');
            });

            // Add active class to clicked button
            this.classList.add('bg-blue-600', 'text-white');
            this.classList.remove('text-gray-600', 'hover:bg-gray-50');

            // Hide all tab contents
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });

            // Show target tab content
            const targetContent = document.getElementById(targetTab);
            if (targetContent) {
                targetContent.classList.remove('hidden');
            }
        });
    });

    // Auto-hide notifications after 5 seconds
    setTimeout(() => {
        const notifications = document.querySelectorAll('.animate-slide-in');
        notifications.forEach(notif => {
            notif.style.transition = 'opacity 0.5s';
            notif.style.opacity = '0';
            setTimeout(() => notif.remove(), 500);
        });
    }, 5000);
});

// Hard Skills Management
function addHardSkill() {
    const container = document.getElementById('hard-skills-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2 skill-item';
    div.innerHTML = `
        <input type="text" name="hard_skills[]" 
            class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
            placeholder="Contoh: Laravel, React, UI/UX Design">
        <button type="button" onclick="removeSkill(this)" 
            class="px-4 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center space-x-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            <span>Hapus</span>
        </button>
    `;
    container.appendChild(div);
}

// Soft Skills Management
function addSoftSkill() {
    const container = document.getElementById('soft-skills-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2 skill-item';
    div.innerHTML = `
        <input type="text" name="soft_skills[]" 
            class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
            placeholder="Contoh: Komunikasi, Kerja Tim, Problem Solving">
        <button type="button" onclick="removeSkill(this)" 
            class="px-4 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center space-x-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            <span>Hapus</span>
        </button>
    `;
    container.appendChild(div);
}

// Remove Skill
function removeSkill(button) {
    const container = button.closest('.skill-item');
    container.style.transition = 'opacity 0.3s, transform 0.3s';
    container.style.opacity = '0';
    container.style.transform = 'translateX(-20px)';
    setTimeout(() => container.remove(), 300);
}

// ===== Riwayat Pendidikan Modal Functions =====
function openPendidikanModal() {
    const modal = document.getElementById('pendidikanModal');
    const form = document.getElementById('pendidikanForm');
    const modalTitle = document.getElementById('modalTitle');
    
    // Reset form
    form.reset();
    document.getElementById('pendidikan_id').value = '';
    form.action = '{{ route("alumni.pendidikan.store") }}';
    modalTitle.textContent = 'Tambah Riwayat Pendidikan';
    
    // Show modal dengan flex
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closePendidikanModal() {
    const modal = document.getElementById('pendidikanModal');
    
    // Hide modal
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    
    // Allow body scroll
    document.body.style.overflow = 'auto';
}

function editPendidikan(id) {
    fetch(`/alumni/pendidikan/${id}/edit`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        // Fill form with data
        document.getElementById('pendidikan_id').value = data.id;
        document.getElementById('nama_sekolah').value = data.nama_sekolah;
        document.getElementById('program_studi_pendidikan').value = data.program_studi || '';
        document.getElementById('strata').value = data.strata;
        document.getElementById('tahun_masuk').value = data.tahun_masuk;
        document.getElementById('tahun_lulus').value = data.tahun_lulus || '';
        document.getElementById('deskripsi').value = data.deskripsi || '';
        
        // Change modal title
        document.getElementById('modalTitle').textContent = 'Edit Riwayat Pendidikan';
        
        // Open modal
        openPendidikanModal();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal memuat data pendidikan. Silakan coba lagi.');
    });
}

function deletePendidikan(id) {
    if (confirm('Apakah Anda yakin ingin menghapus riwayat pendidikan ini?')) {
        fetch(`/alumni/pendidikan/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Gagal menghapus riwayat pendidikan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus riwayat pendidikan');
        });
    }
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('pendidikanModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closePendidikanModal();
            }
        });
    }
    
    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePendidikanModal();
        }
    });
});

// ===== Pengalaman Kerja/Organisasi Modal Functions =====
function openPengalamanModal() {
    document.getElementById('pengalamanModal').classList.remove('hidden');
    document.getElementById('pengalamanForm').reset();
    document.getElementById('pengalaman_id').value = '';
    document.body.style.overflow = 'hidden';
}

function closePengalamanModal() {
    document.getElementById('pengalamanModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function editPengalaman(id) {
    // Fetch data via AJAX
    fetch(`/alumni/pengalaman/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('pengalaman_id').value = data.id;
            document.getElementById('pengalaman_type').value = data.type;
            document.getElementById('perusahaan_organisasi').value = data.perusahaan_organisasi;
            document.getElementById('posisi').value = data.posisi;
            document.getElementById('mulai_kerja').value = data.mulai_kerja;
            document.getElementById('selesai_kerja').value = data.selesai_kerja || '';
            document.getElementById('deskripsi_piri').value = data.deskripsi_piri || '';
            
            if (!data.selesai_kerja) {
                document.getElementById('masih_bekerja').checked = true;
                document.getElementById('selesai_kerja').disabled = true;
            }
            
            openPengalamanModal();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memuat data pengalaman');
        });
}

function deletePengalaman(id) {
    if (confirm('Apakah Anda yakin ingin menghapus pengalaman ini?')) {
        fetch(`/alumni/pengalaman/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal menghapus pengalaman');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus pengalaman');
        });
    }
}

// Handle "Masih Bekerja" checkbox
document.addEventListener('DOMContentLoaded', function() {
    const masihBekerjaCheckbox = document.getElementById('masih_bekerja');
    const selesaiKerjaInput = document.getElementById('selesai_kerja');
    
    if (masihBekerjaCheckbox) {
        masihBekerjaCheckbox.addEventListener('change', function() {
            if (this.checked) {
                selesaiKerjaInput.value = '';
                selesaiKerjaInput.disabled = true;
                selesaiKerjaInput.classList.add('bg-gray-100');
            } else {
                selesaiKerjaInput.disabled = false;
                selesaiKerjaInput.classList.remove('bg-gray-100');
            }
        });
    }
});

// ===== Sertifikasi Modal Functions =====
function openSertifikasiModal() {
    document.getElementById('sertifikasiModal').classList.remove('hidden');
    document.getElementById('sertifikasiForm').reset();
    document.getElementById('sertifikasi_id').value = '';
    document.body.style.overflow = 'hidden';
}

function closeSertifikasiModal() {
    document.getElementById('sertifikasiModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function editSertifikasi(id) {
    // Fetch data via AJAX
    fetch(`/alumni/sertifikasi/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('sertifikasi_id').value = data.id;
            document.getElementById('nama_sertifikasi').value = data.nama_sertifikasi;
            document.getElementById('lembaga_sertifikasi').value = data.lembaga_sertifikasi;
            document.getElementById('mulai_berlaku').value = data.mulai_berlaku;
            document.getElementById('selesai_berlaku').value = data.selesai_berlaku || '';
            document.getElementById('deskripsi_sertifikasi').value = data.deskripsi || '';
            
            if (!data.selesai_berlaku) {
                document.getElementById('tidak_kadaluarsa').checked = true;
                document.getElementById('selesai_berlaku').disabled = true;
            }
            
            openSertifikasiModal();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memuat data sertifikasi');
        });
}

function deleteSertifikasi(id) {
    if (confirm('Apakah Anda yakin ingin menghapus sertifikasi ini?')) {
        fetch(`/alumni/sertifikasi/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal menghapus sertifikasi');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus sertifikasi');
        });
    }
}

// Handle "Tidak Kadaluarsa" checkbox
document.addEventListener('DOMContentLoaded', function() {
    const tidakKadaluarsaCheckbox = document.getElementById('tidak_kadaluarsa');
    const selesaiBerlakuInput = document.getElementById('selesai_berlaku');
    
    if (tidakKadaluarsaCheckbox) {
        tidakKadaluarsaCheckbox.addEventListener('change', function() {
            if (this.checked) {
                selesaiBerlakuInput.value = '';
                selesaiBerlakuInput.disabled = true;
                selesaiBerlakuInput.classList.add('bg-gray-100');
            } else {
                selesaiBerlakuInput.disabled = false;
                selesaiBerlakuInput.classList.remove('bg-gray-100');
            }
        });
    }
});

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const pengalamanModal = document.getElementById('pengalamanModal');
    const sertifikasiModal = document.getElementById('sertifikasiModal');
    
    if (pengalamanModal) {
        pengalamanModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closePengalamanModal();
            }
        });
    }
    
    if (sertifikasiModal) {
        sertifikasiModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeSertifikasiModal();
            }
        });
    }
    
    // Handle ESC key to close modals
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePengalamanModal();
            closeSertifikasiModal();
        }
    });
});
</script>
@endsection