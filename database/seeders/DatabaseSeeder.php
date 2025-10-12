<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AlumniSeeder;
use Database\Seeders\ProgramStudiSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            MitraSeeder::class,
            MahasiswaSeeder::class,
            AlumniSeeder::class,
            ProgramStudiSeeder::class,
            LowonganPekerjaanSeeder::class,
        ]);
    }
}
