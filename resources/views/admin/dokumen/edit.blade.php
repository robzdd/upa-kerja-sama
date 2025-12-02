@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit Dokumen</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="flex items-center space-x-4 mb-6">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Edit Dokumen</h2>
            <p class="text-gray-600 mt-1">Perbarui informasi dokumen</p>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <form action="{{ route('admin.dokumen-publik.update', $dokumen?->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-6">
                <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">Judul Dokumen *</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $dokumen?->judul) }}" required
                       class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('judul') border-red-500 @else border-gray-300 @enderror">
                @error('judul')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3"
                          class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('deskripsi') border-red-500 @else border-gray-300 @enderror">{{ old('deskripsi', $dokumen?->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-6">
                <label for="kategori_dokumen_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori *</label>
                <select name="kategori_dokumen_id" id="kategori_dokumen_id" required
                        class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('kategori_dokumen_id') border-red-500 @else border-gray-300 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_dokumen_id', $dokumen?->kategori_dokumen_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_dokumen_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current File Info -->
            <div class="mb-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 {{ $dokumen?->file_type == 'PDF' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }} rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-800">File Saat Ini</p>
                        <p class="text-xs text-gray-600">{{ $dokumen?->file_type }} • {{ $dokumen?->file_size_formatted }}</p>
                    </div>
                    <a href="{{ route('admin.dokumen-publik.download', $dokumen?->id) }}" 
                       class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>
            </div>

            <!-- File Upload (Optional) -->
            <div class="mb-6">
                <label for="file" class="block text-sm font-semibold text-gray-700 mb-2">Ganti File (Opsional)</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-blue-500 transition">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                <span>Upload file baru</span>
                                <input id="file" name="file" type="file" class="sr-only" accept=".pdf,.xls,.xlsx" onchange="displayFileName(this)">
                            </label>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PDF atau Excel hingga 10MB</p>
                        <p class="text-xs text-yellow-600 font-medium">Kosongkan jika tidak ingin mengganti file</p>
                        <p id="file-name" class="text-sm font-medium text-blue-600 mt-2"></p>
                    </div>
                </div>
                @error('file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Download Stats -->
            <div class="mb-6 p-4 bg-blue-50 rounded-xl border border-blue-200">
                <div class="flex items-center space-x-2 text-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span class="text-sm font-semibold">Total Download: {{ $dokumen?->download_count ?? 0 }}x</span>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.dokumen-publik.index') }}"
                   class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-medium hover:from-blue-700 hover:to-purple-700 transition shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Dokumen
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function displayFileName(input) {
    const fileName = input.files[0]?.name;
    const fileNameDisplay = document.getElementById('file-name');
    if (fileName) {
        fileNameDisplay.textContent = `File baru terpilih: ${fileName}`;
    }
}
</script>
@endsection
