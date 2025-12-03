@extends('mitra.layouts.app')

@section('title', 'Edit Lowongan - Mitra Perusahaan')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2 ml-14">
            <a href="{{ route('mitra.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
            <span>/</span>
            <a href="{{ route('mitra.lowongan.index') }}" class="hover:text-blue-600">Lowongan</a>
            <span>/</span>
            <span class="text-gray-700">Edit Lowongan</span>
        </div>
        <div class="flex items-center gap-4 mb-2">
            
            <h1 class="text-3xl font-bold text-gray-800">Edit Lowongan Kerja</h1>
        </div>
        <p class="text-gray-600 ml-14">Perbarui informasi lowongan kerja</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm p-8">
        <form action="{{ route('mitra.lowongan.update', $lowongan->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Lowongan *</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $lowongan->judul) }}"
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-500 @else border-gray-300 @enderror"
                           placeholder="Contoh: UI/UX Designer" required>
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="posisi" class="block text-sm font-medium text-gray-700 mb-2">Posisi *</label>
                    <input type="text" id="posisi" name="posisi" value="{{ old('posisi', $lowongan->posisi) }}"
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('posisi') border-red-500 @else border-gray-300 @enderror"
                           placeholder="Contoh: UI/UX Designer" required>
                    @error('posisi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat *</label>
                <textarea id="deskripsi" name="deskripsi" rows="3"
                          class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('deskripsi') border-red-500 @else border-gray-300 @enderror"
                          placeholder="Deskripsi singkat tentang lowongan kerja" required>{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Job Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi *</label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $lowongan->lokasi) }}"
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('lokasi') border-red-500 @else border-gray-300 @enderror"
                           placeholder="Contoh: Jakarta, Indonesia" required>
                    @error('lokasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="jenis_pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">Jenis Pekerjaan *</label>
                    <select id="jenis_pekerjaan" name="jenis_pekerjaan"
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jenis_pekerjaan') border-red-500 @else border-gray-300 @enderror" required>
                        <option value="">Pilih Jenis Pekerjaan</option>
                        @foreach(['Full-Time', 'Part-Time', 'Contract', 'Internship', 'Freelance'] as $type)
                            <option value="{{ $type }}" {{ old('jenis_pekerjaan', $lowongan->jenis_pekerjaan) == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('jenis_pekerjaan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="jenjang_pendidikan" class="block text-sm font-medium text-gray-700 mb-2">Jenjang Pendidikan *</label>
                    <select id="jenjang_pendidikan" name="jenjang_pendidikan"
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jenjang_pendidikan') border-red-500 @else border-gray-300 @enderror" required>
                        <option value="">Pilih Jenjang</option>
                        @foreach(['D3', 'D4', 'S1', 'S2', 'Fresh Graduate'] as $level)
                            <option value="{{ $level }}" {{ old('jenjang_pendidikan', $lowongan->jenjang_pendidikan) == $level ? 'selected' : '' }}>{{ $level }}</option>
                        @endforeach
                    </select>
                    @error('jenjang_pendidikan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Prodi Diizinkan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Prodi Diizinkan</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @php
                        $selectedProdi = old('prodi_diizinkan', $lowongan->prodi_diizinkan ?? []);
                    @endphp
                    @foreach($prodi as $p)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="prodi_diizinkan[]" value="{{ $p->program_studi }}"
                                   {{ in_array($p->program_studi, $selectedProdi) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">{{ $p->program_studi }}</span>
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
                        $selectedDokumen = old('persyaratan_dokumen', $lowongan->persyaratan_dokumen ?? []);
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
                          class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('rincian_lowongan') border-red-500 @else border-gray-300 @enderror"
                          placeholder="Jelaskan secara detail tentang lowongan kerja, tanggung jawab, dan persyaratan yang dibutuhkan" required>{{ old('rincian_lowongan', $lowongan->rincian_lowongan) }}</textarea>
                @error('rincian_lowongan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Salary Range -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="gaji_min" class="block text-sm font-medium text-gray-700 mb-2">Gaji Minimum</label>
                    <input type="number" id="gaji_min" name="gaji_min" value="{{ old('gaji_min', $lowongan->gaji_min) }}" min="0"
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('gaji_min') border-red-500 @else border-gray-300 @enderror"
                           placeholder="5000000">
                </div>

                <div>
                    <label for="gaji_max" class="block text-sm font-medium text-gray-700 mb-2">Gaji Maksimum</label>
                    <input type="number" id="gaji_max" name="gaji_max" value="{{ old('gaji_max', $lowongan->gaji_max) }}" min="0"
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('gaji_max') border-red-500 @else border-gray-300 @enderror"
                           placeholder="8000000">
                </div>
            </div>

            <!-- Important Dates -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="tanggal_penerimaan_lamaran" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Penerimaan Lamaran *</label>
                    <input type="date" id="tanggal_penerimaan_lamaran" name="tanggal_penerimaan_lamaran"
                           value="{{ old('tanggal_penerimaan_lamaran', $lowongan->tanggal_penerimaan_lamaran ? $lowongan->tanggal_penerimaan_lamaran->format('Y-m-d') : '') }}"
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_penerimaan_lamaran') border-red-500 @else border-gray-300 @enderror" required>
                    @error('tanggal_penerimaan_lamaran')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_pengumuman" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengumuman *</label>
                    <input type="date" id="tanggal_pengumuman" name="tanggal_pengumuman"
                           value="{{ old('tanggal_pengumuman', $lowongan->tanggal_pengumuman ? $lowongan->tanggal_pengumuman->format('Y-m-d') : '') }}"
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_pengumuman') border-red-500 @else border-gray-300 @enderror" required>
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
                        @foreach(['Fresh Graduate', '1-2 tahun', '2-3 tahun', '3-5 tahun', '5+ tahun'] as $exp)
                            <option value="{{ $exp }}" {{ old('pengalaman_minimal', $lowongan->pengalaman_minimal) == $exp ? 'selected' : '' }}>{{ $exp }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="skill_required" class="block text-sm font-medium text-gray-700 mb-2">Skill yang Dibutuhkan</label>
                    <input type="text" id="skill_required" name="skill_required" 
                           value="{{ old('skill_required', is_array($lowongan->skill_required) ? implode(', ', $lowongan->skill_required) : $lowongan->skill_required) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Contoh: JavaScript, React, Figma (pisahkan dengan koma)">
                    <p class="text-xs text-gray-500 mt-1">Pisahkan skill dengan koma (,)</p>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t">
                <a href="{{ route('mitra.lowongan.index') }}"
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Kembali
                </a>
                <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
