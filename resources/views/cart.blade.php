@extends('layouts.main')

@section('title', 'Shopping Cart - Yummy Restaurant')

@section('content')
<style>
    .cart-page {
        padding: 60px 0;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .cart-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .cart-header {
        background: white;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .cart-item {
        background: white;
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        display: flex;
        align-items: center;
        gap: 20px;
    }
    
    .cart-item-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
    }
    
    .cart-item-details {
        flex: 1;
    }
    
    .cart-item-name {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .cart-item-price {
        color: #ce1212;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .qty-btn {
        width: 35px;
        height: 35px;
        border: 1px solid #dee2e6;
        background: white;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .qty-btn:hover {
        background: #ce1212;
        color: white;
        border-color: #ce1212;
    }
    
    .qty-display {
        font-weight: 600;
        min-width: 30px;
        text-align: center;
    }
    
    .remove-btn {
        color: #dc3545;
        cursor: pointer;
        font-size: 1.5rem;
    }
    
    .cart-summary {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        position: sticky;
        top: 100px;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .summary-row.total {
        border-bottom: none;
        font-size: 1.3rem;
        font-weight: 700;
        color: #ce1212;
    }
    
    .checkout-btn {
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
    
    .checkout-btn:hover {
        background: #a00e0e;
    }
    
    .empty-cart {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
    }
    
    .empty-cart i {
        font-size: 5rem;
        color: #dee2e6;
        margin-bottom: 20px;
    }
</style>

<div class="cart-page">
    <div class="container cart-container">
        <div class="cart-header">
            <h2><i class="bi bi-cart3 me-2"></i>Your Cart</h2>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <div id="cartItems">
                    <!-- Cart items will be loaded here -->
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="cart-summary">
                    <h4 class="mb-4">Order Summary</h4>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="subtotal">₹0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Delivery Fee</span>
                        <span id="deliveryFee">₹40.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (5%)</span>
                        <span id="tax">₹0.00</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="total">₹0.00</span>
                    </div>
                    <button class="checkout-btn" onclick="proceedToCheckout()">
                        <i class="bi bi-credit-card me-2"></i>Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function loadCart() {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const cartItemsContainer = document.getElementById('cartItems');
        
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="empty-cart">
                    <i class="bi bi-cart-x"></i>
                    <h3>Your cart is empty</h3>
                    <p class="text-muted">Add some delicious items to get started!</p>
                    <a href="/menu" class="btn btn-danger mt-3">Browse Menu</a>
                </div>
            `;
            updateSummary();
            return;
        }
        
        cartItemsContainer.innerHTML = cart.map((item, index) => `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                <div class="cart-item-details">
                    <div class="cart-item-name">${item.name}</div>
                    <div class="cart-item-price">₹${item.price.toFixed(2)}</div>
                    ${item.customizations ? `<small class="text-muted">${item.customizations}</small>` : ''}
                </div>
                <div class="quantity-controls">
                    <button class="qty-btn" onclick="updateQuantity(${index}, -1)">-</button>
                    <span class="qty-display">${item.quantity}</span>
                    <button class="qty-btn" onclick="updateQuantity(${index}, 1)">+</button>
                </div>
                <i class="bi bi-trash remove-btn" onclick="removeItem(${index})"></i>
            </div>
        `).join('');
        
        updateSummary();
    }
    
    function updateQuantity(index, change) {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        cart[index].quantity += change;
        
        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        loadCart();
        updateCartCount();
    }
    
    function removeItem(index) {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        loadCart();
        updateCartCount();
    }
    
    function updateSummary() {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const deliveryFee = subtotal > 0 ? 40 : 0;
        const tax = subtotal * 0.05;
        const total = subtotal + deliveryFee + tax;
        
        document.getElementById('subtotal').textContent = '₹' + subtotal.toFixed(2);
        document.getElementById('deliveryFee').textContent = '₹' + deliveryFee.toFixed(2);
        document.getElementById('tax').textContent = '₹' + tax.toFixed(2);
        document.getElementById('total').textContent = '₹' + total.toFixed(2);
    }
    
    function proceedToCheckout() {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        if (cart.length === 0) {
            alert('Your cart is empty!');
            return;
        }
        window.location.href = '/checkout';
    }
    
    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);
        const badge = document.querySelector('.cart-badge');
        if (badge) {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'block' : 'none';
        }
    }
    
    // Load cart on page load
    document.addEventListener('DOMContentLoaded', loadCart);
</script>
@endsection
