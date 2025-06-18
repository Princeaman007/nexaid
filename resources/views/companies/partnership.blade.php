@extends('layouts.app')

@section('content')
    <h1>
        @if(app()->getLocale() == 'fr')
            Comment travaillons-nous avec les entreprises ?
        @else
            How do we work with companies?
        @endif
    </h1>

    <div class="content">
        @if(app()->getLocale() == 'fr')
            <p>Nous offrons des solutions de partenariat flexibles adaptées à vos besoins spécifiques :</p>
            
            <ul>
                <li><strong>Partenariat stratégique</strong> - Collaboration à long terme pour vos objectifs RH</li>
                <li><strong>Formation personnalisée</strong> - Programmes adaptés à vos secteurs d'activité</li>
                <li><strong>Support complet</strong> - Accompagnement dans tous les processus de recrutement</li>
                <li><strong>Réseau international</strong> - Accès à notre réseau mondial d'étudiants qualifiés</li>
                <li><strong>Solutions sur mesure</strong> - Services adaptés à la taille et aux besoins de votre entreprise</li>
            </ul>
            
            <p>Notre équipe dédiée vous accompagne à chaque étape pour garantir le succès de votre partenariat avec nous.</p>
            
            <h3>Nos services incluent :</h3>
            <ul>
                <li>Présélection des candidats selon vos critères</li>
                <li>Gestion des formalités administratives</li>
                <li>Support logistique (visa, hébergement, etc.)</li>
                <li>Suivi personnalisé pendant toute la durée du stage</li>
                <li>Évaluation et reporting de performance</li>
            </ul>
        @else
            <p>We offer flexible partnership solutions tailored to your specific needs:</p>
            
            <ul>
                <li><strong>Strategic partnership</strong> - Long-term collaboration for your HR objectives</li>
                <li><strong>Customized training</strong> - Programs adapted to your industry sectors</li>
                <li><strong>Complete support</strong> - Assistance throughout all recruitment processes</li>
                <li><strong>International network</strong> - Access to our global network of qualified students</li>
                <li><strong>Tailored solutions</strong> - Services adapted to your company size and needs</li>
            </ul>
            
            <p>Our dedicated team supports you at every step to ensure the success of your partnership with us.</p>
            
            <h3>Our services include:</h3>
            <ul>
                <li>Pre-screening candidates according to your criteria</li>
                <li>Management of administrative formalities</li>
                <li>Logistical support (visa, accommodation, etc.)</li>
                <li>Personalized follow-up throughout the internship</li>
                <li>Performance evaluation and reporting</li>
            </ul>
        @endif
        
        <div class="cta-button">
            <a href="{{ route('company.register', ['type' => 'partnership']) }}" class="btn btn-primary">
                @if(app()->getLocale() == 'fr')
                    Devenir partenaire
                @else
                    Become a partner
                @endif
            </a>
        </div>
    </div>
@endsection