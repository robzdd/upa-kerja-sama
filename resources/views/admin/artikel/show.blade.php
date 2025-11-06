@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $artikel->judul }}</h2>
                <p class="text-gray-600 mt-1">
                    {{ $artikel->kategori->nama ?? 'Tanpa Kategori' }} •
                    {{ $artikel->created_at->format('d M Y') }}
                </p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.artikel.edit', $artikel->id) }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Edit
                </a>
                <a href="{{ route('admin.artikel.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Kembali
                </a>
            </div>
        </div>

        @if($artikel->thumbnail)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" class="w-full h-64 object-cover rounded-lg">
            </div>
        @endif

        <div class="prose max-w-none">
            {!! nl2br(e($artikel->konten)) !!}
        </div>
    </div>
</div>
@endsection

