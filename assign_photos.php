<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$orphanedPhotos = ['6ZZecsdcZjaDHnvDIIGqRs46T8hZtQggmeowqKwZ.jpg', 'nH3ZhDIeQ1ZI9QXnOLlb3rarB39dM5QkGROVREi4.jpg', 'vG4KVeiRoQ3vSzuLS0u5SNUtpknWdG3ztHkFm4el.png'];
$artistsWithoutPhotos = App\Models\Artist::whereNull('photo')->orWhere('photo', '')->get();

echo 'Assigning photos to artists without photos...' . PHP_EOL;

foreach($artistsWithoutPhotos as $index => $artist) {
    if (isset($orphanedPhotos[$index])) {
        $photoPath = 'artists/' . $orphanedPhotos[$index];
        $artist->update(['photo' => $photoPath]);
        echo 'Assigned ' . $photoPath . ' to ' . $artist->name . PHP_EOL;
    }
}

echo 'Done!' . PHP_EOL;
