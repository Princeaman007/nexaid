<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internship_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained('internship_offers')->onDelete('cascade');
            $table->string('student_name');
            $table->string('student_email');
            $table->string('student_phone')->nullable();
            $table->string('nationality')->nullable();
            $table->string('cv_path')->nullable();
            $table->text('cover_letter')->nullable();
            $table->enum('status', ['pending', 'interview', 'accepted', 'rejected'])->default('pending');
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamps();

            $table->index(['offer_id', 'status']);
            $table->index(['status', 'applied_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internship_applications');
    }
};