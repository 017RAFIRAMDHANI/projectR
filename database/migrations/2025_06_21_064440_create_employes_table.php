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
        Schema::create('employes', function (Blueprint $table) {
          $table->increments('id_employe');  // Primary key
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('position')->nullable();
            $table->string('type')->nullable();
            $table->string('type2')->nullable();
            $table->string('number_plate')->nullable();
            $table->string('file_card')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
