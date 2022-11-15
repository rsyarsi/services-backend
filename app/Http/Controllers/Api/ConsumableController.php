<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repository\aHnaRepositoryImpl;
use App\Http\Repository\aStokRepositoryImpl;
use App\Http\Repository\aBarangRepositoryImpl;
use App\Http\Repository\aFakturRepositoryImpl;
use App\Http\Repository\aJurnalRepositoryImpl;
use App\Http\Repository\aSupplierRepositoryImpl;
use App\Http\Repository\aDeliveryOrderRepositoryImpl;
use App\Http\Repository\aPurchaseOrderRepositoryImpl;

class ConsumableController extends Controller
{
    //
    public function addConsumable(Request $request)
    {
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl();
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseOrderRepository = new aPurchaseOrderRepositoryImpl();
        $sStok = new aStokRepositoryImpl();
        $aHna = new aHnaRepositoryImpl();
        $aJurnal = new aJurnalRepositoryImpl();
        $aFakturRepository = new aFakturRepositoryImpl();
        $aFakturService = new aFakturService(
            $aDeliveryOrderRepository,
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseOrderRepository,
            $sStok,
            $aHna,
            $aJurnal,
            $aFakturRepository
        );
        $addHeader =  $aFakturService->addFakturHeader($request);
        return $addHeader;
    }
    public function addConsumableDetail(Request $request)
    {
        
    }
    public function voidConsumable(Request $request)
    {
        
    }
    public function voidConsumableDetailbyItem(Request $request)
    {
        
    }public function getConsumablebyID(Request $request)
    {
        
    }public function getConsumableDetailbyID(Request $request)
    {
        
    }public function getConsumablebyDateUser(Request $request)
    {
        
    }public function getConsumablebyPeriode(Request $request)
    {
        
    }
}
