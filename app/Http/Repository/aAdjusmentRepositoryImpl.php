<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class aAdjusmentRepositoryImpl implements aAdjusmentRepositoryInterface
{
    public function addAdjusmentHeader($request, $autoNumber)
    {
        return  DB::connection('sqlsrv')->table("Adjusments")->insert([
            'TransactionCode' => $autoNumber,
            'TransactionDate' => $request->TransactionDate,
            'UserCreate' => $request->UserCreate,
            'UnitCode' => $request->UnitCode, 
            'Notes' => $request->Notes, 
            'TransactionDateFirst' => Carbon::now(),
            'UserCreateFirst' => $request->UserCreate,
            'ReffDateTrs' => date("dmY", strtotime($request->TransactionDate))
        ]);
    }
    public function addAdjusmentFinish($request,$key)
    {
        return  DB::connection('sqlsrv')->table("AdjusmentDetails")->insert([
            'TransactionCode' => $request->TransactionCode,
            'ProductCode' => $key['ProductCode'],
            'ProductName' => $key['ProductName'],
            'QtyStok' => $key['QtyStok'],
            'QtyAdjusment' => $key['QtyAdjusment'],
            'QtyAkhir' => $key['QtyAkhir'],
            'Satuan' => $key['ProductSatuan'], 
            'Hpp' => $key['Hpp'],
            'Total' => $key['Total'], 
            'DateAdd' => Carbon::now(),
            'UserAdd' =>  $request->UserAdd
        ]);
    }
    public function editAdjusmentHeader($request)
    {
        $updatesatuan =  DB::connection('sqlsrv')->table('Adjusments')
            ->where('TransactionCode', $request->TransactionCode)
            ->update([
                'TotalRow' => $request->TotalRow,
                'TotalQty' => $request->TotalQty,
                'TotalPersediaan' => $request->TotalPersediaan,
                'Notes' => $request->Notes, 
                'UserCreateLast' => $request->UserCreate,
                'TransactionDateLast' => Carbon::now(), 
                'Notes' => $request->Notes, 
            ]);
        return $updatesatuan;
    }
    public function getAdjusmentbyID($id)
    {
        return  DB::connection('sqlsrv')->table("v_adjusment_hdr")
        ->where('TransactionCode', $id)
            ->where('Void', '0')
            ->get();
   
    }
    public function getAdjusmentDetailbyID($request)
    {
        return  DB::connection('sqlsrv')->table("AdjusmentDetails")
        ->where('TransactionCode', $request->TransactionCode) 
            ->where('Void', '0')
            ->get();
    }
 
    public function getAdjusmentbyDateUser($request)
    {
        return  DB::connection('sqlsrv')->table("v_adjusment_hdr")
        ->where('Usercreate', $request->UserCreate)
            ->where('Void', '0')
            ->get();
    }
    public function getAdjusmentbyPeriode($request)
    {
        return  DB::connection('sqlsrv')->table("v_adjusment_hdr")
        ->whereBetween('TglPeriode', [$request->StartPeriode, $request->EndPeriode])
            ->where('Void', '0')
            ->get();
    }

    public function getMaxCode($request)
    {
        $ddatedmy = date("dmY", strtotime($request['TransactionDate']));
        return  DB::connection('sqlsrv')
        ->table('Adjusments')
        ->where('ReffDateTrs', $ddatedmy, DB::raw("(select max(`TransactionCode`) from Adjusments)"))->get();
    }
}