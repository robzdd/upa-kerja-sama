<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking foreign key constraints...\n";

try {
    // Check if alumnis table exists
    $alumnisExists = DB::select("SHOW TABLES LIKE 'alumnis'");
    echo "Alumnis table exists: " . (count($alumnisExists) > 0 ? "YES" : "NO") . "\n";
    
    if (count($alumnisExists) > 0) {
        // Check alumnis table structure
        $alumnisStructure = DB::select("DESCRIBE alumnis");
        echo "Alumnis table structure:\n";
        foreach ($alumnisStructure as $column) {
            echo "  - {$column->Field}: {$column->Type}\n";
        }
        
        // Check foreign key constraints
        $constraints = DB::select("
            SELECT 
                CONSTRAINT_NAME,
                COLUMN_NAME,
                REFERENCED_TABLE_NAME,
                REFERENCED_COLUMN_NAME
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'alumnis' 
            AND REFERENCED_TABLE_NAME IS NOT NULL
        ");
        
        echo "\nForeign key constraints for alumnis:\n";
        foreach ($constraints as $constraint) {
            echo "  - {$constraint->CONSTRAINT_NAME}: {$constraint->COLUMN_NAME} -> {$constraint->REFERENCED_TABLE_NAME}.{$constraint->REFERENCED_COLUMN_NAME}\n";
        }
        
        // Check if users table exists
        $usersExists = DB::select("SHOW TABLES LIKE 'users'");
        echo "\nUsers table exists: " . (count($usersExists) > 0 ? "YES" : "NO") . "\n";
        
        if (count($usersExists) > 0) {
            // Check users table structure
            $usersStructure = DB::select("DESCRIBE users");
            echo "Users table structure:\n";
            foreach ($usersStructure as $column) {
                echo "  - {$column->Field}: {$column->Type}\n";
            }
            
            // Check if there are any users
            $userCount = DB::select("SELECT COUNT(*) as count FROM users")[0]->count;
            echo "Users count: {$userCount}\n";
            
            if ($userCount > 0) {
                $users = DB::select("SELECT id, name, email FROM users LIMIT 5");
                echo "Sample users:\n";
                foreach ($users as $user) {
                    echo "  - ID: {$user->id}, Name: {$user->name}, Email: {$user->email}\n";
                }
            }
        }
        
        // Check if there are any alumnis
        $alumniCount = DB::select("SELECT COUNT(*) as count FROM alumnis")[0]->count;
        echo "\nAlumnis count: {$alumniCount}\n";
        
        if ($alumniCount > 0) {
            $alumnis = DB::select("SELECT id, user_id FROM alumnis LIMIT 5");
            echo "Sample alumnis:\n";
            foreach ($alumnis as $alumni) {
                echo "  - ID: {$alumni->id}, User ID: {$alumni->user_id}\n";
            }
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
