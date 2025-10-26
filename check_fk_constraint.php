<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking foreign key constraints for alumnis table...\n";

try {
    // Check if the specific constraint exists
    $constraintExists = DB::select("
        SELECT CONSTRAINT_NAME 
        FROM information_schema.KEY_COLUMN_USAGE 
        WHERE TABLE_SCHEMA = DATABASE() 
        AND TABLE_NAME = 'alumnis' 
        AND CONSTRAINT_NAME = 'dokumen_pendukungs_alumni_id_foreign'
    ");
    
    if (count($constraintExists) > 0) {
        echo "Constraint 'dokumen_pendukungs_alumni_id_foreign' EXISTS\n";
    } else {
        echo "Constraint 'dokumen_pendukungs_alumni_id_foreign' does NOT exist\n";
    }
    
    // Check all constraints on alumnis table
    $allConstraints = DB::select("
        SELECT CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
        FROM information_schema.KEY_COLUMN_USAGE 
        WHERE TABLE_SCHEMA = DATABASE() 
        AND TABLE_NAME = 'alumnis' 
        AND REFERENCED_TABLE_NAME IS NOT NULL
    ");
    
    echo "\nAll foreign key constraints on alumnis table:\n";
    foreach ($allConstraints as $constraint) {
        echo "  - {$constraint->CONSTRAINT_NAME}: {$constraint->COLUMN_NAME} -> {$constraint->REFERENCED_TABLE_NAME}.{$constraint->REFERENCED_COLUMN_NAME}\n";
    }
    
    // Check all constraints on dokumen_pendukungs table
    $dokumenConstraints = DB::select("
        SELECT CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
        FROM information_schema.KEY_COLUMN_USAGE 
        WHERE TABLE_SCHEMA = DATABASE() 
        AND TABLE_NAME = 'dokumen_pendukungs' 
        AND REFERENCED_TABLE_NAME IS NOT NULL
    ");
    
    echo "\nAll foreign key constraints on dokumen_pendukungs table:\n";
    foreach ($dokumenConstraints as $constraint) {
        echo "  - {$constraint->CONSTRAINT_NAME}: {$constraint->COLUMN_NAME} -> {$constraint->REFERENCED_TABLE_NAME}.{$constraint->REFERENCED_COLUMN_NAME}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}