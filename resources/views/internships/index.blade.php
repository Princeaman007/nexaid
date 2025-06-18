@extends('layouts.app')

@section('content')
<div class="internships-container">
    <!-- Hero Section -->
    <div class="internships-hero">
        <div class="hero-content">
            <h1 class="hero-title">
                @if(app()->getLocale() == 'fr')
                    Découvrez nos Opportunités de Stage
                @else
                    Discover Our Internship Opportunities
                @endif
            </h1>
            <p class="hero-subtitle">
                @if(app()->getLocale() == 'fr')
                    Trouvez le stage parfait pour lancer votre carrière professionnelle
                @else
                    Find the perfect internship to launch your professional career
                @endif
            </p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $internships->total() }}</span>
                    <span class="stat-label">
                        @if(app()->getLocale() == 'fr')
                            Stages disponibles
                        @else
                            Available internships
                        @endif
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $categories->count() }}</span>
                    <span class="stat-label">
                        @if(app()->getLocale() == 'fr')
                            Domaines
                        @else
                            Fields
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
        <div class="hero-decoration">
            <svg width="200" height="200" viewBox="0 0 200 200" class="floating-icon">
                <circle cx="100" cy="100" r="80" fill="rgba(255,255,255,0.1)" />
                <path d="M60 80h80v40H60z" fill="rgba(255,255,255,0.2)" />
                <circle cx="80" cy="100" r="8" fill="rgba(255,255,255,0.3)" />
                <circle cx="120" cy="100" r="8" fill="rgba(255,255,255,0.3)" />
            </svg>
        </div>
    </div>

    @if(session('locale_set'))
        <div class="alert-success">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20,6 9,17 4,12"/>
            </svg>
            <span>Langue bien changée en : {{ session('locale_set') }}</span>
        </div>
    @endif

    <!-- Filtres avancés -->
    <div class="filters-section">
        <div class="filters-header">
            <h2 class="filters-title">
                @if(app()->getLocale() == 'fr')
                    Affinez votre recherche
                @else
                    Refine your search
                @endif
            </h2>
            <button class="filters-toggle" onclick="toggleFilters()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46"/>
                </svg>
                <span>
                    @if(app()->getLocale() == 'fr')
                        Filtres
                    @else
                        Filters
                    @endif
                </span>
            </button>
        </div>

        <div class="filters-content" id="filtersContent">
            <form action="{{ route('internships.index') }}" method="GET" class="filters-form">
                <div class="filters-grid">
                    <!-- Catégorie -->
                    <div class="filter-group">
                        <label for="category" class="filter-label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            @if(app()->getLocale() == 'fr')
                                Catégorie
                            @else
                                Category
                            @endif
                        </label>
                        <select name="category" id="category" class="filter-select">
                            <option value="">
                                @if(app()->getLocale() == 'fr')
                                    Toutes les catégories
                                @else
                                    All categories
                                @endif
                            </option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->getTranslation('name', app()->getLocale()) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Lieu -->
                    <div class="filter-group">
                        <label for="location" class="filter-label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            @if(app()->getLocale() == 'fr')
                                Lieu
                            @else
                                Location
                            @endif
                        </label>
                        <input type="text" name="location" id="location" value="{{ request('location') }}" 
                               class="filter-input" placeholder="@if(app()->getLocale() == 'fr')Paris, Lyon, Remote...@elseParis, Lyon, Remote...@endif">
                    </div>

                    <!-- Mot-clé -->
                    <div class="filter-group">
                        <label for="keyword" class="filter-label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.35-4.35"/>
                            </svg>
                            @if(app()->getLocale() == 'fr')
                                Mot-clé
                            @else
                                Keyword
                            @endif
                        </label>
                        <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}" 
                               class="filter-input" placeholder="@if(app()->getLocale() == 'fr')Développement, Marketing...@elseDevelopment, Marketing...@endif">
                    </div>

                    <!-- Date de début -->
                    <div class="filter-group">
                        <label for="start_date" class="filter-label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            @if(app()->getLocale() == 'fr')
                                Début après
                            @else
                                Start after
                            @endif
                        </label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" 
                               class="filter-input">
                    </div>

                    <!-- Tri -->
                    <div class="filter-group">
                        <label for="sort" class="filter-label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 6h18M7 12h10m-7 6h4"/>
                            </svg>
                            @if(app()->getLocale() == 'fr')
                                Trier par
                            @else
                                Sort by
                            @endif
                        </label>
                        <select name="sort" id="sort" class="filter-select">
                            <option value="">
                                @if(app()->getLocale() == 'fr')
                                    Par défaut
                                @else
                                    Default
                                @endif
                            </option>
                            <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>
                                @if(app()->getLocale() == 'fr')
                                    Plus récents
                                @else
                                    Newest
                                @endif
                            </option>
                            <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>
                                @if(app()->getLocale() == 'fr')
                                    Plus anciens
                                @else
                                    Oldest
                                @endif
                            </option>
                            <option value="duration_asc" {{ request('sort') == 'duration_asc' ? 'selected' : '' }}>
                                @if(app()->getLocale() == 'fr')
                                    Durée la plus courte
                                @else
                                    Shortest duration
                                @endif
                            </option>
                        </select>
                    </div>

                    <!-- Durée -->
                    <div class="filter-group">
                        <label for="duration" class="filter-label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12,6 12,12 16,14"/>
                            </svg>
                            @if(app()->getLocale() == 'fr')
                                Durée
                            @else
                                Duration
                            @endif
                        </label>
                        <select name="duration" id="duration" class="filter-select">
                            <option value="">
                                @if(app()->getLocale() == 'fr')
                                    Toutes durées
                                @else
                                    All durations
                                @endif
                            </option>
                            <option value="1-3" {{ request('duration') == '1-3' ? 'selected' : '' }}>1-3 mois</option>
                            <option value="3-6" {{ request('duration') == '3-6' ? 'selected' : '' }}>3-6 mois</option>
                            <option value="6+" {{ request('duration') == '6+' ? 'selected' : '' }}>6+ mois</option>
                        </select>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="filters-actions">
                    <button type="submit" class="btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                        @if(app()->getLocale() == 'fr')
                            Rechercher
                        @else
                            Search
                        @endif
                    </button>
                    <a href="{{ route('internships.index') }}" class="btn-secondary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 6h18M7 12h10m-7 6h4"/>
                        </svg>
                        @if(app()->getLocale() == 'fr')
                            Réinitialiser
                        @else
                            Reset
                        @endif
                    </a>
                </div>
            </form>
        </div>
    </div>

    @if($internships->count())
        <!-- Résultats header -->
        <div class="results-header">
            <div class="results-info">
                <h3 class="results-count">
                    {{ $internships->total() }}
                    @if(app()->getLocale() == 'fr')
                        stage{{ $internships->total() > 1 ? 's' : '' }} trouvé{{ $internships->total() > 1 ? 's' : '' }}
                    @else
                        internship{{ $internships->total() > 1 ? 's' : '' }} found
                    @endif
                </h3>
                <p class="results-description">
                    @if(app()->getLocale() == 'fr')
                        Explorez nos opportunités et postulez dès maintenant
                    @else
                        Explore our opportunities and apply now
                    @endif
                </p>
            </div>
            <div class="view-toggle">
                <button class="view-btn active" data-view="grid">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>
                </button>
                <button class="view-btn" data-view="list">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="8" y1="6" x2="21" y2="6"/>
                        <line x1="8" y1="12" x2="21" y2="12"/>
                        <line x1="8" y1="18" x2="21" y2="18"/>
                        <line x1="3" y1="6" x2="3.01" y2="6"/>
                        <line x1="3" y1="12" x2="3.01" y2="12"/>
                        <line x1="3" y1="18" x2="3.01" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Liste des stages -->
        <div class="internships-grid" id="internshipsGrid">
            @foreach ($internships as $internship)
                <div class="internship-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    @if($internship->image)
                        <div class="card-image">
                            <img src="{{ asset('storage/' . $internship->image) }}" 
                                 alt="{{ $internship->getTranslation('title', app()->getLocale()) }}"
                                 loading="lazy">
                            <div class="image-overlay"></div>
                        </div>
                    @else
                        <div class="card-image card-no-image">
                            <div class="no-image-placeholder">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21,15 16,10 5,21"/>
                                </svg>
                            </div>
                        </div>
                    @endif

                    <div class="card-content">
                        <div class="card-header">
                            <div class="card-badges">
                                @if(\Carbon\Carbon::parse($internship->created_at)->gt(now()->subDays(7)))
                                    <span class="badge badge-new">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
                                        </svg>
                                        @if(app()->getLocale() == 'fr')
                                            Nouveau
                                        @else
                                            New
                                        @endif
                                    </span>
                                @endif
                                
                                @if($internship->category)
                                    <span class="badge badge-category">
                                        {{ $internship->category->getTranslation('name', app()->getLocale()) }}
                                    </span>
                                @endif
                            </div>

                            <h3 class="card-title">
                                <a href="{{ route('internships.show', $internship->slug) }}">
                                    {{ $internship->getTranslation('title', app()->getLocale()) }}
                                </a>
                            </h3>
                        </div>

                        <div class="card-meta">
                            @if($internship->company)
                                <div class="meta-item">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 21h18"/>
                                        <path d="M5 21V7l8-4v18"/>
                                        <path d="M19 21V11l-6-4"/>
                                    </svg>
                                    <span>{{ $internship->company->name }}</span>
                                </div>
                            @endif

                            @if($internship->location)
                                <div class="meta-item">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                        <circle cx="12" cy="10" r="3"/>
                                    </svg>
                                    <span>{{ $internship->location }}</span>
                                </div>
                            @endif

                            @if($internship->duration)
                                <div class="meta-item">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12,6 12,12 16,14"/>
                                    </svg>
                                    <span>{{ $internship->duration }}</span>
                                </div>
                            @endif
                        </div>

                        @if($internship->start_date && $internship->end_date)
                            <div class="card-dates">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                <span>
                                    @if(app()->getLocale() == 'fr')
                                        Du {{ \Carbon\Carbon::parse($internship->start_date)->translatedFormat('d M Y') }}
                                        au {{ \Carbon\Carbon::parse($internship->end_date)->translatedFormat('d M Y') }}
                                    @else
                                        From {{ \Carbon\Carbon::parse($internship->start_date)->translatedFormat('M d, Y') }}
                                        to {{ \Carbon\Carbon::parse($internship->end_date)->translatedFormat('M d, Y') }}
                                    @endif
                                </span>
                            </div>
                        @endif

                        <p class="card-description">
                            {{ \Illuminate\Support\Str::limit(strip_tags($internship->getTranslation('description', app()->getLocale())), 120) }}
                        </p>

                        @if($internship->skills && (is_array($internship->skills) ? count($internship->skills) > 0 : $internship->skills))
                            <div class="card-skills">
                                @php
                                    $skills = is_array($internship->skills) ? $internship->skills : explode(',', $internship->skills);
                                    $displaySkills = array_slice($skills, 0, 3);
                                    $remainingCount = count($skills) - 3;
                                @endphp
                                @foreach($displaySkills as $skill)
                                    <span class="skill-tag">{{ trim($skill) }}</span>
                                @endforeach
                                @if($remainingCount > 0)
                                    <span class="skill-tag skill-more">+{{ $remainingCount }}</span>
                                @endif
                            </div>
                        @endif

                        <div class="card-footer">
                            <div class="card-date">
                                @if(app()->getLocale() == 'fr')
                                    Publié le {{ \Carbon\Carbon::parse($internship->created_at)->translatedFormat('d M Y') }}
                                @else
                                    Published on {{ \Carbon\Carbon::parse($internship->created_at)->translatedFormat('M d, Y') }}
                                @endif
                            </div>
                            <a href="{{ route('internships.show', $internship->slug) }}" class="btn-details">
                                @if(app()->getLocale() == 'fr')
                                    Voir détails
                                @else
                                    View details
                                @endif
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $internships->appends(request()->query())->links() }}
        </div>
    @else
        <div class="no-results">
            <div class="no-results-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
            </div>
            <h3 class="no-results-title">
                @if(app()->getLocale() == 'fr')
                    Aucun stage trouvé
                @else
                    No internships found
                @endif
            </h3>
            <p class="no-results-text">
                @if(app()->getLocale() == 'fr')
                    Essayez de modifier vos critères de recherche ou consultez toutes nos offres
                @else
                    Try modifying your search criteria or browse all our offers
                @endif
            </p>
            <a href="{{ route('internships.index') }}" class="btn-primary">
                @if(app()->getLocale() == 'fr')
                    Voir tous les stages
                @else
                    View all internships
                @endif
            </a>
        </div>
    @endif
