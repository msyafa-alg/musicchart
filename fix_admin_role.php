<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "Checking admin user role...\n";

$user = User::where('email', 'admin@musicchart.com')->first();

if ($user) {
    echo "Admin user found: " . $user->name . " - Current Role: " . $user->role . "\n";

    if ($user->role !== 'admin') {
        $user->role = 'admin';
        $user->save();
        echo "✅ UPDATED admin role to 'admin'\n";
    } else {
        echo "✅ Admin role is already correct\n";
    }
} else {
    echo "❌ Admin user not found in database\n";
}

echo "Done!\n";
