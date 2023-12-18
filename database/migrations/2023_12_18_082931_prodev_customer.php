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
		Schema::create('prodevCustomer', function (Blueprint $table) {
			$table->string('kode_customer', 20)->primary();
			$table->string('provinsi', 40);
			$table->string('kota', 40);
			$table->string('nama_toko', 90);
			$table->string('tipe_customer', 20);
			$table->string('kode_area', 20);
			$table->string('kode_amm', 20);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('prodevCustomer');
	}
};
