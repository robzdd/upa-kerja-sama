<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Checking and converting alumnis table..." . PHP_EOL;

try {
    $status = DB::select("SHOW TABLE STATUS WHERE Name = 'alumnis'");
    $currentEngine = $status[0]->Engine;
    echo "Current engine: " . $currentEngine . PHP_EOL;
    
    if ($currentEngine !== 'InnoDB') {
        echo "Converting to InnoDB..." . PHP_EOL;
        
        // MySQL might have a lock on the table, let's try with the safe method
        $pdo = DB::connection()->getPdo();
        $pdo->exec("ALTER TABLE alumnis ENGINE=InnoDB");
        
        echo "Conversion successful!" . PHP_EOL;
        
        // Verify
        $status2 = DB::select("SHOW TABLE STATUS WHERE Name = 'alumnis'");
        echo "New engine: " . $status2[0]->Engine . PHP_EOL;
    } else {
        echo "Already InnoDB, no conversion needed." . PHP_EOL;
    }
    
    // Now test the insert
    echo PHP_EOL . "Testing insert..." . PHP_EOL;
    $alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';
    $newId = \Illuminate\Support\Str::uuid();
    
    try {
        $result = DB::table('data_akademiks')->insert([
            'id' => $newId,
            'alumni_id' => $alumniId,
            'nim' => 'test_success',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        echo "Insert SUCCESS! Foreign key constraint is working!" . PHP_EOL;
        
        // Clean up
        DB::table('data_akademiks')->where('id', $newId)->delete();
        echo "Test completed and cleaned up." . PHP_EOL;
    } catch (\Exception $e) {
        echo "Insert failed: " . $e->getMessage() . PHP_EOL;
    }
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}

