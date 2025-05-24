<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('internships', function (Blueprint $table) {
            // Nouveaux champs principaux
            $table->json('main_responsibilities')->nullable()->after('description');
            $table->json('qualifications')->nullable()->after('required_skills');
            
            // Information sur l'entreprise
            $table->text('company_description')->nullable()->after('company_name');
            
            // Processus de candidature
            $table->text('application_process')->nullable()->after('benefits');
            
            // Informations de contact
            $table->string('contact_email')->nullable()->after('application_process');
            $table->string('contact_phone')->nullable()->after('contact_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('internships', function (Blueprint $table) {
            $table->dropColumn([
                'main_responsibilities',
                'qualifications',
                'company_description',
                'application_process',
                'contact_email',
                'contact_phone'
            ]);
        });
    }
};