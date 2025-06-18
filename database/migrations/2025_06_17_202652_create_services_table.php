<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['internship-search', 'housing', 'airport-pickup', 'support']);
            $table->json('title'); // {'fr': 'Recherche de stage', 'en': 'Internship Search'}
            $table->json('subtitle')->nullable(); // Courte description
            $table->json('description'); // Description complète HTML
            $table->json('how_it_works')->nullable(); // Étapes du processus
            $table->json('advantages')->nullable(); // Liste des avantages
            $table->json('testimonials')->nullable(); // Témoignages clients
            $table->string('icon')->nullable(); // Icône ou emoji
            $table->string('hero_image')->nullable(); // Image hero de la page
            $table->json('gallery')->nullable(); // Galerie d'images
            $table->string('background_color')->default('#667eea'); // Couleur de fond
            $table->json('features')->nullable(); // Fonctionnalités spéciales
            $table->json('pricing')->nullable(); // Informations de prix si applicable
            $table->json('faq')->nullable(); // FAQ spécifique au service
            $table->string('contact_email')->nullable(); // Email de contact spécifique
            $table->string('contact_phone')->nullable(); // Téléphone spécifique
            $table->json('meta_title')->nullable(); // SEO
            $table->json('meta_description')->nullable(); // SEO
            $table->json('call_to_action')->nullable(); // CTA personnalisé
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};