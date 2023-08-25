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
        Schema::create('parking_space_statuses', function (Blueprint $table) {
            $table->id();
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('availability');
            $table->string('email');
            $table->string('car_plate');
            $table->foreign('car_plate')->references('car_plate')->on('cars')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->string('parking_lot_id');
            $table->foreign('parking_lot_id')->references('parking_lot_id')->on('parking_spaces')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('parking_space_id');
            $table->foreign('parking_space_id')->references('parking_space_id')->on('parking_spaces')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_space_statuses');
    }
};
