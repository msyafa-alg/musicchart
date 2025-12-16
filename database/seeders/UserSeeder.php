<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah sudah ada user admin
        if (DB::table('users')->where('email', 'admin@musicchart.com')->exists()) {
            echo "User admin sudah ada, skipping...\n";
            return;
        }

        // Admin User
        DB::table('users')->insert([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@musicchart.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Regular Users
        DB::table('users')->insert([
            'name' => 'John Doe',
            'username' => 'john_doe',
            'email' => 'john@example.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Sarah Music',
            'username' => 'sarah_music',
            'email' => 'sarah@example.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        echo "UserSeeder berhasil dijalankan!\n";
        echo "Admin: admin@musicchart.com / admin123\n";
        echo "User: john@example.com / user123\n";
    }
}
