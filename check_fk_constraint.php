<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';

echo "Checking foreign key constraint..." . PHP_EOL;

// Check if the foreign key is working at all
$check = DB::select("
    SELECT COUNT(*) as cnt 
    FROM alumnis 
    WHERE id = ? 
    AND deleted_at IS NULL
", [$alumniId]);

echo "Alumni exists and not deleted: " . ($check[0]->cnt > 0 ? "YES" : "NO") . PHP_EOL;

// Now try a manual foreign key check
echo PHP_EOL . "Testing foreign key validation manually..." . PHP_EOL;

try {
    $result = DB::statement("
        SET FOREIGN_KEY_CHECKS = 1;
    ");
    echo "FK checks enabled: OK" . PHP_EOL;
    
    // Try to validate the foreign key exists
    $exists = DB::selectOne("
        SELECT EXISTS(
            SELECT 1 FROM alumnis WHERE id = ?
        ) as exists_check
    ", [$alumniId]);
    
    echo "Exists check: " . ($exists->exists_check ? "YES" : "NO") . PHP_EOL;
    
    // Now try to explain the insert
    echo PHP_EOL . "Trying EXPLAIN on INSERT..." . PHP_EOL;
    $explain = DB::select("EXPLAIN INSERT INTO data_akademiks (id, alumni_id, nim, created_at, updated_at) VALUES (?, ?, 'test', NOW(), NOW())", [\Illuminate\Support\Str::uuid(), $alumniId]);
    print_r($explain);
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}

