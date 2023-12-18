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
		Schema::create('aktivitas_prodevs', function (Blueprint $table) {
			$table->string('id', 20);
			$table->string('nama_kegiatan', 40);
			$table->string('tanggal', 40);
			$table->string('kode_customer', 90);
			$table->string('nama_produk', 20);
			$table->string('id_produk', 20);
			$table->string('nama_toko', 90);
			$table->string('nip', 20);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('aktivitas_prodevs');
	}
};
