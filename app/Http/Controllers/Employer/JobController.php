<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\JobPosting;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        
        if (!$company) {
            return redirect()->route('employer.company.create')
                ->with('warning', 'Please create your company profile first.');
        }
        
        $jobs = JobPosting::where('company_id', $company->id)
            ->latest()
            ->paginate(10);
            
        return view('employer.jobs.index', compact('jobs'));
    }
    
    public function create()
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        
        if (!$company) {
            return redirect()->route('employer.company.create')
                ->with('warning', 'Please create your company profile first.');
        }
        
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('employer.jobs.create', compact('categories', 'tags'));
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        
        if (!$company) {
            return redirect()->route('employer.company.create')
                ->with('warning', 'Please create your company profile first.');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'location' => 'required|string|max:255',
            'type' => 'required|string|in:full-time,part-time,contract,freelance,internship',
            'experience_level' => 'required|string|in:entry,mid,senior,lead,executive',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'deadline' => 'nullable|date|after:today',
            'is_featured' => 'boolean',
        ]);
        
        $validated['company_id'] = $company->id;
        $validated['slug'] = Str::slug($validated['title']);
        $validated['status'] = 'active';
        
        $job = JobPosting::create($validated);
        
        if (isset($validated['tags'])) {
            $job->tags()->sync($validated['tags']);
        }
        
        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job posted successfully.');
    }
    
    public function edit(JobPosting $job)
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        
        if (!$company || $job->company_id !== $company->id) {
            return redirect()->route('employer.jobs.index')
                ->with('error', 'You do not have permission to edit this job.');
        }
        
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('employer.jobs.edit', compact('job', 'categories', 'tags'));
    }
    
    public function update(Request $request, JobPosting $job)
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        
        if (!$company || $job->company_id !== $company->id) {
            return redirect()->route('employer.jobs.index')
                ->with('error', 'You do not have permission to update this job.');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'location' => 'required|string|max:255',
            'type' => 'required|string|in:full-time,part-time,contract,freelance,internship',
            'experience_level' => 'required|string|in:entry,mid,senior,lead,executive',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'deadline' => 'nullable|date|after:today',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive,closed',
        ]);
        
        $validated['slug'] = Str::slug($validated['title']);
        
        $job->update($validated);
        
        if (isset($validated['tags'])) {
            $job->tags()->sync($validated['tags']);
        } else {
            $job->tags()->detach();
        }
        
        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated successfully.');
    }
    
    public function destroy(JobPosting $job)
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        
        if (!$company || $job->company_id !== $company->id) {
            return redirect()->route('employer.jobs.index')
                ->with('error', 'You do not have permission to delete this job.');
        }
        
        $job->delete();
        
        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }
    
    public function applications(JobPosting $job)
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        
        if (!$company || $job->company_id !== $company->id) {
            return redirect()->route('employer.jobs.index')
                ->with('error', 'You do not have permission to view applications for this job.');
        }
        
        $applications = $job->applications()->with('user')->latest()->paginate(10);
        
        return view('employer.jobs.applications', compact('job', 'applications'));
    }
}
