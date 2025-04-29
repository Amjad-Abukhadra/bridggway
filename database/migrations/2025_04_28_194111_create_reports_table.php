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
    Schema::create('reports', function (Blueprint $table) {
        $table->id();
        $table->foreignId('comp_id')->constrained('companies')->onDelete('cascade');
        $table->foreignId('super_id')->constrained('supervisors')->onDelete('cascade');
        $table->string('task')->nullable();
        $table->string('tools')->nullable();
        $table->integer('number_of_hours')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
