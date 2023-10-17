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
        Schema::create('wilayah_survey', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kota_id');
            $table->foreign('kota_id')->references('id')->on('kota');
            $table->unsignedBigInteger('surveyor_id');
            $table->foreign('surveyor_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayah_survey');
    }
};
