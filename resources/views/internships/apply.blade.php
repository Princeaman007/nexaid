@extends('layouts.app')

@section('content')
<div class="apply-container">
    <!-- Hero Section -->
    <div class="apply-hero">
        <nav class="breadcrumb">
            <a href="{{ route('internships.show', $internship->slug) }}" class="breadcrumb-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
                @if(app()->getLocale() == 'fr')
                    Retour à l'offre
                @else
                    Back to offer
                @endif
            </a>
        </nav>

        <div class="hero-content">
            <div class="hero-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                </svg>
            </div>
            
            <h1 class="hero-title">
                @if(app()->getLocale() == 'fr')
                    Postuler pour ce stage
                @else
                    Apply for this internship
                @endif
            </h1>
            
            <div class="hero-internship">
                <h2 class="internship-title">
                    {{ $internship->getTranslation('title', app()->getLocale()) }}
                </h2>
                <div class="internship-meta">
                    @if($internship->company_name)
                        <span class="meta-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 21h18"/>
                                <path d="M5 21V7l8-4v18"/>
                            </svg>
                            {{ $internship->company_name }}
                        </span>
                    @endif
                    
                    @if($internship->location)
                        <span class="meta-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            {{ $internship->location }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Application Form -->
    <div class="apply-content">
        <div class="form-container">
            @if ($errors->any())
                <div class="alert-error">
                    <div class="alert-header">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="15" y1="9" x2="9" y2="15"/>
                            <line x1="9" y1="9" x2="15" y2="15"/>
                        </svg>
                        <span>
                            @if(app()->getLocale() == 'fr')
                                Veuillez corriger les erreurs suivantes :
                            @else
                                Please correct the following errors:
                            @endif
                        </span>
                    </div>
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('internships.apply.submit', $internship->id) }}" method="POST" enctype="multipart/form-data" class="apply-form">
                @csrf
                
                <!-- Personal Information -->
                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <h3 class="section-title">
                            @if(app()->getLocale() == 'fr')
                                Informations personnelles
                            @else
                                Personal Information
                            @endif
                        </h3>
                        <p class="section-subtitle">
                            @if(app()->getLocale() == 'fr')
                                Parlez-nous de vous
                            @else
                                Tell us about yourself
                            @endif
                        </p>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                                @if(app()->getLocale() == 'fr')
                                    Nom complet *
                                @else
                                    Full Name *
                                @endif
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   class="form-input @error('name') error @enderror"
                                   placeholder="Jean Dupont"
                                   required>
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                @if(app()->getLocale() == 'fr')
                                    Adresse email *
                                @else
                                    Email Address *
                                @endif
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   class="form-input @error('email') error @enderror"
                                   placeholder="jean.dupont@email.com"
                                   required>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                                @if(app()->getLocale() == 'fr')
                                    Téléphone
                                @else
                                    Phone Number
                                @endif
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   class="form-input @error('phone') error @enderror"
                                   placeholder="+33 6 12 34 56 78">
                            @error('phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="linkedin" class="form-label">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                                    <rect x="2" y="9" width="4" height="12"/>
                                    <circle cx="4" cy="4" r="2"/>
                                </svg>
                                @if(app()->getLocale() == 'fr')
                                    Profil LinkedIn
                                @else
                                    LinkedIn Profile
                                @endif
                            </label>
                            <input type="url" 
                                   id="linkedin" 
                                   name="linkedin" 
                                   value="{{ old('linkedin') }}" 
                                   class="form-input @error('linkedin') error @enderror"
                                   placeholder="https://www.linkedin.com/in/username">
                            @error('linkedin')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Background Section -->
                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                            </svg>
                        </div>
                        <h3 class="section-title">
                            @if(app()->getLocale() == 'fr')
                                Votre parcours
                            @else
                                Your Background
                            @endif
                        </h3>
                        <p class="section-subtitle">
                            @if(app()->getLocale() == 'fr')
                                Décrivez votre formation et expérience
                            @else
                                Describe your education and experience
                            @endif
                        </p>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="education" class="form-label">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                                    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                                </svg>
                                @if(app()->getLocale() == 'fr')
                                    Formation actuelle
                                @else
                                    Current Education
                                @endif
                            </label>
                            <textarea id="education" 
                                      name="education" 
                                      rows="4" 
                                      class="form-textarea @error('education') error @enderror"
                                      placeholder="@if(app()->getLocale() == 'fr')Master en Informatique à l'Université de Paris, spécialisation développement web...@elseMaster in Computer Science at University of Paris, specializing in web development...@endif">{{ old('education') }}</textarea>
                            @error('education')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="experience" class="form-label">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                    <line x1="8" y1="21" x2="16" y2="21"/>
                                    <line x1="12" y1="17" x2="12" y2="21"/>
                                </svg>
                                @if(app()->getLocale() == 'fr')
                                    Expérience professionnelle
                                @else
                                    Professional Experience
                                @endif
                            </label>
                            <textarea id="experience" 
                                      name="experience" 
                                      rows="4" 
                                      class="form-textarea @error('experience') error @enderror"
                                      placeholder="@if(app()->getLocale() == 'fr')Stage de 3 mois chez TechCorp en développement frontend, projets personnels...@else3-month internship at TechCorp in frontend development, personal projects...@endif">{{ old('experience') }}</textarea>
                            @error('experience')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Documents Section -->
                <div class="form-section">
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
                        <h3 class="section-title">
                            @if(app()->getLocale() == 'fr')
                                Documents requis
                            @else
                                Required Documents
                            @endif
                        </h3>
                        <p class="section-subtitle">
                            @if(app()->getLocale() == 'fr')
                                Joignez vos documents de candidature
                            @else
                                Attach your application documents
                            @endif
                        </p>
                    </div>

                    <div class="documents-grid">
                        <div class="form-group">
                            <label for="cv" class="form-label">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14,2 14,8 20,8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                    <polyline points="10,9 9,9 8,9"/>
                                </svg>
                                @if(app()->getLocale() == 'fr')
                                    Curriculum Vitae *
                                @else
                                    Resume/CV *
                                @endif
                            </label>
                            <div class="file-upload-container">
                                <input type="file" 
                                       id="cv" 
                                       name="cv" 
                                       class="file-input @error('cv') error @enderror"
                                       accept=".pdf,.doc,.docx"
                                       required>
                                <label for="cv" class="file-upload-label">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                        <polyline points="7,10 12,15 17,10"/>
                                        <line x1="12" y1="15" x2="12" y2="3"/>
                                    </svg>
                                    <span class="upload-text">
                                        @if(app()->getLocale() == 'fr')
                                            Choisir un fichier ou glisser-déposer
                                        @else
                                            Choose file or drag and drop
                                        @endif
                                    </span>
                                    <span class="upload-subtext">PDF, DOC, DOCX (Max. 5MB)</span>
                                </label>
                            </div>
                            @error('cv')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Cover Letter Section -->
                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <h3 class="section-title">
                            @if(app()->getLocale() == 'fr')
                                Lettre de motivation
                            @else
                                Cover Letter
                            @endif
                        </h3>
                        <p class="section-subtitle">
                            @if(app()->getLocale() == 'fr')
                                Exprimez votre motivation pour ce stage
                            @else
                                Express your motivation for this internship
                            @endif
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="cover_letter" class="form-label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14,2 14,8 20,8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <polyline points="10,9 9,9 8,9"/>
                            </svg>
                            @if(app()->getLocale() == 'fr')
                                Votre message *
                            @else
                                Your Message *
                            @endif
                        </label>
                        <textarea id="cover_letter" 
                                  name="cover_letter" 
                                  rows="8" 
                                  class="form-textarea @error('cover_letter') error @enderror"
                                  placeholder="@if(app()->getLocale() == 'fr')Expliquez pourquoi vous êtes intéressé(e) par ce stage, quelles compétences vous apportez, et comment cette expérience s'inscrit dans votre projet professionnel...@elseExplain why you are interested in this internship, what skills you bring, and how this experience fits into your career plan...@endif"
                                  required>{{ old('cover_letter') }}</textarea>
                        @error('cover_letter')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <div class="character-counter">
                            <span id="charCount">0</span> / 2000 
                            @if(app()->getLocale() == 'fr')
                                caractères
                            @else
                                characters
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Terms Section -->
                <div class="form-section">
                    <div class="terms-container">
                        <div class="checkbox-container">
                            <input type="checkbox" 
                                   id="agree_terms" 
                                   name="agree_terms" 
                                   class="checkbox-input @error('agree_terms') error @enderror"
                                   required>
                            <label for="agree_terms" class="checkbox-label">
                                <div class="checkbox-custom"></div>
                                <div class="checkbox-text">
                                    @if(app()->getLocale() == 'fr')
                                        J'accepte que mes données personnelles soient traitées pour cette candidature et partagées avec l'entreprise proposant ce stage. Je comprends que je peux retirer mon consentement à tout moment.
                                    @else
                                        I agree that my personal data will be processed for this application and shared with the company offering this internship. I understand that I can withdraw my consent at any time.
                                    @endif
                                    <a href="#" class="privacy-link">
                                        @if(app()->getLocale() == 'fr')
                                            Politique de confidentialité
                                        @else
                                            Privacy Policy
                                        @endif
                                    </a>
                                </div>
                            </label>
                        </div>
                        @error('agree_terms')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-actions">
                    <button type="submit" class="submit-button">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        @if(app()->getLocale() == 'fr')
                            Soumettre ma candidature
                        @else
                            Submit My Application
                        @endif
                    </button>
                    
                    <p class="submit-note">
                        @if(app()->getLocale() == 'fr')
                            Votre candidature sera envoyée directement à l'entreprise. Vous recevrez une confirmation par email.
                        @else
                            Your application will be sent directly to the company. You will receive an email confirmation.
                        @endif
                    </p>
                </div>
            </form>
        </div>

        <!-- Sidebar Tips -->
        <div class="tips-sidebar">
            <div class="tips-card">
                <div class="tips-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 11H5a2 2 0 0 0-2 2v3c0 1.1.9 2 2 2h4m0-6v6m0-6V9a2 2 0 0 1 2-2h2M9 17h10a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H19m0 0V9a2 2 0 0 0-2-2h-2m0 0V5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2"/>
                    </svg>
                    <h3>
                        @if(app()->getLocale() == 'fr')
                            Conseils pour votre candidature
                        @else
                            Application Tips
                        @endif
                    </h3>
                </div>
                
                <div class="tips-content">
                    <div class="tip-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20,6 9,17 4,12"/>
                        </svg>
                        <span>
                            @if(app()->getLocale() == 'fr')
                                Personnalisez votre lettre de motivation
                            @else
                                Personalize your cover letter
                            @endif
                        </span>
                    </div>
                    
                    <div class="tip-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20,6 9,17 4,12"/>
                        </svg>
                        <span>
                            @if(app()->getLocale() == 'fr')
                                Mettez en avant vos compétences pertinentes
                            @else
                                Highlight your relevant skills
                            @endif
                        </span>
                    </div>
                    
                    <div class="tip-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20,6 9,17 4,12"/>
                        </svg>
                        <span>
                            @if(app()->getLocale() == 'fr')
                                Relisez attentivement avant d'envoyer
                            @else
                                Proofread carefully before submitting
                            @endif
                        </span>
                    </div>
                    
                    <div class="tip-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20,6 9,17 4,12"/>
                        </svg>
                        <span>
                            @if(app()->getLocale() == 'fr')
                                Assurez-vous que votre CV est à jour
                            @else
                                Make sure your CV is up to date
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div class="support-card">
                <div class="support-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 17h.01"/>
                    </svg>
                    <h3>
                        @if(app()->getLocale() == 'fr')
                            Besoin d'aide ?
                        @else
                            Need Help?
                        @endif
                    </h3>
                </div>
                
                <div class="support-content">
                    <p>
                        @if(app()->getLocale() == 'fr')
                            Notre équipe est là pour vous accompagner dans votre candidature.
                        @else
                            Our team is here to help you with your application.
                        @endif
                    </p>
                    <a href="/contact" class="support-link">
                        @if(app()->getLocale() == 'fr')
                            Nous contacter
                        @else
                            Contact us
                        @endif
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m9 18 6-6-6-6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.apply-container {
    max-width: 1200px;
    margin: 0 auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Hero Section */
.apply-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem 2rem;
    border-radius: 0 0 32px 32px;
    margin-bottom: 3rem;
}

.breadcrumb {
    margin-bottom: 2rem;
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

.hero-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.hero-icon {
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    backdrop-filter: blur(10px);
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.hero-internship {
    background: rgba(255,255,255,0.1);
    padding: 1.5rem;
    border-radius: 16px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
}

.internship-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: white;
}

.internship-meta {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    opacity: 0.9;
}

/* Content Layout */
.apply-content {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 3rem;
    padding: 0 2rem;
}

.form-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid #f0f0f0;
}

/* Error Alert */
.alert-error {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
    padding: 1.5rem;
    border: 1px solid #f5c6cb;
}

.alert-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.error-list {
    margin: 0;
    padding-left: 1.5rem;
    line-height: 1.6;
}

/* Form Sections */
.apply-form {
    display: flex;
    flex-direction: column;
}

.form-section {
    padding: 2.5rem;
    border-bottom: 1px solid #f0f0f0;
}

.form-section:last-child {
    border-bottom: none;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
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
    flex-shrink: 0;
}

.section-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0 0 0.25rem 0;
}

