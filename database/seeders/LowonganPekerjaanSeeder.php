<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LowonganPekerjaan;
use App\Models\MitraPerusahaan;
use Carbon\Carbon;

class LowonganPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing mitra companies
        $mitraCompanies = MitraPerusahaan::all();

        if ($mitraCompanies->isEmpty()) {
            $this->command->warn('No mitra companies found. Please run MitraSeeder first.');
            return;
        }

        $lowonganData = [
            [
                'judul' => 'UI/UX Designer',
                'posisi' => 'UI/UX Designer',
                'deskripsi' => 'Kami mencari UI/UX Designer yang kreatif dan berpengalaman untuk bergabung dengan tim kami.',
                'lokasi' => 'Jakarta, Indonesia',
                'jenis_pekerjaan' => 'Full-Time',
                'jenjang_pendidikan' => 'S1',
                'prodi_diizinkan' => ['Teknik Informatika', 'Sistem Informasi Kota Cerdas'],
                'persyaratan_dokumen' => ['CV/Resume', 'Portfolio', 'Sertifikat'],
                'rincian_lowongan' => 'Kami mencari UI/UX Designer yang dapat merancang antarmuka pengguna yang menarik dan fungsional. Kandidat harus memiliki pengalaman minimal 2 tahun dalam desain UI/UX, menguasai tools seperti Figma, Adobe XD, dan Sketch. Tanggung jawab meliputi merancang wireframe, mockup, dan prototype untuk aplikasi web dan mobile.',
                'tanggal_penerimaan_lamaran' => Carbon::now()->addDays(30),
                'tanggal_pengumuman' => Carbon::now()->addDays(45),
                'gaji_min' => '8.000.000',
                'gaji_max' => '12.000.000',
                'pengalaman_minimal' => '2-3 tahun',
                'skill_required' => ['Figma', 'Adobe XD', 'Sketch', 'HTML/CSS', 'JavaScript'],
                'jumlah_pelamar' => 15,
                'status_aktif' => true,
            ],
            [
                'judul' => 'Software Developer',
                'posisi' => 'Software Developer',
                'deskripsi' => 'Bergabunglah dengan tim development kami untuk mengembangkan aplikasi web dan mobile yang inovatif.',
                'lokasi' => 'Bandung, Indonesia',
                'jenis_pekerjaan' => 'Full-Time',
                'jenjang_pendidikan' => 'S1',
                'prodi_diizinkan' => ['Teknik Informatika', 'Sistem Informasi Kota Cerdas', 'Rekayasa Perangkat Lunak'],
                'persyaratan_dokumen' => ['CV/Resume', 'Portfolio', 'Transkrip Nilai'],
                'rincian_lowongan' => 'Kami mencari Software Developer yang dapat mengembangkan aplikasi web dan mobile menggunakan teknologi modern. Kandidat harus menguasai bahasa pemrograman seperti JavaScript, Python, atau Java, serta framework seperti React, Node.js, atau Spring Boot.',
                'tanggal_penerimaan_lamaran' => Carbon::now()->addDays(25),
                'tanggal_pengumuman' => Carbon::now()->addDays(40),
                'gaji_min' => '10.000.000',
                'gaji_max' => '15.000.000',
                'pengalaman_minimal' => '3-5 tahun',
                'skill_required' => ['JavaScript', 'React', 'Node.js', 'Python', 'MySQL'],
                'jumlah_pelamar' => 28,
                'status_aktif' => true,
            ],
            [
                'judul' => 'Data Analyst',
                'posisi' => 'Data Analyst',
                'deskripsi' => 'Kami mencari Data Analyst untuk menganalisis data dan memberikan insights yang berharga bagi bisnis.',
                'lokasi' => 'Surabaya, Indonesia',
                'jenis_pekerjaan' => 'Contract',
                'jenjang_pendidikan' => 'S1',
                'prodi_diizinkan' => ['Teknik Informatika', 'Sistem Informasi Kota Cerdas'],
                'persyaratan_dokumen' => ['CV/Resume', 'Transkrip Nilai', 'Sertifikat'],
                'rincian_lowongan' => 'Kami mencari Data Analyst yang dapat menganalisis data bisnis dan memberikan rekomendasi strategis. Kandidat harus menguasai tools seperti Python, R, SQL, dan Tableau. Pengalaman dalam machine learning dan data visualization akan menjadi nilai tambah.',
                'tanggal_penerimaan_lamaran' => Carbon::now()->addDays(20),
                'tanggal_pengumuman' => Carbon::now()->addDays(35),
                'gaji_min' => '7.000.000',
                'gaji_max' => '10.000.000',
                'pengalaman_minimal' => '1-2 tahun',
                'skill_required' => ['Python', 'R', 'SQL', 'Tableau', 'Excel'],
                'jumlah_pelamar' => 12,
                'status_aktif' => true,
            ],
            [
                'judul' => 'Digital Marketing Specialist',
                'posisi' => 'Digital Marketing Specialist',
                'deskripsi' => 'Bergabunglah dengan tim marketing kami untuk mengembangkan strategi digital marketing yang efektif.',
                'lokasi' => 'Yogyakarta, Indonesia',
                'jenis_pekerjaan' => 'Part-Time',
                'jenjang_pendidikan' => 'D3',
                'prodi_diizinkan' => ['Teknik Informatika', 'Rekayasa Perangkat Lunak'],
                'persyaratan_dokumen' => ['CV/Resume', 'Portfolio', 'Sertifikat'],
                'rincian_lowongan' => 'Kami mencari Digital Marketing Specialist yang dapat mengelola kampanye digital marketing, social media, dan content marketing. Kandidat harus memiliki pengalaman dalam Google Ads, Facebook Ads, SEO, dan content creation.',
                'tanggal_penerimaan_lamaran' => Carbon::now()->addDays(15),
                'tanggal_pengumuman' => Carbon::now()->addDays(30),
                'gaji_min' => '5.000.000',
                'gaji_max' => '8.000.000',
                'pengalaman_minimal' => 'Fresh Graduate',
                'skill_required' => ['Google Ads', 'Facebook Ads', 'SEO', 'Content Creation', 'Social Media'],
                'jumlah_pelamar' => 8,
                'status_aktif' => true,
            ],
            [
                'judul' => 'DevOps Engineer',
                'posisi' => 'DevOps Engineer',
                'deskripsi' => 'Kami mencari DevOps Engineer untuk mengelola infrastructure dan deployment pipeline.',
                'lokasi' => 'Medan, Indonesia',
                'jenis_pekerjaan' => 'Full-Time',
                'jenjang_pendidikan' => 'S1',
                'prodi_diizinkan' => ['Teknik Informatika', 'Sistem Informasi Kota Cerdas'],
                'persyaratan_dokumen' => ['CV/Resume', 'Sertifikat', 'Transkrip Nilai'],
                'rincian_lowongan' => 'Kami mencari DevOps Engineer yang dapat mengelola cloud infrastructure, CI/CD pipeline, dan monitoring systems. Kandidat harus menguasai tools seperti Docker, Kubernetes, AWS, dan monitoring tools seperti Prometheus dan Grafana.',
                'tanggal_penerimaan_lamaran' => Carbon::now()->addDays(35),
                'tanggal_pengumuman' => Carbon::now()->addDays(50),
                'gaji_min' => '12.000.000',
                'gaji_max' => '18.000.000',
                'pengalaman_minimal' => '3-5 tahun',
                'skill_required' => ['Docker', 'Kubernetes', 'AWS', 'Linux', 'CI/CD'],
                'jumlah_pelamar' => 5,
                'status_aktif' => true,
            ],
            [
                'judul' => 'Frontend Developer',
                'posisi' => 'Frontend Developer',
                'deskripsi' => 'Bergabunglah dengan tim frontend kami untuk mengembangkan user interface yang menarik dan responsif.',
                'lokasi' => 'Semarang, Indonesia',
                'jenis_pekerjaan' => 'Internship',
                'jenjang_pendidikan' => 'Fresh Graduate',
                'prodi_diizinkan' => ['Teknik Informatika', 'Sistem Informasi Kota Cerdas', 'Rekayasa Perangkat Lunak'],
                'persyaratan_dokumen' => ['CV/Resume', 'Portfolio', 'Transkrip Nilai'],
                'rincian_lowongan' => 'Program internship untuk fresh graduate yang ingin belajar pengembangan frontend. Kandidat akan belajar React, Vue.js, HTML, CSS, dan JavaScript. Program berlangsung selama 6 bulan dengan kemungkinan diangkat menjadi karyawan tetap.',
                'tanggal_penerimaan_lamaran' => Carbon::now()->addDays(10),
                'tanggal_pengumuman' => Carbon::now()->addDays(25),
                'gaji_min' => '2.000.000',
                'gaji_max' => '3.000.000',
                'pengalaman_minimal' => 'Fresh Graduate',
                'skill_required' => ['HTML', 'CSS', 'JavaScript', 'React', 'Vue.js'],
                'jumlah_pelamar' => 25,
                'status_aktif' => true,
            ],
            [
                'judul' => 'Backend Developer',
                'posisi' => 'Backend Developer',
                'deskripsi' => 'Kami mencari Backend Developer untuk mengembangkan API dan sistem backend yang robust.',
                'lokasi' => 'Makassar, Indonesia',
                'jenis_pekerjaan' => 'Full-Time',
                'jenjang_pendidikan' => 'S1',
                'prodi_diizinkan' => ['Teknik Informatika', 'Sistem Informasi Kota Cerdas Kota Cerdas', 'Rekayasa Perangkat Lunak'],
                'persyaratan_dokumen' => ['CV/Resume', 'Portfolio', 'Sertifikat'],
                'rincian_lowongan' => 'Kami mencari Backend Developer yang dapat mengembangkan RESTful API, microservices, dan database design. Kandidat harus menguasai bahasa pemrograman seperti Java, Python, atau Node.js, serta framework seperti Spring Boot, Django, atau Express.js.',
                'tanggal_penerimaan_lamaran' => Carbon::now()->addDays(40),
                'tanggal_pengumuman' => Carbon::now()->addDays(55),
                'gaji_min' => '9.000.000',
                'gaji_max' => '14.000.000',
                'pengalaman_minimal' => '2-3 tahun',
                'skill_required' => ['Java', 'Python', 'Node.js', 'Spring Boot', 'PostgreSQL'],
                'jumlah_pelamar' => 18,
                'status_aktif' => true,
            ],
            [
                'judul' => 'Product Manager',
                'posisi' => 'Product Manager',
                'deskripsi' => 'Bergabunglah dengan tim product kami untuk mengelola product roadmap dan strategi produk.',
                'lokasi' => 'Palembang, Indonesia',
                'jenis_pekerjaan' => 'Full-Time',
                'jenjang_pendidikan' => 'S1',
                'prodi_diizinkan' => ['Teknik Informatika', 'Sistem Informasi Kota Cerdas'],
                'persyaratan_dokumen' => ['CV/Resume', 'Portfolio', 'Sertifikat'],
                'rincian_lowongan' => 'Kami mencari Product Manager yang dapat mengelola product lifecycle, melakukan market research, dan berkoordinasi dengan tim development. Kandidat harus memiliki pengalaman dalam product management tools seperti Jira, Confluence, dan analytics tools.',
                'tanggal_penerimaan_lamaran' => Carbon::now()->addDays(45),
                'tanggal_pengumuman' => Carbon::now()->addDays(60),
                'gaji_min' => '15.000.000',
                'gaji_max' => '20.000.000',
                'pengalaman_minimal' => '5+ tahun',
                'skill_required' => ['Product Management', 'Jira', 'Analytics', 'Agile', 'Scrum'],
                'jumlah_pelamar' => 7,
                'status_aktif' => true,
            ]
        ];

        foreach ($lowonganData as $index => $data) {
            // Assign to different mitra companies
            $mitra = $mitraCompanies[$index % $mitraCompanies->count()];

            LowonganPekerjaan::create([
                'mitra_id' => $mitra->id,
                'judul' => $data['judul'],
                'posisi' => $data['posisi'],
                'deskripsi' => $data['deskripsi'],
                'lokasi' => $data['lokasi'],
                'jenis_pekerjaan' => $data['jenis_pekerjaan'],
                'jenjang_pendidikan' => $data['jenjang_pendidikan'],
                'prodi_diizinkan' => $data['prodi_diizinkan'],
                'persyaratan_dokumen' => $data['persyaratan_dokumen'],
                'rincian_lowongan' => $data['rincian_lowongan'],
                'tanggal_penerimaan_lamaran' => $data['tanggal_penerimaan_lamaran'],
                'tanggal_pengumuman' => $data['tanggal_pengumuman'],
                'gaji_min' => $data['gaji_min'],
                'gaji_max' => $data['gaji_max'],
                'pengalaman_minimal' => $data['pengalaman_minimal'],
                'skill_required' => $data['skill_required'],
                'jumlah_pelamar' => $data['jumlah_pelamar'],
                'status_aktif' => $data['status_aktif'],
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }

        $this->command->info('Lowongan pekerjaan seeded successfully!');
    }
}
