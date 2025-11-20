@extends('alumni.layouts.app')

@section('title', 'Cari Lowongan - Portal Kerja POLINDRA')

@section('content')
    <!-- Header Section with Gradient Background -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-purple-900 text-white pb-32 relative">
        <!-- Navbar -->
        @include('components.navbar')
        <!-- Hero Content -->
        <div class="container mx-auto px-6 py-8 relative z-10">
            <div class="text-left max-w-2xl">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">
                    Temukan pekerjaan impianmu
                </h1>
            </div>
        </div>

        <!-- Decorative "We're Hiring!" text -->
        <div class="absolute right-10 top-10 opacity-10 font-bold text-8xl md:text-9xl pointer-events-none">
            We're<br>HIRING!
        </div>
    </div>

    <!-- Search Section (Overlapping) -->
    <div class="container mx-auto px-6 -mt-20 relative z-30 mb-8">
        <div class="bg-white rounded-xl shadow-2xl p-6">
            <!-- Search Filters -->
            <div class="grid grid-cols-2 md:grid-cols-6 gap-3 mb-4">
                <input
                    type="text"
                    placeholder="Posisi"
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 text-sm"
                >
                <input
                    type="text"
                    placeholder="Perusahaan"
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 text-sm"
                >
                <input
                    type="text"
                    placeholder="Lokasi"
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 text-sm"
                >
                <select class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 text-sm">
                    <option>Prodi</option>
                    <option>Teknik Informatika</option>
                    <option>Teknik Mesin</option>
                </select>
                <select class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 text-sm">
                    <option>Jenjang Pendidikan</option>
                    <option>D3</option>
                    <option>D4</option>
                </select>
                <div class="flex gap-2 col-span-2 md:col-span-1">
                    <button class="px-3 text-gray-600 hover:text-gray-800 transition font-semibold text-sm">
                        Clear
                    </button>
                    <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-4 py-3 rounded-lg hover:from-blue-800 hover:to-purple-600 transition flex items-center justify-center flex-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>

        </div>
        <!-- AI Recommendation Button -->
        <button class="w-full bg-gradient-to-r from-blue-700 to-purple-700 text-white py-4 rounded-lg font-semibold hover:from-blue-600 hover:to-purple-600 transition shadow-lg flex items-center justify-center space-x-3 mt-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
            </svg>
            <span>Coba rekomendasi pekerjaan menggunakan AI</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
            </svg>
        </button>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-6 pb-16">
        <!-- Stats -->
        <div class="mb-6 flex justify-between items-center">
            <p class="text-gray-700 text-sm">Posisi tersedia: {{ $totalLowongan }} | Total Pelamar: {{ $totalPelamar }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <!-- Left Side - Job Listings (40%) -->
            <div class="lg:col-span-2 space-y-4">
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
                <div class="flex justify-center items-center space-x-2 mt-8">
                    <button class="w-8 h-8 rounded-full bg-blue-900 text-white flex items-center justify-center text-sm">1</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center text-sm">2</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center text-sm">3</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center text-sm">...</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center text-sm">100</button>
                    <button class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center justify-center text-sm">→</button>
                </div>
            </div>

            <!-- Right Side - Job Detail (60%) -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg shadow-lg p-8 sticky top-6" id="job-detail">
                    @if($lowongan->count() > 0)
                        @php $firstJob = $lowongan->first(); @endphp
                        <!-- Company Logo Placeholder -->
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-2xl font-bold text-gray-400">{{ substr($firstJob->mitra->nama_perusahaan, 0, 2) }}</span>
                            </div>
                            <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-5 py-2 rounded-lg hover:from-blue-800 hover:to-purple-600 transition text-sm font-semibold">
                                {{ $firstJob->jenis_pekerjaan }}
                            </button>
                        </div>

                        <!-- Posisi & Peringatan -->
                        <div class="mb-4">
                            <span class="text-xs text-red-500">1 Posisi - {{ $firstJob->jumlah_pelamar }} Pelamar</span>
                        </div>

                        <!-- Job Title -->
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $firstJob->judul }}</h2>
                        <p class="text-gray-600 mb-4">{{ $firstJob->mitra->nama_perusahaan }}</p>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">{{ $firstJob->jenjang_pendidikan }}</span>
                            @if($firstJob->pengalaman_minimal)
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">{{ $firstJob->pengalaman_minimal }}</span>
                            @endif
                        </div>

                        <!-- Apply Button -->
                        <a href="{{ route('alumni.lowongan.apply', $firstJob->id) }}" class="block w-full bg-gradient-to-r from-blue-900 to-purple-700 text-white py-3 rounded-lg hover:from-blue-800 hover:to-purple-600 transition font-semibold mb-6 text-center">
                            Daftar Sekarang
                        </a>


                        <!-- Job Details -->
                        <div class="space-y-5 mb-6">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-gray-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Pendidikan</h4>
                                    <p class="text-sm text-gray-600">Jenjang Pendidikan: {{ $firstJob->jenjang_pendidikan }}</p>
                                    @if($firstJob->prodi_diizinkan && count($firstJob->prodi_diizinkan) > 0)
                                        <p class="text-sm text-gray-600">Prodi: {{ implode(', ', $firstJob->prodi_diizinkan) }}</p>
                                    @endif
                                </div>
                            </div>

                            @if($firstJob->persyaratan_dokumen && count($firstJob->persyaratan_dokumen) > 0)
                                <div class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-gray-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold text-gray-800 mb-1">Persyaratan Dokumen</h4>
                                        <ul class="text-sm text-gray-600">
                                            @foreach($firstJob->persyaratan_dokumen as $dokumen)
                                                <li>• {{ $dokumen }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-gray-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Tanggal Penting</h4>
                                    @if($firstJob->tanggal_penerimaan_lamaran)
                                        <p class="text-sm text-gray-600">• Penerimaan lamaran: {{ \Carbon\Carbon::parse($firstJob->tanggal_penerimaan_lamaran)->format('d F Y') }}</p>
                                    @endif
                                    @if($firstJob->tanggal_pengumuman)
                                        <p class="text-sm text-gray-600">• Pengumuman: {{ \Carbon\Carbon::parse($firstJob->tanggal_pengumuman)->format('d F Y') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="border-t pt-6">
                            <h3 class="font-bold text-gray-800 mb-3">Rincian Lowongan</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                {{ $firstJob->rincian_lowongan }}
                            </p>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-800 mb-2">Pilih lowongan untuk melihat detail</h3>
                            <p class="text-gray-600">Klik pada salah satu lowongan di sebelah kiri untuk melihat detail</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectJob(element, jobId) {
            console.log('Selecting job with ID:', jobId);

            // Remove active class from all job cards
            document.querySelectorAll('.job-card').forEach(card => {
                card.classList.remove('active');
                card.classList.remove('border-blue-500');
                card.classList.add('border-transparent');
            });

            // Add active class to clicked card
            element.classList.add('active');
            element.classList.remove('border-transparent');
            element.classList.add('border-blue-500');

            // Fetch job details and update the right side
            fetchJobDetails(jobId);
        }

        function fetchJobDetails(jobId) {
            console.log('Fetching job details for ID:', jobId);

            // Show loading state
            const jobDetailContainer = document.getElementById('job-detail');
            jobDetailContainer.innerHTML = `
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Memuat Detail Lowongan...</h3>
                    <p class="text-gray-600">Mohon tunggu sebentar</p>
                </div>
            `;

            fetch(`/alumni/lowongan/${jobId}/details`)
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Job details received:', data);
                    updateJobDetail(data);
                })
                .catch(error => {
                    console.error('Error fetching job details:', error);
                    // Show error message to user
                    jobDetailContainer.innerHTML = `
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-800 mb-2">Error Loading Job Details</h3>
                            <p class="text-gray-600">Gagal memuat detail lowongan. Silakan coba lagi.</p>
                        </div>
                    `;
                });
        }

        function updateJobDetail(job) {
            const jobDetailContainer = document.getElementById('job-detail');

            // Format dates
            const formatDate = (dateString) => {
                if (!dateString) return '';
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            };

            // Format prodi array
            const formatProdi = (prodiArray) => {
                if (!prodiArray || prodiArray.length === 0) return '';
                return prodiArray.join(', ');
            };

            // Format persyaratan dokumen
            const formatDokumen = (dokumenArray) => {
                if (!dokumenArray || dokumenArray.length === 0) return '';
                return dokumenArray.map(doc => `• ${doc}`).join('<br>');
            };

            jobDetailContainer.innerHTML = `
                <!-- Company Logo Placeholder -->
                <div class="flex justify-between items-start mb-6">
                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-2xl font-bold text-gray-400">${job.mitra.nama_perusahaan.substring(0, 2)}</span>
                    </div>
                    <button class="bg-gradient-to-r from-blue-900 to-purple-700 text-white px-5 py-2 rounded-lg hover:from-blue-800 hover:to-purple-600 transition text-sm font-semibold">
                        ${job.jenis_pekerjaan}
                    </button>
                </div>

                <!-- Posisi & Peringatan -->
                <div class="mb-4">
                    <span class="text-xs text-red-500">1 Posisi - ${job.jumlah_pelamar} Pelamar</span>
                </div>

                <!-- Job Title -->
                <h2 class="text-2xl font-bold text-gray-800 mb-2">${job.judul}</h2>
                <p class="text-gray-600 mb-4">${job.mitra.nama_perusahaan}</p>

                <!-- Tags -->
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">${job.jenjang_pendidikan}</span>
                    ${job.pengalaman_minimal ? `<span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">${job.pengalaman_minimal}</span>` : ''}
                </div>

                <!-- Apply Button -->
               <a href="/alumni/lowongan/${job.id}/apply" class="block w-full bg-gradient-to-r from-blue-900 to-purple-700 text-white py-3 rounded-lg hover:from-blue-800 hover:to-purple-600 transition font-semibold mb-6 text-center">
                    Daftar Sekarang
                </a>

                <!-- Job Details -->
                <div class="space-y-5 mb-6">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-gray-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Pendidikan</h4>
                            <p class="text-sm text-gray-600">Jenjang Pendidikan: ${job.jenjang_pendidikan}</p>
                            ${formatProdi(job.prodi_diizinkan) ? `<p class="text-sm text-gray-600">Prodi: ${formatProdi(job.prodi_diizinkan)}</p>` : ''}
                        </div>
                    </div>

                    ${job.persyaratan_dokumen && job.persyaratan_dokumen.length > 0 ? `
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-gray-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Persyaratan Dokumen</h4>
                            <div class="text-sm text-gray-600">
                                ${formatDokumen(job.persyaratan_dokumen)}
                            </div>
                        </div>
                    </div>
                    ` : ''}

                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-gray-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Tanggal Penting</h4>
                            ${job.tanggal_penerimaan_lamaran ? `<p class="text-sm text-gray-600">• Penerimaan lamaran: ${formatDate(job.tanggal_penerimaan_lamaran)}</p>` : ''}
                            ${job.tanggal_pengumuman ? `<p class="text-sm text-gray-600">• Pengumuman: ${formatDate(job.tanggal_pengumuman)}</p>` : ''}
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="border-t pt-6">
                    <h3 class="font-bold text-gray-800 mb-3">Rincian Lowongan</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        ${job.rincian_lowongan}
                    </p>
                </div>
            `;
        }
    </script>
@endsection
