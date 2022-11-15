<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\aFakturService;
use App\Http\Repository\aHnaRepositoryImpl;
use App\Http\Repository\aStokRepositoryImpl;
use App\Http\Repository\aBarangRepositoryImpl;
use App\Http\Repository\aJurnalRepositoryImpl;
use App\Http\Repository\aSupplierRepositoryImpl;
use App\Http\Repository\aDeliveryOrderRepositoryImpl;
use App\Http\Repository\aFakturRepositoryImpl;
use App\Http\Repository\aPurchaseOrderRepositoryImpl;

class FakturController extends Controller
{
    //
    public function addFaktur(Request $request)
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
    public function addFakturDetail(Request $request)
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
        $addHeader =  $aFakturService->addFakturDetail($request);
        return $addHeader;
    } 
    public function voidFaktur(Request $request)
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
        $addHeader =  $aFakturService->voidFaktur($request);
        return $addHeader;
    }
    public function voidFakturDetailbyItem(Request $request)
    {
    }
    public function getFakturbyID(Request $request)
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
        $addHeader =  $aFakturService->getFakturbyID($request);
        return $addHeader;
    }
    public function getFakturDetailbyID(Request $request)
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
        $addHeader =  $aFakturService->getFakturDetailbyID($request);
        return $addHeader;
    }
    public function getFakturbyDateUser(Request $request)
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
        $addHeader =  $aFakturService->getFakturbyDateUser($request);
        return $addHeader;
    }
    public function getFakturbyPeriode(Request $request)
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
        $addHeader =  $aFakturService->getFakturbyPeriode($request);
        return $addHeader;
    }
}
