<?php

namespace App\Http\Repository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class bVisitRepositoryImpl implements bVisitRepositoryInterface
{
    public function getMaxnumberVisit()
    {
        return  DB::connection('sqlsrv3')->table("Visit")
        ->select('ID')
        ->orderBy('ID', 'desc')->first();
    }
    public function getRegistrationActivebyMedrec($medrec)
    {
        return  DB::connection('sqlsrv3')->table("Visit")
        ->select('Status ID','NoEpisode')
        ->where('NoMR',$medrec)
        ->where('batal','0')
        ->where('Status ID','<>','4')
        ->orderBy('ID', 'desc')->first();
    }
    public function getRegistrationLastByDate($tglregistrasi,$codeRegAwal){
        return  DB::connection('sqlsrv3')->table("Visit")
        ->select('NoRegistrasi','NoEpisode',DB::raw("right( REPLACE(NoRegistrasi,'-','0') ,4) as urutregx"),
                    DB::raw("right( REPLACE(NoEpisode,'-','0')  ,4) as noepisodex"))
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"),$tglregistrasi)  
        ->where(DB::raw("LEFT(NoRegistrasi,4)"),$codeRegAwal)   
        ->orderBy('id', 'desc')->first();
        
    }
    public function getActiveRegistrationToday($NoMR,$IdGrupPerawatan,$IdDokter,$shift,$ApmDate)
    {
        return  DB::connection('sqlsrv3')->table("Visit")
        ->select('Status ID','NoEpisode','NoRegistrasi')
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), TglKunjungan, 111), '/','-')"),$ApmDate)  
        ->where('NoMR',$NoMR)   
        ->where('Status ID','<>','4')   
        ->where('unit',$IdGrupPerawatan)   
        ->where('Doctor_1',$IdDokter)   
        ->where('JamPraktek',$shift)   
        ->orderBy('id', 'desc')->first();
    }
    public function  addRegistrationRajal($ID,$NoEpisode,$NoRegistrasi,$LokasiPasien,$NoMR,
                                            $PatientType,$Unit,$Doctor_1,$Antrian,$NoAntrianAll,
                                            $Company,$JamPraktek,$TelemedicineIs,$TglKunjungan,
                                            $visitdate,$Operator,$CaraBayar,$Perusahaan,$idCaraMasuk,
                                            $idAdmin,$Tipe_Registrasi,$ID_JadwalPraktek)
    {
        return  DB::connection('sqlsrv3')->table("Visit")->insert([
            'ID' => $ID,
            'NoEpisode' => $NoEpisode,
            'NoRegistrasi' =>  $NoRegistrasi,
            'LokasiPasien' => $LokasiPasien,
            'NoMR' =>  $NoMR,
            'PatientType' => $PatientType,
            'Unit' =>  $Unit,
            'Doctor_1' => $Doctor_1,
            'Antrian' =>  $Antrian,
            'NoAntrianAll' => $NoAntrianAll,
            'Company' => $Company, 
            'JamPraktek' => $JamPraktek, 
            'TelemedicineIs' => $TelemedicineIs, 
            'TglKunjungan' => $TglKunjungan, 
            'Visit Date' => $visitdate, 
            'Operator' => $Operator, 
            'CaraBayar' => $CaraBayar, 
            'Perusahaan' => $Perusahaan, 
            'idCaraMasuk' => $idCaraMasuk, 
            'idAdmin' => $idAdmin, 
            'Tipe_Registrasi' => $Tipe_Registrasi, 
            'ID_JadwalPraktek' => $ID_JadwalPraktek
        ]);
    }
    public function addTaskOneBPJS($KODE_TRANSAKSI,$WAKTU,$TASK_ID,$DATE_CREATE)
    {
        return  DB::connection('sqlsrv3')->table("Visit")->insert([
            'KODE_TRANSAKSI' => $KODE_TRANSAKSI,
            'WAKTU' => $WAKTU,
            'TASK_ID' =>  $TASK_ID,
            'DATE_CREATE' => $DATE_CREATE
        ]);
    }
}
