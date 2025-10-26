@extends('alumni.layouts.app')

@section('title', 'Edit Profil')

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
                <!-- Back to Profile Button -->
                <a href="{{ route('alumni.profile') }}" class="w-full bg-gradient-to-r from-gray-500 to-gray-600 text-white font-semibold py-2 px-4 rounded-lg hover:from-gray-600 hover:to-gray-700 transition-all mb-4 inline-block text-center">
                    Kembali ke Profil
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
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Profil</h1>
                <p class="text-gray-600">Lengkapi dan perbarui informasi profil Anda</p>
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

            <!-- Data Pribadi Form -->
            <div id="data-pribadi" class="tab-content">
                <form method="POST" action="{{ route('alumni.profile.update') }}" class="bg-white rounded-lg shadow p-6">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="form_type" value="data_pribadi">

                    <h3 class="text-lg font-bold text-gray-800 mb-6">Data Pribadi</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No Handphone</label>
                                <input type="text" name="no_hp" value="{{ old('no_hp', $alumni->no_hp) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('no_hp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $alumni->tempat_lahir) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('tempat_lahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $alumni->tanggal_lahir) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('tanggal_lahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $alumni->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $alumni->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                <textarea name="alamat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alamat', $alumni->alamat) }}</textarea>
                                @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                                <input type="text" name="kota" value="{{ old('kota', $alumni->kota) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('kota') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi', $alumni->provinsi) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('provinsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                                <input type="text" name="kode_pos" value="{{ old('kode_pos', $alumni->kode_pos) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('kode_pos') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Bank</label>
                                <input type="text" name="nama_bank" value="{{ old('nama_bank', $alumni->nama_bank) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('nama_bank') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No Rekening</label>
                                <input type="text" name="no_rekening" value="{{ old('no_rekening', $alumni->no_rekening) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('no_rekening') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tentang Saya</label>
                        <textarea name="tentang_saya" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('tentang_saya', $alumni->tentang_saya) }}</textarea>
                        @error('tentang_saya') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                            Simpan Data Pribadi
                        </button>
                    </div>
                </form>
            </div>

            <!-- Data Akademik Form -->
            <div id="data-akademik" class="tab-content hidden">
                <form method="POST" action="{{ route('alumni.profile.update') }}" class="bg-white rounded-lg shadow p-6">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="form_type" value="data_akademik">

                    <h3 class="text-lg font-bold text-gray-800 mb-6">Data Akademik</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                                <input type="text" name="nim" value="{{ old('nim', $dataAkademik->nim ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('nim') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                                <input type="text" name="program_studi" value="{{ old('program_studi', $dataAkademik->program_studi ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('program_studi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Masuk</label>
                                <input type="number" name="tahun_masuk" value="{{ old('tahun_masuk', $dataAkademik->tahun_masuk ?? '') }}" min="1900" max="{{ date('Y') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('tahun_masuk') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Lulus</label>
                                <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus', $dataAkademik->tahun_lulus ?? '') }}" min="1900" max="{{ date('Y') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('tahun_lulus') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">IPK</label>
                                <input type="number" name="ipk" value="{{ old('ipk', $dataAkademik->ipk ?? '') }}" step="0.01" min="0" max="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('ipk') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Universitas</label>
                                <input type="text" name="universitas" value="{{ old('universitas', $dataAkademik->universitas ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('universitas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Keahlian Section -->
                    <div class="mt-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Keahlian</h4>

                        <!-- Hard Skills -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Hard Skills</label>
                            <div class="space-y-2" id="hard-skills-container">
                                @if($alumni->keahlian)
                                    @php
                                        $hardSkills = explode(',', $alumni->keahlian);
                                    @endphp
                                    @foreach($hardSkills as $index => $skill)
                                        @if(trim($skill))
                                        <div class="flex items-center space-x-2">
                                            <input type="text" name="hard_skills[]" value="{{ trim($skill) }}" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan hard skill">
                                            <button type="button" onclick="removeSkill(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Hapus</button>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="hard_skills[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan hard skill">
                                    <button type="button" onclick="removeSkill(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Hapus</button>
                                </div>
                            </div>
                            <button type="button" onclick="addHardSkill()" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah Hard Skill</button>
                        </div>

                        <!-- Soft Skills -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Soft Skills</label>
                            <div class="space-y-2" id="soft-skills-container">
                                @if($alumni->soft_skills)
                                    @php
                                        $softSkills = explode(',', $alumni->soft_skills);
                                    @endphp
                                    @foreach($softSkills as $index => $skill)
                                        @if(trim($skill))
                                        <div class="flex items-center space-x-2">
                                            <input type="text" name="soft_skills[]" value="{{ trim($skill) }}" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan soft skill">
                                            <button type="button" onclick="removeSkill(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Hapus</button>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="soft_skills[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan soft skill">
                                    <button type="button" onclick="removeSkill(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Hapus</button>
                                </div>
                            </div>
                            <button type="button" onclick="addSoftSkill()" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Tambah Soft Skill</button>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                            Simpan Data Akademik
                        </button>
                    </div>
                </form>
            </div>

            <!-- Data Keluarga Form -->
            <div id="data-keluarga" class="tab-content hidden">
                <form method="POST" action="{{ route('alumni.profile.update') }}" class="bg-white rounded-lg shadow p-6">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="form_type" value="data_keluarga">

                    <h3 class="text-lg font-bold text-gray-800 mb-6">Data Keluarga</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ayah</label>
                                <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $dataKeluarga->nama_ayah ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('nama_ayah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $dataKeluarga->pekerjaan_ayah ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('pekerjaan_ayah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu</label>
                                <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $dataKeluarga->nama_ibu ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('nama_ibu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $dataKeluarga->pekerjaan_ibu ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('pekerjaan_ibu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Wali</label>
                                <input type="text" name="nama_wali" value="{{ old('nama_wali', $dataKeluarga->nama_wali ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('nama_wali') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Wali</label>
                                <input type="text" name="pekerjaan_wali" value="{{ old('pekerjaan_wali', $dataKeluarga->pekerjaan_wali ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('pekerjaan_wali') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Saudara</label>
                                <input type="number" name="jumlah_saudara" value="{{ old('jumlah_saudara', $dataKeluarga->jumlah_saudara ?? '') }}" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('jumlah_saudara') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Keluarga</label>
                        <textarea name="alamat_keluarga" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alamat_keluarga', $dataKeluarga->alamat_keluarga ?? '') }}</textarea>
                        @error('alamat_keluarga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                            Simpan Data Keluarga
                        </button>
                    </div>
                </form>
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

function addHardSkill() {
    const container = document.getElementById('hard-skills-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2';
    div.innerHTML = `
        <input type="text" name="hard_skills[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan hard skill">
        <button type="button" onclick="removeSkill(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Hapus</button>
    `;
    container.appendChild(div);
}

function addSoftSkill() {
    const container = document.getElementById('soft-skills-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2';
    div.innerHTML = `
        <input type="text" name="soft_skills[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan soft skill">
        <button type="button" onclick="removeSkill(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Hapus</button>
    `;
    container.appendChild(div);
}

function removeSkill(button) {
    button.parentElement.remove();
}
</script>
@endsection
