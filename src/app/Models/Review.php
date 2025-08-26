<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; //with this 

class Review extends Model
{
    use HasFactory; //and this 

    //add this method to the child 
    public function book(){
        return $this->belongsTo(Book::class);
    }
}
