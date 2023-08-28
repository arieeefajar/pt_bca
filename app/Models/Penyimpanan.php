<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyimpanan extends Model
{
    use HasFactory;

    protected $table = 'penyimpanan';

    protected $fillable = [
        'surveyor_id',
        'perusahaan_id',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function surveyor()
    {
        return $this->belongsTo(User::class, 'surveyor_id', 'id');
    }
}
