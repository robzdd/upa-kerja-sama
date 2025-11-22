<?php

namespace Database\Seeders;

use App\Models\KategoriArtikel;
use Illuminate\Database\Seeder;

class KategoriArtikelSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama' => 'Tutorial',
                'deskripsi' => 'Panduan dan tutorial langkah demi langkah'
            ],
            [
                'nama' => 'Tips & Trik',
                'deskripsi' => 'Tips dan trik berguna untuk meningkatkan produktivitas'
            ],
            [
                'nama' => 'Berita',
                'deskripsi' => 'Berita terkini dan update terbaru'
            ],
            [
                'nama' => 'Teknologi',
                'deskripsi' => 'Artikel seputar teknologi dan inovasi'
            ],
            [
                'nama' => 'Karir',
                'deskripsi' => 'Panduan karir dan pengembangan profesional'
            ],
            [
                'nama' => 'Lowongan Kerja',
                'deskripsi' => 'Informasi lowongan kerja dan peluang karir'
            ],
            [
                'nama' => 'Event',
                'deskripsi' => 'Informasi event, seminar, dan workshop'
            ],
            [
                'nama' => 'Pengumuman',
                'deskripsi' => 'Pengumuman resmi dan informasi penting'
            ],
        ];

        foreach ($kategoris as $kategori) {
            KategoriArtikel::create($kategori);
        }
    }
}
