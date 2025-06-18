<?php

namespace Database\Seeders;

use App\Models\HousingService;
use Illuminate\Database\Seeder;

class HousingServiceSeeder extends Seeder
{
    public function run(): void
    {
        $housings = [
            // Résidence étudiante Paris
            [
                'housing_type' => 'student_residence',
                'housing_name' => 'Résidence Internationale Paris',
                'housing_slug' => 'residence-internationale-paris',
                'description' => 'Résidence étudiante moderne avec tous les équipements pour les étudiants internationaux.',
                'detailed_description' => 'Logements spécialement conçus pour les étudiants, avec services partagés et équipements incluant salles d\'étude, espaces communs et sécurité 24h/24.',
                'starting_price_monthly' => 450.00,
                'deposit_amount' => 450.00,
                'agency_fees' => 50.00,
                'additional_costs' => json_encode([
                    ['name' => 'Électricité', 'monthly_amount' => 30],
                    ['name' => 'Internet', 'monthly_amount' => 20],
                ]),
                'city' => 'Paris',
                'country' => 'France',
                'district' => 'Quartier Latin',
                'room_count' => 1,
                'bathroom_count' => 1,
                'surface_area_sqm' => 18.00,
                'furnished' => true,
                'max_occupants' => 1,
                'suitable_for_couples' => false,
                'amenities' => json_encode([
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'Cuisine commune', 'icon' => 'utensils'],
                    ['name' => 'Salle d\'étude', 'icon' => 'book'],
                    ['name' => 'Lave-linge', 'icon' => 'washing-machine'],
                    ['name' => 'Salle de sport', 'icon' => 'dumbbell'],
                    ['name' => 'Sécurité 24h', 'icon' => 'shield'],
                ]),
                'shared_facilities' => json_encode([
                    'Cuisine commune à chaque étage',
                    'Salles d\'étude',
                    'Buanderie',
                    'Salle de détente',
                    'Salle de sport',
                    'Terrasse',
                ]),
                'utilities_included' => false,
                'included_utilities' => json_encode(['Eau', 'Chauffage']),
                'cleaning_service' => true,
                'security_system' => true,
                'min_stay_months' => 3,
                'max_stay_months' => 12,
                'flexible_contracts' => true,
                'currently_available' => true,
                'transport_options' => json_encode([
                    ['type' => 'Métro', 'distance' => '3 min à pied', 'lines' => ['Ligne 4', 'Ligne 10']],
                    ['type' => 'Bus', 'distance' => '1 min à pied', 'lines' => ['Bus 21', 'Bus 27']],
                    ['type' => 'RER', 'distance' => '8 min à pied', 'lines' => ['RER B']],
                ]),
                'distance_to_city_center_km' => 2.5,
                'quality_inspected' => true,
                'quality_rating' => 4.6,
                'average_rating' => 4.7,
                'total_bookings' => 245,
                'has_24_7_support' => true,
                'welcome_service' => true,
                'installation_assistance' => true,
                'maintenance_included' => true,
                'testimonials' => json_encode([
                    [
                        'name' => 'Elena M.',
                        'country' => 'Spain',
                        'rating' => 5,
                        'text' => 'Parfait pour les étudiants ! Environnement international et très bien situé.',
                        'date' => '2024-11-20'
                    ],
                    [
                        'name' => 'Marcus L.',
                        'country' => 'Germany',
                        'rating' => 5,
                        'text' => 'Great facilities and amazing location. Made many international friends.',
                        'date' => '2024-12-05'
                    ]
                ]),
                'contact_email' => 'residence@internshipmakers.com',
                'contact_phone' => '+33 1 45 67 89 12',
                'is_active' => true,
                'is_featured' => true,
                'verified_listing' => true,
                'sort_order' => 1,
                'admin_notes' => 'Résidence très populaire - liste d\'attente possible'
            ],

            // Colocation Berlin
            [
                'housing_type' => 'shared_apartment',
                'housing_name' => 'Colocation Moderne Berlin',
                'housing_slug' => 'colocation-moderne-berlin',
                'description' => 'Partagez un appartement confortable avec des étudiants internationaux et jeunes professionnels.',
                'detailed_description' => 'Partagez un appartement avec d\'autres étudiants internationaux ou jeunes professionnels dans un environnement convivial et multiculturel.',
                'starting_price_monthly' => 380.00,
                'deposit_amount' => 760.00,
                'agency_fees' => 80.00,
                'additional_costs' => json_encode([
                    ['name' => 'Charges', 'monthly_amount' => 55],
                    ['name' => 'Internet', 'monthly_amount' => 15],
                ]),
                'city' => 'Berlin',
                'country' => 'Allemagne',
                'district' => 'Mitte',
                'room_count' => 1,
                'bathroom_count' => 2,
                'surface_area_sqm' => 22.00,
                'furnished' => true,
                'max_occupants' => 4,
                'suitable_for_couples' => false,
                'amenities' => json_encode([
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'Cuisine équipée', 'icon' => 'utensils'],
                    ['name' => 'Balcon', 'icon' => 'tree'],
                    ['name' => 'Lave-vaisselle', 'icon' => 'utensils'],
                    ['name' => 'Lave-linge', 'icon' => 'washing-machine'],
                    ['name' => 'Chauffage', 'icon' => 'thermometer'],
                ]),
                'shared_facilities' => json_encode([
                    'Cuisine équipée',
                    'Salon spacieux',
                    'Balcon',
                    '2 salles de bain',
                    'Cave de stockage',
                ]),
                'utilities_included' => false,
                'included_utilities' => json_encode(['Eau']),
                'cleaning_service' => false,
                'security_system' => true,
                'min_stay_months' => 2,
                'max_stay_months' => 24,
                'flexible_contracts' => true,
                'currently_available' => true,
                'transport_options' => json_encode([
                    ['type' => 'U-Bahn', 'distance' => '4 min à pied', 'lines' => ['U6', 'U8']],
                    ['type' => 'Tram', 'distance' => '2 min à pied', 'lines' => ['M1', 'M12']],
                    ['type' => 'Bus', 'distance' => '1 min à pied', 'lines' => ['100', '200']],
                ]),
                'distance_to_city_center_km' => 1.2,
                'quality_inspected' => true,
                'quality_rating' => 4.3,
                'average_rating' => 4.4,
                'total_bookings' => 156,
                'has_24_7_support' => true,
                'welcome_service' => true,
                'installation_assistance' => true,
                'maintenance_included' => false,
                'testimonials' => json_encode([
                    [
                        'name' => 'Sofia K.',
                        'country' => 'Poland',
                        'rating' => 4,
                        'text' => 'Great location in the heart of Berlin. Nice flatmates from different countries.',
                        'date' => '2024-10-15'
                    ]
                ]),
                'contact_email' => 'berlin@internshipmakers.com',
                'contact_phone' => '+49 30 12345678',
                'is_active' => true,
                'is_featured' => false,
                'verified_listing' => true,
                'sort_order' => 2,
                'admin_notes' => 'Appartement très central'
            ],

