@extends('layouts.app')

@section('content')
    <h1>
        @if(app()->getLocale() == 'fr')
            Service de Transport depuis l'Aéroport
        @else
            Airport Pickup Service
        @endif
    </h1>

    <div class="service-description" style="max-width: 800px; margin: 0 auto; line-height: 1.6;">
        @if(app()->getLocale() == 'fr')
            <p>Arriver dans un nouveau pays peut être stressant. Notre service de transport depuis l'aéroport vous assure un accueil chaleureux et un transfert en toute sécurité vers votre logement, vous permettant de commencer votre expérience de stage de la meilleure façon possible.</p>
            
            <h2>Comment fonctionne notre service</h2>
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 30px;">
                <ol style="padding-left: 20px;">
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Réservation</h3>
                        <p>Réservez votre transfert à l'avance en nous fournissant les détails de votre vol et votre adresse de destination.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Suivi de vol</h3>
                        <p>Nous suivons votre vol en temps réel pour nous assurer d'être là même en cas de retard.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Accueil personnalisé</h3>
                        <p>Notre chauffeur vous attend dans la zone d'arrivée avec une pancarte à votre nom.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Transfert confortable</h3>
                        <p>Voyage jusqu'à votre logement dans un véhicule confortable et climatisé.</p>
                    </li>
                    <li style="margin-bottom: 0;">
                        <h3 style="margin-top: 0;">Assistance à l'installation</h3>
                        <p>Notre chauffeur vous aide avec vos bagages et vous fournit des informations utiles sur la ville.</p>
                    </li>
                </ol>
            </div>
            
            <h2>Aéroports desservis</h2>
            <p>Nous proposons des transferts depuis tous les principaux aéroports des villes où nous opérons, notamment :</p>
            <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px;">
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Londres</h3>
                    <p>Heathrow, Gatwick, Stansted, Luton, City</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Paris</h3>
                    <p>Charles de Gaulle, Orly, Beauvais</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Madrid</h3>
                    <p>Barajas</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Berlin</h3>
                    <p>Brandenburg</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Rome</h3>
                    <p>Fiumicino, Ciampino</p>
                </div>
            </div>
            <p>Et bien d'autres! Contactez-nous pour vérifier la disponibilité dans votre ville de destination.</p>
            
            <h2>Tarifs</h2>
            <p>Nos tarifs sont transparents et dépendent de la distance entre l'aéroport et votre destination finale :</p>
            <div style="margin-bottom: 30px;">
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <thead>
                        <tr style="background-color: #f8f9fa;">
                            <th style="padding: 10px; text-align: left; border: 1px solid #dee2e6;">Distance</th>
                            <th style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">Tarif standard</th>
                            <th style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">Tarif de nuit (22h-6h)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #dee2e6;">0-20 km</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">50€</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">60€</td>
                        </tr>
                        <tr style="background-color: #f8f9fa;">
                            <td style="padding: 10px; border: 1px solid #dee2e6;">21-40 km</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">70€</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">85€</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #dee2e6;">41-60 km</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">90€</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">110€</td>
                        </tr>
                        <tr style="background-color: #f8f9fa;">
                            <td style="padding: 10px; border: 1px solid #dee2e6;">61+ km</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">Sur devis</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">Sur devis</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <h2>Avantages de notre service</h2>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Sécurité et tranquillité d'esprit</strong> - Évitez les arnaques et le stress de naviguer dans les transports publics dans un pays inconnu</li>
                <li style="margin-bottom: 10px;"><strong>Économie de temps</strong> - Pas besoin de rechercher votre chemin ou d'attendre les transports en commun</li>
                <li style="margin-bottom: 10px;"><strong>Confort</strong> - Voyage confortable après un long vol</li>
                <li style="margin-bottom: 10px;"><strong>Assistance linguistique</strong> - Nos chauffeurs parlent plusieurs langues</li>
                <li style="margin-bottom: 10px;"><strong>Fiabilité</strong> - Service ponctuel et garanti, même en cas de retard de vol</li>
            </ul>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('contact.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">
                    Réserver un transfert
                </a>
            </div>
        @else
            <p>Arriving in a new country can be stressful. Our airport pickup service ensures a warm welcome and a safe transfer to your accommodation, allowing you to start your internship experience in the best possible way.</p>
            
            <h2>How Our Service Works</h2>
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 30px;">
                <ol style="padding-left: 20px;">
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Booking</h3>
                        <p>Book your transfer in advance by providing us with your flight details and destination address.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Flight Tracking</h3>
                        <p>We track your flight in real-time to ensure we're there even in case of delays.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Personalized Welcome</h3>
                        <p>Our driver waits for you in the arrival area with a sign bearing your name.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Comfortable Transfer</h3>
                        <p>Travel to your accommodation in a comfortable, air-conditioned vehicle.</p>
                    </li>
                    <li style="margin-bottom: 0;">
                        <h3 style="margin-top: 0;">Settlement Assistance</h3>
                        <p>Our driver helps you with your luggage and provides useful information about the city.</p>
                    </li>
                </ol>
            </div>
            
            <h2>Airports Served</h2>
            <p>We offer transfers from all major airports in the cities where we operate, including:</p>
            <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px;">
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">London</h3>
                    <p>Heathrow, Gatwick, Stansted, Luton, City</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Paris</h3>
                    <p>Charles de Gaulle, Orly, Beauvais</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Madrid</h3>
                    <p>Barajas</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Berlin</h3>
                    <p>Brandenburg</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Rome</h3>
                    <p>Fiumicino, Ciampino</p>
                </div>
            </div>
            <p>And many more! Contact us to check availability in your destination city.</p>
            
            <h2>Rates</h2>
            <p>Our rates are transparent and depend on the distance between the airport and your final destination:</p>
            <div style="margin-bottom: 30px;">
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <thead>
                        <tr style="background-color: #f8f9fa;">
                            <th style="padding: 10px; text-align: left; border: 1px solid #dee2e6;">Distance</th>
                            <th style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">Standard Rate</th>
                            <th style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">Night Rate (10PM-6AM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #dee2e6;">0-20 km</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">€50</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">€60</td>
                        </tr>
                        <tr style="background-color: #f8f9fa;">
                            <td style="padding: 10px; border: 1px solid #dee2e6;">21-40 km</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">€70</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">€85</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #dee2e6;">41-60 km</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">€90</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">€110</td>
                        </tr>
                        <tr style="background-color: #f8f9fa;">
                            <td style="padding: 10px; border: 1px solid #dee2e6;">61+ km</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">On quote</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">On quote</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <h2>Advantages of Our Service</h2>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Safety and Peace of Mind</strong> - Avoid scams and the stress of navigating public transport in an unfamiliar country</li>
                <li style="margin-bottom: 10px;"><strong>Time Saving</strong> - No need to figure out your way or wait for public transportation</li>
                <li style="margin-bottom: 10px;"><strong>Comfort</strong> - Comfortable travel after a long flight</li>
                <li style="margin-bottom: 10px;"><strong>Language Assistance</strong> - Our drivers speak multiple languages</li>
                <li style="margin-bottom: 10px;"><strong>Reliability</strong> - Punctual and guaranteed service, even in case of flight delays</li>
            </ul>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('contact.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">
                    Book a Transfer
                </a>
            </div>
        @endif
    </div>
@endsection