@extends('layouts.main')

@section('title', 'Contact Messages - Admin')

@section('content')
<style>
    .admin-header {
        background: linear-gradient(135deg, #212529 0%, #495057 100%);
        padding: 60px 0;
        color: white;
    }
    
    .admin-section {
        padding: 60px 0;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .message-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    
    .message-card:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        transform: translateY(-3px);
    }
    
    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
    }
    
    .message-info h5 {
        margin: 0;
        color: #212529;
        font-weight: 600;
    }
    
    .message-info p {
        margin: 5px 0 0;
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .message-date {
        color: #6c757d;
        font-size: 0.85rem;
    }
    
    .message-subject {
        font-weight: 600;
        color: #ce1212;
        margin-bottom: 10px;
    }
    
    .message-body {
        color: #495057;
        line-height: 1.6;
    }
    
    .badge-new {
        background: #ce1212;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
    }
</style>

<div class="admin-header">
    <div class="container">
        <h1><i class="bi bi-envelope-open me-3"></i>Contact Messages</h1>
        <p class="mb-0">View all customer inquiries and messages</p>
    </div>
</div>

<section class="admin-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if($contacts->count() > 0)
                    @foreach($contacts as $contact)
                        <div class="message-card">
                            <div class="message-header">
                                <div class="message-info">
                                    <h5>{{ $contact->name }}</h5>
                                    <p><i class="bi bi-envelope me-2"></i>{{ $contact->email }}</p>
                                </div>
                                <div class="text-end">
                                    <span class="message-date">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $contact->created_at->format('M d, Y - h:i A') }}
                                    </span>
                                    @if($contact->created_at->diffInDays() < 1)
                                        <br><span class="badge-new mt-2">New</span>
                                    @endif
                                </div>
                            </div>
                            <div class="message-subject">
                                <i class="bi bi-tag me-2"></i>{{ $contact->subject }}
                            </div>
                            <div class="message-body">
                                {{ $contact->message }}
                            </div>
                        </div>
                    @endforeach
                    
                    <div class="mt-4">
                        {{ $contacts->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 4rem; color: #dee2e6;"></i>
                        <h3 class="mt-3 text-muted">No messages yet</h3>
                        <p class="text-muted">Contact messages will appear here</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
