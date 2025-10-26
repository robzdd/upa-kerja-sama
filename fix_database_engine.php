<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Converting alumnis table to InnoDB..." . PHP_EOL;

$pdo = DB::connection()->getPdo();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Check current engine
    $result = $pdo->query("SHOW CREATE TABLE alumnis")->fetch(PDO::FETCH_ASSOC);
    echo "Current table definition obtained." . PHP_EOL;
    
    // Convert to InnoDB with ROW_FORMAT=DYNAMIC
    echo "Converting..." . PHP_EOL;
    $pdo->exec("ALTER TABLE alumnis ENGINE=InnoDB ROW_FORMAT=DYNAMIC");
    
    echo "SUCCESS! alumnis table converted to InnoDB!" . PHP_EOL;
    
    // Verify
    $status = $pdo->query("SHOW TABLE STATUS WHERE Name = 'alumnis'")->fetch(PDO::FETCH_ASSOC);
    echo "Engine: " . $status['Engine'] . PHP_EOL;
    
    // Test insert
    echo PHP_EOL . "Testing foreign key constraint..." . PHP_EOL;
    $alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';
    $newId = \Illuminate\Support\Str::uuid();
    
    DB::table('data_akademiks')->insert([
        'id' => $newId,
        'alumni_id' => $alumniId,
        'nim' => 'success_test',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    echo "Insert SUCCESS! Foreign key constraint is working!" . PHP_EOL;
    
    // Clean up
    DB::table('data_akademiks')->where('id', $newId)->delete();
    echo "Test completed." . PHP_EOL;
    
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage() . PHP_EOL;
} catch (\Exception $e) {
    echo "General Error: " . $e->getMessage() . PHP_EOL;
}

