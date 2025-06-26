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
        Schema::create('historisafetis', function (Blueprint $table) {
            $table->increments('id_histori_safeti');
            $table->unsignedInteger('id_safeti')->nullable();
            $table->string('type')->nullable();
            $table->string('jenis_lampu')->nullable();
            $table->string('note')->nullable();
            $table->string('date_terbit')->nullable();
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->string('company')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historisafetis');
    }
};
