<?php

namespace App\Http\Repository;
use Illuminate\Support\Facades\DB;

class aHnaRepositoryImpl implements aHnaRepositoryInterface
{
    public function addHna($request, $key)
    {
        $hna = ($key['Price'] / $key['Konversi_QtyTotal']);
        $hnaTax = $hna + $key['TaxRp'];
        $hnaTaxDiskon = ($hna + $key['DiscountRp']) - $key['TaxRp'];
        $dateStart = date('Y-m-d', strtotime($request->TransactionDate . ' + 1 days'));
        return  DB::connection('sqlsrv')->table("Hnas")->insert([
            'DeliveryCode' => $request->TransactionCode,
            'DeliveryDate' => $request->TransactionDate,
            'ProductCode' => $key['ProductCode'],
            'NominalHna' => $hnaTax,
            'NominalHnaMinDiskon' => $hnaTaxDiskon,
            'UserCreate' => $request->UserCreate,
            'StartDate' => $dateStart,
            'ExpiredDate' => "4000-01-01"
        ]);
    }
    public function updateHna($request, $key)
    {
        $hna = ($key['Price'] / $key['Konversi_QtyTotal']);
        $hnaTax = $hna + $key['TaxRp'];
        $hnaTaxDiskon =  $hna - $key['TaxRp'];
        $dateStart = date('Y-m-d', strtotime($request->TransactionDate . ' + 1 days'));
        return DB::connection('sqlsrv')->table('Hnas')
        ->where('DeliveryCode', $request->TransactionCode)
        ->where('ProductCode', $key['ProductCode'])
            ->update(['DeliveryDate' => $request->TransactionDate,
            'ProductCode' => $key['ProductCode'],
            'NominalHna' => $hnaTax,
            'NominalHnaMinDiskon' => $hnaTaxDiskon,
            'UserCreate' => $request->UserCreate,
            'StartDate' => $dateStart,
            'ExpiredDate' => "4000-01-01"
            ]);
    }
    public function getHnabyDOIdbarang($request,$key)
    {
        return  DB::connection('sqlsrv')->table("Hnas")
        ->where('DeliveryCode', $key['ProductCode'])
        ->where('ProductCode', $request->UnitCode)
        ->get();
    }
    public function getHnabyIdbarang($request)
    {
        return  DB::connection('sqlsrv')->table("Hnas") 
        ->where('ProductCode', $request->UnitCode)
            ->get();
    }
}
