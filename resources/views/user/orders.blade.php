@extends('layouts.main')

@section('title', 'My Orders - Yummy Restaurant')

@section('content')
<style>
    .orders-page {
        padding: 80px 0;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .page-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 10px;
    }
    
    .order-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    
    .order-card:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    
    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f8f9fa;
    }
    
    .order-number {
        font-size: 1.2rem;
        font-weight: 700;
        color: #ce1212;
    }
    
    .order-date {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .order-status {
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
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
    
    .status-out-for-delivery {
        background: #cce5ff;
        color: #004085;
    }
    
    .status-delivered {
        background: #d4edda;
        color: #155724;
    }
    
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }
    
    .order-items {
        margin-bottom: 15px;
    }
    
    .order-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f8f9fa;
    }
    
    .order-item:last-child {
        border-bottom: none;
    }
    
    .item-name {
        font-weight: 600;
    }
    
    .item-quantity {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .order-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 2px solid #f8f9fa;
    }
    
    .order-total {
        font-size: 1.3rem;
        font-weight: 700;
        color: #ce1212;
    }
    
    .btn-view-details {
        padding: 10px 25px;
        background: #ce1212;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .btn-view-details:hover {
        background: #a00e0e;
        color: white;
    }
    
    .empty-orders {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
    }
    
    .empty-orders i {
        font-size: 4rem;
        color: #ce1212;
        margin-bottom: 20px;
    }
    
    .empty-orders h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }
    
    .btn-order-now {
        padding: 12px 30px;
        background: #ce1212;
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        transition: all 0.3s ease;
    }
    
    .btn-order-now:hover {
        background: #a00e0e;
        color: white;
    }
</style>

<div class="orders-page">
    <div class="container">
        <div class="page-header">
            <h2><i class="bi bi-bag-check me-2"></i>My Orders</h2>
            <p class="text-muted">Track and manage your orders</p>
        </div>
        
        @if($orders->count() > 0)
            @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-number">{{ $order->order_number }}</div>
                        <div class="order-date">
                            <i class="bi bi-calendar me-1"></i>
                            {{ $order->created_at->format('d M Y, h:i A') }}
                        </div>
                    </div>
                    <span class="order-status status-{{ $order->status }}">
                        {{ ucfirst(str_replace('-', ' ', $order->status)) }}
                    </span>
                </div>
                
                <div class="order-items">
                    @foreach($order->orderItems as $item)
                    <div class="order-item">
                        <div>
                            <div class="item-name">{{ $item->item_name }}</div>
                            <div class="item-quantity">Quantity: {{ $item->quantity }}</div>
                            @if($item->customizations)
                            <div class="item-quantity">{{ $item->customizations }}</div>
                            @endif
                        </div>
                        <div class="item-price">₹{{ number_format($item->price * $item->quantity, 2) }}</div>
                    </div>
                    @endforeach
                </div>
                
                <div class="order-footer">
                    <div>
                        <div class="text-muted" style="font-size: 0.9rem;">Total Amount</div>
                        <div class="order-total">₹{{ number_format($order->total, 2) }}</div>
                    </div>
                    <a href="{{ route('user.order.details', $order->id) }}" class="btn-view-details">
                        <i class="bi bi-eye me-2"></i>View Details
                    </a>
                </div>
            </div>
            @endforeach
        @else
            <div class="empty-orders">
                <i class="bi bi-bag-x"></i>
                <h3>No Orders Yet</h3>
                <p class="text-muted">You haven't placed any orders yet. Start ordering now!</p>
                <a href="{{ url('/menu') }}" class="btn-order-now">
                    <i class="bi bi-cart-plus me-2"></i>Order Now
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
