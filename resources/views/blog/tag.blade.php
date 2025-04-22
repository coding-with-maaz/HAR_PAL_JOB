@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-3">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Posts tagged with #{{ $tag->name }}</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($posts as $post)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    @if($post->featured_image)
                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span>{{ $post->published_at->format('M d, Y') }}</span>
                            <span class="mx-2">•</span>
                            <a href="{{ route('category', $post->category) }}" class="hover:text-gray-700">
                                {{ $post->category->name }}
                            </a>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">
                            <a href="{{ route('post.show', $post) }}" class="hover:text-gray-600">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 100) }}</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $postTag)
                                <a href="{{ route('tag', $postTag) }}" class="text-sm text-blue-600 hover:text-blue-800">
                                    #{{ $postTag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <!-- Categories -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Categories</h3>
            <ul class="space-y-2">
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('category', $category) }}" class="flex items-center justify-between text-gray-600 hover:text-gray-900">
                            <span>{{ $category->name }}</span>
                            <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2 py-1 rounded-full">
                                {{ $category->posts_count }}
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Tags -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tags</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $t)
                    <a href="{{ route('tag', $t) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-900">
                        {{ $t->name }}
                        <span class="ml-1 text-xs text-gray-500">({{ $t->posts_count }})</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 