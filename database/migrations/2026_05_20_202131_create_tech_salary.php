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
        Schema::create('tech_salary', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('dev_type')->nullable();
            $table->decimal('salary_usd_yearly', 12, 2)->nullable();
            $table->float('years_code')->nullable();
            $table->float('work_exp')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('remote_work')->nullable();
            $table->string('ed_level')->nullable();
            $table->unsignedSmallInteger('survey_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tech_salary');
    }
};
