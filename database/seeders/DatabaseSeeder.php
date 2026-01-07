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
        // User::factory(10)->create();

        // Create Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@kolektif.com',
            'password' => bcrypt('password'), // Ensure password is set if factory doesn't
            'is_admin' => true,
        ]);



        $this->call(SpaceSeeder::class);
        $this->call(BookingSeeder::class);
    }
}
