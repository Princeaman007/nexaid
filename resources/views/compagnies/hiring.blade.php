@extends('layouts.app')

@section('title', 'Why hire an international intern?')

@section('content')
<div class="company-container">
    <!-- Hero Section -->
    <div class="company-hero hiring-hero">
        <div class="hero-content">
            <h1 class="hero-title">
                Why hire an international intern?
            </h1>
            <p class="hero-subtitle">
                Enrich your team with motivated international talents and discover new cultural perspectives
            </p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['hiring_companies'] ?? 0 }}+</span>
                    <span class="stat-label">Hiring companies</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['total_interns_placed'] ?? 0 }}+</span>
                    <span class="stat-label">Internships completed</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['countries_represented'] ?? 0 }}+</span>
                    <span class="stat-label">Countries represented</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['satisfaction_rate'] ?? 0 }}%</span>
                    <span class="stat-label">Satisfaction rate</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="benefits-section">
        <div class="section-header">
            <h2 class="section-title">The advantages of an international intern</h2>
            <p class="section-subtitle">Discover how to enrich your team with global perspectives</p>
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
                <h3 class="benefit-title">Cultural diversity</h3>
                <div class="benefit-content">
                    <p class="benefit-description">
                        Enrich your team with international perspectives and develop 
                        cultural openness for increased innovation.
                    </p>
                    <ul class="benefit-features">
                        <li>New creative approaches</li>
                        <li>Multicultural perspectives</li>
                        <li>Team enrichment</li>
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
                <h3 class="benefit-title">Specialized skills</h3>
                <div class="benefit-content">
                    <p class="benefit-description">
                        Access talents trained in different educational systems with 
                        innovative approaches and unique methodologies.
                    </p>
                    <ul class="benefit-features">
                        <li>International training</li>
                        <li>Diverse methodologies</li>
                        <li>Technical expertise</li>
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
                <h3 class="benefit-title">International expansion</h3>
                <div class="benefit-content">
                    <p class="benefit-description">
                        Facilitate your development in new markets through their 
                        local knowledge and international networks.
                    </p>
                    <ul class="benefit-features">
                        <li>Market knowledge</li>
                        <li>International networks</li>
                        <li>Expansion opportunities</li>
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
                <h3 class="benefit-title">Dynamism</h3>
                <div class="benefit-content">
                    <p class="benefit-description">
                        Benefit from their exceptional motivation and adaptability 
                        in a new professional environment.
                    </p>
                    <ul class="benefit-features">
                        <li>High motivation</li>
                        <li>Adaptability</li>
                        <li>Fresh energy</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Section -->
    <div class="process-section">
        <div class="section-header">
            <h2 class="section-title">Our recruitment process</h2>
            <p class="section-subtitle">Personalized support in 3 key steps</p>
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
                    <h4 class="step-title">Analyze your needs</h4>
                    <p class="step-description">
                        We study in detail your company culture, projects and specific 
                        requirements to identify the ideal profile.
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
                    <h4 class="step-title">Rigorous selection</h4>
                    <p class="step-description">
                        We carefully pre-select candidates according to your criteria: 
                        technical skills, languages, international experience.
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
                    <h4 class="step-title">Complete support</h4>
                    <p class="step-description">
                        Administrative support, cultural integration assistance and personalized 
                        follow-up throughout the internship to ensure success.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">Ready to enrich your team?</h2>
            <p class="cta-subtitle">
                Join the {{ $stats['hiring_companies'] ?? '150' }}+ companies who trust our expertise to recruit their future talents
            </p>
            <div class="cta-actions">
                <a href="{{ route('company.register', ['type' => 'hiring']) }}" class="btn-primary">
                    Start recruiting
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
                <div class="cta-benefits">
                    <span class="benefit-item">✓ Free and no commitment</span>
                    <span class="benefit-item">✓ 24h response</span>
                    <span class="benefit-item">✓ Personalized support</span>
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
    
    .benefit-card {
        padding: 1.5rem;
    }
}
</style>
@endsection