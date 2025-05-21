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
        Schema::table('reports', function (Blueprint $table) {
            // Add evaluation fields
            $table->enum('performance_level', ['excellent', 'very_good', 'good', 'acceptable', 'weak'])->nullable();
            $table->enum('responsibility', ['excellent', 'very_good', 'good', 'acceptable', 'weak'])->nullable();
            $table->enum('punctuality', ['excellent', 'very_good', 'good', 'acceptable', 'weak'])->nullable();
            $table->enum('accuracy_in_work', ['excellent', 'very_good', 'good', 'acceptable', 'weak'])->nullable();
            $table->enum('teamwork', ['excellent', 'very_good', 'good', 'acceptable', 'weak'])->nullable();
            $table->enum('adaptability', ['excellent', 'very_good', 'good', 'acceptable', 'weak'])->nullable();
            $table->enum('skill_acquisition_speed', ['excellent', 'very_good', 'good', 'acceptable', 'weak'])->nullable();
            $table->enum('overall_completion', ['excellent', 'very_good', 'good', 'acceptable', 'weak'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn([
                'performance_level',
                'responsibility',
                'punctuality',
                'accuracy_in_work',
                'teamwork',
                'adaptability',
                'skill_acquisition_speed',
                'overall_completion'
            ]);
        });
    }
}; 