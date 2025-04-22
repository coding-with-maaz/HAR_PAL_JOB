<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\User;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = User::where('email', 'superadmin@example.com')->first()->id;
        $categories = BlogCategory::all();
        $tags = BlogTag::all();

        $posts = [
            [
                'title' => '10 Essential Tips for Job Seekers in 2024',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'excerpt' => 'Discover the most effective job searching strategies for the current job market.',
                'category_id' => $categories->where('slug', 'job-search-tips')->first()->id,
                'author_id' => $adminId,
                'status' => 'published',
                'featured_image' => null,
                'published_at' => now(),
            ],
            [
                'title' => 'The Future of Remote Work: Trends and Predictions',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'excerpt' => 'Explore how remote work is shaping the future of employment.',
                'category_id' => $categories->where('slug', 'remote-work')->first()->id,
                'author_id' => $adminId,
                'status' => 'published',
                'featured_image' => null,
                'published_at' => now(),
            ],
            [
                'title' => 'Building a Strong Professional Network',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'excerpt' => 'Learn effective strategies for networking in the digital age.',
                'category_id' => $categories->where('slug', 'career-advice')->first()->id,
                'author_id' => $adminId,
                'status' => 'published',
                'featured_image' => null,
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $post) {
            $post['slug'] = Str::slug($post['title']);
            
            $blogPost = BlogPost::firstOrCreate(
                ['slug' => $post['slug']],
                $post
            );
            
            // Attach random tags to each post (only if it's a new post)
            if ($blogPost->wasRecentlyCreated) {
                $blogPost->tags()->attach(
                    $tags->random(rand(2, 4))->pluck('id')->toArray()
                );
            }
        }
    }
} 