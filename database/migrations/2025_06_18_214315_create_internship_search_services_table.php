<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('internship_search_services', function (Blueprint $table) {
            $table->id();
            
            // Informations du package
            $table->string('package_name');
            $table->string('package_slug')->unique();
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            
            // Services inclus
            $table->boolean('profile_analysis')->default(false);
            $table->integer('application_count')->default(0); // -1 pour illimité
            $table->boolean('cv_optimization')->default(false);
            $table->boolean('cover_letter_optimization')->default(false);
            $table->boolean('unlimited_followup')->default(false);
            $table->boolean('direct_company_connection')->default(false);
            $table->boolean('personalized_advisor')->default(false);
            
            // Garantie
            $table->boolean('has_guarantee')->default(false);
            $table->integer('guarantee_duration_months')->nullable();
            $table->integer('guarantee_refund_percentage')->nullable();
            $table->text('guarantee_conditions')->nullable();
            
            // Couverture
            $table->json('supported_sectors')->nullable();
            $table->json('supported_languages')->nullable();
            $table->json('covered_countries')->nullable();
            
            // Statistiques
            $table->integer('partner_companies_count')->nullable();
            $table->decimal('success_rate_percentage', 5, 2)->nullable();
            $table->integer('average_placement_days')->nullable();
            
            // Administration
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            
            $table->timestamps();
            
            // Index
            $table->index(['is_active', 'is_featured']);
            $table->index('sort_order');
            $table->index('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_search_services');
    }
};