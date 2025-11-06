<?php

namespace Database\Seeders;

use App\Models\KategoriArtikel;
use Illuminate\Database\Seeder;

class KategoriArtikelSeeder extends Seeder
{
    public function run()
    {
        KategoriArtikel::create(['nama' => 'Pengembangan Karir']);
        KategoriArtikel::create(['nama' => 'Teknologi']);
        KategoriArtikel::create(['nama' => 'Tips Kerja']);
    }
}
