@extends('layouts.main')

@section('title', 'Orders Management - Admin')

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
    
    .orders-table {
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
    
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .status-confirmed {
        background: #d1ecf1;
        color: #0c5460;
    }
    
    .status-preparing {
        background: #d4edda;
        color: #155724;
    }
    
    .status-delivered {
        background: #d4edda;
        color: #155724;
    }
    
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }
    
    .action-btn {
        padding: 5px 12px;
        border-radius: 5px;
        font-size: 0.85rem;
        margin: 0 2px;
    }
</style>

<div class="admin-header">
    <div class="container">
        <h1><i class="bi bi-receipt me-3"></i>Orders Management</h1>
        <p class="mb-0">View and manage all customer orders</p>
    </div>
</div>

<section class="admin-section">
    <div class="container">
        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>{{ $stats['total_orders'] }}</h3>
                <p><i class="bi bi-receipt me-2"></i>Total Orders</p>
            </div>
            <div class="stat-card">
                <h3>{{ $stats['pending_orders'] }}</h3>
                <p><i class="bi bi-clock me-2"></i>Pending Orders</p>
            </div>
            <div class="stat-card">
                <h3>{{ $stats['completed_orders'] }}</h3>
                <p><i class="bi bi-check-circle me-2"></i>Completed</p>
            </div>
            <div class="stat-card">
                <h3>₹{{ number_format($stats['total_revenue'], 2) }}</h3>
                <p><i class="bi bi-currency-rupee me-2"></i>Total Revenue</p>
            </div>
        </div>
        
        <!-- Orders Table -->
        <div class="orders-table">
            <h4 class="mb-4">All Orders</h4>
            
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td><strong>{{ $order->order_number }}</strong></td>
                                <td>
                                    {{ $order->user ? $order->user->name : 'Guest' }}<br>
                                    <small class="text-muted">{{ $order->phone }}</small>
                                </td>
                                <td>{{ $order->orderItems->count() }} items</td>
                                <td><strong>₹{{ number_format($order->total, 2) }}</strong></td>
                                <td>
                                    <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span><br>
                                    <small class="text-muted">{{ ucfirst($order->payment_method) }}</small>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}<br>
                                    <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info action-btn">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 4rem; color: #dee2e6;"></i>
                    <h3 class="mt-3 text-muted">No orders yet</h3>
                    <p class="text-muted">Orders will appear here when customers place them</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
