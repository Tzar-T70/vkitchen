<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Added CSRF token -->
    <title>@yield('title', "T's Virtual Kitchen")</title> <!-- Added default title -->
    
    <!-- Your original styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">

    <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/x-icon"/>
</head>
<body>
<header class="main-header">
    <div class="logo">
        <h1>T's Virtual Kitchen</h1>
    </div>
    
    <nav class="auth-links">
        @guest
            <a href="{{ route('login') }}">Login</a> 
            <a href="{{ route('register') }}">Register</a>
        @else
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="{{ route('recipes.create') }}">Add Recipe</a>
        @endguest
    </nav>
</header>

    <div class="container">
        @yield('content') <!-- Keep your original content section -->
    </div>

    <footer class="footer">
        <p>
            Name: Tahir Mahmud
            <br>Email: <a href="mailto:240215884@aston.ac.uk">240215884@aston.ac.uk</a>
            <br>Student Number: 240215884
        </p>
    
        <nav class="footer-nav">
            <ul>
                <li><a href="{{ route('home') }}">Homepage</a></li>
                <li><a href="{{ route('recipes.index') }}">Recipes</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
            </ul>
        </nav>
    </footer>

</body>
</html>