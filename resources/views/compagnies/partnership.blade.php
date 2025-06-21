```blade
@extends('layouts.app')

@section('title', 'Comment travaillons-nous avec les entreprises')

@section('content')
<div class="company-container">
    <!-- Hero Section -->
    <div class="company-hero partnership-hero">
        <div class="hero-content">
            <h1 class="hero-title">
                Comment travaillons-nous avec les entreprises ?
            </h1>
            <p class="hero-subtitle">
                Découvrez nos solutions de partenariat sur mesure pour développer votre activité avec des talents internationaux
            </p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['active_partnerships'] ?? 0 }}+</span>
                    <span class="stat-label">Partenariats actifs</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['total_companies'] ?? 0 }}+</span>
                    <span class="stat-label">Entreprises partenaires</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['avg_partnership_duration'] ?? '2.5 ans' }}</span>
                    <span class="stat-label">Durée moyenne</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['success_rate'] ?? 0 }}%</span>
                    <span class="stat-label">Taux de succès</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Partnership Types Section -->
    <div class="partnership-types-section">
        <div class="section-header">
            <h2 class="section-title">Types de partenariats disponibles</h2>
            <p class="section-subtitle">Choisissez la collaboration qui correspond le mieux à vos objectifs</p>
        </div>
        
        <div class="partnership-grid">
            @if($partnership_types && $partnership_types->count() > 0)
                @foreach($partnership_types as $type)
                    <div class="partnership-card">
                        <div class="partnership-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="m22 21-3-3"/>
                                <path d="m16 16 3 3"/>
                            </svg>
                        </div>
                        <h3 class="partnership-title">{{ $type }}</h3>
                        <p class="partnership-description">
                            Partenariat {{ strtolower($type) }} adapté à vos besoins spécifiques et objectifs d'entreprise.
                        </p>
                    </div>
                @endforeach
            @else
                <!-- Fallback types -->
                <div class="partnership-card">
                    <div class="partnership-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="m22 21-3-3"/>
                        </svg>
                    </div>
                    <h3 class="partnership-title">Partenariat Stratégique</h3>
                    <p class="partnership-description">
                        Collaboration à long terme pour développer votre stratégie RH internationale et optimiser vos recrutements.
                    </p>
                </div>
                
                <div class="partnership-card">
                    <div class="partnership-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                    </div>
                    <h3 class="partnership-title">Partenariat Commercial</h3>
                    <p class="partnership-description">
                        Solutions flexibles et évolutives pour vos besoins ponctuels de recrutement de stagiaires internationaux.
                    </p>
                </div>
                
                <div class="partnership-card">
                    <div class="partnership-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect width="16" height="10" x="2" y="3" rx="2"/>
                            <path d="M12 17v4"/>
                            <path d="m8 21 4-4 4 4"/>
                        </svg>
                    </div>
                    <h3 class="partnership-title">Partenariat Technologique</h3>
                    <p class="partnership-description">
                        Intégration de nos outils et services dans vos processus RH pour une gestion optimisée des talents.
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Services Section -->
    <div class="services-section">
        <div class="section-header">
            <h2 class="section-title">Services les plus demandés</h2>
            <p class="section-subtitle">Nos solutions adaptées aux besoins de nos partenaires</p>
        </div>
        
        <div class="services-grid">
            @if($popular_services && $popular_services->count() > 0)
                @foreach($popular_services->take(6) as $service => $count)
                    <div class="service-card">
                        <div class="service-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20,6 9,17 4,12"/>
                            </svg>
                        </div>
                        <h4 class="service-title">{{ $service }}</h4>
                        <p class="service-count">{{ $count }} entreprises</p>
                    </div>
                @endforeach
            @else
                <!-- Fallback services -->
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="m22 21-3-3"/>
                        </svg>
                    </div>
                    <h4 class="service-title">Conseil en recrutement</h4>
                    <p class="service-count">Expertise RH</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                        </svg>
                    </div>
                    <h4 class="service-title">Formation interculturelle</h4>
                    <p class="service-count">Intégration optimale</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect width="16" height="10" x="2" y="3" rx="2"/>
                            <path d="M12 17v4"/>
                        </svg>
                    </div>
                    <h4 class="service-title">Outils technologiques</h4>
                    <p class="service-count">Solutions digitales</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 10v12"/>
                            <path d="M15 5v16"/>
                        </svg>
                    </div>
                    <h4 class="service-title">Support marketing</h4>
                    <p class="service-count">Communication ciblée</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="3"/>
                            <path d="M12 1v6"/>
                        </svg>
                    </div>
                    <h4 class="service-title">Suivi personnalisé</h4>
                    <p class="service-count">Accompagnement dédié</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/>
                        </svg>
                    </div>
                    <h4 class="service-title">Documentation légale</h4>
                    <p class="service-count">Conformité assurée</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Process Section -->
    <div class="process-section">
        <div class="section-header">
            <h2 class="section-title">Notre processus de partenariat</h2>
            <p class="section-subtitle">Une approche structurée en 4 étapes pour un partenariat réussi</p>
        </div>
        
        <div class="process-timeline">
            <div class="timeline-step">
                <div class="step-marker">01</div>
                <div class="step-content">
                    <h4 class="step-title">Diagnostic initial</h4>
                    <p class="step-description">
                        Analyse approfondie de vos besoins, objectifs et contraintes pour définir le partenariat optimal.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">02</div>
                <div class="step-content">
                    <h4 class="step-title">Proposition sur mesure</h4>
                    <p class="step-description">
                        Élaboration d'une solution personnalisée avec tarification transparente et planning détaillé.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">03</div>
                <div class="step-content">
                    <h4 class="step-title">Mise en œuvre</h4>
                    <p class="step-description">
                        Lancement du partenariat avec formation de vos équipes et intégration de nos services.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">04</div>
                <div class="step-content">
                    <h4 class="step-title">Suivi & optimisation</h4>
                    <p class="step-description">
                        Monitoring continu des résultats et ajustements pour maximiser la performance.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">Prêt pour un partenariat ?</h2>
            <p class="cta-subtitle">
                Rejoignez nos {{ $stats['active_partnerships'] ?? '50' }}+ partenaires et développez votre activité avec des talents internationaux
            </p>
            <div class="cta-actions">
                <a href="{{ route('company.register', ['type' => 'partnership']) }}" class="btn-primary">
                    Démarrer un partenariat
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
                <div class="cta-benefits">
                    <span class="benefit-item">✓ Consultation gratuite</span>
                    <span class="benefit-item">✓ Devis personnalisé</span>
                    <span class="benefit-item">✓ Support dédié</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.company-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
    line-height: 1.6;
    color: #1a1a1a;
}

.partnership-hero {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
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

.partnership-types-section {
    margin-bottom: 6rem;
}

.partnership-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.partnership-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 2.5rem;
    text-align: center;
    transition: all 0.3s ease;
}

.partnership-card:hover {
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

.partnership-icon {
    width: 60px;
    height: 60px;
    background: #059669;
    color: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.partnership-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1rem;
}

.partnership-description {
    color: #64748b;
    line-height: 1.6;
}

.services-section {
    margin-bottom: 6rem;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.service-card {
    background: #f8fafc;
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
}

.service-card:hover {
    background: white;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
}

.service-icon {
    width: 40px;
    height: 40px;
    background: #059669;
    color: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

.service-title {
    font-size: 1rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.service-count {
    font-size: 0.9rem;
    color: #64748b;
    margin: 0;
}

.process-section {
    background: #f8fafc;
    padding: 4rem 2rem;
    border-radius: 16px;
    margin-bottom: 6rem;
}

.process-timeline {
    max-width: 800px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 2rem;
}

.timeline-step {
    text-align: center;
}

.step-marker {
    width: 60px;
    height: 60px;
    background: #059669;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: 700;
    margin: 0 auto 1.5rem;
}

.step-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1rem;
}

.step-description {
    color: #64748b;
    line-height: 1.6;
    font-size: 0.9rem;
}

.cta-section {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
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
    color: #059669;
    padding: 1rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
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
    
    .partnership-grid {
        grid-template-columns: 1fr;
    }
    
    .services-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    
    .process-timeline {
        grid-template-columns: 1fr;
    }
    
    .cta-benefits {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>
@endsection
```