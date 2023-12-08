<?php

namespace App\Http\Repository;
 
use Illuminate\Support\Facades\DB;

class bAntrianPoliklinikRepositoryImpl implements bAntrianPoliklinikRepositoryInterface
{
    public function ListDataAntrian($request)
    {
        $booking =  DB::connection('sqlsrv3')
        ->table('AntrianPoli_Booking')
        ->select('id','no_transaksi','NoRegistrasi','noAntrianAll',
                'status_dipanggil','status_regis','UnitPoli','CounterName','Side') 
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $request->tanggalKunjungan)
        ->where('Doctor_1', $request->kodeDokter)
        ->where('UnitPoli', $request->KodeUnit);
        $registrasi = DB::connection('sqlsrv3')
                    ->table('AntrianPoli_Registrasi')
                    ->select('id','no_transaksi','NoRegistrasi','noAntrianAll','status_dipanggil','status_regis','UnitPoli','CounterName','Side')  
                    ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"), $request->tanggalKunjungan)
                    ->where('Doctor_1', $request->kodeDokter)
                    ->where('UnitPoli', $request->KodeUnit)
                    ->unionAll($booking)
                    ->orderBy('id', 'ASC')
                    ->get();
        return $registrasi;
    }
    public function UpdatePanggil($request){
        $updatesatuan =  DB::connection('sqlsrv3')->table('AntrianPasien')
        ->where('id', $request->IdAntrian)
            ->update([
                'StatusAntrian' => '1'
            ]);
        return $updatesatuan;
    }
    public function getAntrianPoliklinikbyId($request){
        return  DB::connection('sqlsrv3')
            ->table("AntrianPasien") 
            ->where('id',  $request->IdAntrian)
            ->where('batal', '0')
            ->get();
    }
    public function getUpdatedAntrianPoliklinikbyId($request){
        return  DB::connection('sqlsrv3')
            ->table("AntrianPoli_Registrasi") 
            ->where('id',  $request->IdAntrian)
            ->where('batal', '0')
            ->get();
    }
}