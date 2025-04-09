@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Recipes</h1>
    
    <!-- Search Form -->
    <form action="{{ route('recipes.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" 
                placeholder="Search by name, type, or ingredients..."
                value="{{ request('query') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    @if($recipes->isEmpty())
        <p>No recipes found.</p>
    @else
        <div class="row">
            @foreach($recipes as $recipe)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($recipe->image)
                            <img src="{{ asset('storage/' . $recipe->image) }}" class="card-img-top" alt="{{ $recipe->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $recipe->name }}</h5>
                            <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                            <span class="badge bg-secondary">{{ $recipe->type }}</span>
                            <span class="badge bg-info text-dark">{{ $recipe->cookingtime }} mins</span>
                            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary mt-2">View Recipe</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $recipes->links() }}
    @endif
</div>
@endsection