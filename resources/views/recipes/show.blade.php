@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $recipe->name }}</h1>
            <p class="text-muted">Posted by: {{ $recipe->user->username }}</p>
            
            @if($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" class="img-fluid mb-4" alt="{{ $recipe->name }}">
            @endif
            
            <p><strong>Type:</strong> {{ $recipe->type }}</p>
            <p><strong>Cooking Time:</strong> {{ $recipe->cookingtime }} minutes</p>
            
            <h3>Description</h3>
            <p>{{ $recipe->description }}</p>
            
            <h3>Ingredients</h3>
            <div>{!! nl2br(e($recipe->ingredients)) !!}</div>
            
            <h3>Instructions</h3>
            <div>{!! nl2br(e($recipe->instructions)) !!}</div>
        </div>
        
        <div class="col-md-4">
            @auth
                @if(Auth::id() === $recipe->uid)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Manage Recipe</h5>
                            <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection