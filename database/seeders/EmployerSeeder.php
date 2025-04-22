<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployerSeeder extends Seeder
{
    public function run()
    {
        $employerRole = Role::where('name', 'employer')->first();

        // Create 5 employer users
        for ($i = 1; $i <= 5; $i++) {
            $user = User::updateOrCreate(
                ['email' => 'employer' . $i . '@example.com'],
                [
                    'name' => 'Employer ' . $i,
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'phone' => '555-01' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'address' => 'Business Address ' . $i,
                    'bio' => 'Professional employer with experience in recruitment and HR management.',
                    'skills' => json_encode(['Recruitment', 'HR Management', 'Team Leadership']),
                    'experience' => rand(5, 15) . ' years',
                    'education' => 'Master\'s Degree in Human Resources',
                    'status' => 'active',
                ]
            );

            $user->roles()->syncWithoutDetaching([$employerRole->id]);

            // Create a company for each employer
            Company::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name' => 'Company ' . $i,
                    'description' => 'A leading company in the industry.',
                    'website' => 'https://company' . $i . '.com',
                    'email' => 'contact@company' . $i . '.com',
                    'phone' => '555-02' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'address' => '123 Business St, Suite ' . $i,
                    'logo' => null,
                    'industry' => $this->getRandomIndustry(),
                    'company_size' => $this->getRandomCompanySize(),
                    'founded_year' => rand(1990, 2020),
                    'linkedin_url' => 'https://linkedin.com/company' . $i,
                    'twitter_url' => 'https://twitter.com/company' . $i,
                    'facebook_url' => 'https://facebook.com/company' . $i,
                    'status' => 'approved',
                    'is_public' => true,
                    'slug' => 'company-' . $i
                ]
            );
        }
    }

    private function getRandomIndustry()
    {
        $industries = [
            'Technology',
            'Healthcare',
            'Finance',
            'Education',
            'Manufacturing',
            'Retail',
            'Consulting',
        ];

        return $industries[array_rand($industries)];
    }

    private function getRandomCompanySize()
    {
        $sizes = [
            '1-10',
            '11-50',
            '51-200',
            '201-500',
            '501-1000',
            '1000+',
        ];

        return $sizes[array_rand($sizes)];
    }
} 