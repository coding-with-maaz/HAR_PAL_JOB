<?php

namespace Database\Seeders;

use App\Models\JobApplication;
use App\Models\JobPosting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobApplicationSeeder extends Seeder
{
    public function run(): void
    {
        // Get all job postings and regular users (non-employers)
        $jobPostings = JobPosting::where('is_active', true)->get();
        $users = User::whereDoesntHave('roles', function($query) {
            $query->where('name', 'employer');
        })->get();

        if ($jobPostings->isEmpty() || $users->isEmpty()) {
            $this->command->info('No active job postings or users found. Skipping job application seeding.');
            return;
        }

        // Create 5-10 applications for each job posting
        foreach ($jobPostings as $jobPosting) {
            $numApplications = rand(5, 10);
            $selectedUsers = $users->random(min($numApplications, $users->count()));

            foreach ($selectedUsers as $user) {
                // Check if application already exists
                if (JobApplication::where('job_posting_id', $jobPosting->id)
                    ->where('user_id', $user->id)
                    ->exists()) {
                    continue;
                }

                $status = $this->getRandomStatus();
                $createdAt = now()->subDays(rand(0, 30));

                $application = JobApplication::create([
                    'job_posting_id' => $jobPosting->id,
                    'user_id' => $user->id,
                    'phone' => $user->phone ?? $this->generateRandomPhone(),
                    'resume' => 'resumes/sample-resume.pdf', // Assuming you have a sample resume in storage
                    'cover_letter' => $this->generateCoverLetter($jobPosting, $user),
                    'answers' => $this->generateApplicationAnswers(),
                    'status' => $status,
                    'notes' => $status === 'rejected' ? 'Not enough experience' : null,
                    'reviewed_at' => $status !== 'pending' ? $createdAt->addDays(rand(1, 5)) : null,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);

                // Increment the applications count for the job posting
                $jobPosting->increment('applications_count');
            }
        }
    }

    private function generateRandomPhone(): string
    {
        return '+1' . rand(100, 999) . rand(100, 999) . rand(1000, 9999);
    }

    private function getRandomStatus(): string
    {
        $statuses = [
            'pending',
            'reviewed',
            'shortlisted',
            'rejected',
            'hired'
        ];

        return $statuses[array_rand($statuses)];
    }

    private function generateCoverLetter(JobPosting $job, User $user): string
    {
        return "Dear Hiring Manager,

I am writing to express my interest in the {$job->title} position at {$job->company->name}. With my background in {$this->getRandomSkill()}, I believe I would be a valuable addition to your team.

I am particularly drawn to this opportunity because {$this->getRandomReason()}. My experience aligns well with the requirements outlined in the job description, and I am confident in my ability to contribute to your organization's success.

Thank you for considering my application. I look forward to the opportunity to discuss how my skills and experience would benefit {$job->company->name}.

Best regards,
{$user->name}";
    }

    private function generateApplicationAnswers(): array
    {
        return [
            'Why are you interested in this position?' => 'I am excited about the opportunity to work with a dynamic team and contribute to innovative projects.',
            'What relevant experience do you have?' => 'I have several years of experience in the field and have worked on similar projects.',
            'What are your salary expectations?' => 'I am open to discussing a competitive salary based on my experience and the market rate.',
        ];
    }

    private function getRandomSkill(): string
    {
        $skills = ['PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js', 'Node.js', 'Python', 'Java', 'C#', 'SQL'];
        return $skills[array_rand($skills)];
    }

    private function getRandomReason(): string
    {
        $reasons = [
            'I am passionate about the work your company does',
            'I am looking for a new challenge in my career',
            'I want to work with cutting-edge technologies',
            'I am impressed by your company culture',
            'I want to contribute to meaningful projects',
        ];
        return $reasons[array_rand($reasons)];
    }
} 