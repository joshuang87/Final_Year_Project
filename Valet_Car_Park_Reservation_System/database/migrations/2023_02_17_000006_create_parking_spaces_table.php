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
            $table->time('open_time')->default("08:00:00");
            $table->time('close_time')->default("23:30:00");
            $table->timestamps();
            $table->string('parking_lot_id');
            $table->foreign('parking_lot_id')->references('parking_lot_id')->on('parking_lots')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('status')->default(true);

            $table->integer('x');
            $table->integer('y');
            $table->integer('w')->default(1);
            $table->integer('h')->default(2);
            $table->string('i');
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
