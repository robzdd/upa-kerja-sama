@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto animate-fade-in">
    <!-- Breadcrumb -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 transition">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit Profile</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Success Alert -->
    @if(session('success'))
        <div id="success-alert" class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl p-4 shadow-lg animate-slide-in">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="ml-3 text-sm font-medium text-green-800">{{ session('success') }}</p>
                <button onclick="closeAlert('success-alert')" class="ml-auto text-green-500 hover:text-green-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-6 text-white">
        <div class="flex items-center space-x-6">
            <div class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-lg">
                <span class="text-4xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
            </div>
            <div>
                <h1 class="text-3xl font-bold mb-2">Edit Profile</h1>
                <p class="text-blue-100">Perbarui informasi akun Anda</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <form method="POST" action="{{ route('admin.profile.update') }}">
            @csrf
            @method('PUT')
            
            <div class="p-8 space-y-6">
                <!-- Basic Information -->
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        Informasi Dasar
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required
                                   class="w-full px-4 py-3 border-2 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300 @error('name') border-red-500 @else border-gray-200 @enderror">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="group">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required
                                   class="w-full px-4 py-3 border-2 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300 @error('email') border-red-500 @else border-gray-200 @enderror">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="border-t-2 border-gray-100 pt-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </span>
                        Ubah Password
                        <span class="ml-3 text-sm font-normal text-gray-500">(Opsional - kosongkan jika tidak ingin mengubah)</span>
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                            <input type="password" 
                                   id="password" 
                                   name="password"
                                   class="w-full px-4 py-3 border-2 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300 @error('password') border-red-500 @else border-gray-200 @enderror"
                                   placeholder="Minimal 8 karakter">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="group">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300"
                                   placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200 flex items-center justify-end space-x-4">
                <a href="{{ route('admin.dashboard') }}"
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
    @keyframes slide-in {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out;
    }
    .animate-slide-in {
        animation: slide-in 0.4s ease-out;
    }
</style>

<script>
    function closeAlert(id) {
        const alert = document.getElementById(id);
        alert.style.transition = 'all 0.3s ease-out';
        alert.style.opacity = '0';
        alert.style.transform = 'translateX(-20px)';
        setTimeout(() => alert.remove(), 300);
    }

    // Auto-hide success alert after 5 seconds
    setTimeout(() => {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) closeAlert('success-alert');
    }, 5000);
</script>
@endsection
