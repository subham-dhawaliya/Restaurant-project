<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    private function checkAdmin()
    {
        if (!auth()->guard('admin')->check() || (auth()->guard('admin')->user()->role !== 'admin' && !auth()->guard('admin')->user()->is_admin)) {
            auth()->guard('admin')->logout();
            abort(redirect()->route('login')->with('error', 'Access denied. Admin login required.'));
        }
    }

    public function index()
    {
        $this->checkAdmin();
        
        $settings = SiteSetting::getSettings();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $this->checkAdmin();
        
        $validated = $request->validate([
            // Header
            'site_name' => 'required|string|max:255',
            'header_phone' => 'nullable|string|max:50',
            'header_email' => 'nullable|email|max:255',
            'book_table_link' => 'nullable|string|max:255',
            
            // Footer
            'footer_about' => 'nullable|string|max:500',
            'footer_address' => 'nullable|string|max:255',
            'footer_phone' => 'nullable|string|max:50',
            'footer_email' => 'nullable|email|max:255',
            'footer_timing' => 'nullable|string|max:255',
            
            // Social Links
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            
            // Copyright
            'copyright_text' => 'nullable|string|max:255',
            
            // Logo
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $settings = SiteSetting::getSettings();
        
        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = 'logo_' . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/settings'), $logoName);
            $validated['logo'] = 'uploads/settings/' . $logoName;
        }
        
        $settings->update($validated);
        
        return redirect()->back()->with('success', 'Site settings updated successfully!');
    }
}
