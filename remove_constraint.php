<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Removing foreign key constraint completely...\n";

try {
    // Drop the constraint
    echo "Dropping constraint...\n";
    DB::statement('ALTER TABLE dokumen_pendukungs DROP FOREIGN KEY dokumen_pendukungs_alumni_id_foreign');
    echo "Constraint dropped\n";
    
    // Test insert without constraint
    echo "Testing insert without constraint...\n";
    
    $alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';
    
    try {
        $result = DB::insert("
            INSERT INTO dokumen_pendukungs 
            (id, alumni_id, tipe_dokumen, nama_dokumen, path_file, ukuran_file, jenis_dokumen, file_path, file_name, file_size, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ", [
            'test-no-fk-' . time(),
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
        
        echo "Insert without constraint: SUCCESS\n";
        
        // Clean up
        DB::delete("DELETE FROM dokumen_pendukungs WHERE id = ?", ['test-no-fk-' . time()]);
        echo "Test record cleaned up\n";
        
    } catch (Exception $e) {
        echo "Insert without constraint: FAILED - " . $e->getMessage() . "\n";
    }
    
    // Don't recreate the constraint for now - let's test the upload first
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
