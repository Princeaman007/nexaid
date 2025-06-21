<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['hiring', 'partnership', 'offer_sender']);
            
            // Champs pour hiring
            $table->json('sectors_interested')->nullable();
            $table->json('languages_needed')->nullable();
            $table->string('intern_duration_preference')->nullable();
            $table->boolean('has_international_projects')->default(false);
            $table->text('cultural_diversity_goals')->nullable();
            
            // Champs pour partnership
            $table->json('services_needed')->nullable();
            $table->string('partnership_type')->nullable();
            $table->string('partnership_duration')->nullable();
            $table->decimal('budget_range', 10, 2)->nullable();
            $table->boolean('long_term_partnership')->default(false);
            $table->text('collaboration_expectations')->nullable();
            
            // Statut et données supplémentaires
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->json('data')->nullable(); // Pour stocker des données supplémentaires
            $table->timestamps();

            $table->index(['type', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_registrations');
    }
};
