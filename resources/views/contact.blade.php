@extends('layouts.main')

@section('title', 'Contact Us - Yummy Restaurant')

@section('content')
<style>
    .contact-hero {
        background: linear-gradient(135deg, #ce1212 0%, #8b0000 100%);
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }
    
    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
    }
    
    .contact-hero h1 {
        color: white;
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    
    .contact-hero p {
        color: rgba(255,255,255,0.95);
        font-size: 1.2rem;
    }
    
    .contact-section {
        padding: 80px 0;
        background: #f8f9fa;
    }
    
    .info-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        height: 100%;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .info-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(206,18,18,0.15);
        border-color: #ce1212;
    }
    
    .info-card .icon-box {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(206,18,18,0.3);
    }
    
    .info-card .icon-box i {
        font-size: 2rem;
        color: white;
    }
    
    .info-card h3 {
        color: #212529;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .info-card p {
        color: #6c757d;
        margin: 0;
        line-height: 1.8;
    }
    
    .map-container {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        margin-bottom: 60px;
    }
    
    .map-container iframe {
        width: 100%;
        height: 450px;
        border: none;
    }
    
    .contact-form-wrapper {
        background: white;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    
    .contact-form-wrapper h2 {
        color: #212529;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-align: center;
    }
    
    .contact-form-wrapper .subtitle {
        color: #6c757d;
        text-align: center;
        margin-bottom: 40px;
        font-size: 1.1rem;
    }
    
    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 15px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #ce1212;
        box-shadow: 0 0 0 0.2rem rgba(206,18,18,0.15);
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 15px 50px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(206,18,18,0.3);
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(206,18,18,0.4);
    }
    
    .section-title {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 15px;
    }
    
    .section-title p {
        color: #6c757d;
        font-size: 1.1rem;
    }
</style>

<!-- Hero Section -->
<div class="contact-hero" data-aos="fade-down">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1>Get In Touch</h1>
                <p>We'd love to hear from you! Whether you have questions, feedback, or just want to say hello.</p>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <!-- Contact Info Cards -->
        <div class="section-title" data-aos="fade-up">
            <h2>Contact Information</h2>
            <p>Find us at these locations or reach out through any of these channels</p>
        </div>
        
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="info-card">
                    <div class="icon-box">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h3>Address</h3>
                    <p>A108 Adam Street<br>New York, NY 535022</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="info-card">
                    <div class="icon-box">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <h3>Call Us</h3>
                    <p>+1 5589 55488 55<br>Mon-Sat: 11AM - 11PM</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="info-card">
                    <div class="icon-box">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h3>Email Us</h3>
                    <p>info@example.com<br>support@example.com</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="info-card">
                    <div class="icon-box">
                        <i class="bi bi-clock"></i>
                    </div>
                    <h3>Opening Hours</h3>
                    <p><strong>Mon-Sat:</strong> 11AM - 23PM<br><strong>Sunday:</strong> Closed</p>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="map-container" data-aos="fade-up" data-aos-delay="500">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1841861553894!2d-73.98823492346449!3d40.758895971387916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1699280838544!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <!-- Contact Form -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="contact-form-wrapper" data-aos="fade-up" data-aos-delay="600">
                    <h2>Send Us a Message</h2>
                    <p class="subtitle">Have a question or want to make a reservation? Fill out the form below!</p>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; border-left: 4px solid #28a745;">
                            <i class="bi bi-check-circle me-2"></i>
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px; border-left: 4px solid #dc3545;">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Error!</strong> Please check the form fields.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="col-12">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control" rows="6" placeholder="Your Message" required></textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-submit">
                                    <i class="bi bi-send me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
