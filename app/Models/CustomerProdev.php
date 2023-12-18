<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProdev extends Model
{
	use HasFactory;
	protected $table = 'prodevcustomer';
	protected $primaryKey = 'kode_customer';
	public $incrementing = false;
	public $timestamps = false;

	protected $guarded = [];
}
