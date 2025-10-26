<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Debugging charset and data...\n";

try {
    $alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';
    
    // Check the exact data in alumnis table
    $alumni = DB::select("SELECT id, HEX(id) as hex_id, LENGTH(id) as id_length FROM alumnis WHERE id = ?", [$alumniId]);
    
    if (count($alumni) > 0) {
        $alumni = $alumni[0];
        echo "Alumni found:\n";
        echo "  - ID: '{$alumni->id}'\n";
        echo "  - HEX: {$alumni->hex_id}\n";
        echo "  - Length: {$alumni->id_length}\n";
        
        // Check if the ID matches exactly
        $testId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';
        $testHex = bin2hex($testId);
        echo "  - Test ID: '{$testId}'\n";
        echo "  - Test HEX: {$testHex}\n";
        echo "  - Test Length: " . strlen($testId) . "\n";
        
        // Check if they match
        if ($alumni->id === $testId) {
            echo "  - IDs MATCH exactly\n";
        } else {
            echo "  - IDs DO NOT match exactly\n";
        }
        
        // Check charset and collation
        $tableInfo = DB::select("SHOW TABLE STATUS LIKE 'alumnis'");
        if (count($tableInfo) > 0) {
            $info = $tableInfo[0];
            echo "  - Table Collation: {$info->Collation}\n";
        }
        
        $columnInfo = DB::select("SHOW FULL COLUMNS FROM alumnis WHERE Field = 'id'");
        if (count($columnInfo) > 0) {
            $col = $columnInfo[0];
            echo "  - Column Collation: {$col->Collation}\n";
        }
        
    } else {
        echo "Alumni not found!\n";
    }
    
    // Check dokumen_pendukungs table info
    $dokumenInfo = DB::select("SHOW TABLE STATUS LIKE 'dokumen_pendukungs'");
    if (count($dokumenInfo) > 0) {
        $info = $dokumenInfo[0];
        echo "\nDokumen table info:\n";
        echo "  - Table Collation: {$info->Collation}\n";
    }
    
    $dokumenColumnInfo = DB::select("SHOW FULL COLUMNS FROM dokumen_pendukungs WHERE Field = 'alumni_id'");
    if (count($dokumenColumnInfo) > 0) {
        $col = $dokumenColumnInfo[0];
        echo "  - Column Collation: {$col->Collation}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
