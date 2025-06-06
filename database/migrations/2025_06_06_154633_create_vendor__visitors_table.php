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
        Schema::create('vendor__visitors', function (Blueprint $table) {
          $table->increments('id_vendor_visitor');  // Primary key
            $table->unsignedInteger('id_vendor')->nullable();  // Gunakan unsignedInteger jika id_vendor adalah integer
            $table->unsignedInteger('id_visitor')->nullable();  // Gunakan unsignedInteger jika id_visitor adalah integer
            $table->string('type')->nullable();
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('id_vendor')->references('id_vendor')->on('vendors')->onDelete('cascade');
            $table->foreign('id_visitor')->references('id_visitor')->on('visitors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor__visitors');
    }
};
