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
    Schema::create('internship_opportunities', function (Blueprint $table) {
        $table->id();
        $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
        $table->foreignId('super_id')->constrained('supervisors')->onDelete('cascade');
        $table->string('title')->nullable();
        $table->string('requirements')->nullable();
        $table->string('description')->nullable();
        $table->dateTime('start_time')->nullable();  
        $table->dateTime('end_time')->nullable();   
        $table->foreignId('std_id')->constrained('students')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_opportunities');
    }
};
