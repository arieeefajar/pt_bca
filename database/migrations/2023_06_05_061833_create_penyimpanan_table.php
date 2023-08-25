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
        schema::create('penyimpanan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('surveyor_id');
            $table->unsignedBigInteger('customer_id');
            $table->enum('status', [1, 2]);
            $table->timestamps();
        });
        Schema::table('penyimpanan', function (Blueprint $table) {
            $table->foreign('surveyor_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyimpanan', function (Blueprint $table) {
            $table->dropForeign('detail_penyimpanan_custommer_id_foreign');
        });
        Schema::dropIfExists('penyimpanan');
    }
};
