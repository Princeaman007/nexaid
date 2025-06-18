@extends('layouts.app')

@section('content')
    <h1>
        @if(app()->getLocale() == 'fr')
            Service de Recherche de Stage
        @else
            Internship Search Service
        @endif
    </h1>

    <div class="service-description" style="max-width: 800px; margin: 0 auto; line-height: 1.6;">
        @if(app()->getLocale() == 'fr')
            <p>Trouver le stage parfait peut être un défi, surtout dans un pays étranger. Notre service de recherche de stage vous accompagne dans toutes les étapes pour décrocher l'opportunité qui correspond à vos ambitions et à votre profil.</p>
            
            <h2>Comment nous vous aidons</h2>
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 30px;">
                <ol style="padding-left: 20px;">
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Analyse de profil</h3>
                        <p>Nous analysons votre CV, vos compétences et vos objectifs pour identifier les opportunités les plus adaptées.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Recherche ciblée</h3>
                        <p>Notre équipe recherche activement des stages dans votre domaine d'études et vos secteurs d'intérêt.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Préparation des candidatures</h3>
                        <p>Nous vous aidons à optimiser votre CV et lettre de motivation selon les standards locaux.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Mise en relation</h3>
                        <p>Nous vous mettons en contact direct avec les entreprises et facilitons le processus de candidature.</p>
                    </li>
                    <li style="margin-bottom: 0;">
                        <h3 style="margin-top: 0;">Suivi personnalisé</h3>
                        <p>Accompagnement jusqu'à la signature de votre convention de stage.</p>
                    </li>
                </ol>
            </div>
            
            <h2>Secteurs d'activité</h2>
            <p>Nous avons des partenariats dans de nombreux secteurs :</p>
            <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px;">
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Tech & IT</h3>
                    <p>Développement, Data, Cybersécurité</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Marketing</h3>
                    <p>Digital, Communication, Events</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Finance</h3>
                    <p>Banque, Assurance, Consulting</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Ingénierie</h3>
                    <p>Mécanique, Civil, Électronique</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Santé</h3>
                    <p>Médical, Pharmaceutique, Recherche</p>
                </div>
            </div>
            <p>Et bien d'autres domaines ! Contactez-nous pour discuter de vos besoins spécifiques.</p>
            
            <h2>Nos tarifs</h2>
            <div style="margin-bottom: 30px;">
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <thead>
                        <tr style="background-color: #f8f9fa;">
                            <th style="padding: 10px; text-align: left; border: 1px solid #dee2e6;">Formule</th>
                            <th style="padding: 10px; text-align: left; border: 1px solid #dee2e6;">Services inclus</th>
                            <th style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #dee2e6;"><strong>Basic</strong></td>
                            <td style="padding: 10px; border: 1px solid #dee2e6;">Analyse de profil + 5 candidatures</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">199€</td>
                        </tr>
                        <tr style="background-color: #f8f9fa;">
                            <td style="padding: 10px; border: 1px solid #dee2e6;"><strong>Premium</strong></td>
                            <td style="padding: 10px; border: 1px solid #dee2e6;">Basic + 10 candidatures + CV optimisé</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">349€</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #dee2e6;"><strong>Success</strong></td>
                            <td style="padding: 10px; border: 1px solid #dee2e6;">Premium + Suivi illimité + Garantie*</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">499€</td>
                        </tr>
                    </tbody>
                </table>
                <p style="font-size: 0.9em; color: #666; margin-top: 10px;">
                    *Garantie : Si aucun stage n'est trouvé après 3 mois, nous vous remboursons 50% du montant payé.
                </p>
            </div>
            
            <h2>Pourquoi choisir notre service</h2>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Réseau étendu</strong> - Plus de 2000 entreprises partenaires en Europe</li>
                <li style="margin-bottom: 10px;"><strong>Expertise locale</strong> - Connaissance approfondie des marchés du travail européens</li>
                <li style="margin-bottom: 10px;"><strong>Taux de réussite élevé</strong> - 85% de nos candidats trouvent un stage dans les 2 mois</li>
                <li style="margin-bottom: 10px;"><strong>Support multilingue</strong> - Équipe parlant français, anglais, espagnol, allemand</li>
                <li style="margin-bottom: 10px;"><strong>Suivi personnalisé</strong> - Un conseiller dédié pour chaque candidat</li>
            </ul>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('contact.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">
                    Commencer ma recherche
                </a>
            </div>
        @else
            <p>Finding the perfect internship can be challenging, especially in a foreign country. Our internship search service supports you through every step to land the opportunity that matches your ambitions and profile.</p>
            
            <h2>How We Help You</h2>
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 30px;">
                <ol style="padding-left: 20px;">
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Profile Analysis</h3>
                        <p>We analyze your CV, skills, and objectives to identify the most suitable opportunities.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Targeted Search</h3>
                        <p>Our team actively searches for internships in your field of study and areas of interest.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Application Preparation</h3>
                        <p>We help you optimize your CV and cover letter according to local standards.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <h3 style="margin-top: 0;">Direct Connection</h3>
                        <p>We put you in direct contact with companies and facilitate the application process.</p>
                    </li>
                    <li style="margin-bottom: 0;">
                        <h3 style="margin-top: 0;">Personalized Follow-up</h3>
                        <p>Support until you sign your internship agreement.</p>
                    </li>
                </ol>
            </div>
            
            <h2>Business Sectors</h2>
            <p>We have partnerships in many sectors:</p>
            <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px;">
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Tech & IT</h3>
                    <p>Development, Data, Cybersecurity</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Marketing</h3>
                    <p>Digital, Communication, Events</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Finance</h3>
                    <p>Banking, Insurance, Consulting</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Engineering</h3>
                    <p>Mechanical, Civil, Electronic</p>
                </div>
                
                <div style="flex: 1; min-width: 150px; text-align: center; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Healthcare</h3>
                    <p>Medical, Pharmaceutical, Research</p>
                </div>
            </div>
            <p>And many other fields! Contact us to discuss your specific needs.</p>
            
            <h2>Our Rates</h2>
            <div style="margin-bottom: 30px;">
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <thead>
                        <tr style="background-color: #f8f9fa;">
                            <th style="padding: 10px; text-align: left; border: 1px solid #dee2e6;">Package</th>
                            <th style="padding: 10px; text-align: left; border: 1px solid #dee2e6;">Services Included</th>
                            <th style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #dee2e6;"><strong>Basic</strong></td>
                            <td style="padding: 10px; border: 1px solid #dee2e6;">Profile analysis + 5 applications</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">€199</td>
                        </tr>
                        <tr style="background-color: #f8f9fa;">
                            <td style="padding: 10px; border: 1px solid #dee2e6;"><strong>Premium</strong></td>
                            <td style="padding: 10px; border: 1px solid #dee2e6;">Basic + 10 applications + CV optimization</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">€349</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #dee2e6;"><strong>Success</strong></td>
                            <td style="padding: 10px; border: 1px solid #dee2e6;">Premium + Unlimited follow-up + Guarantee*</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #dee2e6;">€499</td>
                        </tr>
                    </tbody>
                </table>
                <p style="font-size: 0.9em; color: #666; margin-top: 10px;">
                    *Guarantee: If no internship is found after 3 months, we refund 50% of the amount paid.
                </p>
            </div>
            
            <h2>Why Choose Our Service</h2>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Extensive Network</strong> - Over 2000 partner companies across Europe</li>
                <li style="margin-bottom: 10px;"><strong>Local Expertise</strong> - Deep knowledge of European job markets</li>
                <li style="margin-bottom: 10px;"><strong>High Success Rate</strong> - 85% of our candidates find an internship within 2 months</li>
                <li style="margin-bottom: 10px;"><strong>Multilingual Support</strong> - Team speaking French, English, Spanish, German</li>
                <li style="margin-bottom: 10px;"><strong>Personalized Follow-up</strong> - A dedicated advisor for each candidate</li>
            </ul>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('contact.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">
                    Start My Search
                </a>
            </div>
        @endif
    </div>
@endsection