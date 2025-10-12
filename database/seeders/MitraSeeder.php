<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\MitraPerusahaan;
use App\Models\User;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user dengan email mitra1@example.com
        $user = User::where('email', 'mitra1@example.com')->first();

        if (!$user) {
            $this->command->warn('⚠️ User dengan email mitra1@example.com tidak ditemukan. Jalankan UserSeeder dulu.');
            return;
        }

        $mitras = [
            [
                'id' => (string) Str::uuid(),
                'user_id' => $user->id, // tambahkan ini!
                'nama_perusahaan' => 'PT Teknologi Nusantara',
                'logo' => 'logo1.png',
                'sektor' => 'Teknologi Informasi',
                'kontak' => '012313123',
                'tautan' => null,
                'mulai_kerjasama' => '2024-01-01',
                'akhir_kerjasama' => '2026-01-01',
            ],
        ];

        foreach ($mitras as $data) {
            MitraPerusahaan::updateOrCreate(
                ['user_id' => $data['user_id']],
                $data
            );
        }

        $this->command->info('✅ MitraSeeder berhasil dijalankan!');
    }
}
