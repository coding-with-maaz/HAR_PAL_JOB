<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Get all active job postings grouped by department
        $categories = JobPosting::where('is_active', true)
            ->select('department')
            ->selectRaw('count(*) as job_count')
            ->groupBy('department')
            ->orderBy('job_count', 'desc')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function show($department)
    {
        // Get all active jobs for the specified department
        $jobs = JobPosting::where('is_active', true)
            ->where('department', $department)
            ->with('company')
            ->latest()
            ->paginate(12);

        // If no jobs found for this department, return 404
        if ($jobs->isEmpty()) {
            abort(404, 'Category not found');
        }

        return view('categories.show', [
            'department' => $department,
            'jobs' => $jobs,
            'jobCount' => $jobs->total()
        ]);
    }
} 