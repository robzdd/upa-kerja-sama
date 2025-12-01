@forelse($lowongan as $index => $job)
    <div class="job-card {{ $index === 0 ? 'active' : '' }} bg-white rounded-lg shadow-md p-5 hover:shadow-lg transition cursor-pointer border-l-4 {{ $index === 0 ? 'border-blue-500' : 'border-transparent' }}"
            onclick="selectJob(this, '{{ $job->id }}')">
        <div class="flex justify-between items-start mb-3">
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $job->judul }}</h3>
                <p class="text-gray-600 text-sm mb-3">{{ $job->mitra->nama_perusahaan }}</p>
            </div>
            <div class="flex items-center gap-2">
                @if(isset($job->similarity_score))
                    @php
                        $score = $job->similarity_score;
                        if ($score >= 70) {
                            $badgeClass = 'bg-green-100 text-green-700 border-green-300';
                        } elseif ($score >= 40) {
                            $badgeClass = 'bg-yellow-100 text-yellow-700 border-yellow-300';
                        } else {
                            $badgeClass = 'bg-orange-100 text-orange-700 border-orange-300';
                        }
                    @endphp
                    <span class="px-3 py-1 {{ $badgeClass }} rounded-full text-xs font-semibold border">
                        {{ number_format($score, 0) }}% Match
                    </span>
                @endif
            </div>
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

        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
            <div class="text-sm text-gray-500">
                <i class="far fa-clock mr-1"></i> {{ $job->created_at->diffForHumans() }}
            </div>
            <div class="flex space-x-2">
                @auth
                <button onclick="toggleSave(event, '{{ $job->id }}')" id="save-btn-{{ $job->id }}" 
                        class="p-2 rounded-lg border transition-all duration-200 transform active:scale-95 {{ Auth::user()->alumni && Auth::user()->alumni->savedJobs->contains($job->id) ? 'bg-blue-50 border-blue-200 text-blue-600' : 'border-gray-200 text-gray-400 hover:text-blue-600 hover:border-blue-200' }}"
                        title="{{ Auth::user()->alumni && Auth::user()->alumni->savedJobs->contains($job->id) ? 'Hapus dari simpanan' : 'Simpan lowongan' }}">
                    <i class="{{ Auth::user()->alumni && Auth::user()->alumni->savedJobs->contains($job->id) ? 'fas' : 'far' }} fa-bookmark transition-transform duration-200"></i>
                </button>
                @endauth
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full text-center py-12">
        <div class="inline-block p-4 rounded-full bg-blue-50 mb-4">
            <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900">Tidak ada lowongan ditemukan</h3>
        <p class="text-gray-500 mt-2">Coba ubah filter pencarian Anda</p>
    </div>
@endforelse

<!-- Pagination -->
<div class="mt-8">
    {{ $lowongan->withQueryString()->links() }}
</div>
