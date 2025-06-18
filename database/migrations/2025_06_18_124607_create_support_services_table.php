<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('support_services', function (Blueprint $table) {
            $table->id();
            
            // Informations de base
            $table->string('service_name');
            $table->string('service_slug')->unique();
            $table->text('description')->nullable();
            $table->longText('detailed_description')->nullable();
            
            // Catégories principales de support
            $table->boolean('administrative_assistance')->default(false);
            $table->boolean('professional_support')->default(false);
            $table->boolean('personal_support')->default(false);
            $table->boolean('social_activities')->default(false);
            
            // Services administratifs détaillés
            $table->json('administrative_services')->nullable();
            $table->boolean('visa_assistance')->default(false);
            $table->boolean('residence_permit_help')->default(false);
            $table->boolean('bank_account_assistance')->default(false);
            $table->boolean('local_registration_help')->default(false);
            $table->boolean('health_insurance_guidance')->default(false);
            $table->boolean('document_translation')->default(false);
            
            // Services professionnels détaillés
            $table->json('professional_services')->nullable();
            $table->boolean('company_mediation')->default(false);
            $table->boolean('corporate_culture_advice')->default(false);
            $table->boolean('internship_difficulty_support')->default(false);
            $table->boolean('professional_guidance')->default(false);
            $table->boolean('cv_linkedin_optimization')->default(false);
            $table->boolean('interview_preparation')->default(false);
            
            // Services personnels détaillés
            $table->json('personal_services')->nullable();
            $table->boolean('cultural_integration_help')->default(false);
            $table->boolean('local_life_recommendations')->default(false);
            $table->boolean('medical_assistance')->default(false);
            $table->boolean('personal_difficulties_support')->default(false);
            $table->boolean('mental_health_support')->default(false);
            $table->boolean('emergency_assistance')->default(false);
            
            // Activités sociales détaillées
            $table->json('social_activities_offered')->nullable();
            $table->boolean('networking_events')->default(false);
            $table->boolean('intern_meetups')->default(false);
            $table->boolean('cultural_outings')->default(false);
            $table->boolean('team_building_activities')->default(false);
            $table->integer('monthly_events_count')->nullable();
            $table->decimal('events_average_cost', 8, 2)->nullable();
            
            // Contact et communication
            $table->boolean('has_24_7_helpline')->default(false);
            $table->string('emergency_phone')->nullable();
            $table->string('support_email')->nullable();
            $table->boolean('email_support_available')->default(false);
            $table->integer('email_response_hours')->nullable();
            $table->boolean('personal_appointments')->default(false);
            $table->boolean('video_appointments')->default(false);
            $table->boolean('mobile_app_available')->default(false);
            $table->boolean('live_chat_support')->default(false);
            $table->string('whatsapp_support')->nullable();
            $table->integer('urgent_response_hours')->nullable();
            
            // Qualité du service
            $table->boolean('personalized_advisor')->default(false);
            $table->boolean('confidential_handling')->default(false);
            $table->boolean('concrete_solutions_commitment')->default(false);
            $table->json('service_guarantees')->nullable();
            
            // Couverture géographique et linguistique
            $table->json('covered_cities');
            $table->json('supported_languages');
            $table->boolean('operates_weekends')->default(false);
            $table->boolean('operates_holidays')->default(false);
            $table->time('regular_hours_start')->nullable();
            $table->time('regular_hours_end')->nullable();
            
            // Équipe
            $table->integer('advisors_count')->nullable();
            $table->decimal('team_average_experience_years', 3, 1)->nullable();
            $table->json('team_specializations')->nullable();
            $table->boolean('multilingual_team')->default(false);
            
            // Ressources et outils
            $table->boolean('online_resource_library')->default(false);
            $table->boolean('city_guides_available')->default(false);
            $table->boolean('document_templates')->default(false);
            $table->boolean('emergency_contacts_database')->default(false);
            $table->string('mobile_app_store_url')->nullable();
            $table->string('resource_portal_url')->nullable();
            
            // Statistiques et performance
            $table->decimal('service_satisfaction_rating', 3, 2)->nullable();
            $table->integer('total_cases_handled')->default(0);
            $table->decimal('resolution_success_rate', 5, 2)->nullable();
            $table->decimal('average_resolution_hours', 6, 1)->nullable();
            $table->json('testimonials')->nullable();
            
            // Tarification
            $table->decimal('monthly_subscription_price', 8, 2)->nullable();
            $table->boolean('included_in_internship_package')->default(false);
            $table->boolean('pay_per_use_available')->default(false);
            $table->decimal('consultation_hourly_rate', 8, 2)->nullable();
            $table->json('premium_features')->nullable();
            
            // Intégrations avec autres services
            $table->boolean('housing_integration')->default(false);
            $table->boolean('internship_integration')->default(false);
            $table->boolean('airport_pickup_coordination')->default(false);
            $table->boolean('company_liaison')->default(false);
            
            // Services d'urgence et crise
            $table->boolean('crisis_intervention_available')->default(false);
            $table->json('emergency_protocols')->nullable();
            $table->json('local_emergency_contacts')->nullable();
            $table->boolean('family_notification_service')->default(false);
            $table->boolean('legal_assistance_referral')->default(false);
            
            // Suivi et reporting
            $table->boolean('monthly_progress_reports')->default(false);
            $table->boolean('case_tracking_system')->default(false);
            $table->boolean('satisfaction_surveys')->default(false);
            $table->integer('survey_frequency_days')->nullable();
            
            // Statut et gestion
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('accepting_new_clients')->default(true);
            $table->decimal('current_capacity_percentage', 5, 2)->default(0);
            $table->integer('sort_order')->default(0);
            $table->text('admin_notes')->nullable();
            
            $table->timestamps();
            
            // Index pour optimiser les requêtes
            $table->index(['is_active', 'accepting_new_clients']);
            $table->index(['service_satisfaction_rating']);
            $table->index(['sort_order']);
            $table->index(['is_featured']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('support_services');
    }
};