<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // * PATTERN
        // form potensi lahan, form pesaing => allowed all access
        // kuisioner kepuasan pelanggan => allowed: Petani Pengguna
        // kuisioner analisis pesaing, kekuatan kelemahan pesaing, skala pasar product => allowed: Master Dealer, Dealer, Kios
        
        $routeName = $request->route()->getName();
        $jenisCustommer = request()->cookie('kategoriToko');
        
        // apabila belum pilih toko
        if (!$jenisCustommer) {
            return redirect()->back();
        }
        
        $allowedRoutes_PetaniPengguna = ['kepuasanPelanggan.index'];
        $allowedRoutes_MasterDealer_Dealer_Kios = ['analisisPesaing.index', 'KekuatanDanKelemahanPesaing.index', 'SkalaPasarProduk.index'];

        // kepuasan pelanggan
        if (in_array($routeName, $allowedRoutes_PetaniPengguna)) {
            if ($jenisCustommer === 'petani_pengguna') {
                return $next($request); // lanjutkan apabila petani pengguna
            }
            return redirect()->back(); // tolak jika bukan petani pengguna
        }

        // analisis pesaing, kekuatan kelemahan, skala pasar
        if (in_array($routeName, $allowedRoutes_MasterDealer_Dealer_Kios)) {

            $roleCustommerAllowed = ['master_dealer', 'dealer', 'kios'];

            if (in_array($jenisCustommer, $roleCustommerAllowed)) {
                return $next($request); // lanjutkan apabila role custommer sesuai
            }
            return redirect()->back();
        }

        return $next($request); // hanya tersisa Form lahan dan pesaing maka lanjutkan
    }
}
