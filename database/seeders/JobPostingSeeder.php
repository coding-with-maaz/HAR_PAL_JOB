<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobPosting;
use App\Models\JobTag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobPostingSeeder extends Seeder
{
    public function run()
    {
        $companies = Company::all();
        $jobTags = JobTag::all();

        foreach ($companies as $company) {
            $numJobs = rand(1, 3);
            for ($i = 0; $i < $numJobs; $i++) {
                $title = $this->getJobTitle($company->industry);
                $jobPosting = JobPosting::create([
                    'title' => $title,
                    'slug' => Str::slug($title . '-' . $company->name . '-' . uniqid()),
                    'description' => $this->getJobDescription($title),
                    'requirements' => json_encode($this->getRequirements($company->industry)),
                    'responsibilities' => $this->getResponsibilities($title),
                    'benefits' => json_encode($this->getBenefits()),
                    'salary_min' => rand(30000, 50000),
                    'salary_max' => rand(60000, 120000),
                    'employment_type' => $this->getRandomEmploymentType(),
                    'experience_level' => $this->getRandomExperienceLevel(),
                    'location' => $company->address,
                    'department' => $this->getRandomDepartment(),
                    'remote_allowed' => (bool)rand(0, 1),
                    'easy_apply' => (bool)rand(0, 1),
                    'skills_required' => json_encode($this->getSkills($company->industry)),
                    'company_id' => $company->id,
                    'posted_by' => $company->user_id,
                    'is_active' => true,
                    'application_deadline' => now()->addDays(rand(7, 30))
                ]);

                // Attach 2-4 random job tags
                $randomTags = $jobTags->random(rand(2, 4));
                $jobPosting->tags()->attach($randomTags);
            }
        }
    }

    private function getJobTitle(string $industry): string
    {
        $titles = [
            'Technology' => [
                'Software Engineer',
                'Full Stack Developer',
                'DevOps Engineer',
                'Data Scientist',
                'Product Manager',
                'UI/UX Designer',
                'Cloud Architect'
            ],
            'Healthcare' => [
                'Medical Director',
                'Registered Nurse',
                'Healthcare Administrator',
                'Clinical Research Coordinator',
                'Physical Therapist'
            ],
            'Finance' => [
                'Financial Analyst',
                'Investment Banker',
                'Risk Manager',
                'Accountant',
                'Financial Advisor'
            ],
            'Education' => [
                'Professor',
                'Academic Advisor',
                'Education Coordinator',
                'Curriculum Developer',
                'Educational Content Manager'
            ],
            'Manufacturing' => [
                'Production Manager',
                'Quality Control Specialist',
                'Manufacturing Engineer',
                'Supply Chain Manager',
                'Operations Supervisor'
            ],
            'Retail' => [
                'Store Manager',
                'Retail Operations Manager',
                'Sales Associate',
                'Visual Merchandiser',
                'Customer Service Manager'
            ],
            'Consulting' => [
                'Management Consultant',
                'Business Analyst',
                'Strategy Consultant',
                'IT Consultant',
                'Change Management Specialist'
            ]
        ];

        // If the industry doesn't exist in our titles array, use Technology as default
        if (!isset($titles[$industry])) {
            $industry = 'Technology';
        }

        return $titles[$industry][array_rand($titles[$industry])];
    }

    private function getJobDescription(string $title): string
    {
        return "We are seeking an experienced {$title} to join our growing team. The ideal candidate will have a strong background in their field and excellent communication skills. This is an exciting opportunity to work on challenging projects and make a significant impact.";
    }

    private function getResponsibilities(string $title): string
    {
        return "- Lead and execute key projects in the role of {$title}\n" .
               "- Collaborate with cross-functional teams to achieve objectives\n" .
               "- Develop and implement innovative solutions\n" .
               "- Monitor and report on key performance metrics\n" .
               "- Mentor and support team members\n" .
               "- Drive continuous improvement initiatives";
    }

    private function getRequirements(string $industry): array
    {
        $commonRequirements = [
            "Bachelor's degree in related field",
            "3+ years of relevant experience",
            "Excellent communication skills",
            "Strong problem-solving abilities",
            "Team player with leadership potential"
        ];

        $industrySpecificRequirements = [
            'Technology' => [
                'Programming experience in modern languages',
                'Understanding of software development lifecycle',
                'Experience with cloud platforms'
            ],
            'Healthcare' => [
                'Healthcare certification',
                'Knowledge of medical procedures',
                'Experience with patient care'
            ],
            'Finance' => [
                'Financial modeling skills',
                'Knowledge of financial markets',
                'Experience with financial software'
            ],
            'Education' => [
                'Teaching experience',
                'Curriculum development skills',
                'Educational technology proficiency'
            ],
            'Manufacturing' => [
                'Manufacturing process knowledge',
                'Quality control experience',
                'Safety regulation compliance'
            ],
            'Retail' => [
                'Retail management experience',
                'Sales expertise',
                'Inventory management skills'
            ],
            'Consulting' => [
                'Project management experience',
                'Business analysis skills',
                'Client relationship management'
            ]
        ];

        // If the industry doesn't exist in our requirements array, use Technology as default
        if (!isset($industrySpecificRequirements[$industry])) {
            $industry = 'Technology';
        }

        return array_merge($commonRequirements, $industrySpecificRequirements[$industry]);
    }

    private function getSkills(string $industry): array
    {
        $commonSkills = [
            'Communication',
            'Leadership',
            'Problem Solving',
            'Time Management'
        ];

        $industrySkills = [
            'Technology' => [
                'PHP',
                'JavaScript',
                'Python',
                'AWS',
                'Docker',
                'React',
                'Node.js'
            ],
            'Healthcare' => [
                'Patient Care',
                'Medical Records',
                'HIPAA',
                'Clinical Procedures'
            ],
            'Finance' => [
                'Financial Analysis',
                'Risk Management',
                'Excel',
                'SQL'
            ],
            'Education' => [
                'Curriculum Development',
                'E-learning',
                'Assessment',
                'LMS'
            ],
            'Manufacturing' => [
                'Quality Control',
                'Lean Manufacturing',
                'Supply Chain',
                'Safety Standards'
            ],
            'Retail' => [
                'Sales',
                'Customer Service',
                'Inventory Management',
                'Visual Merchandising'
            ],
            'Consulting' => [
                'Business Analysis',
                'Project Management',
                'Strategic Planning',
                'Change Management'
            ]
        ];

        // If the industry doesn't exist in our skills array, use Technology as default
        if (!isset($industrySkills[$industry])) {
            $industry = 'Technology';
        }

        return array_merge($commonSkills, $industrySkills[$industry]);
    }

    private function getBenefits(): array
    {
        $allBenefits = [
            'Health, dental, and vision insurance',
            '401(k) with company match',
            'Flexible work hours',
            'Remote work options',
            'Professional development budget',
            'Paid time off',
            'Parental leave',
            'Gym membership',
            'Company-sponsored events',
            'Stock options'
        ];

        // Return 5-7 random benefits
        $numBenefits = rand(5, 7);
        shuffle($allBenefits);
        return array_slice($allBenefits, 0, $numBenefits);
    }

    private function getRandomEmploymentType(): string
    {
        $types = ['full-time', 'part-time', 'contract', 'internship'];
        return $types[array_rand($types)];
    }

    private function getRandomExperienceLevel(): string
    {
        $levels = ['entry', 'mid', 'senior'];
        return $levels[array_rand($levels)];
    }

    private function getRandomDepartment(): string
    {
        $departments = [
            'Engineering',
            'Sales',
            'Marketing',
            'Human Resources',
            'Finance',
            'Operations',
            'Product',
            'Design',
            'Customer Support',
            'Research'
        ];
        return $departments[array_rand($departments)];
    }
} 