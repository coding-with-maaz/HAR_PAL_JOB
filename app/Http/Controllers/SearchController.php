<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\Company;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Ensure search parameters are strings
        $searchTerm = is_array($request->input('search')) ? '' : $request->input('search');
        $type = is_array($request->input('type')) ? 'all' : $request->input('type', 'all');
        $location = is_array($request->input('location')) ? '' : $request->input('location');
        $employmentType = is_array($request->input('employment_type')) ? '' : $request->input('employment_type');
        $remote = is_array($request->input('remote')) ? '' : $request->input('remote');
        
        $jobs = collect();
        $companies = collect();
        
        // Get categories with job counts
        $categories = JobPosting::where('is_active', true)
            ->select('department')
            ->selectRaw('count(*) as job_count')
            ->whereNotNull('department')
            ->groupBy('department')
            ->orderByRaw('count(*) DESC')
            ->get();

        // Get unique industries for companies
        $industries = Company::distinct()->pluck('industry')->filter();
        
        // If there's a department specified and type is jobs, redirect to category view
        if ($type === 'jobs' && $request->filled('department')) {
            return redirect()->route('jobs.category', [
                'department' => $request->department,
                'search' => $searchTerm,
                'location' => $location,
                'employment_type' => $employmentType,
                'remote' => $remote,
                'posted_today' => $request->posted_today,
                'easy_apply' => $request->easy_apply,
                'sort' => $request->sort,
            ]);
        }

        // Handle job searches
        if ($type === 'all' || $type === 'jobs') {
            $jobs = JobPosting::with(['company', 'applications'])
                ->where('is_active', true)
                ->when($searchTerm, function ($query) use ($searchTerm) {
                    $query->where(function ($q) use ($searchTerm) {
                        $q->where('title', 'like', "%{$searchTerm}%")
                            ->orWhere('description', 'like', "%{$searchTerm}%")
                            ->orWhere('department', 'like', "%{$searchTerm}%")
                            ->orWhereHas('company', function ($q) use ($searchTerm) {
                                $q->where('name', 'like', "%{$searchTerm}%");
                            });
                    });
                })
                ->when($location, function ($query) use ($location) {
                    $query->where('location', 'like', '%' . $location . '%');
                })
                ->when($employmentType, function ($query) use ($employmentType) {
                    $query->where('employment_type', $employmentType);
                })
                ->when($remote, function ($query) use ($remote) {
                    if ($remote === 'remote') {
                        $query->where('is_remote', true);
                    } elseif ($remote === 'hybrid') {
                        $query->where('is_remote', false)->where('is_hybrid', true);
                    } elseif ($remote === 'onsite') {
                        $query->where('is_remote', false)->where('is_hybrid', false);
                    }
                })
                ->when($request->filled('posted_today'), function ($query) {
                    $query->whereDate('created_at', today());
                })
                ->when($request->filled('easy_apply'), function ($query) {
                    $query->where('easy_apply', true);
                })
                ->when($request->filled('sort'), function ($query) use ($request) {
                    if ($request->sort === 'salary') {
                        $query->orderBy('salary_max', 'desc');
                    } else {
                        $query->latest();
                    }
                }, function ($query) {
                    $query->latest();
                })
                ->paginate(10)
                ->appends($request->except(['page']));

            // Format job attributes
            $jobs->getCollection()->transform(function ($job) {
                $job->formatted_skills_required = $job->skills_required ? json_decode($job->skills_required) : [];
                $job->formatted_benefits = $job->benefits ? json_decode($job->benefits) : [];
                return $job;
            });
        }

        // Handle company searches
        if ($type === 'all' || $type === 'companies') {
            $companies = Company::withCount(['jobs' => function($query) {
                $query->where('is_active', true);
            }])
            ->when($searchTerm, function ($query) use ($searchTerm) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%")
                        ->orWhere('description', 'like', "%{$searchTerm}%")
                        ->orWhere('industry', 'like', "%{$searchTerm}%");
                });
            })
            ->when($request->filled('industry'), function ($query) use ($request) {
                $query->where('industry', $request->industry);
            })
            ->latest()
            ->paginate(12);
        }

        return view('search.index', compact('jobs', 'companies', 'type', 'searchTerm', 'categories', 'industries'));
    }
} 