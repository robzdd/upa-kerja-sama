<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking constraint status...\n";

try {
    // Check constraint status
    $constraintStatus = DB::select("
        SELECT 
            CONSTRAINT_NAME,
            CONSTRAINT_TYPE,
            IS_DEFERRABLE,
            INITIALLY_DEFERRED
        FROM information_schema.TABLE_CONSTRAINTS 
        WHERE TABLE_SCHEMA = DATABASE() 
        AND TABLE_NAME = 'dokumen_pendukungs' 
        AND CONSTRAINT_NAME = 'dokumen_pendukungs_alumni_id_foreign'
    ");
    
    if (count($constraintStatus) > 0) {
        $constraint = $constraintStatus[0];
        echo "Constraint status:\n";
        echo "  - Name: {$constraint->CONSTRAINT_NAME}\n";
        echo "  - Type: {$constraint->CONSTRAINT_TYPE}\n";
        echo "  - Deferrable: {$constraint->IS_DEFERRABLE}\n";
        echo "  - Initially Deferred: {$constraint->INITIALLY_DEFERRED}\n";
    } else {
        echo "Constraint not found in TABLE_CONSTRAINTS!\n";
    }
    
    // Check if we can disable foreign key checks temporarily
    echo "\nTesting with foreign key checks disabled...\n";
    
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
    
    // Check if the constraint is actually working by trying to insert invalid data
    echo "\nTesting with invalid alumni_id...\n";
    
    try {
        $result = DB::insert("
            INSERT INTO dokumen_pendukungs 
            (id, alumni_id, tipe_dokumen, nama_dokumen, path_file, ukuran_file, jenis_dokumen, file_path, file_name, file_size, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ", [
            'test-invalid-' . time(),
            'invalid-alumni-id',
            'cv',
            'test.pdf',
            'dokumen_pendukung/test.pdf',
            1000,
            'cv',
            'dokumen_pendukung/test.pdf',
            'test.pdf',
            1000
        ]);
        
        echo "Insert with invalid alumni_id: SUCCESS (this should NOT happen!)\n";
        
    } catch (Exception $e) {
        echo "Insert with invalid alumni_id: FAILED (expected) - " . $e->getMessage() . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
