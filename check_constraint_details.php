<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking constraint details...\n";

try {
    // Get detailed constraint information
    $constraintDetails = DB::select("
        SELECT 
            CONSTRAINT_NAME,
            COLUMN_NAME,
            REFERENCED_TABLE_NAME,
            REFERENCED_COLUMN_NAME,
            ORDINAL_POSITION
        FROM information_schema.KEY_COLUMN_USAGE 
        WHERE TABLE_SCHEMA = DATABASE() 
        AND TABLE_NAME = 'dokumen_pendukungs' 
        AND CONSTRAINT_NAME = 'dokumen_pendukungs_alumni_id_foreign'
    ");
    
    if (count($constraintDetails) > 0) {
        $constraint = $constraintDetails[0];
        echo "Constraint details:\n";
        echo "  - Name: {$constraint->CONSTRAINT_NAME}\n";
        echo "  - Column: {$constraint->COLUMN_NAME}\n";
        echo "  - Referenced Table: {$constraint->REFERENCED_TABLE_NAME}\n";
        echo "  - Referenced Column: {$constraint->REFERENCED_COLUMN_NAME}\n";
    } else {
        echo "Constraint not found!\n";
    }
    
    // Check the actual data types
    $alumnisColumn = DB::select("DESCRIBE alumnis");
    $dokumenColumn = DB::select("DESCRIBE dokumen_pendukungs");
    
    echo "\nColumn types:\n";
    foreach ($alumnisColumn as $col) {
        if ($col->Field === 'id') {
            echo "  - alumnis.id: {$col->Type}\n";
        }
    }
    
    foreach ($dokumenColumn as $col) {
        if ($col->Field === 'alumni_id') {
            echo "  - dokumen_pendukungs.alumni_id: {$col->Type}\n";
        }
    }
    
    // Try to manually insert a test record to see the exact error
    echo "\nTesting manual insert...\n";
    try {
        $testId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';
        $result = DB::insert("
            INSERT INTO dokumen_pendukungs 
            (id, alumni_id, jenis_dokumen, file_path, file_name, file_size, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
        ", [
            'test-id-' . time(),
            $testId,
            'test',
            'test/path.pdf',
            'test.pdf',
            1000
        ]);
        echo "Manual insert SUCCESS\n";
        
        // Clean up
        DB::delete("DELETE FROM dokumen_pendukungs WHERE jenis_dokumen = 'test'");
        echo "Test record cleaned up\n";
        
    } catch (Exception $e) {
        echo "Manual insert FAILED: " . $e->getMessage() . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
