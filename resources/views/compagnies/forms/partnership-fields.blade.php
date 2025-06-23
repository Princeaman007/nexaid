<div class="form-section">
    <h4>
        @if(app()->getLocale() == 'fr')
            Détails du partenariat
        @else
            Partnership Details
        @endif
    </h4>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="partnership_type" class="form-label">
                    @if(app()->getLocale() == 'fr')
                        Type de partenariat
                    @else
                        Partnership Type
                    @endif
                </label>
                <select class="form-select" id="partnership_type" name="partnership_type">
                    <option value="">
                        @if(app()->getLocale() == 'fr')
                            Sélectionnez un type
                        @else
                            Select type
                        @endif
                    </option>
                    <option value="strategic" {{ old('partnership_type') == 'strategic' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            Stratégique
                        @else
                            Strategic
                        @endif
                    </option>
                    <option value="commercial" {{ old('partnership_type') == 'commercial' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            Commercial
                        @else
                            Commercial
                        @endif
                    </option>
                    <option value="technological" {{ old('partnership_type') == 'technological' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            Technologique
                        @else
                            Technological
                        @endif
                    </option>
                </select>
                @error('partnership_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="partnership_duration" class="form-label">
                    @if(app()->getLocale() == 'fr')
                        Durée du partenariat
                    @else
                        Partnership Duration
                    @endif
                </label>
                <select class="form-select" id="partnership_duration" name="partnership_duration">
                    <option value="">
                        @if(app()->getLocale() == 'fr')
                            Sélectionnez une durée
                        @else
                            Select duration
                        @endif
                    </option>
                    <option value="short_term" {{ old('partnership_duration') == 'short_term' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            Court terme (< 1 an)
                        @else
                            Short term (< 1 year)
                        @endif
                    </option>
                    <option value="medium_term" {{ old('partnership_duration') == 'medium_term' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            Moyen terme (1-3 ans)
                        @else
                            Medium term (1-3 years)
                        @endif
                    </option>
                    <option value="long_term" {{ old('partnership_duration') == 'long_term' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            Long terme (3+ ans)
                        @else
                            Long term (3+ years)
                        @endif
                    </option>
                </select>
                @error('partnership_duration')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="collaboration_expectations" class="form-label">
            @if(app()->getLocale() == 'fr')
                Attentes de collaboration
            @else
                Collaboration Expectations
            @endif
        </label>
        <textarea class="form-control" id="collaboration_expectations" name="collaboration_expectations" 
                  rows="4" placeholder="@if(app()->getLocale() == 'fr')Décrivez vos attentes et objectifs pour cette collaboration...@elseDescribe your expectations and objectives for this collaboration...@endif">{{ old('collaboration_expectations') }}</textarea>
        @error('collaboration_expectations')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label class="form-label">
            @if(app()->getLocale() == 'fr')
                Services recherchés
            @else
                Required Services
            @endif
        </label>
        <div class="row">
            <div class="col-md-6">
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" id="service_recruitment_consulting" 
                           name="services_needed[]" value="recruitment_consulting"
                           {{ in_array('recruitment_consulting', old('services_needed', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="service_recruitment_consulting">
                        @if(app()->getLocale() == 'fr')
                            Conseil en recrutement
                        @else
                            Recruitment Consulting
                        @endif
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" id="service_intercultural_training" 
                           name="services_needed[]" value="intercultural_training"
                           {{ in_array('intercultural_training', old('services_needed', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="service_intercultural_training">
                        @if(app()->getLocale() == 'fr')
                            Formation interculturelle
                        @else
                            Intercultural Training
                        @endif
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" id="service_tech_tools" 
                           name="services_needed[]" value="tech_tools"
                           {{ in_array('tech_tools', old('services_needed', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="service_tech_tools">
                        @if(app()->getLocale() == 'fr')
                            Outils technologiques
                        @else
                            Tech Tools
                        @endif
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" id="service_marketing_support" 
                           name="services_needed[]" value="marketing_support"
                           {{ in_array('marketing_support', old('services_needed', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="service_marketing_support">
                        @if(app()->getLocale() == 'fr')
                            Support marketing
                        @else
                            Marketing Support
                        @endif
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" id="service_strategic_guidance" 
                           name="services_needed[]" value="strategic_guidance"
                           {{ in_array('strategic_guidance', old('services_needed', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="service_strategic_guidance">
                        @if(app()->getLocale() == 'fr')
                            Accompagnement stratégique
                        @else
                            Strategic Guidance
                        @endif
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" id="service_other" 
                           name="services_needed[]" value="other"
                           {{ in_array('other', old('services_needed', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="service_other">
                        @if(app()->getLocale() == 'fr')
                            Autre
                        @else
                            Other
                        @endif
                    </label>
                </div>
            </div>
        </div>
        @error('services_needed')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-3">
                <label for="budget_range" class="form-label">
                    @if(app()->getLocale() == 'fr')
                        Budget approximatif (€)
                    @else
                        Approximate Budget (€)
                    @endif
                </label>
                <input type="number" class="form-control" id="budget_range" name="budget_range" 
                       value="{{ old('budget_range') }}" min="0" step="0.01" 
                       placeholder="@if(app()->getLocale() == 'fr')Ex: 25000@elseEx: 25000@endif">
                @error('budget_range')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <div class="form-group mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="long_term_partnership" 
                           name="long_term_partnership" value="1" 
                           {{ old('long_term_partnership') ? 'checked' : '' }}>
                    <label class="form-check-label" for="long_term_partnership">
                        @if(app()->getLocale() == 'fr')
                            Intéressé par un partenariat à long terme
                        @else
                            Interested in long-term partnership
                        @endif
                    </label>
                </div>
                @error('long_term_partnership')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>