            // Famille d'accueil Madrid
            [
                'housing_type' => 'host_family',
                'housing_name' => 'Famille d\'Accueil Chaleureuse Madrid',
                'housing_slug' => 'famille-accueil-madrid',
                'description' => 'Vivez chez une famille locale pour une immersion culturelle et linguistique complète.',
                'detailed_description' => 'Vivez chez une famille soigneusement sélectionnée pour une immersion linguistique et culturelle complète. Parfait pour améliorer vos compétences linguistiques.',
                'starting_price_monthly' => 520.00,
                'deposit_amount' => 260.00,
                'agency_fees' => 0.00,
                'additional_costs' => json_encode([]),
                'city' => 'Madrid',
                'country' => 'Espagne',
                'district' => 'Salamanca',
                'room_count' => 1,
                'bathroom_count' => 1,
                'surface_area_sqm' => 14.00,
                'furnished' => true,
                'max_occupants' => 1,
                'suitable_for_couples' => false,
                'amenities' => json_encode([
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'Cuisine partagée', 'icon' => 'utensils'],
                    ['name' => 'Chauffage', 'icon' => 'thermometer'],
                    ['name' => 'Bureau', 'icon' => 'desk'],
                ]),
                'shared_facilities' => json_encode([
                    'Cuisine familiale',
                    'Salon',
                    'Salle à manger',
                    'Terrasse',
                ]),
                'utilities_included' => true,
                'included_utilities' => json_encode(['Électricité', 'Eau', 'Chauffage', 'Internet']),
                'cleaning_service' => true,
                'security_system' => false,
                'min_stay_months' => 1,
                'max_stay_months' => 12,
                'flexible_contracts' => true,
                'currently_available' => true,
                'host_family_info' => json_encode([
                    'family_composition' => 'Couple avec 2 enfants adolescents',
                    'languages_spoken' => ['Espagnol', 'Anglais', 'Français'],
                    'interests' => ['Voyage', 'Cuisine', 'Sports', 'Lecture'],
                    'pets' => 'Petit chien amical',
                    'house_rules' => ['Pas de fumée', 'Retour avant 23h les jours de semaine'],
                    'cultural_activities' => true,
                ]),
                'meals_included' => true,
                'meal_plan' => 'breakfast_dinner',
                'transport_options' => json_encode([
                    ['type' => 'Métro', 'distance' => '6 min à pied', 'lines' => ['Ligne 4', 'Ligne 6']],
                    ['type' => 'Bus', 'distance' => '3 min à pied', 'lines' => ['1', '9', '19']],
                ]),
                'distance_to_city_center_km' => 4.2,
                'quality_inspected' => true,
                'quality_rating' => 4.9,
                'average_rating' => 4.8,
                'total_bookings' => 89,
                'has_24_7_support' => true,
                'welcome_service' => true,
                'installation_assistance' => true,
                'maintenance_included' => true,
                'testimonials' => json_encode([
                    [
                        'name' => 'Claire F.',
                        'country' => 'France',
                        'rating' => 5,
                        'text' => 'Famille incroyable ! J\'ai énormément progressé en espagnol et découvert la culture espagnole.',
                        'date' => '2024-11-30'
                    ],
                    [
                        'name' => 'John D.',
                        'country' => 'USA',
                        'rating' => 5,
                        'text' => 'Amazing family! They treated me like their own child. Perfect for language learning.',
                        'date' => '2024-09-18'
                    ]
                ]),
                'contact_email' => 'madrid@internshipmakers.com',
                'contact_phone' => '+34 91 123 4567',
                'is_active' => true,
                'is_featured' => true,
                'verified_listing' => true,
                'sort_order' => 1,
                'admin_notes' => 'Famille exceptionnelle - très demandée'
            ],

            // Studio privé Londres
            [
                'housing_type' => 'private_studio',
                'housing_name' => 'Studio Moderne Londres',
                'housing_slug' => 'studio-moderne-londres',
                'description' => 'Studio indépendant pour ceux qui préfèrent l\'intimité et l\'autonomie.',
                'detailed_description' => 'Pour ceux qui préfèrent l\'indépendance, nous proposons des studios et appartements modernes avec tous les équipements nécessaires.',
                'starting_price_monthly' => 680.00,
                'deposit_amount' => 1360.00,
                'agency_fees' => 120.00,
                'additional_costs' => json_encode([
                    ['name' => 'Électricité', 'monthly_amount' => 45],
                    ['name' => 'Internet', 'monthly_amount' => 30],
                    ['name' => 'Council Tax', 'monthly_amount' => 85],
                ]),
                'city' => 'Londres',
                'country' => 'Royaume-Uni',
                'district' => 'Zone 2 - Canary Wharf',
                'room_count' => 1,
                'bathroom_count' => 1,
                'surface_area_sqm' => 28.00,
                'furnished' => true,
                'max_occupants' => 2,
                'suitable_for_couples' => true,
                'amenities' => json_encode([
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'Cuisine privée', 'icon' => 'utensils'],
                    ['name' => 'SDB privée', 'icon' => 'bath'],
                    ['name' => 'Bureau', 'icon' => 'desk'],
                    ['name' => 'Lave-linge', 'icon' => 'washing-machine'],
                    ['name' => 'Chauffage', 'icon' => 'thermometer'],
                    ['name' => 'Sécurité', 'icon' => 'shield'],
                ]),
                'shared_facilities' => json_encode([]),
                'utilities_included' => false,
                'included_utilities' => json_encode(['Eau', 'Chauffage']),
                'cleaning_service' => false,
                'security_system' => true,
                'min_stay_months' => 1,
                'max_stay_months' => 24,
                'flexible_contracts' => true,
                'currently_available' => true,
                'transport_options' => json_encode([
                    ['type' => 'DLR', 'distance' => '5 min à pied', 'lines' => ['DLR']],
                    ['type' => 'Underground', 'distance' => '8 min à pied', 'lines' => ['Jubilee Line']],
                    ['type' => 'Bus', 'distance' => '2 min à pied', 'lines' => ['135', '277']],
                ]),
                'distance_to_city_center_km' => 7.5,
                'quality_inspected' => true,
                'quality_rating' => 4.7,
                'average_rating' => 4.5,
                'total_bookings' => 78,
                'has_24_7_support' => true,
                'welcome_service' => true,
                'installation_assistance' => true,
                'maintenance_included' => false,
                'testimonials' => json_encode([
                    [
                        'name' => 'Alessandro R.',
                        'country' => 'Italy',
                        'rating' => 5,
                        'text' => 'Perfect for young professionals. Modern, clean and well-connected to the city.',
                        'date' => '2024-12-10'
                    ]
                ]),
                'contact_email' => 'london@internshipmakers.com',
                'contact_phone' => '+44 20 7123 4567',
                'is_active' => true,
                'is_featured' => false,
                'verified_listing' => true,
                'sort_order' => 3,
                'admin_notes' => 'Studio premium - clientèle jeunes professionnels'
            ],

            // Colocation Lyon
            [
                'housing_type' => 'shared_apartment',
                'housing_name' => 'Colocation Étudiante Lyon',
                'housing_slug' => 'colocation-etudiante-lyon',
                'description' => 'Colocation conviviale dans le centre de Lyon, parfaite pour les étudiants.',
                'detailed_description' => 'Appartement spacieux à partager avec d\'autres étudiants dans le quartier animé de la Presqu\'île.',
                'starting_price_monthly' => 320.00,
                'deposit_amount' => 640.00,
                'agency_fees' => 60.00,
                'additional_costs' => json_encode([
                    ['name' => 'Charges', 'monthly_amount' => 45],
                    ['name' => 'Internet', 'monthly_amount' => 12],
                ]),
                'city' => 'Lyon',
                'country' => 'France',
                'district' => 'Presqu\'île',
                'room_count' => 1,
                'bathroom_count' => 1,
                'surface_area_sqm' => 16.00,
                'furnished' => true,
                'max_occupants' => 3,
                'suitable_for_couples' => false,
                'amenities' => json_encode([
                    ['name' => 'WiFi', 'icon' => 'wifi'],
                    ['name' => 'Cuisine équipée', 'icon' => 'utensils'],
                    ['name' => 'Lave-linge', 'icon' => 'washing-machine'],
                    ['name' => 'Chauffage', 'icon' => 'thermometer'],
                ]),
                'shared_facilities' => json_encode([
                    'Cuisine équipée',
                    'Salon',
                    'Salle de bain',
                    'WC séparé',
                ]),
                'utilities_included' => false,
                'included_utilities' => json_encode(['Eau']),
                'cleaning_service' => false,
                'security_system' => false,
                'min_stay_months' => 3,
                'max_stay_months' => 12,
                'flexible_contracts' => true,
                'currently_available' => true,
                'transport_options' => json_encode([
                    ['type' => 'Métro', 'distance' => '3 min à pied', 'lines' => ['Ligne A', 'Ligne D']],
                    ['type' => 'Tramway', 'distance' => '5 min à pied', 'lines' => ['T1', 'T4']],
                ]),
                'distance_to_city_center_km' => 0.8,
                'quality_inspected' => true,
                'quality_rating' => 4.1,
                'average_rating' => 4.2,
                'total_bookings' => 67,
                'has_24_7_support' => false,
                'welcome_service' => true,
                'installation_assistance' => false,
                'maintenance_included' => false,
                'contact_email' => 'lyon@internshipmakers.com',
                'contact_phone' => '+33 4 78 12 34 56',
                'is_active' => true,
                'is_featured' => false,
                'verified_listing' => true,
                'sort_order' => 4,
                'admin_notes' => 'Bon rapport qualité-prix'
            ]
        ];

        foreach ($housings as $housingData) {
            HousingService::create($housingData);
        }

        // Message de confirmation
        $this->command->info('✅ ' . count($housings) . ' logements créés avec succès !');
        $this->command->info('🏠 Types : Résidences étudiantes, Colocations, Familles d\'accueil, Studios');
        $this->command->info('🌍 Villes : Paris, Berlin, Madrid, Londres, Lyon');
        $this->command->info('💰 Prix : de 320€ à 680€/mois');
        $this->command->info('⭐ Note moyenne : ' . number_format(collect($housings)->avg('quality_rating'), 1) . '/5');
    }
}