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
            // $table->integer('price')->default(50);
            $table->string('car_plate');
            $table->string('phone_number');
            $table->string('email');
            $table->string('parking_space_id');
            $table->string('parking_lot_id');
            $table->date('date');
            $table->time('time');
            $table->string('duration');
            $table->timestamps();
            // $table->foreign('car_plate')->references('car_plate')->on('cars')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('client_id');
            // $table->foreign('client_id')->references('client_id')->on('clients')->cascadeOnUpdate()->cascadeOnDelete();
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