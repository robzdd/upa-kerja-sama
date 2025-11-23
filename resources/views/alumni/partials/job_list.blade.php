@forelse($lowongan as $index => $job)
    <div class="job-card {{ $index === 0 ? 'active' : '' }} bg-white rounded-lg shadow-md p-5 hover:shadow-lg transition cursor-pointer border-l-4 {{ $index === 0 ? 'border-blue-500' : 'border-transparent' }}"
            onclick="selectJob(this, '{{ $job->id }}')">
        <div class="flex justify-between items-start mb-3">
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $job->judul }}</h3>
                <p class="text-gray-600 text-sm mb-3">{{ $job->mitra->nama_perusahaan }}</p>
            </div>
            <button class="text-blue-600 text-sm font-semibold">Simpan ♥</button>
        </div>

        <div class="flex flex-wrap gap-3 text-xs text-gray-600 mb-3">
            <div class="flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>{{ $job->lokasi }}</span>
            </div>
            <div class="flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ $job->jenis_pekerjaan }}</span>
            </div>
        </div>

        <div class="flex gap-2">
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">{{ $job->jenjang_pendidikan }}</span>
            @if($job->pengalaman_minimal)
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">{{ $job->pengalaman_minimal }}</span>
            @endif
        </div>
    </div>
@empty
    <div class="text-center py-12">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak ada lowongan ditemukan</h3>
        <p class="text-gray-600">Coba ubah filter pencarian Anda</p>
    </div>
@endforelse

<!-- Pagination -->
<div class="mt-8">
    {{ $lowongan->withQueryString()->links() }}
</div>
