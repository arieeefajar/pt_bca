<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_penyimpanan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('penyimpanan_id');
            $table->enum('pertanyaan', ['k_kepuasan', 'k_analisis', 'k_kekuatan_kelemahan', 'form_lahan', 'form_pesaing']);
            $table->string('api_id');
            $table->timestamps();
        });

        Schema::table('detail_penyimpanan', function (Blueprint $table) {
            $table->foreign('penyimpanan_id')->references('id')->on('penyimpanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_penyimpanan', function (Blueprint $table) {
            $table->dropForeign('detail_penyimpanan_penyimpanan_id_foreign');
        });

        Schema::dropIfExists('detail_penyimpanan');
    }

};
