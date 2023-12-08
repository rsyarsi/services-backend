<?php

namespace App\Http\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Repository\bAntrianKasirRepositoryInterface;

class bAntrianKasirRepositoryImpl implements bAntrianKasirRepositoryInterface
{
    public function CreateAntrianKasir($request,$noAntrian,$datenow,$autonumber)
    {
        return  DB::connection('sqlsrv3')->table("AntrianListKasir")->insert([
            'NoAntrian' =>  $noAntrian, 
            'NoAntrianAll' =>  $autonumber,     
            'DateCreated' => $datenow,  
            'FloorId' =>  $request->FloorID, 
            'Status' =>  "CREATED",
            'JenisJaminan' =>  $request->Jenis_Jaminan 
        ]);
    }
    public function getMaxAntrianKasir($tglAntrian){
        return  DB::connection('sqlsrv3')->table("AntrianListKasir")
        ->select('NoAntrianAll')
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), DateCreated, 111), '/','-')"),$tglAntrian)   
        ->where('Batal', '0')
        ->orderBy('NoAntrianAll', 'desc')->first();
    } 
    public function VerifyAntrianKasirbyKodeAntrianDateNow($noAntrianPoli,$datenow){
        return  DB::connection('sqlsrv3')->table("AntrianListKasir")
        ->select('NoAntrianAll') 
        ->where('NoAntrian', $noAntrianPoli)
        ->where(DB::raw("replace(CONVERT(VARCHAR(11), DateCreated, 111), '/','-')"),$datenow)   
        ->where('Batal', '0')->get();
    } 
    
    // public function ListAntrianKasir($request)
    // {
    //     return  DB::connection('sqlsrv3')->table("AntrianListKasir")
    //         ->whereBetween(DB::raw("replace(CONVERT(VARCHAR(11), DateSavedResep, 111), '/','-')"),[$request->StartPeriode, $request->EndPeriode])   
    //         ->where('IDUnitFarmasi', $request->IdUNitFarmasi)
    //         ->where('Batal', '0')
    //         ->whereIn('StatusAntrean', ['CREATED','PROCESSED'])
    //         ->orderBy('DateCreated', 'ASC')
    //         ->get();
    // }
    public function PanggilAntrian($request,$datenow)
    {
        $updatesatuan =  DB::connection('sqlsrv3')->table('AntrianListKasir')
        ->where('ID', $request->IDTrsAntrian) 
            ->update([
                'UserId' => $request->Username, 
                'Status' =>  "CALLED",
                'DateCalled' => $datenow
            ]);
        return $updatesatuan;
    }
    public function HoldAntrian($request,$datenow)
    {
        $updatesatuan =  DB::connection('sqlsrv3')->table('AntrianListKasir')
        ->where('ID', $request->IDTrsAntrian) 
            ->update([
                'UserId' => $request->Username, 
                'Status' =>  "HOLD",
                'DateHold' => $datenow
            ]);
        return $updatesatuan;
    }
    public function ProccesedAntrian($request,$datenow)
    {
        $updatesatuan =  DB::connection('sqlsrv3')->table('AntrianListKasir')
        ->where('ID', $request->IDTrsAntrian) 
            ->update([
                'UserId' => $request->Username, 
                'Status' =>  "PROCCESSED",
                'DateProccessed' => $datenow
            ]);
        return $updatesatuan;
    }
    public function ClosedAntrian($request,$datenow)
    {
        $updatesatuan =  DB::connection('sqlsrv3')->table('AntrianListKasir')
        ->where('ID', $request->IDTrsAntrian) 
            ->update([
                'UserId' => $request->Username, 
                'Status' =>  "CLOSED",
                'DateClosed' => $datenow
            ]);
        return $updatesatuan;
    }
    public function getAntrianKasirbyID($idTrs){
        return  DB::connection('sqlsrv3')->table("AntrianListKasir")
        ->select('NoAntrianAll') 
        ->where('Id', $idTrs)
        ->where('Batal', '0')->get();
    } 
    
    public function ViewbyIdTrsAntrianKasir($id)
    {
        return  DB::connection('sqlsrv3')->table("AntrianListKasir") 
        ->select('Id','NoAntrian','Status','FloorId') 
        ->where('Id', $id)  
        ->get();
    }
    public function ViewbyDateTrsAntrianKasir($request)
    {
        return  DB::connection('sqlsrv3')->table("AntrianListKasir") 
        ->select('Id','NoAntrian','Status','FloorId') 
        ->whereBetween(DB::raw("replace(CONVERT(VARCHAR(11), DateCreated, 111), '/','-')"),[$request->StartPeriode, $request->EndPeriode])   
        ->orderBy('Id', 'asc')
        ->get();
    }
    public function ViewbyDateTrsJaminanAntrianKasir($request)
    {
        return  DB::connection('sqlsrv3')->table("AntrianListKasir") 
        ->select('Id','NoAntrian','Status','FloorId')   
        ->whereBetween(DB::raw("replace(CONVERT(VARCHAR(11), DateCreated, 111), '/','-')"),[$request->StartPeriode, $request->EndPeriode])   
        ->where('JenisJaminan', $request->JenisJaminan) 
        ->orderBy('Id', 'asc')
        ->get();
    }
}