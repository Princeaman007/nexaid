<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('housing_services', function (Blueprint $table) {
            $table->id();
            
            // Type et identité du logement
            $table->enum('housing_type', ['student_residence', 'shared_apartment', 'host_family', 'private_studio']);
            $table->string('housing_name');
            $table->string('housing_slug')->unique();
            $table->text('description')->nullable();
            $table->longText('detailed_description')->nullable();
            
            // Tarification
            $table->decimal('starting_price_monthly', 8, 2);
            $table->decimal('deposit_amount', 8, 2)->nullable();
            $table->decimal('agency_fees', 8, 2)->nullable();
            $table->json('additional_costs')->nullable();
            
            // Localisation
            $table->string('city');
            $table->string('country');
            $table->string('district')->nullable();
            $table->string('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            // Caractéristiques du logement
            $table->integer('room_count')->default(1);
            $table->integer('bathroom_count')->default(1);
            $table->decimal('surface_area_sqm', 6, 2)->nullable();
            $table->boolean('furnished')->default(true);
            $table->integer('max_occupants')->default(1);
            $table->boolean('suitable_for_couples')->default(false);
            
            // Équipements et services
            $table->json('amenities')->nullable();
            $table->json('shared_facilities')->nullable();
            $table->boolean('utilities_included')->default(false);
            $table->json('included_utilities')->nullable();
            $table->boolean('cleaning_service')->default(false);
            $table->boolean('security_system')->default(false);
            
            // Conditions de location
            $table->integer('min_stay_months')->default(1);
            $table->integer('max_stay_months')->nullable();
            $table->boolean('flexible_contracts')->default(false);
            $table->date('available_from')->nullable();
            $table->boolean('currently_available')->default(true);
            
            // Famille d'accueil spécifique
            $table->json('host_family_info')->nullable();
            $table->boolean('meals_included')->default(false);
            $table->enum('meal_plan', ['breakfast', 'half_board', 'full_board', 'breakfast_dinner'])->nullable();
            
            // Transport et accessibilité
            $table->json('transport_options')->nullable();
            $table->decimal('distance_to_city_center_km', 5, 2)->nullable();
            $table->text('neighborhood_description')->nullable();
            
            // Qualité et certification
            $table->boolean('quality_inspected')->default(false);
            $table->decimal('quality_rating', 3, 2)->nullable();
            $table->json('inspection_photos')->nullable();
            $table->date('last_inspection_date')->nullable();
            
            // Services de support
            $table->boolean('has_24_7_support')->default(false);
            $table->boolean('welcome_service')->default(false);
            $table->boolean('installation_assistance')->default(false);
            $table->boolean('maintenance_included')->default(false);
            
            // Média et documentation
            $table->json('photos')->nullable();
            $table->json('virtual_tour_urls')->nullable();
            $table->json('required_documents')->nullable();
            
            // Avis et témoignages
            $table->json('testimonials')->nullable();
            $table->decimal('average_rating', 3, 2)->nullable();
            $table->integer('total_bookings')->default(0);
            
            // Contact et réservation
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('booking_instructions')->nullable();
            $table->boolean('instant_booking')->default(false);
            
            // Statut et gestion
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('verified_listing')->default(false);
            $table->integer('sort_order')->default(0);
            $table->text('admin_notes')->nullable();
            
            $table->timestamps();
            
            // Index pour optimiser les recherches
            $table->index(['housing_type', 'is_active']);
            $table->index(['city', 'currently_available']);
            $table->index(['starting_price_monthly']);
            $table->index(['quality_rating']);
            $table->index(['is_featured']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('housing_services');
    }
};