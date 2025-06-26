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
        Schema::create('safetis', function (Blueprint $table) {
            $table->increments('id_safeti');
            $table->unsignedInteger('id_visitor')->nullable();
            $table->unsignedInteger('id_vendor')->nullable();
            $table->unsignedInteger('id_employe')->nullable();
            $table->unsignedInteger('id_history_safeti')->nullable();
            $table->string('start_date')->nullable();
            $table->string('expired_date')->nullable();
            $table->string('status_safeti')->nullable();
            $table->string('type')->nullable();
            $table->string('lampu_green')->nullable();
            $table->string('lampu_yellow')->nullable();
            $table->string('lampu_red')->nullable();
            $table->string('catatan_lampu_green')->nullable();
            $table->string('date_lampu_green')->nullable();
            $table->string('catatan_lampu_yellow')->nullable();
            $table->string('date_lampu_yellow')->nullable();
            $table->string('catatan_lampu_red')->nullable();
            $table->string('date_lampu_red')->nullable();
            $table->string('file_gambar')->nullable();
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safetis');
    }
};
