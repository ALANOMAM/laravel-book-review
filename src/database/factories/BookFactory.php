<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

// to have more realistic sounding titles and not just latin start
    $titleFormats = [
        'The %s of %s',
        '%s and the %s',
        'A Tale of %s',
        'The Last %s',
        'Echoes of %s',
        'The %s Legacy',
        'Shadows of %s',
        'Chronicles of %s',
    ];

    $titleWords = [
        'Fire', 'Ashes', 'Storm', 'Kingdom', 'Dreams', 'Destiny',
        'Night', 'Hope', 'War', 'Magic', 'Darkness', 'Truth', 'Fear',
        'Honor', 'Silence', 'Light', 'Ice', 'Blood', 'Secrets',
    ];

    $title = sprintf(
        fake()->randomElement($titleFormats),
        fake()->randomElement($titleWords),
        fake()->randomElement($titleWords)
    );


// to have more realistic sounding titles and not just latin end



        return [
        // 'title' => fake()->sentence(3),
        'title' => $title,
        'author' => fake()->name(),
        'created_at' => fake()->dateTimeBetween('-2 years'),
        'updated_at' => function (array $attributes){
            return fake()->dateTimeBetween($attributes['created_at']);
        },

        ];
    }
}
