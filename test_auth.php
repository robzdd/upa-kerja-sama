<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "Testing database connection...\n";
    
    $user = App\Models\User::where('email', 'john@example.com')->first();
    
    if ($user) {
        echo "User found: " . $user->name . "\n";
        echo "User roles: " . $user->getRoleNames()->implode(', ') . "\n";
        
        // Test login
        if (Hash::check('password', $user->password)) {
            echo "Password is correct\n";
            
            // Test token creation
            $token = $user->createToken('test-token');
            echo "Token created: " . substr($token->plainTextToken, 0, 20) . "...\n";
        } else {
            echo "Password is incorrect\n";
        }
    } else {
        echo "User not found\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
