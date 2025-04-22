<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\Company;
use App\Models\Category;
use App\Models\JobTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobPostingController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return redirect()->route('employer.dashboard')
                ->with('error', 'Please complete your company profile first.');
        }

        $query = $company->jobs()
            ->withCount('applications')
            ->latest();

        // Only show active jobs by default
        if (!$request->has('show_inactive')) {
            $query->where('is_active', true);
        }

        $jobs = $query->paginate(10);

        return view('employer.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return redirect()->route('employer.dashboard')
                ->with('error', 'Please complete your company profile first.');
        }

        if ($company->status !== 'approved') {
            return redirect()->route('employer.dashboard')
                ->with('error', 'Your company profile must be approved before posting jobs.');
        }

        $categories = Category::orderBy('name')->get();
        $tags = JobTag::orderBy('name')->get();
        return view('employer.jobs.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $company = $user->company;

        if (!$company || $company->status !== 'approved') {
            return redirect()->route('employer.dashboard')
                ->with('error', 'Unable to post jobs at this time.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'required_skills' => 'required|string',
            'benefits' => 'required|string',
            'requirements' => 'nullable|string',
            'department' => 'nullable|string|max:100',
            'salary_range' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|string|in:full-time,part-time,contract,temporary,internship',
            'experience_level' => 'required|string|in:entry,mid-level,senior,executive',
            'tags' => 'nullable|string',
            'is_remote' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'application_deadline' => 'nullable|date|after:today',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Process required skills into JSON array
        $skills = array_map('trim', explode(',', $validated['required_skills']));
        $validated['skills_required'] = json_encode(array_values(array_filter($skills)));
        
        // Process benefits into JSON array
        $benefits = array_map('trim', explode(',', $validated['benefits']));
        $validated['benefits'] = json_encode(array_values(array_filter($benefits)));
        
        // Process requirements into JSON array if provided
        if (isset($validated['requirements'])) {
            $requirements = array_map('trim', explode(',', $validated['requirements']));
            $validated['requirements'] = json_encode(array_values(array_filter($requirements)));
        } else {
            $validated['requirements'] = json_encode([]);
        }

        // Process salary range
        if (!empty($validated['salary_range'])) {
            $salary_parts = explode('-', str_replace(' ', '', $validated['salary_range']));
            if (count($salary_parts) == 2) {
                $validated['salary_min'] = (float) preg_replace('/[^0-9.]/', '', $salary_parts[0]);
                $validated['salary_max'] = (float) preg_replace('/[^0-9.]/', '', $salary_parts[1]);
            }
        }
        unset($validated['salary_range']); // Remove the original salary_range as we now have min and max
        
        // Process tags - ensure uniqueness
        $tags = array_unique(array_map('trim', explode(',', $validated['tags'] ?? '')));
        unset($validated['tags']); // Remove tags from validated data as we'll handle them separately

        $validated['company_id'] = $company->id;
        $validated['posted_by'] = $user->id;
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(8);

        $job = JobPosting::create($validated);

        // Save tags
        $tagIds = [];
        foreach ($tags as $tagName) {
            if (!empty($tagName)) {
                $tag = JobTag::firstOrCreate(
                    ['name' => $tagName],
                    ['slug' => Str::slug($tagName)]
                );
                $tagIds[] = $tag->id;
            }
        }
        
        // Attach all tags at once
        if (!empty($tagIds)) {
            $job->tags()->attach(array_unique($tagIds));
        }

        return redirect()->route('employer.jobs.show', $job)
            ->with('success', 'Job posting created successfully.');
    }

    public function show(JobPosting $job)
    {
        $user = Auth::user();
        $company = $user->company;

        if ($job->company_id !== $company->id) {
            abort(403, 'Unauthorized action.');
        }

        $job->load(['applications' => function ($query) {
            $query->with('user')->latest();
        }]);

        return view('employer.jobs.show', compact('job'));
    }

    public function edit(JobPosting $job)
    {
        $user = Auth::user();
        $company = $user->company;

        if ($job->company_id !== $company->id) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        return view('employer.jobs.edit', compact('job', 'categories'));
    }

    public function update(Request $request, JobPosting $job)
    {
        $user = Auth::user();
        $company = $user->company;

        if ($job->company_id !== $company->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'benefits' => 'nullable|string',
            'salary_range' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|string|in:full-time,part-time,contract,temporary,internship',
            'experience_level' => 'required|string|in:entry,mid-level,senior,executive',
            'is_remote' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'application_deadline' => 'nullable|date|after:today',
        ]);

        $job->update($validated);

        return redirect()->route('employer.jobs.show', $job)
            ->with('success', 'Job posting updated successfully.');
    }

    public function destroy(JobPosting $job)
    {
        $user = Auth::user();
        $company = $user->company;

        if ($job->company_id !== $company->id) {
            abort(403, 'Unauthorized action.');
        }

        $job->delete();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job posting deleted successfully.');
    }

    public function toggle(JobPosting $job)
    {
        $user = Auth::user();
        $company = $user->company;

        if ($job->company_id !== $company->id) {
            abort(403, 'Unauthorized action.');
        }

        $job->update(['is_active' => !$job->is_active]);

        return redirect()->back()
            ->with('success', 'Job status updated successfully.');
    }
} 