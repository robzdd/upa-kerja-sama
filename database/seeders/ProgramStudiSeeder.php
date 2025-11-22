<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\ProgramStudi;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programStudis = [
            ['program_studi' => 'Teknik Informatika'],
            ['program_studi' => 'Sistem Informasi Kota Cerdas'],
            ['program_studi' => 'Rekayasa Perangkat Lunak'],
            ['program_studi' => 'Teknologi Rekayasa Komputer'],
            ['program_studi' => 'Teknik Mesin'],
            ['program_studi' => 'Teknik Pendingin'],
            ['program_studi' => 'Perancangan Manufaktur'],
            ['program_studi' => 'Teknologi Rekayasa Instrumentasi & Kontrol'],
            ['program_studi' => 'Keperawatan'],
            ['program_studi' => 'Teknologi Laboratorium Medis'],
            ['program_studi' => 'Teknologi Rekayasa Elektro-Medis'],
            
        ];

        foreach ($programStudis as $prodi) {
            ProgramStudi::create([
                'id' => (string) Str::uuid(),
                'program_studi' => $prodi['program_studi'],
            ]);
        }
    }
}
