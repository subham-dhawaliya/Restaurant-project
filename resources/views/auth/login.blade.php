@extends('layouts.auth')

@section('title', 'Admin Login - Yummy Restaurant')

@section('content')
<style>
    .login-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ce1212 0%, #8b0000 100%);
        position: relative;
        overflow: hidden;
        padding: 60px 0;
    }
    
    .login-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
    }
    
    .login-container {
        position: relative;
        z-index: 1;
    }
    
    .login-card {
        background: white;
        border-radius: 25px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        overflow: hidden;
        max-width: 450px;
        width: 100%;
    }
    
    .login-header {
        background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%);
        padding: 40px 30px;
        text-align: center;
        color: white;
    }
    
    .login-header .logo {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    }
    
    .login-header .logo i {
        font-size: 2.5rem;
        color: #ce1212;
    }
    
    .login-header h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .login-header p {
        margin: 0;
        opacity: 0.95;
        font-size: 0.95rem;
    }
    
    .login-body {
        padding: 40px 30px;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #212529;
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    .input-group {
        position: relative;
    }
    
    .input-group i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 1.1rem;
    }
    
    .form-control {
        width: 100%;
        padding: 15px 20px 15px 50px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #ce1212;
        box-shadow: 0 0 0 0.2rem rgba(206,18,18,0.15);
    }
    
    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        font-size: 0.9rem;
    }
    
    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
    
    .forgot-link {
        color: #ce1212;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .forgot-link:hover {
        color: #8b0000;
        text-decoration: underline;
    }
    
    .btn-login {
        width: 100%;
        background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 15px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(206,18,18,0.3);
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(206,18,18,0.4);
    }
    
    .btn-login:active {
        transform: translateY(0);
    }
    
    .divider {
        text-align: center;
        margin: 30px 0;
        position: relative;
    }
    
    .divider::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background: #e9ecef;
    }
    
    .divider span {
        background: white;
        padding: 0 15px;
        color: #6c757d;
        position: relative;
        font-size: 0.9rem;
    }
    
    .signup-link {
        text-align: center;
        margin-top: 25px;
        color: #6c757d;
        font-size: 0.95rem;
    }
    
    .signup-link a {
        color: #ce1212;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .signup-link a:hover {
        color: #8b0000;
        text-decoration: underline;
    }
    
    .alert {
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        border: none;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }
    
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }
    
    .first-user-notice {
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        color: #856404;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }
    
    .first-user-notice i {
        margin-right: 8px;
    }
</style>

<div class="login-section">
    <div class="login-container">
        <div class="login-card" data-aos="zoom-in">
            <div class="login-header">
                <div class="logo">
                    <i class="bi bi-person-circle"></i>
                </div>
                <h2>Welcome Back</h2>
                <p>Login to access your dashboard</p>
            </div>
            
            <div class="login-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                @if(\App\Models\User::count() === 0)
                    <div class="first-user-notice">
                        <i class="bi bi-info-circle"></i>
                        <strong>First Time Setup:</strong> Enter your email and password to create an admin account.
                    </div>
                @endif
                
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-group">
                            <i class="bi bi-envelope"></i>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-control" 
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <i class="bi bi-lock"></i>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-control" 
                                placeholder="Enter your password"
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="remember-forgot">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" id="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>
                    
                    <button type="submit" class="btn-login">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </button>
                </form>
                
                <div class="signup-link">
                    Don't have an account? <a href="#">Sign up</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection