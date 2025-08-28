<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Review;
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

        //this will create 100 books, and for every single book 
        //it will decide randomly how many reviews to generate,
        // and then generate those reviews
        Book::factory(33)->create()->each( function($book){
            $numReviews = random_int(5,30);
          
            Review::factory()->count($numReviews)->for($book)->create();
        });
        
    }
}
