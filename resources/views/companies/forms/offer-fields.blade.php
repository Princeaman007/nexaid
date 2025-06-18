<div class="form-section">
    <h4>
        @if(app()->getLocale() == 'fr')
            Détails de l'offre de stage
        @else
            Internship Offer Details
        @endif
    </h4>

    <div class="form-group mb-3">
        <label for="offer_title" class="form-label">
            @if(app()->getLocale() == 'fr')
                Titre de l'offre *
            @else
                Offer Title *
            @endif
        </label>
        <input type="text" class="form-control @error('offer_title') is-invalid @enderror" 
               id="offer_title" name="offer_title" value="{{ old('offer_title') }}" required>
        @error('offer_title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="offer_description" class="form-label">
            @if(app()->getLocale() == 'fr')
                Description de l'offre *
            @else
                Offer Description *
            @endif
        </label>
        <textarea class="form-control @error('offer_description') is-invalid @enderror" 
                  id="offer_description" name="offer_description" rows="4" required>{{ old('offer_description') }}</textarea>
        @error('offer_description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label class="form-label">
            @if(app()->getLocale() == 'fr')
                Compétences requises
            @else
                Required Skills
            @endif
        </label>
        <div class="tags-input">
            <input type="text" placeholder="Tapez et appuyez sur Entrée...">
            <input type="hidden" name="required_skills" value="{{ old('required_skills', '[]') }}">
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-3">
                <label for="offer_location" class="form-label">
                    @if(app()->getLocale() == 'fr')
                        Lieu de l'offre
                    @else
                        Offer Location
                    @endif
                </label>
                <input type="text" class="form-control" id="offer_location" name="offer_location" 
                       value="{{ old('offer_location') }}">
            </div>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <div class="form-group mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remote_possible" 
                           name="remote_possible" value="1" 
                           {{ old('remote_possible') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remote_possible">
                        @if(app()->getLocale() == 'fr')
                            Télétravail possible
                        @else
                            Remote work possible
                        @endif
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="offer_start_date" class="form-label">
                    @if(app()->getLocale() == 'fr')
                        Date de début
                    @else
                        Start Date
                    @endif
                </label>
                <input type="date" class="form-control" id="offer_start_date" name="offer_start_date" 
                       value="{{ old('offer_start_date') }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="offer_end_date" class="form-label">
                    @if(app()->getLocale() == 'fr')
                        Date de fin
                    @else
                        End Date
                    @endif
                </label>
                <input type="date" class="form-control" id="offer_end_date" name="offer_end_date" 
                       value="{{ old('offer_end_date') }}">
            </div>
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="salary_amount" class="form-label">
            @if(app()->getLocale() == 'fr')
                Salaire/Indemnité (€)
            @else
                Salary/Allowance (€)
            @endif
        </label>
        <input type="number" class="form-control" id="salary_amount" name="salary_amount" 
               value="{{ old('salary_amount') }}" min="0" step="0.01">
    </div>
</div>