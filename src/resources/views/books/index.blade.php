@extends('layouts.app')

@section('title',' ')

@section('content')
<h1>{{__('messages.books')}}</h1>

<form action="{{route('books.index')}}" method="GET">
    <input type="text" name="title" placeholder="Search by title">
    <button class="btn btn-info" type="submit">Search</button>
    <a class="btn btn-info" href="{{route('books.index')}}">Reset</a>
</form>


<div class="d-flex flex-column gap-4">
@foreach ($books as $book)
<div class="card" style="width: 18rem;">
  <img src="{{ asset('book.jpg') }}" class="card-img-top" alt="Book Cover">
  <div class="card-body">
    <h5 class="card-title">{{$book->title}}</h5>
    <p class="card-text">{{$book->author}}</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Rating {{number_format($book->reviews_avg_rating, 1)}} </li>
    <li class="list-group-item">Out of {{ $book->reviews_count}} {{ Str::plural('review', $book->reviews_count)}} </li>
    {{-- the "{{ Str::plural('review', $book->reviews_count)}}" turns the word "review" to its plural form if 
    "$book->reviews_count" is more than one, it remains to its singular form f it is one --}}
  </ul>
  <div class="card-body">
    <a href="{{route('books.show', $book)}}" class="card-link">Check out the book</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>
@endforeach
</div>




@endsection






