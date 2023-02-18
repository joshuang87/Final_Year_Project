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
        Schema::create('clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->string('phone_number');
            $table->string('car_plate')->unique();
            $table->string('reserve_id')->default(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10))->unique(); // generate a uniqid code with alphabet and integer like : jho2b31h
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
