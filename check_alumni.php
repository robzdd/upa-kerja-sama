<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking specific alumni ID...\n";

$alumniId = '591e3123-a0b5-48ac-98bc-093c2afedbd7';

try {
    // Check if alumni exists
    $alumni = DB::select("SELECT * FROM alumnis WHERE id = ?", [$alumniId]);
    
    if (count($alumni) > 0) {
        echo "Alumni with ID {$alumniId} EXISTS\n";
        $alumni = $alumni[0];
        echo "  - User ID: {$alumni->user_id}\n";
        echo "  - NIM: {$alumni->nim}\n";
        echo "  - Created: {$alumni->created_at}\n";
    } else {
        echo "Alumni with ID {$alumniId} does NOT exist\n";
    }
    
    // Check all alumnis
    $allAlumnis = DB::select("SELECT id, user_id, nim FROM alumnis");
    echo "\nAll alumnis in database:\n";
    foreach ($allAlumnis as $alumni) {
        echo "  - ID: {$alumni->id}, User ID: {$alumni->user_id}, NIM: {$alumni->nim}\n";
    }
    
    // Check if the user exists
    $userId = 'f109537e-52c9-4e91-a983-a1a4739a5b06';
    $user = DB::select("SELECT * FROM users WHERE id = ?", [$userId]);
    
    if (count($user) > 0) {
        echo "\nUser with ID {$userId} EXISTS\n";
        $user = $user[0];
        echo "  - Name: {$user->name}\n";
        echo "  - Email: {$user->email}\n";
    } else {
        echo "\nUser with ID {$userId} does NOT exist\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
