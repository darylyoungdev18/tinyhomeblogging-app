@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>

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

    @include('categories.partials.form', [
        'action' => route('categories.store'),
        'method' => $formMethod ?? 'PUT',
        'category' => $category ?? null,
        'buttonText' => $buttonText
    ])
@endsection