.section-subtitle {
    color: #6c757d;
    font-size: 0.9rem;
    margin: 0;
}

/* Form Grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.documents-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

/* Form Elements */
.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
}

.form-input,
.form-textarea {
    padding: 1rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    font-family: inherit;
    background: white;
}

.form-input:focus,
.form-textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-input.error,
.form-textarea.error {
    border-color: #dc3545;
}

.form-textarea {
    resize: vertical;
    line-height: 1.6;
}

.error-message {
    color: #dc3545;
    font-size: 0.85rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

/* File Upload */
.file-upload-container {
    position: relative;
}

.file-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    padding: 2rem;
    border: 2px dashed #dee2e6;
    border-radius: 12px;
    background: #f8f9fa;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.file-upload-label:hover {
    border-color: #667eea;
    background: #f0f8ff;
}

.upload-text {
    font-weight: 500;
    color: #495057;
}

.upload-subtext {
    font-size: 0.85rem;
    color: #6c757d;
}

/* Character Counter */
.character-counter {
    text-align: right;
    font-size: 0.8rem;
    color: #6c757d;
    margin-top: 0.5rem;
}

/* Terms */
.terms-container {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.checkbox-container {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.checkbox-input {
    display: none;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    cursor: pointer;
    line-height: 1.6;
}

.checkbox-custom {
    width: 20px;
    height: 20px;
    border: 2px solid #dee2e6;
    border-radius: 4px;
    background: white;
    position: relative;
    flex-shrink: 0;
    margin-top: 2px;
    transition: all 0.3s ease;
}

.checkbox-input:checked + .checkbox-label .checkbox-custom {
    background: #667eea;
    border-color: #667eea;
}

.checkbox-input:checked + .checkbox-label .checkbox-custom::after {
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

/* Submit Actions */
.form-actions {
    text-align: center;
    padding: 2.5rem;
    background: #f8f9fa;
}

.submit-button {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border: none;
    padding: 1.25rem 3rem;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: inherit;
    margin-bottom: 1rem;
}

.submit-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
}

.submit-note {
    color: #6c757d;
    font-size: 0.9rem;
    margin: 0;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.5;
}

/* Sidebar */
.tips-sidebar {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.tips-card,
.support-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

.tips-header,
.support-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 1.5rem;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.tips-header h3,
.support-header h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
}

.tips-header svg,
.support-header svg {
    color: #667eea;
    flex-shrink: 0;
}

.tips-content,
.support-content {
    padding: 1.5rem;
}

.tip-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    line-height: 1.5;
}

.tip-item:last-child {
    margin-bottom: 0;
}

.tip-item svg {
    color: #28a745;
    flex-shrink: 0;
    margin-top: 2px;
}

.support-content p {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}

.support-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.support-link:hover {
    gap: 0.75rem;
}

/* Responsive */
@media (max-width: 1024px) {
    .apply-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .tips-sidebar {
        order: -1;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .apply-container {
        padding: 0;
    }
    
    .apply-hero {
        padding: 2rem 1rem;
        border-radius: 0 0 24px 24px;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .internship-meta {
        flex-direction: column;
        gap: 1rem;
    }
    
    .apply-content {
        padding: 0 1rem;
        gap: 1.5rem;
    }
    
    .form-section {
        padding: 2rem 1.5rem;
    }
    
    .section-header {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .tips-sidebar {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 1.5rem;
    }
    
    .form-section {
        padding: 1.5rem 1rem;
    }
    
    .submit-button {
        width: 100%;
        justify-content: center;
    }
    
    .file-upload-label {
        padding: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for cover letter
    const coverLetterTextarea = document.getElementById('cover_letter');
    const charCountSpan = document.getElementById('charCount');
    
    if (coverLetterTextarea && charCountSpan) {
        function updateCharCount() {
            const currentLength = coverLetterTextarea.value.length;
            charCountSpan.textContent = currentLength;
            
            if (currentLength > 1800) {
                charCountSpan.style.color = '#dc3545';
            } else if (currentLength > 1500) {
                charCountSpan.style.color = '#ffc107';
            } else {
                charCountSpan.style.color = '#6c757d';
            }
        }
        
        coverLetterTextarea.addEventListener('input', updateCharCount);
        updateCharCount(); // Initial count
    }
    
    // File upload handling
    const fileInput = document.getElementById('cv');
    const fileLabel = document.querySelector('.file-upload-label');
    
    if (fileInput && fileLabel) {
        fileInput.addEventListener('change', function() {
            const fileName = this.files[0]?.name;
            const uploadText = fileLabel.querySelector('.upload-text');
            
            if (fileName) {
                uploadText.textContent = fileName;
                fileLabel.style.borderColor = '#28a745';
                fileLabel.style.backgroundColor = '#f8fff9';
            } else {
                uploadText.textContent = @if(app()->getLocale() == 'fr')'Choisir un fichier ou glisser-déposer'@else'Choose file or drag and drop'@endif;
                fileLabel.style.borderColor = '#dee2e6';
                fileLabel.style.backgroundColor = '#f8f9fa';
            }
        });
        
        // Drag and drop functionality
        fileLabel.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#667eea';
            this.style.backgroundColor = '#f0f8ff';
        });
        
        fileLabel.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#dee2e6';
            this.style.backgroundColor = '#f8f9fa';
        });
        
        fileLabel.addEventListener('drop', function(e) {
            e.preventDefault();
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
    }
    
    // Form validation enhancement
    const form = document.querySelector('.apply-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('error');
                    isValid = false;
                } else {
                    field.classList.remove('error');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                const firstError = form.querySelector('.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    }
});
</script>
@endsection