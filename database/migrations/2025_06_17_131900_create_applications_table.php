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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internship_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('linkedin')->nullable();
            $table->text('education')->nullable();
            $table->text('experience')->nullable();
            $table->text('cover_letter');
            $table->string('cv_path')->nullable();
            $table->enum('status', ['pending', 'reviewing', 'accepted', 'rejected'])->default('pending');
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamps();
            
            $table->index(['internship_id', 'status']);
            $table->index(['email', 'applied_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};