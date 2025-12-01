<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutSectionController extends Controller
{
    public function index()
    {
        $aboutSections = AboutSection::latest()->get();
        return view('admin.about.index', compact('aboutSections'));
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'additional_text' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
            'is_active' => 'boolean'
        ]);

        // Filter out empty features
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features'], function($value) {
                return !empty($value);
            });
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('about-images', 'public');
        }

        AboutSection::create($validated);

        return redirect()->route('admin.about.index')->with('success', 'About section created successfully!');
    }

    public function edit(AboutSection $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, AboutSection $about)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'additional_text' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
            'is_active' => 'boolean'
        ]);

        // Filter out empty features
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features'], function($value) {
                return !empty($value);
            });
        }

        if ($request->hasFile('image')) {
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $validated['image'] = $request->file('image')->store('about-images', 'public');
        }

        $about->update($validated);

        return redirect()->route('admin.about.index')->with('success', 'About section updated successfully!');
    }

    public function destroy(AboutSection $about)
    {
        if ($about->image) {
            Storage::disk('public')->delete($about->image);
        }
        
        $about->delete();

        return redirect()->route('admin.about.index')->with('success', 'About section deleted successfully!');
    }
}
