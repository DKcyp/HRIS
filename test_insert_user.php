<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\UserAuth;

try {
    echo "Testing UserAuth Model...\n\n";
    
    // Count existing users
    echo "Counting existing users...\n";
    $count = UserAuth::count();
    echo "Current users count: $count\n\n";
    
    // Try to create a test user
    echo "Creating test user...\n";
    $user = UserAuth::create([
        'username' => 'testuser_' . time(),
        'nama' => 'Test User',
        'email' => 'test' . time() . '@example.com',
        'password' => 'password123',
        'role' => 'Employee',
        'status' => 'aktif',
    ]);
    
    echo "User created successfully!\n";
    echo "ID: " . $user->id . "\n";
    echo "Username: " . $user->username . "\n";
    echo "Email: " . $user->email . "\n";
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
