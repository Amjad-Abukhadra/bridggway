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
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Automatically creates primary key
            $table->foreignId('super_id')->constrained('supervisors')->onDelete('cascade');  // Reference 'supervisor_id' column
            $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
            $table->foreignId('college_id')->constrained('colleges')->onDelete('cascade');
            $table->string('st_department')->nullable();
            $table->string('full_name')->nullable();
            $table->double('gpa', 8, 2)->nullable();
            $table->integer('resume')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
