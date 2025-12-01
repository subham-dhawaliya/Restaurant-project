@extends('layouts.dashboard')

@section('title', 'Hero Sections')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Hero Sections</h2>
        <a href="{{ route('admin.hero.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle me-2"></i>Add New Hero Section
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
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($heroSections as $hero)
                            <tr>
                                <td>{{ $hero->id }}</td>
                                <td>{{ Str::limit($hero->title, 30) }}</td>
                                <td>{{ Str::limit($hero->description, 50) }}</td>
                                <td>
                                    @if($hero->image)
                                        <img src="{{ asset('storage/' . $hero->image) }}" alt="Hero" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $hero->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $hero->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.hero.edit', $hero) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.hero.destroy', $hero) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <p class="text-muted mb-0">No hero sections found. Create one to get started!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
