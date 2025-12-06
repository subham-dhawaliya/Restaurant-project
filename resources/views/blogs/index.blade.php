@extends('layouts.main')

@section('title', 'Blog - Evara Restaurant')

@section('content')
<style>
    .blog-hero {
        background: linear-gradient(135deg, #ce1212 0%, #8b0000 100%);
        padding: 80px 0;
        text-align: center;
        color: white;
    }
    .blog-hero h1 { font-size: 3rem; font-weight: 700; margin-bottom: 15px; }
    .blog-hero p { font-size: 1.2rem; opacity: 0.9; }
    
    .blog-section { padding: 80px 0; background: #f8f9fa; }
    
    .blog-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .blog-card:hover { transform: translateY(-10px); box-shadow: 0 15px 40px rgba(0,0,0,0.15); }
    
    .blog-image {
        height: 200px;
        overflow: hidden;
    }
    .blog-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
    .blog-card:hover .blog-image img { transform: scale(1.1); }
    
    .blog-content { padding: 25px; flex: 1; display: flex; flex-direction: column; }
    .blog-category { color: #ce1212; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 10px; }
    .blog-title { font-size: 1.3rem; font-weight: 700; margin-bottom: 15px; color: #212529; }
    .blog-title a { color: inherit; text-decoration: none; }
    .blog-title a:hover { color: #ce1212; }
    .blog-excerpt { color: #6c757d; font-size: 0.95rem; line-height: 1.6; flex: 1; }
    
    .blog-meta { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding-top: 15px; border-top: 1px solid #e9ecef; }
    .blog-author { display: flex; align-items: center; gap: 10px; }
    .blog-author i { color: #ce1212; }
    .blog-date { color: #6c757d; font-size: 0.85rem; }
    
    .read-more { color: #ce1212; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; }
    .read-more:hover { color: #a00e0e; }
    
    .no-blogs { text-align: center; padding: 60px 20px; }
    .no-blogs i { font-size: 4rem; color: #dee2e6; }
</style>

<section class="blog-hero">
    <div class="container">
        <h1 data-aos="fade-up">Our Blog</h1>
        <p data-aos="fade-up" data-aos-delay="100">Latest news, updates & recipes from Evara Restaurant</p>
    </div>
</section>

<section class="blog-section">
    <div class="container">
        @if($blogs->count() > 0)
        <div class="row g-4">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="blog-card">
                    <div class="blog-image">
                        @if($blog->image)
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                        @else
                            <img src="https://via.placeholder.com/400x200/ce1212/ffffff?text=Yummy+Blog" alt="{{ $blog->title }}">
                        @endif
                    </div>
                    <div class="blog-content">
                        @if($blog->category)
                            <div class="blog-category">{{ $blog->category }}</div>
                        @endif
                        <h3 class="blog-title">
                            <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                        </h3>
                        <p class="blog-excerpt">{{ Str::limit($blog->excerpt ?? $blog->content, 120) }}</p>
                        <div class="blog-meta">
                            <div class="blog-author">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ $blog->author }}</span>
                            </div>
                            <div class="blog-date">{{ $blog->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-5 d-flex justify-content-center">
            {{ $blogs->links() }}
        </div>
        @else
        <div class="no-blogs">
            <i class="bi bi-newspaper"></i>
            <h3 class="mt-3">No Blog Posts Yet</h3>
            <p class="text-muted">Check back soon for updates!</p>
        </div>
        @endif
    </div>
</section>
@endsection
