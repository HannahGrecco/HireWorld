<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tech_salary', function (Blueprint $table) {
            $table->foreignId('country_id')->nullable()->after('id')->constrained('countries');
            $table->index('country_id');
        });

        DB::statement('UPDATE tech_salary ts JOIN countries c ON c.name = ts.country SET ts.country_id = c.id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tech_salary', function (Blueprint $table) {
            $table->dropConstrainedForeignId('country_id');
        });
    }
};
