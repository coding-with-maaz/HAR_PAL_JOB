<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;

class CompanyPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Company $company): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->is_admin || $user->is_employer;
    }

    public function update(User $user, Company $company): bool
    {
        return $user->is_admin || $company->user_id === $user->id;
    }

    public function delete(User $user, Company $company): bool
    {
        return $user->is_admin || $company->user_id === $user->id;
    }

    public function manageJobs(User $user, Company $company): bool
    {
        return $user->is_admin || $company->jobs()->where('posted_by', $user->id)->exists();
    }
} 