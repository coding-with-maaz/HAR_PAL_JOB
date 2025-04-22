<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $permissions = [
            'manage-users' => 'Manage Users',
            'manage-roles' => 'Manage Roles',
            'manage-permissions' => 'Manage Permissions',
            'manage-jobs' => 'Manage Jobs',
            'manage-companies' => 'Manage Companies',
            'manage-blog' => 'Manage Blog',
            'manage-applications' => 'Manage Job Applications',
        ];

        foreach ($permissions as $slug => $name) {
            Permission::firstOrCreate([
                'slug' => $slug,
            ], [
                'name' => $name,
                'description' => "Permission to {$name}",
            ]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate([
            'slug' => 'admin',
        ], [
            'name' => 'Administrator',
            'description' => 'Full access to all features',
        ]);

        $employerRole = Role::firstOrCreate([
            'slug' => 'employer',
        ], [
            'name' => 'Employer',
            'description' => 'Can manage jobs and companies',
        ]);

        $jobSeekerRole = Role::firstOrCreate([
            'slug' => 'job-seeker',
        ], [
            'name' => 'Job Seeker',
            'description' => 'Can apply for jobs',
        ]);

        // Assign all permissions to admin role
        $adminRole->permissions()->sync(Permission::all());

        // Assign specific permissions to employer role
        $employerRole->permissions()->sync(
            Permission::whereIn('slug', ['manage-jobs', 'manage-companies'])->get()
        );

        // Create or update admin user
        $admin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        // Assign admin role to admin user
        $admin->roles()->sync([$adminRole->id]);
    }
} 