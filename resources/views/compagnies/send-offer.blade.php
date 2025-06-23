@extends('layouts.app')

@section('title', 'Post an internship offer')

@section('content')
<div class="company-container">
    <!-- Hero Section -->
    <div class="company-hero offer-hero">
        <div class="hero-content">
            <h1 class="hero-title">
                Post your international internship offer
            </h1>
            <p class="hero-subtitle">
                Access our network of motivated international students and find the perfect talent for your company
            </p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">250+</span>
                    <span class="stat-label">Active offers</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">180+</span>
                    <span class="stat-label">Companies posting</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">3 days</span>
                    <span class="stat-label">Response time</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">89%</span>
                    <span class="stat-label">Placement rate</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="section-header">
            <h2 class="section-title">Why choose our platform?</h2>
            <p class="section-subtitle">A complete solution to optimize your international recruitment</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-number">01</div>
                <h3 class="feature-title">Simplified process</h3>
                <div class="feature-content">
                    <p class="feature-description">
                        Our intuitive interface guides you through creating your offer. 
                        In just a few minutes, your announcement is ready to be published.
                    </p>
                    <ul class="feature-list">
                        <li>Step-by-step guided form</li>
                        <li>Customizable templates</li>
                        <li>Real-time preview</li>
                    </ul>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-number">02</div>
                <h3 class="feature-title">Qualified candidates</h3>
                <div class="feature-content">
                    <p class="feature-description">
                        Our intelligent matching algorithm pre-selects the most 
                        relevant profiles according to your specific criteria.
                    </p>
                    <ul class="feature-list">
                        <li>Automatic pre-selection</li>
                        <li>Skills assessment</li>
                        <li>Reference verification</li>
                    </ul>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-number">03</div>
                <h3 class="feature-title">Complete support</h3>
                <div class="feature-content">
                    <p class="feature-description">
                        From publication to integration, our team supports you 
                        at every step of the recruitment process.
                    </p>
                    <ul class="feature-list">
                        <li>Dedicated advisor</li>
                        <li>Administrative support</li>
                        <li>Post-placement follow-up</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Section -->
    <div class="process-section">
        <div class="section-header">
            <h2 class="section-title">How does it work?</h2>
            <p class="section-subtitle">A proven process in 4 simple steps</p>
        </div>
        
        <div class="process-timeline">
            <div class="timeline-step">
                <div class="step-marker">1</div>
                <div class="step-content">
                    <h4 class="step-title">Create your offer</h4>
                    <p class="step-description">
                        Precisely describe your need: missions, required skills, 
                        hosting conditions and selection criteria.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">2</div>
                <div class="step-content">
                    <h4 class="step-title">Validation & Publication</h4>
                    <p class="step-description">
                        Our team validates your offer within 24h and optimizes its distribution 
                        on our network to maximize visibility.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">3</div>
                <div class="step-content">
                    <h4 class="step-title">Receive applications</h4>
                    <p class="step-description">
                        Access pre-qualified profiles via your personalized dashboard. 
                        Filter and organize your applications easily.
                    </p>
                </div>
            </div>
            
            <div class="timeline-step">
                <div class="step-marker">4</div>
                <div class="step-content">
                    <h4 class="step-title">Selection & Integration</h4>
                    <p class="step-description">
                        Schedule your interviews and benefit from our support for 
                        the successful integration of your new intern.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="section-header">
            <h2 class="section-title">Measured results</h2>
            <p class="section-subtitle">Performance that speaks for itself</p>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value">89%</div>
                <div class="stat-label">Successful placement rate</div>
                <div class="stat-detail">9 out of 10 offers find their ideal candidate</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-value">72h</div>
                <div class="stat-label">Average time to first application</div>
                <div class="stat-detail">Receive qualified profiles quickly</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-value">45</div>
                <div class="stat-label">Nationalities represented</div>
                <div class="stat-detail">Exceptional cultural diversity</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-value">4.8/5</div>
                <div class="stat-label">Client satisfaction</div>
                <div class="stat-detail">Average rating from our partners</div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">Post your internship offer</h2>
            <p class="cta-subtitle">
                Join the companies who trust our expertise to recruit their future talents
            </p>
            <div class="cta-actions">
                <a href="{{ route('compagnies.register', ['type' => 'offer_sender']) }}" class="btn-primary">
                    Post an offer
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>
                <div class="cta-benefits">
                    <span class="benefit-item">✓ Free posting</span>
                    <span class="benefit-item">✓ Validation within 24h</span>
                    <span class="benefit-item">✓ Support included</span>
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