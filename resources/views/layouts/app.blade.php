<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiny Home Blogging App</title>
    @vite('resources/css/app.css')
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li>
            <li><a href="{{ route('posts.index') }}">Posts</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
        </ul>
    </nav>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
