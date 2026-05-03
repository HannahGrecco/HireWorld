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
        Schema::create('labor_laws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('weekly_hours_limit')->nullable();
            $table->tinyInteger('min_vacation_days')->nullable();
            $table->decimal('min_wage_local', 12, 2)->nullable();
            $table->enum('min_wage_period', ['hour', 'month', 'year'])->nullable();
            $table->json('contract_types')->nullable();
            $table->tinyInteger('notice_period_days')->nullable();
            $table->string('source_url', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labor_laws');
    }
};
