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

      
      <a href="{{ url('/cart') }}" class="cart-icon-link" style="position: relative; margin-left: 20px; font-size: 1.5rem; color: var(--accent-color);">
        <i class="bi bi-cart3"></i>
        <span class="cart-badge" style="display: none; position: absolute; top: -8px; right: -8px; background: #ce1212; color: white; border-radius: 50%; width: 20px; height: 20px; font-size: 0.7rem; display: flex; align-items: center; justify-content: center; font-weight: 600;">0</span>
      </a>

      @if(Auth::guard('web')->check())
      <div class="user-profile-dropdown" style="position: relative; margin-left: 20px;">
        <button class="profile-btn" onclick="toggleProfileDropdown()" style="background: none; border: none; cursor: pointer; display: flex; align-items: center; gap: 8px; color: var(--accent-color); font-size: 1rem; font-weight: 600;">
          <i class="bi bi-person-circle" style="font-size: 1.8rem;"></i>
          <span>{{ Auth::guard('web')->user()->name }}</span>
          <i class="bi bi-chevron-down" style="font-size: 0.8rem;"></i>
        </button>
        
        <div class="profile-dropdown-menu" id="profileDropdown" style="display: none; position: absolute; top: 100%; right: 0; margin-top: 10px; background: white; border-radius: 12px; box-shadow: 0 5px 25px rgba(0,0,0,0.15); min-width: 220px; z-index: 1000; overflow: hidden;">
          <div style="padding: 15px; border-bottom: 1px solid #e9ecef; background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%); color: white;">
            <div style="font-weight: 600; font-size: 1rem;">{{ Auth::guard('web')->user()->name }}</div>
            <div style="font-size: 0.85rem; opacity: 0.9;">{{ Auth::guard('web')->user()->email }}</div>
          </div>
          
          <a href="{{ route('user.profile') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 15px; color: #212529; text-decoration: none; transition: all 0.3s ease;">
            <i class="bi bi-person" style="font-size: 1.2rem; color: #ce1212;"></i>
            <span>Profile</span>
          </a>
          
          <a href="{{ route('user.orders') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 15px; color: #212529; text-decoration: none; transition: all 0.3s ease;">
            <i class="bi bi-receipt" style="font-size: 1.2rem; color: #ce1212;"></i>
            <span>My Orders</span>
          </a>
          
          <form action="{{ route('user.logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" style="width: 100%; display: flex; align-items: center; gap: 12px; padding: 12px 15px; color: #dc3545; text-decoration: none; background: none; border: none; border-top: 1px solid #e9ecef; cursor: pointer; transition: all 0.3s ease; text-align: left;">
              <i class="bi bi-box-arrow-right" style="font-size: 1.2rem;"></i>
              <span>Logout</span>
            </button>
          </form>
        </div>
      </div>
      @else
      <a href="{{ route('user.login') }}" class="btn-login" style="margin-left: 20px; padding: 10px 20px; background: var(--accent-color); color: white; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
        <i class="bi bi-box-arrow-in-right me-1"></i>Login
      </a>
      @endif

    </div>
</header>

<style>
    .cart-icon-link {
        transition: all 0.3s ease;
    }
    
    .cart-icon-link:hover {
        transform: scale(1.1);
    }
    
    .profile-btn:hover {
        opacity: 0.8;
    }
    
    .profile-dropdown-menu a:hover,
    .profile-dropdown-menu button:hover {
        background: #f8f9fa;
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
    
    @keyframes dropdownSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .profile-dropdown-menu {
        animation: dropdownSlide 0.3s ease;
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
    
    // Profile dropdown toggle
    function toggleProfileDropdown() {
        const dropdown = document.getElementById('profileDropdown');
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profileDropdown');
        const profileBtn = document.querySelector('.profile-btn');
        
        if (dropdown && profileBtn && !profileBtn.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });
</script>
