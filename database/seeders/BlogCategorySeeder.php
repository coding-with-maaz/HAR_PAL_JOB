<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Career Advice', 'slug' => 'career-advice'],
            ['name' => 'Industry News', 'slug' => 'industry-news'],
            ['name' => 'Job Search Tips', 'slug' => 'job-search-tips'],
            ['name' => 'Interview Tips', 'slug' => 'interview-tips'],
            ['name' => 'Resume Writing', 'slug' => 'resume-writing'],
            ['name' => 'Workplace Culture', 'slug' => 'workplace-culture'],
            ['name' => 'Professional Development', 'slug' => 'professional-development'],
            ['name' => 'Remote Work', 'slug' => 'remote-work'],
        ];

        foreach ($categories as $category) {
            BlogCategory::firstOrCreate(
                ['slug' => $category['slug']],
                ['name' => $category['name']]
            );
        }
    }
} 