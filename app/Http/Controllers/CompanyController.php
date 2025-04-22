<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::withCount(['jobs' => function($query) {
            $query->where('is_active', true);
        }])
        ->where('status', 'approved')
        ->where('is_public', true);

        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('industry', 'like', "%{$searchTerm}%");
            });
        }

        // Apply industry filter
        if ($request->filled('industry') && $request->industry !== '') {
            $query->where('industry', $request->industry);
        }

        $companies = $query->latest()->paginate(12);

        // Get unique industries for the filter dropdown
        $industries = Company::distinct()
            ->whereNotNull('industry')
            ->where('status', 'approved')
            ->where('is_public', true)
            ->pluck('industry')
            ->filter()
            ->map(function ($industry) {
                return (string) $industry;
            })
            ->sort()
            ->values()
            ->toArray();

        // Ensure all company industries are strings
        $companies->each(function ($company) {
            if ($company->industry) {
                $company->industry = (string) $company->industry;
            }
        });

        // Debug the results
        \Log::info('Search Results:', [
            'total' => $companies->total(),
            'current_page' => $companies->currentPage(),
            'per_page' => $companies->perPage(),
            'has_results' => $companies->isNotEmpty()
        ]);

        return view('companies.index', compact('companies', 'industries'));
    }

    public function show(Company $company)
    {
        // Ensure only approved and public companies are shown directly (or pending if owned)
        // You might want to add more robust authorization logic here
        if (!($company->isApproved() && $company->isPublic())) {
            // Add logic here if you want owners/admins to see non-public/pending companies
            // For now, we just abort
            abort(404);
        }

        // Load necessary relationships
        $company->load(['jobs' => function ($query) {
            $query->where('is_active', true)->orderBy('created_at', 'desc');
        }]);

        // Calculate logo gradient class for the view
        $colors = [
            'from-indigo-500 to-purple-600',
            'from-blue-500 to-cyan-600',
            'from-green-500 to-emerald-600',
            'from-red-500 to-pink-600',
            'from-yellow-500 to-orange-600'
        ];
        $colorIndex = crc32($company->name) % count($colors);
        $logoGradient = $colors[$colorIndex];

        return view('companies.show', compact('company', 'logoGradient'));
    }

    public function create()
    {
        $this->authorize('create', Company::class);
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Company::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:1024',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'industry' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:255',
            'founded_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'headquarters' => 'nullable|string|max:255',
            'social_links' => 'nullable|array',
            'social_links.linkedin' => 'nullable|url|max:255',
            'social_links.twitter' => 'nullable|url|max:255',
            'social_links.facebook' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('company-logos', 'public');
        }

        $company = Company::create($validated);

        return redirect()->route('companies.show', $company)
            ->with('success', 'Company created successfully.');
    }

    public function edit(Company $company)
    {
        $this->authorize('update', $company);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:1024',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'industry' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:255',
            'founded_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'headquarters' => 'nullable|string|max:255',
            'social_links' => 'nullable|array',
            'social_links.linkedin' => 'nullable|url|max:255',
            'social_links.twitter' => 'nullable|url|max:255',
            'social_links.facebook' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $validated['logo'] = $request->file('logo')->store('company-logos', 'public');
        }

        $company->update($validated);

        return redirect()->route('companies.show', $company)
            ->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        // Delete logo if exists
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }
} 