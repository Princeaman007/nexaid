
@extends('layouts.app')

@section('title', 'Pourquoi recruter un stagiaire international')

@section('content')
<div class="company-container">
    <!-- Hero Section -->
    <div class="company-hero hiring-hero">
        <div class="hero-content">
            <h1 class="hero-title">
                Pourquoi recruter un stagiaire international ?
            </h1>
            <p class="hero-subtitle">
                Enrichissez votre équipe avec des talents internationaux motivés et découvrez de nouvelles perspectives culturelles
            </p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['hiring_companies'] ?? 0 }}+</span>
                    <span class="stat-label">Entreprises recruteuses</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['total_interns_placed'] ?? 0 }}+</span>
                    <span class="stat-label">Stages réalisés</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['countries_represented'] ?? 0 }}+</span>
                    <span class="stat-label">Pays représentés</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['satisfaction_rate'] ?? 0 }}%</span>
                    <span class="stat-label">Satisfaction</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="benefits-section">
        <div class="section-header">
            <h2 class="section-title">Les avantages d'un stagiaire international</h2>
            <p class="section-subtitle">Découvrez comment enrichir votre équipe avec des perspectives globales</p>
        </div>
        
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-number">01</div>
                <div class="benefit-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <h3 class="benefit-title">Diversité culturelle</h3>
                <div class="benefit-content">
                    <p class="benefit-description">
                        Enrichissez votre équipe avec des perspectives internationales et développez 
                        votre ouverture culturelle pour une innovation accrue.
                    </p>
                    <ul class="benefit-features">
                        <li>Nouvelles approches créatives</li>
                        <li>Perspectives multiculturelles</li>
                        <li>Enrichissement des équipes</li>
                    </ul>
                </div>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-number">02</div>
                <div class="benefit-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                    </svg>
                </div>
                <h3 class="benefit-title">Compétences spécialisées</h3>
                <div class="benefit-content">
                    <p class="benefit-description">
                        Accédez à des talents formés dans différents systèmes éducatifs avec 
                        des approches innovantes et des méthodologies uniques.
                    </p>
                    <ul class="benefit-features">
                        <li>Formations internationales</li>
                        <li>Méthodologies diverses</li>
                        <li>Expertise technique</li>
                    </ul>
                </div>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-number">03</div>
                <div class="benefit-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M12 1v6M12 17v6M4.22 4.22l4.24 4.24M15.54 15.54l4.24 4.24M1 12h6M17 12h6M4.22 19.78l4.24-4.24M15.54 8.46l4.24-4.24"/>
                    </svg>
                </div>
                <h3 class="benefit-title">Expansion internationale</h3>
                <div class="benefit-content">
                    <p class="benefit-description">
                        Facilitez votre développement sur de nouveaux marchés grâce à leur 
                        connaissance locale et leurs réseaux internationaux.
                    </p>
                    <ul class="benefit-features">
                        <li>Connaissance des marchés</li>
                        <li>Réseaux internationaux</li>
                        <li>Opportunités d'expansion</li>
                    </ul>
                </div>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-number">04</div>
                <div class="benefit-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                    </svg>
                </div>
                <h3 class="benefit-title">Dynamisme</h3>
                <div class="benefit-content">
                    <p class="benefit-description">
                        Bénéficiez de leur motivation exceptionnelle et de leur capacité 
                        d'adaptation dans un nouvel environnement professionnel.
                    </p>
                    <ul class="benefit-features">
                        <li>Motivation élevée</li>
                        <li>Adaptabilité</li>
                        <li>Énergie nouvelle</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Section -->
    <div class="process-section">
        <div class="section-header">
            <h2 class="section-title">Notre processus de recrutement</h2>
            <p class="section-subtitle">Un accompagnement personnalisé en 3 étapes clés</p>
        </div>
        
        <div class="process-timeline">
            <div class="timeline-step">
                <div class="step-marker">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                </div>
                <div class="step-content">
                    <h4 class="step-title">Analyse de vos besoins</h4>
                    <p class="step-description">
                        Nous étudions en détail votre culture d'entreprise, vos projets et vos exigences 
                        spécifiques pour identifier le profil idéal.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 12l2 2 4-4"/>
                        <circle cx="12" cy="12" r="10"/>
                    </svg>
                </div>
                <div class="step-content">
                    <h4 class="step-title">Sélection rigoureuse</h4>
                    <p class="step-description">
                        Nous présélectionnons soigneusement les candidats selon vos critères : 
                        compétences techniques, langues, expérience internationale.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
                <div class="step-content">
                    <h4 class="step-title">Accompagnement complet</h4>
                    <p class="step-description">
                        Support administratif, aide à l'intégration culturelle et suivi personnalisé 
                        tout au long du stage pour garantir le succès.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Stories Section -->
    <div class="success-stories-section">
        <div class="section-header">
            <h2 class="section-title">Témoignages de nos entreprises partenaires</h2>
            <p class="section-subtitle">Découvrez l'expérience de ceux qui nous font confiance</p>
        </div>
        
        <div class="stories-grid">
            @if($testimonials && $testimonials->count() > 0)
                @foreach($testimonials as $testimonial)
                    <div class="story-card">
                        <div class="story-header">
                            <div class="company-avatar">
                                {{ strtoupper(substr($testimonial->name, 0, 2)) }}
                            </div>
                            <div class="company-info">
                                <h4 class="company-name">{{ $testimonial->name }}</h4>
                                <p class="company-details">
                                    @if($testimonial->team_size)
                                        {{ $testimonial->team_size }} employés •
                                    @endif
                                    @if($testimonial->sectors_interested && is_array($testimonial->sectors_interested))
                                        {{ implode(', ', array_slice($testimonial->sectors_interested, 0, 2)) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        @if($testimonial->cultural_diversity_goals)
                            <p class="story-text">
                                "{{ $testimonial->cultural_diversity_goals }}"
                            </p>
                        @else
                            <p class="story-text">
                                "{{ $testimonial->description ?? 'Excellente expérience avec les stagiaires internationaux.' }}"
                            </p>
                        @endif
                        
                        <div class="story-metrics">
                            <div class="metric">
                                @if($testimonial->intern_duration_preference)
                                    <span class="metric-value">{{ $testimonial->intern_duration_preference }}</span>
                                    <span class="metric-label">Durée préférée</span>
                                @else
                                    <span class="metric-value">{{ $testimonial->team_size ?? '10+' }}</span>
                                    <span class="metric-label">Employés</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="story-tags">
                            @if($testimonial->sectors_interested && is_array($testimonial->sectors_interested))
                                @foreach(array_slice($testimonial->sectors_interested, 0, 3) as $sector)
                                    <span class="tag">{{ $sector }}</span>
                                @endforeach
                            @endif
                            
                            @if($testimonial->languages_needed && is_array($testimonial->languages_needed))
                                @foreach(array_slice($testimonial->languages_needed, 0, 2) as $language)
                                    <span class="tag">{{ $language }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback testimonials si aucune donnée -->
                <div class="story-card">
                    <div class="story-header">
                        <div class="company-avatar">TI</div>
                        <div class="company-info">
                            <h4 class="company-name">TechInnovate</h4>
                            <p class="company-details">120 employés • Technologie</p>
                        </div>
                    </div>
                    <p class="story-text">
                        "Les stagiaires internationaux ont transformé notre approche des projets. 
                        Leur diversité culturelle nous a permis de repenser nos produits pour un marché global."
                    </p>
                    <div class="story-metrics">
                        <div class="metric">
                            <span class="metric-value">+35%</span>
                            <span class="metric-label">Innovation produit</span>
                        </div>
                    </div>
                    <div class="story-tags">
                        <span class="tag">Informatique</span>
                        <span class="tag">Innovation</span>
                    </div>
                </div>
                
                <div class="story-card">
                    <div class="story-header">
                        <div class="company-avatar">DF</div>
                        <div class="company-info">
                            <h4 class="company-name">Digital Factory</h4>
                            <p class="company-details">85 employés • Design</p>
                        </div>
                    </div>
                    <p class="story-text">
                        "Recruter des stagiaires internationaux était la meilleure décision ! 
                        Ils apportent des perspectives créatives uniques et enrichissent nos projets clients."
                    </p>
                    <div class="story-metrics">
                        <div class="metric">
                            <span class="metric-value">92%</span>
                            <span class="metric-label">Satisfaction client</span>
                        </div>
                    </div>
                    <div class="story-tags">
                        <span class="tag">Design</span>
                        <span class="tag">Créativité</span>
                    </div>
                </div>
                
                <div class="story-card">
                    <div class="story-header">
                        <div class="company-avatar">GS</div>
                        <div class="company-info">
                            <h4 class="company-name">Green Solutions</h4>
                            <p class="company-details">200 employés • Environnement</p>
                        </div>
                    </div>
                    <p class="story-text">
                        "L'accompagnement est exceptionnel. De la sélection à l'intégration, tout est facilité. 
                        Nos stagiaires internationaux sont devenus indispensables."
                    </p>
                    <div class="story-metrics">
                        <div class="metric">
                            <span class="metric-value">6 mois</span>
                            <span class="metric-label">Durée moyenne</span>
                        </div>
                    </div>
                    <div class="story-tags">
                        <span class="tag">Environnement</span>
                        <span class="tag">Durabilité</span>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">Prêt à enrichir votre équipe ?</h2>
            <p class="cta-subtitle">
                Rejoignez les {{ $stats['hiring_companies'] ?? '150' }}+ entreprises qui font confiance à notre expertise pour recruter leurs futurs talents
            </p>
            <div class="cta-actions">
                <a href="{{ route('company.register', ['type' => 'hiring']) }}" class="btn-primary">
                    Commencer le recrutement
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
                <div class="cta-benefits">
                    <span class="benefit-item">✓ Gratuit et sans engagement</span>
                    <span class="benefit-item">✓ Réponse sous 24h</span>
                    <span class="benefit-item">✓ Support personnalisé</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Le CSS reste identique à l'original */
.company-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
    line-height: 1.6;
    color: #1a1a1a;
}

.hiring-hero {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    color: white;
    border-radius: 16px;
    padding: 4rem 2rem;
    margin-bottom: 5rem;
    text-align: center;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    line-height: 1.1;
    letter-spacing: -0.02em;
}

.hero-subtitle {
    font-size: 1.25rem;
    opacity: 0.9;
    margin-bottom: 3rem;
    line-height: 1.5;
    font-weight: 400;
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
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    font-weight: 500;
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
}

.section-subtitle {
    font-size: 1.2rem;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
    font-weight: 400;
}

.benefits-section {
    margin-bottom: 6rem;
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.benefit-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 2.5rem;
    transition: all 0.3s ease;
    position: relative;
}

.benefit-card:hover {
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

.benefit-number {
    position: absolute;
    top: -15px;
    left: 2.5rem;
    background: #1e293b;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    font-weight: 600;
}

.benefit-icon {
    width: 60px;
    height: 60px;
    background: #f1f5f9;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    color: #475569;
}

.benefit-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1rem;
}

.benefit-description {
    color: #64748b;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.benefit-features {
    list-style: none;
    padding: 0;
    margin: 0;
}

.benefit-features li {
    color: #475569;
    padding: 0.4rem 0;
    position: relative;
    padding-left: 1.5rem;
    font-size: 0.9rem;
}

.benefit-features li::before {
    content: '•';
    color: #3b82f6;
    position: absolute;
    left: 0;
    font-weight: 600;
}

.process-section {
    background: #f8fafc;
    padding: 4rem 2rem;
    border-radius: 16px;
    margin-bottom: 6rem;
}

.process-timeline {
    max-width: 900px;
    margin: 0 auto;
    position: relative;
}

.process-timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e2e8f0;
    transform: translateX(-50%);
}

.timeline-step {
    display: flex;
    align-items: flex-start;
    margin-bottom: 3rem;
    position: relative;
}

.timeline-step:nth-child(odd) {
    flex-direction: row;
    text-align: right;
}

.timeline-step:nth-child(even) {
    flex-direction: row-reverse;
    text-align: left;
}

.step-marker {
    width: 60px;
    height: 60px;
    background: #1e293b;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    position: relative;
    flex-shrink: 0;
}

.step-content {
    flex: 1;
    max-width: 350px;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    margin: 0 2rem;
}

.step-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1rem;
}

