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
            $table->unsignedInteger('detail_quisioner_id');
            $table->integer('jawaban');
            $table->timestamps();
        });

        Schema::table('detail_penyimpanan', function (Blueprint $table) {
            $table->foreign('detail_quisioner_id')->references('id')->on('detail_quisioner');
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
            $table->dropForeign('detail_penyimpanan_detail_quisioner_id_foreign');
        });

        Schema::dropIfExists('detail_penyimpanan');
    }

};
