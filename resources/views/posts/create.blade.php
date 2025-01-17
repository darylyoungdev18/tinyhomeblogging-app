@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>

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
    
    @include('posts.partials.form', [
        'action' => route('posts.store'),
        'method' => 'POST',
        'buttonText' => 'Create Post',
        'allCategories' => $allCategories ?? null,
    ])
    
@endsection
