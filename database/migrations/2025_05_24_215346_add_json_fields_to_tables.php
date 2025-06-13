<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // BlogPost - convertir title et content en JSON
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('content')->change();
        });

        // Partners - convertir name et description en JSON
        Schema::table('partners', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
