@extends('layouts.dashboard')

@section('title', 'Site Settings - Admin')

@section('content')
<style>
    .settings-section {
        padding: 30px 0;
    }
    
    .settings-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f8f9fa;
    }
    
    .section-header i {
        font-size: 1.5rem;
        color: #ce1212;
    }
    
    .section-header h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 600;
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
    
    .btn-save {
        background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%);
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(206,18,18,0.3);
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(206,18,18,0.4);
    }
    
    .current-logo {
        max-width: 150px;
        max-height: 60px;
        margin-bottom: 10px;
        border-radius: 8px;
    }
    
    .social-input-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .social-input-group i {
        font-size: 1.5rem;
        width: 40px;
        text-align: center;
    }
    
    .social-input-group .form-control {
        flex: 1;
    }
    
    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 25px;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }
</style>

<div class="settings-section">
    <div class="container-fluid">
        <h2 class="mb-4"><i class="bi bi-gear me-2"></i>Site Settings</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Header Settings -->
            <div class="settings-card">
                <div class="section-header">
                    <i class="bi bi-layout-text-window-reverse"></i>
                    <h3>Header Settings</h3>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Name / Logo Text</label>
                            <input type="text" name="site_name" class="form-control" value="{{ $settings->site_name }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Book a Table Link</label>
                            <input type="text" name="book_table_link" class="form-control" value="{{ $settings->book_table_link }}" placeholder="#book-a-table">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Header Phone</label>
                            <input type="text" name="header_phone" class="form-control" value="{{ $settings->header_phone }}" placeholder="+1 234 567 890">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Header Email</label>
                            <input type="email" name="header_email" class="form-control" value="{{ $settings->header_email }}" placeholder="info@yummy.com">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer Settings -->
            <div class="settings-card">
                <div class="section-header">
                    <i class="bi bi-layout-text-sidebar-reverse"></i>
                    <h3>Footer Settings</h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="footer_address" class="form-control" value="{{ $settings->footer_address }}" placeholder="123 Main Street, City">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="footer_phone" class="form-control" value="{{ $settings->footer_phone }}" placeholder="+1 234 567 890">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="footer_email" class="form-control" value="{{ $settings->footer_email }}" placeholder="info@yummy.com">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Opening Hours</label>
                            <input type="text" name="footer_timing" class="form-control" value="{{ $settings->footer_timing }}" placeholder="Mon-Sun: 10:00 AM - 11:00 PM">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Copyright Text</label>
                    <input type="text" name="copyright_text" class="form-control" value="{{ $settings->copyright_text }}" placeholder="© 2025 Yummy Restaurant. All Rights Reserved.">
                </div>
            </div>
            
            <!-- Social Links -->
            <div class="settings-card">
                <div class="section-header">
                    <i class="bi bi-share"></i>
                    <h3>Social Media Links</h3>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Facebook</label>
                            <div class="social-input-group">
                                <i class="bi bi-facebook" style="color: #1877f2;"></i>
                                <input type="url" name="facebook_url" class="form-control" value="{{ $settings->facebook_url }}" placeholder="https://facebook.com/yourpage">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Instagram</label>
                            <div class="social-input-group">
                                <i class="bi bi-instagram" style="color: #e4405f;"></i>
                                <input type="url" name="instagram_url" class="form-control" value="{{ $settings->instagram_url }}" placeholder="https://instagram.com/yourpage">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Twitter / X</label>
                            <div class="social-input-group">
                                <i class="bi bi-twitter-x" style="color: #000;"></i>
                                <input type="url" name="twitter_url" class="form-control" value="{{ $settings->twitter_url }}" placeholder="https://twitter.com/yourpage">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>YouTube</label>
                            <div class="social-input-group">
                                <i class="bi bi-youtube" style="color: #ff0000;"></i>
                                <input type="url" name="youtube_url" class="form-control" value="{{ $settings->youtube_url }}" placeholder="https://youtube.com/yourchannel">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn-save">
                    <i class="bi bi-check-circle me-2"></i>Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
