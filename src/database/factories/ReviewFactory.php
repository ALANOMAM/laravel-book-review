<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $rating = fake()->numberBetween(1, 5);

        return [
            'book_id' => null,
            'review' => $this->generateReviewText($rating),
            'rating' => $rating,
            'created_at' => fake()->dateTimeBetween('-2 years'),
            'updated_at' => function (array $attributes) {
                return fake()->dateTimeBetween($attributes['created_at']);
            },
        ];
    }

    /**
     * Generate realistic review text based on rating
     */
    private function generateReviewText(int $rating): string
    {
        $positive = [
            'Absolutely loved this book from start to finish.',
            'A beautifully written story with unforgettable characters.',
            'One of the best books I’ve read this year!',
            'Highly recommended to anyone who loves a good story.',
            'A masterpiece — couldn’t put it down.'
        ];

        $neutral = [
            'The book had some good moments, but it was a bit slow in parts.',
            'An average read — not bad, but not great either.',
            'Some parts were enjoyable, others were confusing.',
            'Decent writing, but the plot didn’t fully grab me.',
            'It was okay, but I expected more based on the reviews.'
        ];

        $negative = [
            'I couldn’t get into this book at all.',
            'Disappointing and hard to follow.',
            'The story was predictable and the characters were flat.',
            'Not worth the time. I struggled to finish it.',
            'Unfortunately, this book just wasn’t for me.'
        ];

        return match (true) {
            $rating >= 4 => fake()->randomElement($positive),
            $rating === 3 => fake()->randomElement($neutral),
            default => fake()->randomElement($negative),
        };
    }
}

