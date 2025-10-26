<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Only create table if it doesn't exist to avoid tablespace issues
        if (!Schema::hasTable('alumnis')) {
            // Create table with MyISAM first to avoid tablespace issues, then convert to InnoDB
            DB::statement('
                CREATE TABLE alumnis (
                    id CHAR(36) NOT NULL PRIMARY KEY,
                    user_id CHAR(36) NOT NULL,
                    program_studi_id CHAR(36) NULL,
                    nim VARCHAR(255) NULL,
                    nik VARCHAR(255) NULL,
                    no_hp VARCHAR(255) NULL,
                    tempat_lahir VARCHAR(255) NULL,
                    tanggal_lahir DATE NULL,
                    jenis_kelamin ENUM("Laki-laki", "Perempuan") NULL,
                    alamat TEXT NULL,
                    kota VARCHAR(255) NULL,
                    provinsi VARCHAR(255) NULL,
                    kode_pos VARCHAR(255) NULL,
                    tentang_saya TEXT NULL,
                    nama_bank VARCHAR(255) NULL,
                    no_rekening VARCHAR(255) NULL,
                    file_cv VARCHAR(255) NULL,
                    cv_updated_at TIMESTAMP NULL,
                    created_at TIMESTAMP NULL,
                    updated_at TIMESTAMP NULL,
                    deleted_at TIMESTAMP NULL,
                    INDEX alumnis_nim_index (nim)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
            ');
            
            // Convert to InnoDB (this will create new tablespace)
            try {
                $tableStatus = DB::selectOne("SHOW TABLE STATUS LIKE 'alumnis'");
                if ($tableStatus && $tableStatus->Engine !== 'InnoDB') {
                    DB::statement('ALTER TABLE alumnis ENGINE=InnoDB');
                }
                
                // Add foreign keys after table creation
                DB::statement('ALTER TABLE alumnis ADD CONSTRAINT alumnis_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');
                DB::statement('ALTER TABLE alumnis ADD CONSTRAINT alumnis_program_studi_id_foreign FOREIGN KEY (program_studi_id) REFERENCES program_studis(id) ON DELETE SET NULL');
            } catch (\Exception $e) {
                // If foreign key constraints already exist or table is already InnoDB, ignore error
            }
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
