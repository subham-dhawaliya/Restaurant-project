@extends('layouts.dashboard')

@section('title', 'Dashboard - Yummy Restaurant')

@section('styles')
<style>
    .page-header {
        background: white;
        padding: 25px 30px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        margin-top: 70px;
    }
    
    @media (min-width: 993px) {
        .page-header {
            margin-top: 0;
        }
    }
    
    .page-header h1 {
        font-size: 2rem;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }
    
    .page-header p {
        color: #6c757d;
        margin: 5px 0 0;
    }
    
    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 35px rgba(206,18,18,0.15);
    }
    
    .stats-card .icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    
    .stats-card .icon i {
        font-size: 1.8rem;
        color: white;
    }
    
    .stats-card h3 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 10px;
    }
    
    .stats-card p {
        color: #6c757d;
        margin: 0;
        font-size: 1.1rem;
    }
    
    .table-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    }
    
    .table-card h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 20px;
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table thead th {
        border-bottom: 2px solid #dee2e6;
        color: #495057;
        font-weight: 600;
        padding: 15px;
        white-space: nowrap;
        background-color: #f8f9fa;
    }
    
    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        color: #212529;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .table tbody td:nth-child(1) {
        min-width: 150px;
    }
    
    .table tbody td:nth-child(2) {
        min-width: 250px;
        word-break: break-word;
    }
    
    .table tbody td:nth-child(3) {
        min-width: 200px;
    }
    
    .table tbody td:nth-child(4) {
        min-width: 120px;
        white-space: nowrap;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .btn-view-all {
        background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 40px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-view-all:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(206,18,18,0.3);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="page-header" data-aos="fade-down">
    <h1>Welcome back, {{ $user->name }}! 👋</h1>
    <p>Here's what's happening with your restaurant today.</p>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-up">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-4 mb-4">
    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="stats-card">
            <div class="icon">
                <i class="bi bi-envelope"></i>
            </div>
            <h3>{{ $totalContacts }}</h3>
            <p>Total Messages</p>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="stats-card">
            <div class="icon">
                <i class="bi bi-people"></i>
            </div>
            <h3>{{ \App\Models\User::count() }}</h3>
            <p>Total Users</p>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="stats-card">
            <div class="icon">
                <i class="bi bi-calendar-check"></i>
            </div>
            <h3>{{ $recentContacts->count() }}</h3>
            <p>Recent Messages</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12" data-aos="fade-up" data-aos-delay="400">
        <div class="table-card">
            <h3>
                <i class="bi bi-clock-history me-2"></i>Recent Contact Messages
            </h3>
            
            @if($recentContacts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentContacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>{{ $contact->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('admin.contacts') }}" class="btn-view-all">
                        <i class="bi bi-arrow-right-circle me-2"></i>View All Messages
                    </a>
                </div>
            @else
                <p class="text-muted text-center py-4">No messages yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
