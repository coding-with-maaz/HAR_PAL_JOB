<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $employers = User::whereHas('roles', function($query) {
            $query->where('slug', 'employer');
        })->get();

        // If no employers exist, create a default one
        if ($employers->isEmpty()) {
            $user = User::factory()->create([
                'email' => 'employer@example.com',
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('employer');
            $employers = collect([$user]);
        }

        $companies = [
            [
                'name' => 'Tech Solutions Inc.',
                'description' => 'Leading technology company focused on innovation and digital transformation.',
                'website' => 'https://techsolutions.com',
                'industry' => 'Technology',
                'company_size' => '1000-5000',
                'founded_year' => 2010,
                'is_featured' => true,
                'is_verified' => true,
                'status' => 'approved',
                'is_public' => true,
                'logo' => null,
                'email' => 'contact@techsolutions.com',
                'phone' => '555-0123',
                'address' => '123 Tech Park, New York, NY 10001',
                'linkedin_url' => 'https://linkedin.com/company/tech-solutions',
                'twitter_url' => 'https://twitter.com/techsolutions',
                'facebook_url' => 'https://facebook.com/techsolutions'
            ],
            [
                'name' => 'Global Innovations Ltd',
                'description' => 'International consulting firm specializing in business transformation.',
                'website' => 'https://globalinnovations.com',
                'industry' => 'Consulting',
                'company_size' => '500-1000',
                'founded_year' => 2005,
                'is_featured' => true,
                'is_verified' => true,
                'status' => 'approved',
                'is_public' => true,
                'logo' => null,
                'email' => 'info@globalinnovations.com',
                'phone' => '555-0124',
                'address' => '456 Innovation Ave, San Francisco, CA 94105',
                'linkedin_url' => 'https://linkedin.com/company/global-innovations',
                'twitter_url' => 'https://twitter.com/globalinnovations',
                'facebook_url' => 'https://facebook.com/globalinnovations'
            ],
            [
                'name' => 'Digital Innovations',
                'description' => 'Full-service digital agency helping businesses grow globally.',
                'website' => 'https://digitalinnovations.com',
                'industry' => 'Technology',
                'company_size' => '100-500',
                'founded_year' => 2015,
                'is_featured' => true,
                'is_verified' => true,
                'status' => 'approved',
                'is_public' => true,
                'logo' => null,
                'email' => 'contact@digitalinnovations.com',
                'phone' => '555-0125',
                'address' => '789 Digital St, San Francisco, CA 94101',
                'linkedin_url' => 'https://linkedin.com/company/digital-innovations',
                'twitter_url' => 'https://twitter.com/digitalinnovations',
                'facebook_url' => 'https://facebook.com/digitalinnovations'
            ],
            [
                'name' => 'Global Tech Services',
                'description' => 'Leading technology services provider focused on enterprise solutions.',
                'website' => 'https://globaltechservices.com',
                'industry' => 'Technology',
                'company_size' => '5000+',
                'founded_year' => 2000,
                'is_featured' => true,
                'is_verified' => true,
                'status' => 'approved',
                'is_public' => true,
                'logo' => null,
                'email' => 'contact@globaltechservices.com',
                'phone' => '555-0126',
                'address' => '101 Tech Blvd, Chicago, IL 60601',
                'linkedin_url' => 'https://linkedin.com/company/global-tech-services',
                'twitter_url' => 'https://twitter.com/globaltechservices',
                'facebook_url' => 'https://facebook.com/globaltechservices'
            ],
            [
                'name' => 'Pending Company',
                'description' => 'A company that is pending approval.',
                'website' => 'https://pendingcompany.com',
                'industry' => 'Technology',
                'company_size' => '10-50',
                'founded_year' => 2020,
                'is_featured' => false,
                'is_verified' => false,
                'status' => 'pending',
                'is_public' => true,
                'logo' => null,
                'email' => 'contact@pendingcompany.com',
                'phone' => '555-0127',
                'address' => '111 Pending St, Austin, TX 78701',
                'linkedin_url' => 'https://linkedin.com/company/pending-company',
                'twitter_url' => 'https://twitter.com/pendingcompany',
                'facebook_url' => 'https://facebook.com/pendingcompany'
            ],
            [
                'name' => 'Rejected Company',
                'description' => 'A company that was rejected.',
                'website' => 'https://rejectedcompany.com',
                'industry' => 'Technology',
                'company_size' => '10-50',
                'founded_year' => 2021,
                'is_featured' => false,
                'is_verified' => false,
                'status' => 'rejected',
                'is_public' => true,
                'logo' => null,
                'email' => 'contact@rejectedcompany.com',
                'phone' => '555-0128',
                'address' => '222 Rejected Ave, Seattle, WA 98101',
                'linkedin_url' => 'https://linkedin.com/company/rejected-company',
                'twitter_url' => 'https://twitter.com/rejectedcompany',
                'facebook_url' => 'https://facebook.com/rejectedcompany'
            ],
        ];

        // Loop through companies and assign a random user_id
        foreach ($companies as $companyData) {
            // Assign a random user
            $companyData['user_id'] = $employers->random()->id;

            // Generate slug from name
            $companyData['slug'] = Str::slug($companyData['name']);

            // Check for existing company by slug to avoid duplicates during seeding
            Company::updateOrCreate(
                ['slug' => $companyData['slug']], // Use slug as the unique identifier
                $companyData
            );
        }
    }
} 