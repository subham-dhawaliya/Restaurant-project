@extends('layouts.dashboard')

@section('title', 'Gallery')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gallery Items</h2>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle me-2"></i>Add New Image
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                @forelse($gallerySections as $gallery)
                    <div class="col-md-4 col-lg-3">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top" alt="{{ $gallery->title }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title">{{ Str::limit($gallery->title, 30) }}</h6>
                                @if($gallery->category)
                                    <span class="badge bg-info mb-2">{{ $gallery->category }}</span>
                                @endif
                                <p class="card-text small text-muted">{{ Str::limit($gallery->description, 50) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge {{ $gallery->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $gallery->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <div>
                                        <a href="{{ route('admin.gallery.edit', $gallery) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-images" style="font-size: 4rem; color: #ccc;"></i>
                            <p class="text-muted mt-3 mb-0">No gallery items found. Add some images to get started!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
