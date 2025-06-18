<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            // Vérifier et ajouter chaque colonne individuellement
            if (!Schema::hasColumn('applications', 'response_message')) {
                $table->text('response_message')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'responded_at')) {
                $table->timestamp('responded_at')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'interview_date')) {
                $table->timestamp('interview_date')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'interview_location')) {
                $table->string('interview_location')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $columns = ['response_message', 'responded_at', 'interview_date', 'interview_location'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('applications', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};