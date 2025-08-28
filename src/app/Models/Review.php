<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; //with this 
use App\Models\Book;

class Review extends Model
{
    use HasFactory; //and this 

        protected $fillable = [
        'review',
        'rating',
    ];

    //add this method to the child 
    public function book(){
        return $this->belongsTo(Book::class);
    }
}
