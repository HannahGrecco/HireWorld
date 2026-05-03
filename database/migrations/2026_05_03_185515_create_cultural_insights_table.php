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
        Schema::create('cultural_insights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->text('business_etiquette')->nullable();
            $table->text('decision_making_style')->nullable();
            $table->text('communication_style')->nullable();
            $table->text('things_to_avoid')->nullable();
            $table->boolean('generated_by_ai')->default(false);
            $table->timestamps('generated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cultural_insights');
    }
};
