<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\DB;

// Check database connection
try {
    echo "=== Database Test ===\n";
    echo "Users count: " . User::count() . "\n";

    if (User::count() > 0) {
        $user = User::first();
        echo "First user: {$user->username}, Points: {$user->points}\n";

        // Test topup functionality
        echo "\n=== Testing Topup Functionality ===\n";
        $originalPoints = $user->points;
        $topupAmount = 100;

        echo "Original points: {$originalPoints}\n";
        echo "Topup amount: {$topupAmount}\n";

        // Simulate topup
        $user->increment('points', $topupAmount);
        $newPoints = $user->fresh()->points;

        echo "New points: {$newPoints}\n";
        echo "Points increased by: " . ($newPoints - $originalPoints) . "\n";

        if ($newPoints == $originalPoints + $topupAmount) {
            echo "✅ Topup functionality works correctly!\n";
        } else {
            echo "❌ Topup functionality failed!\n";
        }

        // Reset points
        $user->decrement('points', $topupAmount);
        echo "Reset points back to: {$user->fresh()->points}\n";

    } else {
        echo "No users found. Please seed the database first.\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
