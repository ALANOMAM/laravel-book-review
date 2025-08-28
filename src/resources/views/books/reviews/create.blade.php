@extends('layouts.app')

@section('title',' ')

@section('content')

<div class="container-fluid">

<h1 class="text-center text-uppercase mt-3 mb-3">{{__('messages.create_review')}}</h1>

<div class="d-flex justify-content-center align-items-center">

    <form action="{{route('books.reviews.store', $book)}}" method="POST" class="shadow-lg p-3 mb-5 bg-body-tertiary rounded w-50">
     @csrf

     <div class="d-flex flex-column mt-3 ">
     <label for="review">{{__('messages.review')}}</label>
     {{-- <textarea name="review" id="review" cols="30" rows="5"></textarea> --}}
     <div>
        <textarea class="form-control mt-2" placeholder="{{__('messages.leave_a_review_here')}}" name="review" id="review" style="height: 100px"></textarea>
     </div>
     </div>

     <div class="d-flex flex-column mt-3">
        <label for="rating">{{__('messages.rating')}}</label>
        <select class="form-select w-25 mt-2" aria-label="Default select example" name="rating" id="rating">
        <option selected>{{__('messages.select_a_rating')}}</option>
            @for($i=1; $i<=5; $i++)
             <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
     </div>

     <div class="mt-3">
       <button type="submit" class="btn btn-success">{{__('messages.add_new_review')}}</button>
     </div>
     
    </form>
</div>


</div>

@endsection

 