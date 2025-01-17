<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-lg">
                    {{ __("Welcome to your dashboard! You're logged in!") }}
                    <br />
                    <a href="/login" class="mt-4 inline-block text-blue-500 hover:underline">Click here to log in and get started!</a>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Recent Blogs</h3>
                <div class="mt-4">
                    @if($posts->count() > 0)
                        @foreach($posts->take(3) as $post)
                            <div class="p-6 mb-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                <h4 class="text-xl font-bold text-gray-800 dark:text-gray-100">{{ $post->title }}</h4>
                                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ Str::limit($post->content, 150) }}</p>
                                <a href="/post/{{ $post->id }}" class="text-blue-500 hover:underline mt-2 inline-block">Read more</a>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-600 dark:text-gray-400">No blogs available at the moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>