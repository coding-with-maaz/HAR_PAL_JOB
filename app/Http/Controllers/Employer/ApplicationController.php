<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the applications for the employer's job postings.
     */
    public function index()
    {
        $applications = JobApplication::whereHas('jobPosting', function ($query) {
            $query->where('company_id', Auth::user()->company->id);
        })
        ->with(['jobPosting', 'applicant'])
        ->latest()
        ->paginate(10);

        return view('employer.applications.index', compact('applications'));
    }

    /**
     * Display the specified application.
     */
    public function show(JobApplication $application)
    {
        // Verify that the application belongs to the employer's company
        if ($application->jobPosting->company_id !== Auth::user()->company->id) {
            abort(403);
        }

        $application->load(['jobPosting', 'applicant']);

        // Check if applicant relationship exists
        if (!$application->applicant) {
            \Log::warning('Application missing applicant relationship', [
                'application_id' => $application->id,
                'applicant_id' => $application->applicant_id
            ]);
            
            return view('employer.applications.show', [
                'application' => $application,
                'error' => 'The applicant information for this application is not available.'
            ]);
        }

        return view('employer.applications.show', compact('application'));
    }

    /**
     * Update the application status.
     */
    public function updateStatus(Request $request, JobApplication $application)
    {
        // Verify that the application belongs to the employer's company
        if ($application->jobPosting->company_id !== Auth::user()->company->id) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,rejected,hired'
        ]);

        $application->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Application status updated successfully.');
    }
} 