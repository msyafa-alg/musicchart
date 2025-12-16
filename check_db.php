<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking users table structure...\n";

try {
    $pdo = DB::connection()->getPdo();
    $result = $pdo->query('DESCRIBE users');

    $columns = [];
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $columns[] = $row['Field'];
        echo $row['Field'] . ' - ' . $row['Type'] . ' - ' . ($row['Null'] === 'YES' ? 'NULL' : 'NOT NULL') . ' - ' . ($row['Default'] ?? 'NULL') . "\n";
    }

    // Check if role column exists
    if (!in_array('role', $columns)) {
        echo "\n❌ Role column missing! Adding it...\n";

        // Add role column
        $pdo->exec("ALTER TABLE users ADD COLUMN role ENUM('admin', 'user') DEFAULT 'user' AFTER password");

        echo "✅ Role column added successfully!\n";
    } else {
        echo "\n✅ Role column exists\n";
    }

    // Check admin user
    echo "\nChecking admin user...\n";
    $admin = DB::table('users')->where('email', 'admin@musicchart.com')->first();

    if ($admin) {
        echo "Admin user found: " . $admin->name . " - Role: " . $admin->role . "\n";

        if ($admin->role !== 'admin') {
            DB::table('users')->where('id', $admin->id)->update(['role' => 'admin']);
            echo "✅ Admin role updated to 'admin'\n";
        } else {
            echo "✅ Admin role is already correct\n";
        }
    } else {
        echo "❌ Admin user not found\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "Done!\n";
