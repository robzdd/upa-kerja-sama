@extends('mitra.layouts.app')

@section('title', $lowongan->judul . ' - Mitra Perusahaan')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white border-b sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    
                    <div>
                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                            <a href="{{ route('mitra.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                            <span>/</span>
                            <a href="{{ route('mitra.lowongan.index') }}" class="hover:text-blue-600">Lowongan</a>
                            <span>/</span>
                            <span class="text-gray-700">Detail</span>
                        </div>
                        <h1 class="text-xl font-bold text-gray-900">{{ $lowongan->judul }}</h1>
                        <p class="text-sm text-gray-500">{{ $lowongan->posisi }} • {{ $lowongan->lokasi }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <a href="{{ route('mitra.lowongan.edit', $lowongan->id) }}" 
                       class="flex-1 md:flex-none justify-center px-4 py-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-colors font-medium flex items-center gap-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('mitra.lowongan.destroy', $lowongan->id) }}" method="POST" class="delete-form flex-1 md:flex-none">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full justify-center px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-medium flex items-center gap-2">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Description Card -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi Pekerjaan</h2>
                    <div class="prose max-w-none text-gray-600">
                        <p class="whitespace-pre-line">{{ $lowongan->deskripsi }}</p>
                    </div>
                </div>

                <!-- Requirements Card -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Rincian & Persyaratan</h2>
                    <div class="prose max-w-none text-gray-600">
                        <p class="whitespace-pre-line">{{ $lowongan->rincian_lowongan }}</p>
                    </div>
                </div>

                <!-- Skills Card -->
                @if($lowongan->skill_required)
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Skill yang Dibutuhkan</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($lowongan->skill_required as $skill)
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-medium">
                                {{ trim($skill) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Back Button -->
                <div class="pt-4">
                    <a href="{{ route('mitra.lowongan.index') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium shadow-sm">
                        <i class="fas fa-arrow-left text-sm"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-4">Informasi Lowongan</h3>
                    <div class="space-y-4">
                        <div>
                            <span class="text-xs text-gray-400 block mb-1">Status</span>
                            @if($lowongan->status_aktif)
                                @if($lowongan->tanggal_penerimaan_lamaran && $lowongan->tanggal_penerimaan_lamaran < now())
                                    <span class="px-2 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-medium">Kadaluarsa</span>
                                @else
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Aktif</span>
                                @endif
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">Tidak Aktif</span>
                            @endif
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 block mb-1">Jenis Pekerjaan</span>
                            <p class="text-sm text-gray-700 font-medium">{{ $lowongan->jenis_pekerjaan }}</p>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 block mb-1">Jenjang Pendidikan</span>
                            <p class="text-sm text-gray-700 font-medium">{{ $lowongan->jenjang_pendidikan }}</p>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 block mb-1">Pengalaman</span>
                            <p class="text-sm text-gray-700 font-medium">{{ $lowongan->pengalaman_minimal ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 block mb-1">Gaji</span>
                            <p class="text-sm text-gray-700 font-medium">
                                @if($lowongan->gaji_min && $lowongan->gaji_max)
                                    Rp {{ number_format((float) str_replace(['.', ','], '', $lowongan->gaji_min), 0, ',', '.') }} - {{ number_format((float) str_replace(['.', ','], '', $lowongan->gaji_max), 0, ',', '.') }}
                                @elseif($lowongan->gaji_min)
                                    Rp {{ number_format((float) str_replace(['.', ','], '', $lowongan->gaji_min), 0, ',', '.') }}
                                @else
                                    Disembunyikan
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Timeline Card -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-4">Timeline</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-calendar-alt text-blue-600 text-xs"></i>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 block">Batas Lamaran</span>
                                <p class="text-sm text-gray-700 font-medium">
                                    {{ \Carbon\Carbon::parse($lowongan->tanggal_penerimaan_lamaran)->isoFormat('D MMMM Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-purple-50 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-bullhorn text-purple-600 text-xs"></i>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 block">Pengumuman</span>
                                <p class="text-sm text-gray-700 font-medium">
                                    {{ \Carbon\Carbon::parse($lowongan->tanggal_pengumuman)->isoFormat('D MMMM Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prodi & Documents -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-4">Persyaratan Tambahan</h3>
                    
                    <div class="mb-4">
                        <span class="text-xs text-gray-400 block mb-2">Prodi Diizinkan</span>
                        <div class="flex flex-wrap gap-2">
                            @forelse($lowongan->prodi_diizinkan ?? [] as $prodi)
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">
                                    {{ $prodi }}
                                </span>
                            @empty
                                <span class="text-sm text-gray-500">-</span>
                            @endforelse
                        </div>
                    </div>

                    <div>
                        <span class="text-xs text-gray-400 block mb-2">Dokumen Wajib</span>
                        <ul class="space-y-1">
                            @forelse($lowongan->persyaratan_dokumen ?? [] as $doc)
                                <li class="flex items-center gap-2 text-sm text-gray-600">
                                    <i class="fas fa-check text-green-500 text-xs"></i>
                                    {{ $doc }}
                                </li>
                            @empty
                                <li class="text-sm text-gray-500">-</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Lowongan yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endpush
@endsection
