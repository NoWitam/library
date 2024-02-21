<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $endAt = fake()->dateTimeBetween('-1 week', '+2 months');

        return [
            'user_id' => User::client()->inRandomOrder()->first()->id,
            'book_id' => Book::whereDoesntHave('loans')->inRandomOrder()->first()->id,
            'returned_at' => fake()->boolean ? $endAt : null,
            'start_at' => fake()->dateTimeBetween('-2 months', 'now'),
            'end_at' => $endAt
        ];
    }
}
