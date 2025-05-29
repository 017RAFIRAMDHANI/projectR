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
            $table->string('company_name', 255);
            $table->string('requestor_name', 255);
            $table->string('location_of_work', 255);
            $table->string('building_level_room', 20);
            $table->string('work_description', 20);
            $table->string('email', 255);
            $table->string('phone_number', 15);
            $table->string('permit_number', 15);
            $table->string('start_date');
            $table->string('end_date');
            $table->string('number_plate');
            $table->string('vehicle_types');
            $table->string('worker1_name');
            $table->string('worker1_id_nopermit');
            $table->string('worker2_name');
            $table->string('worker2_id_nopermit');
            $table->string('worker3_name');
            $table->string('worker3_id_nopermit');
            $table->string('worker4_name');
            $table->string('worker4_id_nopermit');
            $table->string('worker5_name');
            $table->string('worker5_id_nopermit');
            $table->string('generate_dust');
            $table->string('protection_system')->nullable();
            $table->string('file_mos')->nullable();
            $table->boolean('status_approval_DHI')->default(false); // Default false (pending)
            $table->boolean('status_approval_FH')->default(false); // Default false (pending)
            $table->enum('mode', ['Urgent', 'Normal']);
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
