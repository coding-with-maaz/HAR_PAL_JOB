<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobPosting;
use App\Policies\CompanyPolicy;
use App\Policies\JobApplicationPolicy;
use App\Policies\JobPostingPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        JobPosting::class => JobPostingPolicy::class,
        JobApplication::class => JobApplicationPolicy::class,
        Company::class => CompanyPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
} 