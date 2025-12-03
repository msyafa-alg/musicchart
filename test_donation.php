<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Artist;
use App\Models\User;

echo "=== Donation Feature Test ===\n\n";

echo "Artists count: " . Artist::count() . "\n";
echo "Users count: " . User::count() . "\n";
echo "Users with points: " . User::where('points', '>', 0)->count() . "\n\n";

$artist = Artist::first();
if ($artist) {
    echo "Sample artist: {$artist->name} (ID: {$artist->id}, Donations: {$artist->total_donations})\n";
} else {
    echo "No artists found\n";
}

$user = User::first();
if ($user) {
    echo "Sample user: {$user->username} (Points: {$user->points})\n";
} else {
    echo "No users found\n";
}

echo "\n=== Test Complete ===\n";
