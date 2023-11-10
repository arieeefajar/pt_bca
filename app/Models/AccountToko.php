<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class AccountToko extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'akun_toko';

    protected $fillable = [
        'id',
        'nama_toko',
        'no_telp',
        'address',
        'password'
    ];
}
