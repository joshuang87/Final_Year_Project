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
        Schema::create('parking_spaces', function (Blueprint $table) {
            $table->string('parking_space_id')->primary();
            $table->dateTime('open_time')->nullable()->default(null);
            $table->dateTime('close_time')->nullable()->default(null);
            $table->timestamps();
            $table->string('parking_lot_id');
            $table->foreign('parking_lot_id')->references('parking_lot_id')->on('parking_lots')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('car_plate')->nullable()->default(null);
            $table->foreign('car_plate')->references('car_plate')->on('cars')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('client_id')->nullable()->default(null);
            $table->foreign('client_id')->references('client_id')->on('clients')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_spaces');
    }
};
