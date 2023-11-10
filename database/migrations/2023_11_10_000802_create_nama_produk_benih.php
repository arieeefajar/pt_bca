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
        Schema::create('nama_produk_benih', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('benih_id');
            $table->foreign('benih_id')->references('id')->on('jenis_benih');
            $table->string('nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nama_produk_benih');
    }
};
