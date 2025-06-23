@extends('layouts.app')

@section('title', 'Demande de Partenariat')

@section('content')
<div class="company-container">
    <div class="registration-wrapper">
        <!-- Header Section -->
        <div class="registration-header">
            <h1 class="registration-title">
                Demande de Partenariat
            </h1>
            <p class="registration-subtitle">
                Développons ensemble un partenariat stratégique pour transformer votre approche RH
            </p>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Section -->
        <div class="registration-form-container">
            <form method="POST" action="{{ route('compagnies.register.submit') }}" class="registration-form">
                @csrf

                <!-- Company Information -->
                <div class="form-section">
                    <div class="section-header">
                        <h2 class="section-title">Informations générales</h2>
                        <p class="section-description">Renseignez les informations de base de votre entreprise</p>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name" class="form-label required">
                                Nom de l'entreprise
                            </label>
                            <input type="text" id="name" name="name" required
                                   class="form-input"
                                   value="{{ old('name') }}"
                                   placeholder="Ex: TechCorp International">
                            @error('name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label required">
                                Email de contact
                            </label>
                            <input type="email" id="email" name="email" required
                                   class="form-input"
                                   value="{{ old('email') }}"
                                   placeholder="contact@entreprise.com">
                            @error('email')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">
                                Téléphone
                            </label>
                            <input type="tel" id="phone" name="phone"
                                   class="form-input"
                                   value="{{ old('phone') }}"
                                   placeholder="+33 1 23 45 67 89">
                            @error('phone')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="website" class="form-label">
                                Site web
                            </label>
                            <input type="url" id="website" name="website"
                                   class="form-input"
                                   value="{{ old('website') }}"
                                   placeholder="https://www.entreprise.com">
                            @error('website')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group-full">
                        <label for="address" class="form-label">
                            Adresse complète
                        </label>
                        <textarea id="address" name="address" rows="2"
                                  class="form-textarea"
                                  placeholder="Adresse, Code postal, Ville, Pays">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group-full">
                        <label for="description" class="form-label">
                            Description de l'entreprise
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  class="form-textarea"
                                  placeholder="Présentez votre entreprise, vos activités et votre culture...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Partnership Details -->
                <div class="form-section">
                    <div class="section-header">
                        <h2 class="section-title">Détails du partenariat</h2>
                        <p class="section-description">Précisez vos attentes pour développer un partenariat sur mesure</p>
                    </div>
                    
                    <div class="form-group-full">
                        <label class="form-label">
                            Services recherchés
                        </label>
                        <div class="checkbox-grid">
                            <label class="checkbox-item">
                                <input type="checkbox" name="services_needed[]" value="recruitment_consulting"
                                       class="checkbox-input" {{ in_array('recruitment_consulting', old('services_needed', [])) ? 'checked' : '' }}>
                                <span class="checkbox-label">Conseil en recrutement</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="services_needed[]" value="intercultural_training"
                                       class="checkbox-input" {{ in_array('intercultural_training', old('services_needed', [])) ? 'checked' : '' }}>
                                <span class="checkbox-label">Formation interculturelle</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="services_needed[]" value="tech_tools"
                                       class="checkbox-input" {{ in_array('tech_tools', old('services_needed', [])) ? 'checked' : '' }}>
                                <span class="checkbox-label">Outils technologiques</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="services_needed[]" value="marketing_support"
                                       class="checkbox-input" {{ in_array('marketing_support', old('services_needed', [])) ? 'checked' : '' }}>
                                <span class="checkbox-label">Support marketing</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="services_needed[]" value="strategic_guidance"
                                       class="checkbox-input" {{ in_array('strategic_guidance', old('services_needed', [])) ? 'checked' : '' }}>
                                <span class="checkbox-label">Accompagnement stratégique</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="services_needed[]" value="other"
                                       class="checkbox-input" {{ in_array('other', old('services_needed', [])) ? 'checked' : '' }}>
                                <span class="checkbox-label">Autre</span>
                            </label>
                        </div>
                        @error('services_needed')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="partnership_type" class="form-label">
                                Type de partenariat
                            </label>
                            <select id="partnership_type" name="partnership_type" class="form-select">
                                <option value="">Sélectionner un type...</option>
                                <option value="strategic" {{ old('partnership_type') === 'strategic' ? 'selected' : '' }}>Stratégique</option>
                                <option value="commercial" {{ old('partnership_type') === 'commercial' ? 'selected' : '' }}>Commercial</option>
                                <option value="technological" {{ old('partnership_type') === 'technological' ? 'selected' : '' }}>Technologique</option>
                            </select>
                            @error('partnership_type')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="partnership_duration" class="form-label">
                                Durée souhaitée
                            </label>
                            <select id="partnership_duration" name="partnership_duration" class="form-select">
                                <option value="">Sélectionner une durée...</option>
                                <option value="short_term" {{ old('partnership_duration') === 'short_term' ? 'selected' : '' }}>Court terme (< 1 an)</option>
                                <option value="medium_term" {{ old('partnership_duration') === 'medium_term' ? 'selected' : '' }}>Moyen terme (1-3 ans)</option>
                                <option value="long_term" {{ old('partnership_duration') === 'long_term' ? 'selected' : '' }}>Long terme (3+ ans)</option>
                            </select>
                            @error('partnership_duration')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="budget_range" class="form-label">
                                Budget approximatif (€)
                            </label>
                            <input type="number" id="budget_range" name="budget_range" min="0"
                                   class="form-input"
                                   value="{{ old('budget_range') }}"
                                   placeholder="Ex: 25000">
                            @error('budget_range')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group-full">
                        <label class="checkbox-item">
                            <input type="checkbox" name="long_term_partnership" value="1"
                                   class="checkbox-input" {{ old('long_term_partnership') ? 'checked' : '' }}>
                            <span class="checkbox-label">Je suis intéressé par un partenariat à long terme</span>
                        </label>
                        @error('long_term_partnership')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group-full">
                        <label for="collaboration_expectations" class="form-label">
                            Attentes de collaboration
                        </label>
                        <textarea id="collaboration_expectations" name="collaboration_expectations" rows="4"
                                  class="form-textarea"
                                  placeholder="Décrivez vos attentes et objectifs pour cette collaboration...">{{ old('collaboration_expectations') }}</textarea>
                        @error('collaboration_expectations')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-submit">
                    <button type="submit" class="submit-button">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m9 18 6-6-6-6"/>
                        </svg>
                        Envoyer ma demande de partenariat
                    </button>
                    <p class="submit-note">
                        En soumettant ce formulaire, vous acceptez nos conditions d'utilisation et notre politique de confidentialité.
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.company-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
    line-height: 1.6;
    color: #1a1a1a;
}

