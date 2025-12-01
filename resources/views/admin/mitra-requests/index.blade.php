@extends('admin.layouts.app')

@section('title', 'Request Mitra')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Request Mitra</h1>
        <a href="{{ route('admin.mitra-requests.index') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
            Refresh
        </a>
    </div>

    <!-- Stats Card -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl shadow p-5 border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <div class="w-10 h-10 bg-red-100 text-red-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-1 rounded-full">{{ $stats['pending_mitra_requests'] }}</span>
            </div>
            <p class="text-gray-500 text-sm">Pending Requests</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['pending_mitra_requests']) }}</h3>
        </div>
    </div>

    <!-- Requests Table -->
    <div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
        <div class="p-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Pending Mitra Requests</h2>
            <a href="{{ route('admin.mitra-requests.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bidang Usaha</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diajukan</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($requests as $request)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $request->nama_perusahaan }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-600">{{ $request->email }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-600">{{ $request->bidang_usaha }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $request->created_at->diffForHumans() }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-center">
                            <a href="{{ route('admin.mitra-requests.show', $request->id) }}" class="text-blue-600 hover:underline text-sm">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">Tidak ada request pending.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $requests->links() }}
        </div>
    </div>
</div>
@endsection
