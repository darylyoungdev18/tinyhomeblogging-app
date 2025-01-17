@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>

    @if($errors->any())
        <div>
            <strong>Errors:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Use PUT method for updating -->

        <!-- Title -->
        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}" required>

        <!-- Subtitle -->
        <label for="subtitle">Subtitle (optional):</label>
        <input type="text" name="subtitle" value="{{ old('subtitle', $post->subtitle) }}">

        <!-- Body -->
        <label for="body">Body:</label>
        <textarea name="body" rows="5" required>{{ old('body', $post->body) }}</textarea>

        <!-- Image -->
        <label for="image">Post Image (optional):</label>
        <input type="file" name="image" accept="image/*">

        @if($post->image)
            <p>Current Image:</p>
            <img src="{{ asset('storage/images/' . $post->image) }}" alt="Post Image" style="max-width: 200px;">
        @endif

        <!-- Categories (if applicable) -->
        @if(isset($allCategories) && $allCategories->count())
            <label for="categories">Categories:</label>
            <select name="category_ids[]" multiple>
                @foreach($allCategories as $category)
                    <option value="{{ $category->id }}"
                        @if($post->categories->contains($category->id)) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        @endif

        <button type="submit">Update Post</button>
    </form>
@endsection
