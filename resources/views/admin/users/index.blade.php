@extends('layouts.main')

@section('title', 'Users Management - Admin')

@section('content')
<style>
    .admin-header {
        background: linear-gradient(135deg, #212529 0%, #495057 100%);
        padding: 60px 0;
        color: white;
    }
    
    .admin-section {
        padding: 60px 0;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .stat-card h3 {
        font-size: 2rem;
        font-weight: 700;
        color: #ce1212;
        margin-bottom: 10px;
    }
    
    .stat-card p {
        color: #6c757d;
        margin: 0;
    }
    
    .users-table {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .table {
        margin: 0;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        color: #212529;
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ce1212;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }
    
    .action-btn {
        padding: 5px 12px;
        border-radius: 5px;
        font-size: 0.85rem;
    }
</style>

<div class="admin-header">
    <div class="container">
        <h1><i class="bi bi-people me-3"></i>Users Management</h1>
        <p class="mb-0">View and manage all registered customers</p>
    </div>
</div>

<section class="admin-section">
    <div class="container">
        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>{{ $stats['total_customers'] }}</h3>
                <p><i class="bi bi-people me-2"></i>Total Customers</p>
            </div>
            <div class="stat-card">
                <h3>{{ $stats['new_today'] }}</h3>
                <p><i class="bi bi-person-plus me-2"></i>New Today</p>
            </div>
            <div class="stat-card">
                <h3>{{ $stats['active_customers'] }}</h3>
                <p><i class="bi bi-person-check me-2"></i>Active Customers</p>
            </div>
        </div>
        
        <!-- Users Table -->
        <div class="users-table">
            <h4 class="mb-4">All Customers</h4>
            
            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Orders</th>
                                <th>Registered</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong>{{ $user->name }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $user->orders_count }} orders</span>
                                </td>
                                <td>
                                    {{ $user->created_at->format('M d, Y') }}<br>
                                    <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info action-btn">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-people" style="font-size: 4rem; color: #dee2e6;"></i>
                    <h3 class="mt-3 text-muted">No customers yet</h3>
                    <p class="text-muted">Registered customers will appear here</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
