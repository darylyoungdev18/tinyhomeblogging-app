@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-800 flex flex-col items-center justify-center text-gray-700 dark:text-gray-300">
    <div class="max-w-2xl p-6 text-center">
        <h1 class="text-5xl font-bold mb-6">Welcome to Tiny Home Blogging!</h1>
        <p class="text-xl mb-4">
            This is the home page of the Tiny Home Blogging App. Start sharing your thoughts and insights today!
        </p>
        <a href="/register" class="text-blue-500 hover:underline">Join us today</a>
    </div>
</div>
@endsection