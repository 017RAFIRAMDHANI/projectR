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
$table->string('company_name', 255)->nullable();
$table->string('company_contact', 255)->nullable();
$table->string('requestor_name', 255)->nullable();
$table->string('phone_number', 15)->nullable();
$table->string('validity_date_from')->nullable();
$table->string('validity_date_to')->nullable();
$table->text('work_description')->nullable();
$table->string('building')->nullable();
$table->string('level')->nullable();
$table->string('specific_location')->nullable();
$table->string('vehicle_types')->nullable();
$table->string('number_plate')->nullable();

    $table->text('worker1_name')->nullable();
    $table->text('worker1_id_card')->nullable();
    $table->text('worker2_name')->nullable();
    $table->text('worker2_id_card')->nullable();
    $table->text('worker3_name')->nullable();
    $table->text('worker3_id_card')->nullable();
    $table->text('worker4_name')->nullable();
    $table->text('worker4_id_card')->nullable();
    $table->text('worker5_name')->nullable();
    $table->text('worker5_id_card')->nullable();
    $table->text('worker6_name')->nullable();
    $table->text('worker6_id_card')->nullable();
    $table->text('worker7_name')->nullable();
    $table->text('worker7_id_card')->nullable();
    $table->text('worker8_name')->nullable();
    $table->text('worker8_id_card')->nullable();
    $table->text('worker9_name')->nullable();
    $table->text('worker9_id_card')->nullable();
    $table->text('worker10_name')->nullable();
    $table->text('worker10_id_card')->nullable();
    $table->text('worker11_name')->nullable();
    $table->text('worker11_id_card')->nullable();
    $table->text('worker12_name')->nullable();
    $table->text('worker12_id_card')->nullable();
    $table->text('worker13_name')->nullable();
    $table->text('worker13_id_card')->nullable();
    $table->text('worker14_name')->nullable();
    $table->text('worker14_id_card')->nullable();
    $table->text('worker15_name')->nullable();
    $table->text('worker15_id_card')->nullable();
    $table->text('worker16_name')->nullable();
    $table->text('worker16_id_card')->nullable();
    $table->text('worker17_name')->nullable();
    $table->text('worker17_id_card')->nullable();
    $table->text('worker18_name')->nullable();
    $table->text('worker18_id_card')->nullable();
    $table->text('worker19_name')->nullable();
    $table->text('worker19_id_card')->nullable();
    $table->text('worker20_name')->nullable();
    $table->text('worker20_id_card')->nullable();
    $table->text('worker21_name')->nullable();
    $table->text('worker21_id_card')->nullable();
    $table->text('worker22_name')->nullable();
    $table->text('worker22_id_card')->nullable();
    $table->text('worker23_name')->nullable();
    $table->text('worker23_id_card')->nullable();
    $table->text('worker24_name')->nullable();
    $table->text('worker24_id_card')->nullable();
    $table->text('worker25_name')->nullable();
    $table->text('worker25_id_card')->nullable();
    $table->text('worker26_name')->nullable();
    $table->text('worker26_id_card')->nullable();
    $table->text('worker27_name')->nullable();
    $table->text('worker27_id_card')->nullable();
    $table->text('worker28_name')->nullable();
    $table->text('worker28_id_card')->nullable();
    $table->text('worker29_name')->nullable();
    $table->text('worker29_id_card')->nullable();
    $table->text('worker30_name')->nullable();
    $table->text('worker30_id_card')->nullable();

$table->string('generate_dust')->nullable();
$table->string('fire_system')->nullable();
$table->string('isolation_of')->nullable();
$table->string('isolation_name')->nullable();
$table->string('isolation_date')->nullable();
$table->string('up_id_card_foto')->nullable();
$table->string('file_mos')->nullable();
$table->string('primary_number', 255)->nullable();
            $table->integer('check_one_approve')->nullable();
            $table->string('permit_number', 255)->nullable();
            $table->string('status')->nullable();
            $table->string('mode')->nullable();
            $table->timestamps();
        });
    }

    /** 83
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
