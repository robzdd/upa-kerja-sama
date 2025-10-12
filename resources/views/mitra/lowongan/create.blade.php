@extends('mitra.layouts.app')

@section('title', 'Buat Lowongan - Mitra Perusahaan')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Buat Lowongan Kerja</h1>
        <p class="text-gray-600">Isi informasi lowongan kerja yang akan ditampilkan kepada kandidat</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm p-8">
        <form action="{{ route('mitra.lowongan.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Basic Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Lowongan *</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-500 @enderror"
                           placeholder="Contoh: UI/UX Designer" required>
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="posisi" class="block text-sm font-medium text-gray-700 mb-2">Posisi *</label>
                    <input type="text" id="posisi" name="posisi" value="{{ old('posisi') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('posisi') border-red-500 @enderror"
                           placeholder="Contoh: UI/UX Designer" required>
                    @error('posisi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat *</label>
                <textarea id="deskripsi" name="deskripsi" rows="3"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('deskripsi') border-red-500 @enderror"
                          placeholder="Deskripsi singkat tentang lowongan kerja" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Job Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi *</label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('lokasi') border-red-500 @enderror"
                           placeholder="Contoh: Jakarta, Indonesia" required>
                    @error('lokasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="jenis_pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">Jenis Pekerjaan *</label>
                    <select id="jenis_pekerjaan" name="jenis_pekerjaan"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jenis_pekerjaan') border-red-500 @enderror" required>
                        <option value="">Pilih Jenis Pekerjaan</option>
                        <option value="Full-Time" {{ old('jenis_pekerjaan') == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                        <option value="Part-Time" {{ old('jenis_pekerjaan') == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                        <option value="Contract" {{ old('jenis_pekerjaan') == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Internship" {{ old('jenis_pekerjaan') == 'Internship' ? 'selected' : '' }}>Internship</option>
                        <option value="Freelance" {{ old('jenis_pekerjaan') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                    </select>
                    @error('jenis_pekerjaan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="jenjang_pendidikan" class="block text-sm font-medium text-gray-700 mb-2">Jenjang Pendidikan *</label>
                    <select id="jenjang_pendidikan" name="jenjang_pendidikan"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jenjang_pendidikan') border-red-500 @enderror" required>
                        <option value="">Pilih Jenjang</option>
                        <option value="D3" {{ old('jenjang_pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="D4" {{ old('jenjang_pendidikan') == 'D4' ? 'selected' : '' }}>D4</option>
                        <option value="S1" {{ old('jenjang_pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ old('jenjang_pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="Fresh Graduate" {{ old('jenjang_pendidikan') == 'Fresh Graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                    </select>
                    @error('jenjang_pendidikan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Jurusan Diizinkan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan Diizinkan</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @php
                        $jurusan = [
                            'Teknik Informatika', 'Sistem Informasi', 'Rekayasa Perangkat Lunak',
                            'Teknik Komputer', 'Teknologi Informasi', 'Ilmu Komputer',
                            'Teknik Mesin', 'Teknik Elektro', 'Teknik Sipil',
                            'Manajemen', 'Akuntansi', 'Ekonomi'
                        ];
                        $selectedJurusan = old('jurusan_diizinkan', []);
                    @endphp
                    @foreach($jurusan as $j)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="jurusan_diizinkan[]" value="{{ $j }}"
                                   {{ in_array($j, $selectedJurusan) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">{{ $j }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Persyaratan Dokumen -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Persyaratan Dokumen</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @php
                        $dokumen = ['CV/Resume', 'Portfolio', 'Sertifikat', 'Transkrip Nilai', 'Surat Lamaran', 'KTP'];
                        $selectedDokumen = old('persyaratan_dokumen', []);
                    @endphp
                    @foreach($dokumen as $d)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="persyaratan_dokumen[]" value="{{ $d }}"
                                   {{ in_array($d, $selectedDokumen) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">{{ $d }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Rincian Lowongan -->
            <div>
                <label for="rincian_lowongan" class="block text-sm font-medium text-gray-700 mb-2">Rincian Lowongan *</label>
                <textarea id="rincian_lowongan" name="rincian_lowongan" rows="6"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('rincian_lowongan') border-red-500 @enderror"
                          placeholder="Jelaskan secara detail tentang lowongan kerja, tanggung jawab, dan persyaratan yang dibutuhkan" required>{{ old('rincian_lowongan') }}</textarea>
                @error('rincian_lowongan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Salary Range -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="gaji_min" class="block text-sm font-medium text-gray-700 mb-2">Gaji Minimum</label>
                    <input type="text" id="gaji_min" name="gaji_min" value="{{ old('gaji_min') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Contoh: 5.000.000">
                </div>

                <div>
                    <label for="gaji_max" class="block text-sm font-medium text-gray-700 mb-2">Gaji Maksimum</label>
                    <input type="text" id="gaji_max" name="gaji_max" value="{{ old('gaji_max') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Contoh: 8.000.000">
                </div>
            </div>

            <!-- Important Dates -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="tanggal_penerimaan_lamaran" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Penerimaan Lamaran *</label>
                    <input type="date" id="tanggal_penerimaan_lamaran" name="tanggal_penerimaan_lamaran"
                           value="{{ old('tanggal_penerimaan_lamaran') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_penerimaan_lamaran') border-red-500 @enderror" required>
                    @error('tanggal_penerimaan_lamaran')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_pengumuman" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengumuman *</label>
                    <input type="date" id="tanggal_pengumuman" name="tanggal_pengumuman"
                           value="{{ old('tanggal_pengumuman') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_pengumuman') border-red-500 @enderror" required>
                    @error('tanggal_pengumuman')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Additional Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="pengalaman_minimal" class="block text-sm font-medium text-gray-700 mb-2">Pengalaman Minimal</label>
                    <select id="pengalaman_minimal" name="pengalaman_minimal"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Pengalaman</option>
                        <option value="Fresh Graduate" {{ old('pengalaman_minimal') == 'Fresh Graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                        <option value="1-2 tahun" {{ old('pengalaman_minimal') == '1-2 tahun' ? 'selected' : '' }}>1-2 tahun</option>
                        <option value="2-3 tahun" {{ old('pengalaman_minimal') == '2-3 tahun' ? 'selected' : '' }}>2-3 tahun</option>
                        <option value="3-5 tahun" {{ old('pengalaman_minimal') == '3-5 tahun' ? 'selected' : '' }}>3-5 tahun</option>
                        <option value="5+ tahun" {{ old('pengalaman_minimal') == '5+ tahun' ? 'selected' : '' }}>5+ tahun</option>
                    </select>
                </div>

                <div>
                    <label for="skill_required" class="block text-sm font-medium text-gray-700 mb-2">Skill yang Dibutuhkan</label>
                    <input type="text" id="skill_required" name="skill_required" value="{{ old('skill_required') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Contoh: JavaScript, React, Figma (pisahkan dengan koma)">
                    <p class="text-xs text-gray-500 mt-1">Pisahkan skill dengan koma (,)</p>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t">
                <a href="{{ route('mitra.lowongan.index') }}"
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Buat Lowongan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
