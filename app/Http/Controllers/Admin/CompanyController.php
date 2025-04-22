<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('user')
            ->withCount('jobs')
            ->latest()
            ->paginate(10);

        return view('admin.companies.index', compact('companies'));
    }

    public function show(Company $company)
    {
        $company->load(['user', 'jobs' => function ($query) {
            $query->latest()->with('applications');
        }]);

        return view('admin.companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'website' => 'nullable|url|max:255',
            'location' => 'required|string|max:255',
            'industry' => 'required|string|max:100',
            'size' => 'required|string|in:1-10,11-50,51-200,201-500,501-1000,1000+',
            'founded_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'status' => 'required|string|in:pending,approved,rejected'
        ]);

        $company->update($validated);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company deleted successfully.');
    }

    public function approve(Company $company)
    {
        $company->update(['status' => 'approved']);

        // Notify the company owner
        $company->user->notify(new \App\Notifications\CompanyApproved($company));

        return redirect()->route('admin.companies.show', $company)
            ->with('success', 'Company has been approved.');
    }

    public function reject(Company $company)
    {
        $company->update(['status' => 'rejected']);

        // Notify the company owner
        $company->user->notify(new \App\Notifications\CompanyRejected($company));

        return redirect()->route('admin.companies.show', $company)
            ->with('success', 'Company has been rejected.');
    }
} 