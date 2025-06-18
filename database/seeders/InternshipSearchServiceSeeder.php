<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternshipSearchService;

class InternshipSearchServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'package_name' => 'Package Basic',
                'package_slug' => 'basic',
                'price' => 99.00,
                'description' => 'Package de base pour commencer votre recherche de stage avec les outils essentiels.',
                'profile_analysis' => true,
                'application_count' => 10,
                'cv_optimization' => false,
                'cover_letter_optimization' => false,
                'unlimited_followup' => false,
                'direct_company_connection' => false,
                'personalized_advisor' => false,
                'has_guarantee' => false,
                'supported_sectors' => [
                    ['name' => 'Technologie', 'description' => 'IT, développement, data science'],
                    ['name' => 'Marketing', 'description' => 'Marketing digital, communication'],
                ],
                'supported_languages' => [
                    ['code' => 'fr', 'name' => 'Français', 'level' => 'native'],
                    ['code' => 'en', 'name' => 'Anglais', 'level' => 'intermediate'],
                ],
                'covered_countries' => [
                    ['code' => 'FR', 'name' => 'France', 'premium_only' => false],
                    ['code' => 'BE', 'name' => 'Belgique', 'premium_only' => false],
                ],
                'partner_companies_count' => 50,
                'success_rate_percentage' => 65.5,
                'average_placement_days' => 45,
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 1,
            ],
            [
                'package_name' => 'Package Premium',
                'package_slug' => 'premium',
                'price' => 299.00,
                'description' => 'Package complet avec conseiller personnalisé et optimisation CV/lettre de motivation.',
                'profile_analysis' => true,
                'application_count' => 50,
                'cv_optimization' => true,
                'cover_letter_optimization' => true,
                'unlimited_followup' => true,
                'direct_company_connection' => true,
                'personalized_advisor' => true,
                'has_guarantee' => false,
                'supported_sectors' => [
                    ['name' => 'Technologie', 'description' => 'IT, développement, data science'],
                    ['name' => 'Marketing', 'description' => 'Marketing digital, communication'],
                    ['name' => 'Finance', 'description' => 'Banque, assurance, fintech'],
                    ['name' => 'Consulting', 'description' => 'Conseil en stratégie et management'],
                ],
                'supported_languages' => [
                    ['code' => 'fr', 'name' => 'Français', 'level' => 'native'],
                    ['code' => 'en', 'name' => 'Anglais', 'level' => 'advanced'],
                    ['code' => 'de', 'name' => 'Allemand', 'level' => 'intermediate'],
                ],
                'covered_countries' => [
                    ['code' => 'FR', 'name' => 'France', 'premium_only' => false],
                    ['code' => 'BE', 'name' => 'Belgique', 'premium_only' => false],
                    ['code' => 'CH', 'name' => 'Suisse', 'premium_only' => false],
                    ['code' => 'DE', 'name' => 'Allemagne', 'premium_only' => false],
                    ['code' => 'GB', 'name' => 'Royaume-Uni', 'premium_only' => true],
                ],
                'partner_companies_count' => 200,
                'success_rate_percentage' => 85.2,
                'average_placement_days' => 30,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'package_name' => 'Package Success',
                'package_slug' => 'success',
                'price' => 599.00,
                'description' => 'Package premium avec garantie de réussite - trouvez votre stage ou remboursé !',
                'profile_analysis' => true,
                'application_count' => -1, // Illimité
                'cv_optimization' => true,
                'cover_letter_optimization' => true,
                'unlimited_followup' => true,
                'direct_company_connection' => true,
                'personalized_advisor' => true,
                'has_guarantee' => true,
                'guarantee_duration_months' => 6,
                'guarantee_refund_percentage' => 100,
                'guarantee_conditions' => 'Si aucun stage n\'est trouvé après 6 mois d\'accompagnement actif, remboursement intégral du package. Conditions : participation active aux sessions de coaching, envoi d\'au moins 20 candidatures par mois selon nos recommandations.',
                'supported_sectors' => [
                    ['name' => 'Technologie', 'description' => 'IT, développement, data science, IA'],
                    ['name' => 'Marketing', 'description' => 'Marketing digital, communication, growth'],
                    ['name' => 'Finance', 'description' => 'Banque, assurance, fintech, trading'],
                    ['name' => 'Consulting', 'description' => 'Conseil en stratégie et management'],
                    ['name' => 'Startup', 'description' => 'Écosystème startup et scale-up'],
                    ['name' => 'Luxe', 'description' => 'Mode, bijouterie, hôtellerie de luxe'],
                ],
                'supported_languages' => [
                    ['code' => 'fr', 'name' => 'Français', 'level' => 'native'],
                    ['code' => 'en', 'name' => 'Anglais', 'level' => 'advanced'],
                    ['code' => 'de', 'name' => 'Allemand', 'level' => 'advanced'],
                    ['code' => 'es', 'name' => 'Espagnol', 'level' => 'intermediate'],
                    ['code' => 'it', 'name' => 'Italien', 'level' => 'intermediate'],
                ],
                'covered_countries' => [
                    ['code' => 'FR', 'name' => 'France', 'premium_only' => false],
                    ['code' => 'BE', 'name' => 'Belgique', 'premium_only' => false],
                    ['code' => 'CH', 'name' => 'Suisse', 'premium_only' => false],
                    ['code' => 'DE', 'name' => 'Allemagne', 'premium_only' => false],
                    ['code' => 'GB', 'name' => 'Royaume-Uni', 'premium_only' => false],
                    ['code' => 'US', 'name' => 'États-Unis', 'premium_only' => true],
                    ['code' => 'CA', 'name' => 'Canada', 'premium_only' => true],
                    ['code' => 'SG', 'name' => 'Singapour', 'premium_only' => true],
                ],
                'partner_companies_count' => 500,
                'success_rate_percentage' => 95.8,
                'average_placement_days' => 21,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($packages as $packageData) {
            InternshipSearchService::create($packageData);
        }
    }
}