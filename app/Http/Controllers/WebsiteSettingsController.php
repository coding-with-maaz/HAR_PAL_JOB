<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebsiteSettingsController extends Controller
{
    public function index()
    {
        $settings = WebsiteSetting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'logo' => 'nullable|file|max:2048',
            'favicon' => 'nullable|file|max:1024',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'google_analytics_id' => 'nullable|string|max:50',
            'google_verification_code' => 'nullable|string|max:100',
            'bing_verification_code' => 'nullable|string|max:100',
            'og_image' => 'nullable|file|max:2048',
            'twitter_card_image' => 'nullable|file|max:2048',
        ]);

        $settings = WebsiteSetting::firstOrNew();
        
        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = 'logo_' . time() . '.' . $extension;
            $file->move(public_path('uploads/website'), $filename);
            $validated['logo'] = 'uploads/website/' . $filename;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $extension = $file->getClientOriginalExtension();
            $filename = 'favicon_' . time() . '.' . $extension;
            $file->move(public_path('uploads/website'), $filename);
            $validated['favicon'] = 'uploads/website/' . $filename;
        }

        // Handle OG image upload
        if ($request->hasFile('og_image')) {
            $file = $request->file('og_image');
            $extension = $file->getClientOriginalExtension();
            $filename = 'og_' . time() . '.' . $extension;
            $file->move(public_path('uploads/website'), $filename);
            $validated['og_image'] = 'uploads/website/' . $filename;
        }

        // Handle Twitter card image upload
        if ($request->hasFile('twitter_card_image')) {
            $file = $request->file('twitter_card_image');
            $extension = $file->getClientOriginalExtension();
            $filename = 'twitter_' . time() . '.' . $extension;
            $file->move(public_path('uploads/website'), $filename);
            $validated['twitter_card_image'] = 'uploads/website/' . $filename;
        }

        $settings->fill($validated);
        $settings->save();

        // Clear settings cache
        Cache::forget('website_settings');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Website settings updated successfully.');
    }
} 