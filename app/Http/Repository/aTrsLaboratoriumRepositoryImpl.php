<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class aTrsLaboratoriumRepositoryImpl implements aTrsLaboratoriumRepositoryInterface
{
    public function createHeader($request,$getNotrsLabNext,$datareg,$kelasid)
    {
        return  DB::connection('sqlsrv7')->table("tblLab")->insert([
            'OrderCode' => $request->CodeOrder,
            'RecID' => $getNotrsLabNext[0],
            'NoLAB' =>  $getNotrsLabNext[4],
            'LabDate' => $request->dateOrder, 
            'Dokter' =>  $datareg->IdDokter,
            'NoMR' => $datareg->NoMR,
            'NoEpisode' =>  $datareg->NoEpisode,
            'NoRegRI' => $request->NoRegistrasi,
            'KelasID' =>  $kelasid,
            'Operator' =>  '1',
            'StatusID' =>  '3',
            'JenisOrder' =>  $request->JenisOrder,
            'Diagnosa' =>  $request->Daignosa,
            'KeteranganKlinis' =>  $request->Keterangan_Klinik,
            'JamOrder' =>  date('H:i:s', strtotime($request->dateOrder)) 
           
        ]);
    }
    public function createDetail($request)
    {
        return  DB::connection('sqlsrv7')->table("tblLabDetail")->insert([
            'LabID' => $request->LabID,
            'IdTes' => $request->IdTes,
            'Tarif' =>  $request->NominalTarif,
            'Rate' => '1', 
            'TarifKelas' =>  $request->NominalTarif,
            'kode_test' => $request->KodeKelompokTes,
            'DokterJasa' =>  $request->IdDokter,
        ]);
    }
    public function getTrsLabDetail($request)
    {
        return  DB::connection('sqlsrv7')->table("View_OrderLab")
        ->select('LabID','OrderCode','LabDetailID','NoRegRI','NoLAB','NamaTes','KodeKelompok','jenisOrder') 
        ->where('NoLab',$request->NoTrsOrderLab)    
        ->get();
    }
    public function getTrsLabDetaiAllbyTrs($request)
    {
        return  DB::connection('sqlsrv7')->table("View_OrderLab")
        ->select('LabID','OrderCode','LabDetailID','NoRegRI','NoLAB','NamaTes','KodeKelompok','jenisOrder') 
        ->where('NoLab',$request->NoTrsOrderLab)    
        ->get();
    }
    public function getTrsLabHasReceived($request)
    {
        return  DB::connection('sqlsrv7')->table("tblLab")
        ->select('NoLab')
        ->where('NoLAB',$request->NoTrsOrderLab)  
        ->where('Receive_st','1')   
        ->get();
    }
    public function getMaxTblLab()
    {
        return  DB::connection('sqlsrv7')->table("tblLab")
        ->select('LabID','RecID')
        ->orderBy('LabID', 'desc')->first();

    }
    public function getMaxNOTrsOrderLab($tglOrder)
    {
        return  DB::connection('sqlsrv7')->table("tblLab")
        ->select('NoLab')
        ->where(DB::raw("left([NoLAB],6)"),$tglOrder)  
        ->orderBy('LabID', 'desc')
        ->get();
    }
    public function getTrsLabbyNoOrder($noOrderLab)
    {
        return  DB::connection('sqlsrv7')->table("tblLab")
        ->select('NoLAB','LabID','OrderCode','RecID','LabDate','NoMR','NoEpisode','NoRegRI','Dokter',
        'KelasID','Operator','TypePasien','StatusID','JenisOrder','Diagnosa','KeteranganKlinis','FlagPA','IncludePaket','lockBill')
        ->where('NoLAB',$noOrderLab)
        ->where('Batal','0') 
        ->get();
    }
    public function viewOrderLabbyMedrecPeriode($request)
    {
        return  DB::connection('sqlsrv7')->table("tblLab")
        ->select('NoLAB','LabID','OrderCode','RecID','LabDate','NoMR','NoEpisode','NoRegRI','Dokter',
        'KelasID','Operator','TypePasien','StatusID','JenisOrder','Diagnosa','KeteranganKlinis','FlagPA','IncludePaket','lockBill')
        ->where('NoMR',$request->NoMR)
        ->where('Batal','0') 
        ->whereBetween(DB::raw("replace(CONVERT(VARCHAR(11), LabDate, 111), '/','-')"),
        [$request->tglPeriodeBerobatAwal,$request->tglPeriodeBerobatAkhir])  
        ->get();
    }
    public function createHeaderLis($request,$datareg,$kelasid)
    {
        return  DB::connection('sqlsrv7')->table("LIS_Order")->insert([                          
            'NoMR' => $datareg->NoMR,
            'NoEpisode' =>  $datareg->NoEpisode,
            'NoRegistrasi' => $request->NoRegistrasi,
            'NoLAB' =>  $request->NoTrsOrderLab,
            'Title' =>  $request->NoTrsOrderLab,
            'pname' =>  $datareg->PatientName,
            'sex' =>  $datareg->Gander,
            'birth_dt' =>  $datareg->Date_of_birth,
            'Address' =>  $datareg->Address,
            'ptype' =>  $datareg->PatientType,
            'locid' =>  $datareg->IdUnit,
            'locname' =>  $datareg->NamaUnit,
            'clinician_id' =>  $datareg->IdDokter,
            'clinician_name' =>  $datareg->NamaDokter,
            'request_dt' =>  $request->dateOrder,
            'user_order' =>  $request->NamaUser,
            'diag_klinik' =>  $request->Daignosa,
            'ketklinis' =>  $request->Keterangan_Klinik,
            'asuransi' =>  $datareg->NamaJaminan 
        ]);
    }
    public function createLisDetil($request,$datareg,$key)
    {
        return  DB::connection('sqlsrv7')->table("LIS_Order_detail")->insert([  
            'NoMR' => $datareg->NoMR,
            'NoEpisode' =>  $datareg->NoEpisode, 
            'NoLAB' =>  $request->NoTrsOrderLab,
            'kode_test' =>  $key->NamaTes,
            'nama_test' =>  $key->KodeKelompok,
            'is_cito' =>  $key->jenisOrder,
            'dateinput' =>  $request->dateOrder,
            'dokterOperator' =>  $datareg->IdDokter
        ]);
    }
}
