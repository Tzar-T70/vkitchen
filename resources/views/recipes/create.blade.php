@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($recipe) ? 'Edit' : 'Create' }} Recipe</h1>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ isset($recipe) ? route('recipes.update', $recipe) : route('recipes.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($recipe))
            @method('PUT')
        @endif
        
        <div class="mb-3">
            <label for="name" class="form-label">Recipe Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" value="{{ old('name', $recipe->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" name="description" rows="3" required>{{ old('description', $recipe->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="type" class="form-label">Cuisine Type</label>
            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                <option value="">Select a type</option>
                @foreach(['French', 'Italian', 'Chinese', 'Indian', 'Mexican', 'others'] as $cuisine)
                    <option value="{{ $cuisine }}" {{ (old('type', $recipe->type ?? '') == $cuisine) ? 'selected' : '' }}>
                        {{ $cuisine }}
                    </option>
                @endforeach
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="cookingtime" class="form-label">Cooking Time (minutes)</label>
            <input type="number" class="form-control @error('cookingtime') is-invalid @enderror" 
                   id="cookingtime" name="cookingtime" min="1" value="{{ old('cookingtime', $recipe->cookingtime ?? '') }}" required>
            @error('cookingtime')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredients (one per line)</label>
            <textarea class="form-control @error('ingredients') is-invalid @enderror" 
                      id="ingredients" name="ingredients" rows="5" required>{{ old('ingredients', $recipe->ingredients ?? '') }}</textarea>
            @error('ingredients')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="instructions" class="form-label">Instructions</label>
            <textarea class="form-control @error('instructions') is-invalid @enderror" 
                      id="instructions" name="instructions" rows="5" required>{{ old('instructions', $recipe->instructions ?? '') }}</textarea>
            @error('instructions')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Recipe Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                   id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/gif">
            @if(isset($recipe) && $recipe->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $recipe->image) }}" width="100" class="img-thumbnail">
                    <p class="text-muted">Current image</p>
                </div>
            @endif
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">{{ isset($recipe) ? 'Update' : 'Create' }} Recipe</button>
    </form>
</div>
@endsection