@extends('layouts.main')

@section('title', 'Checkout - Yummy Restaurant')

@section('content')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
    .checkout-page {
        padding: 60px 0;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .checkout-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .checkout-section {
        background: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #212529;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #212529;
    }
    
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        font-size: 1rem;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #ce1212;
    }
    
    .order-item {
        display: flex;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .order-item:last-child {
        border-bottom: none;
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
        font-weight: 600;
        color: #ce1212;
    }
    
    .payment-method {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .payment-option {
        flex: 1;
        min-width: 150px;
        padding: 15px;
        border: 2px solid #dee2e6;
        border-radius: 10px;
        cursor: pointer;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .payment-option:hover {
        border-color: #ce1212;
    }
    
    .payment-option.selected {
        border-color: #ce1212;
        background: #fff5f5;
    }
    
    .payment-option input[type="radio"] {
        display: none;
    }
    
    .payment-option i {
        font-size: 2rem;
        color: #ce1212;
        margin-bottom: 10px;
    }
    
    .place-order-btn {
        width: 100%;
        padding: 15px;
        background: #ce1212;
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .place-order-btn:hover {
        background: #a00e0e;
    }
    
    .auth-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .auth-tab {
        flex: 1;
        padding: 12px;
        background: #f8f9fa;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .auth-tab.active {
        background: #ce1212;
        color: white;
    }
    
    .auth-form {
        display: none;
    }
    
    .auth-form.active {
        display: block;
    }
</style>

<div class="checkout-page">
    <div class="container checkout-container">
        <h2 class="mb-4"><i class="bi bi-credit-card me-2"></i>Checkout</h2>
        
        <div class="row">
            <div class="col-lg-8">
                @if(!Auth::guard('web')->check())
                <!-- Login/Register Section -->
                <div class="checkout-section">
                    <div class="section-title">
                        <i class="bi bi-person-circle"></i>
                        Account Information
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Please login or register to continue with your order
                    </div>
                    
                    <div class="d-flex gap-3">
                        <a href="{{ route('user.login') }}" class="btn btn-danger flex-fill">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </a>
                        <a href="{{ route('user.register') }}" class="btn btn-outline-danger flex-fill">
                            <i class="bi bi-person-plus me-2"></i>Register
                        </a>
                    </div>
                </div>
                @else
                <!-- User Info Section -->
                <div class="checkout-section">
                    <div class="section-title">
                        <i class="bi bi-person-check"></i>
                        Account Information
                    </div>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>
                        Logged in as <strong>{{ Auth::guard('web')->user()->name }}</strong> ({{ Auth::guard('web')->user()->email }})
                    </div>
                </div>
                @endif
                
                @if(Auth::guard('web')->check())
                <!-- Delivery Address -->
                <div class="checkout-section" id="deliverySection">
                    <div class="section-title">
                        <i class="bi bi-geo-alt"></i>
                        Delivery Address
                    </div>
                    <div class="form-group">
                        <label>Complete Address</label>
                        <textarea class="form-control" id="deliveryAddress" rows="3" placeholder="House no., Street, Area" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control" id="city" placeholder="City" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pincode</label>
                                <input type="text" class="form-control" id="pincode" placeholder="Pincode" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Method -->
                <div class="checkout-section" id="paymentSection">
                    <div class="section-title">
                        <i class="bi bi-credit-card"></i>
                        Payment Method
                    </div>
                    <div class="payment-method">
                        <label class="payment-option" onclick="selectPayment('cod')">
                            <input type="radio" name="payment" value="cod">
                            <i class="bi bi-cash"></i>
                            <div>Cash on Delivery</div>
                        </label>
                        <label class="payment-option" onclick="selectPayment('razorpay')">
                            <input type="radio" name="payment" value="razorpay">
                            <i class="bi bi-credit-card-2-front"></i>
                            <div>Razorpay (Card/UPI/Netbanking)</div>
                        </label>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="col-lg-4">
                <!-- Order Summary -->
                <div class="checkout-section" style="position: sticky; top: 100px;">
                    <div class="section-title">
                        <i class="bi bi-receipt"></i>
                        Order Summary
                    </div>
                    <div id="orderItems"></div>
                    <hr>
                    <div class="order-item">
                        <span>Subtotal</span>
                        <span id="checkoutSubtotal">₹0.00</span>
                    </div>
                    <div class="order-item">
                        <span>Delivery Fee</span>
                        <span id="checkoutDeliveryFee">₹40.00</span>
                    </div>
                    <div class="order-item">
                        <span>Tax (5%)</span>
                        <span id="checkoutTax">₹0.00</span>
                    </div>
                    <div class="order-item" style="font-size: 1.2rem; font-weight: 700; color: #ce1212;">
                        <span>Total</span>
                        <span id="checkoutTotal">₹0.00</span>
                    </div>
                    @if(Auth::guard('web')->check())
                    <button class="place-order-btn mt-3" id="placeOrderBtn" onclick="placeOrder()">
                        <i class="bi bi-check-circle me-2"></i>Place Order
                    </button>
                    @else
                    <div id="loginPrompt" class="text-center" style="padding: 20px; background: #fff3cd; border-radius: 10px; margin-top: 15px;">
                        <i class="bi bi-info-circle" style="font-size: 2rem; color: #856404;"></i>
                        <p style="margin: 10px 0 0; color: #856404; font-weight: 500;">Please login or register to place order</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedPaymentMethod = '';
    
    function selectPayment(method) {
        selectedPaymentMethod = method;
        document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('selected'));
        event.currentTarget.classList.add('selected');
    }
    
    function loadOrderSummary() {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const orderItemsContainer = document.getElementById('orderItems');
        
        if (cart.length === 0) {
            window.location.href = '/menu';
            return;
        }
        
        orderItemsContainer.innerHTML = cart.map(item => `
            <div class="order-item">
                <div class="item-details">
                    <div class="item-name">${item.name} x ${item.quantity}</div>
                    ${item.customizations ? `<div class="item-customizations">${item.customizations}</div>` : ''}
                </div>
                <div class="item-price">₹${(item.price * item.quantity).toFixed(2)}</div>
            </div>
        `).join('');
        
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const deliveryFee = 40;
        const tax = subtotal * 0.05;
        const total = subtotal + deliveryFee + tax;
        
        document.getElementById('checkoutSubtotal').textContent = '₹' + subtotal.toFixed(2);
        document.getElementById('checkoutDeliveryFee').textContent = '₹' + deliveryFee.toFixed(2);
        document.getElementById('checkoutTax').textContent = '₹' + tax.toFixed(2);
        document.getElementById('checkoutTotal').textContent = '₹' + total.toFixed(2);
    }
    
    async function placeOrder() {
        const address = document.getElementById('deliveryAddress').value;
        const city = document.getElementById('city').value;
        const pincode = document.getElementById('pincode').value;
        
        if (!address || !city || !pincode) {
            alert('Please fill in all delivery address fields');
            return;
        }
        
        if (!selectedPaymentMethod) {
            alert('Please select a payment method');
            return;
        }
        
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const deliveryFee = 40;
        const tax = subtotal * 0.05;
        const total = subtotal + deliveryFee + tax;
        
        const orderData = {
            items: cart,
            delivery_address: address,
            city: city,
            pincode: pincode,
            phone: '{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->phone : "" }}',
            payment_method: selectedPaymentMethod,
            subtotal: subtotal,
            delivery_fee: deliveryFee,
            tax: tax,
            total: total
        };
        
        // If Razorpay payment selected
        if (selectedPaymentMethod === 'razorpay') {
            try {
                // Create Razorpay order
                const response = await fetch('{{ route("razorpay.create") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        amount: total,
                        items: cart,
                        delivery_address: address,
                        city: city,
                        pincode: pincode,
                        phone: '{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->phone : "" }}'
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Open Razorpay checkout
                    const options = {
                        key: result.key,
                        amount: result.amount,
                        currency: result.currency,
                        name: 'Yummy Restaurant',
                        description: 'Order Payment',
                        order_id: result.order_id,
                        handler: async function (response) {
                            // Verify payment
                            const verifyResponse = await fetch('{{ route("razorpay.verify") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    razorpay_order_id: response.razorpay_order_id,
                                    razorpay_payment_id: response.razorpay_payment_id,
                                    razorpay_signature: response.razorpay_signature,
                                    order_data: orderData
                                })
                            });
                            
                            const verifyResult = await verifyResponse.json();
                            
                            if (verifyResult.success) {
                                localStorage.removeItem('cart');
                                alert('Payment successful! Order Number: ' + verifyResult.order_number);
                                window.location.href = '/my-orders';
                            } else {
                                alert('Payment verification failed: ' + verifyResult.message);
                            }
                        },
                        prefill: {
                            name: '{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->name : "" }}',
                            email: '{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->email : "" }}',
                            contact: '{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->phone : "" }}'
                        },
                        theme: {
                            color: '#ce1212'
                        }
                    };
                    
                    const rzp = new Razorpay(options);
                    rzp.open();
                } else {
                    alert('Error creating payment: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error processing payment. Please try again.');
            }
        } else {
            // COD payment
            try {
                const response = await fetch('{{ route("order.place") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(orderData)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    localStorage.removeItem('cart');
                    alert('Order placed successfully! Order Number: ' + result.order_number);
                    window.location.href = '/my-orders';
                } else {
                    alert('Error placing order: ' + (result.message || 'Please try again.'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error placing order. Please try again.');
            }
        }
    }
    
    document.addEventListener('DOMContentLoaded', loadOrderSummary);
</script>
@endsection
