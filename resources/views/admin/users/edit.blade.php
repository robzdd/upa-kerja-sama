@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto animate-fade-in">
    <!-- Header with gradient -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-2">
            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Edit User</h2>
                <p class="text-gray-600">Perbarui informasi pengguna</p>
            </div>
        </div>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')
            
            <div class="p-8 space-y-8">
                <!-- User Type Badge -->
                <div class="flex items-center space-x-3 p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border border-blue-100">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tipe User</p>
                        <p class="text-lg font-bold text-gray-900">
                            @if($type === 'alumni')
                                👨‍🎓 Alumni
                            @elseif($type === 'mitra')
                                🏢 Mitra Perusahaan
                            @else
                                User
                            @endif
                        </p>
                    </div>
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
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300">
                        </div>
                        <div class="group">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300">
                        </div>
                        <div class="group">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" id="password" name="password"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300"
                                   placeholder="Minimal 8 karakter">
                        </div>
                        <div class="group">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300"
                                   placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                <!-- Alumni Fields -->
                @if($type === 'alumni' && $user->alumni)
                    <div class="border-t-2 border-gray-100 pt-6">
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
                                <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                                <input type="text" id="nim" name="nim" value="{{ old('nim', $user->alumni->nim) }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300">
                            </div>
                            <div class="group">
                                <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP</label>
                                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->alumni->no_hp) }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300">
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Mitra Fields -->
                @if($type === 'mitra' && $user->mitraPerusahaan)
                    <div class="border-t-2 border-gray-100 pt-6">
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
                                <input type="text" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan', $user->mitraPerusahaan->nama_perusahaan) }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300">
                            </div>
                            <div class="group">
                                <label for="sektor" class="block text-sm font-medium text-gray-700 mb-2">Sektor Industri</label>
                                <input type="text" id="sektor" name="sektor" value="{{ old('sektor', $user->mitraPerusahaan->sektor) }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300">
                            </div>
                        </div>
                    </div>
                @endif
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
                        class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-medium hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Perubahan
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
    .animate-fade-in {
        animation: fade-in 0.5s ease-out;
    }
</style>
@endsection
