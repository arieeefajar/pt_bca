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
		Schema::create('produk_prodev', function (Blueprint $table) {
			$table->string('id_produk', 8)->primary();
			$table->string('nama_produk', 20);
			$table->string('jenis_tanaman', 20);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('produk_prodev');
	}
};
