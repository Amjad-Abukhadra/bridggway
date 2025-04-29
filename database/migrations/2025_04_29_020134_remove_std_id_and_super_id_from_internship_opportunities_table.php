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
        Schema::table('internship_opportunities', function (Blueprint $table) {
            $table->dropForeign(['std_id']);
            $table->dropForeign(['super_id']);

            // Then drop columns
            $table->dropColumn('std_id');
            $table->dropColumn('super_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('internship_opportunities', function (Blueprint $table) {
            //
        });
    }
};
