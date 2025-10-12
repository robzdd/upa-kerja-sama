<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Alumni;
use App\Models\DataAkademik;
use App\Models\DataKeluarga;
use App\Models\DokumenPendukung;
use App\Models\User;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah user alumni sudah ada
        $user = User::where('email', 'alumni1@example.com')->first();

        if (!$user) {
            $this->command->warn('User alumni belum ada. Jalankan UserSeeder dulu.');
            return;
        }

        // Buat atau update Alumni
        $alumni = Alumni::updateOrCreate(
            ['user_id' => $user->id],
            [
                'id' => (string) Str::uuid(),
                'program_studi_id' => null,
                'nim' => '2019010001',
                'no_hp' => '082123456789',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2000-05-15',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Merdeka No. 123, Krasak',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => '12345',
                'tentang_saya' => 'Saya adalah seorang programmer berpengalaman dengan fokus pada web development dan mobile apps.',
                'nama_bank' => 'Bank Mandiri',
                'no_rekening' => '1234567890',
                'file_cv' => null,
                'cv_updated_at' => null,
            ]
        );

        $this->command->info("Alumni berhasil dibuat/diupdate: {$alumni->id}");

        // Buat Data Akademik
        DataAkademik::updateOrCreate(
            ['alumni_id' => $alumni->id],
            [
                'id' => (string) Str::uuid(),
                'nim' => '2019010001',
                'program_studi' => 'Teknik Informatika',
                'tahun_masuk' => 2019,
                'tahun_lulus' => 2023,
                'ipk' => 3.75,
                'universitas' => 'Institut Teknologi Sepuluh Nopember (ITS)',
            ]
        );

        $this->command->info("Data Akademik berhasil dibuat/diupdate");

        // Buat Data Keluarga
        DataKeluarga::updateOrCreate(
            ['alumni_id' => $alumni->id],
            [
                'id' => (string) Str::uuid(),
                'nama_ayah' => 'Budi Santoso',
                'pekerjaan_ayah' => 'Pengusaha',
                'nama_ibu' => 'Siti Nurhaliza',
                'pekerjaan_ibu' => 'Guru',
                'nama_wali' => null,
                'pekerjaan_wali' => null,
                'alamat_keluarga' => 'Jl. Merdeka No. 123, Krasak, Jakarta',
            ]
        );

        $this->command->info("Data Keluarga berhasil dibuat/diupdate");

        // Buat Dokumen Pendukung (optional - hanya untuk demo)
        $this->createSampleDocuments($alumni);

        $this->command->info("Seeding Alumni berhasil!");
    }

    private function createSampleDocuments(Alumni $alumni): void
    {
        // Cek apakah sudah ada dokumen
        if ($alumni->dokumenPendukung()->exists()) {
            $this->command->info("Dokumen pendukung sudah ada, skip pembuatan dokumen baru");
            return;
        }

        // Note: Dokumen ini adalah placeholder, pastikan file benar-benar ada di storage
        // Jika ingin membuat dokumen sebenarnya, gunakan cara lain (upload manual atau generate PDF)

        $documents = [
            [
                'id' => (string) Str::uuid(),
                'alumni_id' => $alumni->id,
                'tipe_dokumen' => 'ijazah',
                'nama_dokumen' => 'Ijazah S1 Teknik Informatika',
                'path_file' => 'dokumen-alumni/' . $alumni->id . '/ijazah.pdf',
                'ukuran_file' => 2048000,
            ],
            [
                'id' => (string) Str::uuid(),
                'alumni_id' => $alumni->id,
                'tipe_dokumen' => 'transkrip',
                'nama_dokumen' => 'Transkrip Nilai Semester 1-8',
                'path_file' => 'dokumen-alumni/' . $alumni->id . '/transkrip.pdf',
                'ukuran_file' => 1024000,
            ],
            [
                'id' => (string) Str::uuid(),
                'alumni_id' => $alumni->id,
                'tipe_dokumen' => 'sertifikat',
                'nama_dokumen' => 'Sertifikat Kompetisi Programming 2022',
                'path_file' => 'dokumen-alumni/' . $alumni->id . '/sertifikat-programming.pdf',
                'ukuran_file' => 512000,
            ],
        ];

        foreach ($documents as $document) {
            DokumenPendukung::create(array_merge(
                $document,
                ['id' => (string) Str::uuid()]
            ));
        }

        $this->command->info("Dokumen pendukung berhasil dibuat");
    }
}
