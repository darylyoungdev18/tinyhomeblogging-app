@extends('layouts.app')

@section('content')
    <h1>{{ $category->name }}</h1>

    <p>{{ $category->description }}</p>

    @if($category->posts->count())
        <h2>Posts in this Category</h2>
        <ul>
            @foreach($category->posts as $post)
                <li>
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No posts in this category yet.</p>
    @endif

    @auth
        <a href="{{ route('categories.edit', $category) }}">Edit Category</a>
        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Delete this category?')">Delete Category</button>
        </form>
    @endauth
@endsection
