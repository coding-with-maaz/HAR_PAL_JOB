<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with(['jobPosting.company', 'applicant'])
            ->latest()
            ->paginate(10);

        return view('admin.applications.index', compact('applications'));
    }

    public function show(JobApplication $application)
    {
        $application->load(['jobPosting', 'applicant', 'jobPosting.company']);
        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', JobApplication::$statuses),
        ]);

        $application->update($validated);

        return redirect()->back()
            ->with('success', 'Application status updated successfully.');
    }

    public function destroy(JobApplication $application)
    {
        $application->delete();

        return redirect()->route('admin.applications.index')
            ->with('success', 'Application deleted successfully.');
    }
} 