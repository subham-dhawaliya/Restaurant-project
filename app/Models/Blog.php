<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category',
        'author',
        'is_active',
        'views',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Auto-generate slug from title
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }

    // Get active blogs
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Increment views
    public function incrementViews()
    {
        $this->increment('views');
    }
}
