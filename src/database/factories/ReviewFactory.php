<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = fake()->dateTimeBetween('-2 years', 'now');
        return [
            'book_id' => null,
            'review' => fake()->sentence,
            'rating' => fake()->numberBetween(1,5),
            'created_at'=> $createdAt,
            'updated_at'=> fake()->dateTimeBetween($createdAt, 'now'),
        ];
    }
}
