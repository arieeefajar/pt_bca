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
        schema::create('penyimpanan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('daerah_id');
            $table->string('nama');
            $table->string('alamat');
            $table->integer('umur');
            $table->string('no_telepon');
            $table->unsignedInteger('posisi_id');
            $table->unsignedBigInteger('perusahaan_id');
            $table->date('tanggal')->default(now());
            $table->timestamps();
        });
        Schema::table('penyimpanan', function (Blueprint $table) {
            $table->foreign('daerah_id')->references('id')->on('daerah');
            $table->foreign('posisi_id')->references('id')->on('posisi');
            $table->foreign('perusahaan_id')->references('id')->on('perusahaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyimpanan', function (Blueprint $table) {
            $table->dropForeign('detail_penyimpanan_posisi_id_foreign');
            $table->dropForeign('detail_penyimpanan_perusahaan_id_foreign');
        });
        Schema::dropIfExists('penyimpanan');
    }
};
