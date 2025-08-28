<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; //with this 
use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Book extends Model
{
        use HasFactory; //and this 

        //Add this method in the parent (this pretty much says the book can have many reviews)
        public function reviews(){
           return $this->hasMany(Review::class)->latest();
        }

        //local query scope that helps us find a book based on what the title contains
        //the name of the function should always start with "scope" and the give the 
        //name you want, e.g scopeTitle, scopeBook, etc
        public function scopeTitle(Builder $query, string $title): Builder {
            return $query->where('title','LIKE','%'.$title.'%');
        }


         public function scopeWithReviewsCount (Builder $query, $from = null, $to = null): Builder|QueryBuilder {
            //i applied a time range to my local query scope.
            return $query->withCount([
                'reviews' => fn (Builder $q) => $this->dateRangeFilter($q, $from, $to)
            ]);
       }

         public function scopeWithAverageRating (Builder $query, $from = null, $to = null): Builder|QueryBuilder {
            //i applied a time range to my local query scope.
            return $query->withAvg([
            'reviews' => fn (Builder $q) => $this->dateRangeFilter($q, $from, $to)
            ],'rating');
       }       


       //local query scope that gets the books that have the most amount of reviews
       public function scopePopular (Builder $query, $from = null, $to = null): Builder|QueryBuilder {
            return $query->withReviewsCount()->orderBy('reviews_count','desc');
            // the orderBy literally adds "reviews_count" column to our books, only when this query scope is used though
       }

      //local query scope that sorts the books by the reviews average ratings
       public function scopeHighestRated (Builder $query,$from = null, $to = null): Builder|QueryBuilder{
            return $query->withAverageRating()->orderBy('reviews_avg_rating','desc');
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
                       $query->whereBetween('created_at', [$from,$to]);
                    }
       }


      public function scopePopularLastMonth(Builder $query): Builder|QueryBuilder{
            //  here i use the popular local query scope i created above and just give it a time range
            // amongs the most popular, i get those with the highest ratings still using a created local query scope
            // and finaly i only want to consider those with a minimum review number of 2, using a created l.q.s 
             return $query->popular(now()->subMonth(), now())->highestRated(now()->subMonth(), now())->minReviews(2);
      } 

      public function scopePopularLast6Months(Builder $query): Builder|QueryBuilder{
            //  here i use the popular local query scope i created above and just give it a time range
            // amongs the most popular, i get those with the highest ratings still using a created local query scope
            // and finaly i only want to consider those with a minimum review number of 5, using a created l.q.s 
             return $query->popular(now()->subMonths(6), now())->highestRated(now()->subMonths(6), now())->minReviews(5);
      } 

      public function scopeHighestRatedLastMonth(Builder $query): Builder|QueryBuilder{
            //  here i use first the highest rated local query scope i created above and just give it a time range
            // amongs the highest rated, i get the most popular, still using a created local query scope
            // and finaly i only want to consider those with a minimum review number of 2, using a created l.q.s 
             return $query->highestRated(now()->subMonth(), now())->popular(now()->subMonth(), now())->minReviews(2);
      } 

      public function scopeHighestRatedLast6Months(Builder $query): Builder|QueryBuilder{
            //  here i use first the highest rated local query scope i created above and just give it a time range
            // amongs the highest rated, i get the most popular, still using a created local query scope
            // and finaly i only want to consider those with a minimum review number of 5, using a created l.q.s 
             return $query->highestRated(now()->subMonths(6), now())->popular(now()->subMonths(6), now())->minReviews(5);
      } 

      

}