.registration-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

.registration-header {
    text-align: center;
    margin-bottom: 3rem;
}

.registration-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
}

.registration-subtitle {
    font-size: 1.2rem;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.5;
}

/* Alert Messages */
.alert {
    padding: 1rem 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    font-weight: 500;
}

.alert-success {
    background: #dcfce7;
    color: #15803d;
    border: 1px solid #bbf7d0;
}

.alert-error {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.registration-form-container {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.registration-form {
    padding: 0;
}

.form-section {
    padding: 3rem;
    border-bottom: 1px solid #f1f5f9;
}

.form-section:last-of-type {
    border-bottom: none;
}

.section-header {
    margin-bottom: 2.5rem;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.section-description {
    font-size: 1rem;
    color: #64748b;
    line-height: 1.5;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-group,
.form-group-full {
    display: flex;
    flex-direction: column;
}

.form-group-full {
    margin-bottom: 1.5rem;
}

.form-label {
    font-size: 0.9rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}

.form-label.required::after {
    content: '*';
    color: #ef4444;
    margin-left: 0.25rem;
}

.form-input,
.form-select,
.form-textarea {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.95rem;
    background: #ffffff;
    transition: all 0.2s ease;
    font-family: inherit;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-input::placeholder,
.form-textarea::placeholder {
    color: #9ca3af;
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

.form-error {
    font-size: 0.85rem;
    color: #ef4444;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
}

.form-error::before {
    content: '⚠';
    margin-right: 0.5rem;
}

.checkbox-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.75rem;
}

.checkbox-item {
    display: flex;
    align-items: center;
    cursor: pointer;
    padding: 0.75rem;
    border: 2px solid #f1f5f9;
    border-radius: 8px;
    transition: all 0.2s ease;
    background: #ffffff;
}

.checkbox-item:hover {
    border-color: #e2e8f0;
    background: #f8fafc;
}

.checkbox-item:has(.checkbox-input:checked) {
    border-color: #3b82f6;
    background: #eff6ff;
}

.checkbox-input {
    width: 16px;
    height: 16px;
    margin-right: 0.75rem;
    accent-color: #3b82f6;
    cursor: pointer;
}

.checkbox-label {
    font-size: 0.9rem;
    color: #374151;
    font-weight: 500;
    cursor: pointer;
    line-height: 1.4;
}

.form-submit {
    padding: 3rem;
    background: #f8fafc;
    text-align: center;
}

.submit-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #1e293b;
    color: white;
    padding: 1rem 2.5rem;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: inherit;
}

.submit-button:hover {
    background: #334155;
    transform: translateY(-1px);
    box-shadow: 0 4px 20px rgba(30, 41, 59, 0.2);
}

.submit-button svg {
    transition: transform 0.2s ease;
}

.submit-button:hover svg {
    transform: translateX(2px);
}

.submit-note {
    font-size: 0.85rem;
    color: #64748b;
    margin-top: 1rem;
    line-height: 1.4;
}

/* Responsive Design */
@media (max-width: 768px) {
    .company-container {
        padding: 1rem;
    }
    
    .registration-title {
        font-size: 2rem;
    }
    
    .registration-subtitle {
        font-size: 1.1rem;
    }
    
    .form-section {
        padding: 2rem;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .checkbox-grid {
        grid-template-columns: 1fr;
    }
    
    .form-submit {
        padding: 2rem;
    }
    
    .submit-button {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .registration-title {
        font-size: 1.8rem;
    }
    
    .form-section {
        padding: 1.5rem;
    }
    
    .checkbox-item {
        padding: 0.5rem;
    }
    
    .form-input,
    .form-select,
    .form-textarea {
        padding: 0.75rem;
    }
}

/* Animation pour les form groups */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-group,
.form-group-full {
    animation: fadeIn 0.3s ease-out;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'entrée pour les éléments
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observer les sections du formulaire
    document.querySelectorAll('.form-section').forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'all 0.6s ease';
        observer.observe(section);
    });

    // Validation du formulaire côté client
    const form = document.querySelector('.registration-form');
    
    form.addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        
        if (!name || !email) {
            e.preventDefault();
            alert('Veuillez remplir les champs obligatoires (nom et email).');
            return false;
        }
        
        // Validation email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            alert('Veuillez entrer une adresse email valide.');
            return false;
        }
    });
});
</script>
@endsection