<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::active()->orderBy('created_at', 'desc')->paginate(9);
        return view('blogs.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->active()->firstOrFail();
        $blog->incrementViews();
        
        $relatedBlogs = Blog::active()
            ->where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->limit(3)
            ->get();
            
        return view('blogs.show', compact('blog', 'relatedBlogs'));
    }
}
