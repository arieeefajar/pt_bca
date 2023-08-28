<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProduct extends Model
{
    use HasFactory;

    protected $table = 'custommer_produk';

    protected $fillable = [
        'id',
        'id_customer',
        'id_produk',
    ];
}
