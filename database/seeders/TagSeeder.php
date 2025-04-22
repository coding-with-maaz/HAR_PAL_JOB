<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Remote', 'slug' => 'remote'],
            ['name' => 'Full-time', 'slug' => 'full-time'],
            ['name' => 'Part-time', 'slug' => 'part-time'],
            ['name' => 'Contract', 'slug' => 'contract'],
            ['name' => 'Freelance', 'slug' => 'freelance'],
            ['name' => 'Entry Level', 'slug' => 'entry-level'],
            ['name' => 'Mid Level', 'slug' => 'mid-level'],
            ['name' => 'Senior Level', 'slug' => 'senior-level'],
            ['name' => 'Manager', 'slug' => 'manager'],
            ['name' => 'Director', 'slug' => 'director'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(
                ['slug' => $tag['slug']],
                ['name' => $tag['name']]
            );
        }
    }
}
