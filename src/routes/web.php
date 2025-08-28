<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class );

//an example of SCOPING RESOURCE ROUTES, that is with the mechanism below 
// every review operation will be prefixed by "books/book_id/" this means 
// "books/book_id/reviews"
// "books/book_id/reviews/review_id" etc
//in fact, if i go to the route list in the terminal,i will see all these routes
Route::resource('books.reviews', ReviewController::class)->scoped([
'review'=>'book'
]);