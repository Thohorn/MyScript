<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = [
            'Open',
            'In behandeling',
            'Opgelost',
        ];

        return [
            'title' => fake()->word(),
            'body' => fake()->paragraph(),
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => fake()->randomElement($status),
            'category_id' => Category::inRandomOrder()->first()->id,
            'assigned_to' => User::where('role', 'admin')->inRandomOrder()->first()->id,
        ];
    }
}
