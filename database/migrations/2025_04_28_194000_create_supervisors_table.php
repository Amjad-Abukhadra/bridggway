<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id(); // Automatically primary key
            $table->string('full_name')->nullable();
            $table->string('super_department')->nullable();
            $table->foreignId('college_id')->constrained('colleges')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisors');
    }
};
