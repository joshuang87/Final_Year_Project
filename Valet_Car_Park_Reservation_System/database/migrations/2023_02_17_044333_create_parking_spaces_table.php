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
            $table->id('parking_space_id');
            $table->unsignedBigInteger('parking_lot_id');
            $table->foreign('parking_lot_id')->references('parking_lot_id')->on('parking_lots')->onDelete('cascade');
            $table->string('car_plate');
            $table->dateTime('open_time');
            $table->dateTime('close_time');
            $table->timestamps();
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
