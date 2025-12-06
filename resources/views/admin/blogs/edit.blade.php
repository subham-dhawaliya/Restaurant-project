@extends('layouts.dashboard')

@section('title', 'Edit Blog - Admin')

@section('content')
<style>
    .blog-form-section { padding: 30px 0; }
    .back-btn { display: inline-flex; align-items: center; gap: 8px; color: #ce1212; text-decoration: none; font-weight: 600; margin-bottom: 20px; }
    .form-card { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #212529; }
    .form-control { width: 100%; padding: 12px 15px; border: 2px solid #e9ecef; border-radius: 8px; font-size: 1rem; }
    .form-control:focus { outline: none; border-color: #ce1212; }
    .btn-save { background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%); color: white; border: none; padding: 15px 40px; border-radius: 10px; font-weight: 600; cursor: pointer; }
    .form-check { display: flex; align-items: center; gap: 10px; }
    .form-check input { width: 20px; height: 20px; }
    .current-image { max-width: 200px; border-radius: 8px; margin-bottom: 10px; }
</style>

<div class="blog-form-section">
    <div class="container-fluid">
        <a href="{{ route('admin.blogs.index') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i> Back to Blogs
        </a>
        
        <div class="form-card">
            <h3 class="mb-4"><i class="bi bi-pencil me-2"></i>Edit Blog Post</h3>
            
            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Title *</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control" value="{{ old('category', $blog->category) }}">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Short Excerpt</label>
                    <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $blog->excerpt) }}</textarea>
                </div>
                
                <div class="form-group">
                    <label>Content *</label>
                    <textarea name="content" class="form-control" rows="10" required>{{ old('content', $blog->content) }}</textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Author</label>
                            <input type="text" name="author" class="form-control" value="{{ old('author', $blog->author) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Featured Image</label>
                            @if($blog->image)
                                <div><img src="{{ asset($blog->image) }}" alt="Current Image" class="current-image"></div>
                            @endif
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Leave empty to keep current image</small>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" {{ $blog->is_active ? 'checked' : '' }}>
                        <span>Published</span>
                    </label>
                </div>
                
                <button type="submit" class="btn-save">
                    <i class="bi bi-check-circle me-2"></i>Update Blog Post
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
