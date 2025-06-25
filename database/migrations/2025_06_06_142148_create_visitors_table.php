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
$table->string('purpose_visit', 255)->nullable();
$table->string('purpose_detail', 255)->nullable();
$table->string('building', 255)->nullable();
$table->string('level', 255)->nullable();
$table->string('specific_location', 255)->nullable();
$table->string('pic_name', 255)->nullable();
$table->string('pic_contact', 255)->nullable();
$table->string('car_plate_no', 255)->nullable();
$table->string('vehicle_type', 255)->nullable();
$table->text('name_1')->nullable();
$table->text('id_card_1')->nullable();
$table->text('name_2')->nullable();
$table->text('id_card_2')->nullable();
$table->text('name_3')->nullable();
$table->text('id_card_3')->nullable();
$table->text('name_4')->nullable();
$table->text('id_card_4')->nullable();
$table->text('name_5')->nullable();
$table->text('id_card_5')->nullable();
$table->text('name_6')->nullable();
$table->text('id_card_6')->nullable();
$table->text('name_7')->nullable();
$table->text('id_card_7')->nullable();
$table->text('name_8')->nullable();
$table->text('id_card_8')->nullable();
$table->text('name_9')->nullable();
$table->text('id_card_9')->nullable();
$table->text('name_10')->nullable();
$table->text('id_card_10')->nullable();
$table->text('name_11')->nullable();
$table->text('id_card_11')->nullable();
$table->text('name_12')->nullable();
$table->text('id_card_12')->nullable();
$table->text('name_13')->nullable();
$table->text('id_card_13')->nullable();
$table->text('name_14')->nullable();
$table->text('id_card_14')->nullable();
$table->text('name_15')->nullable();
$table->text('id_card_15')->nullable();
$table->text('name_16')->nullable();
$table->text('id_card_16')->nullable();
$table->text('name_17')->nullable();
$table->text('id_card_17')->nullable();
$table->text('name_18')->nullable();
$table->text('id_card_18')->nullable();
$table->text('name_19')->nullable();
$table->text('id_card_19')->nullable();
$table->text('name_20')->nullable();
$table->text('id_card_20')->nullable();
$table->text('name_21')->nullable();
$table->text('id_card_21')->nullable();
$table->text('name_22')->nullable();
$table->text('id_card_22')->nullable();
$table->text('name_23')->nullable();
$table->text('id_card_23')->nullable();
$table->text('name_24')->nullable();
$table->text('id_card_24')->nullable();
$table->text('name_25')->nullable();
$table->text('id_card_25')->nullable();
$table->text('name_26')->nullable();
$table->text('id_card_26')->nullable();
$table->text('name_27')->nullable();
$table->text('id_card_27')->nullable();
$table->text('name_28')->nullable();
$table->text('id_card_28')->nullable();
$table->text('name_29')->nullable();
$table->text('id_card_29')->nullable();
$table->text('name_30')->nullable();
$table->text('id_card_30')->nullable();
$table->text('material_1')->nullable();
$table->text('quantity_1')->nullable();
$table->text('material_2')->nullable();
$table->text('quantity_2')->nullable();
$table->text('material_3')->nullable();
$table->text('quantity_3')->nullable();
$table->text('material_4')->nullable();
$table->text('quantity_4')->nullable();
$table->text('material_5')->nullable();
$table->text('quantity_5')->nullable();
$table->text('material_6')->nullable();
$table->text('quantity_6')->nullable();
$table->text('material_7')->nullable();
$table->text('quantity_7')->nullable();
$table->text('material_8')->nullable();
$table->text('quantity_8')->nullable();
$table->text('material_9')->nullable();
$table->text('quantity_9')->nullable();
$table->text('material_10')->nullable();
$table->text('quantity_10')->nullable();
$table->text('material_11')->nullable();
$table->text('quantity_11')->nullable();
$table->text('material_12')->nullable();
$table->text('quantity_12')->nullable();
$table->text('material_13')->nullable();
$table->text('quantity_13')->nullable();
$table->text('material_14')->nullable();
$table->text('quantity_14')->nullable();
$table->text('material_15')->nullable();
$table->text('quantity_15')->nullable();
$table->text('material_16')->nullable();
$table->text('quantity_16')->nullable();
$table->text('material_17')->nullable();
$table->text('quantity_17')->nullable();
$table->text('material_18')->nullable();
$table->text('quantity_18')->nullable();
$table->text('material_19')->nullable();
$table->text('quantity_19')->nullable();
$table->text('material_20')->nullable();
$table->text('quantity_20')->nullable();
$table->text('material_21')->nullable();
$table->text('quantity_21')->nullable();
$table->text('material_22')->nullable();
$table->text('quantity_22')->nullable();
$table->text('material_23')->nullable();
$table->text('quantity_23')->nullable();
$table->text('material_24')->nullable();
$table->text('quantity_24')->nullable();
$table->text('material_25')->nullable();
$table->text('quantity_25')->nullable();
$table->text('material_26')->nullable();
$table->text('quantity_26')->nullable();
$table->text('material_27')->nullable();
$table->text('quantity_27')->nullable();
$table->text('material_28')->nullable();
$table->text('quantity_28')->nullable();
$table->text('material_29')->nullable();
$table->text('quantity_29')->nullable();
$table->text('material_30')->nullable();
$table->text('quantity_30')->nullable();
$table->string('upload_id_card_foto', 255)->nullable();
$table->string('primary_number', 255)->nullable();
   $table->integer('check_one_approve')->nullable();
            $table->string('permit_number', 255)->nullable();
            $table->string('status')->nullable();
            $table->text('note_visitor')->nullable();
            $table->string('company_name')->nullable();
            $table->string('pdf_nama')->nullable();
            $table->string('pdf_jabatan')->nullable();
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
