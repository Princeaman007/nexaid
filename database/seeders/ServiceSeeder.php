<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        // Service Recherche de Stage
        Service::create([
            'type' => 'internship-search',
            'title' => [
                'fr' => 'Recherche de Stage',
                'en' => 'Internship Search'
            ],
            'subtitle' => [
                'fr' => 'Notre service de recherche de stage vous aide à trouver le stage parfait qui correspond à vos compétences et objectifs.',
                'en' => 'Our internship search service helps you find the perfect internship that matches your skills and career goals.'
            ],
            'description' => [
                'fr' => '<p>Notre équipe dédiée vous accompagne dans votre recherche de stage international. Nous analysons votre profil, vos compétences et vos objectifs pour vous proposer les opportunités les plus adaptées.</p>',
                'en' => '<p>Our dedicated team supports you in your international internship search. We analyze your profile, skills and objectives to offer you the most suitable opportunities.</p>'
            ],
            'how_it_works' => [
                'fr' => [
                    ['step' => '1', 'title' => 'Évaluation du profil', 'description' => 'Nous analysons votre CV, vos compétences et vos objectifs'],
                    ['step' => '2', 'title' => 'Recherche personnalisée', 'description' => 'Notre équipe recherche les opportunités qui correspondent à votre profil'],
                    ['step' => '3', 'title' => 'Préparation aux entretiens', 'description' => 'Nous vous préparons aux entretiens spécifiques à votre secteur'],
                    ['step' => '4', 'title' => 'Assistance administrative', 'description' => 'Nous vous aidons avec les documents et procédures nécessaires']
                ],
                'en' => [
                    ['step' => '1', 'title' => 'Profile Assessment', 'description' => 'We analyze your resume, skills, and objectives'],
                    ['step' => '2', 'title' => 'Personalized Search', 'description' => 'Our team searches for opportunities matching your profile'],
                    ['step' => '3', 'title' => 'Interview Preparation', 'description' => 'We prepare you for interviews specific to your sector'],
                    ['step' => '4', 'title' => 'Administrative Assistance', 'description' => 'We help you with necessary documents and procedures']
                ]
            ],
            'advantages' => [
                'fr' => [
                    ['title' => 'Réseau d\'entreprises internationales', 'description' => 'Accès à notre vaste réseau d\'entreprises partenaires', 'icon' => '🌍'],
                    ['title' => 'Accompagnement personnalisé', 'description' => 'Un conseiller dédié vous accompagne tout au long du processus', 'icon' => '👥'],
                    ['title' => 'Suivi régulier', 'description' => 'Nous assurons un suivi régulier tout au long de votre stage', 'icon' => '📊'],
                    ['title' => 'Taux de réussite élevé', 'description' => 'Plus de 90% de nos candidats trouvent un stage correspondant à leur profil', 'icon' => '✅']
                ],
                'en' => [
                    ['title' => 'International Business Network', 'description' => 'Access our extensive network of partner companies', 'icon' => '🌍'],
                    ['title' => 'Personalized Support', 'description' => 'A dedicated advisor accompanies you throughout the process', 'icon' => '👥'],
                    ['title' => 'Regular Follow-up', 'description' => 'We ensure regular follow-up throughout your internship', 'icon' => '📊'],
                    ['title' => 'High Success Rate', 'description' => 'Over 90% of our candidates find an internship matching their profile', 'icon' => '✅']
                ]
            ],
            'testimonials' => [
                'fr' => [
                    [
                        'quote' => 'Grâce à Internship Makers, j\'ai trouvé un stage dans une entreprise internationale à Londres. Le processus était simple et efficace, et j\'ai reçu un soutien constant.',
                        'author' => 'Marie D.',
                        'position' => 'Stage en Marketing Digital',
                        'company' => 'Londres'
                    ]
                ],
                'en' => [
                    [
                        'quote' => 'Thanks to Internship Makers, I found an internship in an international company in London. The process was simple and efficient, and I received constant support.',
                        'author' => 'Marie D.',
                        'position' => 'Digital Marketing Internship',
                        'company' => 'London'
                    ]
                ]
            ],
            'icon' => '🔍',
            'background_color' => '#667eea',
            'call_to_action' => [
                'fr' => ['title' => 'Trouvez votre stage idéal', 'button' => 'Commencer ma recherche'],
                'en' => ['title' => 'Find your ideal internship', 'button' => 'Start my search'],
                'url' => '/contact'
            ],
            'is_active' => true
        ]);

        // Service Logement
        Service::create([
            'type' => 'housing',
            'title' => [
                'fr' => 'Logement',
                'en' => 'Housing'
            ],
            'subtitle' => [
                'fr' => 'Des options de logement sûres et abordables pendant votre stage à l\'étranger.',
                'en' => 'Safe and affordable housing options during your internship abroad.'
            ],
            'description' => [
                'fr' => '<p>Trouvez le logement parfait pour votre stage international. Nous proposons des options variées : résidences étudiantes, appartements partagés, familles d\'accueil.</p>',
                'en' => '<p>Find the perfect accommodation for your international internship. We offer various options: student residences, shared apartments, host families.</p>'
            ],
            'icon' => '🏠',
            'background_color' => '#28a745',
            'is_active' => true
        ]);

        // Service Transport Aéroport
        Service::create([
            'type' => 'airport-pickup',
            'title' => [
                'fr' => 'Transport Aéroport',
                'en' => 'Airport Pickup'
            ],
            'subtitle' => [
                'fr' => 'Arrivez en toute sécurité avec notre service de transport depuis l\'aéroport.',
                'en' => 'Arrive safely with our airport pickup service.'
            ],
            'description' => [
                'fr' => '<p>Service de transport sécurisé depuis l\'aéroport jusqu\'à votre logement. Évitez le stress de l\'arrivée dans un nouveau pays.</p>',
                'en' => '<p>Secure transport service from the airport to your accommodation. Avoid the stress of arriving in a new country.</p>'
            ],
            'icon' => '✈️',
            'background_color' => '#ffc107',
            'is_active' => true
        ]);

        // Service Support
        Service::create([
            'type' => 'support',
            'title' => [
                'fr' => 'Support',
                'en' => 'Support'
            ],
            'subtitle' => [
                'fr' => 'Un support 24/7 pendant toute la durée de votre stage international.',
                'en' => '24/7 support throughout your international internship.'
            ],
            'description' => [
                'fr' => '<p>Notre équipe de support est disponible 24h/24 et 7j/7 pour vous aider en cas de problème pendant votre stage.</p>',
                'en' => '<p>Our support team is available 24/7 to help you with any issues during your internship.</p>'
            ],
            'icon' => '🆘',
            'background_color' => '#17a2b8',
            'is_active' => true
        ]);
    }
}