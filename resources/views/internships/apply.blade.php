@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('internships.show', $internship->slug) }}" style="color: #6c757d; text-decoration: none;">
            <span style="margin-right: 5px;">&#8592;</span>
            @if(app()->getLocale() == 'fr')
                Retour à l'offre de stage
            @else
                Back to internship
            @endif
        </a>
    </div>

    <div style="max-width: 800px; margin: 0 auto; background-color: #f8f9fa; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h1 style="text-align: center; margin-bottom: 30px; color: #343a40;">
            @if(app()->getLocale() == 'fr')
                Candidature pour :
            @else
                Application for:
            @endif
            <span style="color: #007bff;">{{ $internship->title[app()->getLocale()] ?? '' }}</span>
        </h1>
        
        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('internships.apply.submit', $internship->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px;">
                <!-- Informations personnelles -->
                <div style="flex: 1; min-width: 250px;">
                    <h3 style="margin-top: 0; color: #343a40; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                        @if(app()->getLocale() == 'fr')
                            Informations personnelles
                        @else
                            Personal Information
                        @endif
                    </h3>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">
                            @if(app()->getLocale() == 'fr')
                                Nom complet *
                            @else
                                Full Name *
                            @endif
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                               style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ced4da;">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">
                            @if(app()->getLocale() == 'fr')
                                Email *
                            @else
                                Email *
                            @endif
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ced4da;">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="phone" style="display: block; margin-bottom: 5px; font-weight: bold;">
                            @if(app()->getLocale() == 'fr')
                                Téléphone
                            @else
                                Phone
                            @endif
                        </label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                               style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ced4da;">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="linkedin" style="display: block; margin-bottom: 5px; font-weight: bold;">
                            @if(app()->getLocale() == 'fr')
                                Profil LinkedIn
                            @else
                                LinkedIn Profile
                            @endif
                        </label>
                        <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin') }}"
                               style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ced4da;"
                               placeholder="https://www.linkedin.com/in/username">
                    </div>
                </div>
                
                <!-- Parcours -->
                <div style="flex: 1; min-width: 250px;">
                    <h3 style="margin-top: 0; color: #343a40; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                        @if(app()->getLocale() == 'fr')
                            Votre parcours
                        @else
                            Your Background
                        @endif
                    </h3>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="education" style="display: block; margin-bottom: 5px; font-weight: bold;">
                            @if(app()->getLocale() == 'fr')
                                Formation
                            @else
                                Education
                            @endif
                        </label>
                        <textarea id="education" name="education" rows="3" 
                                 style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ced4da;">{{ old('education') }}</textarea>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="experience" style="display: block; margin-bottom: 5px; font-weight: bold;">
                            @if(app()->getLocale() == 'fr')
                                Expérience
                            @else
                                Experience
                            @endif
                        </label>
                        <textarea id="experience" name="experience" rows="3"
                                 style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ced4da;">{{ old('experience') }}</textarea>
                    </div>
                </div>
            </div>
            
            <!-- Documents -->
            <div style="margin-bottom: 20px;">
                <h3 style="color: #343a40; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
                    @if(app()->getLocale() == 'fr')
                        Documents
                    @else
                        Documents
                    @endif
                </h3>
                
                <div style="margin-bottom: 15px;">
                    <label for="cv" style="display: block; margin-bottom: 5px; font-weight: bold;">
                        @if(app()->getLocale() == 'fr')
                            CV (PDF, DOC, DOCX) *
                        @else
                            Resume/CV (PDF, DOC, DOCX) *
                        @endif
                    </label>
                    <input type="file" id="cv" name="cv" required accept=".pdf,.doc,.docx"
                           style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ced4da;">
                    <small style="color: #6c757d; display: block; margin-top: 5px;">
                        @if(app()->getLocale() == 'fr')
                            Taille maximale : 5 Mo
                        @else
                            Maximum size: 5 MB
                        @endif
                    </small>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label for="cover_letter" style="display: block; margin-bottom: 5px; font-weight: bold;">
                        @if(app()->getLocale() == 'fr')
                            Lettre de motivation *
                        @else
                            Cover Letter *
                        @endif
                    </label>
                    <textarea id="cover_letter" name="cover_letter" rows="8" required
                             style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ced4da;">{{ old('cover_letter') }}</textarea>
                    <small style="color: #6c757d; display: block; margin-top: 5px;">
                        @if(app()->getLocale() == 'fr')
                            Expliquez pourquoi vous êtes intéressé(e) par ce stage et pourquoi vous seriez un bon candidat.
                        @else
                            Explain why you are interested in this internship and why you would be a good candidate.
                        @endif
                    </small>
                </div>
            </div>
            
            <!-- Conditions -->
            <div style="margin-bottom: 30px;">
                <div style="display: flex; align-items: flex-start;">
                    <input type="checkbox" id="agree_terms" name="agree_terms" required
                           style="margin-right: 10px; margin-top: 5px;">
                    <label for="agree_terms" style="font-size: 0.9em; color: #495057;">
                        @if(app()->getLocale() == 'fr')
                            J'accepte que mes données soient traitées pour cette candidature. Je comprends que mon CV et ma lettre de motivation seront envoyés à l'entreprise proposant ce stage. *
                        @else
                            I agree that my data will be processed for this application. I understand that my CV and cover letter will be sent to the company offering this internship. *
                        @endif
                    </label>
                </div>
            </div>
            
            <!-- Bouton de soumission -->
            <div style="text-align: center;">
                <button type="submit" style="background-color: #28a745; color: white; border: none; padding: 12px 30px; border-radius: 4px; cursor: pointer; font-size: 1.1em;">
                    @if(app()->getLocale() == 'fr')
                        Soumettre ma candidature
                    @else
                        Submit Application
                    @endif
                </button>
            </div>
        </form>
    </div>
@endsection