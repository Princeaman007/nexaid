@extends('layouts.app')

@section('content')
<div class="blog-post-container">
    @if(session('locale_set'))
        <div class="alert-success">
            Langue bien changée en : {{ session('locale_set') }}
        </div>
    @endif

    <!-- Navigation retour -->
    <div class="breadcrumb">
        <a href="{{ route('blog.index') }}" class="back-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m15 18-6-6 6-6"/>
            </svg>
            @if(app()->getLocale() == 'fr')
                Retour au blog
            @else
                Back to blog
            @endif
        </a>
    </div>

    <!-- Article principal -->
    <article class="blog-post">
        <!-- En-tête de l'article -->
        <header class="post-header">
            <h1 class="post-title">
                {{ $post->getTranslation('title', app()->getLocale()) }}
            </h1>
            
            <div class="post-meta">
                <div class="post-date">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    @if(app()->getLocale() == 'fr')
                        Publié le {{ $post->published_at ? $post->published_at->format('d F Y') : 'Date non définie' }}
                    @else
                        Published on {{ $post->published_at ? $post->published_at->format('F d, Y') : 'Date not defined' }}
                    @endif
                </div>
                
                <div class="reading-time">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12,6 12,12 16,14"/>
                    </svg>
                    @php
                        $wordCount = str_word_count(strip_tags($post->getTranslation('content', app()->getLocale())));
                        $readingTime = ceil($wordCount / 200); // 200 mots par minute en moyenne
                    @endphp
                    @if(app()->getLocale() == 'fr')
                        {{ $readingTime }} min de lecture
                    @else
                        {{ $readingTime }} min read
                    @endif
                </div>
            </div>
        </header>

        <!-- Image principale -->
        @if($post->image)
            <div class="post-featured-image">
                <img src="{{ asset('storage/' . $post->image) }}" 
                     alt="{{ $post->getTranslation('title', app()->getLocale()) }}">
            </div>
        @endif

        <!-- Contenu de l'article -->
        <div class="post-content">
            {!! $post->getTranslation('content', app()->getLocale()) !!}
        </div>

        <!-- Pied de l'article -->
        <footer class="post-footer">
            <div class="post-tags">
                <!-- Vous pouvez ajouter des tags ici si vous en avez -->
            </div>
            
            <div class="post-actions">
                <button onclick="window.print()" class="action-button">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6,9 6,2 18,2 18,9"/>
                        <path d="M6,18H4a2,2,0,0,1-2-2V11a2,2,0,0,1,2-2H20a2,2,0,0,1,2,2v5a2,2,0,0,1-2,2H18"/>
                        <polyline points="6,14 6,22 18,22 18,14"/>
                    </svg>
                    @if(app()->getLocale() == 'fr')
                        Imprimer
                    @else
                        Print
                    @endif
                </button>
                
                <button onclick="navigator.share ? navigator.share({title: '{{ addslashes($post->getTranslation('title', app()->getLocale())) }}', url: window.location.href}) : copyToClipboard()" class="action-button">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/>
                        <polyline points="16,6 12,2 8,6"/>
                        <line x1="12" y1="2" x2="12" y2="15"/>
                    </svg>
                    @if(app()->getLocale() == 'fr')
                        Partager
                    @else
                        Share
                    @endif
                </button>
            </div>
        </footer>
    </article>

    <!-- Navigation entre articles -->
    <nav class="post-navigation">
        <div class="nav-links">
            <!-- Vous pouvez ajouter ici la navigation vers l'article précédent/suivant -->
            <a href="{{ route('blog.index') }}" class="nav-button primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
                @if(app()->getLocale() == 'fr')
                    Voir tous les articles
                @else
                    View all articles
                @endif
            </a>
        </div>
    </nav>
</div>

<style>
.blog-post-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
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

.breadcrumb {
    margin-bottom: 2rem;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    color: #6c757d;
    font-weight: 500;
    transition: all 0.3s ease;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    background: white;
}

.back-link:hover {
    color: #007bff;
    border-color: #007bff;
    transform: translateX(-3px);
}

.blog-post {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

.post-header {
    padding: 2.5rem 2.5rem 1.5rem;
    border-bottom: 1px solid #f0f0f0;
}

.post-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 1.5rem 0;
    line-height: 1.2;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.post-meta {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.post-date,
.reading-time {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6c757d;
    font-size: 0.95rem;
    font-weight: 500;
}

.post-date svg,
.reading-time svg {
    color: #007bff;
}

.post-featured-image {
    width: 100%;
    height: 400px;
    overflow: hidden;
    position: relative;
}

.post-featured-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.post-content {
    padding: 2.5rem;
    font-size: 1.1rem;
    line-height: 1.8;
    color: #343a40;
}

.post-content h1,
.post-content h2,
.post-content h3,
.post-content h4,
.post-content h5,
.post-content h6 {
    color: #2c3e50;
    margin: 2rem 0 1rem 0;
    font-weight: 600;
}

.post-content h2 {
    font-size: 1.8rem;
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 0.5rem;
}

.post-content h3 {
    font-size: 1.5rem;
}

.post-content p {
    margin-bottom: 1.5rem;
}

.post-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1.5rem 0;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.post-content blockquote {
    border-left: 4px solid #007bff;
    padding: 1rem 1.5rem;
    margin: 2rem 0;
    background: #f8f9fa;
    border-radius: 0 8px 8px 0;
    font-style: italic;
}

.post-content ul,
.post-content ol {
    padding-left: 2rem;
    margin-bottom: 1.5rem;
}

.post-content li {
    margin-bottom: 0.5rem;
}

.post-footer {
    padding: 2rem 2.5rem;
    border-top: 1px solid #f0f0f0;
    background: #f8f9fa;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.post-actions {
    display: flex;
    gap: 1rem;
}

.action-button {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.25rem;
    border: 1px solid #dee2e6;
    background: white;
    color: #6c757d;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 0.9rem;
}

.action-button:hover {
    color: #007bff;
    border-color: #007bff;
    transform: translateY(-1px);
}

.post-navigation {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #f0f0f0;
}

.nav-links {
    display: flex;
    justify-content: center;
}

.nav-button {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.nav-button.primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.nav-button.primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

/* Responsive */
@media (max-width: 768px) {
    .blog-post-container {
        padding: 1rem;
    }
    
    .post-header {
        padding: 2rem 1.5rem 1rem;
    }
    
    .post-title {
        font-size: 2rem;
    }
    
    .post-content {
        padding: 1.5rem;
    }
    
    .post-footer {
        padding: 1.5rem;
        flex-direction: column;
        align-items: stretch;
    }
    
    .post-actions {
        justify-content: center;
    }
    
    .post-meta {
        flex-direction: column;
        gap: 1rem;
    }
    
    .post-featured-image {
        height: 250px;
    }
}

@media (max-width: 480px) {
    .post-title {
        font-size: 1.75rem;
    }
    
    .post-content {
        font-size: 1rem;
        padding: 1rem;
    }
    
    .action-button {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }
}

/* Styles pour l'impression */
@media print {
    .breadcrumb,
    .post-footer,
    .post-navigation {
        display: none;
    }
    
    .blog-post {
        box-shadow: none;
        border: none;
    }
    
    .post-title {
        -webkit-text-fill-color: #2c3e50;
        color: #2c3e50;
    }
}
</style>

<script>
function copyToClipboard() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        alert(@if(app()->getLocale() == 'fr')'Lien copié dans le presse-papiers!'@else'Link copied to clipboard!'@endif);
    });
}
</script>
@endsection