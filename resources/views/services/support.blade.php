@extends('layouts.app')

@section('content')
    <h1>
        @if(app()->getLocale() == 'fr')
            Service de Support
        @else
            Support Service
        @endif
    </h1>

    <div class="service-description" style="max-width: 800px; margin: 0 auto; line-height: 1.6;">
        @if(app()->getLocale() == 'fr')
            <p>Notre service de support est conçu pour vous accompagner tout au long de votre expérience de stage à l'étranger. Nous sommes là pour vous aider à résoudre tout problème et pour vous assurer une expérience sereine et enrichissante.</p>
            
            <h2>Ce que nous offrons</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 30px;">
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Assistance administrative</h3>
                    <ul style="padding-left: 20px; margin-bottom: 0;">
                        <li>Aide pour les visas et permis de séjour</li>
                        <li>Ouverture de compte bancaire</li>
                        <li>Enregistrement auprès des autorités locales</li>
                        <li>Assurance santé et documents administratifs</li>
                    </ul>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Support professionnel</h3>
                    <ul style="padding-left: 20px; margin-bottom: 0;">
                        <li>Médiation avec l'entreprise d'accueil</li>
                        <li>Conseils sur la culture d'entreprise locale</li>
                        <li>Aide en cas de difficultés sur le lieu de stage</li>
                        <li>Orientation professionnelle</li>
                    </ul>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Soutien personnel</h3>
                    <ul style="padding-left: 20px; margin-bottom: 0;">
                        <li>Aide à l'intégration culturelle</li>
                        <li>Recommandations sur la vie locale</li>
                        <li>Assistance médicale en cas de besoin</li>
                        <li>Soutien en cas de difficultés personnelles</li>
                    </ul>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Activités sociales</h3>
                    <ul style="padding-left: 20px; margin-bottom: 0;">
                        <li>Événements de networking</li>
                        <li>Rencontres entre stagiaires internationaux</li>
                        <li>Sorties culturelles et découverte</li>
                        <li>Activités de team building</li>
                    </ul>
                </div>
            </div>
            
            <h2>Comment accéder à notre support</h2>
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 30px;">
                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <div style="flex: 1; min-width: 200px;">
                        <h3 style="margin-top: 0;">Ligne d'assistance 24/7</h3>
                        <p>Notre ligne téléphonique d'urgence est disponible 24h/24, 7j/7 pour tout problème urgent.</p>
                        <p><strong>Numéro :</strong> +33 (0)1 XX XX XX XX</p>
                    </div>
                    
                    <div style="flex: 1; min-width: 200px;">
                        <h3 style="margin-top: 0;">Support par email</h3>
                        <p>Pour les questions non urgentes, envoyez-nous un email et nous vous répondrons sous 24 heures.</p>
                        <p><strong>Email :</strong> support@internshipmakers.com</p>
                    </div>
                    
                    <div style="flex: 1; min-width: 200px;">
                        <h3 style="margin-top: 0;">Rendez-vous personnels</h3>
                        <p>Vous pouvez prendre rendez-vous avec un conseiller pour discuter de vos préoccupations en personne ou par vidéo.</p>
                    </div>
                    
                    <div style="flex: 1; min-width: 200px;">
                        <h3 style="margin-top: 0;">Application mobile</h3>
                        <p>Notre application mobile vous permet d'accéder à des ressources utiles et de nous contacter facilement.</p>
                    </div>
                </div>
            </div>
            
            <h2>Témoignages</h2>
            <div style="margin-bottom: 30px;">
                <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 15px;">
                    <p><em>"Lorsque j'ai eu des problèmes avec mon propriétaire, l'équipe de support est intervenue immédiatement et a résolu la situation. Leur aide a été inestimable pendant mon séjour à Berlin."</em></p>
                    <p style="text-align: right; margin-bottom: 0;"><strong>Thomas L., 24 ans</strong> - Stage en ingénierie à Berlin</p>
                </div>
                
                <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
                    <p><em>"J'étais inquiète à l'idée de partir seule à l'étranger, mais grâce aux événements sociaux organisés par Internship Makers, j'ai rencontré d'autres stagiaires dès la première semaine et je me suis rapidement sentie chez moi à Madrid."</em></p>
                    <p style="text-align: right; margin-bottom: 0;"><strong>Sophie K., 22 ans</strong> - Stage en marketing à Madrid</p>
                </div>
            </div>
            
            <h2>Notre engagement</h2>
            <p>Nous nous engageons à :</p>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Réactivité</strong> - Réponse à toute demande urgente dans un délai maximum de 2 heures</li>
                <li style="margin-bottom: 10px;"><strong>Suivi personnalisé</strong> - Un conseiller dédié pour chaque stagiaire</li>
                <li style="margin-bottom: 10px;"><strong>Confidentialité</strong> - Traitement confidentiel de toutes vos préoccupations</li>
                <li style="margin-bottom: 10px;"><strong>Solutions concrètes</strong> - Nous ne nous contentons pas d'écouter, nous agissons pour résoudre vos problèmes</li>
            </ul>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('contact.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">
                    Nous contacter
                </a>
            </div>
        @else
            <p>Our support service is designed to accompany you throughout your internship experience abroad. We are here to help you solve any problems and to ensure you have a smooth and enriching experience.</p>
            
            <h2>What We Offer</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 30px;">
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Administrative Assistance</h3>
                    <ul style="padding-left: 20px; margin-bottom: 0;">
                        <li>Help with visas and residence permits</li>
                        <li>Opening a bank account</li>
                        <li>Registration with local authorities</li>
                        <li>Health insurance and administrative documents</li>
                    </ul>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Professional Support</h3>
                    <ul style="padding-left: 20px; margin-bottom: 0;">
                        <li>Mediation with the host company</li>
                        <li>Advice on local corporate culture</li>
                        <li>Help in case of difficulties at the internship site</li>
                        <li>Professional guidance</li>
                    </ul>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Personal Support</h3>
                    <ul style="padding-left: 20px; margin-bottom: 0;">
                        <li>Help with cultural integration</li>
                        <li>Recommendations on local life</li>
                        <li>Medical assistance if needed</li>
                        <li>Support in case of personal difficulties</li>
                    </ul>
                </div>
                
                <div style="flex: 1; min-width: 200px; background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
                    <h3 style="margin-top: 0;">Social Activities</h3>
                    <ul style="padding-left: 20px; margin-bottom: 0;">
                        <li>Networking events</li>
                        <li>Meetings with other international interns</li>
                        <li>Cultural outings and discovery</li>
                        <li>Team building activities</li>
                    </ul>
                </div>
            </div>
            
            <h2>How to Access Our Support</h2>
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 30px;">
                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <div style="flex: 1; min-width: 200px;">
                        <h3 style="margin-top: 0;">24/7 Helpline</h3>
                        <p>Our emergency phone line is available 24/7 for any urgent issues.</p>
                        <p><strong>Number:</strong> +33 (0)1 XX XX XX XX</p>
                    </div>
                    
                    <div style="flex: 1; min-width: 200px;">
                        <h3 style="margin-top: 0;">Email Support</h3>
                        <p>For non-urgent questions, send us an email and we'll respond within 24 hours.</p>
                        <p><strong>Email:</strong> support@internshipmakers.com</p>
                    </div>
                    
                    <div style="flex: 1; min-width: 200px;">
                        <h3 style="margin-top: 0;">Personal Appointments</h3>
                        <p>You can schedule an appointment with an advisor to discuss your concerns in person or via video.</p>
                    </div>
                    
                    <div style="flex: 1; min-width: 200px;">
                        <h3 style="margin-top: 0;">Mobile App</h3>
                        <p>Our mobile app allows you to access useful resources and contact us easily.</p>
                    </div>
                </div>
            </div>
            
            <h2>Testimonials</h2>
            <div style="margin-bottom: 30px;">
                <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 15px;">
                    <p><em>"When I had problems with my landlord, the support team stepped in immediately and resolved the situation. Their help was invaluable during my stay in Berlin."</em></p>
                    <p style="text-align: right; margin-bottom: 0;"><strong>Thomas L., 24</strong> - Engineering internship in Berlin</p>
                </div>
                
                <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
                    <p><em>"I was worried about going abroad alone, but thanks to the social events organized by Internship Makers, I met other interns in the first week and quickly felt at home in Madrid."</em></p>
                    <p style="text-align: right; margin-bottom: 0;"><strong>Sophie K., 22</strong> - Marketing internship in Madrid</p>
                </div>
            </div>
            
            <h2>Our Commitment</h2>
            <p>We are committed to:</p>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Responsiveness</strong> - Response to any urgent request within a maximum of 2 hours</li>
                <li style="margin-bottom: 10px;"><strong>Personalized Follow-up</strong> - A dedicated advisor for each intern</li>
                <li style="margin-bottom: 10px;"><strong>Confidentiality</strong> - Confidential handling of all your concerns</li>
                <li style="margin-bottom: 10px;"><strong>Concrete Solutions</strong> - We don't just listen, we act to solve your problems</li>
            </ul>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('contact.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">
                    Contact Us
                </a>
            </div>
        @endif
    </div>
@endsection