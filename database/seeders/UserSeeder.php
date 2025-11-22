<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'id' => (string) Str::uuid(),
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Admin Kampus',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Mitra 1',
                'email' => 'mitra1@example.com',
                'password' => Hash::make('password'),
            ],

            [
                'id' => (string) Str::uuid(),
                'name' => 'Alumni 1',
                'email' => 'alumni1@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $index => $data) {
            $user = User::create($data);
            // Assigning role sesuai urutan
            if ($index === 0) {
                $user->assignRole('admin'); // Super Admin
            } elseif ($index === 1) {
                $user->assignRole('admin'); // Admin Kampus
            } elseif ($index === 2) {
                $user->assignRole('mitra'); // Mitra 1

            } elseif ($index === 4) {
                $user->assignRole('alumni'); // Alumni 1
            }
        }
    }
}
