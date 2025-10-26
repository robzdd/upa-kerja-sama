<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Fixing foreign key constraint...\n";

try {
    // Drop the existing constraint
    echo "Dropping existing constraint...\n";
    try {
        DB::statement('ALTER TABLE dokumen_pendukungs DROP FOREIGN KEY dokumen_pendukungs_alumni_id_foreign');
        echo "Constraint dropped successfully\n";
    } catch (Exception $e) {
        echo "Error dropping constraint: " . $e->getMessage() . "\n";
    }
    
    // Recreate the constraint
    echo "Recreating constraint...\n";
    try {
        DB::statement('ALTER TABLE dokumen_pendukungs ADD CONSTRAINT dokumen_pendukungs_alumni_id_foreign FOREIGN KEY (alumni_id) REFERENCES alumnis(id) ON DELETE CASCADE');
        echo "Constraint recreated successfully\n";
    } catch (Exception $e) {
        echo "Error recreating constraint: " . $e->getMessage() . "\n";
    }
    
    // Test the constraint
    echo "\nTesting constraint...\n";
    
    $alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';
    
    try {
        $result = DB::insert("
            INSERT INTO dokumen_pendukungs 
            (id, alumni_id, tipe_dokumen, nama_dokumen, path_file, ukuran_file, jenis_dokumen, file_path, file_name, file_size, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ", [
            'test-id-3-' . time(),
            $alumniId,
            'cv',
            'test.pdf',
            'dokumen_pendukung/test.pdf',
            1000,
            'cv',
            'dokumen_pendukung/test.pdf',
            'test.pdf',
            1000
        ]);
        
        echo "Insert test: SUCCESS\n";
        
        // Clean up
        DB::delete("DELETE FROM dokumen_pendukungs WHERE id = ?", ['test-id-3-' . time()]);
        echo "Test record cleaned up\n";
        
    } catch (Exception $e) {
        echo "Insert test: FAILED - " . $e->getMessage() . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
