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
    Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('super_id')->constrained('supervisors')->onDelete('cascade');
        $table->foreignId('internship_id')->constrained('internship_opportunities')->onDelete('cascade');
        $table->foreignId('comp_id')->constrained('companies')->onDelete('cascade');
        $table->foreignId('std_id')->constrained('students')->onDelete('cascade');
        $table->tinyInteger('status')->nullable();
        
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
