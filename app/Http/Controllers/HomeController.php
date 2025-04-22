<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $totalJobs = JobPosting::where('is_active', true)->count();
        $totalCompanies = Company::count();
        $totalUsers = User::count();

        $featuredJobs = JobPosting::where('is_active', true)
            ->with('company')
            ->latest()
            ->take(6)
            ->get();

        $categories = JobPosting::where('is_active', true)
            ->select('department')
            ->selectRaw('count(*) as job_count')
            ->whereNotNull('department')
            ->groupBy('department')
            ->orderByRaw('count(*) DESC')
            ->take(8)
            ->get();

        $featuredCompanies = Company::withCount(['jobs' => function ($query) {
            $query->where('is_active', true);
        }])
        ->orderByDesc('jobs_count')
        ->take(6)
        ->get();

        $recentJobs = JobPosting::where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        $companies = Company::whereIn('id', $recentJobs->pluck('company_id'))->get();
        $companiesMap = $companies->pluck('name', 'id');

        $topDepartments = JobPosting::where('is_active', true)
            ->whereNotNull('department')
            ->select('department', DB::raw('count(*) as job_count'))
            ->groupBy('department')
            ->orderByDesc('job_count')
            ->limit(8)
            ->get();

        return view('home', compact(
            'totalJobs',
            'totalCompanies',
            'totalUsers',
            'featuredJobs',
            'categories',
            'featuredCompanies',
            'recentJobs',
            'companies',
            'companiesMap',
            'topDepartments'
        ));
    }
} 