<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking constraint with simple test...\n";

try {
    // Test with foreign key checks disabled
    echo "Testing with foreign key checks disabled...\n";
    
    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    
    $alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';
    
    try {
        $result = DB::insert("
            INSERT INTO dokumen_pendukungs 
            (id, alumni_id, tipe_dokumen, nama_dokumen, path_file, ukuran_file, jenis_dokumen, file_path, file_name, file_size, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ", [
            'test-id-' . time(),
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
        
        echo "Insert with FK checks disabled: SUCCESS\n";
        
        // Clean up
        DB::delete("DELETE FROM dokumen_pendukungs WHERE id = ?", ['test-id-' . time()]);
        echo "Test record cleaned up\n";
        
    } catch (Exception $e) {
        echo "Insert with FK checks disabled: FAILED - " . $e->getMessage() . "\n";
    }
    
    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    
    // Now test with FK checks enabled
    echo "\nTesting with foreign key checks enabled...\n";
    
    try {
        $result = DB::insert("
            INSERT INTO dokumen_pendukungs 
            (id, alumni_id, tipe_dokumen, nama_dokumen, path_file, ukuran_file, jenis_dokumen, file_path, file_name, file_size, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ", [
            'test-id-2-' . time(),
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
        
        echo "Insert with FK checks enabled: SUCCESS\n";
        
        // Clean up
        DB::delete("DELETE FROM dokumen_pendukungs WHERE id = ?", ['test-id-2-' . time()]);
        echo "Test record cleaned up\n";
        
    } catch (Exception $e) {
        echo "Insert with FK checks enabled: FAILED - " . $e->getMessage() . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
