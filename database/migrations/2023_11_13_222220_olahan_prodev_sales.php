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
        Schema::create('prodev_sales', function (Blueprint $table) {
            $table->string('id_transaksi', 8)->primary();
            $table->string('id_produk', 3);
            $table->string('nama_produk', 20);
            $table->date('tanggal');
            $table->string('tahun_jual', 4);
            $table->float('berat', 15);
            $table->string('kode_customer', 15);
            $table->string('nama_toko', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodev_sales');
    }
};
