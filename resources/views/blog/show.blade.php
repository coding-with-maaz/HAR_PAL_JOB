@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen"> 

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8 xl:gap-12">
            
            <!-- Main Article Column -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Article Card -->
                <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                    {{-- Featured Image --}}
                    @if($post->featured_image)
                        <div class="aspect-w-16 aspect-h-9 w-full">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    @endif

                    {{-- Content Area --}}
                    <div class="p-6 sm:p-8 lg:p-10">
                        {{-- Category --}}
                        <a href="{{ route('blog.category', $post->category) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 mb-3 transition-colors duration-150">
                           <i class="fas fa-folder-open mr-1.5"></i> {{ $post->category->name }}
                        </a>
                        
                        {{-- Title --}}
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-4">
                            {{ $post->title }}
                        </h1>
                        
                        {{-- Metadata --}}
                         <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-500 mb-6 border-b border-t border-gray-100 py-4 gap-3">
                            <div class="flex items-center space-x-4">
                                <a href="#author-info" class="flex items-center group">
                                    <span class="flex items-center h-10 w-10 justify-center rounded-full mr-2 bg-gray-100 group-hover:bg-indigo-100 transition-colors duration-150">
                                        <i class="fas fa-user text-lg text-gray-400 group-hover:text-indigo-500 transition-colors duration-150"></i>
                                    </span>
                                    <span class="font-medium text-gray-700 group-hover:text-indigo-600">{{ $post->author->name }}</span>
                                 </a>
                                <span class="hidden sm:block">•</span>
                                <span class="flex items-center"><i class="far fa-calendar-alt mr-1.5 text-gray-400"></i>{{ $post->published_at->format('M d, Y') }}</span>
                            </div>
                             {{-- Add social share icons --}}
                            <div class="flex items-center space-x-3">
                                <span class="text-xs font-medium text-gray-500">Share:</span>
                                <a href="#" class="text-gray-400 hover:text-indigo-500 transition-colors duration-150" title="Share on Twitter"><i class="fab fa-twitter text-lg"></i></a>
                                <a href="#" class="text-gray-400 hover:text-indigo-500 transition-colors duration-150" title="Share on Facebook"><i class="fab fa-facebook-f text-lg"></i></a>
                                <a href="#" class="text-gray-400 hover:text-indigo-500 transition-colors duration-150" title="Share on LinkedIn"><i class="fab fa-linkedin-in text-lg"></i></a>
                                <a href="#" class="text-gray-400 hover:text-indigo-500 transition-colors duration-150" title="Copy link"><i class="fas fa-link text-lg"></i></a>
                            </div>
                        </div>

                        {{-- Post Content - Added max-width for readability --}}
                        <div class="prose prose-lg lg:prose-xl max-w-4xl mx-auto text-gray-700 prose-indigo">
                            {!! $post->content !!}
                        </div>

                        {{-- Tags --}}
                        @if($post->tags->isNotEmpty())
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <div class="flex flex-wrap items-center gap-2">
                                     <span class="text-sm font-medium text-gray-500 mr-2"><i class="fas fa-tags mr-1"></i>Tags:</span>
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('blog.tag', $tag) }}" 
                                           class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 border border-gray-200 hover:border-indigo-200 transition-colors duration-150">
                                            #{{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </article>

                <!-- Author Info Card - Enhanced Styling -->
                <div id="author-info" class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl shadow-lg overflow-hidden p-6 sm:p-8 border border-gray-200">
                    <div class="flex flex-col sm:flex-row items-center">
                        <div class="flex-shrink-0 mb-4 sm:mb-0 sm:mr-6">
                            <div class="h-20 w-20 rounded-full bg-white ring-4 ring-white shadow-md flex items-center justify-center">
                                <i class="fas fa-user text-4xl text-indigo-400"></i>
                            </div>
                        </div>
                        <div class="text-center sm:text-left flex-grow">
                            <p class="text-xs font-medium text-indigo-600 uppercase tracking-wider mb-1">Written By</p>
                            <h3 class="text-xl font-semibold text-gray-900">{{ $post->author->name }}</h3>
                            <p class="text-sm font-medium text-gray-500 mb-2">{{ $post->author->title ?? 'Author' }}</p>
                            <p class="text-sm text-gray-600 mb-3">
                                {{ $post->author->bio ?? 'No bio available.' }}
                            </p>
                             {{-- Added social links --}}
                            <div class="flex justify-center sm:justify-start space-x-4">
                                <a href="#" class="text-gray-400 hover:text-indigo-500 transition-colors duration-150" title="Twitter"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-gray-400 hover:text-indigo-500 transition-colors duration-150" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="text-gray-400 hover:text-indigo-500 transition-colors duration-150" title="Website"><i class="fas fa-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Comments Section Placeholder --}}
                {{-- <div id="comments" class="bg-white rounded-xl shadow-lg overflow-hidden p-6 sm:p-8">
                     <h2 class="text-xl font-semibold text-gray-900 mb-6">Comments (3)</h2>
                     </div> --}}

                <!-- Related Posts -->
                @if(isset($relatedPosts) && $relatedPosts->isNotEmpty())
                    <div class="mt-12">
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">You Might Also Like</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($relatedPosts as $relatedPost)
                                {{-- Re-using the card style from index --}}
                                <article class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group">
                                    @if($relatedPost->featured_image)
                                        <div class="aspect-w-16 aspect-h-9 w-full relative overflow-hidden">
                                            <img class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300 ease-in-out" src="{{ asset('storage/' . $relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}">
                                            <a href="{{ route('blog.category', $relatedPost->category) }}" class="absolute top-3 left-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-600 text-white hover:bg-indigo-700 transition-colors">
                                                <i class="fas fa-folder-open mr-1 opacity-75"></i> {{ $relatedPost->category->name }}
                                            </a>
                                        </div>
                                    @endif
                                    <div class="p-5 flex flex-col flex-grow">
                                        <div class="flex-grow">
                                            <div class="flex items-center text-xs text-gray-500 mb-1.5">
                                                @if(!$relatedPost->featured_image) 
                                                 <a href="{{ route('blog.category', $relatedPost->category) }}" class="text-indigo-600 hover:text-indigo-800 font-medium mr-2">
                                                    {{ $relatedPost->category->name }}
                                                </a>
                                                <span class="mr-2">•</span>
                                                @endif
                                                <span><i class="far fa-calendar-alt mr-1 opacity-75"></i>{{ $relatedPost->published_at->format('M d, Y') }}</span>
                                                <span class="mx-1.5">•</span>
                                                <span><i class="far fa-user mr-1 opacity-75"></i>{{ $relatedPost->author->name }}</span>
                                            </div>
                                            <h3 class="mt-1 text-lg font-semibold text-gray-900">
                                                <a href="{{ route('blog.show', $relatedPost) }}" class="hover:text-indigo-600 transition-colors duration-200 line-clamp-2">
                                                    {{ $relatedPost->title }}
                                                </a>
                                            </h3>
                                            {{-- Removed excerpt from related posts for cleaner look --}}
                                            {{-- <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $relatedPost->excerpt ?: Str::limit(strip_tags($relatedPost->content), 100) }}</p> --}}
                                        </div>
                                        <div class="mt-3 pt-3 border-t border-gray-100">
                                            <span class="inline-flex items-center text-xs font-medium text-indigo-600 group-hover:text-indigo-700">
                                                Read More <i class="fas fa-arrow-right ml-1 group-hover:translate-x-0.5 transition-transform duration-200"></i>
                                            </span>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="hidden lg:block lg:col-span-4">
                 <div class="sticky top-6 space-y-6"> 
                    {{-- Ensured consistency with index page sidebar --}}
                     <!-- Categories -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Categories</h3>
                        <ul class="space-y-2">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('blog.category', $category->slug) }}" 
                                       class="flex items-center justify-between text-gray-600 hover:text-indigo-600 p-2 rounded-md hover:bg-gray-50 transition-colors duration-150 group">
                                        <span class="group-hover:font-medium">{{ $category->name }}</span>
                                        <span class="bg-gray-100 group-hover:bg-indigo-100 group-hover:text-indigo-700 text-gray-600 text-xs font-medium px-2 py-0.5 rounded-full transition-colors duration-150">
                                            {{ $category->posts_count }}
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Tags -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Popular Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($tags as $tag)
                                <a href="{{ route('blog.tag', $tag) }}" 
                                   class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 border border-gray-200 hover:border-indigo-200 transition-colors duration-150">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection 