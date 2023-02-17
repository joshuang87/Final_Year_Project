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
        Schema::create('reserves', function (Blueprint $table) {
            $table->string('reserve_id')->primary();
            // $table->unsignedInteger('client_id');
            // $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
            $table->string('phone_number');
            // $table->foreign('car_plate')->references('car_plate')->on('cars')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserves');
    }
};
