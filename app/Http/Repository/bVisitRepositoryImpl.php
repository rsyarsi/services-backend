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
    public function getRegistrationRajalbyMedreActive($medrec)
    {
        //a
        return  DB::connection('sqlsrv6')->table("dataRWJ")
        ->select('NoAntrianAll','NamaJaminan','PatientName',DB::raw("CASE WHEN Sex='L' then 'M' ELSE 'F' END AS Gander") ,
        DB::raw("replace(CONVERT(VARCHAR(11), DateOfBirth, 111), '/','-') as Date_of_birth") , 
        'Address',   'IdUnit', DB::raw("[Visit Date] AS Visit_Date"), 'NamaUnit',   'IdDokter', 'NamaDokter','NoMR','NoEpisode','NoRegistrasi',
        DB::raw("case when TipePasien='1' THEN 'PRIBADI' WHEN TipePasien='2' THEN 'ASURANSI' WHEN TipePasien='5' THEN 'PERUSAHAAN' END 
        AS  PatientType"),'StatusID')
        ->where('NoMR',$medrec)
         ->where('StatusID','<',4)
        ->orderBy('Visit Date', 'desc')
        ->get();
    }
    public function getRegistrationRajalbyMedreHistory($request)
    {
        //a
        return  DB::connection('sqlsrv6')->table("dataRWJ")
        ->select( 'NoAntrianAll', 'NamaJaminan','StatusID','PatientName',DB::raw("CASE WHEN Sex='L' then 'M' ELSE 'F' END AS Gander") ,
        DB::raw("replace(CONVERT(VARCHAR(11), DateOfBirth, 111), '/','-') as Date_of_birth") , 
        'Address',   'IdUnit', DB::raw("[Visit Date] AS Visit_Date"), 'NamaUnit',   'IdDokter', 'NamaDokter','NoMR','NoEpisode','NoRegistrasi',
        DB::raw("case when TipePasien='1' THEN 'PRIBADI' WHEN TipePasien='2' THEN 'ASURANSI' WHEN TipePasien='5' THEN 'PERUSAHAAN' END 
        AS  PatientType"),'StatusID')
        ->where('NoMR',$request->medrec)
         ->where('StatusID','4')
         ->whereBetween(DB::raw("replace(CONVERT(VARCHAR(11), [Visit Date], 111), '/','-')"),
         [$request->tglPeriodeBerobatAwal,$request->tglPeriodeBerobatAkhir])  
        ->orderBy('Visit Date', 'desc')
        ->get();
    }
    public function getRegistrationRajalbyDoctorActive($NamaDokter)
    {
        //a
        return  DB::connection('sqlsrv6')->table("dataRWJ")
        ->select('NoAntrianAll',  'NamaJaminan','PatientName',DB::raw("CASE WHEN Sex='L' then 'M' ELSE 'F' END AS Gander") ,
        DB::raw("replace(CONVERT(VARCHAR(11), DateOfBirth, 111), '/','-') as Date_of_birth") , 
        'Address',   'IdUnit', DB::raw("[Visit Date] AS Visit_Date"), 'NamaUnit',   'IdDokter', 'NamaDokter','NoMR','NoEpisode','NoRegistrasi',
        DB::raw("case when TipePasien='1' THEN 'PRIBADI' WHEN TipePasien='2' THEN 'ASURANSI' WHEN TipePasien='5' THEN 'PERUSAHAAN' END 
        AS  PatientType"),'StatusID')
        ->where('NamaDokter',$NamaDokter)
         ->where('StatusID','<',4)
        ->orderBy('Visit Date', 'desc')
        ->get();
    }
    public function getRegistrationRajalbyDoctorHistory($request)
    {
        //a
        return  DB::connection('sqlsrv6')->table("dataRWJ")
        ->select('NoAntrianAll', 'NamaJaminan','StatusID','PatientName',DB::raw("CASE WHEN Sex='L' then 'M' ELSE 'F' END AS Gander") ,
        DB::raw("replace(CONVERT(VARCHAR(11), DateOfBirth, 111), '/','-') as Date_of_birth") , 
        'Address',   'IdUnit',  DB::raw("[Visit Date] AS Visit_Date"), 'NamaUnit',   'IdDokter', 'NamaDokter','NoMR','NoEpisode','NoRegistrasi',
        DB::raw("case when TipePasien='1' THEN 'PRIBADI' WHEN TipePasien='2' THEN 'ASURANSI' WHEN TipePasien='5' THEN 'PERUSAHAAN' END 
        AS  PatientType"),'StatusID')
        ->where('NamaDokter',$request->NamaDokter)
        ->where('StatusID','4')
        ->whereBetween(DB::raw("replace(CONVERT(VARCHAR(11), [Visit Date], 111), '/','-')"),
        [$request->tglPeriodeBerobatAwal,$request->tglPeriodeBerobatAkhir])  
        ->orderBy('Visit Date', 'desc')
        ->get();
    }
    public function getRegistrationRajalbyNoreg($NoRegistrasi)
    {
        //a
        return  DB::connection('sqlsrv6')->table("dataRWJ")
        ->select( 'NoAntrianAll', 'NamaJaminan','PatientName',DB::raw("CASE WHEN Sex='L' then 'M' ELSE 'F' END AS Gander") ,
        DB::raw("replace(CONVERT(VARCHAR(11), DateOfBirth, 111), '/','-') as Date_of_birth") , 
        'Address',   'IdUnit',  DB::raw("[Visit Date] AS Visit_Date"), 'NamaUnit',   'IdDokter', 'NamaDokter','NoMR','NoEpisode','NoRegistrasi',
        DB::raw("case when TipePasien='1' THEN 'PRIBADI' WHEN TipePasien='2' THEN 'ASURANSI' WHEN TipePasien='5' THEN 'PERUSAHAAN' END 
        AS  PatientType"),'StatusID')
        ->where('NoRegistrasi', $NoRegistrasi) 
        ->orderBy('Visit Date', 'desc')
        ->get();
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
        ->where('Batal','0')
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
    public function  addRegistrationRajalAsuransi($ID,$NoEpisode,$NoRegistrasi,$LokasiPasien,$NoMR,
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
            'Asuransi' => $Perusahaan, 
            'idCaraMasuk' => $idCaraMasuk, 
            'idAdmin' => $idAdmin, 
            'Tipe_Registrasi' => $Tipe_Registrasi, 
            'ID_JadwalPraktek' => $ID_JadwalPraktek
        ]);
    }
    public function addTaskOneBPJS($KODE_TRANSAKSI,$WAKTU,$TASK_ID,$DATE_CREATE)
    {
        return  DB::connection('sqlsrv3')->table("BPJS_TASKID_LOG")->insert([
            'KODE_TRANSAKSI' => $KODE_TRANSAKSI,
            'WAKTU' => $WAKTU,
            'TASK_ID' =>  $TASK_ID,
            'DATE_CREATE' => $DATE_CREATE
        ]);
    }
    public function viewByNoBooking($NoBooking)
    {
        //a
        return  DB::connection('sqlsrv3')->table("View_Visit_by_Booking") 
        ->where('NoBooking', $NoBooking)  
        ->get();
    }
}

