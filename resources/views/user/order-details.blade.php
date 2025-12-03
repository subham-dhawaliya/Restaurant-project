@extends('layouts.main')

@section('title', 'Order Details - Yummy Restaurant')

@section('content')
<style>
    .order-details-page {
        padding: 80px 0;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #ce1212;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .back-btn:hover {
        color: #a00e0e;
    }
    
    .details-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .order-header {
        text-align: center;
        padding-bottom: 25px;
        border-bottom: 2px solid #f8f9fa;
        margin-bottom: 25px;
    }
    
    .order-number {
        font-size: 2rem;
        font-weight: 700;
        color: #ce1212;
        margin-bottom: 10px;
    }
    
    .order-date {
        color: #6c757d;
    }
    
    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #212529;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f8f9fa;
    }
    
    .info-label {
        color: #6c757d;
        font-weight: 500;
    }
    
    .info-value {
        font-weight: 600;
        text-align: right;
    }
    
    .order-status {
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 600;
        display: inline-block;
        margin-top: 10px;
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
    
    .order-item {
        display: flex;
        justify-content: space-between;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 10px;
    }
    
    .item-details {
        flex: 1;
    }
    
    .item-name {
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .item-customizations {
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .item-price {
        font-weight: 700;
        color: #ce1212;
        font-size: 1.1rem;
    }
    
    .total-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-top: 20px;
    }
    
    .total-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
    }
    
    .grand-total {
        font-size: 1.5rem;
        font-weight: 700;
        color: #ce1212;
        padding-top: 15px;
        border-top: 2px solid #dee2e6;
        margin-top: 10px;
    }
</style>

<div class="order-details-page">
    <div class="container">
        <a href="{{ route('user.orders') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back to Orders
        </a>
        
        <div class="details-card">
            <div class="order-header">
                <div class="order-number">{{ $order->order_number }}</div>
                <div class="order-date">
                    <i class="bi bi-calendar me-2"></i>
                    {{ $order->created_at->format('d M Y, h:i A') }}
                </div>
                <span class="order-status status-{{ $order->status }}">
                    {{ ucfirst(str_replace('-', ' ', $order->status)) }}
                </span>
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title">
                        <i class="bi bi-bag"></i>
                        Order Items
                    </div>
                    
                    @foreach($order->orderItems as $item)
                    <div class="order-item">
                        <div class="item-details">
                            <div class="item-name">{{ $item->item_name }}</div>
                            <div class="item-customizations">Quantity: {{ $item->quantity }}</div>
                            @if($item->customizations)
                            <div class="item-customizations">{{ $item->customizations }}</div>
                            @endif
                        </div>
                        <div class="item-price">₹{{ number_format($item->price * $item->quantity, 2) }}</div>
                    </div>
                    @endforeach
                    
                    <div class="total-section">
                        <div class="total-row">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="total-row">
                            <span>Delivery Fee</span>
                            <span>₹{{ number_format($order->delivery_fee, 2) }}</span>
                        </div>
                        <div class="total-row">
                            <span>Tax</span>
                            <span>₹{{ number_format($order->tax, 2) }}</span>
                        </div>
                        <div class="total-row grand-total">
                            <span>Total</span>
                            <span>₹{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="section-title">
                        <i class="bi bi-info-circle"></i>
                        Order Information
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Payment Method</span>
                        <span class="info-value">{{ strtoupper($order->payment_method) }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Payment Status</span>
                        <span class="info-value">{{ ucfirst($order->payment_status) }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Phone</span>
                        <span class="info-value">{{ $order->phone }}</span>
                    </div>
                    
                    <div class="section-title mt-4">
                        <i class="bi bi-geo-alt"></i>
                        Delivery Address
                    </div>
                    
                    <p style="line-height: 1.6;">{{ $order->delivery_address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
