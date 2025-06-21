@extends('layouts.app')

@section('title', 'Envoyer une offre de stage')

@section('content')
<div class="company-container">
    <!-- Hero Section -->
    <div class="company-hero offer-hero">
        <div class="hero-content">
            <h1 class="hero-title">
                Publiez votre offre de stage international
            </h1>
            <p class="hero-subtitle">
                Accédez à notre réseau d'étudiants internationaux motivés et trouvez le talent parfait pour votre entreprise
            </p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">250+</span>
                    <span class="stat-label">Offres actives</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">180+</span>
                    <span class="stat-label">Entreprises publiant</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">3 jours</span>
                    <span class="stat-label">Temps de réponse</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">89%</span>
                    <span class="stat-label">Taux de placement</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="section-header">
            <h2 class="section-title">Pourquoi choisir notre plateforme ?</h2>
            <p class="section-subtitle">Une solution complète pour optimiser votre recrutement international</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-number">01</div>
                <h3 class="feature-title">Processus simplifié</h3>
                <div class="feature-content">
                    <p class="feature-description">
                        Notre interface intuitive vous guide dans la création de votre offre. 
                        En quelques minutes, votre annonce est prête à être diffusée.
                    </p>
                    <ul class="feature-list">
                        <li>Formulaire guidé étape par étape</li>
                        <li>Templates personnalisables</li>
                        <li>Prévisualisation en temps réel</li>
                    </ul>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-number">02</div>
                <h3 class="feature-title">Candidats qualifiés</h3>
                <div class="feature-content">
                    <p class="feature-description">
                        Notre algorithme de matching intelligent présélectionne les profils 
                        les plus pertinents selon vos critères spécifiques.
                    </p>
                    <ul class="feature-list">
                        <li>Pré-sélection automatique</li>
                        <li>Évaluation des compétences</li>
                        <li>Vérification des références</li>
                    </ul>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-number">03</div>
                <h3 class="feature-title">Support complet</h3>
                <div class="feature-content">
                    <p class="feature-description">
                        De la publication à l'intégration, notre équipe vous accompagne 
                        à chaque étape du processus de recrutement.
                    </p>
                    <ul class="feature-list">
                        <li>Conseiller dédié</li>
                        <li>Support administratif</li>
                        <li>Suivi post-placement</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Section -->
    <div class="process-section">
        <div class="section-header">
            <h2 class="section-title">Comment ça fonctionne ?</h2>
            <p class="section-subtitle">Un processus éprouvé en 4 étapes simples</p>
        </div>
        
        <div class="process-timeline">
            <div class="timeline-step">
                <div class="step-marker">1</div>
                <div class="step-content">
                    <h4 class="step-title">Création de l'offre</h4>
                    <p class="step-description">
                        Décrivez précisément votre besoin : missions, compétences requises, 
                        conditions d'accueil et critères de sélection.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">2</div>
                <div class="step-content">
                    <h4 class="step-title">Validation & Publication</h4>
                    <p class="step-description">
                        Notre équipe valide votre offre sous 24h et optimise sa diffusion 
                        sur notre réseau pour maximiser sa visibilité.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">3</div>
                <div class="step-content">
                    <h4 class="step-title">Réception des candidatures</h4>
                    <p class="step-description">
                        Accédez aux profils pré-qualifiés via votre dashboard personnalisé. 
                        Filtrez et organisez facilement vos candidatures.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">4</div>
                <div class="step-content">
                    <h4 class="step-title">Sélection & Intégration</h4>
                    <p class="step-description">
                        Planifiez vos entretiens et bénéficiez de notre support pour 
                        l'intégration réussie de votre nouveau stagiaire.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="section-header">
            <h2 class="section-title">Résultats mesurés</h2>
            <p class="section-subtitle">Des performances qui parlent d'elles-mêmes</p>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value">89%</div>
                <div class="stat-label">Taux de placement réussi</div>
                <div class="stat-detail">9 offres sur 10 trouvent leur candidat idéal</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-value">72h</div>
                <div class="stat-label">Délai moyen de première candidature</div>
                <div class="stat-detail">Recevez rapidement des profils qualifiés</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-value">45</div>
                <div class="stat-label">Nationalités représentées</div>
                <div class="stat-detail">Une diversité culturelle exceptionnelle</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-value">4.8/5</div>
                <div class="stat-label">Satisfaction client</div>
                <div class="stat-detail">Note moyenne attribuée par nos partenaires</div>
            </div>
        </div>
    </div>

    <!-- Skills Section -->
    <div class="skills-section">
        <div class="section-header">
            <h2 class="section-title">Profils disponibles</h2>
            <p class="section-subtitle">Accédez à une large gamme de compétences et expertises</p>
        </div>
        
        <div class="skills-categories">
            <div class="skill-category">
                <div class="category-header">
                    <div class="category-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                            <line x1="8" y1="21" x2="16" y2="21"/>
                            <line x1="12" y1="17" x2="12" y2="21"/>
                        </svg>
                    </div>
                    <h4 class="category-title">Développement & Tech</h4>
                </div>
                <div class="skills-list">
                    <span class="skill-item">JavaScript</span>
                    <span class="skill-item">Python</span>
                    <span class="skill-item">React</span>
                    <span class="skill-item">Node.js</span>
                    <span class="skill-item">DevOps</span>
                    <span class="skill-item">+15 autres</span>
                </div>
            </div>
            
            <div class="skill-category">
                <div class="category-header">
                    <div class="category-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h4 class="category-title">Design & Créatif</h4>
                </div>
                <div class="skills-list">
                    <span class="skill-item">UI/UX Design</span>
                    <span class="skill-item">Figma</span>
                    <span class="skill-item">Adobe Suite</span>
                    <span class="skill-item">Motion Design</span>
                    <span class="skill-item">Branding</span>
                    <span class="skill-item">+8 autres</span>
                </div>
            </div>
            
            <div class="skill-category">
                <div class="category-header">
                    <div class="category-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="20" x2="12" y2="10"/>
                            <line x1="18" y1="20" x2="18" y2="4"/>
                            <line x1="6" y1="20" x2="6" y2="16"/>
                        </svg>
                    </div>
                    <h4 class="category-title">Marketing & Data</h4>
                </div>
                <div class="skills-list">
                    <span class="skill-item">Digital Marketing</span>
                    <span class="skill-item">Analytics</span>
                    <span class="skill-item">SEO/SEA</span>
                    <span class="skill-item">Social Media</span>
                    <span class="skill-item">Data Analysis</span>
                    <span class="skill-item">+12 autres</span>
                </div>
            </div>
            
            <div class="skill-category">
                <div class="category-header">
                    <div class="category-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            <polyline points="3.27,6.96 12,12.01 20.73,6.96"/>
                            <line x1="12" y1="22.08" x2="12" y2="12"/>
                        </svg>
                    </div>
                    <h4 class="category-title">Business & Management</h4>
                </div>
                <div class="skills-list">
                    <span class="skill-item">Project Management</span>
                    <span class="skill-item">Consulting</span>
                    <span class="skill-item">Finance</span>
                    <span class="skill-item">Strategy</span>
                    <span class="skill-item">Operations</span>
                    <span class="skill-item">+10 autres</span>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">Publier votre offre de stage</h2>
            <p class="cta-subtitle">
                Rejoignez les entreprises qui font confiance à notre expertise pour recruter leurs futurs talents
            </p>
            <div class="cta-actions">
                <a href="{{ route('company.register', ['type' => 'offer_sender']) }}" class="btn-primary">
                    Publier une offre
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
                <div class="cta-benefits">
                    <span class="benefit-item">✓ Publication gratuite</span>
                    <span class="benefit-item">✓ Validation sous 24h</span>
                    <span class="benefit-item">✓ Support inclus</span>
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

