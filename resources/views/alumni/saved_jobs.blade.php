@extends('alumni.layouts.app')

@section('title', 'Lowongan Tersimpan')

@section('content')
<div class="bg-white border-b border-gray-200 sticky top-0 z-30">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Lowongan Tersimpan</h1>
            <a href="{{ route('alumni.cari_lowongan') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Pencarian
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($jobs as $job)
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition border border-gray-100 flex flex-col h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white rounded-lg shadow-sm border p-1 flex items-center justify-center">
                        @if($job->mitra->logo)
                            <img src="{{ asset('storage/' . $job->mitra->logo) }}" alt="{{ $job->mitra->nama_perusahaan }}" class="w-full h-full object-contain">
                        @else
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 line-clamp-1">{{ $job->judul }}</h3>
                        <p class="text-gray-600 text-sm">{{ $job->mitra->nama_perusahaan }}</p>
                    </div>
                </div>
                <button onclick="toggleSave('{{ $job->id }}', this)" class="text-blue-600 hover:text-red-600 transition" title="Hapus dari simpanan">
                    <i class="fas fa-bookmark text-xl"></i>
                </button>
            </div>

            <div class="space-y-2 mb-4 flex-1">
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    {{ $job->lokasi }}
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Rp {{ number_format($job->gaji, 0, ',', '.') }}
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    {{ $job->jenis_pekerjaan }}
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 mt-auto">
                <a href="{{ route('alumni.lowongan.show', $job->id) }}" class="block w-full bg-blue-50 text-blue-600 text-center py-2 rounded-lg font-medium hover:bg-blue-100 transition">
                    Lihat Detail
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-800 mb-2">Belum ada lowongan tersimpan</h3>
            <p class="text-gray-600 mb-6">Simpan lowongan yang menarik minat Anda untuk dilihat nanti.</p>
            <a href="{{ route('alumni.cari_lowongan') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Cari Lowongan
            </a>
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $jobs->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function updateSavedJobsBadge(isSaved) {
        const badge = document.getElementById('saved-jobs-badge');
        const countElement = document.getElementById('saved-jobs-count');
        
        if (!badge || !countElement) return;
        
        // Get current count
        let currentCount = parseInt(countElement.textContent) || 0;
        if (countElement.textContent === '9+') {
            currentCount = 9;
        }
        
        // Update count
        const newCount = isSaved ? currentCount + 1 : Math.max(0, currentCount - 1);
        
        // Update display
        if (newCount === 0) {
            badge.classList.add('hidden');
        } else {
            badge.classList.remove('hidden');
            countElement.textContent = newCount > 9 ? '9+' : newCount;
        }
    }

    function toggleSave(jobId, btn) {
        Swal.fire({
            title: 'Hapus dari simpanan?',
            text: "Lowongan ini akan dihapus dari daftar simpanan Anda.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/alumni/lowongan/${jobId}/save`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update navbar badge
                        updateSavedJobsBadge(data.is_saved);
                        
                        // Remove card from DOM
                        const card = btn.closest('.bg-white');
                        card.remove();
                        
                        // Check if list is empty
                        const container = document.querySelector('.grid');
                        if (container.children.length === 0) {
                            location.reload(); // Reload to show empty state
                        }

                        Swal.fire(
                            'Dihapus!',
                            'Lowongan telah dihapus dari simpanan.',
                            'success'
                        )
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menghapus.',
                        'error'
                    )
                });
            }
        })
    }
</script>
@endsection
