<?php

namespace Database\Seeders;

use App\Models\JobTag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobTagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            // Technical Skills
            'PHP',
            'JavaScript',
            'Python',
            'Java',
            'React',
            'Vue.js',
            'Angular',
            'Node.js',
            'Laravel',
            'AWS',
            'Docker',
            'Kubernetes',
            'SQL',
            'NoSQL',
            'Git',

            // Soft Skills
            'Leadership',
            'Communication',
            'Problem Solving',
            'Team Work',
            'Project Management',
            'Time Management',
            'Agile',
            'Scrum',

            // Industry Specific
            'Healthcare IT',
            'FinTech',
            'EdTech',
            'E-commerce',
            'Digital Marketing',
            'Data Science',
            'AI/ML',
            'Cybersecurity',

            // Job Level
            'Entry Level',
            'Mid Level',
            'Senior Level',
            'Management',
            'Executive',

            // Work Environment
            'Remote',
            'Hybrid',
            'On-site',
            'Flexible Hours',
            'International'
        ];

        foreach ($tags as $tag) {
            JobTag::create([
                'name' => $tag,
                'slug' => Str::slug($tag)
            ]);
        }
    }
} 