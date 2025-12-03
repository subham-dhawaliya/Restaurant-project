@extends('layouts.main')

@section('title', 'Menu - Yummy Restaurant')
@section('body_class', 'menu-page')

@section('content')
<style>
    .menu-item {
        position: relative;
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    
    .menu-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .menu-item .menu-img {
        border-radius: 10px;
        height: 200px;
        object-fit: cover;
        width: 100%;
    }
    
    .menu-item h4 {
        margin-top: 15px;
        font-size: 1.2rem;
        font-weight: 600;
    }
    
    .menu-item .ingredients {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 10px 0;
        display: none;
    }
    
    .menu-item .ingredients.expanded {
        display: block;
    }
    
    .menu-item .price {
        font-size: 1.3rem;
        font-weight: 700;
        color: #ce1212;
        margin: 10px 0;
    }
    
    .menu-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }
    
    .btn-more-details {
        flex: 1;
        padding: 8px 15px;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        color: #495057;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }
    
    .btn-more-details:hover {
        background: #e9ecef;
    }
    
    .btn-add {
        flex: 1;
        padding: 8px 15px;
        background: #ce1212;
        border: none;
        border-radius: 8px;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .btn-add:hover {
        background: #a00e0e;
    }
    
    .customization-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.6);
        overflow-y: auto;
    }
    
    .modal-content-custom {
        background-color: white;
        margin: 3% auto;
        padding: 0;
        border-radius: 15px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        animation: slideDown 0.3s ease;
    }
    
    @keyframes slideDown {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .modal-header-custom {
        padding: 20px 25px;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .modal-header-custom h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 600;
    }
    
    .close-modal {
        font-size: 28px;
        font-weight: bold;
        color: #aaa;
        cursor: pointer;
        border: none;
        background: none;
    }
    
    .close-modal:hover {
        color: #ce1212;
    }
    
    .modal-body-custom {
        padding: 25px;
        max-height: 60vh;
        overflow-y: auto;
    }
    
    .modal-item-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    
    .customization-section {
        margin-bottom: 25px;
    }
    
    .customization-section h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #212529;
    }
    
    .customization-option {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .customization-option:hover {
        background: #f8f9fa;
        border-color: #ce1212;
    }
    
    .customization-option input[type="checkbox"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }
    
    .option-info {
        flex: 1;
        margin: 0 15px;
    }
    
    .option-name {
        font-weight: 500;
        color: #212529;
    }
    
    .option-price {
        color: #ce1212;
        font-weight: 600;
    }
    
    .modal-footer-custom {
        padding: 20px 25px;
        border-top: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .total-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: #212529;
    }
    
    .btn-add-to-cart {
        padding: 12px 30px;
        background: #ce1212;
        border: none;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-add-to-cart:hover {
        background: #a00e0e;
    }
</style>
<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Our Menu</h1>
                    <p class="mb-0">Discover our delicious menu items</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="current">Menu</li>
            </ol>
        </div>
    </nav>
</div>

<!-- Menu Section -->
<section id="menu" class="menu section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Our Menu</h2>
        <p><span>Check Our</span> <span class="description-title">Yummy Menu</span></p>
    </div><!-- End Section Title -->

    <div class="container">
        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-all">
                    <h4>All</h4>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-food">
                    <h4>Food</h4>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-beverages">
                    <h4>Beverages</h4>
                </a>
            </li>
        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
            <div class="tab-pane fade active show" id="menu-all">
                <div class="tab-header text-center">
                    <p>Menu</p>
                    <h3>All Items</h3>
                </div>

                <div class="row gy-5">
                    @forelse($menuItems as $item)
                    <div class="col-lg-4">
                        <div class="menu-item">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/menu/menu-item-1.png') }}" class="menu-img" alt="{{ $item->name }}">
                            <h4>{{ $item->name }}</h4>
                            <p class="price">
                                ₹{{ number_format($item->price, 2) }}
                            </p>
                            <p class="ingredients" id="desc-all-{{ $item->id }}">
                                {{ $item->description }}
                            </p>
                            <div class="menu-actions">
                                <button class="btn-more-details" onclick="toggleDescription('all-{{ $item->id }}')">
                                    <i class="bi bi-info-circle me-1"></i>More Details
                                </button>
                                <button class="btn-add" onclick="openCustomizationModal({{ $item->id }}, '{{ $item->name }}', {{ $item->price }}, '{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/menu/menu-item-1.png') }}', '{{ addslashes($item->description) }}')">
                                    <i class="bi bi-plus-circle me-1"></i>ADD
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No menu items available at the moment.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="tab-pane fade" id="menu-food">
                <div class="tab-header text-center">
                    <p>Menu</p>
                    <h3>Food</h3>
                </div>

                <div class="row gy-5">
                    @forelse($menuItems->where('category', 'food') as $item)
                    <div class="col-lg-4">
                        <div class="menu-item">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/menu/menu-item-1.png') }}" class="menu-img" alt="{{ $item->name }}">
                            <h4>{{ $item->name }}</h4>
                            <p class="price">
                                ₹{{ number_format($item->price, 2) }}
                            </p>
                            <p class="ingredients" id="desc-food-{{ $item->id }}">
                                {{ $item->description }}
                            </p>
                            <div class="menu-actions">
                                <button class="btn-more-details" onclick="toggleDescription('food-{{ $item->id }}')">
                                    <i class="bi bi-info-circle me-1"></i>More Details
                                </button>
                                <button class="btn-add" onclick="openCustomizationModal({{ $item->id }}, '{{ $item->name }}', {{ $item->price }}, '{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/menu/menu-item-1.png') }}', '{{ addslashes($item->description) }}')">
                                    <i class="bi bi-plus-circle me-1"></i>ADD
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No food items available.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="tab-pane fade" id="menu-beverages">
                <div class="tab-header text-center">
                    <p>Menu</p>
                    <h3>Beverages</h3>
                </div>

                <div class="row gy-5">
                    @forelse($menuItems->where('category', 'beverages') as $item)
                    <div class="col-lg-4">
                        <div class="menu-item">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/menu/menu-item-1.png') }}" class="menu-img" alt="{{ $item->name }}">
                            <h4>{{ $item->name }}</h4>
                            <p class="price">
                                ₹{{ number_format($item->price, 2) }}
                            </p>
                            <p class="ingredients" id="desc-bev-{{ $item->id }}">
                                {{ $item->description }}
                            </p>
                            <div class="menu-actions">
                                <button class="btn-more-details" onclick="toggleDescription('bev-{{ $item->id }}')">
                                    <i class="bi bi-info-circle me-1"></i>More Details
                                </button>
                                <button class="btn-add" onclick="openCustomizationModal({{ $item->id }}, '{{ $item->name }}', {{ $item->price }}, '{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/menu/menu-item-1.png') }}', '{{ addslashes($item->description) }}')">
                                    <i class="bi bi-plus-circle me-1"></i>ADD
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No beverages available.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Customization Modal -->
<div id="customizationModal" class="customization-modal">
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h3 id="modalItemName">Customize your item</h3>
            <button class="close-modal" onclick="closeCustomizationModal()">&times;</button>
        </div>
        <div class="modal-body-custom">
            <img id="modalItemImage" src="" alt="" class="modal-item-image">
            <p id="modalItemDescription" style="color: #6c757d; margin-bottom: 20px;"></p>
            
            <div class="customization-section">
                <h4>Add Extra Toppings</h4>
                <div class="customization-option" onclick="toggleCheckbox('extra-cheese')">
                    <input type="checkbox" id="extra-cheese" data-price="20">
                    <div class="option-info">
                        <div class="option-name">Extra Cheese</div>
                    </div>
                    <div class="option-price">+ ₹20</div>
                </div>
                <div class="customization-option" onclick="toggleCheckbox('extra-sauce')">
                    <input type="checkbox" id="extra-sauce" data-price="15">
                    <div class="option-info">
                        <div class="option-name">Extra Sauce</div>
                    </div>
                    <div class="option-price">+ ₹15</div>
                </div>
                <div class="customization-option" onclick="toggleCheckbox('extra-veggies')">
                    <input type="checkbox" id="extra-veggies" data-price="25">
                    <div class="option-info">
                        <div class="option-name">Extra Vegetables</div>
                    </div>
                    <div class="option-price">+ ₹25</div>
                </div>
            </div>
            
            <div class="customization-section">
                <h4>Make it a Combo (0/3)</h4>
                <div class="customization-option" onclick="toggleCheckbox('combo-fries')">
                    <input type="checkbox" id="combo-fries" data-price="50" class="combo-option">
                    <div class="option-info">
                        <div class="option-name">Fries + Coke (Save Rs. 20)</div>
                    </div>
                    <div class="option-price">+ ₹50</div>
                </div>
                <div class="customization-option" onclick="toggleCheckbox('combo-drink')">
                    <input type="checkbox" id="combo-drink" data-price="30" class="combo-option">
                    <div class="option-info">
                        <div class="option-name">Soft Drink</div>
                    </div>
                    <div class="option-price">+ ₹30</div>
                </div>
                <div class="customization-option" onclick="toggleCheckbox('combo-dessert')">
                    <input type="checkbox" id="combo-dessert" data-price="40" class="combo-option">
                    <div class="option-info">
                        <div class="option-name">Ice Cream</div>
                    </div>
                    <div class="option-price">+ ₹40</div>
                </div>
            </div>
        </div>
        <div class="modal-footer-custom">
            <div class="total-price">
                <span id="totalPrice">₹0</span>
            </div>
            <button class="btn-add-to-cart" onclick="addToCart()">
                <i class="bi bi-cart-plus me-2"></i>Add item to cart
            </button>
        </div>
    </div>
</div>

<script>
    let basePrice = 0;
    let currentItemId = null;
    
    function toggleDescription(itemId) {
        const descElement = document.getElementById('desc-' + itemId);
        const button = event.target.closest('.btn-more-details');
        
        if (descElement.classList.contains('expanded')) {
            descElement.classList.remove('expanded');
            button.innerHTML = '<i class="bi bi-info-circle me-1"></i>More Details';
        } else {
            descElement.classList.add('expanded');
            button.innerHTML = '<i class="bi bi-info-circle me-1"></i>Less Details';
        }
    }
    
    function openCustomizationModal(itemId, itemName, price, image, description) {
        currentItemId = itemId;
        basePrice = price;
        
        document.getElementById('modalItemName').textContent = itemName;
        document.getElementById('modalItemImage').src = image;
        document.getElementById('modalItemDescription').textContent = description;
        
        // Reset all checkboxes
        document.querySelectorAll('.customization-option input[type="checkbox"]').forEach(cb => {
            cb.checked = false;
        });
        
        updateTotalPrice();
        document.getElementById('customizationModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
    
    function closeCustomizationModal() {
        document.getElementById('customizationModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    function toggleCheckbox(checkboxId) {
        const checkbox = document.getElementById(checkboxId);
        checkbox.checked = !checkbox.checked;
        updateTotalPrice();
    }
    
    function updateTotalPrice() {
        let total = basePrice;
        document.querySelectorAll('.customization-option input[type="checkbox"]:checked').forEach(cb => {
            total += parseFloat(cb.dataset.price);
        });
        document.getElementById('totalPrice').textContent = '₹' + total.toFixed(2);
    }
    
    function addToCart() {
        const selectedOptions = [];
        let customizationText = '';
        let totalPrice = basePrice;
        
        document.querySelectorAll('.customization-option input[type="checkbox"]:checked').forEach(cb => {
            const optionName = cb.parentElement.parentElement.querySelector('.option-name').textContent;
            selectedOptions.push(optionName);
            totalPrice += parseFloat(cb.dataset.price);
        });
        
        if (selectedOptions.length > 0) {
            customizationText = selectedOptions.join(', ');
        }
        
        // Get cart from localStorage
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        // Add item to cart
        const cartItem = {
            id: currentItemId,
            name: document.getElementById('modalItemName').textContent,
            price: totalPrice,
            quantity: 1,
            image: document.getElementById('modalItemImage').src,
            customizations: customizationText
        };
        
        // Check if item already exists
        const existingIndex = cart.findIndex(item => 
            item.id === cartItem.id && item.customizations === cartItem.customizations
        );
        
        if (existingIndex > -1) {
            cart[existingIndex].quantity += 1;
        } else {
            cart.push(cartItem);
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Show success message
        showNotification('Item added to cart!');
        updateCartCount();
        closeCustomizationModal();
    }
    
    function showNotification(message) {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            z-index: 10000;
            animation: slideIn 0.3s ease;
        `;
        notification.innerHTML = `<i class="bi bi-check-circle me-2"></i>${message}`;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 2000);
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
    
    // Update cart count on page load
    document.addEventListener('DOMContentLoaded', updateCartCount);
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('customizationModal');
        if (event.target == modal) {
            closeCustomizationModal();
        }
    }
</script>
@endsection
