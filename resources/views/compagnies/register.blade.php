@extends('layouts.app')

@section('title', 'Inscription Entreprise')

@section('content')
<div class="company-container">
    <div class="registration-wrapper">
        <!-- Header Section -->
        <div class="registration-header">
            <h1 class="registration-title">
                @switch($type)
                    @case('hiring')
                        Inscription - Recrutement de stagiaire
                        @break
                    @case('partnership')
                        Inscription - Demande de partenariat
                        @break
                    @case('offer_sender')
                        Inscription - Publication d'offre
                        @break
                    @default
                        Inscription Entreprise
                @endswitch
            </h1>
            <p class="registration-subtitle">
                @switch($type)
                    @case('hiring')
                        Rejoignez notre réseau d'entreprises recruteuses et accédez aux meilleurs talents internationaux
                        @break
                    @case('partnership')
                        Développons ensemble un partenariat stratégique pour transformer votre approche RH
                        @break
                    @case('offer_sender')
                        Publiez votre offre sur notre plateforme et recevez des candidatures qualifiées
                        @break
                    @default
                        Complétez votre inscription pour accéder à nos services
                @endswitch
            </p>
        </div>

        <!-- Form Section -->
        <div class="registration-form-container">
            <form method="POST" action="{{ route('company.register') }}" class="registration-form">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">

                <!-- Informations de base -->
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

                <!-- Champs spécifiques selon le type -->
                @if($type === 'hiring')
                    <div class="form-section">
                        <div class="section-header">
                            <h2 class="section-title">Besoins de recrutement</h2>
                            <p class="section-description">Aidez-nous à comprendre vos attentes pour un matching optimal</p>
                        </div>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="team_size" class="form-label">
                                    Taille de l'équipe
                                </label>
                                <input type="number" id="team_size" name="team_size" min="1"
                                       class="form-input"
                                       value="{{ old('team_size') }}"
                                       placeholder="Ex: 25">
                            </div>

                            <div class="form-group">
                                <label for="intern_duration_preference" class="form-label">
                                    Durée de stage préférée
                                </label>
                                <select id="intern_duration_preference" name="intern_duration_preference" class="form-select">
                                    <option value="">Sélectionner une durée...</option>
                                    <option value="1-3 mois" {{ old('intern_duration_preference') === '1-3 mois' ? 'selected' : '' }}>1-3 mois</option>
                                    <option value="3-6 mois" {{ old('intern_duration_preference') === '3-6 mois' ? 'selected' : '' }}>3-6 mois</option>
                                    <option value="6+ mois" {{ old('intern_duration_preference') === '6+ mois' ? 'selected' : '' }}>6+ mois</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group-full">
                            <label class="form-label">
                                Secteurs d'intérêt
                            </label>
                            <div class="checkbox-grid">
                                @if(!empty($formData['sectors']))
                                    @foreach($formData['sectors'] as $sector)
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="sectors_interested[]" value="{{ $sector }}"
                                                   class="checkbox-input" {{ in_array($sector, old('sectors_interested', [])) ? 'checked' : '' }}>
                                            <span class="checkbox-label">{{ $sector }}</span>
                                        </label>
                                    @endforeach
                                @else
                                    @foreach(['Informatique', 'Marketing', 'Finance', 'Design', 'Ingénierie', 'Juridique', 'Commerce', 'Communication'] as $sector)
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="sectors_interested[]" value="{{ $sector }}"
                                                   class="checkbox-input" {{ in_array($sector, old('sectors_interested', [])) ? 'checked' : '' }}>
                                            <span class="checkbox-label">{{ $sector }}</span>
                                        </label>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        @if(!empty($formData['languages']))
                            <div class="form-group-full">
                                <label class="form-label">
                                    Langues requises
                                </label>
                                <div class="checkbox-grid">
                                    @foreach($formData['languages'] as $language)
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="languages_needed[]" value="{{ $language }}"
                                                   class="checkbox-input" {{ in_array($language, old('languages_needed', [])) ? 'checked' : '' }}>
                                            <span class="checkbox-label">{{ $language }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="form-group-full">
                            <label class="checkbox-item">
                                <input type="checkbox" name="has_international_projects" value="1"
                                       class="checkbox-input" {{ old('has_international_projects') ? 'checked' : '' }}>
                                <span class="checkbox-label">Notre entreprise développe des projets à dimension internationale</span>
                            </label>
                        </div>

                        <div class="form-group-full">
                            <label for="cultural_diversity_goals" class="form-label">
                                Objectifs de diversité culturelle
                            </label>
                            <textarea id="cultural_diversity_goals" name="cultural_diversity_goals" rows="3"
                                      class="form-textarea"
                                      placeholder="Décrivez vos objectifs en matière de diversité et d'inclusion...">{{ old('cultural_diversity_goals') }}</textarea>
                        </div>
                    </div>

                @elseif($type === 'partnership')
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
                                @if(!empty($formData['services']))
                                    @foreach($formData['services'] as $service)
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="services_needed[]" value="{{ $service }}"
                                                   class="checkbox-input" {{ in_array($service, old('services_needed', [])) ? 'checked' : '' }}>
                                            <span class="checkbox-label">{{ $service }}</span>
                                        </label>
                                    @endforeach
                                @else
                                    @foreach(['Conseil en recrutement', 'Formation interculturelle', 'Outils technologiques', 'Support marketing', 'Accompagnement stratégique', 'Autre'] as $service)
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="services_needed[]" value="{{ $service }}"
                                                   class="checkbox-input" {{ in_array($service, old('services_needed', [])) ? 'checked' : '' }}>
                                            <span class="checkbox-label">{{ $service }}</span>
                                        </label>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="partnership_type" class="form-label">
                                    Type de partenariat
                                </label>
                                <select id="partnership_type" name="partnership_type" class="form-select">
                                    <option value="">Sélectionner un type...</option>
                                    @if(!empty($formData['partnership_types']))
                                        @foreach($formData['partnership_types'] as $partnershipType)
                                            <option value="{{ $partnershipType }}" {{ old('partnership_type') === $partnershipType ? 'selected' : '' }}>
                                                {{ $partnershipType }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="Stratégique" {{ old('partnership_type') === 'Stratégique' ? 'selected' : '' }}>Stratégique</option>
                                        <option value="Commercial" {{ old('partnership_type') === 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                        <option value="Technologique" {{ old('partnership_type') === 'Technologique' ? 'selected' : '' }}>Technologique</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="partnership_duration" class="form-label">
                                    Durée souhaitée
                                </label>
                                <select id="partnership_duration" name="partnership_duration" class="form-select">
                                    <option value="">Sélectionner une durée...</option>
                                    <option value="Court terme" {{ old('partnership_duration') === 'Court terme' ? 'selected' : '' }}>Court terme (< 1 an)</option>
                                    <option value="Moyen terme" {{ old('partnership_duration') === 'Moyen terme' ? 'selected' : '' }}>Moyen terme (1-3 ans)</option>
                                    <option value="Long terme" {{ old('partnership_duration') === 'Long terme' ? 'selected' : '' }}>Long terme (3+ ans)</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="budget_range" class="form-label">
                                    Budget approximatif (€)
                                </label>
                                <input type="number" id="budget_range" name="budget_range" min="0"
                                       class="form-input"
                                       value="{{ old('budget_range') }}"
                                       placeholder="Ex: 25000">
                            </div>
                        </div>

                        <div class="form-group-full">
                            <label class="checkbox-item">
                                <input type="checkbox" name="long_term_partnership" value="1"
                                       class="checkbox-input" {{ old('long_term_partnership') ? 'checked' : '' }}>
                                <span class="checkbox-label">Je suis intéressé par un partenariat à long terme</span>
                            </label>
                        </div>

                        <div class="form-group-full">
                            <label for="collaboration_expectations" class="form-label">
                                Attentes de collaboration
                            </label>
                            <textarea id="collaboration_expectations" name="collaboration_expectations" rows="3"
                                      class="form-textarea"
                                      placeholder="Décrivez vos attentes et objectifs pour cette collaboration...">{{ old('collaboration_expectations') }}</textarea>
                        </div>
                    </div>

                @elseif($type === 'offer_sender')
                    <div class="form-section">
                        <div class="section-header">
                            <h2 class="section-title">Détails de l'offre de stage</h2>
                            <p class="section-description">Créez une offre attractive pour attirer les meilleurs candidats</p>
                        </div>
                        
                        <div class="form-group-full">
                            <label for="offer_title" class="form-label required">
                                Titre de l'offre
                            </label>
                            <input type="text" id="offer_title" name="offer_title" required
                                   class="form-input"
                                   value="{{ old('offer_title') }}"
                                   placeholder="Ex: Stage Développeur Frontend - React.js">
                            @error('offer_title')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="offer_location" class="form-label">
                                    Lieu du stage
                                </label>
                                <input type="text" id="offer_location" name="offer_location"
                                       class="form-input"
                                       value="{{ old('offer_location') }}"
                                       placeholder="Ex: Paris, Lyon, Remote">
                            </div>

                            <div class="form-group">
                                <label for="salary_amount" class="form-label">
                                    Rémunération (€/mois)
                                </label>
                                <input type="number" id="salary_amount" name="salary_amount" min="0"
                                       class="form-input"
                                       value="{{ old('salary_amount') }}"
                                       placeholder="Ex: 800">
                            </div>

                            <div class="form-group">
                                <label for="offer_start_date" class="form-label">
                                    Date de début
                                </label>
                                <input type="date" id="offer_start_date" name="offer_start_date"
                                       class="form-input"
                                       value="{{ old('offer_start_date') }}">
                            </div>

                            <div class="form-group">
                                <label for="offer_end_date" class="form-label">
                                    Date de fin
                                </label>
                                <input type="date" id="offer_end_date" name="offer_end_date"
                                       class="form-input"
                                       value="{{ old('offer_end_date') }}">
                            </div>
                        </div>

                        <div class="form-group-full">
                            <label class="checkbox-item">
                                <input type="checkbox" name="remote_possible" value="1"
                                       class="checkbox-input" {{ old('remote_possible') ? 'checked' : '' }}>
                                <span class="checkbox-label">Télétravail possible</span>
                            </label>
                        </div>

                        <div class="form-group-full">
                            <label for="offer_description" class="form-label required">
                                Description du stage
                            </label>
                            <textarea id="offer_description" name="offer_description" rows="4" required
                                      class="form-textarea"
                                      placeholder="Décrivez les missions, responsabilités, objectifs du stage et ce que le stagiaire va apprendre...">{{ old('offer_description') }}</textarea>
                            @error('offer_description')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group-full">
                            <label class="form-label">
                                Compétences requises
                            </label>
                            <div class="checkbox-grid">
                                @if(!empty($formData['skills']))
                                    @foreach($formData['skills'] as $skill)
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="required_skills[]" value="{{ $skill }}"
                                                   class="checkbox-input" {{ in_array($skill, old('required_skills', [])) ? 'checked' : '' }}>
                                            <span class="checkbox-label">{{ $skill }}</span>
                                        </label>
                                    @endforeach
                                @else
                                    @foreach(['JavaScript', 'Python', 'Java', 'React', 'Node.js', 'SQL', 'Git', 'Agile', 'Communication', 'Anglais', 'Figma', 'Photoshop'] as $skill)
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="required_skills[]" value="{{ $skill }}"
                                                   class="checkbox-input" {{ in_array($skill, old('required_skills', [])) ? 'checked' : '' }}>
                                            <span class="checkbox-label">{{ $skill }}</span>
                                        </label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Submit Button -->
                <div class="form-submit">
                    <button type="submit" class="submit-button">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m9 18 6-6-6-6"/>
                        </svg>
                        @switch($type)
                            @case('hiring')
                                Envoyer ma demande de recrutement
                                @break
                            @case('partnership')
                                Envoyer ma demande de partenariat
                                @break
                            @case('offer_sender')
                                Publier mon offre de stage
                                @break
                            @default
                                Envoyer
                        @endswitch
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
    // Validation des dates pour l'offre de stage
    const startDate = document.getElementById('offer_start_date');
    const endDate = document.getElementById('offer_end_date');
    
    if (startDate && endDate) {
        startDate.addEventListener('change', function() {
            endDate.min = this.value;
        });
    }
    
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
});
</script>
@endsection