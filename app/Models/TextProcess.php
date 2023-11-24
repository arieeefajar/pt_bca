<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextProcess extends Model
{
	use HasFactory;

	protected $table = 'text_process';

	protected $fillable = ['data', 'id_produk'];

	public function produkProdev()
	{
		return $this->belongsTo(ProdukProdev::class, 'id_produk', 'id_produk');
	}
}
