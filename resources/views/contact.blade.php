@extends('layouts.app')

@section('title', "Contact Us - T's Virtual Kitchen")

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="text-center">Book a Private Cooking Lesson</h2>
    <form action="   " method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" class="form-control @error('fullName') is-invalid @enderror" 
                   id="fullName" name="fullName" value="{{ old('fullName') }}" required>
            @error('fullName')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Other form fields with similar error handling -->
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection