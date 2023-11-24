<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukProdev extends Model
{
	use HasFactory;

	protected $table = 'produk_prodev';
	protected $primaryKey = 'id_produk';
	public $incrementing = false;
	public $timestamps = false;

	protected $guarded = [];

	public function prodev_sales()
	{
		return $this->hasMany(ProdevSales::class, 'id_produk', 'id_produk');
	}

	public function text_process()
	{
		return $this->hasMany(TextProcess::class, 'id_produk', 'id_produk');
	}
}