</div>

<style>
.internships-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.internships-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 24px;
    padding: 4rem 2rem;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
    text-align: center;
}

.internships-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: heroFloat 8s ease-in-out infinite;
}

@keyframes heroFloat {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-30px) rotate(10deg); }
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.3rem;
    opacity: 0.9;
    margin-bottom: 3rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.hero-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 2rem;
    max-width: 600px;
    margin: 0 auto;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.hero-decoration {
    position: absolute;
    top: 50%;
    right: 2rem;
    transform: translateY(-50%);
    opacity: 0.3;
}

.floating-icon {
    animation: floatRotate 6s ease-in-out infinite;
}

@keyframes floatRotate {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.alert-success {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    border: 1px solid #c3e6cb;
    margin-bottom: 2rem;
    font-weight: 500;
}

.filters-section {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
    margin-bottom: 3rem;
    overflow: hidden;
}

.filters-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem;
    border-bottom: 1px solid #f0f0f0;
}

.filters-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
}

.filters-toggle {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filters-toggle:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.filters-content {
    padding: 2rem;
}

.filters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.filter-input,
.filter-select {
    padding: 0.75rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: white;
}

.filter-input:focus,
.filter-select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.filters-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-primary,
.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 0.95rem;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-secondary {
    background: #f8f9fa;
    color: #6c757d;
    border: 1px solid #dee2e6;
}

.btn-secondary:hover {
    background: #e9ecef;
    color: #495057;
}

.results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding: 1.5rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.results-count {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
}

.results-description {
    color: #6c757d;
    margin: 0;
}

.view-toggle {
    display: flex;
    gap: 0.5rem;
}

.view-btn {
    width: 40px;
    height: 40px;
    border: 1px solid #dee2e6;
    background: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #6c757d;
}

.view-btn:hover,
.view-btn.active {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.internships-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.internship-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
    transition: all 0.3s ease;
    height: fit-content;
}

.internship-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}

