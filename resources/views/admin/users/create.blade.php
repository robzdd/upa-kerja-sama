@extends('admin.layouts.app')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('css/admin-user-create.css') }}" rel="stylesheet" />

@section('content')
<div class="min-h-screen animated-bg py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold mb-2">
                <span class="bg-gradient-to-r from-purple-600 via-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Tambah User Baru
                </span>
            </h1>
            <p class="text-gray-600 text-sm">Lengkapi formulir di bawah untuk menambahkan pengguna baru</p>
        </div>

        <!-- Main Form Container -->
        <div class="glass-container rounded-2xl shadow-2xl p-8">
            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-8">
                @csrf

                <!-- Type Selection -->
                <div class="space-y-3">
                    <label for="type" class="block text-sm font-semibold text-gray-800">
                        Tipe User <span class="text-red-500">*</span>
                    </label>
                    <select id="type"
                            name="type"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Pilih Tipe User</option>
                        <option value="alumni" {{ old('type') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        <option value="mitra" {{ old('type') == 'mitra' ? 'selected' : '' }}>Mitra Perusahaan</option>
                        <option value="mahasiswa" {{ old('type') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    </select>
                </div>

                <!-- Basic Info Section -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="h-1 w-12 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full"></div>
                        <h3 class="text-xl font-bold section-header">Informasi Dasar</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-gray-800">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   placeholder="Masukkan nama lengkap"
                                   class="glass-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-semibold text-gray-800">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   placeholder="email@example.com"
                                   class="glass-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-semibold text-gray-800">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   required
                                   placeholder="Minimal 8 karakter"
                                   class="glass-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        </div>
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-800">
                                Konfirmasi Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   required
                                   placeholder="Ulangi password"
                                   class="glass-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        </div>
                    </div>
                </div>

                <!-- Alumni Fields -->
                <div id="alumni-fields" style="display: none;" class="space-y-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="h-1 w-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full"></div>
                        <h3 class="text-xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                            Informasi Alumni
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                <label for="nim_alumni" class="block text-sm font-semibold text-gray-800">NIM Alumni</label>
                <input type="text"
                    id="nim_alumni"
                    name="nim_alumni"
                    value="{{ old('nim_alumni') }}"
                    placeholder="Masukkan NIM Alumni"
                    class="glass-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        </div>
                        <div class="space-y-2">
                            <label for="no_hp" class="block text-sm font-semibold text-gray-800">No. HP</label>
                            <input type="text"
                                   id="no_hp"
                                   name="no_hp"
                                   value="{{ old('no_hp') }}"
                                   placeholder="08xxxxxxxxxx"
                                   class="glass-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        </div>
                    </div>
                </div>

                <!-- Mitra Fields -->
                <div id="mitra-fields" style="display: none;" class="space-y-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="h-1 w-12 bg-gradient-to-r from-orange-500 to-amber-600 rounded-full"></div>
                        <h3 class="text-xl font-bold bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent">
                            Informasi Mitra
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="nama_perusahaan" class="block text-sm font-semibold text-gray-800">Nama Perusahaan</label>
                            <input type="text"
                                   id="nama_perusahaan"
                                   name="nama_perusahaan"
                                   value="{{ old('nama_perusahaan') }}"
                                   placeholder="PT. Contoh Perusahaan"
                                   class="glass-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        </div>
                        <div class="space-y-2">
                            <label for="sektor" class="block text-sm font-semibold text-gray-800">Sektor</label>
                            <input type="text"
                                   id="sektor"
                                   name="sektor"
                                   value="{{ old('sektor') }}"
                                   placeholder="Teknologi, Finance, dll"
                                   class="glass-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        </div>
                    </div>
                </div>

                <!-- Mahasiswa Fields -->
                <div id="mahasiswa-fields" style="display: none;" class="space-y-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="h-1 w-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full"></div>
                        <h3 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Informasi Mahasiswa
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="program_studi_id" class="block text-sm font-semibold text-gray-800">Program Studi</label>
                            <select id="program_studi_id"
                                    name="program_studi_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                <option value="">Pilih Program Studi</option>
                                @foreach($programStudi as $prodi)
                                    <option value="{{ $prodi->id }}" {{ old('program_studi_id') == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->program_studi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="nim_mhs" class="block text-sm font-semibold text-gray-800">NIM</label>
                            <input type="text"
                                   id="nim_mhs"
                                   name="nim"
                                   value="{{ old('nim') }}"
                                   placeholder="Masukkan NIM"
                                   class="glass-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        </div>
                        <div class="space-y-2">
                            <label for="angkatan" class="block text-sm font-semibold text-gray-800">Angkatan</label>
                            <input type="text"
                                   id="angkatan"
                                   name="angkatan"
                                   value="{{ old('angkatan') }}"
                                   placeholder="2024"
                                   class="glass-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end space-x-4 pt-8 border-t border-gray-200/50">
                    <a href="{{ route('admin.users.index') }}"
                       class="btn-secondary px-8 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition-all duration-300">
                        Batal
                    </a>
                    <button type="submit"
                            class="btn-primary px-8 py-3  rounded-xl font-semibold transition-all duration-300">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/admin-user-create.js') }}"></script>
@endpush
