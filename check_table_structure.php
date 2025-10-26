<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking dokumen_pendukungs table structure...\n";

try {
    $columns = DB::select('DESCRIBE dokumen_pendukungs');
    
    echo "Column details:\n";
    foreach ($columns as $col) {
        $nullStatus = $col->Null === 'NO' ? 'NOT NULL' : 'NULL';
        $default = $col->Default ? "DEFAULT '{$col->Default}'" : 'NO DEFAULT';
        echo "  - {$col->Field}: {$col->Type} ({$nullStatus}) {$default}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
