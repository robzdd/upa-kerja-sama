@extends('alumni.layouts.app')

@section('title', 'Pengaturan Keamanan')

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
                <a href="{{ route('alumni.profile.edit') }}" 
                   class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all mb-4 inline-block text-center">
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
                    <a href="{{ route('alumni.certificates') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors text-gray-700">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        <span class="text-sm font-medium">Sertifikat Magang</span>
                    </a>
                    <a href="{{ route('alumni.security.settings') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-blue-50 border-l-4 border-blue-600 text-blue-700 transition-colors">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span class="text-sm font-semibold">Pengaturan Keamanan</span>
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
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pengaturan Keamanan</h1>
        <p class="text-gray-600">Kelola keamanan akun dan informasi pribadi Anda</p>
    </div>

    <!-- Security Settings -->
    <div class="space-y-6">
        <!-- Password Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Kata Sandi</h3>
                        <p class="text-sm text-gray-600">Ubah kata sandi akun Anda</p>
                    </div>
                </div>
                <button onclick="togglePasswordForm()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                    Ubah Kata Sandi
                </button>
            </div>

            <!-- Password Form -->
            <div id="password-form" class="hidden border-t border-gray-200 pt-4">
                <form method="POST" action="{{ route('alumni.security.update-password') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi Lama</label>
                            <input type="password" name="current_password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi Baru</label>
                            <input type="password" name="new_password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="new_password_confirmation" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" onclick="togglePasswordForm()" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Profile Information Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Profil</h3>
                        <p class="text-sm text-gray-600">Kelola informasi pribadi Anda</p>
                    </div>
                </div>
                <button onclick="toggleProfileForm()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm">
                    Edit Profil
                </button>
            </div>

            <!-- Profile Form -->
            <div id="profile-form" class="hidden border-t border-gray-200 pt-4">
                <form method="POST" action="{{ route('alumni.security.update-profile') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ $user->alumni->nama_lengkap ?? $user->name }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No Handphone</label>
                            <input type="tel" name="no_hp" value="{{ $user->alumni->no_hp ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea name="alamat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ $user->alumni->alamat ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" onclick="toggleProfileForm()" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Privacy Settings Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Pengaturan Privasi</h3>
                    <p class="text-sm text-gray-600">Kelola visibilitas informasi Anda</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Profil Publik</h4>
                        <p class="text-sm text-gray-600">Izinkan orang lain melihat profil Anda</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">CV Publik</h4>
                        <p class="text-sm text-gray-600">Izinkan orang lain melihat CV Anda</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Notifikasi Email</h4>
                        <p class="text-sm text-gray-600">Terima notifikasi melalui email</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Account Security Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Zona Bahaya</h3>
                    <p class="text-sm text-gray-600">Aksi yang tidak dapat dibatalkan</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg">
                    <div>
                        <h4 class="text-sm font-medium text-red-900">Hapus Akun</h4>
                        <p class="text-sm text-red-700">Hapus akun dan semua data terkait secara permanen</p>
                    </div>
                    <button onclick="confirmDeleteAccount()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">
                        Hapus Akun
                    </button>
                </div>

                <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
                    <div>
                        <h4 class="text-sm font-medium text-yellow-900">Deaktivasi Akun</h4>
                        <p class="text-sm text-yellow-700">Nonaktifkan akun sementara tanpa menghapus data</p>
                    </div>
                    <button onclick="confirmDeactivateAccount()" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 text-sm">
                        Deaktivasi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePasswordForm() {
    const form = document.getElementById('password-form');
    form.classList.toggle('hidden');
}

function toggleProfileForm() {
    const form = document.getElementById('profile-form');
    form.classList.toggle('hidden');
}

function confirmDeleteAccount() {
    if (confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.')) {
        // Redirect to delete account route
        window.location.href = '{{ route("alumni.security.delete-account") }}';
    }
}

function confirmDeactivateAccount() {
    if (confirm('Apakah Anda yakin ingin menonaktifkan akun? Anda dapat mengaktifkannya kembali kapan saja.')) {
        // Redirect to deactivate account route
        window.location.href = '{{ route("alumni.security.deactivate-account") }}';
    }
}
</script>
@endsection
