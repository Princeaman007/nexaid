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
                    <option value="recruitment" {{ old('partnership_type') == 'recruitment' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            Recrutement
                        @else
                            Recruitment
                        @endif
                    </option>
                    <option value="training" {{ old('partnership_type') == 'training' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            Formation
                        @else
                            Training
                        @endif
                    </option>
                    <option value="consulting" {{ old('partnership_type') == 'consulting' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            Conseil
                        @else
                            Consulting
                        @endif
                    </option>
                    <option value="other" {{ old('partnership_type') == 'other' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            Autre
                        @else
                            Other
                        @endif
                    </option>
                </select>
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
                    <option value="3_months" {{ old('partnership_duration') == '3_months' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            3 mois
                        @else
                            3 months
                        @endif
                    </option>
                    <option value="6_months" {{ old('partnership_duration') == '6_months' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            6 mois
                        @else
                            6 months
                        @endif
                    </option>
                    <option value="1_year" {{ old('partnership_duration') == '1_year' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            1 an
                        @else
                            1 year
                        @endif
                    </option>
                    <option value="2_years" {{ old('partnership_duration') == '2_years' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            2 ans
                        @else
                            2 years
                        @endif
                    </option>
                    <option value="long_term" {{ old('partnership_duration') == 'long_term' ? 'selected' : '' }}>
                        @if(app()->getLocale() == 'fr')
                            Long terme
                        @else
                            Long term
                        @endif
                    </option>
                </select>
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
                  rows="3">{{ old('collaboration_expectations') }}</textarea>
    </div>

    <div class="form-group mb-3">
        <label class="form-label">
            @if(app()->getLocale() == 'fr')
                Services requis
            @else
                Required Services
            @endif
        </label>
        <div class="tags-input">
            <input type="text" placeholder="Tapez et appuyez sur Entrée...">
            <input type="hidden" name="services_needed" value="{{ old('services_needed', '[]') }}">
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-3">
                <label for="budget_range" class="form-label">
                    @if(app()->getLocale() == 'fr')
                        Budget alloué (€)
                    @else
                        Allocated Budget (€)
                    @endif
                </label>
                <input type="number" class="form-control" id="budget_range" name="budget_range" 
                       value="{{ old('budget_range') }}" min="0" step="0.01">
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
                            Partenariat long terme
                        @else
                            Long-term partnership
                        @endif
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
