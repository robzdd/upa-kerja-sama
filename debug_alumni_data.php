<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Debugging alumni data...\n";

try {
    $alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';
    
    // Check all alumnis with raw query
    echo "All alumnis in database:\n";
    $allAlumnis = DB::select("SELECT id, user_id, deleted_at, created_at FROM alumnis ORDER BY created_at");
    foreach ($allAlumnis as $alumni) {
        $status = $alumni->deleted_at ? "DELETED ({$alumni->deleted_at})" : "ACTIVE";
        echo "  - ID: '{$alumni->id}', User: '{$alumni->user_id}', Status: {$status}, Created: {$alumni->created_at}\n";
    }
    
    // Check if the specific alumni exists with different queries
    echo "\nChecking specific alumni with different queries:\n";
    
    // Query 1: Exact match
    $exact = DB::select("SELECT * FROM alumnis WHERE id = ?", [$alumniId]);
    echo "  - Exact match: " . (count($exact) > 0 ? "FOUND" : "NOT FOUND") . "\n";
    
    // Query 2: With LIKE
    $like = DB::select("SELECT * FROM alumnis WHERE id LIKE ?", ["%{$alumniId}%"]);
    echo "  - LIKE match: " . (count($like) > 0 ? "FOUND" : "NOT FOUND") . "\n";
    
    // Query 3: With BINARY
    $binary = DB::select("SELECT * FROM alumnis WHERE BINARY id = ?", [$alumniId]);
    echo "  - BINARY match: " . (count($binary) > 0 ? "FOUND" : "NOT FOUND") . "\n";
    
    // Query 4: Check if there are any alumnis at all
    $count = DB::select("SELECT COUNT(*) as count FROM alumnis")[0]->count;
    echo "  - Total alumnis: {$count}\n";
    
    // Query 5: Check with hex comparison
    $hex = bin2hex($alumniId);
    $hexQuery = DB::select("SELECT * FROM alumnis WHERE HEX(id) = ?", [$hex]);
    echo "  - HEX match: " . (count($hexQuery) > 0 ? "FOUND" : "NOT FOUND") . "\n";
    
    // Check if there are any constraints on alumnis table
    echo "\nChecking constraints on alumnis table:\n";
    $constraints = DB::select("
        SELECT CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
        FROM information_schema.KEY_COLUMN_USAGE 
        WHERE TABLE_SCHEMA = DATABASE() 
        AND TABLE_NAME = 'alumnis' 
        AND REFERENCED_TABLE_NAME IS NOT NULL
    ");
    
    foreach ($constraints as $constraint) {
        echo "  - {$constraint->CONSTRAINT_NAME}: {$constraint->COLUMN_NAME} -> {$constraint->REFERENCED_TABLE_NAME}.{$constraint->REFERENCED_COLUMN_NAME}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
