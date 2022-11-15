<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class aStokRepositoryImpl implements aStokRepositoryInterface
{
    public function addStok($request,$key)
    { 
        return  DB::connection('sqlsrv')->table("Stoks")->insert([
            'ProductCode' => $key['ProductCode'],
            'Qty' => $key['QtyDelivery']* $key['KonversiQty'],
            'Satuan' => $key['Satuan_Konversi'],
            'Layanan' => $request->UnitCode 
        ]);
    }
    public function addStokTrs($request, $key, $qtynew,$Unit)
    {
        return  DB::connection('sqlsrv')->table("Stoks")->insert([
            'ProductCode' => $key['ProductCode'],
            'Qty' => $qtynew,
            'Satuan' => $key['Satuan_Konversi'],
            'Layanan' => $Unit
        ]);
    }
    public function addBukuStok($request, $key)
    {
        $qtystok = $key['QtyDelivery'] * $key['KonversiQty'];
        return  DB::connection('sqlsrv')->table("BukuStoks")->insert([
            'TransactionCode' => $request->TransactionCode,
            'TransactionDate' => $request->TransactionDate,
            'UserCreate' =>  $request->UserCreate,
            'ProductCode' => $key['ProductCode'],
            'ProductName' => $key['ProductName'],
            'Satuan' => $key['Satuan_Konversi'],
            'QtyIn' => $qtystok ,
            'Hpp' => $key['Hpp'],
            'PersediaanIn' => $key['Hpp']*$qtystok ,
            'TransactionCodeReff' => $request->TransactionCode,
            'TransactionCodeReff2' => 'DO',
            'Status' => '1',
            'ExpiredDate' => $request->ExpiredDate,
            'DeliveryCode' => $request->TransactionCode,
            'Unit' => $request->UnitCode,
            'BatchNumber' => $key['NoBatch']
        ]);
    }
    public function addBukuStokVoid($request, $key)
    {
        $qtystok = $key->QtyDelivery* $key->KonversiQty;
        return  DB::connection('sqlsrv')->table("BukuStoks")->insert([
            'TransactionCode' => $request->TransactionCode,
            'TransactionDate' => Carbon::now(),
            'UserCreate' =>  $request->UserVoid,
            'ProductCode' => $key->ProductCode,
            'ProductName' => $key->ProductName,
            'Satuan' => $key->Satuan_Konversi,
            'QtyOut' => $qtystok,
            'Hpp' => $key->Hpp,
            'PersediaanOut' => $key->Hpp * $qtystok,
            'TransactionCodeReff' => $request->TransactionCode,
            'TransactionCodeReff2' => 'DO_V',
            'Status' => '1',
            'DeliveryCode' => $request->TransactionCode,
            'Unit' => $request->UnitCode,
            'ExpiredDate' => $request->ExpiredDate,
            'BatchNumber' => $key->NoBatch
        ]);
    }
    public function addBukuStokVoidbyIdProduct($request, $dtlDo)
    {
        $qtystok = $dtlDo->QtyDelivery * $dtlDo->KonversiQty;
        return  DB::connection('sqlsrv')->table("BukuStoks")->insert([
            'TransactionCode' => $request->TransactionCode,
            'TransactionDate' => Carbon::now(),
            'UserCreate' =>  $request->UserVoid,
            'ProductCode' => $dtlDo->ProductCode,
            'ProductName' => $dtlDo->ProductName,
            'Satuan' => $dtlDo->Satuan_Konversi,
            'QtyOut' => $qtystok,
            'Hpp' => $dtlDo->Hpp,
            'PersediaanOut' => $dtlDo->Hpp * $qtystok,
            'TransactionCodeReff' => $request->TransactionCode,
            'TransactionCodeReff2' => 'DO_V',
            'Status' => '1',
            'DeliveryCode' => $request->TransactionCode,
            'Unit' => $request->UnitCode,
            'ExpiredDate' => $request->ExpiredDate,
            'BatchNumber' => $dtlDo->NoBatch
        ]);
    }
    public function deleteBukuStok($request, $key, $tipetrs,$unit)
    {
        return  DB::connection('sqlsrv')->table("BukuStoks")
        ->where('ProductCode', $key['ProductCode'])
        ->where('TransactionCodeReff', $request->TransactionCode)
        ->where('TransactionCodeReff2', $tipetrs)
        ->where('Unit', $unit)
        ->delete();
    }
    public function updateStok($request, $key, $QtyTotal)
    {
        $updatesatuan =  DB::connection('sqlsrv')->table('Stoks')
        ->where('ProductCode', $key['ProductCode'])
        ->where('Layanan', $request->UnitCode)
            ->update([
                'Qty' => $QtyTotal,
                'Satuan' =>  $key['Satuan_Konversi']
            ]);
        return $updatesatuan;
    }
    
    public function updateStokTrs($request, $key, $QtyTotal, $Unit)
    {
        $updatesatuan =  DB::connection('sqlsrv')->table('Stoks')
        ->where('ProductCode', $key['ProductCode'])
        ->where('Layanan', $Unit)
            ->update([
                'Qty' => $QtyTotal,
            'Satuan' =>  $key['Satuan_Konversi']
            ]);
        return $updatesatuan;
    }
    public function cekStokbyIDBarang($key, $unit)
    {
        return  DB::connection('sqlsrv')->table("v_stok")
        ->where('ProductCode', $key['ProductCode'])
        ->where('Layanan', $unit)
        ->get();
    }
    
    public function cekStokbyIDBarangOnly($id, $request)
    {
        return  DB::connection('sqlsrv')->table("v_stok")
        ->where('ProductCode', $id)
        ->where('Layanan', $request->UnitCode)
            ->get();
    }
    public function updateStokPerItemBarang($request, $key, $QtyTotal)
    {
        $updatesatuan =  DB::connection('sqlsrv')->table('Stoks')
        ->where('ProductCode', $key)
        ->where('Layanan', $request->UnitCode)
            ->update([
                'Qty' => $QtyTotal
            ]);
        return $updatesatuan;
    }
    public function getStokExpiredFirst($request, $key)
    {
        return  DB::connection('sqlsrv')->table("BukuStoks")
        ->where('ProductCode', $key['ProductCode'])
        ->where('Unit', $request->UnitTujuan)
        -> select(
            'BukuStoks.DeliveryCode',
            'BukuStoks.Hpp',
            'BukuStoks.BatchNumber',
            DB::raw('SUM(QtyIn)-SUM(QtyOut)  AS x'),
            DB::raw("replace(CONVERT(VARCHAR(11),ExpiredDate, 111), ' / ',' - ') as ExpiredDate")
            )
            ->groupBy('BukuStoks.ExpiredDate','BukuStoks.DeliveryCode','BukuStoks.Hpp', 'BukuStoks.BatchNumber')
            ->having(DB::raw('SUM(QtyIn)-SUM(QtyOut)'), '>', 0)
            ->orderBy('ExpiredDate','asc')
            ->get()->first();
    }
    public function addBukuStokIn($request, $key, $TipeTrs, $DeliveryCode, $xhpp, $ExpiredDate,$BatchNumber, $qtynew, $persediaan, $UnitIn)
    {
        if($TipeTrs == "MT"){
            $qtystok = $qtynew; 
        }else{
            $qtystok ="0";
        }
        return  DB::connection('sqlsrv')->table("BukuStoks")->insert([
            'TransactionCode' => $request->TransactionCode,
            'TransactionDate' => $request->TransactionDate,
            'UserCreate' =>  $request->UserCreate,
            'ProductCode' => $key['ProductCode'],
            'ProductName' => $key['ProductName'],
            'Satuan' => $key['Satuan_Konversi'],
            'QtyIn' => $qtystok,
            'Hpp' => $xhpp,
            'PersediaanIn' => $persediaan,
            'TransactionCodeReff' => $request->TransactionCode,
            'TransactionCodeReff2' => $TipeTrs,
            'Status' => '1',
            'ExpiredDate' => $ExpiredDate,
            'DeliveryCode' => $DeliveryCode,
            'Unit' => $UnitIn,
            'BatchNumber' => $BatchNumber
        ]);
    }
    public function addBukuStokOut($request, $key, $TipeTrs, $DeliveryCode, $xhpp, $ExpiredDate,$BatchNumber, $qtynew, $persediaan, $UnitOut)
    {
        if ($TipeTrs == "MT") {
            $qtystok = $qtynew; 
        } else {
            $qtystok = "0";
        }
        return  DB::connection('sqlsrv')->table("BukuStoks")->insert([
            'TransactionCode' => $request->TransactionCode,
            'TransactionDate' => $request->TransactionDate,
            'UserCreate' =>  $request->UserCreate,
            'ProductCode' => $key['ProductCode'],
            'ProductName' => $key['ProductName'],
            'Satuan' => $key['Satuan_Konversi'],
            'QtyOut' => $qtystok,
            'Hpp' => $xhpp,
            'PersediaanOut' => $persediaan,
            'TransactionCodeReff' => $request->TransactionCode,
            'TransactionCodeReff2' => $TipeTrs,
            'Status' => '1',
            'ExpiredDate' => $ExpiredDate,
            'DeliveryCode' => $DeliveryCode,
            'Unit' => $UnitOut,
            'BatchNumber' => $BatchNumber
        ]);
    }
}