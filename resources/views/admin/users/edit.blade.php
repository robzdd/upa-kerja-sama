@extends('admin.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Edit User</h2>
            <p class="text-gray-600 mt-1">Edit informasi user</p>
        </div>

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Basic Info -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Type Specific Fields -->
                @if($type === 'alumni' && $user->alumni)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Alumni</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                                <input type="text"
                                       id="nim"
                                       name="nim"
                                       value="{{ old('nim', $user->alumni->nim) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP</label>
                                <input type="text"
                                       id="no_hp"
                                       name="no_hp"
                                       value="{{ old('no_hp', $user->alumni->no_hp) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                @elseif($type === 'mitra' && $user->mitraPerusahaan)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Mitra</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700 mb-2">Nama Perusahaan</label>
                                <input type="text"
                                       id="nama_perusahaan"
                                       name="nama_perusahaan"
                                       value="{{ old('nama_perusahaan', $user->mitraPerusahaan->nama_perusahaan) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="sektor" class="block text-sm font-medium text-gray-700 mb-2">Sektor</label>
                                <input type="text"
                                       id="sektor"
                                       name="sektor"
                                       value="{{ old('sektor', $user->mitraPerusahaan->sektor) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                @elseif($type === 'mahasiswa' && $user->mahasiswa)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Mahasiswa</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="program_studi_id" class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                                <select id="program_studi_id"
                                        name="program_studi_id"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Pilih Program Studi</option>
                                    @foreach($programStudi as $prodi)
                                        <option value="{{ $prodi->id }}" {{ old('program_studi_id', $user->mahasiswa->program_studi_id) == $prodi->id ? 'selected' : '' }}>
                                            {{ $prodi->program_studi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                                <input type="text"
                                       id="nim"
                                       name="nim"
                                       value="{{ old('nim', $user->mahasiswa->nim) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="angkatan" class="block text-sm font-medium text-gray-700 mb-2">Angkatan</label>
                                <input type="text"
                                       id="angkatan"
                                       name="angkatan"
                                       value="{{ old('angkatan', $user->mahasiswa->angkatan) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.users.index') }}"
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

