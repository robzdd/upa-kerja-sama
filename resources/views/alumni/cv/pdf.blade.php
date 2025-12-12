<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV {{ $alumni->nama_lengkap ?? 'Alumni' }}</title>
    <style>
        /* General Setup */
        @page {
            margin: 0.5in; /* Standard margins */
            size: A4 portrait;
        }

        body {
            font-family: "Times New Roman", Times, serif; /* Standard ATS font */
            font-size: 11pt;
            line-height: 1.3;
            color: #000;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        /* Typography */
        h1 {
            font-size: 24pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
            padding: 0;
            text-align: center;
            width: 100%;
        }

        h2 {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            margin: 18pt 0 8pt 0;
            padding-bottom: 2pt;
            letter-spacing: 1px;
            text-align: left;
        }

        h3 {
            font-size: 12pt;
            font-weight: bold;
            margin: 0;
        }

        p {
            margin: 0 0 4pt 0;
            text-align: justify;
        }

        a {
            color: #000;
            text-decoration: none;
        }

        /* Header Specifics */
        .header {
            text-align: center;
            width: 100%;
        }
        
        .contact-info {
            text-align: center;
            font-size: 10pt;
            margin-top: 5pt;
            margin-bottom: 15pt;
            width: 100%;
        }
        .contact-info span {
            margin: 0 3pt;
        }

        /* Tables for Layout */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 0;
            margin-bottom: 5pt;
        }
        
        td {
            vertical-align: top;
            padding: 0;
        }

        .td-left { 
            text-align: left; 
            width: auto;
        }
        
        .td-right { 
            text-align: right; 
            white-space: nowrap; 
            width: 1%; /* Shrink to fit content */
            padding-left: 20px;
        }
        
        /* Lists */
        ul {
            margin: 2pt 0 5pt 18pt;
            padding: 0;
            text-align: justify;
        }
        li {
            padding-left: 0;
            margin-bottom: 2pt;
        }

        /* Sections */
        .item {
            margin-bottom: 10pt;
            page-break-inside: avoid;
        }

        /* Utilities */
        .font-bold { font-weight: bold; }
        .italic { font-style: italic; }
        .text-sm { font-size: 10pt; }
        .text-center { text-align: center; }
        
        .personal-info-table td {
            padding-bottom: 3pt;
            padding-right: 10pt;
        }
        
        .personal-info-label {
            font-weight: bold;
            width: 150px;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h1>{{ $alumni->nama_lengkap ?? auth()->user()->name }}</h1>
        
        <div class="contact-info">
            {{ auth()->user()->email }}
            @if($alumni->no_hp) <span>|</span> {{ $alumni->no_hp }} @endif
            @if($alumni->alamat) <br>{{ $alumni->alamat }} @endif
        </div>

        @if($alumni->programStudi)
            <div style="text-align: center; font-size: 12pt; margin-top: -10pt; margin-bottom: 10pt;">
                {{ $alumni->programStudi->nama }}
            </div>
        @endif
    </div>

    <!-- SUMMARY -->
    @if($alumni->tentang_saya)
    <div class="section">
        <h2>Professional Summary</h2>
        <p>{{ $alumni->tentang_saya }}</p>
    </div>
    @endif

    <!-- EDUCATION -->
    @if($alumni->riwayatPendidikan && $alumni->riwayatPendidikan->count() > 0)
    <div class="section">
        <h2>Education</h2>
        @foreach($alumni->riwayatPendidikan as $pendidikan)
        <div class="item">
            <table>
                <tr>
                    <td class="td-left">
                        <h3>{{ $pendidikan->strata }}</h3>
                        <div class="font-bold">{{ $pendidikan->nama_sekolah }}</div>
                        @if($pendidikan->program_studi)
                        <div class="text-sm">{{ $pendidikan->program_studi }}</div>
                        @endif
                    </td>
                    <td class="td-right">
                        {{ \Carbon\Carbon::parse($pendidikan->tahun_masuk)->format('Y') }} - 
                        {{ $pendidikan->tahun_lulus ? \Carbon\Carbon::parse($pendidikan->tahun_lulus)->format('Y') : 'Present' }}
                    </td>
                </tr>
            </table>
            @if($pendidikan->deskripsi)
            <p>{{ $pendidikan->deskripsi }}</p>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    <!-- WORK EXPERIENCE -->
    @if($alumni->pengalamanKerja && $alumni->pengalamanKerja->count() > 0)
    <div class="section">
        <h2>Work Experience</h2>
        @foreach($alumni->pengalamanKerja as $pengalaman)
        <div class="item">
            <table>
                <tr>
                    <td class="td-left">
                        <h3>{{ $pengalaman->posisi }}</h3>
                        <div>
                            <span class="font-bold">{{ $pengalaman->perusahaan_organisasi }}</span>
                            <span class="text-sm">({{ $pengalaman->type == 'organisasi' ? 'Organization' : 'Company' }})</span>
                        </div>
                    </td>
                    <td class="td-right">
                        {{ \Carbon\Carbon::parse($pengalaman->mulai_kerja)->format('M Y') }} - 
                        {{ $pengalaman->selesai_kerja ? \Carbon\Carbon::parse($pengalaman->selesai_kerja)->format('M Y') : 'Present' }}
                    </td>
                </tr>
            </table>
            
            @if($pengalaman->deskripsi_piri)
            <ul>
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
    @endif

    <!-- CERTIFICATIONS & LICENSES -->
    @if($alumni->sertifikasi && $alumni->sertifikasi->count() > 0)
    <div class="section">
        <h2>Certifications & Licenses</h2>
        @foreach($alumni->sertifikasi as $cert)
        <div class="item">
            <table>
                <tr>
                    <td class="td-left">
                        <h3>{{ $cert->nama_sertifikasi }}</h3>
                        <div>{{ $cert->lembaga_sertifikasi }}</div>
                    </td>
                    <td class="td-right">
                        {{ \Carbon\Carbon::parse($cert->mulai_berlaku)->format('M Y') }}
                        @if($cert->selesai_berlaku)
                            - {{ \Carbon\Carbon::parse($cert->selesai_berlaku)->format('M Y') }}
                        @else
                            - No Expiration
                        @endif
                    </td>
                </tr>
            </table>
            @if($cert->deskripsi)
            <p class="text-sm" style="margin-top: 2pt;">{{ $cert->deskripsi }}</p>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    <!-- SKILLS -->
    @if(($alumni->keahlian && trim($alumni->keahlian)) || ($alumni->soft_skills && trim($alumni->soft_skills)))
    <div class="section">
        <h2>Skills</h2>
        
        @if($alumni->keahlian && trim($alumni->keahlian))
        <div class="item">
            <span class="font-bold">Technical Skills:</span>
            <span>
                @foreach(explode(',', $alumni->keahlian) as $index => $skill)
                    @if(trim($skill))
                        {{ trim($skill) }}@if(!$loop->last), @endif
                    @endif
                @endforeach
            </span>
        </div>
        @endif

        @if($alumni->soft_skills && trim($alumni->soft_skills))
        <div class="item">
            <span class="font-bold">Soft Skills:</span>
            <span>
                @foreach(explode(',', $alumni->soft_skills) as $index => $skill)
                    @if(trim($skill))
                        {{ trim($skill) }}@if(!$loop->last), @endif
                    @endif
                @endforeach
            </span>
        </div>
        @endif
    </div>
    @endif

    <!-- PERSONAL INFO -->
    @if($alumni->dataKeluarga || ($alumni->tempat_lahir && $alumni->tanggal_lahir))
    <div class="section">
        <h2>Personal Information</h2>
        <table class="personal-info-table">
            @if($alumni->tempat_lahir && $alumni->tanggal_lahir)
            <tr>
                <td class="personal-info-label">Place & Date of Birth</td>
                <td>: {{ $alumni->tempat_lahir }}, {{ \Carbon\Carbon::parse($alumni->tanggal_lahir)->format('d F Y') }}</td>
                <td class="personal-info-label">Gender</td>
                <td>: {{ $alumni->jenis_kelamin }}</td>
            </tr>
            @endif
            @if($alumni->dataKeluarga && $alumni->dataKeluarga->nama_ayah)
            <tr>
                <td class="personal-info-label">Father's Name</td>
                <td>: {{ $alumni->dataKeluarga->nama_ayah }}</td>
                <td class="personal-info-label">Mother's Name</td>
                <td>: {{ $alumni->dataKeluarga->nama_ibu }}</td>
            </tr>
            @endif
        </table>
    </div>
    @endif

</body>
</html>
