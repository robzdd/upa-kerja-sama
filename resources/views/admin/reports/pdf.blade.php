<!DOCTYPE html>
<html>
<head>
    <title>Laporan UPA Polindra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }
        
        /* Header */
        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
            position: relative;
        }
        .header-logo {
            float: left;
            width: 70px;
            height: 70px;
            margin-right: 20px;
        }
        .header-content {
            text-align: center;
        }
        .header h1 {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0 0 5px 0;
            color: #000;
        }
        .header h2 {
            font-size: 14px;
            font-weight: bold;
            margin: 0 0 5px 0;
        }
        .header p {
            margin: 0;
            font-size: 10px;
        }

        /* Content */
        .report-title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            text-decoration: underline;
        }
        .report-period {
            text-align: center;
            font-size: 11px;
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 12px;
            font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
            color: #000;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            font-size: 10px;
            text-align: center;
        }
        td {
            font-size: 10px;
        }
        
        /* Helpers */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .mt-4 { margin-top: 20px; }
        
        /* Summary Grid */
        .summary-table {
            width: 100%;
            margin-bottom: 20px;
            border: none;
        }
        .summary-table td {
            border: none;
            padding: 10px;
            vertical-align: top;
        }
        .summary-box {
            border: 1px solid #000;
            padding: 15px;
            text-align: center;
        }
        .summary-value {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        .summary-label {
            font-size: 10px;
            text-transform: uppercase;
        }

        /* Signature */
        .signature-block {
            margin-top: 50px;
            page-break-inside: avoid;
        }
        .signature-table {
            width: 100%;
            border: none;
        }
        .signature-table td {
            border: none;
            text-align: center;
            vertical-align: top;
            width: 33%;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            font-size: 9px;
            border-top: 1px solid #ccc;
            padding-top: 5px;
            text-align: right;
        }
        
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <!-- Logo Placeholder (Uncomment if logo path is fixed) -->
        <!-- <img src="{{ public_path('images/logo.png') }}" class="header-logo"> -->
        <div class="header-content">
            <h1>Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi</h1>
            <h2>Politeknik Negeri Indramayu</h2>
            <p>Jalan Raya Lohbener Lama No. 08, Lohbener, Indramayu 45252</p>
            <p>Telepon: (0234) 5746764 | Email: info@polindra.ac.id | Website: www.polindra.ac.id</p>
            <p style="margin-top: 5px; font-weight: bold;">UNIT PENUNJANG AKADEMIK (UPA) PENGEMBANGAN KARIR DAN KERJASAMA</p>
        </div>
    </div>

    <div class="report-title">LAPORAN STATISTIK DAN KINERJA</div>
    <div class="report-period">
        Periode: {{ \Carbon\Carbon::parse($startDate)->isoFormat('D MMMM Y') }} - {{ \Carbon\Carbon::parse($endDate)->isoFormat('D MMMM Y') }}
    </div>

    <!-- Executive Summary -->
    <div class="section">
        <div class="section-title">A. Ringkasan Eksekutif</div>
        <table class="summary-table">
            <tr>
                <td width="25%">
                    <div class="summary-box">
                        <span class="summary-value">{{ number_format($totalAlumni) }}</span>
                        <span class="summary-label">Total Alumni</span>
                    </div>
                </td>
                <td width="25%">
                    <div class="summary-box">
                        <span class="summary-value">{{ number_format($totalMitra) }}</span>
                        <span class="summary-label">Total Mitra</span>
                    </div>
                </td>
                <td width="25%">
                    <div class="summary-box">
                        <span class="summary-value">{{ number_format($totalLowongan) }}</span>
                        <span class="summary-label">Total Lowongan</span>
                    </div>
                </td>
                <td width="25%">
                    <div class="summary-box">
                        <span class="summary-value">{{ number_format($totalLamaran) }}</span>
                        <span class="summary-label">Total Lamaran</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Monthly Growth -->
    <div class="section">
        <div class="section-title">B. Pertumbuhan User & Lowongan (Bulanan)</div>
        <table>
            <thead>
                <tr>
                    <th width="40%">Bulan</th>
                    <th width="30%">User Baru</th>
                    <th width="30%">Lowongan Baru</th>
                </tr>
            </thead>
            <tbody>
                @foreach($months as $index => $month)
                <tr>
                    <td class="text-center">{{ $month }}</td>
                    <td class="text-center">{{ number_format($userCounts[$index]) }}</td>
                    <td class="text-center">{{ number_format($lowonganCounts[$index]) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Alumni by Prodi -->
    <div class="section">
        <div class="section-title">C. Distribusi Alumni per Program Studi</div>
        <table>
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th width="70%">Program Studi</th>
                    <th width="20%">Jumlah Alumni Baru</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alumniByProdi as $index => $prodi)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $prodi->program_studi }}</td>
                    <td class="text-center">{{ number_format($prodi->alumni_count) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data program studi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Application Status -->
    <div class="section">
        <div class="section-title">D. Distribusi Status Lamaran</div>
        <table>
            <thead>
                <tr>
                    <th width="40%">Status</th>
                    <th width="30%">Jumlah</th>
                    <th width="30%">Persentase</th>
                </tr>
            </thead>
            <tbody>
                @php $totalLamaranPie = array_sum($lamaranStatus); @endphp
                @forelse($lamaranStatus as $status => $count)
                <tr>
                    <td>{{ ucfirst($status) }}</td>
                    <td class="text-center">{{ number_format($count) }}</td>
                    <td class="text-center">{{ $totalLamaranPie > 0 ? number_format(($count / $totalLamaranPie) * 100, 1) : 0 }}%</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada data lamaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="page-break"></div>

    <!-- Top Companies -->
    <div class="section">
        <div class="section-title">E. Top 5 Mitra Perusahaan (Paling Aktif)</div>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="40%">Nama Perusahaan</th>
                    <th width="25%">Sektor</th>
                    <th width="15%">Bergabung Sejak</th>
                    <th width="15%">Jml Lowongan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topCompanies as $index => $company)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $company->nama_perusahaan }}</td>
                    <td>{{ $company->sektor }}</td>
                    <td class="text-center">{{ $company->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">{{ number_format($company->lowongan_count) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data perusahaan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Recent Job Postings -->
    <div class="section">
        <div class="section-title">F. Aktivitas Lowongan Terbaru (10 Terakhir)</div>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="30%">Judul Posisi</th>
                    <th width="30%">Perusahaan</th>
                    <th width="20%">Tgl Posting</th>
                    <th width="15%">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentLowongan as $index => $job)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $job->posisi }}</td>
                    <td>{{ $job->mitra->nama_perusahaan ?? '-' }}</td>
                    <td class="text-center">{{ $job->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">{{ $job->status_aktif ? 'Aktif' : 'Tutup' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada lowongan terbaru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Signature -->
    <div class="signature-block">
        <table class="signature-table">
            <tr>
                <td></td>
                <td></td>
                <td>
                    Indramayu, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}<br>
                    Kepala UPA Pengembangan Karir<br>
                    dan Kerjasama,
                    <br><br><br><br><br>
                    <strong>(Nama Pejabat)</strong><br>
                    NIP. ...........................
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }} | Halaman <script type="text/php">if (isset($pdf)) { echo $pdf->get_page_number(); }</script>
    </div>
</body>
</html>
