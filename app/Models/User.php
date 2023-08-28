<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'no_telp',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getCustommer()
    {
        $customers = Customer::select('customer.id', 'customer.nama')
            ->leftJoin('wilayah', 'customer.wilayah_id', '=', 'wilayah.id')
            ->leftJoin('wilayah_survey', 'wilayah.id', '=', 'wilayah_survey.wilayah_id')
            ->leftJoin('users', 'wilayah_survey.surveyor_id', '=', 'users.id')
            ->where('users.role', '=', 'user')
            ->where('users.id', '=', Auth::user()->id)
            ->get();

        return $customers;
    }

    public function penyimpanan()
    {
        return $this->hashMany(Penyimpanan::class, 'id', 'surveyor_id');
    }
}
