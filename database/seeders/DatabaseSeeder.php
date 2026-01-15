<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User (skip if already exists)
        User::firstOrCreate(
            ['email' => 'admin@kolektif.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        $this->call(SpaceSeeder::class);
        $this->call(BookingSeeder::class);
    }
}
