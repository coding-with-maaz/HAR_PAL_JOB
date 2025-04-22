<?php

namespace App\Policies;

use App\Models\JobApplication;
use App\Models\User;

class JobApplicationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, JobApplication $application): bool
    {
        return $user->is_admin ||
            $application->applicant_id === $user->id ||
            $application->jobPosting->posted_by === $user->id;
    }

    public function create(User $user): bool
    {
        return !$user->is_admin && !$user->is_employer;
    }

    public function update(User $user, JobApplication $application): bool
    {
        return $user->is_admin || $application->jobPosting->posted_by === $user->id;
    }

    public function delete(User $user, JobApplication $application): bool
    {
        return $user->is_admin || $application->applicant_id === $user->id;
    }
} 