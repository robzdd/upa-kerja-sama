@extends('alumni.layouts.app')

@section('title', 'Preview CV')

@section('content')
<div class="max-w-4xl mx-auto mt-8 mb-12 px-4">
    <!-- Header Actions -->
    <div class="flex items-center justify-between mb-6 print:hidden">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Preview CV</h1>
            <p class="text-gray-600 text-sm">Pratinjau CV Anda (ATS-Friendly Format)</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('alumni.cv.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 text-sm">
                Kembali
            </a>
            <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                Print CV
            </button>
        </div>
    </div>

    <!-- CV Preview - ATS Friendly -->
    <div class="bg-white rounded-lg shadow-lg p-12 print:shadow-none print:p-0" id="cv-content">
        
        <!-- HEADER -->
        <div class="text-center mb-8 pb-6 border-b-2 border-gray-800">
            <h1 class="text-3xl font-bold text-gray-900 mb-2 uppercase tracking-wide">
                {{ $alumni->nama_lengkap ?? auth()->user()->name }}
            </h1>
            @if($alumni->programStudi)
                <p class="text-base text-gray-700 font-medium mb-3">{{ $alumni->programStudi->nama }}</p>
            @endif
            <div class="text-sm text-gray-700 space-y-1">
                <p>{{ auth()->user()->email }}
                    @if($alumni->no_hp) | {{ $alumni->no_hp }} @endif
                </p>
                @if($alumni->alamat)
                <p>{{ $alumni->alamat }}</p>
                @endif
            </div>
        </div>

        <!-- PROFESSIONAL SUMMARY / TENTANG SAYA -->
        @if($alumni->tentang_saya)
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-3 uppercase tracking-wide border-b border-gray-400 pb-1">
                PROFESSIONAL SUMMARY
            </h2>
            <p class="text-gray-800 leading-relaxed text-justify">{{ $alumni->tentang_saya }}</p>
        </div>
        @endif

        <!-- EDUCATION -->
        @if($alumni->riwayatPendidikan && $alumni->riwayatPendidikan->count() > 0)
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-3 uppercase tracking-wide border-b border-gray-400 pb-1">
                EDUCATION
            </h2>
            <div class="space-y-4">
                @foreach($alumni->riwayatPendidikan as $pendidikan)
                <div>
                    <div class="flex justify-between items-start mb-1">
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $pendidikan->strata }}</h3>
                            <p class="text-gray-800 font-semibold">{{ $pendidikan->nama_sekolah }}</p>
                        </div>
                        <p class="text-gray-700 text-sm font-medium">
                            {{ \Carbon\Carbon::parse($pendidikan->tahun_masuk)->format('Y') }} - 
                            {{ $pendidikan->tahun_lulus ? \Carbon\Carbon::parse($pendidikan->tahun_lulus)->format('Y') : 'Present' }}
                        </p>
                    </div>
                    @if($pendidikan->deskripsi)
                    <p class="text-gray-700 text-sm mt-1">{{ $pendidikan->deskripsi }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- WORK EXPERIENCE -->
        @if($alumni->pengalamanKerja && $alumni->pengalamanKerja->count() > 0)
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-3 uppercase tracking-wide border-b border-gray-400 pb-1">
                WORK EXPERIENCE
            </h2>
            <div class="space-y-4">
                @foreach($alumni->pengalamanKerja as $pengalaman)
                <div>
                    <div class="flex justify-between items-start mb-1">
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $pengalaman->posisi }}</h3>
                            <p class="text-gray-800 font-semibold">
                                {{ $pengalaman->perusahaan_organisasi }}
                                <span class="text-gray-600 font-normal text-sm">
                                    ({{ $pengalaman->type == 'organisasi' ? 'Organization' : 'Company' }})
                                </span>
                            </p>
                        </div>
                        <p class="text-gray-700 text-sm font-medium">
                            {{ \Carbon\Carbon::parse($pengalaman->mulai_kerja)->format('M Y') }} - 
                            {{ $pengalaman->selesai_kerja ? \Carbon\Carbon::parse($pengalaman->selesai_kerja)->format('M Y') : 'Present' }}
                        </p>
                    </div>
                    @if($pengalaman->deskripsi_piri)
                    <ul class="list-disc list-inside text-gray-700 text-sm mt-2 space-y-1">
                        @foreach(explode("\n", $pengalaman->deskripsi_piri) as $item)
                            @if(trim($item))
                            <li>{{ trim($item) }}</li>
                            @endif
                        @endforeach
                    </ul>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- CERTIFICATIONS & LICENSES -->
        @if($alumni->sertifikasi && $alumni->sertifikasi->count() > 0)
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-3 uppercase tracking-wide border-b border-gray-400 pb-1">
                CERTIFICATIONS & LICENSES
            </h2>
            <div class="space-y-3">
                @foreach($alumni->sertifikasi as $cert)
                <div>
                    <div class="flex justify-between items-start mb-1">
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $cert->nama_sertifikasi }}</h3>
                            <p class="text-gray-800">{{ $cert->lembaga_sertifikasi }}</p>
                        </div>
                        <p class="text-gray-700 text-sm font-medium">
                            {{ \Carbon\Carbon::parse($cert->mulai_berlaku)->format('M Y') }}
                            @if($cert->selesai_berlaku)
                                - {{ \Carbon\Carbon::parse($cert->selesai_berlaku)->format('M Y') }}
                            @else
                                - No Expiration
                            @endif
                        </p>
                    </div>
                    @if($cert->deskripsi)
                    <p class="text-gray-700 text-sm">{{ $cert->deskripsi }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- SKILLS -->
        @if(($alumni->keahlian && trim($alumni->keahlian)) || ($alumni->soft_skills && trim($alumni->soft_skills)))
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-3 uppercase tracking-wide border-b border-gray-400 pb-1">
                SKILLS
            </h2>
            
            @if($alumni->keahlian && trim($alumni->keahlian))
            <div class="mb-3">
                <h3 class="font-semibold text-gray-900 mb-2">Technical Skills:</h3>
                <p class="text-gray-800">
                    @foreach(explode(',', $alumni->keahlian) as $index => $skill)
                        @if(trim($skill))
                            {{ trim($skill) }}@if(!$loop->last), @endif
                        @endif
                    @endforeach
                </p>
            </div>
            @endif

            @if($alumni->soft_skills && trim($alumni->soft_skills))
            <div>
                <h3 class="font-semibold text-gray-900 mb-2">Soft Skills:</h3>
                <p class="text-gray-800">
                    @foreach(explode(',', $alumni->soft_skills) as $index => $skill)
                        @if(trim($skill))
                            {{ trim($skill) }}@if(!$loop->last), @endif
                        @endif
                    @endforeach
                </p>
            </div>
            @endif
        </div>
        @endif

        <!-- PERSONAL INFORMATION (Optional) -->
        @if($alumni->dataKeluarga)
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-3 uppercase tracking-wide border-b border-gray-400 pb-1">
                PERSONAL INFORMATION
            </h2>
            <div class="grid grid-cols-2 gap-x-8 gap-y-2 text-sm">
                @if($alumni->tempat_lahir && $alumni->tanggal_lahir)
                <div>
                    <span class="font-semibold text-gray-900">Place & Date of Birth:</span>
                    <span class="text-gray-800">{{ $alumni->tempat_lahir }}, {{ \Carbon\Carbon::parse($alumni->tanggal_lahir)->format('d F Y') }}</span>
                </div>
                @endif
                @if($alumni->jenis_kelamin)
                <div>
                    <span class="font-semibold text-gray-900">Gender:</span>
                    <span class="text-gray-800">{{ $alumni->jenis_kelamin }}</span>
                </div>
                @endif
                @if($alumni->dataKeluarga->nama_ayah)
                <div>
                    <span class="font-semibold text-gray-900">Father's Name:</span>
                    <span class="text-gray-800">{{ $alumni->dataKeluarga->nama_ayah }}</span>
                </div>
                @endif
                @if($alumni->dataKeluarga->nama_ibu)
                <div>
                    <span class="font-semibold text-gray-900">Mother's Name:</span>
                    <span class="text-gray-800">{{ $alumni->dataKeluarga->nama_ibu }}</span>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- FOOTER -->
        <div class="mt-12 pt-4 border-t border-gray-300 text-center text-xs text-gray-600">
            <p>This CV was generated through Portal Kerja POLINDRA</p>
            <p class="mt-1">Last Updated: {{ now()->format('d F Y') }}</p>
        </div>
    </div>
</div>

<style>
/* Print Styles for ATS-Friendly CV */
@media print {
    @page {
        margin: 0.5in;
        size: A4;
    }
    
    body {
        font-family: 'Times New Roman', Times, serif;
        font-size: 11pt;
        line-height: 1.4;
        color: #000;
    }
    
    * {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    .print\:hidden {
        display: none !important;
    }
    
    .print\:shadow-none {
        box-shadow: none !important;
    }
    
    .print\:p-0 {
        padding: 0 !important;
    }
    
    #cv-content {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }
    
    h1 {
        font-size: 18pt;
        margin-bottom: 8pt;
    }
    
    h2 {
        font-size: 12pt;
        margin-top: 12pt;
        margin-bottom: 8pt;
        page-break-after: avoid;
    }
    
    h3 {
        font-size: 11pt;
        page-break-after: avoid;
    }
    
    p, li {
        font-size: 11pt;
        orphans: 3;
        widows: 3;
    }
    
    /* Prevent page breaks inside sections */
    .mb-8 {
        page-break-inside: avoid;
    }
    
    /* Ensure proper spacing */
    .space-y-4 > * + * {
        margin-top: 12pt;
    }
    
    .space-y-3 > * + * {
        margin-top: 10pt;
    }
    
    /* Remove shadows and rounded corners for print */
    .rounded-lg {
        border-radius: 0;
    }
    
    .shadow-lg {
        box-shadow: none;
    }
}

/* Screen Styles */
@media screen {
    #cv-content {
        font-family: 'Georgia', 'Times New Roman', Times, serif;
    }
}
</style>
@endsection
