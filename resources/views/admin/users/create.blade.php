@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto animate-fade-in">
    <!-- Header with gradient -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-2">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Tambah User Baru</h2>
                <p class="text-gray-600">Buat akun pengguna baru untuk sistem</p>
            </div>
        </div>
    </div>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-xl p-4 shadow-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form:</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-xl p-4 shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif


    <!-- Main Form Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
        <form method="POST" action="{{ route('admin.users.store') }}" id="createUserForm">
            @csrf
            
            <div class="p-8 space-y-8">
                <!-- Type Selection with Animation -->
                <div class="transform transition-all duration-300 hover:scale-[1.01]">
                    <label for="type" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Tipe User
                    </label>
                    <select id="type" name="type" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 bg-gradient-to-r from-white to-gray-50 hover:border-blue-300"
                            onchange="toggleFields()">
                        <option value="alumni" {{ (old('type', $type) === 'alumni') ? 'selected' : '' }}>👨‍🎓 Alumni</option>
                        <option value="mitra" {{ (old('type', $type) === 'mitra') ? 'selected' : '' }}>🏢 Mitra Perusahaan</option>
                    </select>
                </div>

                <!-- Basic Info Section -->
                <div class="border-t-2 border-gray-100 pt-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                        Informasi Dasar
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300"
                                   placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="group">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300"
                                   placeholder="email@example.com">
                        </div>
                        <div class="group">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password" id="password" name="password" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300"
                                   placeholder="Minimal 8 karakter">
                        </div>
                        <div class="group">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300"
                                   placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                <!-- Alumni Fields -->
                <div id="alumni-fields" class="{{ (old('type', $type) === 'alumni') ? 'animate-slide-down' : 'hidden' }} border-t-2 border-gray-100 pt-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            </svg>
                        </span>
                        Informasi Alumni
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="program_studi_id" class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                            <select id="program_studi_id" name="program_studi_id"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300">
                                <option value="">Pilih Program Studi</option>
                                @foreach($programStudi as $prodi)
                                    <option value="{{ $prodi->id }}" {{ old('program_studi_id') == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->program_studi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="group">
                            <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                            <input type="text" id="nim" name="nim" value="{{ old('nim') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300"
                                   placeholder="Nomor Induk Mahasiswa">
                        </div>
                        <div class="group md:col-span-2">
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP</label>
                            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300"
                                   placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                </div>

                <!-- Mitra Fields -->
                <div id="mitra-fields" class="{{ (old('type', $type) === 'mitra') ? 'animate-slide-down' : 'hidden' }} border-t-2 border-gray-100 pt-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </span>
                        Informasi Mitra Perusahaan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700 mb-2">Nama Perusahaan</label>
                            <input type="text" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300"
                                   placeholder="PT. Nama Perusahaan">
                        </div>
                        <div class="group">
                            <label for="sektor" class="block text-sm font-medium text-gray-700 mb-2">Sektor Industri</label>
                            <input type="text" id="sektor" name="sektor" value="{{ old('sektor') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300"
                                   placeholder="Teknologi, Manufaktur, dll">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="group">
                            <label for="mulai_kerjasama" class="block text-sm font-medium text-gray-700 mb-2">Mulai Kerjasama</label>
                            <input type="date" id="mulai_kerjasama" name="mulai_kerjasama" value="{{ old('mulai_kerjasama') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300">
                        </div>
                        <div class="group">
                            <label for="akhir_kerjasama" class="block text-sm font-medium text-gray-700 mb-2">Akhir Kerjasama</label>
                            <input type="date" id="akhir_kerjasama" name="akhir_kerjasama" value="{{ old('akhir_kerjasama') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200 flex items-center justify-end space-x-4">
                <a href="{{ route('admin.users.index') }}"
                   class="px-6 py-3 border-2 border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-100 hover:border-gray-400 transition-all duration-200 transform hover:scale-105">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </span>
                </a>
                <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan User
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slide-down {
        from { opacity: 0; max-height: 0; }
        to { opacity: 1; max-height: 500px; }
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out;
    }
    .animate-slide-down {
        animation: slide-down 0.4s ease-out;
    }
</style>

<script>
    function toggleFields() {
        const type = document.getElementById('type').value;
        const alumniFields = document.getElementById('alumni-fields');
        const mitraFields = document.getElementById('mitra-fields');

        if (type === 'alumni') {
            alumniFields.classList.remove('hidden');
            alumniFields.classList.add('animate-slide-down');
            mitraFields.classList.add('hidden');
            mitraFields.classList.remove('animate-slide-down');
        } else if (type === 'mitra') {
            alumniFields.classList.add('hidden');
            alumniFields.classList.remove('animate-slide-down');
            mitraFields.classList.remove('hidden');
            mitraFields.classList.add('animate-slide-down');
        }
    }

    // Debug form submission
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('createUserForm');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                console.log('Form is submitting...');
                console.log('Form action:', form.action);
                console.log('Form method:', form.method);
                
                // Check if all required fields are filled
                const requiredFields = form.querySelectorAll('[required]');
                let allFilled = true;
                requiredFields.forEach(field => {
                    if (!field.value) {
                        console.log('Empty required field:', field.name);
                        allFilled = false;
                    }
                });
                
                if (!allFilled) {
                    console.log('Some required fields are empty');
                }
            });
        }
    });
</script>
@endsection
