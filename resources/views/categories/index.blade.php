@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-3xl font-bold mb-6">Categories</h2>
                <a href="{{ route('categories.create') }}">Create New Category</a>
                @if(session('success'))
                    <div>{{ session('success') }}</div>
                @endif

                @if($categories->count())
                <ul class="list-disc ml-6">
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
            </div>
        </div>
    </div>
</div>
@endsection