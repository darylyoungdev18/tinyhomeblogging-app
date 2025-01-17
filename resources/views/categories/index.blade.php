@extends('layouts.app')

@section('content')
    <h1>Categories</h1>

    <a href="{{ route('categories.create') }}">Create New Category</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if($categories->count())
        <ul>
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                    <a href="{{ route('categories.edit', $category) }}">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this category?')">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No categories available.</p>
    @endif
@endsection
