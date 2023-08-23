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
        Schema::create('exhibitions_pictures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exhibition_id');
            $table->foreign('exhibition_id')->references('id')->on('exhibitions')->onDelete('cascade');
            $table->unsignedBigInteger('picture_id');
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibitions_pictures');
    }
};
