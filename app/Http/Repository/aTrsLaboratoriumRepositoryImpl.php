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
            'FlagPA' =>  $request->FlagPA,
            'Diagnosa' =>  $request->Daignosa,
            'KeteranganKlinis' =>  $request->Keterangan_Klinik,
            'JamOrder' =>  date('Y-m-d H:i:s', strtotime($request->dateOrder)) 
           
        ]);
    }
    public function createDetail($key,$RecID,$LabID,$NoOrderLabLIS,$request)
    {
        return  DB::connection('sqlsrv7')->table("tblLabDetail")->insert([
            'LabID' => $LabID,
            'IdTes' => $key['IdTes'],
            'Tarif' =>  $key['NominalTarif'],
            'Rate' => '1', 
            'TarifKelas' =>  $key['NominalTarif'],
            'kode_test' => $key['KodeKelompokTes'],
            'DokterJasa' =>  $request->IdDokter,
        ]);
    }
    public function getTrsLabDetail($request,$kelompok)
    {
        return  DB::connection('sqlsrv7')->table("View_OrderLab")
        ->select('LabID','OrderCode','LabDetailID','NoRegRI','NoLAB','NamaTes','KodeKelompok','jenisOrder') 
        ->where('NoLab',$request->NoTrsOrderLab)    
        ->where('KodeKelompok',$kelompok)    
        ->where('Batal','0')    
        ->get();
    }
    public function getTrsLabDetailbyNoTrsLabIdTest($request,$idTes)
    {
        return  DB::connection('sqlsrv7')->table("View_OrderLab")
        ->select('LabID','OrderCode','LabDetailID','NoRegRI','NoLAB','NamaTes','KodeKelompok','jenisOrder') 
        ->where('NoLab',$request->NoTrsOrderLab)    
        ->where('idTes',$idTes)    
        ->where('Batal','0')    
        ->get();
    }
    public function getTrsLabDetailbyIdDetail($request)
    {
        return  DB::connection('sqlsrv7')->table("View_OrderLab")
        ->select('LabID','OrderCode','LabDetailID','NoRegRI','NoLAB','NamaTes','KodeKelompok','jenisOrder','st_received') 
        ->where('LabDetailID',$request->IdDetail)     
        ->where('Batal','0')    
        ->get();
    }
    public function getTrsLabDetaiAllbyTrs($NoOrderLabLIS)
    {
        return  DB::connection('sqlsrv7')->table("View_OrderLab")
        ->select('LabID','OrderCode','LabDetailID','NoRegRI','NoLAB','NamaTes','KodeKelompok','jenisOrder') 
        ->where('NoLab',$NoOrderLabLIS)    
        ->get();
    }
    public function viewHasilLaboratoriumbyTrs($NoOrderLabLIS)
    {
        return  DB::connection('sqlsrv7')->table("View_Web_Hasil_Lab")
        ->where('NoLab',$NoOrderLabLIS)    
        ->orderBy('NOINDEX', 'asc')
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
    public function getTrsLabDetailNotReceived($request)
    {
        return  DB::connection('sqlsrv7')->table("View_OrderLab")
        ->select('LabID','OrderCode','LabDetailID','NoRegRI','NoLAB','NamaTes','KodeKelompok','jenisOrder','kode_test') 
        ->where('LabID',$request->LabID)      
        ->where('st_received','0')    
        ->get();
    }
    public function getTrsOrderLisDetailHasRecived($request,$kodetest){
        return  DB::connection('sqlsrv7')->table("LIS_Order_detail")
        ->select('NoLab') 
        ->where('NoLab',$request->NoTrsOrderLab)      
        ->where('st_received','1')    
        ->where(DB::raw("left([kode_test],2)"),$kodetest)    
        ->get();
    }
    public function getTrsOrderLisDetailActive($request,$kodetest){
        return  DB::connection('sqlsrv7')->table("LIS_Order_detail")
        ->select('NoLab') 
        ->where('NoLab',$request->NoTrsOrderLab)      
        ->where('status_ts','0')    
        ->where('kode_test',$kodetest)    
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
    public function createHeaderLis($request,$datareg,$kelasid,$NoOrderLabLIS)
    {
        return  DB::connection('sqlsrv7')->table("LIS_Order")->insert([                          
            'NoMR' => $datareg->NoMR,
            'NoEpisode' =>  $datareg->NoEpisode,
            'NoRegistrasi' => $request->NoRegistrasi,
            'NoLAB' =>  $NoOrderLabLIS,
            'Title' =>  $NoOrderLabLIS,
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
    public function createLisDetil($request,$datareg,$key,$NoOrderLabLIS,$dateNow)
    {
        return  DB::connection('sqlsrv7')->table("LIS_Order_detail")->insert([  
            'NoMR' => $datareg->NoMR,
            'NoEpisode' =>  $datareg->NoEpisode, 
            'NoLAB' =>  $NoOrderLabLIS,
            'nama_test' =>  $key->NamaTes,
            'kode_test' =>  $key->KodeKelompok,
            'is_cito' =>  $key->jenisOrder,
            'dateinput' =>  $dateNow,
            'dokterOperator' =>  $datareg->IdDokter
        ]);
    }
    public function updateBatalLabdetail($request,$edited){
        $updatesatuan =  DB::connection('sqlsrv7')->table('tblLabDetail')
        ->where('LabDetailID', $request->IdDetail) 
            ->update([
                'Batal' => '1',
                'status_ts' =>  '1',
                'Keterangan' =>  $request->Note,
                'Editedby' =>  $edited
            ]);
        return $updatesatuan;
    }
    public function updateBatalLISDetail($request,$kodeKelompok){
        $updatesatuan =  DB::connection('sqlsrv7')->table('LIS_Order_detail')
        ->where('NoLab', $request->NoTrsOrderLab) 
        ->where('kode_test', $kodeKelompok) 
            ->update([ 
                'status_ts' =>  '1'
            ]);
        return $updatesatuan;
    }
    public function updateBatalLabHeader($request,$edited){
        $updatesatuan =  DB::connection('sqlsrv7')->table('tblLab')
        ->where('NoLAB', $request->NoTrsOrderLab) 
            ->update([
                'Batal' => '1', 
                'Catatan' =>  $request->Note. ' ' . $edited 
            ]);
        return $updatesatuan;
    }
    public function updateBatalLabDetailAll($request,$edited){
        $updatesatuan =  DB::connection('sqlsrv7')->table('tblLabDetail')
        ->where('LabID', $request->LabID) 
        ->where('Batal', '0') 
            ->update([
                'Batal' => '1',
                'status_ts' =>  '1',
                'Keterangan' =>  $request->Note,
                'Editedby' =>  $edited
            ]);
        return $updatesatuan;
    }
    public function updateBatalLISOrderHeader($request){
        $updatesatuan =  DB::connection('sqlsrv7')->table('LIS_Order')
        ->where('NoLAB', $request->NoTrsOrderLab) 
            ->update([
                'status_ts' => '1' 
            ]);
        return $updatesatuan;
    }
    public function updateBatalLISOrderDetailAll($request){
        $updatesatuan =  DB::connection('sqlsrv7')->table('LIS_Order_detail')
        ->where('NoLAB', $request->NoTrsOrderLab) 
            ->update([
                'status_ts' => '1' 
            ]);
        return $updatesatuan;
    }
    public function updateBatalLISOrderisTakenFalse($request){
        $updatesatuan =  DB::connection('sqlsrv7')->table('LIS_Order')
        ->where('NoLAB', $request->NoTrsOrderLab) 
            ->update([
                'is_taken' => 'FALSE' 
            ]);
        return $updatesatuan;
    }
    public function viewOrderLabbyNoReg($request)
    {
        return  DB::connection('sqlsrv7')->table("View_Web_Order_Lab")
         ->where('NoRegRI',$request->NoRegistrasi)
        ->get();
    }
}

