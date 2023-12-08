<?php

namespace App\Http\Repository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class cMasterDataAntrianRepositoryImpl implements cMasterDataAntrianRepositoryInterface
{
    public function addCounterAntrian($request)
    {
        return  DB::connection('sqlsrv2')->table("AntrianCounter")->insert([
            'CounterName' =>  $request->counterName,
            'FloorId' =>  $request->floorId,
            'JenisAntrian' =>  $request->jenisAntrian,
            'IpAddress' =>  $request->ipaddress,
            'IdUnit' =>  $request->KodeUnit,
            'Side' =>  $request->Side,
            'NamaUnit' =>  $request->NamaUnit 
        ]);
    }
    public function updateCounterAntrian($request)
    {
        $updatesatuan =  DB::connection('sqlsrv2')->table('AntrianCounter')
        ->where('Id', $request->idCounter) 
            ->update([ 
                'CounterName' =>  $request->counterName,
                'FloorId' =>  $request->floorId,
                'JenisAntrian' =>  $request->jenisAntrian,
                'Status' =>  $request->Status,
                'IpAddress' =>  $request->ipaddress ,
                'IdUnit' =>  $request->KodeUnit,
                'Side' =>  $request->Side,
                'NamaUnit' =>  $request->NamaUnit 
            ]);
        return $updatesatuan;
    }

    public function ListAllAntrianCounter()
    {
        return  DB::connection('sqlsrv2')->table("AntrianCounter") 
        ->where('Status', '1')  
        ->get();
    }

    public function ViewbyIdAntrianCounter($id)
    {
        return  DB::connection('sqlsrv2')->table("AntrianCounter") 
        ->where('Id', $id)  
        ->get();
    }
    public function ViewbyIpAddress($IpAddress)
    {
        return  DB::connection('sqlsrv2')->table("AntrianCounter") 
        ->where('IpAddress', $IpAddress)  
        ->get();
    }
    public function ViewbyFloor($data)
    {
        return  DB::connection('sqlsrv2')->table("AntrianCounter") 
        ->where('FloorId', $data->Lantai)  
        ->where('JenisAntrian', $data->JenisAntrian)  
        ->get();
    }
// antrian
    public function getAntrianJenisbyCode($id)
    {
        return  DB::connection('sqlsrv2')->table("AntrianJenis")
        ->where('Id', $id)->get();
    }

    public function ListAllAntrianJenis()
    {
        return  DB::connection('sqlsrv2')->table("AntrianJenis") 
        ->get();
    }
    public function addCreatecomplaint($request)
    {
        return  DB::connection('sqlsrv3')->table("A_Complain")->insert([
            'DateCreate' =>  Carbon::now(),
            'Fullname' =>  $request->Fullname,
            'Email' =>  $request->Email,
            'PatientStatus' =>  $request->PatientStatus,
            'Jenis' =>  $request->Jenis,
            'Place' =>  $request->Place,
            'Complain' =>  $request->Complain, 
            'NoHandphone' =>  $request->NoHandphone 
        ]);
    }
}