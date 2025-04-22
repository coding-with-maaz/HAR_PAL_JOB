<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class JobPostingController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPosting::with(['company'])->active();

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%")
                  ->orWhereHas('company', function($q) use ($searchTerm) {
                      $q->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Location filter
        if ($request->filled('location')) {
            $location = $request->get('location');
            $query->where('location', 'like', "%{$location}%");
        }

        // Department/Category filter
        if ($request->filled('department')) {
            $query->where('department', $request->get('department'));
        }

        // Employment Type filter
        if ($request->filled('employment_type')) {
            $query->where('employment_type', $request->get('employment_type'));
        }

        // Experience Level filter
        if ($request->filled('experience_level')) {
            $query->where('experience_level', $request->get('experience_level'));
        }

        // Remote Work filter
        if ($request->filled('remote')) {
            $query->where('is_remote', true);
        }

        // Salary Range filter
        if ($request->filled('salary_range')) {
            $range = $request->get('salary_range');
            if ($range === '100000+') {
                $query->where('salary_min', '>=', 100000);
            } else {
                $parts = explode('-', $range);
                if (count($parts) === 2) {
                    $min = (int) $parts[0];
                    $max = (int) $parts[1];
                    $query->where(function($q) use ($min, $max) {
                        $q->whereBetween('salary_min', [$min, $max])
                          ->orWhereBetween('salary_max', [$min, $max]);
                    });
                }
            }
        }

        // Posted Today filter
        if ($request->filled('posted_today')) {
            $query->whereDate('created_at', today());
        }

        // Easy Apply filter
        if ($request->filled('easy_apply')) {
            $query->where('easy_apply', true);
        }

        // Sort functionality
        if ($request->filled('sort')) {
            switch ($request->get('sort')) {
                case 'newest':
                    $query->latest();
                    break;
                case 'salary':
                    $query->orderByDesc('salary_max');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $jobs = $query->paginate(10)->withQueryString();

        // Get categories with job counts
        $categories = JobPosting::where('is_active', true)
            ->select('department')
            ->selectRaw('count(*) as job_count')
            ->whereNotNull('department')
            ->groupBy('department')
            ->orderByRaw('count(*) DESC')
            ->get();

        // Get unique locations for dropdown
        $locations = JobPosting::where('is_active', true)
            ->distinct()
            ->whereNotNull('location')
            ->pluck('location')
            ->sort();

        return view('jobs.index', compact('jobs', 'categories', 'locations'));
    }

    public function show(JobPosting $jobPosting)
    {
        $jobPosting->load('company');
        $jobPosting->incrementViewsCount();
        
        $relatedJobs = JobPosting::where('department', $jobPosting->department)
            ->where('id', '!=', $jobPosting->id)
            ->active()
            ->with('company')
            ->take(3)
            ->get();

        return view('jobs.show', compact('jobPosting', 'relatedJobs'));
    }

    public function create()
    {
        $this->authorize('create', JobPosting::class);
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', JobPosting::class);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'requirements' => 'nullable|string',
            'benefits' => 'required|string',
            'location' => 'required|string|max:255',
            'department' => 'nullable|string|max:100',
            'employment_type' => 'required|string|in:full-time,part-time,contract,temporary,internship',
            'experience_level' => 'required|string|in:entry,mid-level,senior,executive',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gt:salary_min',
            'is_remote' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'application_deadline' => 'nullable|date|after:today',
        ]);

        // Generate a unique slug from the title
        $slug = Str::slug($validated['title']);
        $count = 1;
        
        while (JobPosting::where('slug', $slug)->exists()) {
            $slug = Str::slug($validated['title']) . '-' . $count;
            $count++;
        }
        
        $validated['slug'] = $slug;
        $validated['posted_by'] = auth()->id();
        $validated['company_id'] = auth()->user()->company_id;

        // Process requirements into JSON array if provided
        if (isset($validated['requirements'])) {
            $requirements = array_map('trim', explode(',', $validated['requirements']));
            $validated['requirements'] = json_encode(array_values(array_filter($requirements)));
        }

        // Process benefits into JSON array
        $benefits = array_map('trim', explode(',', $validated['benefits']));
        $validated['benefits'] = json_encode(array_values(array_filter($benefits)));

        JobPosting::create($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Job posting created successfully.');
    }

    public function edit(JobPosting $jobPosting)
    {
        $this->authorize('update', $jobPosting);
        return view('jobs.edit', compact('jobPosting'));
    }

    public function update(Request $request, JobPosting $jobPosting)
    {
        $this->authorize('update', $jobPosting);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'requirements' => 'nullable|string',
            'benefits' => 'required|string',
            'location' => 'required|string|max:255',
            'department' => 'nullable|string|max:100',
            'employment_type' => 'required|string|in:full-time,part-time,contract,temporary,internship',
            'experience_level' => 'required|string|in:entry,mid-level,senior,executive',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gt:salary_min',
            'is_remote' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'application_deadline' => 'nullable|date|after:today',
        ]);

        // Update slug if title has changed
        if ($jobPosting->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $count = 1;
            
            while (JobPosting::where('slug', $slug)->where('id', '!=', $jobPosting->id)->exists()) {
                $slug = Str::slug($validated['title']) . '-' . $count;
                $count++;
            }
            
            $validated['slug'] = $slug;
        }

        // Process requirements into JSON array if provided
        if (isset($validated['requirements'])) {
            $requirements = array_map('trim', explode(',', $validated['requirements']));
            $validated['requirements'] = json_encode(array_values(array_filter($requirements)));
        }

        // Process benefits into JSON array
        $benefits = array_map('trim', explode(',', $validated['benefits']));
        $validated['benefits'] = json_encode(array_values(array_filter($benefits)));

        $jobPosting->update($validated);

        return redirect()->route('jobs.show', $jobPosting)
            ->with('success', 'Job posting updated successfully.');
    }

    public function destroy(JobPosting $jobPosting)
    {
        $this->authorize('delete', $jobPosting);
        
        $jobPosting->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Job posting deleted successfully.');
    }

    public function categoryJobs($department)
    {
        $jobs = JobPosting::where('department', $department)
            ->active()
            ->with('company')
            ->latest()
            ->paginate(10);

        return view('jobs.category', compact('jobs', 'department'));
    }
} 