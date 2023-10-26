<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Penyimpanan extends Model
{
    use HasFactory;

    protected $table = 'penyimpanan';

    protected $fillable = [
        'surveyor_id',
        'customer_id',
        'status',
        'created_at'
    ];

    public static function hasDonePenyimpanan($request)
    {
        $answer_type = ['k_kepuasan', 'k_analisis', 'k_kekuatan_kelemahan', 'form_lahan', 'form_pesaing', 'skala_pasar'];

        foreach ($answer_type as $value) {
            $data = Penyimpanan::leftJoin('detail_penyimpanan', 'penyimpanan.id', '=', 'detail_penyimpanan.penyimpanan_id')
                ->select('penyimpanan.id AS id_penyimpanan', 'detail_penyimpanan.id AS id_detail_penyimpanan')
                ->where('penyimpanan.surveyor_id', Auth::user()->id)
                ->where('detail_penyimpanan.pertanyaan', $value)
                ->where('penyimpanan.customer_id', $request->cookie('selectedTokoId'))
                ->get();

            if (count($data) <= 0) {
                return false;
            }
        }

        return true;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function detail_penyimpanan()
    {
        return $this->hasMany(DetailPenyimpanan::class, 'penyimpanan_id', 'id');
    }

    public function surveyor()
    {
        return $this->belongsTo(User::class, 'surveyor_id', 'id');
    }
}
