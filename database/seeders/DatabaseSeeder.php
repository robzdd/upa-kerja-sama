<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Alumni;
use App\Models\MitraPerusahaan;
use App\Models\LowonganPekerjaan;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Get or create roles
        $alumniRole = Role::firstOrCreate(['name' => 'alumni', 'guard_name' => 'web']);
        $mitraRole = Role::firstOrCreate(['name' => 'mitra', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Create Alumni User
        $alumniUser = User::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
            ]
        );
        $alumniUser->assignRole('alumni');

        Alumni::firstOrCreate(
            ['user_id' => $alumniUser->id],
            [
                'nim' => '1234567890',
                'no_hp' => '081234567890',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Contoh No. 123',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => '12345',
                'tentang_saya' => 'Saya adalah seorang alumni yang sedang mencari pekerjaan.',
            ]
        );

        // Create Mitra User
        $mitraUser = User::firstOrCreate(
            ['email' => 'mitra@example.com'],
            [
                'name' => 'PT. Teknologi Indonesia',
                'password' => Hash::make('password'),
            ]
        );
        $mitraUser->assignRole('mitra');

        $mitra = MitraPerusahaan::firstOrCreate(
            ['user_id' => $mitraUser->id],
            [
                'nama_perusahaan' => 'PT. Teknologi Indonesia',
                'sektor' => 'Teknologi Informasi',
                'kontak' => '021-1234567',
                'tautan' => 'https://teknoindonesia.com',
                'mulai_kerjasama' => '2024-01-01',
                'akhir_kerjasama' => '2025-12-31',
            ]
        );

        // Create Additional Mitra User requested: perusahaan@example.com
        $perusahaanUser = User::firstOrCreate(
            ['email' => 'perusahaan@example.com'],
            [
                'name' => 'PT. Perusahaan Contoh',
                'password' => Hash::make('password'),
            ]
        );
        $perusahaanUser->assignRole('mitra');

        MitraPerusahaan::firstOrCreate(
            ['user_id' => $perusahaanUser->id],
            [
                'nama_perusahaan' => 'PT. Perusahaan Contoh',
                'sektor' => 'Beragam Industri',
                'kontak' => '021-7654321',
                'tautan' => 'https://perusahaancontoh.com',
                'mulai_kerjasama' => '2024-01-01',
                'akhir_kerjasama' => '2026-12-31',
            ]
        );

        // Create Admin User
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin UPA',
                'password' => Hash::make('password'),
            ]
        );
        $adminUser->assignRole('admin');

        // Create Job Listings
        $jobs = [
            [
                'judul' => 'Software Developer',
                'deskripsi' => 'Kami mencari Software Developer yang berpengalaman untuk bergabung dengan tim pengembangan kami. Anda akan bertanggung jawab untuk mengembangkan aplikasi web dan mobile yang inovatif.',
                'lokasi' => 'Jakarta',
                'gaji_min' => '8000000',
                'gaji_max' => '12000000',
                'jenis_pekerjaan' => 'Full Time',
                'pengalaman_minimal' => '2-5 tahun',
                'jenjang_pendidikan' => 'S1 Teknik Informatika',
                'skill_required' => json_encode(['JavaScript', 'React', 'Node.js', 'MySQL']),
                'rincian_lowongan' => 'Minimal 2 tahun pengalaman sebagai Software Developer. Menguasai JavaScript, React, Node.js. Familiar dengan database MySQL/PostgreSQL.',
                'tanggal_penerimaan_lamaran' => '2024-12-31',
                'status_aktif' => true,
            ],
            [
                'judul' => 'UI/UX Designer',
                'deskripsi' => 'Kami mencari UI/UX Designer yang kreatif dan berpengalaman untuk mendesain interface yang menarik dan user-friendly.',
                'lokasi' => 'Bandung',
                'gaji_min' => '6000000',
                'gaji_max' => '10000000',
                'jenis_pekerjaan' => 'Full Time',
                'pengalaman_minimal' => '1-3 tahun',
                'jenjang_pendidikan' => 'S1 Desain Komunikasi Visual',
                'skill_required' => json_encode(['Figma', 'Adobe Creative Suite', 'Prototyping']),
                'rincian_lowongan' => 'Minimal 1 tahun pengalaman sebagai UI/UX Designer. Menguasai Figma dan Adobe Creative Suite.',
                'tanggal_penerimaan_lamaran' => '2024-12-31',
                'status_aktif' => true,
            ],
            [
                'judul' => 'Data Analyst',
                'deskripsi' => 'Kami mencari Data Analyst yang dapat menganalisis data dan memberikan insight yang berguna untuk pengambilan keputusan bisnis.',
                'lokasi' => 'Surabaya',
                'gaji_min' => '7000000',
                'gaji_max' => '11000000',
                'jenis_pekerjaan' => 'Contract',
                'pengalaman_minimal' => '2-4 tahun',
                'jenjang_pendidikan' => 'S1 Statistika/Matematika',
                'skill_required' => json_encode(['Python', 'SQL', 'Tableau', 'Excel']),
                'rincian_lowongan' => 'Minimal 2 tahun pengalaman sebagai Data Analyst. Menguasai Python, SQL, dan tools visualisasi data.',
                'tanggal_penerimaan_lamaran' => '2024-12-31',
                'status_aktif' => true,
            ],
            [
                'judul' => 'Marketing Specialist',
                'deskripsi' => 'Kami mencari Marketing Specialist yang dapat mengembangkan strategi pemasaran dan meningkatkan brand awareness perusahaan.',
                'lokasi' => 'Jakarta',
                'gaji_min' => '5000000',
                'gaji_max' => '9000000',
                'jenis_pekerjaan' => 'Full Time',
                'pengalaman_minimal' => '1-3 tahun',
                'jenjang_pendidikan' => 'S1 Marketing/Komunikasi',
                'skill_required' => json_encode(['Digital Marketing', 'Social Media', 'Content Creation']),
                'rincian_lowongan' => 'Minimal 1 tahun pengalaman di bidang marketing. Menguasai digital marketing dan social media.',
                'tanggal_penerimaan_lamaran' => '2024-12-31',
                'status_aktif' => true,
            ],
            [
                'judul' => 'Frontend Developer',
                'deskripsi' => 'Kami mencari Frontend Developer yang dapat mengembangkan aplikasi web yang responsif dan modern.',
                'lokasi' => 'Yogyakarta',
                'gaji_min' => '6000000',
                'gaji_max' => '10000000',
                'jenis_pekerjaan' => 'Remote',
                'pengalaman_minimal' => '1-3 tahun',
                'jenjang_pendidikan' => 'S1 Teknik Informatika',
                'skill_required' => json_encode(['React', 'Vue.js', 'HTML', 'CSS', 'JavaScript']),
                'rincian_lowongan' => 'Minimal 1 tahun pengalaman sebagai Frontend Developer. Menguasai React atau Vue.js.',
                'tanggal_penerimaan_lamaran' => '2024-12-31',
                'status_aktif' => true,
            ],
        ];

        foreach ($jobs as $jobData) {
            LowonganPekerjaan::create([
                'mitra_id' => $mitra->id,
                ...$jobData,
            ]);
        }
    }
}