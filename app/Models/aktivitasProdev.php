<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aktivitasProdev extends Model
{
	use HasFactory;
	protected $table = 'aktivitas_prodevs';
	protected $primaryKey = 'id';
	public $incrementing = false;
	public $timestamps = false;

	protected $guarded = [];
}
