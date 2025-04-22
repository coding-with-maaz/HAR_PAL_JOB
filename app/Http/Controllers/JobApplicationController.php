<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with(['jobPosting', 'jobPosting.company'])
            ->where('applicant_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('applications.index', compact('applications'));
    }

    public function create(JobPosting $jobPosting)
    {
        if (!$jobPosting->is_active) {
            return redirect()->route('jobs.show', $jobPosting)
                ->with('error', 'This job posting is no longer accepting applications.');
        }

        // Check if user has already applied
        if (auth()->user()->jobApplications()->where('job_posting_id', $jobPosting->id)->exists()) {
            return redirect()->route('jobs.show', $jobPosting)
                ->with('error', 'You have already applied for this position.');
        }

        // Check if application deadline has passed
        if ($jobPosting->application_deadline && $jobPosting->application_deadline->isPast()) {
            return redirect()->route('jobs.show', $jobPosting)
                ->with('error', 'The application deadline for this position has passed.');
        }

        return view('applications.create', compact('jobPosting'));
    }

    public function store(Request $request, JobPosting $job)
    {
        try {
            $request->validate([
                'cover_letter' => 'required|string|min:50',
                'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
                'phone' => 'nullable|string|max:20',
                'answers' => 'nullable|array'
            ]);

            if ($request->hasFile('resume')) {
                $resumePath = $request->file('resume')->store('resumes', 'public');
            } else {
                return back()->with('error', 'Please upload a valid resume file.');
            }

            $application = JobApplication::create([
                'job_posting_id' => $job->id,
                'applicant_id' => auth()->id(),
                'phone' => $request->phone ?? auth()->user()->phone,
                'resume' => $resumePath,
                'cover_letter' => $request->cover_letter,
                'answers' => $request->answers,
                'status' => 'pending'
            ]);

            return redirect()->route('jobs.show', $job->slug)
                ->with('success', 'Your application has been submitted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while submitting your application. Please try again.');
        }
    }

    public function show(JobApplication $application)
    {
        $this->authorize('view', $application);
        
        $application->load(['jobPosting', 'jobPosting.company', 'applicant']);
        
        return view('applications.show', compact('application'));
    }

    public function update(Request $request, JobApplication $application)
    {
        $this->authorize('update', $application);

        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', JobApplication::$statuses),
            'notes' => 'nullable|string',
        ]);

        $application->update($validated);

        return redirect()->route('applications.show', $application)
            ->with('success', 'Application status updated successfully.');
    }

    public function downloadResume(JobApplication $application)
    {
        $this->authorize('view', $application);

        if (!Storage::disk('public')->exists($application->resume)) {
            abort(404, 'Resume file not found.');
        }

        return Storage::disk('public')->download($application->resume);
    }

    public function destroy(JobApplication $application)
    {
        $this->authorize('delete', $application);

        Storage::disk('public')->delete($application->resume_path);
        $application->delete();

        return redirect()->route('applications.index')
            ->with('success', 'Application withdrawn successfully.');
    }

    public function success(JobApplication $application)
    {
        if ($application->user_id !== auth()->id()) {
            abort(403);
        }

        return view('applications.success', compact('application'));
    }
} 