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
        Schema::create('profile_images', function (Blueprint $table) {
            $table->id(); // 添加自增主键列
            $table->string('profileImage'); // 添加存储头像路径的列
            $table->timestamps(); // 添加自动维护的 created_at 和 updated_at 列
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_images');
    }
};
