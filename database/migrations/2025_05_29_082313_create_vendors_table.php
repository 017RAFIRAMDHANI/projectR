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
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id_vendor');
           $table->string('company_name', 255)->nullable();
    $table->string('requestor_name', 255)->nullable();
    $table->string('location_of_work', 255)->nullable();
    $table->string('building_level_room')->nullable();
    $table->string('work_description')->nullable();
    $table->string('email', 255)->nullable();
    $table->string('phone_number', 15)->nullable();
    $table->string('permit_number', 15)->nullable();
    $table->string('start_date')->nullable();
    $table->string('end_date')->nullable();
    $table->string('number_plate')->nullable();
    $table->string('vehicle_types')->nullable();
    $table->string('worker1_name')->nullable();
    $table->string('worker1_id_nopermit')->nullable();
    $table->string('worker2_name')->nullable();
    $table->string('worker2_id_nopermit')->nullable();
    $table->string('worker3_name')->nullable();
    $table->string('worker3_id_nopermit')->nullable();
    $table->string('worker4_name')->nullable();
    $table->string('worker4_id_nopermit')->nullable();
    $table->string('worker5_name')->nullable();
    $table->string('worker5_id_nopermit')->nullable();
    $table->string('generate_dust')->nullable();
    $table->string('protection_system')->nullable();
    $table->string('file_mos')->nullable();
            $table->string('status_approval_DHI')->nullable(); // Default false (pending)
            $table->string('status_approval_FH')->nullable(); // Default false (pending)
            $table->string('mode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
