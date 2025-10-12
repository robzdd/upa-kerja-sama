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
            ['program_studi' => 'Sistem Informasi'],
            ['program_studi' => 'Teknologi Informasi'],
            ['program_studi' => 'Manajemen'],
            ['program_studi' => 'Akuntansi'],
            ['program_studi' => 'Ilmu Komunikasi'],
            ['program_studi' => 'Administrasi Publik'],
            ['program_studi' => 'Pendidikan Bahasa Inggris'],
            ['program_studi' => 'Agroteknologi'],
            ['program_studi' => 'Teknik Elektro'],
        ];

        foreach ($programStudis as $prodi) {
            ProgramStudi::create([
                'id' => (string) Str::uuid(),
                'program_studi' => $prodi['program_studi'],
            ]);
        }
    }
}
