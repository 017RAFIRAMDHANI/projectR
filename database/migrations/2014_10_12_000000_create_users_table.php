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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->string('item1')->nullable();
            $table->string('item2')->nullable();
            $table->integer('access_role_create')->nullable();
            $table->integer('access_role_edit')->nullable();
            $table->integer('access_role_delete')->nullable();
            $table->integer('access_role_view')->nullable();
            $table->integer('access_report_create')->nullable();
            $table->integer('access_report_edit')->nullable();
            $table->integer('access_report_delete')->nullable();
            $table->integer('access_report_view')->nullable();
            $table->integer('access_vehicle_edit')->nullable();
            $table->integer('access_vehicle_create')->nullable();
            $table->integer('access_vehicle_view')->nullable();
            $table->integer('access_vehicle_delete')->nullable();
            $table->integer('access_employe_edit')->nullable();
            $table->integer('access_employe_create')->nullable();
            $table->integer('access_employe_view')->nullable();
            $table->integer('access_employe_delete')->nullable();
            $table->integer('access_newspecial_create')->nullable();
  
            $table->integer('access_approvals_view')->nullable();
            $table->integer('access_approvals_edit')->nullable();
            $table->integer('access_visvin_delete')->nullable();
            $table->integer('access_visvin_view')->nullable();
            $table->integer('access_safety_view')->nullable();
            $table->integer('access_safety_edit')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
