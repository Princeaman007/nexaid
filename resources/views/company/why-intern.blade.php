@extends('layouts.app')

@section('content')
    <h1>
        @if(app()->getLocale() == 'fr')
            Pourquoi recruter un stagiaire international ?
        @else
            Why hire an international intern?
        @endif
    </h1>

    <div class="content">
        @if(app()->getLocale() == 'fr')
            <p>Les stagiaires internationaux apportent une perspective unique et des compétences précieuses à votre entreprise :</p>
            
            <ul>
                <li><strong>Diversité culturelle</strong> - Enrichissez votre environnement de travail</li>
                <li><strong>Compétences linguistiques</strong> - Accédez à des talents multilingues</li>
                <li><strong>Perspectives nouvelles</strong> - Bénéficiez d'idées innovantes et d'approches différentes</li>
                <li><strong>Expansion internationale</strong> - Établissez des connexions pour vos projets internationaux</li>
                <li><strong>Flexibilité</strong> - Renforcez vos équipes avec des talents motivés sur des durées variables</li>
            </ul>
            
            <p>Nous nous chargeons de tous les aspects administratifs et logistiques pour vous permettre de vous concentrer sur votre cœur de métier.</p>
        @else
            <p>International interns bring unique perspectives and valuable skills to your company:</p>
            
            <ul>
                <li><strong>Cultural diversity</strong> - Enrich your work environment</li>
                <li><strong>Language skills</strong> - Access multilingual talent</li>
                <li><strong>Fresh perspectives</strong> - Benefit from innovative ideas and different approaches</li>
                <li><strong>International expansion</strong> - Establish connections for your international projects</li>
                <li><strong>Flexibility</strong> - Strengthen your teams with motivated talent for varying durations</li>
            </ul>
            
            <p>We handle all administrative and logistical aspects so you can focus on your core business.</p>
        @endif
        
        <div class="cta-button">
            <a href="{{ route('company.send-offer') }}" class="btn btn-primary">
                @if(app()->getLocale() == 'fr')
                    Soumettre une offre de stage
                @else
                    Submit an internship offer
                @endif
            </a>
        </div>
    </div>
@endsection