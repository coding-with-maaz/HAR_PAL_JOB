<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create regular users (job seekers)
        $regularUserRole = Role::where('slug', 'job-seeker')->first();

        // Create 20 regular users
        for ($i = 1; $i <= 20; $i++) {
            $user = User::updateOrCreate(
                ['email' => 'user' . $i . '@example.com'],
                [
                    'name' => 'User ' . $i,
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'phone' => '123456789' . $i,
                    'address' => 'Address ' . $i,
                    'bio' => 'This is a sample bio for User ' . $i,
                    'resume' => null,
                    'skills' => json_encode(['PHP', 'Laravel', 'JavaScript', 'HTML', 'CSS']),
                    'experience' => rand(1, 10) . ' years',
                    'education' => 'Bachelor\'s Degree in Computer Science',
                    'status' => 'active',
                ]
            );
            $user->roles()->syncWithoutDetaching([$regularUserRole->id]);
        }

        // Create admin user
        $adminRole = Role::where('slug', 'admin')->first();
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'phone' => '1234567890',
                'address' => 'Admin Address',
                'bio' => 'This is the admin user',
                'resume' => null,
                'skills' => json_encode(['Management', 'Administration']),
                'experience' => '5 years',
                'education' => 'Master\'s Degree in Business Administration',
                'status' => 'active',
            ]
        );
        $admin->roles()->syncWithoutDetaching([$adminRole->id]);

        // Create employer user
        $employerRole = Role::where('slug', 'employer')->first();
        $employer = User::updateOrCreate(
            ['email' => 'employer@example.com'],
            [
                'name' => 'Employer User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'phone' => '1234567891',
                'address' => 'Employer Address',
                'bio' => 'This is an employer user',
                'resume' => null,
                'skills' => json_encode(['Recruitment', 'HR Management']),
                'experience' => '5 years',
                'education' => 'Bachelor\'s Degree in Human Resources',
                'status' => 'active',
            ]
        );
        $employer->roles()->syncWithoutDetaching([$employerRole->id]);
    }
} 