<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('airport_pickup_services', function (Blueprint $table) {
            $table->id();
            
            // Informations de base
            $table->string('name');
            $table->string('airport_code', 10);
            $table->string('airport_name');
            $table->string('city');
            $table->string('country')->default('France');
            
            // Tarification par distance
            $table->decimal('base_price_0_20km', 8, 2);
            $table->decimal('base_price_21_40km', 8, 2);
            $table->decimal('base_price_41_60km', 8, 2);
            $table->decimal('price_per_km_beyond_60km', 8, 2);
            
            // Suppléments
            $table->decimal('night_surcharge_percentage', 5, 2)->default(0);
            $table->decimal('weekend_surcharge_percentage', 5, 2)->default(0);
            $table->decimal('luggage_fee_per_bag', 8, 2)->default(0);
            $table->decimal('waiting_fee_per_hour', 8, 2)->default(0);
            
            // Types de véhicules disponibles
            $table->json('vehicle_types'); // ['sedan', 'suv', 'van', 'luxury']
            
            // Informations de service
            $table->time('service_start_time')->default('06:00:00');
            $table->time('service_end_time')->default('23:00:00');
            $table->boolean('operates_24_7')->default(false);
            $table->integer('advance_booking_hours')->default(24);
            $table->integer('max_passengers')->default(4);
            
            // Statut et qualité
            $table->boolean('is_active')->default(true);
            $table->boolean('currently_accepting_bookings')->default(true);
            $table->decimal('service_rating', 3, 2)->nullable();
            $table->integer('total_transfers_completed')->default(0);
            
            // Contact et informations
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('special_instructions')->nullable();
            $table->json('accepted_payment_methods')->nullable();
            
            // Contraintes géographiques
            $table->json('covered_postcodes')->nullable();
            $table->decimal('max_distance_km', 8, 2)->default(100);
            
            $table->timestamps();
            
            // Index
            $table->index(['airport_code', 'is_active']);
            $table->index(['city', 'currently_accepting_bookings']);
            $table->index('service_rating');
        });
    }

    public function down()
    {
        Schema::dropIfExists('airport_pickup_services');
    }
};