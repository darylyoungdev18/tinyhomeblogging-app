@extends('layouts.app')

@section('content')
    <h1>Recent Posts</h1>

    <a href="{{ route('posts.create') }}">Create New Post</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @forelse($posts as $post)
        <article>
            <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
            @if($post->image)
                <img src="{{ asset('storage/images/' . $post->image) }}" alt="Post Image" style="max-width: 200px;">
            @endif
            <p>{{ Str::limit($post->body, 100) }}</p>
        </article>
    @empty
        <p>No posts available.</p>
    @endforelse
@endsection
