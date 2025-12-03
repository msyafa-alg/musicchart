<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Artist;

echo "Checking artists and their photos:\n\n";

$artists = Artist::all();

foreach ($artists as $artist) {
    echo "Artist: " . $artist->name . "\n";
    echo "Photo: " . ($artist->photo ?: 'No photo') . "\n";

    if ($artist->photo) {
        $fullPath = storage_path('app/public/' . $artist->photo);
        echo "File exists: " . (file_exists($fullPath) ? 'YES' : 'NO') . "\n";
        echo "URL: " . asset('storage/' . $artist->photo) . "\n";
    }

    echo "---\n";
}
