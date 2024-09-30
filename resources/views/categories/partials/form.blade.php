<form action="{{ $action }}" method="POST">
    @csrf
    @if(isset($method) && $method !== 'POST')
        @method($method)
    @endif

    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required>

    <label for="slug">Slug (optional):</label>
    <input type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}">

    <label for="description">Description:</label>
    <textarea name="description">{{ old('description', $category->description ?? '') }}</textarea>

    <button type="submit">{{ $buttonText }}</button>
</form>
