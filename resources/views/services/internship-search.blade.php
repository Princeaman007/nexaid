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
            <p>Notre service de recherche de stage vous aide à trouver le stage parfait correspondant à vos compétences, intérêts et objectifs de carrière.</p>
            
            <h2>Comment ça fonctionne</h2>
            <p>Notre processus en 4 étapes vous guide de votre candidature initiale jusqu'à l'obtention du stage idéal :</p>
            
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                <ol style="padding-left: 20px;">
                    <li style="margin-bottom: 10px;"><strong>Évaluation de profil</strong> - Nous analysons votre CV, vos compétences et vos objectifs</li>
                    <li style="margin-bottom: 10px;"><strong>Recherche personnalisée</strong> - Notre équipe recherche des opportunités correspondant à votre profil</li>
                    <li style="margin-bottom: 10px;"><strong>Préparation aux entretiens</strong> - Nous vous préparons aux entretiens spécifiques à votre secteur</li>
                    <li style="margin-bottom: 10px;"><strong>Assistance administrative</strong> - Nous vous aidons avec les documents et les démarches nécessaires</li>
                </ol>
            </div>
            
            <h2>Nos avantages</h2>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>Réseau d'entreprises internationales</strong> - Accédez à notre vaste réseau d'entreprises partenaires</li>
                <li style="margin-bottom: 10px;"><strong>Accompagnement personnalisé</strong> - Un conseiller dédié vous accompagne tout au long du processus</li>
                <li style="margin-bottom: 10px;"><strong>Suivi régulier</strong> - Nous assurons un suivi régulier pendant toute la durée de votre stage</li>
                <li style="margin-bottom: 10px;"><strong>Taux de réussite élevé</strong> - Plus de 90% de nos candidats trouvent un stage correspondant à leur profil</li>
            </ul>
            
            <h2>Témoignages</h2>
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                <p><em>"Grâce à Internship Makers, j'ai trouvé un stage dans une entreprise internationale à Londres. Le processus a été simple et efficace, et j'ai bénéficié d'un soutien constant."</em></p>
                <p style="text-align: right;"><strong>Marie D., 23 ans</strong> - Stage en marketing digital</p>
            </div>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('internships.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">
                    @if(app()->getLocale() == 'fr')
                        Explorer les stages disponibles
                    @else
                        Explore available internships
                    @endif
                </a>
            </div>
        @else
            <p>Our internship search service helps you find the perfect internship that matches your skills, interests, and career goals.</p>
            
            <h2>How It Works</h2>
            <p>Our 4-step process guides you from your initial application to securing your ideal internship:</p>
            
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                <ol style="padding-left: 20px;">
                    <li style="margin-bottom: 10px;"><strong>Profile Assessment</strong> - We analyze your resume, skills, and objectives</li>
                    <li style="margin-bottom: 10px;"><strong>Personalized Search</strong> - Our team searches for opportunities matching your profile</li>
                    <li style="margin-bottom: 10px;"><strong>Interview Preparation</strong> - We prepare you for interviews specific to your sector</li>
                    <li style="margin-bottom: 10px;"><strong>Administrative Assistance</strong> - We help you with necessary documents and procedures</li>
                </ol>
            </div>
            
            <h2>Our Advantages</h2>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 10px;"><strong>International Business Network</strong> - Access our extensive network of partner companies</li>
                <li style="margin-bottom: 10px;"><strong>Personalized Support</strong> - A dedicated advisor accompanies you throughout the process</li>
                <li style="margin-bottom: 10px;"><strong>Regular Follow-up</strong> - We ensure regular follow-up throughout your internship</li>
                <li style="margin-bottom: 10px;"><strong>High Success Rate</strong> - Over 90% of our candidates find an internship matching their profile</li>
            </ul>
            
            <h2>Testimonials</h2>
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                <p><em>"Thanks to Internship Makers, I found an internship in an international company in London. The process was simple and efficient, and I received constant support."</em></p>
                <p style="text-align: right;"><strong>Marie D., 23</strong> - Digital Marketing Internship</p>
            </div>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('internships.index') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px;">
                    Explore available internships
                </a>
            </div>
        @endif
    </div>
@endsection