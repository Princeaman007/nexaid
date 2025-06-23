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
        Schema::create('partnership_requests', function (Blueprint $table) {
            $table->id();
            
            // Company general information
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            
            // Partnership details
            $table->json('services_needed')->nullable(); // Array of services
            $table->string('partnership_type')->nullable();
            $table->string('partnership_duration')->nullable();
            $table->decimal('budget_range', 12, 2)->nullable();
            $table->boolean('long_term_partnership')->default(false);
            $table->text('collaboration_expectations')->nullable();
            
            // Status and tracking
            $table->enum('status', ['pending', 'in_review', 'approved', 'rejected', 'contacted'])
                  ->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            
            $table->timestamps();
            
            // Indexes for searches
            $table->index(['status', 'created_at']);
            $table->index('email');
            $table->index('partnership_type');
            $table->index('created_at');
            
            // Foreign key for admin who processed the request
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnership_requests');
    }
};