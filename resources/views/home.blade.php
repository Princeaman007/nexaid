@extends('layouts.app')

@section('content')
<div class="homepage-container">
    <!-- Hero Section Moderne -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-background" style="background-image: url('{{ asset('images/stage.jpg') }}')"></div>
        
        <div class="hero-content">
            <div class="hero-badge">
                <span class="badge-icon">🌟</span>
                <span>
                    @if(app()->getLocale() == 'fr')
                        Plateforme #1 pour les stages internationaux
                    @else
                        #1 Platform for International Internships
                    @endif
                </span>
            </div>
            
            <h1 class="hero-title">
                @if(app()->getLocale() == 'fr')
                    Trouvez le Stage International <span class="gradient-text">Parfait</span>
                @else
                    Find Your Perfect <span class="gradient-text">International Internship</span>
                @endif
            </h1>
            
            <p class="hero-subtitle">
                @if(app()->getLocale() == 'fr')
                    Connectez-vous à des opportunités exceptionnelles dans le monde entier. 
                    Transformez votre carrière avec une expérience internationale unique.
                @else
                    Connect with outstanding opportunities worldwide. 
                    Transform your career with a unique international experience.
                @endif
            </p>
            
            <!-- Barre de recherche moderne -->
            <form action="{{ route('internships.index') }}" method="GET" class="hero-search">
                <div class="search-container">
                    <div class="search-input-group">
                        <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                        <input type="text" name="q" class="search-input"
                            placeholder="@if(app()->getLocale() == 'fr')Rechercher un stage...@elseSearch for internships...@endif">
                    </div>
                    <button type="submit" class="search-button">
                        @if(app()->getLocale() == 'fr')
                            Rechercher
                        @else
                            Search
                        @endif
                    </button>
                </div>
            </form>
            
            <!-- Stats Hero -->
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">
                        @if(app()->getLocale() == 'fr')
                            Stages disponibles
                        @else
                            Available internships
                        @endif
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">50+</span>
                    <span class="stat-label">
                        @if(app()->getLocale() == 'fr')
                            Pays partenaires
                        @else
                            Partner countries
                        @endif
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">95%</span>
                    <span class="stat-label">
                        @if(app()->getLocale() == 'fr')
                            Taux de satisfaction
                        @else
                            Satisfaction rate
                        @endif
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Floating Elements -->
        <div class="floating-elements">
            <div class="floating-element" style="top: 20%; left: 10%; animation-delay: 0s;">💼</div>
            <div class="floating-element" style="top: 60%; right: 15%; animation-delay: 2s;">🌍</div>
            <div class="floating-element" style="bottom: 30%; left: 5%; animation-delay: 4s;">🚀</div>
        </div>
    </section>

    <!-- Stages récents -->
    <section class="section internships-section">
        <div class="section-header">
            <div class="section-badge">
                <span class="badge-icon">🔥</span>
                <span>
                    @if(app()->getLocale() == 'fr')
                        Opportunités populaires
                    @else
                        Popular opportunities
                    @endif
                </span>
            </div>
            <h2 class="section-title">
                @if(app()->getLocale() == 'fr')
                    Stages récents
                @else
                    Recent Internships
                @endif
            </h2>
            <p class="section-subtitle">
                @if(app()->getLocale() == 'fr')
                    Découvrez les dernières opportunités de stages internationaux
                @else
                    Discover the latest international internship opportunities
                @endif
            </p>
        </div>

        @if(isset($internships) && count($internships))
            <div class="internships-carousel">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($internships as $internship)
                            <div class="swiper-slide">
                                <div class="internship-card">
                                    @if($internship->image)
                                        <div class="card-image">
                                            <img src="{{ asset('storage/' . $internship->image) }}" 
                                                 alt="{{ $internship->title[app()->getLocale()] ?? '' }}">
                                            <div class="image-overlay"></div>
                                            <div class="card-badge">
                                                @if(\Carbon\Carbon::parse($internship->created_at)->gt(now()->subDays(7)))
                                                    <span class="badge new">
                                                        @if(app()->getLocale() == 'fr')
                                                            Nouveau
                                                        @else
                                                            New
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-image no-image">
                                            <div class="no-image-placeholder">
                                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                                    <polyline points="21,15 16,10 5,21"/>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="card-content">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ $internship->title[app()->getLocale()] ?? '' }}</h3>
                                            @if($internship->company_name)
                                                <p class="card-company">{{ $internship->company_name }}</p>
                                            @endif
                                        </div>
                                        
                                        <div class="card-meta">
                                            @if($internship->location)
                                                <div class="meta-item">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                                        <circle cx="12" cy="10" r="3"/>
                                                    </svg>
                                                    <span>{{ $internship->location }}</span>
                                                </div>
                                            @endif
                                            
                                            @if($internship->category)
                                                <div class="meta-item">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                                        <polyline points="22,6 12,13 2,6"/>
                                                    </svg>
                                                    <span>{{ $internship->category->name[app()->getLocale()] ?? '' }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <p class="card-description">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($internship->description[app()->getLocale()] ?? ''), 100) }}
                                        </p>
                                        
                                        <a href="{{ route('internships.show', $internship->slug) }}" class="card-link">
                                            @if(app()->getLocale() == 'fr')
                                                Voir les détails
                                            @else
                                                View details
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
                    
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            
            <div class="section-cta">
                <a href="{{ route('internships.index') }}" class="btn-secondary">
                    @if(app()->getLocale() == 'fr')
                        Voir tous les stages
                    @else
                        View all internships
                    @endif
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <p>
                    @if(app()->getLocale() == 'fr')
                        Aucun stage disponible pour le moment.
                    @else
                        No internships available at the moment.
                    @endif
                </p>
            </div>
        @endif
    </section>

    <!-- Services Section -->
    <section class="section services-section">
        <div class="section-header">
            <div class="section-badge">
                <span class="badge-icon">⭐</span>
                <span>
                    @if(app()->getLocale() == 'fr')
                        Services premium
                    @else
                        Premium services
                    @endif
                </span>
            </div>
            <h2 class="section-title">
                @if(app()->getLocale() == 'fr')
                    Nos Services
                @else
                    Our Services
                @endif
            </h2>
            <p class="section-subtitle">
                @if(app()->getLocale() == 'fr')
                    Un accompagnement complet pour votre expérience internationale
                @else
                    Complete support for your international experience
                @endif
            </p>
        </div>

        <div class="services-grid">
            <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                <div class="service-icon">🔍</div>
                <h3 class="service-title">
                    @if(app()->getLocale() == 'fr')
                        Recherche de Stage
                    @else
                        Internship Search
                    @endif
                </h3>
                <p class="service-description">
                    @if(app()->getLocale() == 'fr')
                        Trouvez le stage parfait correspondant à vos compétences et objectifs de carrière.
                    @else
                        Find the perfect internship matching your skills and career goals.
                    @endif
                </p>
                <a href="{{ route('services.internship-search') }}" class="service-link">
                    @if(app()->getLocale() == 'fr')
                        En savoir plus
                    @else
                        Learn more
                    @endif
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                <div class="service-icon">🏠</div>
                <h3 class="service-title">
                    @if(app()->getLocale() == 'fr')
                        Logement
                    @else
                        Housing
                    @endif
                </h3>
                <p class="service-description">
                    @if(app()->getLocale() == 'fr')
                        Des options de logement sûres et abordables pendant votre stage à l'étranger.
                    @else
                        Safe and affordable housing options during your internship abroad.
                    @endif
                </p>
                <a href="{{ route('services.housing') }}" class="service-link">
                    @if(app()->getLocale() == 'fr')
                        En savoir plus
                    @else
                        Learn more
                    @endif
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                <div class="service-icon">✈️</div>
                <h3 class="service-title">
                    @if(app()->getLocale() == 'fr')
                        Transport Aéroport
                    @else
                        Airport Pickup
                    @endif
                </h3>
                <p class="service-description">
                    @if(app()->getLocale() == 'fr')
                        Arrivez en toute sécurité avec notre service de transport depuis l'aéroport.
                    @else
                        Arrive safely with our airport pickup service.
                    @endif
                </p>
                <a href="{{ route('services.airport-pickup') }}" class="service-link">
                    @if(app()->getLocale() == 'fr')
                        En savoir plus
                    @else
                        Learn more
                    @endif
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Articles de blog récents -->
    @if(isset($blogs) && count($blogs))
        <section class="section blog-section">
            <div class="section-header">
                <div class="section-badge">
                    <span class="badge-icon">📝</span>
                    <span>
                        @if(app()->getLocale() == 'fr')
                            Conseils et guides
                        @else
                            Tips and guides
                        @endif
                    </span>
                </div>
                <h2 class="section-title">
                    @if(app()->getLocale() == 'fr')
                        Articles Récents
                    @else
                        Recent Articles
                    @endif
                </h2>
                <p class="section-subtitle">
                    @if(app()->getLocale() == 'fr')
                        Conseils d'experts pour réussir votre stage international
                    @else
                        Expert tips to succeed in your international internship
                    @endif
                </p>
            </div>

            <div class="blog-grid">
                @foreach ($blogs as $blog)
                    <article class="blog-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @if($blog->image)
                            <div class="blog-image">
                                <img src="{{ asset('storage/' . $blog->image) }}" 
                                     alt="{{ $blog->title[app()->getLocale()] ?? '' }}">
                                <div class="image-overlay"></div>
                            </div>
                        @endif
                        
                        <div class="blog-content">
                            @if($blog->published_at)
                                <div class="blog-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8" y1="2" x2="8" y2="6"/>
                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                    </svg>
                                    <span>{{ $blog->published_at->format('d/m/Y') }}</span>
                                </div>
                            @endif
                            
                            <h3 class="blog-title">{{ $blog->title[app()->getLocale()] ?? '' }}</h3>
                            
                            <p class="blog-excerpt">
                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->content[app()->getLocale()] ?? ''), 120) }}
                            </p>
                            
                            <a href="{{ route('blog.show', $blog->slug) }}" class="blog-link">
                                @if(app()->getLocale() == 'fr')
                                    Lire l'article
                                @else
                                    Read article
                                @endif
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
            
            <div class="section-cta">
                <a href="{{ route('blog.index') }}" class="btn-secondary">
                    @if(app()->getLocale() == 'fr')
                        Voir tous les articles
                    @else
                        View all articles
                    @endif
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
            </div>
        </section>
    @endif

    <!-- Nos partenaires -->
    @if(isset($partners) && count($partners))
        <section class="section partners-section">
            <div class="section-header">
                <div class="section-badge">
                    <span class="badge-icon">🤝</span>
                    <span>
                        @if(app()->getLocale() == 'fr')
                            Écosystème de confiance
                        @else
                            Trusted ecosystem
                        @endif
                    </span>
                </div>
                <h2 class="section-title">
                    @if(app()->getLocale() == 'fr')
                        Nos Partenaires
                    @else
                        Our Partners
                    @endif
                </h2>
                <p class="section-subtitle">
                    @if(app()->getLocale() == 'fr')
                        Entreprises de confiance qui font grandir votre carrière
                    @else
                        Trusted companies that grow your career
                    @endif
                </p>
            </div>

            <div class="partners-carousel">
                <div class="partners-track">
                    @foreach ($partners as $partner)
                        <div class="partner-item">
                            @if($partner->logo)
                                <a href="{{ $partner->website_url ?? '#' }}" target="_blank" class="partner-link">
                                    <img src="{{ asset('storage/' . $partner->logo) }}" 
                                         alt="{{ $partner->name[app()->getLocale()] ?? '' }}" 
                                         class="partner-logo">
                                </a>
                            @else
                                <a href="{{ $partner->website_url ?? '#' }}" target="_blank" class="partner-link partner-text">
                                    {{ $partner->name[app()->getLocale()] ?? '' }}
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA finale -->
    <section class="cta-section">
        <div class="cta-content">
            <div class="cta-badge">
                <span class="badge-icon">🚀</span>
                <span>
                    @if(app()->getLocale() == 'fr')
                        Lancez votre carrière
                    @else
                        Launch your career
                    @endif
                </span>
            </div>
            
            <h2 class="cta-title">
                @if(app()->getLocale() == 'fr')
                    Prêt à commencer votre <span class="gradient-text">aventure internationale</span> ?
                @else
                    Ready to start your <span class="gradient-text">international adventure</span>?
                @endif
            </h2>
            
            <p class="cta-subtitle">
                @if(app()->getLocale() == 'fr')
                    Rejoignez des milliers d'étudiants qui ont transformé leur carrière grâce à nos stages internationaux.
                @else
                    Join thousands of students who have transformed their careers through our international internships.
                @endif
            </p>
            
            <div class="cta-buttons">
                <a href="{{ route('internships.index') }}" class="btn-primary">
                    @if(app()->getLocale() == 'fr')
                        Explorer les Opportunités
                    @else
                        Explore Opportunities
                    @endif
                </a>
                <a href="{{ route('contact.index') }}" class="btn-outline">
                    @if(app()->getLocale() == 'fr')
                        Nous Contacter
                    @else
                        Contact Us
                    @endif
                </a>
            </div>
        </div>
        
        <!-- Background decoration -->
        <div class="cta-decoration">
            <div class="decoration-element" style="top: 10%; left: 10%;">💼</div>
            <div class="decoration-element" style="top: 20%; right: 10%;">🌍</div>
            <div class="decoration-element" style="bottom: 20%; left: 15%;">🎓</div>
            <div class="decoration-element" style="bottom: 10%; right: 20%;">✨</div>
        </div>
    </section>
