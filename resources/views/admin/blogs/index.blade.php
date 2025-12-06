@extends('layouts.dashboard')

@section('title', 'Manage Blogs - Admin')

@section('content')
<style>
    .blogs-section { padding: 30px 0; }
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .btn-add { background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%); color: white; padding: 12px 25px; border-radius: 10px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; }
    .btn-add:hover { transform: translateY(-2px); box-shadow: 0 5px 20px rgba(206,18,18,0.4); color: white; }
    .blogs-table { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
    .blogs-table table { width: 100%; border-collapse: collapse; }
    .blogs-table th { background: #f8f9fa; padding: 15px; text-align: left; font-weight: 600; color: #212529; }
    .blogs-table td { padding: 15px; border-bottom: 1px solid #e9ecef; vertical-align: middle; }
    .blog-image { width: 80px; height: 50px; object-fit: cover; border-radius: 8px; }
    .blog-title { font-weight: 600; color: #212529; }
    .blog-excerpt { font-size: 0.85rem; color: #6c757d; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
    .status-active { background: #d4edda; color: #155724; }
    .status-inactive { background: #f8d7da; color: #721c24; }
    .action-btns { display: flex; gap: 8px; }
    .btn-edit, .btn-delete { padding: 8px 15px; border-radius: 6px; font-size: 0.85rem; text-decoration: none; transition: all 0.3s ease; }
    .btn-edit { background: #17a2b8; color: white; }
    .btn-delete { background: #dc3545; color: white; border: none; cursor: pointer; }
    .alert { padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; }
    .alert-success { background: #d4edda; color: #155724; border-left: 4px solid #28a745; }
</style>

<div class="blogs-section">
    <div class="container-fluid">
        <div class="page-header">
            <h2><i class="bi bi-newspaper me-2"></i>Manage Blogs</h2>
            <a href="{{ route('admin.blogs.create') }}" class="btn-add">
                <i class="bi bi-plus-circle me-2"></i>Add New Blog
            </a>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif
        
        <div class="blogs-table">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                    <tr>
                        <td>
                            @if($blog->image)
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="blog-image">
                            @else
                                <div style="width: 80px; height: 50px; background: #e9ecef; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-image" style="color: #6c757d;"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="blog-title">{{ $blog->title }}</div>
                            <div class="blog-excerpt">{{ $blog->excerpt }}</div>
                        </td>
                        <td>{{ $blog->category ?? '-' }}</td>
                        <td>{{ $blog->author }}</td>
                        <td>{{ $blog->views }}</td>
                        <td>
                            <span class="status-badge {{ $blog->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $blog->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $blog->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn-edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px;">
                            <i class="bi bi-newspaper" style="font-size: 3rem; color: #dee2e6;"></i>
                            <p style="margin-top: 15px; color: #6c757d;">No blog posts yet. Create your first blog!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
</div>
@endsection
