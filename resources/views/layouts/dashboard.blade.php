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
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        
        .sidebar.collapsed {
            transform: translateX(-260px);
        }
        
        .hamburger-btn {
            position: fixed;
            top: 20px;
            left: 20px;
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
            left: 20px;
        }
        
        .sidebar:not(.collapsed) ~ .hamburger-btn {
            left: 280px;
        }
        
        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-header .logo {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .sidebar-header .logo i {
            font-size: 2rem;
            color: #ce1212;
        }
        
        .sidebar-header h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
        }
        
        .sidebar-header p {
            font-size: 0.85rem;
            margin: 5px 0 0;
            opacity: 0.9;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            display: block;
            padding: 15px 25px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
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
        
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        
        .user-info {
            display: flex;
            align-items: center;
            padding: 15px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            margin-top: 15px;
        }
        
        .user-info .avatar {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }
        
        .user-info .avatar i {
            font-size: 1.5rem;
            color: #ce1212;
        }
        
        .user-info .details {
            flex: 1;
        }
        
        .user-info .details .name {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 2px;
        }
        
        .user-info .details .role {
            font-size: 0.8rem;
            opacity: 0.8;
        }
        
        .btn-logout {
            width: 100%;
            background: rgba(255,255,255,0.2);
            color: white;
            border: 2px solid rgba(255,255,255,0.3);
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-logout:hover {
            background: white;
            color: #ce1212;
            border-color: white;
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
                
                <a href="{{ url('/') }}" class="menu-item" target="_blank">
                    <i class="bi bi-house-door"></i>
                    <span>Home Page</span>
                </a>
                
                <a href="{{ route('admin.contacts') }}" class="menu-item {{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i>
                    <span>Messages</span>
                </a>
                
                <!-- <a href="#" class="menu-item">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a> -->
                
                <!-- <a href="#" class="menu-item">
                    <i class="bi bi-gear"></i>
                    <span>Settings</span>
                </a> -->
            </nav>
            
            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
                
                <div class="user-info">
                    <div class="avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="details">
                        <div class="name">Yummy</div>
                        <div class="role">{{ Auth::user()->is_admin ? 'Admin' : 'User' }}</div>
                    </div>
                </div>
            </div>
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
    </script>
    
    @yield('scripts')
</body>
</html>
