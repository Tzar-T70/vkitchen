@extends('layouts.app')

@section('title', "T's Virtual Kitchen - Homepage")

@section('content')
<link rel="stylesheet" href="{{ asset('css/about-me.css') }}">
<section class="about-me">
    <h2>About The Kitchen</h2>
    <div class="about-content">
        <div class="about-info">
            <h3>Name: Tahir Mahmud</h3>
            <p><strong>Address:</strong> 123 Culinary Street, Foodie City, Cookville, 78901</p>
        </div>
        <div class="about-history">
            <h3 class="title">Our Story</h3>
            <p class="description">
                Tahir's Virtual Kitchen brings the rich, aromatic flavors of Indian cuisine straight to your doorstep. 
                Specializing in authentic Indian curries...
            </p>
            <br>
            <img src="{{ asset('images/goldenmoment_gallery(15).jpg') }}" title="food">
        </div>
    </div>
</section>

<div class="container my-5">
    <h2 class="text-center">Customer Reviews</h2>
    
    @foreach($reviews as $review)
    <blockquote class="blockquote text-center">
        <p>{{ $review['text'] }}</p>
        <footer class="blockquote-footer">{{ $review['author'] }}</footer>
    </blockquote>
    @endforeach
</div>
@endsection