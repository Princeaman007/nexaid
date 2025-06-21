<?php

// database/migrations/create_page_contents_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->enum('page_type', ['hiring', 'partnership', 'offer_sender']);
            $table->string('section_key'); // hero, benefits, process, etc.
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->longText('content')->nullable();
            $table->json('meta_data')->nullable(); // données supplémentaires
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['page_type', 'section_key']);
            $table->index('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_contents');
    }
};

// database/migrations/create_testimonials_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_logo')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_position')->nullable();
            $table->text('testimonial_text');
            $table->decimal('rating', 2, 1)->nullable();
            $table->string('company_size')->nullable();
            $table->string('industry')->nullable();
            $table->json('tags')->nullable(); // ["Tech", "Startup"]
            $table->json('metrics')->nullable(); // {"growth": "+35%", "satisfaction": "92%"}
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
            $table->index('is_featured');
        });
    }

    public function down()
    {
        Schema::dropIfExists('testimonials');
    }
};

// database/migrations/create_site_settings_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->json('value');
            $table->enum('type', ['text', 'number', 'boolean', 'array', 'file']);
            $table->string('group')->default('general');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index('group');
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
};

// database/migrations/create_process_steps_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('process_steps', function (Blueprint $table) {
            $table->id();
            $table->enum('page_type', ['hiring', 'partnership', 'offer_sender']);
            $table->integer('step_number');
            $table->string('title');
            $table->text('description');
            $table->string('icon')->nullable(); // nom de l'icône ou SVG
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['page_type', 'step_number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('process_steps');
    }
};