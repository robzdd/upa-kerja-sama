@extends('admin.layouts.app')

@section('content')
<div class="max-w-6xl mx-auto animate-fade-in">
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
                    <a href="{{ route('admin.artikel.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Artikel</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit Artikel</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-6 text-white">
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold">Edit Artikel</h1>
                <p class="text-blue-100 mt-1">Perbarui artikel dengan fitur lengkap</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.artikel.update', $artikel->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Info Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                        Informasi Dasar
                    </h3>

                    <div class="space-y-4">
                        <!-- Judul -->
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel *</label>
                            <input type="text" 
                                   id="judul" 
                                   name="judul" 
                                   value="{{ old('judul', $artikel->judul) }}" 
                                   required
                                   onkeyup="generateSlug()"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition @error('judul') border-red-500 @enderror"
                                   placeholder="Masukkan judul artikel yang menarik">
                            @error('judul')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                Slug (URL)
                                <span class="text-xs text-gray-500">- Otomatis dibuat dari judul</span>
                            </label>
                            <input type="text" 
                                   id="slug" 
                                   name="slug" 
                                   value="{{ old('slug', $artikel->slug) }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition @error('slug') border-red-500 @enderror"
                                   placeholder="url-friendly-slug">
                            @error('slug')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                                Ringkasan Artikel
                                <span class="text-xs text-gray-500">(Maks. 500 karakter)</span>
                            </label>
                            <textarea id="excerpt" 
                                      name="excerpt" 
                                      rows="3"
                                      maxlength="500"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition @error('excerpt') border-red-500 @enderror"
                                      placeholder="Tulis ringkasan singkat artikel untuk ditampilkan di halaman daftar">{{ old('excerpt', $artikel->excerpt) }}</textarea>
                            @error('excerpt')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Content Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </span>
                        Konten Artikel *
                    </h3>

                    <div>
                        <textarea id="konten" 
                                  name="konten" 
                                  rows="20"
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition @error('konten') border-red-500 @enderror">{{ old('konten', $artikel->konten) }}</textarea>
                        @error('konten')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- SEO Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        SEO & Meta
                    </h3>

                    <div class="space-y-4">
                        <!-- Meta Description -->
                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Description
                                <span class="text-xs text-gray-500">(Maks. 160 karakter - untuk SEO)</span>
                            </label>
                            <textarea id="meta_description" 
                                      name="meta_description" 
                                      rows="2"
                                      maxlength="160"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition @error('meta_description') border-red-500 @enderror"
                                      placeholder="Deskripsi singkat untuk mesin pencari">{{ old('meta_description', $artikel->meta_description) }}</textarea>
                            @error('meta_description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div>
                            <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">
                                Tags
                                <span class="text-xs text-gray-500">(Pisahkan dengan koma)</span>
                            </label>
                            <input type="text" 
                                   id="tags" 
                                   name="tags" 
                                   value="{{ old('tags', is_array($artikel->tags) ? implode(',', $artikel->tags) : '') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition @error('tags') border-red-500 @enderror"
                                   placeholder="teknologi, tutorial, tips">
                            @error('tags')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Publish Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Publikasi</h3>
                    
                    <div class="space-y-4">
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select id="status" 
                                    name="status" 
                                    required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition">
                                <option value="draft" {{ old('status', $artikel->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $artikel->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="scheduled" {{ old('status', $artikel->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            </select>
                        </div>

                        <!-- Published At -->
                        <div>
                            <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Publikasi</label>
                            <input type="datetime-local" 
                                   id="published_at" 
                                   name="published_at" 
                                   value="{{ old('published_at', $artikel->published_at ? $artikel->published_at->format('Y-m-d\TH:i') : '') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition">
                        </div>

                        <!-- Featured -->
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="is_featured" 
                                   name="is_featured" 
                                   value="1"
                                   {{ old('is_featured', $artikel->is_featured) ? 'checked' : '' }}
                                   class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_featured" class="ml-3 text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    Artikel Unggulan
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Category & Thumbnail Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Kategori & Media</h3>
                    
                    <div class="space-y-4">
                        <!-- Category -->
                        <div>
                            <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                            <select id="kategori_id" 
                                    name="kategori_id" 
                                    required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition @error('kategori_id') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $artikel->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Thumbnail -->
                        <div>
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Thumbnail</label>
                            <input type="file" 
                                   id="thumbnail" 
                                   name="thumbnail" 
                                   accept="image/*"
                                   onchange="previewImage(this)"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition @error('thumbnail') border-red-500 @enderror">
                            @error('thumbnail')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <!-- Current Thumbnail -->
                            @if($artikel->thumbnail)
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 mb-2">Thumbnail Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="Current thumbnail" class="w-full rounded-xl shadow-md">
                                </div>
                            @endif
                            
                            <!-- Preview -->
                            <div id="thumbnail-preview" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">Preview Thumbnail Baru:</p>
                                <img id="preview-img" src="" alt="Preview" class="w-full rounded-xl shadow-md">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="space-y-3">
                        <button type="submit" 
                                class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Artikel
                            </span>
                        </button>
                        <a href="{{ route('admin.artikel.index') }}"
                           class="w-full block text-center px-6 py-3 border-2 border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-100 transition-all duration-200">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Batal
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
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

<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: '#konten',
        height: 500,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image media link | code | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        images_upload_url: '/upload-image',
        automatic_uploads: true,
        file_picker_types: 'image',
        image_advtab: true,
        setup: function(editor) {
            editor.on('init', function() {
                console.log('TinyMCE initialized successfully');
            });
        }
    });

    // Generate slug from title
    function generateSlug() {
        const title = document.getElementById('judul').value;
        const slug = title
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
        document.getElementById('slug').value = slug;
    }

    // Preview thumbnail
    function previewImage(input) {
        const preview = document.getElementById('thumbnail-preview');
        const previewImg = document.getElementById('preview-img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Handle form submission
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                console.log('Form submit triggered');
                
                // Trigger TinyMCE to save content to textarea
                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                    console.log('TinyMCE content saved');
                }
                
                // Log form data for debugging
                const formData = new FormData(form);
                console.log('Form data:');
                for (let [key, value] of formData.entries()) {
                    if (key !== 'konten') {
                        console.log(key + ': ' + value);
                    } else {
                        console.log(key + ': ' + (value ? value.substring(0, 100) + '...' : 'empty'));
                    }
                }
                
                // Form will submit normally
                return true;
            });
        }
    });
</script>
@endsection
