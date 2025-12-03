<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // HAPUS atau COMMENT baris ini:
        // \App\Models\User::factory(10)->create();

        // HAPUS atau COMMENT baris ini juga:
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Hanya panggil UserSeeder kita
        $this->call([
            UserSeeder::class,
        ]);
    }
}
