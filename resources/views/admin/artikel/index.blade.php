@extends('admin.layouts.app')

@section('title', 'Manajemen Artikel')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <h2 class="text-xl md:text-2xl font-bold text-gray-900">Manajemen Artikel</h2>
        <a href="{{ route('admin.artikel.create') }}"
           class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gradient-to-r from-blue-600 to-purple-600 flex items-center space-x-2">
           <i class="fas fa-plus"></i>
           <span>Tambah Artikel</span>
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-sm font-semibold text-gray-600">
                    <th class="px-6 py-3">Judul</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Penulis</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y text-sm text-gray-700">
                @forelse($artikels as $artikel)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $artikel->judul }}</td>
                    <td class="px-6 py-4">
                        @if($artikel->kategori)
                            <span class="inline-block px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs font-semibold">{{ $artikel->kategori->nama }}</span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{ $artikel->user->name ?? '-' }}
                    </td>
                    <td class="px-6 py-4">{{ $artikel->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.artikel.edit', $artikel->id) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST" onsubmit="return confirm('Yakin hapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500">Belum ada artikel</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
