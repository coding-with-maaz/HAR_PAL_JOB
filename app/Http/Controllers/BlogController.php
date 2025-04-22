<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with(['author', 'category'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(6);

        $categories = BlogCategory::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        $tags = BlogTag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(20)
            ->get();

        return view('blog.index', compact('posts', 'categories', 'tags'));
    }

    public function show(BlogPost $post)
    {
        if ($post->status !== 'published') {
            abort(404);
        }

        $relatedPosts = BlogPost::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->latest()
            ->take(3)
            ->get();

        $categories = BlogCategory::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        $tags = BlogTag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(20)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts', 'categories', 'tags'));
    }

    public function category(BlogCategory $category)
    {
        $posts = BlogPost::with(['author', 'category'])
            ->where('status', 'published')
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->paginate(6);

        $categories = BlogCategory::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        $tags = BlogTag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(20)
            ->get();

        return view('blog.index', compact('posts', 'category', 'categories', 'tags'));
    }

    public function tag(BlogTag $tag)
    {
        $posts = $tag->posts()
            ->with(['author', 'category'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(6);

        $categories = BlogCategory::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        $tags = BlogTag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(20)
            ->get();

        return view('blog.index', compact('posts', 'tag', 'categories', 'tags'));
    }
} 