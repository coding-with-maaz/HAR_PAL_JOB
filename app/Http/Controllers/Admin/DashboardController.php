<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\Company;
use App\Models\User;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts for overview
        $stats = [
            'total_users' => User::count(),
            'total_companies' => Company::count(),
            'total_jobs' => JobPosting::count(),
            'total_applications' => JobApplication::count(),
            'pending_companies' => Company::where('status', 'pending')->count(),
            'active_jobs' => JobPosting::where('is_active', true)->count(),
            'today_applications' => JobApplication::whereDate('created_at', today())->count(),
            'today_jobs' => JobPosting::whereDate('created_at', today())->count(),
            'today_users' => User::whereDate('created_at', today())->count(),
        ];

        // Get monthly job postings for the chart (last 12 months)
        $monthlyJobs = JobPosting::selectRaw('COUNT(*) as count, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Get monthly applications for the chart
        $monthlyApplications = JobApplication::selectRaw('COUNT(*) as count, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Get top job categories with percentage
        $totalJobs = JobPosting::count();
        $topCategories = JobPosting::select('department as name', DB::raw('COUNT(*) as count'))
            ->whereNotNull('department')
            ->groupBy('department')
            ->orderByDesc('count')
            ->limit(5)
            ->get()
            ->map(function ($category) use ($totalJobs) {
                $category->percentage = round(($category->count / $totalJobs) * 100, 1);
                return $category;
            });

        // Get recent activities with more details
        $recentActivities = collect();
        
        // Add recent job postings with status
        $recentJobs = JobPosting::with('company')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($job) {
                return [
                    'type' => 'job',
                    'message' => "New job posted: {$job->title}",
                    'company' => $job->company->name,
                    'status' => $job->is_active ? 'active' : 'inactive',
                    'date' => $job->created_at,
                ];
            });
        
        // Add recent company registrations with status
        $recentCompanies = Company::latest()
            ->limit(5)
            ->get()
            ->map(function ($company) {
                return [
                    'type' => 'company',
                    'message' => "New company registered: {$company->name}",
                    'status' => $company->status,
                    'date' => $company->created_at,
                ];
            });

        // Add recent applications
        $recentApplications = JobApplication::with(['jobPosting', 'applicant'])
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($application) {
                $jobTitle = $application->jobPosting ? $application->jobPosting->title : 'Unknown Job';
                $applicantName = $application->applicant ? $application->applicant->name : 'Unknown Applicant';
                
                return [
                    'type' => 'application',
                    'message' => "New application for: {$jobTitle}",
                    'applicant' => $applicantName,
                    'date' => $application->created_at,
                ];
            });

        // Merge and sort activities
        $recentActivities = $recentJobs->concat($recentCompanies)
            ->concat($recentApplications)
            ->sortByDesc('date')
            ->take(10);

        // Get job status distribution
        $jobStatusDistribution = [
            'active' => JobPosting::where('is_active', true)->count(),
            'inactive' => JobPosting::where('is_active', false)->count(),
        ];

        // Get company status distribution
        $companyStatusDistribution = [
            'approved' => Company::where('status', 'approved')->count(),
            'pending' => Company::where('status', 'pending')->count(),
            'rejected' => Company::where('status', 'rejected')->count(),
        ];

        return view('admin.dashboard', compact(
            'stats',
            'monthlyJobs',
            'monthlyApplications',
            'topCategories',
            'recentActivities',
            'jobStatusDistribution',
            'companyStatusDistribution'
        ));
    }
} 