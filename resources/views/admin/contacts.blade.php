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
    
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }
    
    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 30px;
        border-radius: 15px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }
    
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
    
    .close:hover {
        color: #ce1212;
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
        padding: 10px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        font-size: 1rem;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #ce1212;
    }
    
    textarea.form-control {
        min-height: 150px;
        resize: vertical;
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
                            <div class="mt-3 text-end">
                                <button class="btn btn-danger btn-sm" onclick="openReplyModal({{ $contact->id }}, '{{ $contact->name }}', '{{ $contact->email }}')">
                                    <i class="bi bi-reply-fill me-1"></i>Reply
                                </button>
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

<!-- Reply Modal -->
<div id="replyModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeReplyModal()">&times;</span>
        <h3 class="mb-4"><i class="bi bi-reply-fill me-2"></i>Reply to Message</h3>
        
        @if(session('reply_success'))
            <div class="alert alert-success">
                {{ session('reply_success') }}
            </div>
        @endif
        
        <form id="replyForm" method="POST" action="{{ route('admin.contacts.reply') }}">
            @csrf
            <input type="hidden" name="contact_id" id="contact_id">
            
            <div class="form-group">
                <label>To:</label>
                <input type="text" class="form-control" id="recipient_name" readonly>
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="recipient_email" id="recipient_email" readonly>
            </div>
            
            <div class="form-group">
                <label>Subject:</label>
                <input type="text" class="form-control" name="subject" placeholder="Enter subject" required>
            </div>
            
            <div class="form-group">
                <label>Message:</label>
                <textarea class="form-control" name="message" placeholder="Type your reply here..." required></textarea>
            </div>
            
            <div class="text-end">
                <button type="button" class="btn btn-secondary me-2" onclick="closeReplyModal()">Cancel</button>
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-send me-1"></i>Send Reply
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openReplyModal(contactId, name, email) {
        document.getElementById('contact_id').value = contactId;
        document.getElementById('recipient_name').value = name;
        document.getElementById('recipient_email').value = email;
        document.getElementById('replyModal').style.display = 'block';
    }
    
    function closeReplyModal() {
        document.getElementById('replyModal').style.display = 'none';
        document.getElementById('replyForm').reset();
    }
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('replyModal');
        if (event.target == modal) {
            closeReplyModal();
        }
    }
</script>
@endsection
