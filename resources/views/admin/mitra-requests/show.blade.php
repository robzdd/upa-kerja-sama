@extends('admin.layouts.app')

@section('title', 'Detail Request Mitra')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Detail Request Mitra</h1>
        <a href="{{ route('admin.mitra-requests.index') }}" class="text-sm text-blue-600 hover:underline">← Kembali ke Daftar</a>
    </div>

    <!-- Request Card -->
    <div class="bg-white rounded-xl shadow border border-gray-100 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Perusahaan</p>
                <p class="text-lg font-semibold text-gray-800">{{ $request->nama_perusahaan }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="text-lg font-medium text-gray-800">{{ $request->email }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Bidang Usaha</p>
                <p class="text-lg font-medium text-gray-800">{{ $request->bidang_usaha }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Diajukan</p>
                <p class="text-lg font-medium text-gray-800">{{ $request->created_at->format('d M Y, H:i') }} ({{ $request->created_at->diffForHumans() }})</p>
            </div>
        </div>
        @if($request->keterangan)
        <div class="mt-4">
            <p class="text-sm text-gray-500">Keterangan</p>
            <p class="text-gray-700">{{ $request->keterangan }}</p>
        </div>
        @endif
        @if($request->dokumen)
        <div class="mt-4">
            <p class="text-sm text-gray-500">Dokumen Pendukung</p>
            <a href="{{ asset('storage/' . $request->dokumen) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a>
        </div>
        @endif
    </div>

    <!-- Action Buttons -->
    <div class="flex space-x-4">
        @if($request->isPending())
        <form method="POST" action="{{ route('admin.mitra-requests.approve', $request->id) }}" class="flex-1">
            @csrf
            <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                ✅ Approve
            </button>
        </form>
        <form method="POST" action="{{ route('admin.mitra-requests.reject', $request->id) }}" class="flex-1">
            @csrf
            <button type="button" @click="openReject = true" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                ❌ Reject
            </button>
        </form>
        @else
        <div class="text-gray-600">Request sudah diproses: <span class="font-medium">{{ ucfirst($request->status) }}</span></div>
        @endif
    </div>
</div>

{{-- Reject Modal (Alpine.js) --}}
<div x-data="{ openReject: false, notes: '' }" x-show="openReject" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display:none;">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Alasan Penolakan</h2>
        <textarea x-model="notes" rows="4" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Tuliskan alasan penolakan..."></textarea>
        <div class="flex justify-end mt-4 space-x-2">
            <button @click="openReject = false" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">Batal</button>
            <form method="POST" :action="'{{ route('admin.mitra-requests.reject', $request->id) }}'" class="inline">
                @csrf
                <input type="hidden" name="admin_notes" :value="notes">
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">Kirim Penolakan</button>
            </form>
        </div>
    </div>
</div>
@endsection
