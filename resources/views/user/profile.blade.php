@extends('layouts.main')

@section('title', 'My Profile - Yummy Restaurant')

@section('content')
<style>
    .profile-page {
        padding: 80px 0;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .profile-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%);
        color: white;
        padding: 40px;
        border-radius: 15px 15px 0 0;
        text-align: center;
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    }
    
    .profile-avatar i {
        font-size: 3rem;
        color: #ce1212;
    }
    
    .profile-header h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .profile-header p {
        opacity: 0.9;
        margin: 0;
    }
    
    .profile-body {
        background: white;
        padding: 40px;
        border-radius: 0 0 15px 15px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 25px;
        color: #212529;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
    }
    
    .section-title i {
        color: #ce1212;
    }
    
    .form-section {
        margin-bottom: 40px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #212529;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #ce1212;
        box-shadow: 0 0 0 0.2rem rgba(206,18,18,0.15);
    }
    
    .btn-update {
        background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 3px 15px rgba(206,18,18,0.3);
    }
    
    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(206,18,18,0.4);
    }
    
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
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
</style>

<div class="profile-page">
    <div class="container profile-container">
        <div class="profile-header" data-aos="fade-down">
            <div class="profile-avatar">
                <i class="bi bi-person-circle"></i>
            </div>
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
        </div>
        
        <div class="profile-body" data-aos="fade-up">
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
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            
            <!-- Personal Information -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-person"></i>
                    Personal Information
                </div>
                
                <form action="{{ route('user.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city', $user->city) }}" placeholder="Your city">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control" rows="2" placeholder="Your complete address">{{ old('address', $user->address) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Pincode</label>
                                <input type="text" name="pincode" class="form-control" value="{{ old('pincode', $user->pincode) }}" placeholder="Pincode">
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-update">
                        <i class="bi bi-check-circle me-2"></i>Update Profile
                    </button>
                </form>
            </div>
            
            <!-- Change Password -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-lock"></i>
                    Change Password
                </div>
                
                <form action="{{ route('user.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-update">
                        <i class="bi bi-shield-check me-2"></i>Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
