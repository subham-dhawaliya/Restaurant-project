@extends('layouts.main')

@section('title', 'Menu - Yummy Restaurant')
@section('body_class', 'menu-page')

@section('content')
<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Our Menu</h1>
                    <p class="mb-0">Discover our delicious menu items</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="current">Menu</li>
            </ol>
        </div>
    </nav>
</div>

<!-- Menu Section -->
<section id="menu" class="menu section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Our Menu</h2>
        <p><span>Check Our</span> <span class="description-title">Yummy Menu</span></p>
    </div><!-- End Section Title -->

    <div class="container">
        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-all">
                    <h4>All</h4>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-food">
                    <h4>Food</h4>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-beverages">
                    <h4>Beverages</h4>
                </a>
            </li>
        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
            <div class="tab-pane fade active show" id="menu-all">
                <div class="tab-header text-center">
                    <p>Menu</p>
                    <h3>All Items</h3>
                </div>

                <div class="row gy-5">
                    @forelse($menuItems as $item)
                    <div class="col-lg-4 menu-item">
                        <a href="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/menu/menu-item-1.png') }}" class="glightbox">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/menu/menu-item-1.png') }}" class="menu-img img-fluid" alt="{{ $item->name }}">
                        </a>
                        <h4>{{ $item->name }}</h4>
                        <p class="ingredients">
                            {{ $item->description }}
                        </p>
                        <p class="price">
                            ₹{{ number_format($item->price, 2) }}
                        </p>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No menu items available at the moment.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="tab-pane fade" id="menu-food">
                <div class="tab-header text-center">
                    <p>Menu</p>
                    <h3>Food</h3>
                </div>

                <div class="row gy-5">
                    @forelse($menuItems->where('category', 'food') as $item)
                    <div class="col-lg-4 menu-item">
                        <a href="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/menu/menu-item-1.png') }}" class="glightbox">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/menu/menu-item-1.png') }}" class="menu-img img-fluid" alt="{{ $item->name }}">
                        </a>
                        <h4>{{ $item->name }}</h4>
                        <p class="ingredients">
                            {{ $item->description }}
                        </p>
                        <p class="price">
                            ₹{{ number_format($item->price, 2) }}
                        </p>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No food items available.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="tab-pane fade" id="menu-beverages">
                <div class="tab-header text-center">
                    <p>Menu</p>
                    <h3>Beverages</h3>
                </div>

                <div class="row gy-5">
                    @forelse($menuItems->where('category', 'beverages') as $item)
                    <div class="col-lg-4 menu-item">
                        <a href="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/menu/menu-item-1.png') }}" class="glightbox">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/menu/menu-item-1.png') }}" class="menu-img img-fluid" alt="{{ $item->name }}">
                        </a>
                        <h4>{{ $item->name }}</h4>
                        <p class="ingredients">
                            {{ $item->description }}
                        </p>
                        <p class="price">
                            ₹{{ number_format($item->price, 2) }}
                        </p>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No beverages available.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
