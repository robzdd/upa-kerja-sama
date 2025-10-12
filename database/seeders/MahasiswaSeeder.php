<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Mahasiswa;
use App\Models\User;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'mahasiswa1@example.com')->first();

        if (!$user) {
            $this->command->warn('User mahasiswa belum ada. Jalankan UserSeeder dulu.');
            return;
        }

        Mahasiswa::create([
            'id' => (string) Str::uuid(),
            'user_id' => $user->id,
            'program_studi_id' => null,
            'nim' => '2022010001',
            'angkatan' => '2022',
            'alamat' => 'Jl. Merdeka No. 10',
        ]);
    }
}
