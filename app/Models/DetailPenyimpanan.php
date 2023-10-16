<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DetailPenyimpanan extends Model
{
    use HasFactory;

    protected $table = 'detail_penyimpanan';

    protected $fillable = [
        'penyimpanan_id',
        'pertanyaan',
        'api_id',
        'created_at'
    ];

    public static function getIdPenyimpanan($request)
    {
        $startDate = Carbon::now(); //returns current day
        $firstDay = $startDate->startOfMonth()->format('Y-m-d') . ' 00:00:00';
        $lastDay = $startDate->endOfMonth()->format('Y-m-d') . ' 23:59:59';

        // cek apakah ada data penyimpanan dengan id surveyor dan toko yang di kunjungi pada bulan ini
        $records = Penyimpanan::whereBetween('created_at', [$firstDay, $lastDay])
            ->where('surveyor_id', Auth::user()->id)
            ->where('customer_id', $request->cookie('selectedTokoId')) //ambil data dari cookies
            ->get()
            ->toArray();

        // cek apakah data penyimpanan sudah ada apa belum
        if (count($records) == 0) {
            $penyimpananCreate = new Penyimpanan();
            $penyimpananCreate->surveyor_id = Auth::user()->id;
            $penyimpananCreate->customer_id = $request->cookie('selectedTokoId'); //ambil data dari cookies
            $penyimpananCreate->status = 2; // 1=true, 2=false
            $penyimpananCreate->save();

            $idPenyimpanan = $penyimpananCreate->id;
            return ($idPenyimpanan);
        } else {
            $idPenyimpanan = $records[0]['id'];
            return ($idPenyimpanan);
        }
    }

    public static function hasDetailPenyimpanan($idPenyimpanan, $jenis)
    {

        $startDate = Carbon::now(); //returns current day
        $firstDay = $startDate->startOfMonth()->format('Y-m-d') . ' 00:00:00';
        $lastDay = $startDate->endOfMonth()->format('Y-m-d') . ' 23:59:59';

        $records = DetailPenyimpanan::select('id', 'api_id')
            ->whereBetween('created_at', [$firstDay, $lastDay])
            ->where('penyimpanan_id', $idPenyimpanan)
            ->where('pertanyaan', $jenis)
            ->get()
            ->toArray();

        return $records;
    }
}
