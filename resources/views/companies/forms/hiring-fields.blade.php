{{-- resources/views/companies/forms/hiring-fields.blade.php --}}
<div class="form-section">
    <h4 class="section-title">
        <i class="fas fa-users me-2"></i>
        @if(app()->getLocale() == 'fr')
            Préférences de recrutement
        @else
            Recruitment Preferences
        @endif
    </h4>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-industry me-1"></i>
                    @if(app()->getLocale() == 'fr')
                        Secteurs d'intérêt
                    @else
                        Sectors of Interest
                    @endif
                </label>
                <textarea class="form-control" name="sectors_interested" rows="3" 
                          placeholder="@if(app()->getLocale() == 'fr')Ex: Technologie, Marketing, Finance, Design...@elseEx: Technology, Marketing, Finance, Design...@endif">{{ old('sectors_interested') }}</textarea>
                <small class="form-text text-muted">
                    @if(app()->getLocale() == 'fr')
                        Séparez les secteurs par des virgules
                    @else
                        Separate sectors with commas
                    @endif
                </small>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-language me-1"></i>
                    @if(app()->getLocale() == 'fr')
                        Langues requises
                    @else
                        Required Languages
                    @endif
                </label>
                <textarea class="form-control" name="languages_needed" rows="3" 
                          placeholder="@if(app()->getLocale() == 'fr')Ex: Français, Anglais, Espagnol...@elseEx: French, English, Spanish...@endif">{{ old('languages_needed') }}</textarea>
                <small class="form-text text-muted">
                    @if(app()->getLocale() == 'fr')
                        Listez les langues importantes pour le poste
                    @else
                        List important languages for the position
                    @endif
                </small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="intern_duration_preference" class="form-label fw-bold">
                    <i class="fas fa-clock me-1"></i>
                    @if(app()->getLocale() == 'fr')
                        Durée préférée des stages
                    @else
                        Preferred Internship Duration
                    @endif
                </label>
                <select class="form-select" id="intern_duration_preference" name="intern_duration_preference">
                    <option value="">
                        @if(app()->getLocale() == 'fr')
                            Sélectionnez une durée
                        @else
                            Select duration
                        @endif
                    </option>
                    <option value="1-3_months" {{ old('intern_duration_preference') == '1-3_months' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            1-3 mois
                        @else
                            1-3 months
                        @endif
                    </option>
                    <option value="3-6_months" {{ old('intern_duration_preference') == '3-6_months' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            3-6 mois
                        @else
                            3-6 months
                        @endif
                    </option>
                    <option value="6-12_months" {{ old('intern_duration_preference') == '6-12_months' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            6-12 mois
                        @else
                            6-12 months
                        @endif
                    </option>
                    <option value="flexible" {{ old('intern_duration_preference') == 'flexible' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            Flexible
                        @else
                            Flexible
                        @endif
                    </option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="team_size" class="form-label fw-bold">
                    <i class="fas fa-user-friends me-1"></i>
                    @if(app()->getLocale() == 'fr')
                        Taille de l'équipe
                    @else
                        Team Size
                    @endif
                </label>
                <input type="number" class="form-control" id="team_size" name="team_size" 
                       value="{{ old('team_size') }}" min="1" placeholder="@if(app()->getLocale() == 'fr')Ex: 10@elseEx: 10@endif">
                <small class="form-text text-muted">
                    @if(app()->getLocale() == 'fr')
                        Nombre approximatif de personnes dans l'équipe
                    @else
                        Approximate number of people in the team
                    @endif
                </small>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="card border-info">
            <div class="card-body">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="has_international_projects" 
                           name="has_international_projects" value="1" 
                           {{ old('has_international_projects') ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="has_international_projects">
                        <i class="fas fa-globe me-1 text-info"></i>
                        @if(app()->getLocale() == 'fr')
                            Nous avons des projets internationaux
                        @else
                            We have international projects
                        @endif
                    </label>
                </div>
                <small class="form-text text-muted ms-4">
                    @if(app()->getLocale() == 'fr')
                        Cochez si votre entreprise travaille sur des projets à l'international
                    @else
                        Check if your company works on international projects
                    @endif
                </small>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="cultural_diversity_goals" class="form-label fw-bold">
            <i class="fas fa-handshake me-1"></i>
            @if(app()->getLocale() == 'fr')
                Objectifs de diversité culturelle
            @else
                Cultural Diversity Goals
            @endif
        </label>
        <textarea class="form-control" id="cultural_diversity_goals" name="cultural_diversity_goals" 
                  rows="4" 
                  placeholder="@if(app()->getLocale() == 'fr')Décrivez vos objectifs concernant la diversité culturelle dans votre équipe...@elseDescribe your goals regarding cultural diversity in your team...@endif">{{ old('cultural_diversity_goals') }}</textarea>
        <small class="form-text text-muted">
            @if(app()->getLocale() == 'fr')
                Expliquez comment la diversité culturelle peut enrichir votre entreprise
            @else
                Explain how cultural diversity can enrich your company
            @endif
        </small>
    </div>
</div>

<style>
.form-section {
    margin-bottom: 2rem;
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    border-left: 5px solid #007bff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.section-title {
    margin-bottom: 1.5rem;
    color: #495057;
    border-bottom: 3px solid #007bff;
    padding-bottom: 0.5rem;
    font-weight: 600;
}

.form-label.fw-bold {
    color: #495057;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    transform: translateY(-1px);
}

.card.border-info {
    background: rgba(23, 162, 184, 0.05);
    border-radius: 10px !important;
}

.form-check-input:checked {
    background-color: #17a2b8;
    border-color: #17a2b8;
}

.form-text.text-muted {
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.fas {
    color: #007bff;
}

.text-info .fas {
    color: #17a2b8 !important;
}
</style>