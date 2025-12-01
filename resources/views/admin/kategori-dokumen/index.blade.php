@extends('admin.layouts.app')

@section('content')
<div class="space-y-6 animate-fade-in">
    <!-- Success/Error Alerts -->
    @if(session('success'))
        <div id="success-alert" class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl p-4 shadow-lg animate-slide-in">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
                <button onclick="closeAlert('success-alert')" class="ml-auto flex-shrink-0 text-green-500 hover:text-green-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div id="error-alert" class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-xl p-4 shadow-lg animate-slide-in">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
                <button onclick="closeAlert('error-alert')" class="ml-auto flex-shrink-0 text-red-500 hover:text-red-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

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
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('admin.dokumen-publik.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Dokumen Publik</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Kategori Dokumen</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center space-x-4">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg transform transition hover:scale-110">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Kategori Dokumen</h2>
                <p class="text-gray-600 mt-1">Kelola kategori untuk mengorganisir dokumen</p>
            </div>
        </div>
        <a href="{{ route('admin.kategori-dokumen.create') }}"
           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Kategori
        </a>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($kategoris as $kategori)
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-{{ $kategori->color }}-100 text-{{ $kategori->color }}-600 rounded-xl flex items-center justify-center">
                        <i class="fas {{ $kategori->icon ?? 'fa-folder' }} text-xl"></i>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.kategori-dokumen.edit', $kategori->id) }}"
                           class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition"
                           title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('admin.kategori-dokumen.destroy', $kategori->id) }}" method="POST" class="inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    onclick="confirmDelete(this)"
                                    data-kategori-title="{{ $kategori->nama }}"
                                    data-dokumen-count="{{ $kategori->dokumen_count }}"
                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition"
                                    title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $kategori->nama }}</h3>
                @if($kategori->deskripsi)
                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($kategori->deskripsi, 100) }}</p>
                @endif
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        {{ $kategori->dokumen_count }} dokumen
                    </div>
                    <span class="text-xs font-medium bg-gray-100 text-gray-600 px-3 py-1 rounded-full">
                        Urutan: {{ $kategori->urutan }}
                    </span>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-white rounded-2xl shadow-lg">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <p class="text-gray-500 font-medium">Belum ada kategori dokumen</p>
                <a href="{{ route('admin.kategori-dokumen.create') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-700 font-medium">
                    Buat kategori pertama →
                </a>
            </div>
        @endforelse
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

    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');
        if (successAlert) closeAlert('success-alert');
        if (errorAlert) closeAlert('error-alert');
    }, 5000);

    // SweetAlert2 Delete Confirmation
    function confirmDelete(button) {
        const kategoriTitle = button.getAttribute('data-kategori-title');
        const dokumenCount = button.getAttribute('data-dokumen-count');
        const form = button.closest('form');
        
        if (dokumenCount > 0) {
            Swal.fire({
                title: 'Tidak Dapat Dihapus!',
                html: `Kategori <strong>${kategoriTitle}</strong> masih memiliki <strong>${dokumenCount} dokumen</strong>.<br><small class="text-gray-500">Hapus atau pindahkan dokumen terlebih dahulu.</small>`,
                icon: 'error',
                confirmButtonColor: '#3b82f6',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-3 font-medium'
                }
            });
        } else {
            Swal.fire({
                title: 'Hapus Kategori?',
                html: `Apakah Anda yakin ingin menghapus kategori <strong>${kategoriTitle}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fas fa-trash mr-2"></i> Ya, Hapus!',
                cancelButtonText: '<i class="fas fa-times mr-2"></i> Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-3 font-medium',
                    cancelButton: 'rounded-xl px-6 py-3 font-medium'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    }
</script>
@endsection
