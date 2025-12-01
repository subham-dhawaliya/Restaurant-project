@extends('layouts.dashboard')

@section('title', 'Menu Items')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Menu Items</h2>
        <a href="{{ route('admin.menu.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle me-2"></i>Add New Menu Item
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menuSections as $menu)
                            <tr>
                                <td>{{ $menu->id }}</td>
                                <td>
                                    @if($menu->image)
                                        <img src="{{ asset('storage/' . $menu->image) }}" alt="Menu" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ Str::limit($menu->description, 40) }}</td>
                                <td>₹{{ number_format($menu->price, 2) }}</td>
                                <td>
                                    <span class="badge {{ $menu->category == 'food' ? 'bg-info' : 'bg-warning' }}">
                                        {{ ucfirst($menu->category) }}
                                    </span>
                                </td>
                                <td>{{ $menu->order }}</td>
                                <td>
                                    <span class="badge {{ $menu->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $menu->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.menu.edit', $menu) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.menu.destroy', $menu) }}" method="POST" class="d-inline">
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
                                <td colspan="9" class="text-center py-4">
                                    <p class="text-muted mb-0">No menu items found. Create one to get started!</p>
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
