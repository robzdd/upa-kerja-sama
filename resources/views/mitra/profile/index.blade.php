@extends('mitra.layouts.app')

@section('title', 'Profil Perusahaan - Mitra Pro')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Profil Perusahaan</h2>
                <p class="text-sm text-gray-500">Kelola informasi perusahaan Anda yang akan tampil di publik</p>
            </div>
        </div>

        <form action="{{ route('mitra.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Logo Upload -->
            <div class="flex items-start space-x-6">
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center bg-gray-50 overflow-hidden relative group">
                        @if($mitra->logo)
                            <img id="logo-preview" src="{{ asset('storage/' . $mitra->logo) }}" alt="Logo" class="w-full h-full object-contain">
                        @else
                            <div id="logo-placeholder" class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <p class="text-white text-xs font-medium">Ubah Logo</p>
                        </div>
                        <input type="file" name="logo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(this)">
                    </div>
                    <p class="mt-2 text-xs text-gray-500 text-center">PNG, JPG up to 2MB</p>
                </div>
                
                <div class="flex-1 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $mitra->nama_perusahaan) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sektor Industri</label>
                            <input type="text" name="sektor" value="{{ old('sektor', $mitra->sektor) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" required placeholder="Contoh: Teknologi Informasi">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kontak (Telp/WA)</label>
                            <input type="text" name="kontak" value="{{ old('kontak', $mitra->kontak) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                            <input type="url" name="tautan" value="{{ old('tautan', $mitra->tautan) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" placeholder="https://">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <textarea name="alamat" rows="2" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">{{ old('alamat', $mitra->alamat) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Perusahaan</label>
                <textarea name="deskripsi" rows="4" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">{{ old('deskripsi', $mitra->deskripsi) }}</textarea>
                <p class="mt-1 text-xs text-gray-500">Jelaskan tentang perusahaan Anda, budaya kerja, dan apa yang Anda cari dari kandidat.</p>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 font-medium transition-all flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById('logo-preview');
            let placeholder = document.getElementById('logo-placeholder');
            
            if(preview) {
                preview.src = e.target.result;
            } else {
                // If there was no image before, create one
                placeholder.innerHTML = `<img id="logo-preview" src="${e.target.result}" class="w-full h-full object-contain">`;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
