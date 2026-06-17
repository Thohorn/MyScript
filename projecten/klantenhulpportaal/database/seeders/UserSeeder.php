<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test',
            'surname' => 'User',
            'email' => 'test@user.com',
            'email_verified_at' => now(),
            'phone_number' => fake()->phoneNumber(),
            'password' => 'testUser',
            'role' => 'user',
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'name' => 'Test',
            'surname' => 'Admin',
            'email' => 'test@admin.com',
            'email_verified_at' => now(),
            'phone_number' => fake()->phoneNumber(),
            'password' => 'testAdmin',
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);
    }
}
