@extends('layouts.main')

@section('title', 'Gallery - Evara Restaurant')
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
                                <div class="description-wrapper">
                                    <p class="description-text">{{ Str::limit($item->description, 120) }}</p>
                                    @if(strlen($item->description) > 120)
                                        <a href="javascript:void(0)" class="read-more-btn" data-full-text="{{ $item->description }}">Read More</a>
                                    @endif
                                </div>
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
    .gallery-item {
        display: flex;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .gallery-wrap {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
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
        flex-shrink: 0;
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
        max-height: 100%;
        overflow: hidden;
    }

    .gallery-wrap:hover .gallery-info {
        transform: translateY(0);
    }

    .gallery-info h4 {
        color: white;
        font-size: 1.2rem;
        margin-bottom: 5px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .description-wrapper {
        margin-bottom: 10px;
    }

    .gallery-info .description-text {
        color: rgba(255,255,255,0.9);
        font-size: 0.9rem;
        margin-bottom: 5px;
        line-height: 1.4;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .read-more-btn {
        color: #ce1212;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 5px;
        transition: color 0.3s ease;
        cursor: pointer;
        position: relative;
        z-index: 10;
        padding: 2px 5px;
        background: rgba(255,255,255,0.1);
        border-radius: 3px;
    }

    .read-more-btn:hover {
        color: #ff4444;
        text-decoration: underline;
        background: rgba(255,255,255,0.2);
    }

    .gallery-links {
        margin-top: 5px;
    }

    .gallery-links a {
        color: white;
        font-size: 1.5rem;
        transition: color 0.3s ease;
        position: relative;
        z-index: 5;
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

    .gallery-item.hidden {
        opacity: 0;
        transform: scale(0.8);
        display: none;
    }

    /* Ensure equal height rows */
    .gallery-container {
        display: flex;
        flex-wrap: wrap;
    }

    .gallery-container > .col-lg-4,
    .gallery-container > .col-md-6 {
        display: flex;
        margin-bottom: 30px;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        // Read More functionality
        setTimeout(function() {
            document.querySelectorAll('.read-more-btn').forEach(function(button) {
                const fullText = button.getAttribute('data-full-text');
                const wrapper = button.closest('.description-wrapper');
                const descriptionText = wrapper.querySelector('.description-text');
                const truncatedText = descriptionText.textContent;
                
                console.log('Read More button found:', button, 'Full text:', fullText);
                
                button.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    
                    console.log('Read More clicked! Current state:', this.classList.contains('expanded'));
                    
                    if (this.classList.contains('expanded')) {
                        descriptionText.textContent = truncatedText;
                        this.textContent = 'Read More';
                        this.classList.remove('expanded');
                        console.log('Collapsed to truncated text');
                    } else {
                        descriptionText.textContent = fullText;
                        this.textContent = 'Read Less';
                        this.classList.add('expanded');
                        console.log('Expanded to full text');
                    }
                    
                    return false;
                };
            });
        }, 500);
    });
</script>
@endsection
