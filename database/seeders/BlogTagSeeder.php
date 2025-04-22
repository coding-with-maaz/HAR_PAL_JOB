<?php

namespace Database\Seeders;

use App\Models\BlogTag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Career Growth', 'slug' => 'career-growth'],
            ['name' => 'Job Market', 'slug' => 'job-market'],
            ['name' => 'Skills Development', 'slug' => 'skills-development'],
            ['name' => 'Work-Life Balance', 'slug' => 'work-life-balance'],
            ['name' => 'Leadership', 'slug' => 'leadership'],
            ['name' => 'Technology', 'slug' => 'technology'],
            ['name' => 'Productivity', 'slug' => 'productivity'],
            ['name' => 'Networking', 'slug' => 'networking'],
            ['name' => 'Personal Branding', 'slug' => 'personal-branding'],
            ['name' => 'Career Change', 'slug' => 'career-change'],
        ];

        foreach ($tags as $tag) {
            BlogTag::firstOrCreate(
                ['slug' => $tag['slug']],
                ['name' => $tag['name']]
            );
        }
    }
} 