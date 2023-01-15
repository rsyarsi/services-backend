<?php

namespace App\Http\Repository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class bAntrianRepositoryImpl implements bAntrianRepositoryInterface
{ 
    public function getMaxAntrianPoli($tglbookingfix,$NamaSesion,$IdDokter){
        return  DB::connection('sqlsrv3')->table("AntrianPasien")
        ->select('Antrian')
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"),$tglbookingfix)   
        ->where('JamPraktek', $NamaSesion)
        ->where('Doctor_1', $IdDokter)  
        ->orderBy('Antrian', 'desc')->first();
    }
    public function insertAntrian($nobokingreal,$IdDokter,$NamaSesion,$idno_urutantrian,$fixNoAntrian,$tglbookingfix,$Company)
    {
        return  DB::connection('sqlsrv3')->table("AntrianPasien")->insert([
            'no_transaksi' => $nobokingreal, 
            'Doctor_1' => $IdDokter,
            'JamPraktek' => $NamaSesion, 
            'Antrian' => $idno_urutantrian, 
            'noAntrianAll' => $fixNoAntrian, 
            'TglKunjungan' => $tglbookingfix, 
            'Company' => $Company
        ]);
    }
    public function getAntrianPoliByDateDoctor($tglbookingfix,$NamaSesion,$IdDokter){
        return  DB::connection('sqlsrv3')->table("AntrianPasien")
        ->select(DB::raw('COUNT(StatusAntrian)  as  BlmPanggil'))
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"),$tglbookingfix)   
        ->where('JamPraktek', $NamaSesion)
        ->where('doctor_1', $IdDokter) 
        ->where('batal', '0')->get();
    }
    public function getAntrianPoliCalledByDateDoctor($tglbookingfix,$NamaSesion,$IdDokter){
        return  DB::connection('sqlsrv3')->table("AntrianPasien")
        ->select(DB::raw('COUNT(StatusAntrian)  as  SdhPanggil'))
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"),$tglbookingfix)   
        ->where('JamPraktek', $NamaSesion)
        ->where('doctor_1', $IdDokter) 
        ->where('batal', '0')
        ->where('StatusAntrian', '1')
        ->get();
    }
    public function getAntrianPoliCurrentByDateDoctor($tglbookingfix,$NamaSesion,$IdDokter){
 
        return  DB::connection('sqlsrv3')->table("AntrianPasien")
        ->select('noAntrianAll')
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"),$tglbookingfix)   
        ->where('JamPraktek', $NamaSesion)
        ->where('doctor_1', $IdDokter) 
        ->where('batal', '0')
        ->where('StatusAntrian', '1')
        ->orderBy('Antrian', 'desc')->first();
    }
    public function getAntrianbyKodeBooking($nobooking)
    {
        return  DB::connection('sqlsrv3')->table("AntrianPasien")
        ->select('StatusAntrian','no_transaksi','noAntrianAll','batal') 
        ->where('no_transaksi', $nobooking)  
        ->get();
    }
    public function voidAntrian($nobooking)
    {
        return DB::connection('sqlsrv3')->table('AntrianPasien')
            ->where('no_transaksi', $nobooking)
            ->update([
            'batal' => '1' 
        ]); 
    }
}
