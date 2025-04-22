<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPosting::with(['company'])
            ->withCount('applications');

        // Filter by status
        if ($request->has('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Filter by company
        if ($request->has('company')) {
            $query->where('company_id', $request->company);
        }

        $jobs = $query->latest()->paginate(10);

        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $companies = Company::where('status', 'approved')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.jobs.create', compact('companies', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'requirements' => 'nullable|string',
            'benefits' => 'required|string',
            'location' => 'required|string|max:255',
            'department' => 'nullable|string|max:100',
            'employment_type' => 'required|string|in:full-time,part-time,contract,temporary,internship',
            'experience_level' => 'required|string|in:entry,mid-level,senior,executive',
            'salary_range' => 'nullable|string|max:100',
            'is_remote' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'status' => 'required|string|in:active,inactive',
            'application_deadline' => 'nullable|date|after:today',
        ]);

        // Process salary range
        if (!empty($validated['salary_range'])) {
            $salary_parts = explode('-', str_replace(' ', '', $validated['salary_range']));
            if (count($salary_parts) == 2) {
                $validated['salary_min'] = (float) preg_replace('/[^0-9.]/', '', $salary_parts[0]);
                $validated['salary_max'] = (float) preg_replace('/[^0-9.]/', '', $salary_parts[1]);
            }
        }
        unset($validated['salary_range']); // Remove the original salary_range as we now have min and max

        // Generate a unique slug from the title
        $slug = Str::slug($validated['title']);
        $count = 1;
        
        // Check if slug exists and increment counter until we find a unique slug
        while (JobPosting::where('slug', $slug)->exists()) {
            $slug = Str::slug($validated['title']) . '-' . $count;
            $count++;
        }
        
        $validated['slug'] = $slug;
        $validated['posted_by'] = auth()->id();

        // Process requirements into JSON array if provided
        if (isset($validated['requirements'])) {
            $requirements = array_map('trim', explode(',', $validated['requirements']));
            $validated['requirements'] = json_encode(array_values(array_filter($requirements)));
        }

        // Process benefits into JSON array
        $benefits = array_map('trim', explode(',', $validated['benefits']));
        $validated['benefits'] = json_encode(array_values(array_filter($benefits)));

        // Set default values for boolean fields if not provided
        $validated['is_remote'] = $request->has('is_remote');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['status'] = $request->input('status', 'active');

        JobPosting::create($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job posting created successfully.');
    }

    public function show(JobPosting $job)
    {
        $job->load(['company', 'applications.applicant']);
        return view('admin.jobs.show', compact('job'));
    }

    public function edit(JobPosting $job)
    {
        $companies = Company::where('status', 'approved')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.jobs.edit', compact('job', 'companies', 'categories'));
    }

    public function update(Request $request, JobPosting $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'requirements' => 'nullable|string',
            'benefits' => 'required|string',
            'location' => 'required|string|max:255',
            'department' => 'nullable|string|max:100',
            'employment_type' => 'required|string|in:full-time,part-time,contract,temporary,internship',
            'experience_level' => 'required|string|in:entry,mid-level,senior,executive',
            'salary_range' => 'nullable|string|max:100',
            'is_remote' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'status' => 'required|string|in:active,inactive',
            'application_deadline' => 'nullable|date|after:today',
        ]);

        // Process salary range
        if (!empty($validated['salary_range'])) {
            $salary_parts = explode('-', str_replace(' ', '', $validated['salary_range']));
            if (count($salary_parts) == 2) {
                $validated['salary_min'] = (float) preg_replace('/[^0-9.]/', '', $salary_parts[0]);
                $validated['salary_max'] = (float) preg_replace('/[^0-9.]/', '', $salary_parts[1]);
            }
        }
        unset($validated['salary_range']); // Remove the original salary_range as we now have min and max

        // Update slug if title has changed
        if ($job->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $count = 1;
            
            while (JobPosting::where('slug', $slug)->where('id', '!=', $job->id)->exists()) {
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

        // Set default values for boolean fields if not provided
        $validated['is_remote'] = $request->has('is_remote');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['status'] = $request->input('status', 'active');

        $job->update($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job posting updated successfully.');
    }

    public function destroy(JobPosting $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job posting deleted successfully.');
    }

    public function toggle(JobPosting $job)
    {
        $job->update(['is_active' => !$job->is_active]);

        return redirect()->back()
            ->with('success', 'Job status updated successfully.');
    }
} 