.step-description {
    color: #64748b;
    line-height: 1.6;
}

.success-stories-section {
    margin-bottom: 6rem;
}

.stories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.story-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 2rem;
    transition: all 0.3s ease;
}

.story-card:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

.story-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.company-avatar {
    width: 50px;
    height: 50px;
    background: #1e293b;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
}

.company-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.company-details {
    font-size: 0.9rem;
    color: #64748b;
    margin: 0;
}

.story-text {
    color: #475569;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-style: italic;
}

.story-metrics {
    margin-bottom: 1.5rem;
}

.metric {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.metric-value {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1e293b;
    line-height: 1;
}

.metric-label {
    font-size: 0.8rem;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.story-tags {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.tag {
    background: #f1f5f9;
    color: #475569;
    padding: 0.3rem 0.8rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.cta-section {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    color: white;
    padding: 4rem 2rem;
    border-radius: 16px;
    text-align: center;
}

.cta-content {
    max-width: 600px;
    margin: 0 auto;
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.2;
    letter-spacing: -0.02em;
}

.cta-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 2.5rem;
    line-height: 1.5;
}

.cta-actions {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: white;
    color: #1e293b;
    padding: 1rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn-primary:hover {
    background: #f8fafc;
    transform: translateY(-1px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.cta-benefits {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
    justify-content: center;
}

.benefit-item {
    font-size: 0.9rem;
    opacity: 0.9;
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
    .company-container {
        padding: 1rem;
    }
    
    .hero-title {
        font-size: 2.2rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .benefits-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .process-timeline::before {
        left: 30px;
    }
    
    .timeline-step {
        flex-direction: row !important;
        text-align: left !important;
        padding-left: 80px;
    }
    
    .step-marker {
        position: absolute;
        left: 0;
    }
    
    .step-content {
        margin: 0;
        margin-left: 1rem;
    }
    
    .stories-grid {
        grid-template-columns: 1fr;
    }
    
    .cta-benefits {
        flex-direction: column;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .hero-stats {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .benefit-card,
    .story-card {
        padding: 1.5rem;
    }
}
</style>
@endsection
