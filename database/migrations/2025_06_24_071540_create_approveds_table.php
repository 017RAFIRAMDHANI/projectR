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
        Schema::create('approveds', function (Blueprint $table) {
            $table->increments('id_approved');
            $table->unsignedInteger('id_vendor')->nullable();
            $table->unsignedInteger('id_visitor')->nullable();
            $table->string('type')->nullable();
            // $table->string('validity_date_from')->nullable();
            // $table->string('validity_date_to')->nullable();

            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approveds');
    }
};
