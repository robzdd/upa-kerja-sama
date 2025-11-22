<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Daftar Permission berdasarkan peran
        $permissions = [
            // Alumni
            'registrasi pengguna',
            'kelola profil alumni',

            'lihat lowongan',
            'buat lamaran pekerjaan',
            'lihat status lamaran',
            'lihat mitra perusahaan',
            'lihat artikel berita',

            // Admin
            'kelola pengguna',
            'kelola program studi',
            'kelola kerjasama mitra',
            'kelola artikel berita',
            'kelola dokumen publik',
            'kelola lowongan pekerjaan',

            // Mitra Perusahaan
            'kelola lowongan perusahaan',
            'kelola profil perusahaan',

            // Umum
            'lihat profil upa',
            'lihat artikel berita umum',
            'lihat daftar mitra umum',
            'lihat profil alumni umum',
        ];

        // Buat Permission jika belum ada
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 🔹 Buat Role
        $alumni = Role::firstOrCreate(['name' => 'alumni']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $mitra = Role::firstOrCreate(['name' => 'mitra']);

        $umum = Role::firstOrCreate(['name' => 'umum']);

        // 🔹 Assign Permission ke Role
        $alumni->givePermissionTo([
            'registrasi pengguna',
            'kelola profil alumni',
            'lihat lowongan',
            'buat lamaran pekerjaan',
            'lihat status lamaran',
            'lihat mitra perusahaan',
            'lihat artikel berita',
        ]);

        $admin->givePermissionTo([
            'kelola pengguna',
            'kelola program studi',
            'kelola kerjasama mitra',
            'kelola artikel berita',
            'kelola dokumen publik',
            'kelola lowongan pekerjaan',
        ]);

        $mitra->givePermissionTo([
            'kelola lowongan perusahaan',
            'kelola profil perusahaan',
        ]);



        $umum->givePermissionTo([
            'lihat profil upa',
            'lihat artikel berita umum',
            'lihat daftar mitra umum',
            'lihat profil alumni umum',
        ]);
    }
}
