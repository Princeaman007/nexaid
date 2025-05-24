<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('internships', function (Blueprint $table) {
            // Ajout des nouveaux champs
            $table->string('duration')->nullable()->after('description');
            $table->date('start_date')->nullable()->after('duration');
            $table->string('compensation')->nullable()->after('start_date');
            $table->string('required_language')->nullable()->after('compensation');
            $table->json('required_skills')->nullable()->after('required_language');
            $table->json('learning_outcomes')->nullable()->after('required_skills');
            $table->date('application_deadline')->nullable()->after('learning_outcomes');
            $table->string('position_type')->nullable()->after('application_deadline');
            $table->string('remote_option')->nullable()->after('position_type');
            $table->string('internship_level')->nullable()->after('remote_option');
            $table->json('benefits')->nullable()->after('internship_level');
            $table->boolean('is_featured')->default(false)->after('is_active');
        });
    }

    public function down()
    {
        Schema::table('internships', function (Blueprint $table) {
            // Suppression des nouveaux champs
            $table->dropColumn([
                'duration',
                'start_date',
                'compensation',
                'required_language',
                'required_skills',
                'learning_outcomes',
                'application_deadline',
                'position_type',
                'remote_option',
                'internship_level',
                'benefits',
                'is_featured'
            ]);
        });
    }
};