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
        Schema::create('parking_lot_comments', function (Blueprint $table) {
            $table->id('comment_id');
            $table->longText("content");
            $table->timestamps();
            $table->string('parking_lot_id');
            $table->foreign('parking_lot_id')->references('parking_lot_id')->on('parking_lots')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_lot_comments');
    }
};
