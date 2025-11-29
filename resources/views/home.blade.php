@extends('layouts.main')

@section('title', 'Home - Yummy Restaurant')
@section('body_class', 'index-page')

@section('content')
<!-- Hero Section -->
<section id="hero" class="hero section light-background">
    <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-between">
            <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">Enjoy Your Healthy<br>Delicious Food</h1>
                <p data-aos="fade-up" data-aos-delay="100">We are team of talented chefs making delicious food with passion</p>
                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                    <a href="#book-a-table" class="btn-get-started">Book a Table</a>
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center">
                        <i class="bi bi-play-circle"></i><span>Watch Video</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                <img src="{{ asset('assets/img/hero-img.png') }}" class="img-fluid animated" alt="Yummy Food">
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            <div class="col-lg-6 order-1 order-lg-2">
                <img src="{{ asset('assets/img/about.jpg') }}" class="img-fluid" alt="About Us">
            </div>
            <div class="col-lg-6 order-2 order-lg-1 content">
                <h3>About Our Restaurant</h3>
                <p class="fst-italic">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <ul>
                    <li><i class="bi bi-check2-all"></i> <span>Fresh ingredients sourced daily</span></li>
                    <li><i class="bi bi-check2-all"></i> <span>Expert chefs with international experience</span></li>
                    <li><i class="bi bi-check2-all"></i> <span>Cozy and elegant dining atmosphere</span></li>
                </ul>
                <p>
                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section id="stats" class="stats section dark-background">
    <img src="{{ asset('assets/img/stats-bg.jpg') }}" alt="" data-aos="fade-in">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            <div class="col-lg-3 col-md-6">
                <div class="stats-item text-center w-100 h-100">
                    <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Clients</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-item text-center w-100 h-100">
                    <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Projects</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-item text-center w-100 h-100">
                    <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Hours Of Support</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-item text-center w-100 h-100">
                    <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Workers</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
