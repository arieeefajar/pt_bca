<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
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
        'nip',
        'position',
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
    protected $hidden = ['password', 'remember_token'];

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
        // Mendapatkan tanggal awal bulan ini
        $startDate =
            Carbon::now()
                ->startOfMonth()
                ->format('Y-m-d') . ' 00:00:00';

        // Mendapatkan tanggal akhir bulan ini
        $endDate =
            Carbon::now()
                ->endOfMonth()
                ->format('Y-m-d') . ' 23:59:59';

        $customer = Customer::select(
            'customer.id',
            'customer.nama',
            'penyimpanan.surveyor_id'
        )
            ->leftJoin('kota', 'customer.kota_id', '=', 'kota.id')
            ->leftJoin(
                'wilayah_survey',
                'kota.id',
                '=',
                'wilayah_survey.kota_id'
            )
            ->leftJoin('users', 'wilayah_survey.surveyor_id', '=', 'users.id')
            ->leftJoin('penyimpanan', function ($join) use (
                $startDate,
                $endDate
            ) {
                $join
                    ->on('penyimpanan.customer_id', '=', 'customer.id')
                    ->where('penyimpanan.status', '=', 1)
                    ->whereBetween('penyimpanan.created_at', [
                        $startDate,
                        $endDate,
                    ]);
            })
            ->where('users.role', '=', 'user')
            ->where('users.id', '=', Auth::user()->id)
            ->whereNull('penyimpanan.id')
            ->get();

        $customers = [];
        // get data penyimpanan yang ada sebagian jawaban
        foreach ($customer as $value) {
            $data = Penyimpanan::where('customer_id', '=', $value->id)
                ->whereNot('surveyor_id', '=', Auth::user()->id)
                ->first();
            if ($data) {
                $dataDetail = DetailPenyimpanan::where(
                    'penyimpanan_id',
                    '=',
                    $data->id
                )->first();
                if (!$dataDetail) {
                    array_push($customers, $value);
                    // dd($data, $dataDetail);
                }
            } else {
                array_push($customers, $value);
            }
        }
        // dd($customers);

        return $customers;
    }

    public function penyimpanan()
    {
        return $this->hasMany(Penyimpanan::class, 'surveyor_id', 'id');
    }

    public function wilayah_survey()
    {
        return $this->hasMany(Wilayah_survey::class, 'surveyor_id', 'id');
    }
}
