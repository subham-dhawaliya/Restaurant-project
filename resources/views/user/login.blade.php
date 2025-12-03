@extends('layouts.main')

@section('title', 'Customer Login - Yummy Restaurant')

@section('content')
<style>
    .auth-page {
        padding: 80px 0;
        background: #f8f9fa;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .auth-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        max-width: 450px;
        margin: 0 auto;
    }
    
    .auth-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .auth-header h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 10px;
    }
    
    .auth-header p {
        color: #6c757d;
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
        padding: 12px 15px;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        font-size: 1rem;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #ce1212;
    }
    
    .btn-submit {
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
    
    .btn-submit:hover {
        background: #a00e0e;
    }
    
    .divider {
        text-align: center;
        margin: 25px 0;
        position: relative;
    }
    
    .divider::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background: #dee2e6;
    }
    
    .divider span {
        background: white;
        padding: 0 15px;
        position: relative;
        color: #6c757d;
    }
    
    .register-link {
        text-align: center;
        margin-top: 20px;
    }
    
    .register-link a {
        color: #ce1212;
        font-weight: 600;
        text-decoration: none;
    }
    
    .register-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="auth-page">
    <div class="container">
        <div class="auth-card">
            <div class="auth-header">
                <h2><i class="bi bi-person-circle me-2"></i>Customer Login</h2>
                <p>Login to place your order</p>
            </div>
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('user.login.submit') }}">
                @csrf
                
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <button type="submit" class="btn-submit">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </button>
            </form>
            
            <div class="divider">
                <span>OR</span>
            </div>
            
            <div class="register-link">
                Don't have an account? <a href="{{ route('user.register') }}">Register Now</a>
            </div>
        </div>
    </div>
</div>
@endsection
