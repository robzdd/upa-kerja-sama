<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$pdo = DB::connection()->getPdo();

echo "Converting alumnis table from MyISAM to InnoDB..." . PHP_EOL;

try {
    $pdo->exec("ALTER TABLE alumnis ENGINE=InnoDB");
    echo "Conversion successful!" . PHP_EOL;
    
    // Verify
    $status = $pdo->query("SHOW TABLE STATUS WHERE Name = 'alumnis'")->fetch(PDO::FETCH_ASSOC);
    echo "New engine: " . $status['Engine'] . PHP_EOL;
    
    // Test insert
    echo PHP_EOL . "Testing insert..." . PHP_EOL;
    $alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';
    $newId = \Illuminate\Support\Str::uuid();
    
    DB::table('data_akademiks')->insert([
        'id' => $newId,
        'alumni_id' => $alumniId,
        'nim' => 'test_success',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    echo "Insert SUCCESS! Foreign key constraint is now working!" . PHP_EOL;
    
    // Clean up
    DB::table('data_akademiks')->where('id', $newId)->delete();
    echo "Test completed and cleaned up." . PHP_EOL;
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}

