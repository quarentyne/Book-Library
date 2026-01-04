<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lastname' => fake()->lastName(),
            'firstname' => fake()->firstName(),
            'middlename' => rand(0, 1) ? fake()->firstName() : '',
        ];
    }

    public function withBooks(int $count = 1) {
        return $this->hasAttached(
            Book::factory()->count($count),
            [],
            'books',
        );
    }
}
