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
        Schema::create('detail_record_survey_stock', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_survey_stock_id');
            $table->unsignedBigInteger('nama_produk_id');
            $table->unsignedBigInteger('produsen_benih_id');
            $table->integer('jumlah');
            $table->unsignedBigInteger('satuan_produk_id');
            $table->timestamps();
        });

        Schema::table('detail_record_survey_stock', function (Blueprint $table) {
            $table->foreign('record_survey_stock_id')->references('id')->on('record_survey_stock');
            $table->foreign('nama_produk_id')->references('id')->on('nama_produk_benih');
            $table->foreign('produsen_benih_id')->references('id')->on('produsen_benih');
            $table->foreign('satuan_produk_id')->references('id')->on('satuan_produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExdetail_ists('detail_record_survey_stock');
    }
};
