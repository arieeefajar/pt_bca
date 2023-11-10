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
        Schema::create('jenis_benih', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_benih_id');
            $table->foreign('produk_benih_id')->references('id')->on('produk_benih');
            $table->string('nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_benih');
    }
};
