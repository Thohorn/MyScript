<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test',
            'surname' => 'User',
            'email' => 'user@test.com',
            'email_verified_at' => now(),
            'phone_number' => fake()->phoneNumber(),
            'password' => 'test',
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Test',
            'surname' => 'Admin',
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'phone_number' => fake()->phoneNumber(),
            'password' => 'test',
            'role' => 'admin',
        ]);

        User::factory(10)->create();
    }
}
