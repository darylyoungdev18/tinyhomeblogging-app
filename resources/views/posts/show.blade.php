@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>

    @if($post->subtitle)
        <h2>{{ $post->subtitle }}</h2>
    @endif

    @if($post->image)
        <img src="{{ asset('storage/images/' . $post->image) }}" alt="Post Image" style="max-width: 500px;">
    @endif

    <p>{{ $post->body }}</p>

    @if($post->categories->count())
        <p>Categories:
            @foreach($post->categories as $category)
                <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                @if(!$loop->last), @endif
            @endforeach
        </p>
    @endif

    @auth
        @if(auth()->id() === $post->user_id)
            <a href="{{ route('posts.edit', $post) }}">Edit Post</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this post?')">Delete Post</button>
            </form>
        @endif
    @endauth
@endsection
