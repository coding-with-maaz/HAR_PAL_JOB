<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\JobPosting;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = $user->company;

        // Initialize empty stats
        $stats = [
            'total_jobs' => 0,
            'active_jobs' => 0,
            'total_applications' => 0,
            'pending_applications' => 0,
            'interviewed_applications' => 0,
            'hired_applications' => 0,
        ];

        $recent_jobs = collect([]);
        $recent_applications = collect([]);
        $applications_by_status = [];

        // Check if user has just created a company profile
        $justCreated = session('company_created', false);
        if ($justCreated) {
            session()->forget('company_created');
        }

        if ($company) {
            // Get statistics
            $stats = [
                'total_jobs' => $company->jobs()->count(),
                'active_jobs' => $company->jobs()->where('is_active', true)->count(),
                'total_applications' => JobApplication::whereIn('job_posting_id', $company->jobs->pluck('id'))->count(),
                'pending_applications' => JobApplication::whereIn('job_posting_id', $company->jobs->pluck('id'))
                    ->where('status', 'pending')->count(),
                'interviewed_applications' => JobApplication::whereIn('job_posting_id', $company->jobs->pluck('id'))
                    ->where('status', 'interviewed')->count(),
                'hired_applications' => JobApplication::whereIn('job_posting_id', $company->jobs->pluck('id'))
                    ->where('status', 'hired')->count(),
            ];

            // Get recent job postings with applications count
            $recent_jobs = $company->jobs()
                ->withCount('applications')
                ->latest()
                ->take(5)
                ->get();

            // Get recent applications
            $recent_applications = JobApplication::whereIn('job_posting_id', $company->jobs->pluck('id'))
                ->with(['jobPosting', 'applicant'])
                ->latest()
                ->take(5)
                ->get();

            // Get applications by status
            $applications_by_status = JobApplication::whereIn('job_posting_id', $company->jobs->pluck('id'))
                ->selectRaw('status, count(*) as count')
                ->groupBy('status')
                ->get()
                ->pluck('count', 'status')
                ->toArray();
        }

        return view('employer.dashboard', compact(
            'stats',
            'recent_jobs',
            'recent_applications',
            'applications_by_status',
            'company',
            'justCreated'
        ));
    }
    
    public function profile()
    {
        $user = Auth::user();
        $company = $user->company;
        
        if (!$company) {
            return redirect()->route('employer.company.create')
                ->with('warning', 'Please create your company profile first.');
        }
        
        return view('employer.profile', compact('company'));
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $company = $user->company;
        
        if (!$company) {
            return redirect()->route('employer.company.create')
                ->with('warning', 'Please create your company profile first.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'industry' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:255',
            'founded_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'headquarters' => 'nullable|string|max:255',
        ]);
        
        $company->update($validated);
        
        return redirect()->route('employer.profile')
            ->with('success', 'Company profile updated successfully.');
    }
}
