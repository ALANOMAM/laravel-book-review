@extends('layouts.app')

@section('title',' ')

@section('content')

<div class="container-fluid">

<div class="text-center mt-3 mb-3">
<h1>{{$book->title}}</h1>
<p>By {{$book->author}}</p>
</div>


{{-- @dump($book) --}}

<div class="d-flex gap-2">
    <p >{{__('messages.average_rating')}}: ({{number_format($book->reviews_avg_rating, 1)}}) </p>
    <x-star-rating  :rating="$book->reviews_avg_rating"/>
    {{-- the element "<x-star-rating  :rating="$book->reviews_avg_rating"/>" is alaravel component i created for ratings --}}
</div>

<p class="">{{__('messages.number_of_reviews')}}: {{ $book->reviews_count}} {{ Str::plural('review', $book->reviews_count)}}</p>

<a class="btn btn-success" href="{{route('books.reviews.create', $book)}}">{{__('messages.add_new_review')}}</a>


<h2 class="mt-2">{{__('messages.reviews')}}</h2>

<div class="list-group">
@forelse($book->reviews as $review)
  <a href="#" class="list-group-item list-group-item-action shadow-lg  mb-1  rounded">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1 d-flex gap-2"><x-star-rating  :rating="$review->rating"/> </h5>
      <small>{{$review->created_at->format('M j,Y')}}</small>
    </div>
    <p class="mb-1">{{$review->review}}</p>
  </a>
    @empty
    <p>No reviews yet</p>
 @endforelse
</div>


</div>





@endsection






