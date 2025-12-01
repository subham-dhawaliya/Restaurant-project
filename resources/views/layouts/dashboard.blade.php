<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard - Yummy Restaurant')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }
        
        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #ce1212 0%, #8b0000 100%);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        
        .sidebar.collapsed {
            transform: translateX(-260px);
        }
        
        .hamburger-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 1001;
            box-shadow: 0 5px 15px rgba(206,18,18,0.3);
            transition: all 0.3s ease;
            display: none;
        }
        
        .hamburger-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(206,18,18,0.4);
        }
        
        .sidebar.collapsed ~ .hamburger-btn {
            left: 15px;
        }
        
        .sidebar:not(.collapsed) ~ .hamburger-btn {
            left: 275px;
        }
        
        .sidebar-header {
            padding: 15px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            flex-shrink: 0;
        }
        
        .sidebar-header .logo {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        
        .sidebar-header .logo i {
            font-size: 1.5rem;
            color: #ce1212;
        }
        
        .sidebar-header h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
        }
        
        .sidebar-header p {
            font-size: 0.8rem;
            margin: 3px 0 0;
            opacity: 0.9;
        }
        
        .sidebar-menu {
            padding: 0;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }
        
        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.1);
        }
        
        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        
        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }
        
        .menu-item {
            display: block;
            padding: 15px 25px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            position: relative;
        }
        
        .menu-item:hover {
            background: rgba(255,255,255,0.1);
            border-left-color: white;
            color: white;
        }
        
        .menu-item.active {
            background: rgba(255,255,255,0.15);
            border-left-color: white;
        }
        
        .menu-item i {
            margin-right: 12px;
            font-size: 1.2rem;
            width: 25px;
            text-align: center;
        }
        
        .menu-item span {
            font-size: 1rem;
            font-weight: 500;
        }
        
        .menu-item-dropdown {
            cursor: pointer;
        }
        
        .menu-item-dropdown .dropdown-icon {
            float: right;
            transition: transform 0.3s ease;
            margin-left: auto;
        }
        
        .menu-item-dropdown.open .dropdown-icon {
            transform: rotate(180deg);
        }
        
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: rgba(0,0,0,0.2);
        }
        
        .submenu.show {
            max-height: 300px;
        }
        
        .submenu-item {
            display: block;
            padding: 12px 25px 12px 62px;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .submenu-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            padding-left: 65px;
        }
        

        
        .logout-item {
            width: 100%;
            background: transparent;
            border: none;
            cursor: pointer;
            text-align: left;
        }
        
        .logout-item:hover {
            background: rgba(255,255,255,0.1);
            border-left-color: white;
            color: white;
        }
        
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 30px;
            width: calc(100% - 260px);
        }
        
        @media (max-width: 992px) {
            .hamburger-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .sidebar {
                transform: translateX(-260px);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .sidebar.show ~ .hamburger-btn {
                left: 280px;
            }
            
            .sidebar:not(.show) ~ .hamburger-btn {
                left: 20px;
            }
        }
        
        @media (min-width: 993px) {
            .hamburger-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
    
    @yield('styles')

</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Hamburger Button -->
        <button class="hamburger-btn" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
        
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="bi bi-shop"></i>
                </div>
                <h3>Yummy</h3>
                <p>Restaurant Admin</p>
            </div>
            
            <nav class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
                
                <div class="menu-item menu-item-dropdown" id="homePageDropdown">
                    <i class="bi bi-house-door"></i>
                    <span>Home Page</span>
                    <i class="bi bi-chevron-down dropdown-icon"></i>
                </div>
                <div class="submenu" id="homePageSubmenu">
                    <a href="{{ route('admin.hero.index') }}" class="submenu-item">Hero Section</a>
                    <a href="{{ route('admin.about.index') }}" class="submenu-item">About Section</a>
                    <a href="{{ route('admin.gallery.index') }}" class="submenu-item">Gallery</a>
                    <a href="{{ route('admin.menu.index') }}" class="submenu-item">Menu</a>
                    <a href="{{ url('/contact') }}" class="submenu-item" target="_blank">Contact</a>
                </div>
                
                <a href="{{ route('admin.contacts') }}" class="menu-item {{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i>
                    <span>Messages</span>
                </a>
                
                <form action="{{ route('logout') }}" method="POST" style="margin-top: auto;">
                    @csrf
                    <button type="submit" class="menu-item logout-item">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
        
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        
        sidebarToggle.addEventListener('click', function() {
            if (window.innerWidth <= 992) {
                sidebar.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
            }
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 992) {
                if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
        
        // Home Page Dropdown Toggle
        const homePageDropdown = document.getElementById('homePageDropdown');
        const homePageSubmenu = document.getElementById('homePageSubmenu');
        
        homePageDropdown.addEventListener('click', function() {
            this.classList.toggle('open');
            homePageSubmenu.classList.toggle('show');
        });
    </script>
    
    @yield('scripts')
</body>
</html>
