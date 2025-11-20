@extends('admin.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $aktivitas->judul }}</h2>
                <p class="text-gray-600 mt-1">
                    {{ $aktivitas->tanggal->format('d M Y') }} • {{ $aktivitas->lokasi ?? 'Tidak ada lokasi' }}
                </p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.aktivitas.edit', $aktivitas->id) }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Edit
                </a>
                <a href="{{ route('admin.aktivitas.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Kembali
                </a>
            </div>
        </div>

        <div class="mb-4">
            @if($aktivitas->status == 'published')
                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Published</span>
            @elseif($aktivitas->status == 'completed')
                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">Completed</span>
            @else
                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">Draft</span>
            @endif
        </div>

        <div class="prose max-w-none">
            <p class="text-gray-700 whitespace-pre-line">{{ $aktivitas->deskripsi }}</p>
        </div>
    </div>
</div>
@endsection

