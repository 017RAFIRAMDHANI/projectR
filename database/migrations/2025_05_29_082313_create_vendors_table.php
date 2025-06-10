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
            $table->string('email', 255)->nullable();
            $table->string('validity_date_from')->nullable();
            $table->string('validity_date_to')->nullable();
            $table->string('validity_time_from')->nullable();
            $table->string('validity_time_to')->nullable();
            $table->string('company_name', 255)->nullable();
            $table->string('requestor_name', 255)->nullable();
            $table->string('company_contact', 255)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('location_of_work', 255)->nullable();
            $table->string('building_level_room')->nullable();
            $table->string('purpose')->nullable();
            $table->string('purpose_details')->nullable();
            $table->string('total_worker')->nullable();
            $table->string('worker1_name')->nullable();
            $table->string('worker1_id_card')->nullable();
            $table->string('worker1_birthdate')->nullable();
            $table->string('worker2_name')->nullable();
            $table->string('worker2_id_card')->nullable();
            $table->string('worker2_birthdate')->nullable();
            $table->string('worker3_name')->nullable();
            $table->string('worker3_id_card')->nullable();
            $table->string('worker3_birthdate')->nullable();
            $table->string('worker4_name')->nullable();
            $table->string('worker4_id_card')->nullable();
            $table->string('worker4_birthdate')->nullable();
            $table->string('worker5_name')->nullable();
            $table->string('worker5_id_card')->nullable();
            $table->string('worker5_birthdate')->nullable();
            $table->string('worker6_name')->nullable();
            $table->string('worker6_id_card')->nullable();
            $table->string('worker6_birthdate')->nullable();
            $table->string('worker7_name')->nullable();
            $table->string('worker7_id_card')->nullable();
            $table->string('worker7_birthdate')->nullable();
            $table->string('worker8_name')->nullable();
            $table->string('worker8_id_card')->nullable();
            $table->string('worker8_birthdate')->nullable();
            $table->string('worker9_name')->nullable();
            $table->string('worker9_id_card')->nullable();
            $table->string('worker9_birthdate')->nullable();
            $table->string('worker10_name')->nullable();
            $table->string('worker10_id_card')->nullable();
            $table->string('worker10_birthdate')->nullable();
            $table->string('generate_dust')->nullable();
            $table->string('state_cause')->nullable();
            $table->string('method')->nullable();
            $table->string('any_fire')->nullable();
            $table->string('isolation_of')->nullable();
            $table->string('isolation_name')->nullable();
            $table->string('isolation_date')->nullable();
            $table->string('file_mos')->nullable();
            $table->string('number_plate')->nullable();
            $table->string('vehicle_types')->nullable();
            $table->string('primary_number', 255)->nullable();
            $table->string('permit_number', 255)->nullable();
            $table->string('status')->nullable(); // Default false (pending)
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
