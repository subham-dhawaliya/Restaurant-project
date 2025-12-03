@extends('layouts.main')

@section('title', 'Customer Registration - Yummy Restaurant')

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
        max-width: 500px;
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
    
    .login-link {
        text-align: center;
        margin-top: 20px;
    }
    
    .login-link a {
        color: #ce1212;
        font-weight: 600;
        text-decoration: none;
    }
    
    .login-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="auth-page">
    <div class="container">
        <div class="auth-card">
            <div class="auth-header">
                <h2><i class="bi bi-person-plus me-2"></i>Create Account</h2>
                <p>Register to place your order</p>
            </div>
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('user.register.submit') }}">
                @csrf
                
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your full name" required value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" class="form-control" placeholder="Enter your phone number" required value="{{ old('phone') }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Create a password (min 6 characters)" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                </div>
                
                <button type="submit" class="btn-submit">
                    <i class="bi bi-person-check me-2"></i>Register
                </button>
            </form>
            
            <div class="divider">
                <span>OR</span>
            </div>
            
            <div class="login-link">
                Already have an account? <a href="{{ route('user.login') }}">Login Now</a>
            </div>
        </div>
    </div>
</div>
@endsection
