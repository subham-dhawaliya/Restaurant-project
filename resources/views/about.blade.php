@extends('layouts.main')

@section('title', 'About Us - Yummy Restaurant')
@section('body_class', 'about-page')

@section('content')
<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>About Us</h1>
                    <p class="mb-0">Learn more about our restaurant and our passion for food</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="current">About</li>
            </ol>
        </div>
    </nav>
</div>

<!-- About Section -->
<section id="about" class="about section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            <div class="col-lg-6 order-1 order-lg-2">
                @if($aboutSection && $aboutSection->image)
                    <img src="{{ asset('storage/' . $aboutSection->image) }}" class="img-fluid" alt="{{ $aboutSection->title }}">
                @else
                    <img src="{{ asset('assets/img/about.jpg') }}" class="img-fluid" alt="About Yummy Restaurant">
                @endif
            </div>
            <div class="col-lg-6 order-2 order-lg-1 content">
                <h3>{{ $aboutSection->title ?? 'Our Story' }}</h3>
                <p class="fst-italic">
                    {{ $aboutSection->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' }}
                </p>
                @if($aboutSection && $aboutSection->features && count($aboutSection->features) > 0)
                    <ul>
                        @foreach($aboutSection->features as $feature)
                            <li><i class="bi bi-check2-all"></i> <span>{{ $feature }}</span></li>
                        @endforeach
                    </ul>
                @else
                    <ul>
                        <li><i class="bi bi-check2-all"></i> <span>Fresh ingredients sourced locally</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Expert chefs with years of experience</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Unique dining atmosphere</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Customer satisfaction is our priority</span></li>
                    </ul>
                @endif
                @if($aboutSection && $aboutSection->additional_text)
                    <p>{{ $aboutSection->additional_text }}</p>
                @else
                    <p>
                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Why Us Section -->
<section id="why-us" class="why-us section light-background">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="why-box">
                    <h3>Why Choose Yummy?</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                    </p>
                    <div class="text-center">
                        <a href="#" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 d-flex align-items-stretch">
                <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-xl-4">
                        <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                            <i class="bi bi-clipboard-data"></i>
                            <h4>Quality Food</h4>
                            <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris</p>
                        </div>
                    </div>
                    <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                            <i class="bi bi-gem"></i>
                            <h4>Fast Service</h4>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                        </div>
                    </div>
                    <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                            <i class="bi bi-inboxes"></i>
                            <h4>Great Atmosphere</h4>
                            <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
