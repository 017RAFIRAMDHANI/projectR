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
        Schema::create('visitors', function (Blueprint $table) {

            $table->increments('id_visitor');
            $table->string('email', 255)->nullable();
            $table->string('request_date_from', 255)->nullable();
            $table->string('request_date_to', 255)->nullable();
            $table->string('purpose', 255)->nullable();
            $table->string('purpose_detail', 255)->nullable();
            $table->string('area', 255)->nullable();
            $table->string('name_1', 255)->nullable();
            $table->string('id_card_1', 255)->nullable();
            $table->string('name_2', 255)->nullable();
            $table->string('id_card_2', 255)->nullable();
            $table->string('name_3', 255)->nullable();
            $table->string('id_card_3', 255)->nullable();
            $table->string('name_4', 255)->nullable();
            $table->string('id_card_4', 255)->nullable();
            $table->string('name_5', 255)->nullable();
            $table->string('id_card_5', 255)->nullable();
            $table->string('name_6', 255)->nullable();
            $table->string('id_card_6', 255)->nullable();
            $table->string('name_7', 255)->nullable();
            $table->string('id_card_7', 255)->nullable();
            $table->string('name_8', 255)->nullable();
            $table->string('id_card_8', 255)->nullable();
            $table->string('name_9', 255)->nullable();
            $table->string('id_card_9', 255)->nullable();
            $table->string('name_10', 255)->nullable();
            $table->string('id_card_10', 255)->nullable();
            $table->string('qty_1', 255)->nullable();
            $table->string('material_1', 255)->nullable();
            $table->string('qty_2', 255)->nullable();
            $table->string('material_2', 255)->nullable();
            $table->string('qty_3', 255)->nullable();
            $table->string('material_3', 255)->nullable();
            $table->string('qty_4', 255)->nullable();
            $table->string('material_4', 255)->nullable();
            $table->string('qty_5', 255)->nullable();
            $table->string('material_5', 255)->nullable();
            $table->string('qty_6', 255)->nullable();
            $table->string('material_6', 255)->nullable();
            $table->string('qty_7', 255)->nullable();
            $table->string('material_7', 255)->nullable();
            $table->string('qty_8', 255)->nullable();
            $table->string('material_8', 255)->nullable();
            $table->string('qty_9', 255)->nullable();
            $table->string('material_9', 255)->nullable();
            $table->string('qty_10', 255)->nullable();
            $table->string('material_10', 255)->nullable();
            $table->string('pic_name', 255)->nullable();
            $table->string('contact_number', 255)->nullable();
            $table->string('car_plate_no', 255)->nullable();
            $table->string('vehicle_type', 255)->nullable();
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
        Schema::dropIfExists('visitors');
    }
};
