@extends('layouts.app')


@section('content')
<div class="py-12 bg-gray-100 dark:bg-gray-900">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>
                @if($post->subtitle)
                    <h2 class="text-2x1 text-gray-500 dark:text-gray-400 mb-6">{{ $post->subtitle }}</h2>
                @endif
                @if($post->image)
                    <img src="{{ asset('storage/images/' . $post->image) }}" alt="Post Image" style="max-width: 500px;">
                @endif
                
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">By {{ $post->user_id }} on {{ $post->created_at->format('M d, Y') }}</p>
                <div class="prose dark:prose-dark max-w-none">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection