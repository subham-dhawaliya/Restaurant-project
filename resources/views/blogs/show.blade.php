@extends('layouts.main')

@section('title', $blog->title . ' - Evara Restaurant')

@section('content')
<style>
    .blog-detail-hero {
        background: linear-gradient(135deg, #ce1212 0%, #8b0000 100%);
        padding: 100px 0 60px;
        color: white;
    }
    .blog-detail-hero .category { background: rgba(255,255,255,0.2); padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; display: inline-block; margin-bottom: 15px; }
    .blog-detail-hero h1 { font-size: 2.5rem; font-weight: 700; margin-bottom: 20px; }
    .blog-meta-info { display: flex; gap: 25px; flex-wrap: wrap; opacity: 0.9; }
    .blog-meta-info span { display: flex; align-items: center; gap: 8px; }
    
    .blog-detail-section { padding: 60px 0; }
    
    .blog-featured-image { margin-top: -80px; margin-bottom: 40px; }
    .blog-featured-image img { width: 100%; max-height: 500px; object-fit: cover; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
    
    .blog-content-wrapper { background: white; border-radius: 15px; padding: 40px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); }
    .blog-content-wrapper p { font-size: 1.1rem; line-height: 1.8; color: #444; margin-bottom: 20px; }
    
    .blog-share { margin-top: 40px; padding-top: 30px; border-top: 1px solid #e9ecef; }
    .blog-share h5 { margin-bottom: 15px; }
    .share-btns { display: flex; gap: 10px; }
    .share-btn { width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease; }
    .share-btn:hover { transform: scale(1.1); color: white; }
    .share-btn.facebook { background: #1877f2; }
    .share-btn.twitter { background: #1da1f2; }
    .share-btn.whatsapp { background: #25d366; }
    
    .related-blogs { margin-top: 60px; }
    .related-blogs h3 { margin-bottom: 30px; }
    .related-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
    .related-card img { width: 100%; height: 150px; object-fit: cover; }
    .related-card-body { padding: 20px; }
    .related-card-body h5 { font-size: 1rem; margin-bottom: 10px; }
    .related-card-body h5 a { color: #212529; text-decoration: none; }
    .related-card-body h5 a:hover { color: #ce1212; }
    
    .back-btn { display: inline-flex; align-items: center; gap: 8px; color: #ce1212; text-decoration: none; font-weight: 600; margin-bottom: 20px; }
</style>

<section class="blog-detail-hero">
    <div class="container">
        @if($blog->category)
            <span class="category">{{ $blog->category }}</span>
        @endif
        <h1 data-aos="fade-up">{{ $blog->title }}</h1>
        <div class="blog-meta-info" data-aos="fade-up" data-aos-delay="100">
            <span><i class="bi bi-person-circle"></i> {{ $blog->author }}</span>
            <span><i class="bi bi-calendar"></i> {{ $blog->created_at->format('M d, Y') }}</span>
            <span><i class="bi bi-eye"></i> {{ $blog->views }} views</span>
        </div>
    </div>
</section>

<section class="blog-detail-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <a href="{{ route('blog.index') }}" class="back-btn">
                    <i class="bi bi-arrow-left"></i> Back to Blog
                </a>
                
                @if($blog->image)
                <div class="blog-featured-image" data-aos="fade-up">
                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                </div>
                @endif
                
                <div class="blog-content-wrapper" data-aos="fade-up">
                    {!! nl2br(e($blog->content)) !!}
                    
                    <div class="blog-share">
                        <h5>Share this post</h5>
                        <div class="share-btns">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="share-btn facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" target="_blank" class="share-btn twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}" target="_blank" class="share-btn whatsapp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                @if($relatedBlogs->count() > 0)
                <div class="related-blogs">
                    <h3>Related Posts</h3>
                    <div class="row g-4">
                        @foreach($relatedBlogs as $related)
                        <div class="col-md-4">
                            <div class="related-card">
                                @if($related->image)
                                    <img src="{{ asset($related->image) }}" alt="{{ $related->title }}">
                                @else
                                    <img src="https://via.placeholder.com/400x150/ce1212/ffffff?text=Blog" alt="{{ $related->title }}">
                                @endif
                                <div class="related-card-body">
                                    <h5><a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a></h5>
                                    <small class="text-muted">{{ $related->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
