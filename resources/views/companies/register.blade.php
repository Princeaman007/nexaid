@extends('layouts.app')

@section('content')
<div class="registration-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <!-- Header Section -->
                <div class="registration-header text-center mb-5">
                    <div class="icon-wrapper mb-3">
                        @if($type === 'hiring')
                            <i class="fas fa-users fa-3x text-primary"></i>
                        @elseif($type === 'partnership')
                            <i class="fas fa-handshake fa-3x text-success"></i>
                        @else
                            <i class="fas fa-briefcase fa-3x text-warning"></i>
                        @endif
                    </div>
                    <h1 class="registration-title">
                        @if($type === 'hiring')
                            @if(app()->getLocale() == 'fr')
                                Recrutement de Stagiaires
                            @else
                                Intern Recruitment
                            @endif
                        @elseif($type === 'partnership')
                            @if(app()->getLocale() == 'fr')
                                Partenariat Stratégique
                            @else
                                Strategic Partnership
                            @endif
                        @else
                            @if(app()->getLocale() == 'fr')
                                Publication d'Offre
                            @else
                                Offer Publication
                            @endif
                        @endif
                    </h1>
                </div>

                <!-- Form Card -->
                <div class="form-card">
                    <form method="POST" action="{{ route('company.register.store') }}">
                        @csrf
                        <input type="hidden" name="type" value="{{ $type }}">

                        <!-- Company Information -->
                        <div class="section-card mb-4">
                            <div class="section-header">
                                <h3 class="section-title">
                                    <i class="fas fa-building me-2"></i>
                                    @if(app()->getLocale() == 'fr')
                                        Informations de l'Entreprise
                                    @else
                                        Company Information
                                    @endif
                                </h3>
                            </div>

                            <div class="section-content">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name') }}" 
                                                   required>
                                            <label for="name">
                                                @if(app()->getLocale() == 'fr')
                                                    Nom de l'entreprise *
                                                @else
                                                    Company Name *
                                                @endif
                                            </label>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" 
                                                   name="email" 
                                                   value="{{ old('email') }}" 
                                                   required>
                                            <label for="email">Email *</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" 
                                                   class="form-control" 
                                                   id="phone" 
                                                   name="phone" 
                                                   value="{{ old('phone') }}">
                                            <label for="phone">
                                                @if(app()->getLocale() == 'fr')
                                                    Téléphone
                                                @else
                                                    Phone
                                                @endif
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="url" 
                                                   class="form-control" 
                                                   id="website" 
                                                   name="website" 
                                                   value="{{ old('website') }}">
                                            <label for="website">
                                                @if(app()->getLocale() == 'fr')
                                                    Site web
                                                @else
                                                    Website
                                                @endif
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" 
                                                      id="description" 
                                                      name="description" 
                                                      style="height: 100px">{{ old('description') }}</textarea>
                                            <label for="description">
                                                @if(app()->getLocale() == 'fr')
                                                    Description de l'entreprise
                                                @else
                                                    Company Description
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Specific Information -->
                        <div class="section-card mb-4">
                            <div class="section-header">
                                <h3 class="section-title">
                                    @if($type === 'hiring')
                                        <i class="fas fa-search me-2"></i>
                                        @if(app()->getLocale() == 'fr')
                                            Besoins de Recrutement
                                        @else
                                            Recruitment Needs
                                        @endif
                                    @elseif($type === 'partnership')
                                        <i class="fas fa-handshake me-2"></i>
                                        @if(app()->getLocale() == 'fr')
                                            Détails du Partenariat
                                        @else
                                            Partnership Details
                                        @endif
                                    @else
                                        <i class="fas fa-clipboard-list me-2"></i>
                                        @if(app()->getLocale() == 'fr')
                                            Détails de l'Offre
                                        @else
                                            Offer Details
                                        @endif
                                    @endif
                                </h3>
                            </div>

                            <div class="section-content">
                                @if($type === 'hiring')
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">
                                                @if(app()->getLocale() == 'fr')
                                                    Secteurs d'intérêt
                                                @else
                                                    Sectors of Interest
                                                @endif
                                            </label>
                                            <textarea class="form-control" 
                                                      name="sectors_interested" 
                                                      rows="2" 
                                                      placeholder="@if(app()->getLocale() == 'fr')Ex: IT, Marketing, Finance...@elseEx: IT, Marketing, Finance...@endif">{{ old('sectors_interested') }}</textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select" name="intern_duration_preference">
                                                    <option value="">Choisir...</option>
                                                    <option value="1-3_months">1-3 mois</option>
                                                    <option value="3-6_months">3-6 mois</option>
                                                    <option value="6-12_months">6-12 mois</option>
                                                    <option value="flexible">Flexible</option>
                                                </select>
                                                <label>
                                                    @if(app()->getLocale() == 'fr')
                                                        Durée préférée
                                                    @else
                                                        Preferred Duration
                                                    @endif
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" name="team_size" min="1">
                                                <label>
                                                    @if(app()->getLocale() == 'fr')
                                                        Taille d'équipe
                                                    @else
                                                        Team Size
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                @elseif($type === 'partnership')
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select" name="partnership_type">
                                                    <option value="">Sélectionner...</option>
                                                    <option value="recruitment">Recrutement</option>
                                                    <option value="training">Formation</option>
                                                    <option value="consulting">Conseil</option>
                                                </select>
                                                <label>
                                                    @if(app()->getLocale() == 'fr')
                                                        Type de partenariat
                                                    @else
                                                        Partnership Type
                                                    @endif
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" name="budget_range">
                                                <label>
                                                    @if(app()->getLocale() == 'fr')
                                                        Budget (€)
                                                    @else
                                                        Budget (€)
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                @else
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="offer_title" 
                                                       required>
                                                <label>
                                                    @if(app()->getLocale() == 'fr')
                                                        Titre de l'offre *
                                                    @else
                                                        Offer Title *
                                                    @endif
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="offer_location">
                                                <label>
                                                    @if(app()->getLocale() == 'fr')
                                                        Lieu
                                                    @else
                                                        Location
                                                    @endif
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" name="salary_amount">
                                                <label>
                                                    @if(app()->getLocale() == 'fr')
                                                        Rémunération (€)
                                                    @else
                                                        Salary (€)
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn-submit">
                                @if(app()->getLocale() == 'fr')
                                    @if($type === 'hiring')
                                        Démarrer le recrutement
                                    @elseif($type === 'partnership')
                                        Créer le partenariat
                                    @else
                                        Publier l'offre
                                    @endif
                                @else
                                    @if($type === 'hiring')
                                        Start recruitment
                                    @elseif($type === 'partnership')
                                        Create partnership
                                    @else
                                        Publish offer
                                    @endif
                                @endif
                                <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #2563eb;
    --primary-hover: #1d4ed8;
    --success-color: #059669;
    --warning-color: #d97706;
}

.registration-wrapper {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem 0;
}

.registration-header {
    color: white;
}

.icon-wrapper {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    backdrop-filter: blur(10px);
}

.registration-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.form-card {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

.section-card {
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
}

.section-header {
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
    padding: 1.5rem 2rem;
    border-bottom: 1px solid #e5e7eb;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
}

.section-content {
    padding: 2rem;
}

.form-floating > .form-control,
.form-floating > .form-select {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 1rem 0.75rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-floating > .form-control:focus,
.form-floating > .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.form-floating > label {
    color: #6b7280;
    font-weight: 500;
}

.btn-submit {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 1rem 3rem;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
}

@media (max-width: 768px) {
    .form-card {
        padding: 2rem 1.5rem;
        margin: 0 1rem;
    }
    
    .registration-title {
        font-size: 2rem;
    }
}
</style>
@endsection