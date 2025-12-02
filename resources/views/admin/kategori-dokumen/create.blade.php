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
                    <a href="{{ route('admin.kategori-dokumen.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Kategori Dokumen</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tambah Kategori</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="flex items-center space-x-4 mb-6">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Tambah Kategori Baru</h2>
            <p class="text-gray-600 mt-1">Buat kategori untuk mengorganisir dokumen</p>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <form action="{{ route('admin.kategori-dokumen.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Kategori -->
                <div class="md:col-span-2">
                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori *</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                           class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('nama') border-red-500 @else border-gray-300 @enderror">
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3"
                              class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('deskripsi') border-red-500 @else border-gray-300 @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon -->
                <div>
                    <label for="icon" class="block text-sm font-semibold text-gray-700 mb-2">Icon (Font Awesome)</label>
                    <select name="icon" id="icon"
                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('icon') border-red-500 @else border-gray-300 @enderror">
                        <option value="">Pilih Icon</option>
                        <option value="fa-folder" {{ old('icon') == 'fa-folder' ? 'selected' : '' }}>📁 Folder</option>
                        <option value="fa-file-alt" {{ old('icon') == 'fa-file-alt' ? 'selected' : '' }}>📄 File</option>
                        <option value="fa-handshake" {{ old('icon') == 'fa-handshake' ? 'selected' : '' }}>🤝 Handshake</option>
                        <option value="fa-chart-bar" {{ old('icon') == 'fa-chart-bar' ? 'selected' : '' }}>📊 Chart</option>
                        <option value="fa-book" {{ old('icon') == 'fa-book' ? 'selected' : '' }}>📚 Book</option>
                        <option value="fa-clipboard-list" {{ old('icon') == 'fa-clipboard-list' ? 'selected' : '' }}>📋 Clipboard</option>
                        <option value="fa-certificate" {{ old('icon') == 'fa-certificate' ? 'selected' : '' }}>🏆 Certificate</option>
                    </select>
                    @error('icon')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Color -->
                <div>
                    <label for="color" class="block text-sm font-semibold text-gray-700 mb-2">Warna *</label>
                    <select name="color" id="color" required
                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('color') border-red-500 @else border-gray-300 @enderror">
                        <option value="blue" {{ old('color', 'blue') == 'blue' ? 'selected' : '' }}>🔵 Biru</option>
                        <option value="green" {{ old('color') == 'green' ? 'selected' : '' }}>🟢 Hijau</option>
                        <option value="red" {{ old('color') == 'red' ? 'selected' : '' }}>🔴 Merah</option>
                        <option value="yellow" {{ old('color') == 'yellow' ? 'selected' : '' }}>🟡 Kuning</option>
                        <option value="purple" {{ old('color') == 'purple' ? 'selected' : '' }}>🟣 Ungu</option>
                        <option value="pink" {{ old('color') == 'pink' ? 'selected' : '' }}>🩷 Pink</option>
                        <option value="indigo" {{ old('color') == 'indigo' ? 'selected' : '' }}>🔵 Indigo</option>
                    </select>
                    @error('color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Urutan -->
                <div class="md:col-span-2">
                    <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-2">Urutan Tampilan *</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 0) }}" min="0" required
                           class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('urutan') border-red-500 @else border-gray-300 @enderror">
                    <p class="mt-1 text-xs text-gray-500">Semakin kecil angka, semakin awal ditampilkan</p>
                    @error('urutan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 mt-6">
                <a href="{{ route('admin.kategori-dokumen.index') }}"
                   class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-medium hover:from-blue-700 hover:to-purple-700 transition shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
