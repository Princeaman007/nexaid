@extends('layouts.app')

@section('content')
<div class="blog-container">
    @if(session('locale_set'))
        <div class="alert-success">
            Langue bien changée en : {{ session('locale_set') }}
        </div>
    @endif

    <div class="blog-header">
        <h1 class="blog-title">
            @if(app()->getLocale() == 'fr')
                Articles du Blog
            @else
                Blog Posts
            @endif
        </h1>
        <div class="blog-subtitle">
            @if(app()->getLocale() == 'fr')
                Découvrez nos derniers articles et actualités
            @else
                Discover our latest articles and news
            @endif
        </div>
    </div>

    <div class="blog-grid">
        @foreach($posts as $post)
            <div class="blog-card">
                @if($post->image)
                    <div class="blog-image">
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             alt="{{ $post->getTranslation('title', app()->getLocale()) }}">
                        <div class="image-overlay"></div>
                    </div>
                @else
                    <div class="blog-image blog-no-image">
                        <div class="no-image-placeholder">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21,15 16,10 5,21"/>
                            </svg>
                        </div>
                    </div>
                @endif
                
                <div class="blog-content">
                    <div class="blog-date">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        @if(app()->getLocale() == 'fr')
                            {{ $post->published_at ? $post->published_at->format('d M Y') : 'Date non définie' }}
                        @else
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Date not defined' }}
                        @endif
                    </div>
                    
                    <h2 class="blog-post-title">
                        <a href="{{ route('blog.show', $post->slug) }}">
                            {{ $post->getTranslation('title', app()->getLocale()) }}
                        </a>
                    </h2>
                    
                    <p class="blog-excerpt">
                        {{ \Illuminate\Support\Str::limit(strip_tags($post->getTranslation('content', app()->getLocale())), 120) }}
                    </p>
                    
                    <div class="blog-footer">
                        <a href="{{ route('blog.show', $post->slug) }}" class="read-more">
                            @if(app()->getLocale() == 'fr')
                                Lire la suite
                            @else
                                Read More
                            @endif
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- @if($posts->isEmpty())
    @else
        <div class="no-posts">
            <div class="no-posts-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14,2 14,8 20,8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10,9 9,9 8,9"/>
                </svg>
            </div>
            <h3>
                @if(app()->getLocale() == 'fr')
                    Aucun article disponible
                @else
                    No blog posts available
                @endif
            </h3>
            <p>
                @if(app()->getLocale() == 'fr')
                    Revenez bientôt pour découvrir nos nouveaux contenus
                @else
                    Come back soon to discover our new content
                @endif
            </p>
        </div>
    @endif --}}
</div>

<style>
.blog-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    border: 1px solid #c3e6cb;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.blog-header {
    text-align: center;
    margin-bottom: 3rem;
}

.blog-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.blog-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    font-weight: 400;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.blog-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
    height: fit-content;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.blog-image {
    height: 220px;
    overflow: hidden;
    position: relative;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.blog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.blog-card:hover .blog-image img {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.1) 100%);
}

.blog-no-image {
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.no-image-placeholder {
    color: #adb5bd;
}

.blog-content {
    padding: 1.5rem;
}

.blog-date {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: #6c757d;
    margin-bottom: 1rem;
    font-weight: 500;
}

.blog-date svg {
    color: #007bff;
}

.blog-post-title {
    margin: 0 0 1rem 0;
    font-size: 1.25rem;
    line-height: 1.3;
}

.blog-post-title a {
    text-decoration: none;
    color: #2c3e50;
    font-weight: 600;
    transition: color 0.3s ease;
}

.blog-post-title a:hover {
    color: #007bff;
}

.blog-excerpt {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
}

.blog-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #f0f0f0;
}

.read-more {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    color: #007bff;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.read-more:hover {
    color: #0056b3;
    gap: 0.75rem;
}

.no-posts {
    text-align: center;
    padding: 4rem 2rem;
    color: #6c757d;
}

.no-posts-icon {
    margin-bottom: 2rem;
    color: #adb5bd;
}

.no-posts h3 {
    font-size: 1.5rem;
    color: #495057;
    margin-bottom: 1rem;
}

.no-posts p {
    font-size: 1.1rem;
    max-width: 400px;
    margin: 0 auto;
}

/* Responsive */
@media (max-width: 768px) {
    .blog-container {
        padding: 1rem;
    }
    
    .blog-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .blog-title {
        font-size: 2rem;
    }
    
    .blog-image {
        height: 200px;
    }
    
    .blog-content {
        padding: 1.25rem;
    }
}

@media (max-width: 480px) {
    .blog-grid {
        gap: 1rem;
    }
    
    .blog-title {
        font-size: 1.75rem;
    }
    
    .blog-image {
        height: 180px;
    }
    
    .blog-content {
        padding: 1rem;
    }
}
</style>
@endsection