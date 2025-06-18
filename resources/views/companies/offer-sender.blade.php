@extends('layouts.app')

@section('content')
    <h1>
        @if(app()->getLocale() == 'fr')
            Envoyer une offre de stage
        @else
            Send an offer
        @endif
    </h1>

    <div class="content">
        @if(app()->getLocale() == 'fr')
            <p>Publiez votre offre de stage et trouvez le candidat international idéal :</p>
            
            <div class="offer-benefits">
                <h3>Avantages de publier avec nous :</h3>
                <ul>
                    <li><strong>Visibilité internationale</strong> - Votre offre vue par des milliers d'étudiants qualifiés</li>
                    <li><strong>Candidats pré-qualifiés</strong> - Nous vérifions les profils et compétences</li>
                    <li><strong>Processus simplifié</strong> - Interface intuitive pour gérer vos candidatures</li>
                    <li><strong>Support multilingue</strong> - Communication facilitée avec les candidats</li>
                    <li><strong>Gestion complète</strong> - De la publication à l'intégration du stagiaire</li>
                </ul>
            </div>
            
            <div class="offer-process">
                <h3>Comment ça marche :</h3>
                <ol>
                    <li><strong>Publiez votre offre</strong> - Décrivez votre stage et vos exigences</li>
                    <li><strong>Recevez les candidatures</strong> - Les étudiants intéressés postulent directement</li>
                    <li><strong>Sélectionnez vos candidats</strong> - Triez et contactez vos candidats préférés</li>
                    <li><strong>Finalisez le recrutement</strong> - Nous vous accompagnons dans les démarches</li>
                </ol>
            </div>
            
            <div class="offer-requirements">
                <h3>Types de stages recherchés :</h3>
                <ul>
                    <li>Stages techniques (IT, ingénierie, sciences)</li>
                    <li>Business et management</li>
                    <li>Marketing et communication</li>
                    <li>Finance et comptabilité</li>
                    <li>Design et créatif</li>
                    <li>Et bien d'autres domaines...</li>
                </ul>
            </div>
        @else
            <p>Publish your internship offer and find the ideal international candidate:</p>
            
            <div class="offer-benefits">
                <h3>Benefits of publishing with us:</h3>
                <ul>
                    <li><strong>International visibility</strong> - Your offer seen by thousands of qualified students</li>
                    <li><strong>Pre-qualified candidates</strong> - We verify profiles and skills</li>
                    <li><strong>Simplified process</strong> - Intuitive interface to manage your applications</li>
                    <li><strong>Multilingual support</strong> - Facilitated communication with candidates</li>
                    <li><strong>Complete management</strong> - From publication to intern integration</li>
                </ul>
            </div>
            
            <div class="offer-process">
                <h3>How it works:</h3>
                <ol>
                    <li><strong>Publish your offer</strong> - Describe your internship and requirements</li>
                    <li><strong>Receive applications</strong> - Interested students apply directly</li>
                    <li><strong>Select your candidates</strong> - Sort and contact your preferred candidates</li>
                    <li><strong>Finalize recruitment</strong> - We assist you with the procedures</li>
                </ol>
            </div>
            
            <div class="offer-requirements">
                <h3>Types of internships sought:</h3>
                <ul>
                    <li>Technical internships (IT, engineering, sciences)</li>
                    <li>Business and management</li>
                    <li>Marketing and communication</li>
                    <li>Finance and accounting</li>
                    <li>Design and creative</li>
                    <li>And many other fields...</li>
                </ul>
            </div>
        @endif
        
        <div class="cta-button">
            <a href="{{ route('company.register', ['type' => 'offer_sender']) }}" class="btn btn-primary">
                @if(app()->getLocale() == 'fr')
                    Publier une offre
                @else
                    Publish an offer
                @endif
            </a>
        </div>
    </div>

    <style>
        .offer-benefits, .offer-process, .offer-requirements {
            margin: 2rem 0;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .offer-process ol {
            counter-reset: step-counter;
        }
        
        .offer-process ol li {
            counter-increment: step-counter;
            margin: 1rem 0;
            padding-left: 2rem;
            position: relative;
        }
        
        .offer-process ol li::before {
            content: counter(step-counter);
            position: absolute;
            left: 0;
            top: 0;
            background: #007bff;
            color: white;
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }
    </style>
@endsection