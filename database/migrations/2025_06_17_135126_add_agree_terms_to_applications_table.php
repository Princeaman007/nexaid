<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->boolean('agree_terms')->default(false)->after('cv_path');
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('agree_terms');
        });
    }
};