.company-hero {
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

.features-section {
    margin-bottom: 6rem;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2.5rem;
}

.feature-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 2.5rem;
    transition: all 0.3s ease;
    position: relative;
}

.feature-card:hover {
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

.feature-number {
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

.feature-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1rem;
    margin-top: 0.5rem;
}

.feature-description {
    color: #64748b;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.feature-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.feature-list li {
    color: #475569;
    padding: 0.5rem 0;
    position: relative;
    padding-left: 1.5rem;
}

.feature-list li::before {
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
    width: 50px;
    height: 50px;
    background: #1e293b;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
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

.stats-section {
    margin-bottom: 6rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.stat-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 2.5rem;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    line-height: 1;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1.1rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 0.8rem;
}

.stat-detail {
    font-size: 0.9rem;
    color: #64748b;
    line-height: 1.4;
}

.skills-section {
    margin-bottom: 6rem;
}

.skills-categories {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.skill-category {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 2rem;
    transition: all 0.3s ease;
}

.skill-category:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

.category-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.category-icon {
    width: 40px;
    height: 40px;
    background: #f1f5f9;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    color: #475569;
}

.category-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.skills-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.8rem;
}

.skill-item {
    background: #f1f5f9;
    color: #475569;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.skill-item:hover {
    background: #e2e8f0;
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
    
    .features-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .process-timeline::before {
        left: 25px;
    }
    
    .timeline-step {
        flex-direction: row !important;
        text-align: left !important;
        padding-left: 70px;
    }
    
    .step-marker {
        position: absolute;
        left: 0;
    }
    
    .step-content {
        margin: 0;
        margin-left: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .skills-categories {
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
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .hero-stats {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>
@endsection