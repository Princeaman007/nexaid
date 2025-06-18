@extends('layouts.app')

@section('content')
<div class="internship-detail-container">
    <!-- Hero Section -->
    <div class="internship-hero">
        <div class="hero-overlay"></div>
        @if($internship->image)
            <div class="hero-background" style="background-image: url('{{ asset('storage/' . $internship->image) }}')"></div>
        @else
            <div class="hero-background hero-gradient"></div>
        @endif
        
        <div class="hero-content">
            <nav class="breadcrumb">
                <a href="{{ route('internships.index') }}" class="breadcrumb-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                    @if(app()->getLocale() == 'fr')
                        Retour à la liste
                    @else
                        Back to list
                    @endif
                </a>
            </nav>

            <div class="hero-main">
                <div class="hero-badges">
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

                    @if($internship->remote_option)
                        <span class="badge badge-remote">
                            {{ $internship->remote_option }}
                        </span>
                    @endif
                </div>

                <h1 class="hero-title">
                    {{ $internship->getTranslation('title', app()->getLocale()) }}
                </h1>

                <div class="hero-meta">
                    @if($internship->company_name)
                        <div class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 21h18"/>
                                <path d="M5 21V7l8-4v18"/>
                                <path d="M19 21V11l-6-4"/>
                            </svg>
                            <span>{{ $internship->company_name }}</span>
                        </div>
                    @endif

                    @if($internship->location)
                        <div class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <span>{{ $internship->location }}</span>
                        </div>
                    @endif

                    @if($internship->duration)
                        <div class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12,6 12,12 16,14"/>
                            </svg>
                            <span>{{ $internship->duration }}</span>
                        </div>
                    @endif

                    @if($internship->application_deadline)
                        <div class="meta-item {{ $internship->isExpired() ? 'expired' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <span>
                                @if(app()->getLocale() == 'fr')
                                    Échéance: 
                                @else
                                    Deadline: 
                                @endif
                                @if(is_string($internship->application_deadline))
                                    {{ $internship->application_deadline }}
                                @else
                                    {{ $internship->application_deadline->format('d M Y') }}
                                @endif
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="internship-content">
        <div class="content-main">
            <!-- About Company -->
            @if($internship->company_description)
                <section class="content-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 21h18"/>
                                <path d="M5 21V7l8-4v18"/>
                                <path d="M19 21V11l-6-4"/>
                            </svg>
                        </div>
                        <h2 class="section-title">
                            @if(app()->getLocale() == 'fr')
                                À propos de {{ $internship->company_name }}
                            @else
                                About {{ $internship->company_name }}
                            @endif
                        </h2>
                    </div>
                    <div class="section-content company-description">
                        {!! $internship->getTranslation('company_description', app()->getLocale()) !!}
                    </div>
                </section>
            @endif

            <!-- Job Description -->
            <section class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14,2 14,8 20,8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10,9 9,9 8,9"/>
                        </svg>
                    </div>
                    <h2 class="section-title">
                        @if(app()->getLocale() == 'fr')
                            Description du poste
                        @else
                            Job Description
                        @endif
                    </h2>
                </div>
                <div class="section-content">
                    {!! $internship->getTranslation('description', app()->getLocale()) !!}
                </div>
            </section>

            <!-- Main Responsibilities -->
            @if($internship->main_responsibilities && is_array($internship->getTranslation('main_responsibilities', app()->getLocale())))
                <section class="content-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9,11 12,14 22,4"/>
                                <path d="M21,12v7a2,2,0,0,1-2,2H5a2,2,0,0,1-2-2V5A2,2,0,0,1,5,3H16"/>
                            </svg>
                        </div>
                        <h2 class="section-title">
                            @if(app()->getLocale() == 'fr')
                                Missions principales
                            @else
                                Main Responsibilities
                            @endif
                        </h2>
                    </div>
                    <div class="section-content">
                        <ul class="styled-list">
                            @foreach($internship->getTranslation('main_responsibilities', app()->getLocale()) as $responsibility)
                                @if(isset($responsibility['responsibility']))
                                    <li>{{ $responsibility['responsibility'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </section>
            @endif

            <!-- Learning Outcomes -->
            @if($internship->learning_outcomes && is_array($internship->getTranslation('learning_outcomes', app()->getLocale())))
                <section class="content-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                            </svg>
                        </div>
                        <h2 class="section-title">
                            @if(app()->getLocale() == 'fr')
                                Ce que vous apprendrez
                            @else
                                What You'll Learn
                            @endif
                        </h2>
                    </div>
                    <div class="section-content">
                        <ul class="styled-list">
                            @foreach($internship->getTranslation('learning_outcomes', app()->getLocale()) as $outcome)
                                @if(isset($outcome['outcome']))
                                    <li>{{ $outcome['outcome'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </section>
            @endif

            <!-- Required Skills -->
            @if($internship->required_skills && is_array($internship->getTranslation('required_skills', app()->getLocale())))
                <section class="content-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <h2 class="section-title">
                            @if(app()->getLocale() == 'fr')
                                Compétences requises
                            @else
                                Required Skills
                            @endif
                        </h2>
                    </div>
                    <div class="section-content">
                        <ul class="skills-list">
                            @foreach($internship->getTranslation('required_skills', app()->getLocale()) as $skill)
                                @if(isset($skill['skill']))
                                    <li class="skill-item">{{ $skill['skill'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </section>
            @endif

            <!-- Qualifications -->
            @if($internship->qualifications && is_array($internship->getTranslation('qualifications', app()->getLocale())))
                <section class="content-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                            </svg>
                        </div>
                        <h2 class="section-title">
                            @if(app()->getLocale() == 'fr')
                                Qualifications
                            @else
                                Qualifications
                            @endif
                        </h2>
                    </div>
                    <div class="section-content">
                        <ul class="styled-list">
                            @foreach($internship->getTranslation('qualifications', app()->getLocale()) as $qualification)
                                @if(isset($qualification['qualification']))
                                    <li>{{ $qualification['qualification'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </section>
            @endif

            <!-- Benefits -->
            @if($internship->benefits && is_array($internship->getTranslation('benefits', app()->getLocale())))
                <section class="content-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                        </div>
                        <h2 class="section-title">
                            @if(app()->getLocale() == 'fr')
                                Avantages
                            @else
                                Benefits
                            @endif
                        </h2>
                    </div>
                    <div class="section-content">
                        <div class="benefits-grid">
                            @foreach($internship->getTranslation('benefits', app()->getLocale()) as $benefit)
                                @if(isset($benefit['benefit']))
                                    <div class="benefit-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20,6 9,17 4,12"/>
                                        </svg>
                                        <span>{{ $benefit['benefit'] }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            <!-- Language Requirements -->
            @if($internship->required_language)
                <section class="content-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M2 12h20"/>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                            </svg>
                        </div>
                        <h2 class="section-title">
                            @if(app()->getLocale() == 'fr')
                                Exigences linguistiques
                            @else
                                Language Requirements
                            @endif
                        </h2>
                    </div>
                    <div class="section-content">
                        <p>{{ $internship->required_language }}</p>
                    </div>
                </section>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="content-sidebar">
            <!-- Quick Apply Card -->
            <div class="sidebar-card apply-card">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(app()->getLocale() == 'fr')
                            Postuler maintenant
                        @else
                            Apply Now
                        @endif
                    </h3>
                </div>
                
                <div class="card-content">
                    <div class="apply-details">
                        @if($internship->start_date)
                            <div class="detail-item">
                                <span class="detail-label">
                                    @if(app()->getLocale() == 'fr')
                                        Date de début:
                                    @else
                                        Start Date:
                                    @endif
                                </span>
                                <span class="detail-value">
                                    @if(is_string($internship->start_date))
                                        {{ $internship->start_date }}
                                    @else
                                        {{ $internship->start_date->format('d M Y') }}
                                    @endif
                                </span>
                            </div>
                        @endif

                        @if($internship->compensation)
                            <div class="detail-item">
                                <span class="detail-label">
                                    @if(app()->getLocale() == 'fr')
                                        Rémunération:
                                    @else
                                        Compensation:
                                    @endif
                                </span>
                                <span class="detail-value">{{ $internship->compensation }}</span>
                            </div>
                        @endif

                        @if($internship->position_type)
                            <div class="detail-item">
                                <span class="detail-label">
                                    @if(app()->getLocale() == 'fr')
                                        Type:
                                    @else
                                        Type:
                                    @endif
                                </span>
                                <span class="detail-value">{{ $internship->position_type }}</span>
                            </div>
                        @endif

                        @if($internship->internship_level)
                            <div class="detail-item">
                                <span class="detail-label">
                                    @if(app()->getLocale() == 'fr')
                                        Niveau:
                                    @else
                                        Level:
                                    @endif
                                </span>
                                <span class="detail-value">{{ ucfirst($internship->internship_level) }}</span>
                            </div>
                        @endif
                    </div>

                    @if($internship->application_deadline && !$internship->isExpired())
                        <div class="deadline-info">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12,6 12,12 16,14"/>
                            </svg>
                            <span>
                                @if(app()->getLocale() == 'fr')
                                    Date limite: 
                                @else
                                    Deadline: 
                                @endif
                                @if(is_string($internship->application_deadline))
                                    {{ $internship->application_deadline }}
                                @else
                                    {{ $internship->application_deadline->format('d M Y') }}
                                @endif
                            </span>
                        </div>
                    @endif

                    <a href="{{ route('internships.apply', $internship->id) }}" 
                       class="apply-button {{ $internship->isExpired() ? 'disabled' : '' }}"
                       {{ $internship->isExpired() ? 'disabled' : '' }}>
                        @if($internship->isExpired())
                            @if(app()->getLocale() == 'fr')
                                Candidatures fermées
                            @else
                                Applications Closed
                            @endif
                        @else
                            @if(app()->getLocale() == 'fr')
                                Postuler maintenant
                            @else
                                Apply Now
                            @endif
                        @endif
                        @if(!$internship->isExpired())
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        @endif
                    </a>
                </div>
            </div>

            <!-- Contact Information -->
            @if($internship->contact_email || $internship->contact_phone)
                <div class="sidebar-card contact-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            @if(app()->getLocale() == 'fr')
                                Contact
                            @else
                                Contact
                            @endif
                        </h3>
                    </div>
                    
                    <div class="card-content">
                        @if($internship->contact_email)
                            <div class="contact-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                <a href="mailto:{{ $internship->contact_email }}">{{ $internship->contact_email }}</a>
                            </div>
                        @endif

                        @if($internship->contact_phone)
                            <div class="contact-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                                <a href="tel:{{ $internship->contact_phone }}">{{ $internship->contact_phone }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Share Card -->
            <div class="sidebar-card share-card">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(app()->getLocale() == 'fr')
                            Partager cette offre
                        @else
                            Share this offer
                        @endif
                    </h3>
                </div>
                
                <div class="card-content">
                    <div class="share-buttons">
                        <button class="share-btn linkedin" onclick="shareOnLinkedIn()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                                <rect x="2" y="9" width="4" height="12"/>
                                <circle cx="4" cy="4" r="2"/>
                            </svg>
                            LinkedIn
                        </button>
                        
                        <button class="share-btn twitter" onclick="shareOnTwitter()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
                            </svg>
                            Twitter
                        </button>
                        
                        <button class="share-btn copy" onclick="copyLink()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                            </svg>
                            @if(app()->getLocale() == 'fr')
                                Copier le lien
                            @else
                                Copy link
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Internships -->
    @php
        $relatedInternships = $internship->relatedInternships(3);
    @endphp
    
    @if($relatedInternships->count() > 0)
        <section class="related-section">
            <div class="section-header">
                <h2 class="section-title">
                    @if(app()->getLocale() == 'fr')
                        Stages similaires
                    @else
                        Similar Internships
                    @endif
                </h2>
                <p class="section-subtitle">
                    @if(app()->getLocale() == 'fr')
                        Découvrez d'autres opportunités qui pourraient vous intéresser
                    @else
                        Discover other opportunities that might interest you
                    @endif
                </p>
            </div>
            
            <div class="related-grid">
                @foreach($relatedInternships as $related)
                    <div class="related-card">
                        @if($related->image)
                            <div class="related-image">
                                <img src="{{ asset('storage/' . $related->image) }}" 
                                     alt="{{ $related->getTranslation('title', app()->getLocale()) }}"
                                     loading="lazy">
                                <div class="image-overlay"></div>
                            </div>
                        @else
                            <div class="related-image related-no-image">
                                <div class="no-image-placeholder">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <polyline points="21,15 16,10 5,21"/>
                                    </svg>
                                </div>
                            </div>
                        @endif

                        <div class="related-content">
                            <div class="related-meta">
                                @if($related->category)
                                    <span class="related-category">{{ $related->category->getTranslation('name', app()->getLocale()) }}</span>
                                @endif
                                <span class="related-location">{{ $related->location }}</span>
                            </div>
                            
                            <h3 class="related-title">
                                <a href="{{ route('internships.show', $related->slug) }}">
                                    {{ $related->getTranslation('title', app()->getLocale()) }}
                                </a>
                            </h3>
                            
                            @if($related->company_name)
                                <p class="related-company">{{ $related->company_name }}</p>
                            @endif
                            
                            <div class="related-footer">
                                @if($related->duration)
                                    <span class="related-duration">{{ $related->duration }}</span>
                                @endif
                                <a href="{{ route('internships.show', $related->slug) }}" class="related-link">
                                    @if(app()->getLocale() == 'fr')
                                        Voir détails
                                    @else
                                        View details
                                    @endif
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="m9 18 6-6-6-6"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @else
        <section class="related-section">
            <div class="no-related">
                <div class="no-related-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                </div>
                <h3>
                    @if(app()->getLocale() == 'fr')
                        Aucun stage similaire trouvé
                    @else
                        No similar internships found
                    @endif
                </h3>
                <p>
                    @if(app()->getLocale() == 'fr')
                        Découvrez toutes nos autres opportunités
                    @else
                        Discover all our other opportunities
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
        </section>
    @endif
</div>

<style>
.internship-detail-container {
    max-width: 1400px;
    margin: 0 auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Hero Section */
.internship-hero {
    position: relative;
    height: 400px;
    border-radius: 0 0 32px 32px;
    overflow: hidden;
    margin-bottom: 3rem;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-size: cover;
    background-position: center;
    filter: blur(2px);
}

.hero-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.5) 100%);
}

.hero-content {
    position: relative;
    z-index: 2;
    color: white;
    padding: 2rem;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.breadcrumb {
    margin-bottom: 1rem;
}

.breadcrumb-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.breadcrumb-link:hover {
    color: white;
}

.hero-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    max-width: 800px;
}

.hero-badges {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.badge {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    backdrop-filter: blur(10px);
}

.badge-new {
    background: rgba(40, 167, 69, 0.9);
    color: white;
}

.badge-category {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 1px solid rgba(255,255,255,0.3);
}

.badge-remote {
    background: rgba(220, 53, 69, 0.9);
    color: white;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.hero-meta {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    opacity: 0.9;
}

.meta-item.expired {
    color: #ff6b6b;
}

.meta-item svg {
    flex-shrink: 0;
}

/* Content Layout */
.internship-content {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 3rem;
    padding: 0 2rem;
    margin-bottom: 4rem;
}

.content-main {
    display: flex;
    flex-direction: column;
    gap: 2.5rem;
}

/* Content Sections */
.content-section {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
}

.section-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
}

.section-content {
    color: #495057;
    line-height: 1.7;
    font-size: 1rem;
}

.section-content h3 {
    color: #2c3e50;
    font-size: 1.2rem;
    margin: 1.5rem 0 1rem 0;
}

.section-content p {
    margin-bottom: 1rem;
}

.company-description {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 1.5rem;
    border-radius: 12px;
    border-left: 4px solid #667eea;
}

/* Lists */
.styled-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.styled-list li {
    position: relative;
    padding: 0.75rem 0 0.75rem 2rem;
    border-bottom: 1px solid #f0f0f0;
}

.styled-list li:last-child {
    border-bottom: none;
}

.styled-list li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 1rem;
    width: 8px;
    height: 8px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
}

.skills-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    list-style: none;
    padding: 0;
    margin: 0;
}

.skill-item {
    background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
    color: #1565c0;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    border: 1px solid #bbdefb;
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.benefit-item svg {
    color: #28a745;
    flex-shrink: 0;
}

/* Sidebar */
.content-sidebar {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.sidebar-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

.card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 1.5rem;
    border-bottom: 1px solid #f0f0f0;
}

.card-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
}

.card-content {
    padding: 1.5rem;
}

/* Apply Card */
.apply-card .card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.apply-details {
    margin-bottom: 1.5rem;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 500;
    color: #6c757d;
    font-size: 0.9rem;
}

.detail-value {
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.9rem;
}

.deadline-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: #fff3cd;
    color: #856404;
    padding: 0.75rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 1.5rem;
    border: 1px solid #ffeaa7;
}

.apply-button {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.apply-button:hover:not(.disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.apply-button.disabled {
    background: #95a5a6;
    cursor: not-allowed;
}

/* Contact Card */
.contact-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.contact-item:last-child {
    margin-bottom: 0;
}

.contact-item svg {
    color: #667eea;
    flex-shrink: 0;
}

.contact-item a {
    color: #495057;
    text-decoration: none;
    font-size: 0.9rem;
}

.contact-item a:hover {
    color: #667eea;
}

/* Share Card */
.share-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.share-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    border: 1px solid #dee2e6;
    background: white;
    border-radius: 8px;
    text-decoration: none;
    color: #495057;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
}

.share-btn:hover {
    transform: translateX(3px);
}

.share-btn.linkedin:hover {
    background: #0077b5;
    color: white;
    border-color: #0077b5;
}

.share-btn.twitter:hover {
    background: #1da1f2;
    color: white;
    border-color: #1da1f2;
}

.share-btn.copy:hover {
    background: #28a745;
    color: white;
    border-color: #28a745;
}

/* Related Section */
.related-section {
    padding: 0 2rem 2rem;
}

.related-section .section-header {
    text-align: center;
    margin-bottom: 3rem;
    border: none;
    padding: 0;
}

.related-section .section-title {
    font-size: 2rem;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.section-subtitle {
    color: #6c757d;
    font-size: 1.1rem;
    margin: 0;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.related-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
    transition: all 0.3s ease;
}

.related-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}

.related-image {
    height: 150px;
    overflow: hidden;
    position: relative;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.related-card:hover .related-image img {
    transform: scale(1.05);
}

.related-no-image {
    display: flex;
    align-items: center;
    justify-content: center;
}

.no-image-placeholder {
    color: #adb5bd;
}

.related-content {
    padding: 1.5rem;
}

.related-meta {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    font-size: 0.75rem;
}

.related-category {
    background: #e3f2fd;
    color: #1565c0;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-weight: 500;
}

.related-location {
    color: #6c757d;
    font-weight: 500;
}

.related-title {
    margin: 0 0 0.5rem 0;
    font-size: 1.1rem;
    line-height: 1.3;
}

.related-title a {
    color: #2c3e50;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.related-title a:hover {
    color: #667eea;
}

.related-company {
    color: #6c757d;
    font-size: 0.9rem;
    margin: 0 0 1rem 0;
}

.related-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #f0f0f0;
}

.related-duration {
    color: #6c757d;
    font-size: 0.85rem;
}

.related-link {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    color: #667eea;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.related-link:hover {
    gap: 0.5rem;
}

/* No Related */
.no-related {
    text-align: center;
    padding: 3rem 2rem;
    color: #6c757d;
}

.no-related-icon {
    margin-bottom: 1.5rem;
    color: #adb5bd;
}

.no-related h3 {
    font-size: 1.3rem;
    color: #495057;
    margin-bottom: 1rem;
}

.no-related p {
    font-size: 1rem;
    margin-bottom: 2rem;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

/* Responsive */
@media (max-width: 1024px) {
    .internship-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .content-sidebar {
        order: -1;
    }
}

@media (max-width: 768px) {
    .internship-detail-container {
        padding: 0;
    }
    
    .hero-content {
        padding: 1.5rem;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-meta {
        flex-direction: column;
        gap: 1rem;
    }
    
    .internship-content {
        padding: 0 1rem;
        gap: 1.5rem;
    }
    
    .content-section {
        padding: 1.5rem;
    }
    
    .section-header {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .benefits-grid {
        grid-template-columns: 1fr;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .related-section {
        padding: 0 1rem 1rem;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 1.5rem;
    }
    
    .hero-badges {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .content-section {
        padding: 1.25rem;
    }
    
    .card-content {
        padding: 1.25rem;
    }
    
    .skills-list {
        gap: 0.5rem;
    }
    
    .skill-item {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
    }
}
</style>

<script>
function shareOnLinkedIn() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank');
}

function shareOnTwitter() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://twitter.com/intent/tweet?url=${url}&text=${title}`, '_blank');
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        alert(@if(app()->getLocale() == 'fr')'Lien copié dans le presse-papiers!'@else'Link copied to clipboard!'@endif);
    });
}
</script>
@endsection