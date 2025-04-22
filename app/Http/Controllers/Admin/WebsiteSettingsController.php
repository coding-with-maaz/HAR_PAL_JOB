<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class WebsiteSettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => config('app.name'),
            'site_description' => config('app.description'),
            'site_keywords' => config('app.keywords'),
            'site_logo' => config('app.logo'),
            'site_favicon' => config('app.favicon'),
            'contact_email' => config('app.contact_email'),
            'contact_phone' => config('app.contact_phone'),
            'address' => config('app.address'),
            'social_facebook' => config('app.social_facebook'),
            'social_twitter' => config('app.social_twitter'),
            'social_linkedin' => config('app.social_linkedin'),
            'social_instagram' => config('app.social_instagram'),
            'google_analytics_id' => config('app.google_analytics_id'),
            'meta_title' => config('app.meta_title'),
            'meta_description' => config('app.meta_description'),
            'meta_keywords' => config('app.meta_keywords'),
            'og_image' => config('app.og_image'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:500',
            'site_keywords' => 'required|string|max:500',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'site_favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'social_facebook' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'google_analytics_id' => 'nullable|string|max:50',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'meta_keywords' => 'required|string|max:500',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('site_logo')) {
            $logoPath = $request->file('site_logo')->store('public/settings');
            $validated['site_logo'] = str_replace('public/', '', $logoPath);
        }

        if ($request->hasFile('site_favicon')) {
            $faviconPath = $request->file('site_favicon')->store('public/settings');
            $validated['site_favicon'] = str_replace('public/', '', $faviconPath);
        }

        if ($request->hasFile('og_image')) {
            $ogImagePath = $request->file('og_image')->store('public/settings');
            $validated['og_image'] = str_replace('public/', '', $ogImagePath);
        }

        // Update config values
        $configPath = config_path('app.php');
        $config = File::get($configPath);
        
        foreach ($validated as $key => $value) {
            $config = preg_replace(
                "/'$key' => '.*'/",
                "'$key' => '$value'",
                $config
            );
        }

        File::put($configPath, $config);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Website settings updated successfully.');
    }
} 