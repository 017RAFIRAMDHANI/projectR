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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id_vehicle');  // Primary key
            $table->string('name')->nullable();
            $table->string('number_plate')->nullable();
            $table->string('type')->nullable();
            $table->string('company')->nullable();
            $table->string('date_from')->nullable();
            $table->string('date_to')->nullable();
            $table->string('status')->nullable();
            $table->unsignedInteger('id_visitor')->nullable();
            $table->unsignedInteger('id_vendor')->nullable();
            $table->unsignedInteger('id_employe')->nullable();

            $table->foreign('id_visitor')->references('id_visitor')->on('visitors')->onDelete('cascade');
            $table->foreign('id_vendor')->references('id_vendor')->on('vendors')->onDelete('cascade');
             $table->foreign('id_employe')->references('id_employe')->on('employes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
