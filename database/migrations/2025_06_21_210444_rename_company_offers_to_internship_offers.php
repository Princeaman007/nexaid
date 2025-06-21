<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Renommer company_offers vers internship_offers
        if (Schema::hasTable('company_offers') && !Schema::hasTable('internship_offers')) {
            Schema::rename('company_offers', 'internship_offers');
            
            // Vérifier et ajouter les colonnes manquantes si nécessaire
            Schema::table('internship_offers', function (Blueprint $table) {
                if (!Schema::hasColumn('internship_offers', 'remote_possible')) {
                    $table->boolean('remote_possible')->default(false)->after('end_date');
                }
                if (!Schema::hasColumn('internship_offers', 'required_skills')) {
                    $table->json('required_skills')->nullable()->after('remote_possible');
                }
                if (!Schema::hasColumn('internship_offers', 'published_at')) {
                    $table->timestamp('published_at')->nullable()->after('status');
                }
            });
        }
    }

    public function down(): void
    {
        // Revenir en arrière si nécessaire
        if (Schema::hasTable('internship_offers') && !Schema::hasTable('company_offers')) {
            Schema::rename('internship_offers', 'company_offers');
        }
    }
};