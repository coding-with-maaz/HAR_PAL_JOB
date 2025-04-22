<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function create()
    {
        // Check if employer already has a company
        if (Auth::user()->company) {
            return redirect()->route('employer.dashboard')
                ->with('warning', 'You already have a company profile.');
        }
        
        return view('employer.company.create');
    }
    
    public function store(Request $request)
    {
        // Check if employer already has a company
        if (Auth::user()->company) {
            return redirect()->route('employer.dashboard')
                ->with('warning', 'You already have a company profile.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'website' => 'nullable|url',
            'industry' => 'required|string|max:255',
            'company_size' => 'required|string|max:255',
            'founded_year' => 'required|integer|min:1800|max:' . date('Y'),
            'headquarters' => 'required|string|max:255',
            'is_public' => 'boolean'
        ]);

        $company = new Company($validated);
        $company->user_id = Auth::id();
        $company->slug = Str::slug($validated['name']);
        $company->is_public = $request->boolean('is_public', true);
        $company->status = 'pending'; // Set status to pending for admin approval
        $company->save();

        // Set session variable to indicate company was just created
        session(['company_created' => true]);

        return redirect()->route('employer.dashboard')
            ->with('success', 'Company profile created successfully. It is pending admin approval.');
    }
    
    public function edit()
    {
        $user = Auth::user();
        $company = $user->company;
        
        if (!$company) {
            return redirect()->route('employer.company.create')
                ->with('warning', 'Please create your company profile first.');
        }
        
        return view('employer.company.edit', compact('company'));
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
        $company = $user->company;
        
        if (!$company) {
            return redirect()->route('employer.company.create')
                ->with('warning', 'Please create your company profile first.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'industry' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:255',
            'founded_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'headquarters' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_links.linkedin' => 'nullable|url',
            'social_links.twitter' => 'nullable|url',
            'social_links.facebook' => 'nullable|url',
            'is_public' => 'boolean'
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_public'] = $request->boolean('is_public', true);
        
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('company-logos', 'public');
            $validated['logo'] = $path;
        }
        
        // Handle social links
        $socialLinks = $company->social_links ?? [
            'linkedin' => null,
            'twitter' => null,
            'facebook' => null,
        ];
        
        if (isset($validated['social_links'])) {
            $socialLinks = array_merge($socialLinks, $validated['social_links']);
            unset($validated['social_links']);
        }
        
        $validated['social_links'] = json_encode($socialLinks);
        
        $company->update($validated);
        
        return redirect()->route('employer.profile')
            ->with('success', 'Company profile updated successfully.');
    }

    public function destroy()
    {
        $user = Auth::user();
        $company = $user->company;
        
        if (!$company) {
            return redirect()->route('employer.dashboard')
                ->with('warning', 'No company profile found.');
        }
        
        $company->delete();
        
        return redirect()->route('employer.dashboard')
            ->with('success', 'Company profile deleted successfully.');
    }
}
