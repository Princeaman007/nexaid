<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SupportService;

class SupportServiceSeeder extends Seeder
{
    public function run(): void
    {
        $supportServices = [
            [
                'service_name' => 'Support Complet Paris',
                'service_slug' => 'support-complet-paris',
                'description' => 'Service de support 24/7 pour étudiants internationaux à Paris',
                'detailed_description' => 'Notre service de support complet accompagne les étudiants internationaux dans toutes leurs démarches administratives, professionnelles et personnelles pendant leur séjour à Paris.',

                // Catégories principales
                'administrative_assistance' => true,
                'professional_support' => true,
                'personal_support' => true,
                'social_activities' => true,

                // Services administratifs
                'visa_assistance' => true,
                'residence_permit_help' => true,
                'bank_account_assistance' => true,
                'local_registration_help' => true,
                'health_insurance_guidance' => true,
                'document_translation' => true,

                // Services professionnels
                'company_mediation' => true,
                'corporate_culture_advice' => true,
                'internship_difficulty_support' => true,
                'professional_guidance' => true,
                'cv_linkedin_optimization' => true,
                'interview_preparation' => true,

                // Services personnels
                'cultural_integration_help' => true,
                'local_life_recommendations' => true,
                'medical_assistance' => true,
                'personal_difficulties_support' => true,
                'mental_health_support' => true,
                'emergency_assistance' => true,

                // Activités sociales
                'networking_events' => true,
                'intern_meetups' => true,
                'cultural_outings' => true,
                'team_building_activities' => true,
                'monthly_events_count' => 8,
                'events_average_cost' => 25.00,

                // Contact et disponibilité
                'has_24_7_helpline' => true,
                'emergency_phone' => '+33 1 23 45 67 89',
                'support_email' => 'support@internshipmakers.com',
                'email_support_available' => true,
                'email_response_hours' => 2,
                'personal_appointments' => true,
                'video_appointments' => true,
                'mobile_app_available' => true,
                'live_chat_support' => true,
                'whatsapp_support' => '+33 6 12 34 56 78',
                'urgent_response_hours' => 1,

                // Équipe et qualité
                'personalized_advisor' => true,
                'confidential_handling' => true,
                'concrete_solutions_commitment' => true,
                'service_guarantees' => json_encode(['Réponse sous 2h', 'Conseiller dédié', 'Support 24/7']),

                // Couverture géographique - CORRIGÉ avec json_encode
                'covered_cities' => json_encode(['Paris', 'Boulogne-Billancourt', 'Neuilly-sur-Seine', 'Vincennes', 'Saint-Denis']),
                'supported_languages' => json_encode(['français', 'anglais', 'espagnol', 'italien', 'allemand']),

                // Horaires
                'operates_weekends' => true,
                'operates_holidays' => true,
                'regular_hours_start' => '08:00:00',
                'regular_hours_end' => '20:00:00',

                // Équipe
                'advisors_count' => 12,
                'team_average_experience_years' => 5.2,
                'team_specializations' => json_encode(['Visa/Immigration', 'Logement', 'Santé', 'Professionnel', 'Urgences']),
                'multilingual_team' => true,

                // Ressources
                'online_resource_library' => true,
                'city_guides_available' => true,
                'document_templates' => true,
                'emergency_contacts_database' => true,
                'mobile_app_store_url' => 'https://apps.apple.com/internshipmakers',
                'resource_portal_url' => 'https://support.internshipmakers.com',

                // Statistiques
                'service_satisfaction_rating' => 4.8,
                'total_cases_handled' => 2847,
                'resolution_success_rate' => 96.5,
                'average_resolution_hours' => 4.2,

                // Témoignages - CORRIGÉ avec json_encode
                'testimonials' => json_encode([
                    [
                        'name' => 'Maria S.',
                        'country' => 'Spain',
                        'text' => 'Le support était incroyable ! Ils m\'ont aidée avec tous mes papiers administratifs.',
                        'rating' => 5,
                        'date' => '2024-11-15'
                    ],
                    [
                        'name' => 'James T.',
                        'country' => 'USA',
                        'text' => 'Available 24/7 and always helpful. Made my internship experience smooth.',
                        'rating' => 5,
                        'date' => '2024-12-02'
                    ]
                ]),

                // Tarification
                'monthly_subscription_price' => 149.00,
                'included_in_internship_package' => true,
                'pay_per_use_available' => true,
                'consultation_hourly_rate' => 45.00,
                'premium_features' => json_encode(['Conseiller VIP', 'Réponse prioritaire', 'Services weekend']),

                // Intégrations
                'housing_integration' => true,
                'internship_integration' => true,
                'airport_pickup_coordination' => true,
                'company_liaison' => true,

                // Services d'urgence
                'crisis_intervention_available' => true,
                'emergency_protocols' => json_encode(['Urgence médicale', 'Problème logement', 'Conflit professionnel']),
                'local_emergency_contacts' => json_encode(['SAMU: 15', 'Police: 17', 'Pompiers: 18']),
                'family_notification_service' => true,
                'legal_assistance_referral' => true,

                // Suivi
                'monthly_progress_reports' => true,
                'case_tracking_system' => true,
                'satisfaction_surveys' => true,
                'survey_frequency_days' => 30,

                // Statut
                'is_active' => true,
                'is_featured' => true,
                'accepting_new_clients' => true,
                'current_capacity_percentage' => 75.0,
                'sort_order' => 1,
                'admin_notes' => 'Service principal Paris - Équipe complète'
            ],

            [
                'service_name' => 'Support Essentiel Lyon',
                'service_slug' => 'support-essentiel-lyon',
                'description' => 'Support de base pour étudiants internationaux à Lyon',
                'detailed_description' => 'Service de support adapté aux besoins essentiels des étudiants en stage à Lyon.',

                // Catégories principales (plus limitées)
                'administrative_assistance' => true,
                'professional_support' => true,
                'personal_support' => false,
                'social_activities' => true,

                // Services administratifs
                'visa_assistance' => true,
                'residence_permit_help' => true,
                'bank_account_assistance' => true,
                'local_registration_help' => true,
                'health_insurance_guidance' => false,
                'document_translation' => false,

                // Services professionnels
                'company_mediation' => true,
                'corporate_culture_advice' => true,
                'internship_difficulty_support' => true,
                'professional_guidance' => false,
                'cv_linkedin_optimization' => false,
                'interview_preparation' => false,

                // Services personnels (limités)
                'cultural_integration_help' => false,
                'local_life_recommendations' => true,
                'medical_assistance' => false,
                'personal_difficulties_support' => false,
                'mental_health_support' => false,
                'emergency_assistance' => true,

                // Activités sociales
                'networking_events' => true,
                'intern_meetups' => true,
                'cultural_outings' => false,
                'team_building_activities' => false,
                'monthly_events_count' => 4,
                'events_average_cost' => 15.00,

                // Contact et disponibilité
                'has_24_7_helpline' => false,
                'emergency_phone' => '+33 4 72 22 33 44',
                'support_email' => 'lyon@internshipmakers.com',
                'email_support_available' => true,
                'email_response_hours' => 6,
                'personal_appointments' => true,
                'video_appointments' => false,
                'mobile_app_available' => false,
                'live_chat_support' => false,
                'whatsapp_support' => null,
                'urgent_response_hours' => 4,

                // Équipe et qualité
                'personalized_advisor' => false,
                'confidential_handling' => true,
                'concrete_solutions_commitment' => true,
                'service_guarantees' => json_encode(['Réponse sous 6h', 'Support administratif']),

                // Couverture géographique
                'covered_cities' => json_encode(['Lyon', 'Villeurbanne']),
                'supported_languages' => json_encode(['français', 'anglais']),

                // Horaires
                'operates_weekends' => false,
                'operates_holidays' => false,
                'regular_hours_start' => '09:00:00',
                'regular_hours_end' => '18:00:00',

                // Équipe
                'advisors_count' => 3,
                'team_average_experience_years' => 3.5,
                'team_specializations' => json_encode(['Administratif', 'Professionnel']),
                'multilingual_team' => false,

                // Ressources
                'online_resource_library' => true,
                'city_guides_available' => true,
                'document_templates' => false,
                'emergency_contacts_database' => false,
                'mobile_app_store_url' => null,
                'resource_portal_url' => 'https://lyon.internshipmakers.com',

                // Statistiques
                'service_satisfaction_rating' => 4.2,
                'total_cases_handled' => 456,
                'resolution_success_rate' => 89.5,
                'average_resolution_hours' => 8.5,

                // Témoignages
                'testimonials' => json_encode([
                    [
                        'name' => 'Pierre M.',
                        'country' => 'Belgium',
                        'text' => 'Service efficace pour les démarches administratives.',
                        'rating' => 4,
                        'date' => '2024-10-20'
                    ]
                ]),

                // Tarification
                'monthly_subscription_price' => 89.00,
                'included_in_internship_package' => false,
                'pay_per_use_available' => true,
                'consultation_hourly_rate' => 35.00,
                'premium_features' => json_encode([]),

                // Intégrations
                'housing_integration' => false,
                'internship_integration' => true,
                'airport_pickup_coordination' => false,
                'company_liaison' => false,

                // Services d'urgence
                'crisis_intervention_available' => false,
                'emergency_protocols' => json_encode(['Urgence stage']),
                'local_emergency_contacts' => json_encode(['SAMU: 15']),
                'family_notification_service' => false,
                'legal_assistance_referral' => false,

                // Suivi
                'monthly_progress_reports' => false,
                'case_tracking_system' => false,
                'satisfaction_surveys' => true,
                'survey_frequency_days' => 60,

                // Statut
                'is_active' => true,
                'is_featured' => false,
                'accepting_new_clients' => true,
                'current_capacity_percentage' => 45.0,
                'sort_order' => 2,
                'admin_notes' => 'Service basique Lyon'
            ],

            [
                'service_name' => 'Support Premium Nice',
                'service_slug' => 'support-premium-nice',
                'description' => 'Service de support haut de gamme pour la Côte d\'Azur',
                'detailed_description' => 'Support premium avec services exclusifs pour les étudiants internationaux sur la Côte d\'Azur.',

                // Catégories principales
                'administrative_assistance' => true,
                'professional_support' => true,
                'personal_support' => true,
                'social_activities' => true,

                // Services administratifs
                'visa_assistance' => true,
                'residence_permit_help' => true,
                'bank_account_assistance' => true,
                'local_registration_help' => true,
                'health_insurance_guidance' => true,
                'document_translation' => true,

                // Services professionnels
                'company_mediation' => true,
                'corporate_culture_advice' => true,
                'internship_difficulty_support' => true,
                'professional_guidance' => true,
                'cv_linkedin_optimization' => true,
                'interview_preparation' => true,

                // Services personnels
                'cultural_integration_help' => true,
                'local_life_recommendations' => true,
                'medical_assistance' => true,
                'personal_difficulties_support' => true,
                'mental_health_support' => false,
                'emergency_assistance' => true,

                // Activités sociales premium
                'networking_events' => true,
                'intern_meetups' => true,
                'cultural_outings' => true,
                'team_building_activities' => true,
                'monthly_events_count' => 12,
                'events_average_cost' => 45.00,

                // Contact et disponibilité
                'has_24_7_helpline' => true,
                'emergency_phone' => '+33 4 93 88 99 00',
                'support_email' => 'nice@internshipmakers.com',
                'email_support_available' => true,
                'email_response_hours' => 1,
                'personal_appointments' => true,
                'video_appointments' => true,
                'mobile_app_available' => true,
                'live_chat_support' => true,
                'whatsapp_support' => '+33 6 98 76 54 32',
                'urgent_response_hours' => 1,

                // Équipe et qualité
                'personalized_advisor' => true,
                'confidential_handling' => true,
                'concrete_solutions_commitment' => true,
                'service_guarantees' => json_encode(['Réponse sous 1h', 'Conseiller VIP', 'Support premium']),

                // Couverture géographique
                'covered_cities' => json_encode(['Nice', 'Cannes', 'Antibes', 'Monaco']),
                'supported_languages' => json_encode(['français', 'anglais', 'italien', 'russe']),

                // Horaires
                'operates_weekends' => true,
                'operates_holidays' => true,
                'regular_hours_start' => '07:00:00',
                'regular_hours_end' => '22:00:00',

                // Équipe
                'advisors_count' => 8,
                'team_average_experience_years' => 7.8,
                'team_specializations' => json_encode(['VIP Services', 'Luxury Lifestyle', 'International Relations']),
                'multilingual_team' => true,

                // Ressources
                'online_resource_library' => true,
                'city_guides_available' => true,
                'document_templates' => true,
                'emergency_contacts_database' => true,
                'mobile_app_store_url' => 'https://apps.apple.com/internshipmakers-premium',
                'resource_portal_url' => 'https://premium.internshipmakers.com',

                // Statistiques
                'service_satisfaction_rating' => 4.9,
                'total_cases_handled' => 1234,
                'resolution_success_rate' => 98.2,
                'average_resolution_hours' => 2.1,

                // Témoignages
                'testimonials' => json_encode([
                    [
                        'name' => 'Anastasia K.',
                        'country' => 'Russia',
                        'text' => 'Exceptional service! They made my stay in Nice absolutely perfect.',
                        'rating' => 5,
                        'date' => '2024-12-01'
                    ],
                    [
                        'name' => 'Giovanni R.',
                        'country' => 'Italy',
                        'text' => 'Servizio fantastico, molto professionale e sempre disponibile.',
                        'rating' => 5,
                        'date' => '2024-11-28'
                    ]
                ]),

                // Tarification
                'monthly_subscription_price' => 299.00,
                'included_in_internship_package' => false,
                'pay_per_use_available' => false,
                'consultation_hourly_rate' => 75.00,
                'premium_features' => json_encode(['Concierge service', 'VIP events', 'Luxury recommendations']),

                // Intégrations
                'housing_integration' => true,
                'internship_integration' => true,
                'airport_pickup_coordination' => true,
                'company_liaison' => true,

                // Services d'urgence
                'crisis_intervention_available' => true,
                'emergency_protocols' => json_encode(['Urgence médicale', 'Urgence voyage', 'Assistance familiale']),
                'local_emergency_contacts' => json_encode(['SAMU: 15', 'Police: 17', 'Pompiers: 18']),
                'family_notification_service' => true,
                'legal_assistance_referral' => true,

                // Suivi
                'monthly_progress_reports' => true,
                'case_tracking_system' => true,
                'satisfaction_surveys' => true,
                'survey_frequency_days' => 15,

                // Statut
                'is_active' => true,
                'is_featured' => true,
                'accepting_new_clients' => true,
                'current_capacity_percentage' => 90.0,
                'sort_order' => 1,
                'admin_notes' => 'Service premium Côte d\'Azur - Clientèle VIP'
            ]
        ];

        foreach ($supportServices as $serviceData) {
            SupportService::create($serviceData);
        }

        // Message de confirmation
        $this->command->info('✅ ' . count($supportServices) . ' services de support créés avec succès !');
        $this->command->info('🏙️ Villes couvertes : Paris, Lyon, Nice, Cannes, Antibes, Monaco');
        $this->command->info('🗣️ Langues supportées : Français, Anglais, Espagnol, Italien, Allemand, Russe');
        $this->command->info('⭐ Note moyenne : ' . number_format(collect($supportServices)->pluck('service_satisfaction_rating')->avg(), 1) . '/5');
    }
}