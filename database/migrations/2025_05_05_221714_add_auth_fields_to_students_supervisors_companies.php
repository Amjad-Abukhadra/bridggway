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
        Schema::table('students', function (Blueprint $table) {
            $table->string('email')->unique()->after('full_name');
            $table->string('password')->after('email');
            $table->boolean('status')->default(0)->after('password');
            $table->rememberToken();
        });
    
        Schema::table('supervisors', function (Blueprint $table) {
            $table->string('email')->unique()->after('full_name');
            $table->string('password')->after('email');
            $table->boolean('status')->default(0)->after('password');
            $table->rememberToken();
        });
    
        Schema::table('companies', function (Blueprint $table) {
            $table->string('email')->unique()->after('name');
            $table->string('password')->after('email');
            $table->boolean('status')->default(0)->after('password');
            $table->rememberToken();
        });
        
        Schema::table('colleges', function (Blueprint $table) {
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('status')->default(0);
            $table->rememberToken();
        });
    }
    
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['email', 'password', 'status', 'remember_token']);
        });
    
        Schema::table('supervisors', function (Blueprint $table) {
            $table->dropColumn(['email', 'password', 'status', 'remember_token']);
        });
    
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['email', 'password', 'status', 'remember_token']);
        });
        
        Schema::table('colleges', function (Blueprint $table) {
            $table->dropColumn(['email', 'password', 'status', 'remember_token']);
        });
    }
    
};