</div>

<style>
/* Variables CSS */
:root {
    --primary-color: #667eea;
    --secondary-color: #764ba2;
    --accent-color: #f093fb;
    --success-color: #4ade80;
    --warning-color: #fbbf24;
    --danger-color: #ef4444;
    --text-primary: #1f2937;
    --text-secondary: #6b7280;
    --text-light: #9ca3af;
    --background: #ffffff;
    --surface: #f9fafb;
    --border: #e5e7eb;
    --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    --radius: 12px;
    --radius-lg: 20px;
}

.homepage-container {
    min-height: 100vh;
}

/* Hero Section */
.hero-section {
    position: relative;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    z-index: 1;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.8) 0%, rgba(118, 75, 162, 0.8) 100%);
    z-index: 2;
}

.hero-content {
    position: relative;
    z-index: 3;
    text-align: center;
    color: white;
    max-width: 900px;
    padding: 2rem;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.9rem;
    margin-bottom: 2rem;
    animation: fadeInUp 0.8s ease-out;
}

.badge-icon {
    font-size: 1.2rem;
}

.hero-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 700;
    line-height: 1.1;
    margin-bottom: 1.5rem;
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.gradient-text {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

.hero-subtitle {
    font-size: 1.25rem;
    line-height: 1.6;
    opacity: 0.95;
    margin-bottom: 3rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

/* Hero Search */
.hero-search {
    margin-bottom: 3rem;
    animation: fadeInUp 0.8s ease-out 0.6s both;
}

.search-container {
    display: flex;
    max-width: 600px;
    margin: 0 auto;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: var(--radius-lg);
    padding: 0.75rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.search-input-group {
    flex: 1;
    position: relative;
    display: flex;
    align-items: center;
}

.search-icon {
    position: absolute;
    left: 1rem;
    color: rgba(255, 255, 255, 0.7);
}

.search-input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: none;
    background: transparent;
    color: white;
    font-size: 1rem;
    outline: none;
}

.search-input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.search-button {
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(240, 147, 251, 0.4);
}

/* Hero Stats */
.hero-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 2rem;
    animation: fadeInUp 0.8s ease-out 0.8s both;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Floating Elements */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 2;
}

.floating-element {
    position: absolute;
    font-size: 2rem;
    opacity: 0.3;
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(10deg); }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Section Base */
.section {
    padding: 6rem 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.section-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1rem;
    line-height: 1.2;
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.section-cta {
    text-align: center;
    margin-top: 3rem;
}

/* Internships Section */
.internships-section {
    background: var(--surface);
}

.internships-carousel {
    margin-bottom: 2rem;
}

.swiper {
    padding-bottom: 3rem;
}

.internship-card {
    background: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.internship-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.card-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.internship-card:hover .card-image img {
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

.card-image.no-image {
    background: linear-gradient(135deg, var(--surface) 0%, #e5e7eb 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.no-image-placeholder {
    color: var(--text-light);
}

.card-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    z-index: 2;
}

.badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge.new {
    background: linear-gradient(135deg, var(--success-color) 0%, #10b981 100%);
    color: white;
}

.card-content {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.card-header {
    margin-bottom: 1rem;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    line-height: 1.3;
}

.card-company {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin: 0;
}

.card-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.meta-item svg {
    color: var(--primary-color);
    flex-shrink: 0;
}

.card-description {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 1.5rem;
    flex: 1;
}

.card-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    margin-top: auto;
}

.card-link:hover {
    gap: 0.75rem;
    color: var(--secondary-color);
}

/* Services Section */
.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.service-card {
    background: white;
    padding: 2.5rem;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
    text-align: center;
    transition: all 0.3s ease;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.service-icon {
    font-size: 3rem;
    margin-bottom: 1.5rem;
}

.service-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.service-description {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.service-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.service-link:hover {
    gap: 0.75rem;
}

/* Blog Section */
.blog-section {
    background: var(--surface);
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.blog-card {
    background: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
    transition: all 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.blog-image {
    position: relative;
    height: 200px;
    overflow: hidden;
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

.blog-content {
    padding: 1.5rem;
}

.blog-date {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-light);
    font-size: 0.85rem;
    margin-bottom: 1rem;
}

.blog-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 1rem;
    line-height: 1.3;
}

.blog-excerpt {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.blog-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.blog-link:hover {
    gap: 0.75rem;
}

/* Partners Section */
.partners-carousel {
    overflow: hidden;
    mask-image: linear-gradient(90deg, transparent, black 20%, black 80%, transparent);
}

.partners-track {
    display: flex;
    gap: 3rem;
    animation: scroll 30s linear infinite;
}

.partner-item {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.partner-logo {
    max-height: 60px;
    max-width: 150px;
    opacity: 0.7;
    transition: opacity 0.3s ease;
    filter: grayscale(100%);
}

.partner-link:hover .partner-logo {
    opacity: 1;
    filter: grayscale(0%);
}

.partner-text {
    color: var(--text-secondary);
    font-weight: 600;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.partner-text:hover {
    opacity: 1;
    color: var(--primary-color);
}

@keyframes scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* CTA Section */
.cta-section {
    position: relative;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    text-align: center;
    padding: 6rem 2rem;
    margin: 0 2rem;
    border-radius: var(--radius-lg);
    overflow: hidden;
}

.cta-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
}

.cta-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.9rem;
    margin-bottom: 2rem;
}

.cta-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.cta-subtitle {
    font-size: 1.1rem;
    opacity: 0.95;
    margin-bottom: 2.5rem;
    line-height: 1.6;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.cta-decoration {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.decoration-element {
    position: absolute;
    font-size: 2rem;
    opacity: 0.2;
    animation: float 8s ease-in-out infinite;
}

.decoration-element:nth-child(2) { animation-delay: 2s; }
.decoration-element:nth-child(3) { animation-delay: 4s; }
.decoration-element:nth-child(4) { animation-delay: 6s; }

/* Buttons */
.btn-primary,
.btn-secondary,
.btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    border-radius: var(--radius);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}

.btn-primary {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(240, 147, 251, 0.4);
}

.btn-secondary {
    background: var(--surface);
    color: var(--primary-color);
    border: 1px solid var(--border);
}

.btn-secondary:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}

.btn-outline {
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.btn-outline:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.5);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--text-secondary);
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

/* Swiper Customization */
.swiper-pagination-bullet {
    background: var(--primary-color);
    opacity: 0.3;
}

.swiper-pagination-bullet-active {
    opacity: 1;
    background: var(--primary-color);
}

.swiper-button-next,
.swiper-button-prev {
    color: var(--primary-color);
    background: white;
    border-radius: 50%;
    width: 44px;
    height: 44px;
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 18px;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
    background: var(--primary-color);
    color: white;
}

/* Responsive */
@media (max-width: 1024px) {
    .section {
        padding: 4rem 1.5rem;
    }
    
    .hero-content {
        padding: 1.5rem;
    }
    
    .search-container {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
}

@media (max-width: 768px) {
    .section {
        padding: 3rem 1rem;
    }
    
    .hero-content {
        padding: 1rem;
    }
    
    .hero-stats {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    
    .services-grid,
    .blog-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .partners-track {
        gap: 2rem;
    }
    
    .cta-section {
        margin: 0 1rem;
        padding: 4rem 1.5rem;
    }
}

@media (max-width: 480px) {
    .hero-stats {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .service-card,
    .blog-card {
        margin: 0 0.5rem;
    }
}

/* AOS Animation Support */
[data-aos] {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

[data-aos].aos-animate {
    opacity: 1;
    transform: translateY(0);
}
</style>

@push('scripts')
<script>
// Swiper Initialization
const swiper = new Swiper('.mySwiper', {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
    },
});

// Simple AOS-like animation
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('aos-animate');
            }
        });
    }, observerOptions);

    // Observe all elements with data-aos attribute
    document.querySelectorAll('[data-aos]').forEach(el => {
        observer.observe(el);
    });

    // Parallax effect for hero background
    const heroBackground = document.querySelector('.hero-background');
    if (heroBackground) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            heroBackground.style.transform = `translate3d(0, ${rate}px, 0)`;
        });
    }

    // Counter animation for hero stats
    const animateCounter = (element, target, duration = 2000) => {
        let start = 0;
        const increment = target / (duration / 16);
        
        const timer = setInterval(() => {
            start += increment;
            if (start >= target) {
                element.textContent = target + (element.textContent.includes('%') ? '%' : '+');
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(start) + (element.textContent.includes('%') ? '%' : '+');
            }
        }, 16);
    };

    // Animate counters when hero section is visible
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        const heroObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const statNumbers = document.querySelectorAll('.stat-number');
                    statNumbers.forEach(stat => {
                        const text = stat.textContent;
                        const isPercentage = text.includes('%');
                        const number = parseInt(text.replace(/[^\d]/g, ''));
                        
                        if (number) {
                            stat.textContent = '0' + (isPercentage ? '%' : '+');
                            setTimeout(() => {
                                animateCounter(stat, number);
                            }, 500);
                        }
                    });
                    heroObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        heroObserver.observe(heroSection);
    }
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
</script>
@endpush

@endsection