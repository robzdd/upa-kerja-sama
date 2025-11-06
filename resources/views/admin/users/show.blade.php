@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Detail User</h2>
                <p class="text-gray-600 mt-1">Informasi lengkap user</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.users.edit', $user->id) }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Edit
                </a>
                <a href="{{ route('admin.users.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Kembali
                </a>
            </div>
        </div>

        <div class="space-y-6">
            <!-- User Info -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Nama</p>
                        <p class="text-base font-medium text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="text-base font-medium text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tanggal Daftar</p>
                        <p class="text-base font-medium text-gray-900">{{ $user->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Profile Specific -->
            @if($user->alumni)
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Alumni</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">NIM</p>
                            <p class="text-base font-medium text-gray-900">{{ $user->alumni->nim ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">No. HP</p>
                            <p class="text-base font-medium text-gray-900">{{ $user->alumni->no_hp ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @elseif($user->mitraPerusahaan)
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Mitra</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Nama Perusahaan</p>
                            <p class="text-base font-medium text-gray-900">{{ $user->mitraPerusahaan->nama_perusahaan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Sektor</p>
                            <p class="text-base font-medium text-gray-900">{{ $user->mitraPerusahaan->sektor ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @elseif($user->mahasiswa)
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Mahasiswa</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">NIM</p>
                            <p class="text-base font-medium text-gray-900">{{ $user->mahasiswa->nim ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Program Studi</p>
                            <p class="text-base font-medium text-gray-900">{{ $user->mahasiswa->programStudi->program_studi ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Angkatan</p>
                            <p class="text-base font-medium text-gray-900">{{ $user->mahasiswa->angkatan ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

