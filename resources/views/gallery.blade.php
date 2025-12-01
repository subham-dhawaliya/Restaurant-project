@extends('layouts.main')

@section('title', 'Gallery - Yummy Restaurant')
@section('body_class', 'gallery-page')

@section('content')
<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Gallery</h1>
                    <p class="mb-0">Explore our delicious food and beautiful restaurant ambiance</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="current">Gallery</li>
            </ol>
        </div>
    </nav>
</div>

<!-- Gallery Section -->
<section id="gallery" class="gallery section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        @php
            $galleryItems = \App\Models\GallerySection::where('is_active', true)->orderBy('order')->get();
            $categories = $galleryItems->pluck('category')->unique()->filter();
        @endphp

        @if($categories->count() > 0)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-center flex-wrap gap-2">
                        <button class="btn btn-outline-danger filter-btn active" data-filter="*">All</button>
                        @foreach($categories as $category)
                            <button class="btn btn-outline-danger filter-btn" data-filter=".{{ Str::slug($category) }}">
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="row gy-4 gallery-container">
            @forelse($galleryItems as $item)
                <div class="col-lg-4 col-md-6 gallery-item {{ $item->category ? Str::slug($item->category) : '' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="gallery-wrap">
                        <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid" alt="{{ $item->title }}">
                        <div class="gallery-info">
                            <h4>{{ $item->title }}</h4>
                            @if($item->description)
                                <p>{{ $item->description }}</p>
                            @endif
                            <div class="gallery-links">
                                <a href="{{ asset('storage/' . $item->image) }}" class="glightbox" data-gallery="gallery">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-images" style="font-size: 4rem; color: #ccc;"></i>
                        <p class="text-muted mt-3">No gallery items available at the moment.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .gallery-wrap {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .gallery-wrap:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .gallery-wrap img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery-wrap:hover img {
        transform: scale(1.1);
    }

    .gallery-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 20px;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }

    .gallery-wrap:hover .gallery-info {
        transform: translateY(0);
    }

    .gallery-info h4 {
        color: white;
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .gallery-info p {
        color: rgba(255,255,255,0.9);
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .gallery-links a {
        color: white;
        font-size: 1.5rem;
        transition: color 0.3s ease;
    }

    .gallery-links a:hover {
        color: #ce1212;
    }

    .filter-btn {
        border-radius: 25px;
        padding: 8px 20px;
        transition: all 0.3s ease;
    }

    .filter-btn.active,
    .filter-btn:hover {
        background-color: #ce1212;
        color: white;
        border-color: #ce1212;
    }

    .gallery-item {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .gallery-item.hidden {
        opacity: 0;
        transform: scale(0.8);
        display: none;
    }
</style>
@endsection

@section('scripts')
<script>
    // Gallery Filter
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');
            const items = document.querySelectorAll('.gallery-item');

            items.forEach(item => {
                if (filter === '*' || item.classList.contains(filter.substring(1))) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });
</script>
@endsection
