<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Alumni;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alumnis = [
            [
                'id' => Str::uuid(),
                'user_id' => User::first()->id, // Getting the first user (admin) as reference
                'nama' => 'John Doe',
                'nim' => '1234567890',
                'angkatan' => '2020',
                'program_studi_id' => null, // You should use actual program_studi UUID
                'deskripsi_diri' => 'Alumni jurusan Teknik Informatika',
            ],
            [
                'id' => Str::uuid(),
                'user_id' => User::skip(1)->first()->id, // Getting the second user
                'nama' => 'Jane Doe',
                'nim' => '0987654321',
                'angkatan' => '2021',
                'program_studi_id' => null, // You should use actual program_studi UUID
                'deskripsi_diri' => 'Alumni jurusan Sistem Informasi',
            ],
        ];
        foreach ($alumnis as $alumni) {
            Alumni::create($alumni);
        }
    }
}
