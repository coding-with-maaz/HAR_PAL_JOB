<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First seed roles and admin user
        $this->call(RoleSeeder::class);

        // Seed users
        $this->call(UserSeeder::class);

        // Seed employers
        $this->call(EmployerSeeder::class);

        // Seed categories and tags
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
        ]);

        // Seed companies
        $this->call(CompanySeeder::class);

        // Seed job tags
        $this->call(JobTagSeeder::class);

        // Seed job postings
        $this->call(JobPostingSeeder::class);

        // Seed job applications
        $this->call(JobApplicationSeeder::class);

        // Seed blog-related data
        $this->call([
            BlogCategorySeeder::class,
            BlogTagSeeder::class,
            BlogPostSeeder::class,
        ]);
    }
}
