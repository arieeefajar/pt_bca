<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdevSales extends Model
{
    use HasFactory;

    protected $table = 'prodev_sales';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = [];
}
