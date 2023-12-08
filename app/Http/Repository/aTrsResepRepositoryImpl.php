<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class aTrsResepRepositoryImpl implements aTrsResepRepositoryInterface
{

    public function viewResepHeader($idResep)
    {
        return  DB::connection('sqlsrv')->table("Orders")
        ->where('Order ID', $idResep)
        ->select(DB::raw("[Order ID] as ID"), DB::raw("Text as Description_data"))
        ->get();
    }
    
    public function viewResepDetail($idResep)
    {
        return  DB::connection('sqlsrv')->table("Order Details")
        ->where('Order ID', $idResep)
        ->select('NamaObat','Quantity','QtyRealisasi','Signa','Note1','Review','Dosis',DB::raw("[Product ID] as IdBarang"))
        ->get();
    }
    public function viewOrderReseV2pbyDatePeriode($request)
    {
        return  DB::connection('sqlsrv')->table("ResepV2_ViewbyPeriodeDate")
        ->whereBetween(DB::raw("replace(CONVERT(VARCHAR(11), TglResep, 111), '/','-')"),
        [$request->tglPeriodeAwal,$request->tglPeriodeAkhir])  
        ->get();
    }
}
