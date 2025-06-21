<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Colonnes générales
            if (!Schema::hasColumn('companies', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('type');
            }
            if (!Schema::hasColumn('companies', 'is_verified')) {
                $table->boolean('is_verified')->default(false)->after('is_active');
            }

            // Colonnes pour hiring
            if (!Schema::hasColumn('companies', 'sectors_interested')) {
                $table->json('sectors_interested')->nullable()->after('is_verified');
            }
            if (!Schema::hasColumn('companies', 'languages_needed')) {
                $table->json('languages_needed')->nullable()->after('sectors_interested');
            }
            if (!Schema::hasColumn('companies', 'intern_duration_preference')) {
                $table->string('intern_duration_preference')->nullable()->after('languages_needed');
            }
            if (!Schema::hasColumn('companies', 'has_international_projects')) {
                $table->boolean('has_international_projects')->default(false)->after('intern_duration_preference');
            }
            if (!Schema::hasColumn('companies', 'cultural_diversity_goals')) {
                $table->text('cultural_diversity_goals')->nullable()->after('has_international_projects');
            }

            // Colonnes pour partnership
            if (!Schema::hasColumn('companies', 'partnership_type')) {
                $table->string('partnership_type')->nullable()->after('cultural_diversity_goals');
            }
            if (!Schema::hasColumn('companies', 'collaboration_expectations')) {
                $table->text('collaboration_expectations')->nullable()->after('partnership_type');
            }
            if (!Schema::hasColumn('companies', 'services_needed')) {
                $table->json('services_needed')->nullable()->after('collaboration_expectations');
            }
            if (!Schema::hasColumn('companies', 'partnership_duration')) {
                $table->string('partnership_duration')->nullable()->after('services_needed');
            }
            if (!Schema::hasColumn('companies', 'budget_range')) {
                $table->decimal('budget_range', 10, 2)->nullable()->after('partnership_duration');
            }
            if (!Schema::hasColumn('companies', 'long_term_partnership')) {
                $table->boolean('long_term_partnership')->default(false)->after('budget_range');
            }

            // Colonnes pour offer_sender
            if (!Schema::hasColumn('companies', 'offer_title')) {
                $table->string('offer_title')->nullable()->after('long_term_partnership');
            }
            if (!Schema::hasColumn('companies', 'offer_description')) {
                $table->text('offer_description')->nullable()->after('offer_title');
            }
            if (!Schema::hasColumn('companies', 'required_skills')) {
                $table->json('required_skills')->nullable()->after('offer_description');
            }
            if (!Schema::hasColumn('companies', 'offer_location')) {
                $table->string('offer_location')->nullable()->after('required_skills');
            }
            if (!Schema::hasColumn('companies', 'remote_possible')) {
                $table->boolean('remote_possible')->default(false)->after('offer_location');
            }
            if (!Schema::hasColumn('companies', 'offer_start_date')) {
                $table->date('offer_start_date')->nullable()->after('remote_possible');
            }
            if (!Schema::hasColumn('companies', 'offer_end_date')) {
                $table->date('offer_end_date')->nullable()->after('offer_start_date');
            }
            if (!Schema::hasColumn('companies', 'salary_amount')) {
                $table->decimal('salary_amount', 8, 2)->nullable()->after('offer_end_date');
            }
            if (!Schema::hasColumn('companies', 'offer_status')) {
                $table->enum('offer_status', ['draft', 'active', 'closed'])->default('draft')->after('salary_amount');
            }
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $columns = [
                'is_active', 'is_verified', 'sectors_interested', 'languages_needed',
                'intern_duration_preference', 'has_international_projects', 
                'cultural_diversity_goals', 'partnership_type', 'collaboration_expectations',
                'services_needed', 'partnership_duration', 'budget_range', 
                'long_term_partnership', 'offer_title', 'offer_description',
                'required_skills', 'offer_location', 'remote_possible',
                'offer_start_date', 'offer_end_date', 'salary_amount', 'offer_status'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('companies', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};