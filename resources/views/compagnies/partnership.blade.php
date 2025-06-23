@extends('layouts.app')

@section('title', 'How do we work with companies?')

@section('content')
<div class="company-container">
    <!-- Hero Section -->
    <div class="company-hero partnership-hero">
        <div class="hero-content">
            <h1 class="hero-title">
                How do we work with companies?
            </h1>
            <p class="hero-subtitle">
                Discover our customized partnership solutions to develop your business with international talents
            </p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['active_partnerships'] ?? 0 }}+</span>
                    <span class="stat-label">Active partnerships</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['total_companies'] ?? 0 }}+</span>
                    <span class="stat-label">Partner companies</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['avg_partnership_duration'] ?? '2.5 years' }}</span>
                    <span class="stat-label">Average duration</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['success_rate'] ?? 0 }}%</span>
                    <span class="stat-label">Success rate</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="services-section">
        <div class="section-header">
            <h2 class="section-title">Most requested services</h2>
            <p class="section-subtitle">Our solutions adapted to our partners' needs</p>
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
                        <p class="service-count">{{ $count }} companies</p>
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
                    <h4 class="service-title">Recruitment consulting</h4>
                    <p class="service-count">HR expertise</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                        </svg>
                    </div>
                    <h4 class="service-title">Cross-cultural training</h4>
                    <p class="service-count">Optimal integration</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect width="16" height="10" x="2" y="3" rx="2"/>
                            <path d="M12 17v4"/>
                        </svg>
                    </div>
                    <h4 class="service-title">Technology tools</h4>
                    <p class="service-count">Digital solutions</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 10v12"/>
                            <path d="M15 5v16"/>
                        </svg>
                    </div>
                    <h4 class="service-title">Marketing support</h4>
                    <p class="service-count">Targeted communication</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="3"/>
                            <path d="M12 1v6"/>
                        </svg>
                    </div>
                    <h4 class="service-title">Personalized follow-up</h4>
                    <p class="service-count">Dedicated support</p>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/>
                        </svg>
                    </div>
                    <h4 class="service-title">Legal documentation</h4>
                    <p class="service-count">Compliance assured</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Process Section -->
    <div class="process-section">
        <div class="section-header">
            <h2 class="section-title">Our partnership process</h2>
            <p class="section-subtitle">A structured approach in 4 steps for a successful partnership</p>
        </div>
        
        <div class="process-timeline">
            <div class="timeline-step">
                <div class="step-marker">01</div>
                <div class="step-content">
                    <h4 class="step-title">Initial assessment</h4>
                    <p class="step-description">
                        In-depth analysis of your needs, objectives and constraints to define the optimal partnership.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">02</div>
                <div class="step-content">
                    <h4 class="step-title">Customized proposal</h4>
                    <p class="step-description">
                        Development of a personalized solution with transparent pricing and detailed planning.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">03</div>
                <div class="step-content">
                    <h4 class="step-title">Implementation</h4>
                    <p class="step-description">
                        Partnership launch with team training and integration of our services.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">04</div>
                <div class="step-content">
                    <h4 class="step-title">Monitoring & optimization</h4>
                    <p class="step-description">
                        Continuous monitoring of results and adjustments to maximize performance.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">Ready for a partnership?</h2>
            <p class="cta-subtitle">
                Join our {{ $stats['active_partnerships'] ?? '50' }}+ partners and develop your business with international talents
            </p>
            <div class="cta-actions">
                <a href="{{ route('company.register', ['type' => 'partnership']) }}" class="btn-primary">
                    Start a partnership
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
                <div class="cta-benefits">
                    <span class="benefit-item">✓ Free consultation</span>
                    <span class="benefit-item">✓ Personalized quote</span>
                    <span class="benefit-item">✓ Dedicated support</span>
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