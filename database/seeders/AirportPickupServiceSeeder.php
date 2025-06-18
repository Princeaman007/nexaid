<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AirportPickupService;

class AirportPickupServiceSeeder extends Seeder
{
    public function run(): void
    {
        $airportServices = [
            // Paris - Charles de Gaulle
            [
                'name' => 'Transport CDG Premium',
                'airport_code' => 'CDG',
                'airport_name' => 'Charles de Gaulle',
                'city' => 'Paris',
                'country' => 'France',
                'base_price_0_20km' => 55.00,
                'base_price_21_40km' => 75.00,
                'base_price_41_60km' => 95.00,
                'price_per_km_beyond_60km' => 2.50,
                'night_surcharge_percentage' => 20.00,
                'weekend_surcharge_percentage' => 15.00,
                'luggage_fee_per_bag' => 5.00,
                'waiting_fee_per_hour' => 25.00,
                'vehicle_types' => json_encode(['sedan', 'suv', 'luxury', 'minibus']),
                'service_start_time' => '05:00:00',
                'service_end_time' => '23:30:00',
                'operates_24_7' => true,
                'advance_booking_hours' => 12,
                'max_passengers' => 8,
                'is_active' => true,
                'currently_accepting_bookings' => true,
                'service_rating' => 4.8,
                'total_transfers_completed' => 2847,
                'contact_phone' => '+33 1 48 62 22 80',
                'contact_email' => 'cdg@internshipmakers.com',
                'special_instructions' => 'Point de rendez-vous : Sortie 2A, Terminal 1. Panneau InternshipMakers visible.',
                'accepted_payment_methods' => json_encode(['cash', 'card', 'paypal', 'apple_pay']),
                'covered_postcodes' => json_encode(['75001', '75002', '75003', '75004', '75005', '75006', '75007', '75008', '75009', '75010', '75011', '75012', '75013', '75014', '75015', '75016', '75017', '75018', '75019', '75020', '92100', '92200', '92300', '93100', '93200', '94100']),
                'max_distance_km' => 120.00
            ],

            // Paris - Orly
            [
                'name' => 'Transport Orly Express',
                'airport_code' => 'ORY',
                'airport_name' => 'Orly',
                'city' => 'Paris',
                'country' => 'France',
                'base_price_0_20km' => 45.00,
                'base_price_21_40km' => 65.00,
                'base_price_41_60km' => 85.00,
                'price_per_km_beyond_60km' => 2.20,
                'night_surcharge_percentage' => 20.00,
                'weekend_surcharge_percentage' => 15.00,
                'luggage_fee_per_bag' => 5.00,
                'waiting_fee_per_hour' => 25.00,
                'vehicle_types' => json_encode(['sedan', 'suv', 'van']),
                'service_start_time' => '05:30:00',
                'service_end_time' => '23:00:00',
                'operates_24_7' => false,
                'advance_booking_hours' => 24,
                'max_passengers' => 6,
                'is_active' => true,
                'currently_accepting_bookings' => true,
                'service_rating' => 4.6,
                'total_transfers_completed' => 1924,
                'contact_phone' => '+33 1 49 75 56 10',
                'contact_email' => 'orly@internshipmakers.com',
                'special_instructions' => 'Rendez-vous Hall 3, Sortie E. Chauffeur avec panneau nom.',
                'accepted_payment_methods' => json_encode(['cash', 'card', 'paypal']),
                'covered_postcodes' => json_encode(['75001', '75002', '75003', '75004', '75005', '75006', '75007', '75008', '75009', '75010', '75011', '75012', '75013', '75014', '75015', '75016', '75017', '75018', '75019', '75020', '94100', '94200', '94300']),
                'max_distance_km' => 100.00
            ],

            // Lyon - Saint-Exupéry
            [
                'name' => 'Lyon Airport Shuttle',
                'airport_code' => 'LYS',
                'airport_name' => 'Lyon-Saint Exupéry',
                'city' => 'Lyon',
                'country' => 'France',
                'base_price_0_20km' => 40.00,
                'base_price_21_40km' => 55.00,
                'base_price_41_60km' => 75.00,
                'price_per_km_beyond_60km' => 2.00,
                'night_surcharge_percentage' => 25.00,
                'weekend_surcharge_percentage' => 10.00,
                'luggage_fee_per_bag' => 3.00,
                'waiting_fee_per_hour' => 20.00,
                'vehicle_types' => json_encode(['sedan', 'suv']),
                'service_start_time' => '06:00:00',
                'service_end_time' => '22:00:00',
                'operates_24_7' => false,
                'advance_booking_hours' => 24,
                'max_passengers' => 4,
                'is_active' => true,
                'currently_accepting_bookings' => true,
                'service_rating' => 4.5,
                'total_transfers_completed' => 856,
                'contact_phone' => '+33 4 72 22 72 21',
                'contact_email' => 'lyon@internshipmakers.com',
                'special_instructions' => 'Zone d\'attente niveau arrivées, près des taxis.',
                'accepted_payment_methods' => json_encode(['cash', 'card']),
                'covered_postcodes' => json_encode(['69001', '69002', '69003', '69004', '69005', '69006', '69007', '69008', '69009']),
                'max_distance_km' => 80.00
            ],

            // Nice - Côte d'Azur
            [
                'name' => 'Nice Airport VIP',
                'airport_code' => 'NCE',
                'airport_name' => 'Nice Côte d\'Azur',
                'city' => 'Nice',
                'country' => 'France',
                'base_price_0_20km' => 35.00,
                'base_price_21_40km' => 50.00,
                'base_price_41_60km' => 70.00,
                'price_per_km_beyond_60km' => 2.30,
                'night_surcharge_percentage' => 30.00,
                'weekend_surcharge_percentage' => 20.00,
                'luggage_fee_per_bag' => 4.00,
                'waiting_fee_per_hour' => 22.00,
                'vehicle_types' => json_encode(['sedan', 'luxury', 'suv']),
                'service_start_time' => '05:45:00',
                'service_end_time' => '23:15:00',
                'operates_24_7' => false,
                'advance_booking_hours' => 12,
                'max_passengers' => 6,
                'is_active' => true,
                'currently_accepting_bookings' => true,
                'service_rating' => 4.9,
                'total_transfers_completed' => 1456,
                'contact_phone' => '+33 4 93 21 30 12',
                'contact_email' => 'nice@internshipmakers.com',
                'special_instructions' => 'Terminal 1 - Sortie bagages, près de l\'information.',
                'accepted_payment_methods' => json_encode(['cash', 'card', 'paypal', 'apple_pay', 'google_pay']),
                'covered_postcodes' => json_encode(['06000', '06100', '06200', '06300', '06400']),
                'max_distance_km' => 90.00
            ],

            // Marseille - Provence
            [
                'name' => 'Marseille Airport Connect',
                'airport_code' => 'MRS',
                'airport_name' => 'Marseille Provence',
                'city' => 'Marseille',
                'country' => 'France',
                'base_price_0_20km' => 38.00,
                'base_price_21_40km' => 52.00,
                'base_price_41_60km' => 72.00,
                'price_per_km_beyond_60km' => 2.10,
                'night_surcharge_percentage' => 20.00,
                'weekend_surcharge_percentage' => 15.00,
                'luggage_fee_per_bag' => 3.50,
                'waiting_fee_per_hour' => 18.00,
                'vehicle_types' => json_encode(['sedan', 'van']),
                'service_start_time' => '06:30:00',
                'service_end_time' => '22:30:00',
                'operates_24_7' => false,
                'advance_booking_hours' => 24,
                'max_passengers' => 7,
                'is_active' => true,
                'currently_accepting_bookings' => true,
                'service_rating' => 4.3,
                'total_transfers_completed' => 672,
                'contact_phone' => '+33 4 42 14 14 14',
                'contact_email' => 'marseille@internshipmakers.com',
                'special_instructions' => 'Niveau 0, sortie principale, zone de rencontre.',
                'accepted_payment_methods' => json_encode(['cash', 'card']),
                'covered_postcodes' => json_encode(['13001', '13002', '13003', '13004', '13005', '13006', '13007', '13008', '13009', '13010']),
                'max_distance_km' => 85.00
            ],

            // Toulouse - Blagnac
            [
                'name' => 'Toulouse Airport Service',
                'airport_code' => 'TLS',
                'airport_name' => 'Toulouse-Blagnac',
                'city' => 'Toulouse',
                'country' => 'France',
                'base_price_0_20km' => 32.00,
                'base_price_21_40km' => 45.00,
                'base_price_41_60km' => 65.00,
                'price_per_km_beyond_60km' => 1.90,
                'night_surcharge_percentage' => 15.00,
                'weekend_surcharge_percentage' => 10.00,
                'luggage_fee_per_bag' => 2.50,
                'waiting_fee_per_hour' => 15.00,
                'vehicle_types' => json_encode(['sedan']),
                'service_start_time' => '07:00:00',
                'service_end_time' => '21:30:00',
                'operates_24_7' => false,
                'advance_booking_hours' => 24,
                'max_passengers' => 4,
                'is_active' => true,
                'currently_accepting_bookings' => true,
                'service_rating' => 4.2,
                'total_transfers_completed' => 523,
                'contact_phone' => '+33 5 61 42 44 00',
                'contact_email' => 'toulouse@internshipmakers.com',
                'special_instructions' => 'Hall des arrivées, près du bureau d\'information.',
                'accepted_payment_methods' => json_encode(['cash', 'card']),
                'covered_postcodes' => json_encode(['31000', '31100', '31200', '31300', '31400', '31500']),
                'max_distance_km' => 75.00
            ],

            // Bordeaux - Mérignac
            [
                'name' => 'Bordeaux Airport Premium',
                'airport_code' => 'BOD',
                'airport_name' => 'Bordeaux-Mérignac',
                'city' => 'Bordeaux',
                'country' => 'France',
                'base_price_0_20km' => 35.00,
                'base_price_21_40km' => 48.00,
                'base_price_41_60km' => 68.00,
                'price_per_km_beyond_60km' => 2.00,
                'night_surcharge_percentage' => 20.00,
                'weekend_surcharge_percentage' => 12.00,
                'luggage_fee_per_bag' => 4.00,
                'waiting_fee_per_hour' => 20.00,
                'vehicle_types' => json_encode(['sedan', 'luxury']),
                'service_start_time' => '06:30:00',
                'service_end_time' => '22:30:00',
                'operates_24_7' => false,
                'advance_booking_hours' => 24,
                'max_passengers' => 4,
                'is_active' => true,
                'currently_accepting_bookings' => true,
                'service_rating' => 4.7,
                'total_transfers_completed' => 789,
                'contact_phone' => '+33 5 56 34 50 50',
                'contact_email' => 'bordeaux@internshipmakers.com',
                'special_instructions' => 'Hall A, sortie 1, zone de rencontre.',
                'accepted_payment_methods' => json_encode(['cash', 'card', 'apple_pay']),
                'covered_postcodes' => json_encode(['33000', '33100', '33200', '33300']),
                'max_distance_km' => 80.00
            ],

            // Lille - Lesquin
            [
                'name' => 'Lille Airport Connect',
                'airport_code' => 'LIL',
                'airport_name' => 'Lille-Lesquin',
                'city' => 'Lille',
                'country' => 'France',
                'base_price_0_20km' => 26.00,
                'base_price_21_40km' => 38.00,
                'base_price_41_60km' => 55.00,
                'price_per_km_beyond_60km' => 1.75,
                'night_surcharge_percentage' => 22.00,
                'weekend_surcharge_percentage' => 12.00,
                'luggage_fee_per_bag' => 2.00,
                'waiting_fee_per_hour' => 14.00,
                'vehicle_types' => json_encode(['sedan', 'van']),
                'service_start_time' => '06:30:00',
                'service_end_time' => '21:30:00',
                'operates_24_7' => false,
                'advance_booking_hours' => 12,
                'max_passengers' => 6,
                'is_active' => true,
                'currently_accepting_bookings' => true,
                'service_rating' => 4.3,
                'total_transfers_completed' => 298,
                'contact_phone' => '+33 3 20 49 68 68',
                'contact_email' => 'lille@internshipmakers.com',
                'special_instructions' => 'Terminal passagers, niveau arrivées.',
                'accepted_payment_methods' => json_encode(['cash', 'card']),
                'covered_postcodes' => json_encode(['59000', '59100', '59200']),
                'max_distance_km' => 65.00
            ]
        ];

        foreach ($airportServices as $serviceData) {
            AirportPickupService::create($serviceData);
        }

        // Afficher un message de confirmation
        $this->command->info('✅ ' . count($airportServices) . ' services de transport aéroport créés avec succès !');
        $this->command->info('📍 Aéroports couverts : CDG, ORY, LYS, NCE, MRS, TLS, BOD, LIL');
        $this->command->info('🚗 Types de véhicules : Berlines, SUV, Vans, Véhicules de luxe, Minibus');
        $this->command->info('⭐ Note moyenne : ' . number_format(collect($airportServices)->avg('service_rating'), 1) . '/5');
    }
}