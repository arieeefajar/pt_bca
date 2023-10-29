<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
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
        $kategory_custommer = request()->cookie('kategoriToko');
        $answer_type = [];

        if ($kategory_custommer == 'petani_pengguna'){
            $answer_type = ['k_kepuasan', 'form_lahan', 'form_pesaing'];
        } elseif ($kategory_custommer == 'kios') {
            $answer_type = ['k_analisis', 'k_kekuatan_kelemahan','skala_pasar']; // form_lahan, form_pesaing => optional 
        } elseif ($kategory_custommer == 'master_dealer') {
            $answer_type = ['k_analisis', 'k_kekuatan_kelemahan','skala_pasar']; // form_lahan, form_pesaing => optional 
        } elseif ($kategory_custommer == 'dealer') {
            $answer_type = ['k_analisis', 'k_kekuatan_kelemahan','skala_pasar']; // form_lahan, form_pesaing => optional 
        } elseif ($kategory_custommer == 'lahan_petani') {
            $answer_type = ['form_lahan', 'form_pesaing'];
        }

        // Mendapatkan tanggal awal bulan ini
        $startDate =  Carbon::now()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
        // Mendapatkan tanggal akhir bulan ini
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';
        
        foreach ($answer_type as $value) {
            $data = Penyimpanan::leftJoin('detail_penyimpanan', 'penyimpanan.id', '=', 'detail_penyimpanan.penyimpanan_id')
                ->select('penyimpanan.id AS id_penyimpanan', 'detail_penyimpanan.id AS id_detail_penyimpanan')
                ->where('penyimpanan.surveyor_id', Auth::user()->id)
                ->where('detail_penyimpanan.pertanyaan', $value)
                ->where('penyimpanan.customer_id', $request->cookie('selectedTokoId'))
                ->whereBetween('penyimpanan.created_at', [$startDate, $endDate])
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
