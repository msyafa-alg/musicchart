<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Auth;
use App\Models\User;

echo "Testing admin login redirection...\n";

// Simulate admin login
$user = User::where('email', 'admin@musicchart.com')->first();

if ($user) {
    echo "Admin user found: " . $user->name . " - Role: " . $user->role . "\n";
    echo "isAdmin() method result: " . ($user->isAdmin() ? 'true' : 'false') . "\n";

    // Simulate authentication
    Auth::login($user);

    echo "Auth::check(): " . (Auth::check() ? 'true' : 'false') . "\n";
    echo "Auth::user()->isAdmin(): " . (Auth::user()->isAdmin() ? 'true' : 'false') . "\n";

    // Test middleware logic
    if (Auth::check() && Auth::user()->isAdmin()) {
        echo "✅ Admin user should be redirected to admin dashboard\n";
        echo "Expected redirect route: admin.dashboard (/admin/dashboard)\n";
    } else {
        echo "❌ Admin user would be redirected to user dashboard\n";
        echo "Expected redirect route: user.dashboard (/user/dashboard)\n";
    }

    Auth::logout();
} else {
    echo "❌ Admin user not found\n";
}

echo "Done!\n";
