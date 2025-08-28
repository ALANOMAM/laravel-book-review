@extends('layouts.app')

@section('title',' ')

@section('content')

<div class="container-fluid">
  

<h1 class="mb-3 mt-3 text-center text-uppercase">{{__('messages.books')}}</h1>

{{-- @dd($books); --}}

{{-- search and reset --}}
<form action="{{route('books.index')}}" method="GET" class="d-flex gap-3 w-50">
    <input type="text" class="form-control" name="title" placeholder="{{__('messages.search_by_title')}}" value="{{request('title')}}">
    <input type="hidden" name="filter" value="{{request('filter')}}">
    <button class="btn btn-success" type="submit">{{__('messages.search')}}</button>
    <a class="btn btn-success" href="{{route('books.index')}}">{{__('messages.reset')}}</a>
</form>


{{-- filters --}}
<div class="btn-group my-3" role="group" aria-label="Filter Buttons">
  @php
    $filters = [
      '' => 'Latest',
      'popular_last_month' => 'Popular last month',
      'popular_last_6months' => 'Popular last 6 months',
      'highest_rated_last_month' => 'Highest rated last month',
      'highest_rated_last_6months' => 'Highest rated last 6 months',
    ];
    $activeFilter = request('filter');
  @endphp

  @foreach($filters as $key => $label)
    <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}"
       class="btn {{ $activeFilter === $key ? 'btn-primary' : 'btn-outline-primary' }}">
      {{ $label }}
    </a>
  @endforeach
</div>


{{-- book list  --}}
<div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach ($books as $book)
  <div class="col">
    <div class="card h-100 shadow p-3 mb-5 rounded">
      <img src="{{ asset('book.jpg') }}" class="card-img-top" alt="Book cover">
      <div class="card-body">
        <h5 class="card-title">{{$book->title}}</h5>
        <p class="card-text"><strong>{{__('messages.author')}}: </strong>{{$book->author}}</p>
      </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex gap-2"><strong>{{__('messages.average_rating')}}: </strong> ({{number_format($book->reviews_avg_rating, 1)}}) <x-star-rating  :rating="$book->reviews_avg_rating"/> </li>
          <li class="list-group-item"><strong>{{__('messages.number_of_reviews')}}: </strong> {{ $book->reviews_count}} {{ Str::plural('review', $book->reviews_count)}} </li>
           {{-- the "{{ Str::plural('review', $book->reviews_count)}}" turns the word "review" to its plural form if 
           "$book->reviews_count" is more than one, it remains to its singular form f it is one --}}
        </ul>

        <div class="card-body">
          <a href="{{route('books.show', $book)}}" class="card-link btn btn-success">{{__('messages.more_on_the_book')}}</a>
        </div>
    </div>
  </div>
  @endforeach
</div> 


</div>

@endsection

