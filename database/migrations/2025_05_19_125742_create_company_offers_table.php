<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::create('application_submissions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('internship_id')->constrained('internships')->onDelete('cascade');
        $table->string('name');
        $table->string('email');
        $table->string('phone')->nullable();
        $table->string('cv_path');
        $table->text('cover_letter');
        $table->text('education')->nullable();
        $table->text('experience')->nullable();
        $table->string('linkedin')->nullable();
        $table->string('status')->default('pending');
        $table->timestamp('applied_at');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_offers');
    }
};