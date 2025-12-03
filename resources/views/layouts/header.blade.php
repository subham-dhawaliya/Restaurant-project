<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename">Yummy</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
           <li><a href="{{ url('/home') }}" class="{{ Request::is('home') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{ url('/about') }}" class="{{ Request::is('about') ? 'active' : '' }}">About</a></li>
          <li><a href="{{ url('/menu') }}" class="{{ Request::is('menu') ? 'active' : '' }}">Menu</a></li>
          <li><a href="{{ url('/gallery') }}" class="{{ Request::is('gallery') ? 'active' : '' }}">Gallery</a></li>
          <li><a href="{{ url('/contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="#book-a-table">Book a Table</a>
      
      <a href="{{ url('/cart') }}" class="cart-icon-link" style="position: relative; margin-left: 20px; font-size: 1.5rem; color: var(--accent-color);">
        <i class="bi bi-cart3"></i>
        <span class="cart-badge" style="display: none; position: absolute; top: -8px; right: -8px; background: #ce1212; color: white; border-radius: 50%; width: 20px; height: 20px; font-size: 0.7rem; display: flex; align-items: center; justify-content: center; font-weight: 600;">0</span>
      </a>

    </div>
</header>

<style>
    .cart-icon-link {
        transition: all 0.3s ease;
    }
    
    .cart-icon-link:hover {
        transform: scale(1.1);
    }
    
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
</style>

<script>
    // Update cart count on all pages
    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);
        const badge = document.querySelector('.cart-badge');
        if (badge) {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';
        }
    }
    
    document.addEventListener('DOMContentLoaded', updateCartCount);
</script>
