@extends('layouts.app')

@section('content')
<div class="success-container">
    <!-- Success Hero -->
    <div class="success-hero">
        <div class="success-animation">
            <div class="check-circle">
                <svg class="check-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="success-ripples">
                <div class="ripple"></div>
                <div class="ripple"></div>
                <div class="ripple"></div>
            </div>
        </div>

        <h1 class="success-title">
            @if(app()->getLocale() == 'fr')
                Candidature envoyée avec succès !
            @else
                Application Successfully Submitted!
            @endif
        </h1>

        <p class="success-subtitle">
            @if(app()->getLocale() == 'fr')
                Félicitations ! Votre candidature pour
            @else
                Congratulations! Your application for
            @endif
            <span class="internship-highlight">{{ session('internship') }}</span>
            @if(app()->getLocale() == 'fr')
                a été transmise avec succès.
            @else
                has been successfully submitted.
            @endif
        </p>
    </div>

    <!-- Main Content -->
    <div class="success-content">
        <!-- Application Summary -->
        <div class="summary-card">
            <div class="card-header">
                <div class="header-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 11H5a2 2 0 0 0-2 2v3c0 1.1.9 2 2 2h4m0-6v6m0-6V9a2 2 0 0 1 2-2h2M9 17h10a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H19m0 0V9a2 2 0 0 0-2-2h-2m0 0V5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2"/>
                    </svg>
                </div>
                <h2 class="card-title">
                    @if(app()->getLocale() == 'fr')
                        Résumé de votre candidature
                    @else
                        Application Summary
                    @endif
                </h2>
            </div>
            
            <div class="card-content">
                <div class="summary-item">
                    <div class="item-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                        </svg>
                    </div>
                    <div class="item-content">
                        <span class="item-label">
                            @if(app()->getLocale() == 'fr')
                                Poste :
                            @else
                                Position:
                            @endif
                        </span>
                        <span class="item-value">{{ session('internship') }}</span>
                    </div>
                </div>

                <div class="summary-item">
                    <div class="item-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12,6 12,12 16,14"/>
                        </svg>
                    </div>
                    <div class="item-content">
                        <span class="item-label">
                            @if(app()->getLocale() == 'fr')
                                Envoyée le :
                            @else
                                Submitted on:
                            @endif
                        </span>
                        <span class="item-value">{{ now()->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>

                <div class="summary-item">
                    <div class="item-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <div class="item-content">
                        <span class="item-label">
                            @if(app()->getLocale() == 'fr')
                                Confirmation envoyée à :
                            @else
                                Confirmation sent to:
                            @endif
                        </span>
                        <span class="item-value">{{ session('email', 'votre adresse email') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="steps-card">
            <div class="card-header">
                <div class="header-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                    </svg>
                </div>
                <h2 class="card-title">
                    @if(app()->getLocale() == 'fr')
                        Prochaines étapes
                    @else
                        Next Steps
                    @endif
                </h2>
            </div>
            
            <div class="card-content">
                <div class="timeline">
                    <div class="timeline-item active">
                        <div class="timeline-marker">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20,6 9,17 4,12"/>
                            </svg>
                        </div>
                        <div class="timeline-content">
                            <h4 class="timeline-title">
                                @if(app()->getLocale() == 'fr')
                                    Candidature reçue
                                @else
                                    Application Received
                                @endif
                            </h4>
                            <p class="timeline-description">
                                @if(app()->getLocale() == 'fr')
                                    Votre dossier a été transmis à notre équipe de recrutement.
                                @else
                                    Your application has been forwarded to our recruitment team.
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <span class="step-number">2</span>
                        </div>
                        <div class="timeline-content">
                            <h4 class="timeline-title">
                                @if(app()->getLocale() == 'fr')
                                    Examen du dossier
                                @else
                                    Application Review
                                @endif
                            </h4>
                            <p class="timeline-description">
                                @if(app()->getLocale() == 'fr')
                                    Notre équipe examine votre candidature et la transmet à l'entreprise.
                                @else
                                    Our team reviews your application and forwards it to the company.
                                @endif
                            </p>
                            <span class="timeline-duration">
                                @if(app()->getLocale() == 'fr')
                                    2-3 jours ouvrés
                                @else
                                    2-3 business days
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <span class="step-number">3</span>
                        </div>
                        <div class="timeline-content">
                            <h4 class="timeline-title">
                                @if(app()->getLocale() == 'fr')
                                    Réponse de l'entreprise
                                @else
                                    Company Response
                                @endif
                            </h4>
                            <p class="timeline-description">
                                @if(app()->getLocale() == 'fr')
                                    Si votre profil correspond, l'entreprise vous contactera pour un entretien.
                                @else
                                    If your profile matches, the company will contact you for an interview.
                                @endif
                            </p>
                            <span class="timeline-duration">
                                @if(app()->getLocale() == 'fr')
                                    1-2 semaines
                                @else
                                    1-2 weeks
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <span class="step-number">4</span>
                        </div>
                        <div class="timeline-content">
                            <h4 class="timeline-title">
                                @if(app()->getLocale() == 'fr')
                                    Entretien
                                @else
                                    Interview
                                @endif
                            </h4>
                            <p class="timeline-description">
                                @if(app()->getLocale() == 'fr')
                                    Rencontrez l'équipe et présentez vos motivations pour le poste.
                                @else
                                    Meet the team and present your motivations for the position.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips Card -->
        <div class="tips-card">
            <div class="card-header">
                <div class="header-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 11H5a2 2 0 0 0-2 2v3c0 1.1.9 2 2 2h4m0-6v6m0-6V9a2 2 0 0 1 2-2h2M9 17h10a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H19m0 0V9a2 2 0 0 0-2-2h-2m0 0V5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2"/>
                </svg>
            </div>
            <h2 class="card-title">
                @if(app()->getLocale() == 'fr')
                    Conseils en attendant
                @else
                    Tips While You Wait
                @endif
            </h2>
        </div>
        
        <div class="card-content">
            <div class="tips-grid">
                <div class="tip-item">
                    <div class="tip-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <div class="tip-content">
                        <h4 class="tip-title">
                            @if(app()->getLocale() == 'fr')
                                Vérifiez vos emails
                            @else
                                Check Your Email
                            @endif
                        </h4>
                        <p class="tip-description">
                            @if(app()->getLocale() == 'fr')
                                Surveillez votre boîte mail, y compris les spams.
                            @else
                                Monitor your inbox, including spam folder.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="tip-item">
                    <div class="tip-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                            <rect x="2" y="9" width="4" height="12"/>
                            <circle cx="4" cy="4" r="2"/>
                        </svg>
                    </div>
                    <div class="tip-content">
                        <h4 class="tip-title">
                            @if(app()->getLocale() == 'fr')
                                Mettez à jour votre LinkedIn
                            @else
                                Update Your LinkedIn
                            @endif
                        </h4>
                        <p class="tip-description">
                            @if(app()->getLocale() == 'fr')
                                Optimisez votre profil professionnel en ligne.
                            @else
                                Optimize your professional online profile.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="tip-item">
                    <div class="tip-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                        </svg>
                    </div>
                    <div class="tip-content">
                        <h4 class="tip-title">
                            @if(app()->getLocale() == 'fr')
                                Préparez l'entretien
                            @else
                                Prepare for Interview
                            @endif
                        </h4>
                        <p class="tip-description">
                            @if(app()->getLocale() == 'fr')
                                Renseignez-vous sur l'entreprise et le secteur.
                            @else
                                Research the company and industry.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="tip-item">
                    <div class="tip-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                    </div>
                    <div class="tip-content">
                        <h4 class="tip-title">
                            @if(app()->getLocale() == 'fr')
                                Continuez à postuler
                            @else
                                Keep Applying
                            @endif
                        </h4>
                        <p class="tip-description">
                            @if(app()->getLocale() == 'fr')
                                Explorez d'autres opportunités de stage.
                            @else
                                Explore other internship opportunities.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('internships.index') }}" class="btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <path d="m21 21-4.35-4.35"/>
            </svg>
            @if(app()->getLocale() == 'fr')
                Voir d'autres stages
            @else
                View Other Internships
            @endif
        </a>
        
        <a href="/contact" class="btn-secondary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
            </svg>
            @if(app()->getLocale() == 'fr')
                Nous contacter
            @else
                Contact Us
            @endif
        </a>
    </div>

    <!-- Footer Message -->
    <div class="footer-message">
        <div class="message-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </div>
        <h3 class="message-title">
            @if(app()->getLocale() == 'fr')
                Merci pour votre confiance !
            @else
                Thank You for Your Trust!
            @endif
        </h3>
        <p class="message-text">
            @if(app()->getLocale() == 'fr')
                Nous sommes ravis de vous accompagner dans votre recherche de stage et nous vous souhaitons le meilleur pour la suite de votre parcours professionnel.
            @else
                We are delighted to support you in your internship search and wish you the best for your professional journey.
            @endif
        </p>
    </div>
</div>

<style>
.success-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Success Hero */
.success-hero {
    text-align: center;
    padding: 3rem 2rem;
    margin-bottom: 3rem;
}

.success-animation {
    position: relative;
    display: inline-block;
    margin-bottom: 2rem;
}

.check-circle {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    position: relative;
    z-index: 2;
    animation: checkBounce 1s ease-out;
}

.check-icon {
    animation: checkDraw 0.8s ease-out 0.3s both;
}

.success-ripples {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.ripple {
    position: absolute;
    width: 120px;
    height: 120px;
    border: 2px solid #28a745;
    border-radius: 50%;
    opacity: 0;
    animation: rippleEffect 2s infinite;
}

.ripple:nth-child(2) {
    animation-delay: 0.7s;
}

.ripple:nth-child(3) {
    animation-delay: 1.4s;
}

@keyframes checkBounce {
    0% { transform: scale(0); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

@keyframes checkDraw {
    0% { stroke-dasharray: 0 24; }
    100% { stroke-dasharray: 24 24; }
}

@keyframes rippleEffect {
    0% {
        transform: scale(1);
        opacity: 0.6;
    }
    100% {
        transform: scale(2.5);
        opacity: 0;
    }
}

.success-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.success-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
}

.internship-highlight {
    color: #667eea;
    font-weight: 600;
}

/* Content Cards */
.success-content {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    margin-bottom: 3rem;
}

.summary-card,
.steps-card,
.tips-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 1.5rem;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.header-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.card-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
}

.card-content {
    padding: 2rem;
}

/* Summary Items */
.summary-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.summary-item:last-child {
    border-bottom: none;
}

.item-icon {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #667eea;
    flex-shrink: 0;
}

.item-content {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.item-label {
    font-size: 0.85rem;
    color: #6c757d;
    font-weight: 500;
}

.item-value {
    font-size: 1rem;
    color: #2c3e50;
    font-weight: 600;
}

/* Timeline */
.timeline {
    position: relative;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    position: relative;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    position: relative;
    z-index: 1;
    flex-shrink: 0;
}

.timeline-item.active .timeline-marker {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border-color: #28a745;
    color: white;
}

.step-number {
    font-weight: 600;
    font-size: 0.9rem;
    color: #6c757d;
}

.timeline-content {
    flex: 1;
    padding-top: 0.5rem;
}

.timeline-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
}

.timeline-description {
    color: #6c757d;
    line-height: 1.5;
    margin: 0 0 0.5rem 0;
}

.timeline-duration {
    font-size: 0.8rem;
    color: #667eea;
    font-weight: 500;
    background: #f0f8ff;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    display: inline-block;
}

/* Tips Grid */
.tips-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

.tip-item {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.tip-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.tip-content {
    flex: 1;
}

.tip-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0 0 0.25rem 0;
}

.tip-description {
    font-size: 0.85rem;
    color: #6c757d;
    line-height: 1.4;
    margin: 0;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-bottom: 3rem;
    flex-wrap: wrap;
}

.btn-primary,
.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.btn-secondary {
    background: white;
    color: #667eea;
    border: 2px solid #667eea;
}

.btn-secondary:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

/* Footer Message */
.footer-message {
    text-align: center;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 3rem 2rem;
    border-radius: 20px;
    border: 1px solid #f0f0f0;
}

.message-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #ff6b6b 0%, #feca57 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
}

.message-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.message-text {
    color: #6c757d;
    line-height: 1.6;
    max-width: 500px;
    margin: 0 auto;
}

/* Responsive */
@media (max-width: 768px) {
    .success-container {
        padding: 1rem;
    }
    
    .success-hero {
        padding: 2rem 1rem;
    }
    
    .success-title {
        font-size: 2rem;
    }
    
    .success-subtitle {
        font-size: 1rem;
    }
    
    .check-circle {
        width: 100px;
        height: 100px;
    }
    
    .card-header {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .card-content {
        padding: 1.5rem;
    }
    
    .summary-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }
    
    .item-content {
        width: 100%;
    }
    
    .timeline::before {
        left: 15px;
    }
    
    .timeline-marker {
        width: 30px;
        height: 30px;
    }
    
    .tips-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .tip-item {
        flex-direction: column;
        text-align: center;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-primary,
    .btn-secondary {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
    
    .footer-message {
        padding: 2rem 1rem;
    }
}

@media (max-width: 480px) {
    .success-title {
        font-size: 1.75rem;
    }
    
    .check-circle {
        width: 80px;
        height: 80px;
    }
    
    .card-content {
        padding: 1.25rem;
    }
    
    .timeline-item {
        gap: 0.75rem;
    }
    
    .timeline-content {
        padding-top: 0.25rem;
    }
    
    .message-title {
        font-size: 1.25rem;
    }
}

/* Loading and entrance animations */
.success-container {
    animation: fadeInUp 0.8s ease-out;
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

.summary-card {
    animation: slideInLeft 0.6s ease-out 0.2s both;
}

.steps-card {
    animation: slideInRight 0.6s ease-out 0.4s both;
}

.tips-card {
    animation: slideInLeft 0.6s ease-out 0.6s both;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Confetti animation (optional) */
.success-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 80%, #667eea 2px, transparent 2px),
        radial-gradient(circle at 80% 20%, #764ba2 2px, transparent 2px),
        radial-gradient(circle at 40% 40%, #28a745 2px, transparent 2px),
        radial-gradient(circle at 60% 60%, #feca57 2px, transparent 2px);
    background-size: 50px 50px, 60px 60px, 40px 40px, 55px 55px;
    animation: confetti 20s linear infinite;
    opacity: 0.1;
    pointer-events: none;
}

@keyframes confetti {
    0% { transform: translateY(-100vh) rotate(0deg); }
    100% { transform: translateY(100vh) rotate(360deg); }
}

/* Hover effects */
.tip-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.summary-item:hover .item-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    transition: all 0.3s ease;
}

/* Print styles */
@media print {
    .action-buttons,
    .footer-message {
        display: none;
    }
    
    .success-container {
        box-shadow: none;
    }
    
    .card-header {
        background: #f8f9fa !important;
        -webkit-print-color-adjust: exact;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add some interactive elements
    const checkIcon = document.querySelector('.check-icon');
    
    // Animate check mark on load
    if (checkIcon) {
        checkIcon.style.strokeDasharray = '24';
        checkIcon.style.strokeDashoffset = '24';
        
        setTimeout(() => {
            checkIcon.style.transition = 'stroke-dashoffset 0.8s ease-out';
            checkIcon.style.strokeDashoffset = '0';
        }, 800);
    }
    
    // Add success sound (optional)
    // Uncomment if you want to add audio feedback
    /*
    const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmUeBzqO0vPPfCwGJXfH8N2QQAoUXrTp66hVFApGn+DyvmUeCC');
    
    setTimeout(() => {
        audio.play().catch(e => console.log('Audio play failed:', e));
    }, 1000);
    */
    
    // Auto-redirect after some time (optional)
    /*
    setTimeout(() => {
        if (confirm('Souhaitez-vous être redirigé vers la liste des stages ?')) {
            window.location.href = "{{ route('internships.index') }}";
        }
    }, 30000); // 30 seconds
    */
    
    // Track success event (for analytics)
    if (typeof gtag !== 'undefined') {
        gtag('event', 'application_submitted', {
            'event_category': 'engagement',
            'event_label': '{{ session("internship") }}',
            'value': 1
        });
    }
    
    // Add some particle effects on button hover
    const buttons = document.querySelectorAll('.btn-primary, .btn-secondary');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.02)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Smooth scroll to action buttons when page loads
    setTimeout(() => {
        const actionButtons = document.querySelector('.action-buttons');
        if (actionButtons && window.innerHeight < document.documentElement.scrollHeight) {
            actionButtons.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center' 
            });
        }
    }, 2000);
});
</script>
@endsection