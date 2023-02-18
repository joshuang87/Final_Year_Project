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
        Schema::create('cars', function (Blueprint $table) {
            $table->string('car_plate')->primary();
            $table->string('phone_number');
            $table->timestamps();
            $table->foreignId('client_id')->constrained('clients','client_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('reserve_id');
            $table->foreign('reserve_id')->references('reserve_id')->on('clients')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