.card-image {
    height: 200px;
    overflow: hidden;
    position: relative;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
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

.card-no-image {
    display: flex;
    align-items: center;
    justify-content: center;
}

.no-image-placeholder {
    color: #adb5bd;
}

.card-content {
    padding: 1.5rem;
}

.card-header {
    margin-bottom: 1rem;
}

.card-badges {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.badge {
    font-size: 0.75rem;
    font-weight: 500;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.badge-new {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.badge-category {
    background: #f8f9fa;
    color: #495057;
    border: 1px solid #dee2e6;
}

.card-title {
    margin: 0;
    font-size: 1.25rem;
    line-height: 1.3;
}

.card-title a {
    color: #2c3e50;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.card-title a:hover {
    color: #667eea;
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
    color: #6c757d;
}

.meta-item svg {
    color: #667eea;
    flex-shrink: 0;
}

.card-dates {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: #6c757d;
    margin-bottom: 1rem;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.card-dates svg {
    color: #667eea;
    flex-shrink: 0;
}

.card-description {
    color: #495057;
    line-height: 1.6;
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.card-skills {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
}

.skill-tag {
    font-size: 0.75rem;
    background: #e3f2fd;
    color: #1565c0;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-weight: 500;
}

.skill-more {
    background: #f5f5f5;
    color: #666;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #f0f0f0;
}

.card-date {
    font-size: 0.8rem;
    color: #6c757d;
}

.btn-details {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-details:hover {
    transform: translateX(3px);
    box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
}

.no-results {
    text-align: center;
    padding: 4rem 2rem;
    color: #6c757d;
}

.no-results-icon {
    margin-bottom: 2rem;
    color: #adb5bd;
}

.no-results-title {
    font-size: 1.5rem;
    color: #495057;
    margin-bottom: 1rem;
}

.no-results-text {
    font-size: 1.1rem;
    max-width: 500px;
    margin: 0 auto 2rem;
    line-height: 1.6;
}

/* Responsive */
@media (max-width: 1024px) {
    .internships-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }
    
    .hero-decoration {
        display: none;
    }
}

@media (max-width: 768px) {
    .internships-container {
        padding: 1rem;
    }
    
    .internships-hero {
        padding: 3rem 1.5rem;
    }
    
    .hero-title {
        font-size: 2.2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .hero-stats {
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .filters-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .filters-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .filters-actions {
        flex-direction: column;
    }
    
    .results-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .internships-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .card-footer {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .btn-details {
        align-self: stretch;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .hero-stats {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .card-content {
        padding: 1.25rem;
    }
    
    .card-meta {
        gap: 0.75rem;
    }
}

/* Animation pour les cards */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.internship-card {
    animation: fadeUp 0.6s ease-out;
}

/* Mode liste (optionnel) */
.internships-grid.list-view {
    grid-template-columns: 1fr;
}

.internships-grid.list-view .internship-card {
    display: flex;
    flex-direction: row;
}

.internships-grid.list-view .card-image {
    width: 200px;
    height: auto;
    flex-shrink: 0;
}

.internships-grid.list-view .card-content {
    flex: 1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle filters
    const filtersToggle = document.querySelector('.filters-toggle');
    const filtersContent = document.getElementById('filtersContent');
    
    if (filtersToggle && filtersContent) {
        filtersToggle.addEventListener('click', function() {
            filtersContent.style.display = filtersContent.style.display === 'none' ? 'block' : 'none';
        });
    }
    
    // View toggle
    const viewBtns = document.querySelectorAll('.view-btn');
    const internshipsGrid = document.getElementById('internshipsGrid');
    
    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            viewBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const view = this.dataset.view;
            if (view === 'list') {
                internshipsGrid.classList.add('list-view');
            } else {
                internshipsGrid.classList.remove('list-view');
            }
        });
    });
    
    // Auto-submit form on filter change (optionnel)
    const filterInputs = document.querySelectorAll('.filter-select, .filter-input');
    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Optionnel : auto-submit le formulaire
            // this.form.submit();
        });
    });
});

function toggleFilters() {
    const filtersContent = document.getElementById('filtersContent');
    const isVisible = filtersContent.style.display !== 'none';
    filtersContent.style.display = isVisible ? 'none' : 'block';
}
</script>
@endsection