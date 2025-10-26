<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - {{ $alumni->nama_lengkap ?? 'Alumni' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            .print\\:shadow-none { box-shadow: none !important; }
            body { margin: 0; padding: 0; }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-4">
        <!-- Header with actions -->
        <div class="bg-white rounded-lg shadow p-4 mb-6 no-print">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">CV Publik</h1>
                    <p class="text-gray-600">{{ $alumni->nama_lengkap ?? 'Alumni' }}</p>
                </div>
                <div class="flex space-x-2">
                    <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                        Print CV
                    </button>
                    <a href="{{ route('home') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 text-sm">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- CV Content -->
        <div class="bg-white rounded-lg shadow-lg p-8 print:shadow-none">
            <!-- CV Header -->
            <div class="text-center mb-8 border-b border-gray-200 pb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $alumni->nama_lengkap ?? 'Nama Alumni' }}</h1>
                <p class="text-lg text-gray-600 mb-2">{{ $alumni->user->email ?? 'email@example.com' }}</p>
                <p class="text-gray-500">{{ $alumni->no_hp ?? '-' }} | {{ $alumni->alamat ?? '-' }}</p>
            </div>

            <!-- About Me -->
            @if($alumni->tentang_saya)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Tentang Saya</h2>
                <p class="text-gray-700 leading-relaxed">{{ $alumni->tentang_saya }}</p>
            </div>
            @endif

            <!-- Personal Information -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Informasi Pribadi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span class="font-medium text-gray-700">Nama Lengkap:</span>
                        <span class="text-gray-900 ml-2">{{ $alumni->nama_lengkap ?? 'Nama Alumni' }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Email:</span>
                        <span class="text-gray-900 ml-2">{{ $alumni->user->email ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">No Handphone:</span>
                        <span class="text-gray-900 ml-2">{{ $alumni->no_hp ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Jenis Kelamin:</span>
                        <span class="text-gray-900 ml-2">{{ $alumni->jenis_kelamin ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Tempat, Tanggal Lahir:</span>
                        <span class="text-gray-900 ml-2">{{ $alumni->tempat_lahir ?? '-' }}, {{ $alumni->tanggal_lahir ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Alamat:</span>
                        <span class="text-gray-900 ml-2">{{ $alumni->alamat ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Education -->
            @if($alumni->dataAkademik)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Pendidikan</h2>
                <div class="space-y-4">
                    <div class="border-l-4 border-blue-500 pl-4">
                        <h3 class="font-semibold text-gray-900">{{ $alumni->dataAkademik->universitas ?? 'Universitas' }}</h3>
                        <p class="text-gray-600">{{ $alumni->dataAkademik->program_studi ?? 'Program Studi' }}</p>
                        <p class="text-sm text-gray-500">{{ $alumni->dataAkademik->tahun_masuk ?? '' }} - {{ $alumni->dataAkademik->tahun_lulus ?? '' }}</p>
                        @if($alumni->dataAkademik->ipk)
                        <p class="text-sm text-gray-500">IPK: {{ $alumni->dataAkademik->ipk }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Hard Skills -->
            @if($alumni->keahlian)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Hard Skills</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $alumni->keahlian) as $skill)
                        @if(trim($skill))
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            {{ trim($skill) }}
                        </span>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Soft Skills -->
            @if($alumni->soft_skills)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Soft Skills</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $alumni->soft_skills) as $skill)
                        @if(trim($skill))
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            {{ trim($skill) }}
                        </span>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Experience -->
            @if($alumni->cvData && $alumni->cvData->where('tipe_data', 'pengalaman')->count() > 0)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Pengalaman Kerja</h2>
                <div class="space-y-4">
                    @foreach($alumni->cvData->where('tipe_data', 'pengalaman') as $pengalaman)
                    <div class="border-l-4 border-green-500 pl-4">
                        <h3 class="font-semibold text-gray-900">{{ $pengalaman->judul }}</h3>
                        <p class="text-gray-600">{{ $pengalaman->instansi }}</p>
                        <p class="text-sm text-gray-500">{{ $pengalaman->periode }}</p>
                        @if($pengalaman->deskripsi)
                        <p class="text-gray-700 mt-2">{{ $pengalaman->deskripsi }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Achievements -->
            @if($alumni->cvData && $alumni->cvData->where('tipe_data', 'prestasi')->count() > 0)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Prestasi</h2>
                <div class="space-y-3">
                    @foreach($alumni->cvData->where('tipe_data', 'prestasi') as $prestasi)
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ $prestasi->judul }}</h3>
                            @if($prestasi->deskripsi)
                            <p class="text-gray-600 text-sm">{{ $prestasi->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Organizations -->
            @if($alumni->cvData && $alumni->cvData->where('tipe_data', 'organisasi')->count() > 0)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Organisasi</h2>
                <div class="space-y-3">
                    @foreach($alumni->cvData->where('tipe_data', 'organisasi') as $organisasi)
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ $organisasi->judul }}</h3>
                            @if($organisasi->deskripsi)
                            <p class="text-gray-600 text-sm">{{ $organisasi->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Family Information -->
            @if($alumni->dataKeluarga)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-300 pb-2">Informasi Keluarga</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($alumni->dataKeluarga->nama_ayah)
                    <div>
                        <span class="font-medium text-gray-700">Nama Ayah:</span>
                        <span class="text-gray-900 ml-2">{{ $alumni->dataKeluarga->nama_ayah }}</span>
                    </div>
                    @endif
                    @if($alumni->dataKeluarga->nama_ibu)
                    <div>
                        <span class="font-medium text-gray-700">Nama Ibu:</span>
                        <span class="text-gray-900 ml-2">{{ $alumni->dataKeluarga->nama_ibu }}</span>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</body>
</html>
