<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking soft delete status...\n";

$alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';

try {
    // Check with soft delete
    $alumniWithSoftDelete = DB::select("SELECT * FROM alumnis WHERE id = ? AND deleted_at IS NULL", [$alumniId]);
    
    if (count($alumniWithSoftDelete) > 0) {
        echo "Alumni with ID {$alumniId} EXISTS and NOT soft deleted\n";
    } else {
        echo "Alumni with ID {$alumniId} is SOFT DELETED or does not exist\n";
        
        // Check if it's soft deleted
        $softDeleted = DB::select("SELECT * FROM alumnis WHERE id = ? AND deleted_at IS NOT NULL", [$alumniId]);
        if (count($softDeleted) > 0) {
            echo "  - Alumni is SOFT DELETED (deleted_at: {$softDeleted[0]->deleted_at})\n";
        }
    }
    
    // Check all alumnis including soft deleted
    $allAlumnis = DB::select("SELECT id, user_id, deleted_at FROM alumnis");
    echo "\nAll alumnis (including soft deleted):\n";
    foreach ($allAlumnis as $alumni) {
        $status = $alumni->deleted_at ? "DELETED ({$alumni->deleted_at})" : "ACTIVE";
        echo "  - ID: {$alumni->id}, User ID: {$alumni->user_id}, Status: {$status}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
