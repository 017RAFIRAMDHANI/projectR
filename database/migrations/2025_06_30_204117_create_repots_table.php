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
        Schema::create('repots', function (Blueprint $table) {
            $table->increments('id_repot');
            $table->unsignedInteger('id_akun')->nullable();
            $table->string('type')->nullable();
            $table->string('name_akun_download')->nullable();
            $table->string('schedule')->nullable();
            $table->string('name')->nullable();
            $table->string('name_file_pdf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repots');
    }
};
