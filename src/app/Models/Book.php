<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; //with this 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Book extends Model
{
        use HasFactory; //and this 

        //Add this method in the parent (this pretty much says the book can have many reviews)
        public function reviews(){
           return $this->hasMany(Review::class);
        }

        //local query scope that helps us find a book based on what the title contains
        //the name of the function should always start with "scope" and the give the 
        //name you want, e.g scopeTitle, scopeBook, etc
        public function scopeTitle(Builder $query, string $title): Builder {
            return $query->where('title','LIKE','%'.$title.'%');
        }


       //local query scope that gets the books that have the most amount of reviews
       public function scopePopular (Builder $query, $from = null, $to = null): Builder|QueryBuilder {
            return $query->withCount([
                'reviews' => fn (Builder $q) => $this->dateRangeFilter($q, $from, $to)
            ])->orderBy('reviews_count','desc');
            // the orderBy literally adds "reviews_count" column to our books, only when this query scope is used though
       }

      //local query scope that sorts the books by the reviews average ratings
       public function scopeHighestRated (Builder $query,$from = null, $to = null): Builder|QueryBuilder{
            return $query->withAvg([
            'reviews' => fn (Builder $q) => $this->dateRangeFilter($q, $from, $to)
            ],'rating')->orderBy('reviews_avg_rating','desc');
            // the orderBy literally adds "reviews_avg_rating" column to our books, only when this query scope is used though
       } 

      //local query scope that take into consideration only the books with a certain number of minimum reviews
       public function scopeMinReviews (Builder $query,int $minReviews): Builder|QueryBuilder{
            return $query->having('reviews_count', '>=', $minReviews);
       } 
       


      //we want to manage our query so that if gives us books according to a date range
       private function dateRangeFilter(Builder $query, $from = null, $to = null){
                    if($from && !$to){
                        //if from is specified and to is not
                       $query->where('created_at', '>=', $from);
                    }   elseif(!$from && $to){
                        //if from is not specified and to is 
                       $query->where('created_at', '<=', $to);
                    }    elseif($from && $to){
                        //if from and to are specified 
                       $query->where('created_at', [$from,$to]);
                    }
       }

}
