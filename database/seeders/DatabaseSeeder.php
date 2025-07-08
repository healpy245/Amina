<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Add the specified user
        User::factory()->create([
            'name' => 'Yamen Amer',
            'email' => 'yamenamer245@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            CategorySeeder::class,
            DressSeeder::class,
            ClientSeeder::class,
            AppointmentSeeder::class,
            ContractSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
