@extends('layouts.app')

@section('content')
    <h1>
        @if(app()->getLocale() == 'fr')
            Service de Logement
        @else
            Housing Service
        @endif
    </h1>

    <div class="service-description" style="max-width: 800px; margin: 0 auto; line-height: 1.6;">
        @if(app()->getLocale() == 'fr')
            <p>Trouver un logement à l'étranger peut être compliqué. Notre service de logement vous aide à trouver un hébergement adapté à vos besoins et à votre budget pour votre séjour.</p>
            
            <h2>Types de logements proposés</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 30px;">
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Résidences étudiantes</h3>
                    <p>Logements spécialement conçus pour les étudiants, avec des services et installations communes.</p>
                    <p><strong>À partir de :</strong> 400€/mois</p>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Colocations</h3>
                    <p>Partagez un appartement avec d'autres étudiants ou jeunes professionnels internationaux.</p>
                    <p><strong>À partir de :</strong> 350€/mois</p>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Familles d'accueil</h3>
                    <p>Vivez avec une famille locale pour une immersion linguistique et culturelle complète.</p>
                    <p><strong>À partir de :</strong> 500€/mois</p>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Studios privés</h3>
                    <p>Pour ceux qui préfèrent leur indépendance, nous proposons des studios et appartements.</p>
                    <p><strong>À partir de :</strong> 600€/mois</p>
                </div>
            </div>
            
            <h2>Notre processus</h2>
            <ol style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Évaluation des besoins</strong> - Nous discutons de vos préférences, de votre budget et de vos exigences</li>
                <li style="margin-bottom: 10px;"><strong>Proposition de logements</strong> - Nous vous proposons plusieurs options correspondant à vos critères</li>
                <li style="margin-bottom: 10px;"><strong>Visite virtuelle</strong> - Découvrez votre futur logement par vidéo ou photos détaillées</li>
                <li style="margin-bottom: 10px;"><strong>Réservation sécurisée</strong> - Nous gérons les contrats et les cautions pour vous</li>
                <li style="margin-bottom: 10px;"><strong>Accueil et installation</strong> - Nous vous accueillons à votre arrivée et vous aidons à vous installer</li>
            </ol>
            
            <h2>Avantages de notre service</h2>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Garantie de qualité</strong> - Tous nos logements sont inspectés et certifiés</li>
                <li style="margin-bottom: 10px;"><strong>Assistance 24/7</strong> - Une équipe disponible pour vous aider en cas de problème</li>
                <li style="margin-bottom: 10px;"><strong>Pas de frais cachés</strong> - Des tarifs transparents sans surprises</li>
                <li style="margin-bottom: 10px;"><strong>Flexibilité</strong> - Des contrats adaptés à la durée de votre stage</li>
            </ul>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('contact.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">
                    Demander des informations
                </a>
            </div>
        @else
            <p>Finding accommodation abroad can be complicated. Our housing service helps you find accommodations suited to your needs and budget for your stay.</p>
            
            <h2>Types of Housing Offered</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 30px;">
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Student Residences</h3>
                    <p>Accommodations specially designed for students, with shared services and facilities.</p>
                    <p><strong>Starting from:</strong> €400/month</p>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Shared Apartments</h3>
                    <p>Share an apartment with other international students or young professionals.</p>
                    <p><strong>Starting from:</strong> €350/month</p>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Host Families</h3>
                    <p>Live with a local family for complete linguistic and cultural immersion.</p>
                    <p><strong>Starting from:</strong> €500/month</p>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Private Studios</h3>
                    <p>For those who prefer independence, we offer studios and apartments.</p>
                    <p><strong>Starting from:</strong> €600/month</p>
                </div>
            </div>
            
            <h2>Our Process</h2>
            <ol style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Needs Assessment</strong> - We discuss your preferences, budget, and requirements</li>
                <li style="margin-bottom: 10px;"><strong>Housing Proposals</strong> - We offer you several options matching your criteria</li>
                <li style="margin-bottom: 10px;"><strong>Virtual Tour</strong> - Discover your future accommodation through video or detailed photos</li>
                <li style="margin-bottom: 10px;"><strong>Secure Booking</strong> - We handle contracts and deposits for you</li>
                <li style="margin-bottom: 10px;"><strong>Welcome and Installation</strong> - We welcome you on arrival and help you settle in</li>
            </ol>
            
            <h2>Advantages of Our Service</h2>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Quality Guarantee</strong> - All our accommodations are inspected and certified</li>
                <li style="margin-bottom: 10px;"><strong>24/7 Assistance</strong> - A team available to help you in case of any issues</li>
                <li style="margin-bottom: 10px;"><strong>No Hidden Fees</strong> - Transparent pricing with no surprises</li>
                <li style="margin-bottom: 10px;"><strong>Flexibility</strong> - Contracts adapted to the duration of your internship</li>
            </ul>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('contact.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">
                    Request Information
                </a>
            </div>
        @endif
    </div>
@endsection