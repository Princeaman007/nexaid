<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Ajouter les nouvelles colonnes pour la relation polymorphe
            $table->string('name')->after('id')->nullable();
            $table->string('slug')->after('name')->nullable();
            $table->decimal('base_price', 8, 2)->after('description')->nullable();
            
            // Ajouter les colonnes polymorphes
            $table->string('serviceable_type')->after('base_price')->nullable();
            $table->unsignedBigInteger('serviceable_id')->after('serviceable_type')->nullable();
            
            // Ajouter les index
            $table->index(['serviceable_type', 'serviceable_id']);
            $table->index(['type', 'is_active']);
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['serviceable_type', 'serviceable_id']);
            $table->dropIndex(['type', 'is_active']);
            $table->dropUnique(['slug']);
            
            $table->dropColumn([
                'name', 
                'slug', 
                'base_price', 
                'serviceable_type', 
                'serviceable_id'
            ]);
        });
    }
};