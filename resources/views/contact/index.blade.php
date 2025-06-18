@extends('layouts.app')

@section('content')
<div class="contact-container">
    <!-- Header avec titre accrocheur -->
    <div class="contact-hero">
        <h1 class="hero-title">
            @if(app()->getLocale() == 'fr')
                Besoin d'aide ? Contactez-nous !
            @else
                Need help? Contact us!
            @endif
        </h1>
        <p class="hero-subtitle">
            @if(app()->getLocale() == 'fr')
                Notre équipe est là pour répondre à toutes vos questions et vous accompagner dans votre recherche de stage
            @else
                Our team is here to answer all your questions and support you in your internship search
            @endif
        </p>
    </div>

    <!-- Contenu principal -->
    <div class="contact-main">
        <!-- Formulaire principal -->
        <div class="contact-form-section">
            <div class="form-header">
                <h2 class="form-title">
                    @if(app()->getLocale() == 'fr')
                        Envoyez-nous un message
                    @else
                        Send us a message
                    @endif
                </h2>
                <p class="form-subtitle">
                    @if(app()->getLocale() == 'fr')
                        Remplissez le formulaire ci-dessous et nous vous répondrons rapidement
                    @else
                        Fill out the form below and we'll get back to you quickly
                    @endif
                </p>
            </div>

            @if (session('success'))
                <div class="alert-success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20,6 9,17 4,12"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-error">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="15" y1="9" x2="9" y2="15"/>
                        <line x1="9" y1="9" x2="15" y2="15"/>
                    </svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.send') }}" class="contact-form" id="contactForm">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="form-label">
                            @if(app()->getLocale() == 'fr')
                                Nom complet *
                            @else
                                Full Name *
                            @endif
                        </label>
                        <input 
                            type="text" 
                            id="name"
                            name="name" 
                            class="form-input"
                            value="{{ old('name') }}"
                            placeholder="Votre nom et prénom"
                            required>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">
                            @if(app()->getLocale() == 'fr')
                                Adresse email *
                            @else
                                Email Address *
                            @endif
                        </label>
                        <input 
                            type="email" 
                            id="email"
                            name="email" 
                            class="form-input"
                            value="{{ old('email') }}"
                            placeholder="votre.email@exemple.com"
                            required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone" class="form-label">
                            @if(app()->getLocale() == 'fr')
                                Téléphone
                            @else
                                Phone
                            @endif
                        </label>
                        <input 
                            type="tel" 
                            id="phone"
                            name="phone" 
                            class="form-input"
                            value="{{ old('phone') }}"
                            placeholder="+33 6 12 34 56 78">
                        @error('phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subject" class="form-label">
                            @if(app()->getLocale() == 'fr')
                                Sujet
                            @else
                                Subject
                            @endif
                        </label>
                        <select id="subject" name="subject" class="form-select">
                            <option value="">
                                @if(app()->getLocale() == 'fr')
                                    Choisissez un sujet
                                @else
                                    Choose a subject
                                @endif
                            </option>
                            <option value="stage" {{ old('subject') == 'stage' ? 'selected' : '' }}>
                                @if(app()->getLocale() == 'fr')
                                    Demande de stage
                                @else
                                    Internship request
                                @endif
                            </option>
                            <option value="info" {{ old('subject') == 'info' ? 'selected' : '' }}>
                                @if(app()->getLocale() == 'fr')
                                    Demande d'informations
                                @else
                                    Information request
                                @endif
                            </option>
                            <option value="partenariat" {{ old('subject') == 'partenariat' ? 'selected' : '' }}>
                                @if(app()->getLocale() == 'fr')
                                    Partenariat
                                @else
                                    Partnership
                                @endif
                            </option>
                            <option value="autre" {{ old('subject') == 'autre' ? 'selected' : '' }}>
                                @if(app()->getLocale() == 'fr')
                                    Autre
                                @else
                                    Other
                                @endif
                            </option>
                        </select>
                        @error('subject')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="form-label">
                        @if(app()->getLocale() == 'fr')
                            Votre message *
                        @else
                            Your Message *
                        @endif
                    </label>
                    <textarea 
                        id="message"
                        name="message" 
                        class="form-textarea"
                        placeholder="@if(app()->getLocale() == 'fr')Décrivez votre demande en détail...@elseDescribe your request in detail...@endif"
                        rows="6"
                        required>{{ old('message') }}</textarea>
                    @error('message')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- RGPD disclaimer -->
                <div class="rgpd-section">
                    <label class="checkbox-container">
                        <input type="checkbox" name="rgpd_consent" required {{ old('rgpd_consent') ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        <span class="checkbox-text">
                            @if(app()->getLocale() == 'fr')
                                J'accepte que mes données personnelles soient utilisées pour traiter ma demande. 
                                <a href="#" class="privacy-link">Voir notre politique de confidentialité</a>
                            @else
                                I agree that my personal data may be used to process my request. 
                                <a href="#" class="privacy-link">See our privacy policy</a>
                            @endif
                        </span>
                    </label>
                    @error('rgpd_consent')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="submit-button" id="submitBtn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="submit-icon">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <div class="loading-spinner" style="display: none;">
                            <div class="spinner"></div>
                        </div>
                        <span class="submit-text">
                            @if(app()->getLocale() == 'fr')
                                Envoyer le message
                            @else
                                Send message
                            @endif
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Sidebar avec contact direct -->
        <div class="contact-sidebar">
            <!-- Contact direct -->
            <div class="contact-card">
                <h3 class="card-title">
                    @if(app()->getLocale() == 'fr')
                        Contact direct
                    @else
                        Direct contact
                    @endif
                </h3>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <div class="contact-details">
                        <strong>Email</strong>
                        <a href="mailto:contact@nexaid.com">contact@nexaid.com</a>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <div class="contact-details">
                        <strong>Téléphone</strong>
                        <a href="tel:+33123456789">+33 1 23 45 67 89</a>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <div class="contact-details">
                        <strong>Adresse</strong>
                        <span>10 rue du Stage<br>75001 Paris, France</span>
                    </div>
                </div>
            </div>

            <!-- Localisation sans Google Maps pour éviter les erreurs -->
            <div class="contact-card">
                <h3 class="card-title">
                    @if(app()->getLocale() == 'fr')
                        Nous trouver
                    @else
                        Find us
                    @endif
                </h3>
                <div class="location-info">
                    <div class="location-display">
                        <div class="location-icon">📍</div>
                        <div class="location-text">
                            <strong>10 rue du Stage</strong><br>
                            75001 Paris, France
                        </div>
                    </div>
                    <a href="https://maps.google.com/?q=10+rue+du+Stage+75001+Paris" 
                       target="_blank" 
                       class="map-link">
                        🗺️ Voir sur Google Maps
                    </a>
                </div>
            </div>

            <!-- Réseaux sociaux -->
            <div class="contact-card">
                <h3 class="card-title">
                    @if(app()->getLocale() == 'fr')
                        Suivez-nous
                    @else
                        Follow us
                    @endif
                </h3>
                <div class="social-links">
                    <a href="#" class="social-link linkedin">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                            <rect x="2" y="9" width="4" height="12"/>
                            <circle cx="4" cy="4" r="2"/>
                        </svg>
                        <span>LinkedIn</span>
                    </a>
                    <a href="#" class="social-link instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                        <span>Instagram</span>
                    </a>
                    <a href="#" class="social-link twitter">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
                        </svg>
                        <span>Twitter</span>
                    </a>
                </div>
            </div>

            <!-- FAQ rapide -->
            <div class="contact-card">
                <h3 class="card-title">
                    @if(app()->getLocale() == 'fr')
                        Questions fréquentes
                    @else
                        Frequently asked questions
                    @endif
                </h3>
                <div class="quick-faq">
                    <div class="faq-item">
                        <strong>
                            @if(app()->getLocale() == 'fr')
                                Délai de réponse ?
                            @else
                                Response time?
                            @endif
                        </strong>
                        <span>
                            @if(app()->getLocale() == 'fr')
                                Nous répondons sous 24h
                            @else
                                We respond within 24h
                            @endif
                        </span>
                    </div>
                    <div class="faq-item">
                        <strong>
                            @if(app()->getLocale() == 'fr')
                                Stages disponibles ?
                            @else
                                Available internships?
                            @endif
                        </strong>
                        <span>
                            @if(app()->getLocale() == 'fr')
                                Consultez nos offres en ligne
                            @else
                                Check our online offers
                            @endif
                        </span>
                    </div>
                    <div class="faq-item">
                        <strong>
                            @if(app()->getLocale() == 'fr')
                                Candidature spontanée ?
                            @else
                                Spontaneous application?
                            @endif
                        </strong>
                        <span>
                            @if(app()->getLocale() == 'fr')
                                Toujours possible via ce formulaire
                            @else
                                Always possible via this form
                            @endif
                        </span>
                    </div>
                </div>
                <a href="/faq" class="faq-link">
                    @if(app()->getLocale() == 'fr')
                        Voir toutes les FAQ →
                    @else
                        View all FAQs →
                    @endif
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.contact-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.contact-hero {
    text-align: center;
    margin-bottom: 4rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4rem 2rem;
    border-radius: 24px;
    position: relative;
    overflow: hidden;
}

.contact-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    position: relative;
    z-index: 1;
}

.hero-subtitle {
    font-size: 1.3rem;
    opacity: 0.9;
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.6;
    position: relative;
    z-index: 1;
}

.contact-main {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
}

.contact-form-section {
    background: white;
    padding: 3rem;
    border-radius: 24px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.1);
    border: 1px solid #f0f0f0;
}

.form-header {
    margin-bottom: 2rem;
    text-align: center;
}

.form-title {
    font-size: 1.8rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.form-subtitle {
    color: #6c757d;
    font-size: 1rem;
    line-height: 1.5;
}

.alert-success,
.alert-error {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    font-weight: 500;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-input,
.form-select,
.form-textarea {
    padding: 1rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
    font-family: inherit;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 120px;
}

.error-message {
    color: #dc3545;
    font-size: 0.85rem;
    margin-top: 0.5rem;
}

.rgpd-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.checkbox-container {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    cursor: pointer;
    line-height: 1.5;
}

.checkbox-container input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    background: white;
    border: 2px solid #dee2e6;
    border-radius: 4px;
    position: relative;
    flex-shrink: 0;
    margin-top: 2px;
    transition: all 0.3s ease;
}

.checkbox-container input[type="checkbox"]:checked + .checkmark {
    background: #667eea;
    border-color: #667eea;
}

.checkbox-container input[type="checkbox"]:checked + .checkmark::after {
    content: '';
    position: absolute;
    left: 6px;
    top: 2px;
    width: 6px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.checkbox-text {
    font-size: 0.9rem;
    color: #495057;
}

.privacy-link {
    color: #667eea;
    text-decoration: none;
}

.privacy-link:hover {
    text-decoration: underline;
}

.form-actions {
    margin-top: 1rem;
}

.submit-button {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.25rem 2.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: inherit;
    width: 100%;
    justify-content: center;
    position: relative;
}

.submit-button:hover:not(.loading) {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.submit-button.loading {
    opacity: 0.8;
    cursor: not-allowed;
    pointer-events: none;
}

.submit-button.loading .submit-icon {
    display: none;
}

.submit-button.loading .loading-spinner {
    display: block !important;
}

.loading-spinner {
    width: 20px;
    height: 20px;
}

.spinner {
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255,255,255,0.3);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.contact-sidebar {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.contact-card {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

.card-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 1.5rem;
    text-align: center;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.contact-item:last-child {
    margin-bottom: 0;
}

.contact-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.contact-details {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.contact-details strong {
    color: #2c3e50;
    font-weight: 600;
    font-size: 0.9rem;
}

.contact-details a,
.contact-details span {
    color: #6c757d;
    text-decoration: none;
    font-size: 0.9rem;
    line-height: 1.4;
}

.contact-details a:hover {
    color: #667eea;
}

.location-info {
    margin-top: 1rem;
}

.location-display {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 1rem;
}

.location-icon {
    font-size: 2rem;
}

.location-text {
    line-height: 1.4;
    color: #2c3e50;
}

.map-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #667eea;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    width: 100%;
    justify-content: center;
}

.map-link:hover {
    background: #5a6fd8;
    transform: translateY(-1px);
}

.social-links {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.social-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    border-radius: 12px;
    text-decoration: none;
    color: #495057;
    background: #f8f9fa;
    transition: all 0.3s ease;
    font-weight: 500;
}

.social-link:hover {
    transform: translateX(5px);
    color: white;
}

.social-link.linkedin:hover {
    background: #0077b5;
}

.social-link.instagram:hover {
    background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
}

.social-link.twitter:hover {
    background: #1da1f2;
}

.quick-faq {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.faq-item {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #667eea;
}

.faq-item strong {
    display: block;
    color: #2c3e50;
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
}

.faq-item span {
    color: #6c757d;
    font-size: 0.85rem;
}

.faq-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 1rem;
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.faq-link:hover {
    gap: 0.75rem;
}

/* Responsive */
@media (max-width: 1024px) {
    .contact-main {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}

@media (max-width: 768px) {
    .contact-container {
        padding: 1rem;
    }
    
    .contact-hero {
        padding: 3rem 1.5rem;
    }
    
    .hero-title {
        font-size: 2.2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .contact-form-section {
        padding: 2rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .contact-card {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .contact-form-section {
        padding: 1.5rem;
    }
    
    .submit-button {
        padding: 1rem 2rem;
    }
}
</style>

<script>
// JavaScript pour l'amélioration de l'UX
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = submitBtn.querySelector('.submit-text');
    
    // Animation de soumission
    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            submitBtn.classList.add('loading');
            submitText.textContent = '@if(app()->getLocale() == "fr")Envoi en cours...@elseSubmitting...@endif';
        });
    }
    
    // Validation en temps réel
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateField(this);
            }
        });
    });
    
    function validateField(field) {
        const errorMessage = field.parentNode.querySelector('.error-message');
        
        // Supprimer les anciens messages d'erreur
        if (errorMessage && !errorMessage.textContent.includes('{{ ')) {
            errorMessage.remove();
        }
        
        field.classList.remove('error');
        
        if (!field.value.trim() && field.hasAttribute('required')) {
            field.classList.add('error');
            field.style.borderColor = '#dc3545';
        } else if (field.type === 'email' && field.value && !isValidEmail(field.value)) {
            field.classList.add('error');
            field.style.borderColor = '#dc3545';
        } else {
            field.style.borderColor = '#28a745';
            setTimeout(() => {
                field.style.borderColor = '#e9ecef';
            }, 2000);
        }
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Compteur de caractères pour le message
    const messageTextarea = document.getElementById('message');
    if (messageTextarea) {
        const maxLength = 2000;
        const counter = document.createElement('div');
        counter.className = 'character-counter';
        counter.style.cssText = 'text-align: right; font-size: 0.8rem; color: #6c757d; margin-top: 0.5rem;';
        messageTextarea.parentNode.appendChild(counter);
        
        function updateCounter() {
            const remaining = maxLength - messageTextarea.value.length;
            counter.textContent = `${messageTextarea.value.length}/${maxLength} caractères`;
            
            if (remaining < 100) {
                counter.style.color = '#dc3545';
            } else if (remaining < 200) {
                counter.style.color = '#ffc107';
            } else {
                counter.style.color = '#6c757d';
            }
        }
        
        messageTextarea.addEventListener('input', updateCounter);
        updateCounter();
    }
    
    // Auto-resize pour le textarea
    messageTextarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 200) + 'px';
    });
    
    // Gestion des erreurs JavaScript globales pour éviter les interruptions
    window.addEventListener('error', function(e) {
        console.warn('Erreur JavaScript interceptée:', e.error);
        return true; // Empêche l'arrêt du script
    });
    
    // Animation d'apparition des éléments
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });
    
    // Animation pour les cartes de la sidebar
    document.querySelectorAll('.contact-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
    
    // Confirmation visuelle après soumission réussie
    @if(session('success'))
        setTimeout(() => {
            const successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                successAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
                successAlert.style.animation = 'pulse 0.5s ease-in-out';
            }
        }, 100);
    @endif
});

// Animation CSS pour le pulse
const style = document.createElement('style');
style.textContent = `
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .form-input.error,
    .form-textarea.error,
    .form-select.error {
        animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
`;
document.head.appendChild(style);
</script>
@endsection