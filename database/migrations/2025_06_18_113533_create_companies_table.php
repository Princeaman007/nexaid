<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            
            // Champs communs à tous les types
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            
            // Type de compagnie
            $table->enum('type', ['hiring', 'partnership', 'offer_sender'])
                  ->comment('hiring: cherche à embaucher, partnership: collaboration, offer_sender: envoie des offres');
            
            // Champs pour type "hiring" (Why hire an international intern?)
            $table->json('sectors_interested')->nullable()
                  ->comment('Secteurs d\'activité recherchés');
            $table->json('languages_needed')->nullable()
                  ->comment('Langues requises');
            $table->string('intern_duration_preference')->nullable()
                  ->comment('Durée préférée des stages');
            $table->integer('team_size')->nullable()
                  ->comment('Taille de l\'équipe');
            $table->boolean('has_international_projects')->default(false)
                  ->comment('A des projets internationaux');
            $table->text('cultural_diversity_goals')->nullable()
                  ->comment('Objectifs de diversité culturelle');
            
            // Champs pour type "partnership" (How do we work with companies?)
            $table->string('partnership_type')->nullable()
                  ->comment('Type de partenariat souhaité');
            $table->text('collaboration_expectations')->nullable()
                  ->comment('Attentes de collaboration');
            $table->json('services_needed')->nullable()
                  ->comment('Services requis de la plateforme');
            $table->string('partnership_duration')->nullable()
                  ->comment('Durée du partenariat');
            $table->decimal('budget_range', 10, 2)->nullable()
                  ->comment('Budget alloué');
            $table->boolean('long_term_partnership')->default(false)
                  ->comment('Partenariat à long terme');
            
            // Champs pour type "offer_sender" (Send an offer)
            $table->string('offer_title')->nullable()
                  ->comment('Titre de l\'offre');
            $table->text('offer_description')->nullable()
                  ->comment('Description de l\'offre');
            $table->json('required_skills')->nullable()
                  ->comment('Compétences requises');
            $table->string('offer_location')->nullable()
                  ->comment('Lieu de l\'offre');
            $table->boolean('remote_possible')->default(false)
                  ->comment('Télétravail possible');
            $table->date('offer_start_date')->nullable()
                  ->comment('Date de début');
            $table->date('offer_end_date')->nullable()
                  ->comment('Date de fin');
            $table->decimal('salary_amount', 8, 2)->nullable()
                  ->comment('Montant du salaire/indemnité');
            $table->string('offer_status')->default('draft')
                  ->comment('Statut de l\'offre: draft, active, expired');
            
            // Champs de gestion
            $table->boolean('is_active')->default(true);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            
            // Index
            $table->index(['type', 'is_active']);
            $table->index(['offer_status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};