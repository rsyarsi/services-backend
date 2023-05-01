<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\aConsumableService;
use App\Http\Repository\aHnaRepositoryImpl;
use App\Http\Repository\aStokRepositoryImpl;
use App\Http\Repository\aBarangRepositoryImpl;
use App\Http\Repository\aConsumableRepositoryImpl;
use App\Http\Repository\aFakturRepositoryImpl;
use App\Http\Repository\aJurnalRepositoryImpl;
use App\Http\Repository\aSupplierRepositoryImpl;
use App\Http\Repository\aMasterUnitRepositoryImpl;
use App\Http\Repository\aDeliveryOrderRepositoryImpl;
use App\Http\Repository\aPurchaseOrderRepositoryImpl;

class ConsumableController extends Controller
{
    //
    public function addConsumableHeader(Request $request)
    {
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl();
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseOrderRepository = new aPurchaseOrderRepositoryImpl();
        $sStok = new aStokRepositoryImpl();
        $aHna = new aHnaRepositoryImpl();
        $aJurnal = new aJurnalRepositoryImpl();
        $aConsumableRepository = new aConsumableRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aConsumableService = new aConsumableService(
            $aDeliveryOrderRepository,
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseOrderRepository,
            $sStok,
            $aHna,
            $aJurnal,
            $aConsumableRepository,
            $aMasterUnitRepository
        );
        $addHeader =  $aConsumableService->addConsumableHeader($request);
        return $addHeader;
    }
    public function addConsumableDetail(Request $request)
    {
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl();
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseOrderRepository = new aPurchaseOrderRepositoryImpl();
        $sStok = new aStokRepositoryImpl();
        $aHna = new aHnaRepositoryImpl();
        $aJurnal = new aJurnalRepositoryImpl();
        $aConsumableRepository = new aConsumableRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aConsumableService = new aConsumableService(
            $aDeliveryOrderRepository,
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseOrderRepository,
            $sStok,
            $aHna,
            $aJurnal,
            $aConsumableRepository,
            $aMasterUnitRepository
        );
        $addHeader =  $aConsumableService->addConsumableDetail($request);
        return $addHeader;
    }
    public function voidConsumable(Request $request)
    {
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl();
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseOrderRepository = new aPurchaseOrderRepositoryImpl();
        $sStok = new aStokRepositoryImpl();
        $aHna = new aHnaRepositoryImpl();
        $aJurnal = new aJurnalRepositoryImpl();
        $aConsumableRepository = new aConsumableRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aConsumableService = new aConsumableService(
            $aDeliveryOrderRepository,
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseOrderRepository,
            $sStok,
            $aHna,
            $aJurnal,
            $aConsumableRepository,
            $aMasterUnitRepository
        );
        $addHeader =  $aConsumableService->voidConsumable($request);
        return $addHeader;
    }
    public function voidConsumableDetailbyItem(Request $request)
    {
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl();
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseOrderRepository = new aPurchaseOrderRepositoryImpl();
        $sStok = new aStokRepositoryImpl();
        $aHna = new aHnaRepositoryImpl();
        $aJurnal = new aJurnalRepositoryImpl();
        $aConsumableRepository = new aConsumableRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aConsumableService = new aConsumableService(
            $aDeliveryOrderRepository,
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseOrderRepository,
            $sStok,
            $aHna,
            $aJurnal,
            $aConsumableRepository,
            $aMasterUnitRepository
        );
        $addHeader =  $aConsumableService->voidConsumableDetailbyItem($request);
        return $addHeader;
        
    }public function getConsumablebyID(Request $request)
    {
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl();
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseOrderRepository = new aPurchaseOrderRepositoryImpl();
        $sStok = new aStokRepositoryImpl();
        $aHna = new aHnaRepositoryImpl();
        $aJurnal = new aJurnalRepositoryImpl();
        $aConsumableRepository = new aConsumableRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aConsumableService = new aConsumableService(
            $aDeliveryOrderRepository,
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseOrderRepository,
            $sStok,
            $aHna,
            $aJurnal,
            $aConsumableRepository,
            $aMasterUnitRepository
        );
        $addHeader =  $aConsumableService->getConsumablebyID($request);
        return $addHeader;
        
    }public function getConsumableDetailbyID(Request $request)
    {
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl();
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseOrderRepository = new aPurchaseOrderRepositoryImpl();
        $sStok = new aStokRepositoryImpl();
        $aHna = new aHnaRepositoryImpl();
        $aJurnal = new aJurnalRepositoryImpl();
        $aConsumableRepository = new aConsumableRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aConsumableService = new aConsumableService(
            $aDeliveryOrderRepository,
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseOrderRepository,
            $sStok,
            $aHna,
            $aJurnal,
            $aConsumableRepository,
            $aMasterUnitRepository
        );
        $addHeader =  $aConsumableService->getConsumableDetailbyID($request);
        return $addHeader;
    }public function getConsumablebyDateUser(Request $request)
    {
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl();
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseOrderRepository = new aPurchaseOrderRepositoryImpl();
        $sStok = new aStokRepositoryImpl();
        $aHna = new aHnaRepositoryImpl();
        $aJurnal = new aJurnalRepositoryImpl();
        $aConsumableRepository = new aConsumableRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aConsumableService = new aConsumableService(
            $aDeliveryOrderRepository,
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseOrderRepository,
            $sStok,
            $aHna,
            $aJurnal,
            $aConsumableRepository,
            $aMasterUnitRepository
        );
        $addHeader =  $aConsumableService->getConsumablebyDateUser($request);
        return $addHeader;
    }public function getConsumablebyPeriode(Request $request)
    {
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl();
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseOrderRepository = new aPurchaseOrderRepositoryImpl();
        $sStok = new aStokRepositoryImpl();
        $aHna = new aHnaRepositoryImpl();
        $aJurnal = new aJurnalRepositoryImpl();
        $aConsumableRepository = new aConsumableRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aConsumableService = new aConsumableService(
            $aDeliveryOrderRepository,
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseOrderRepository,
            $sStok,
            $aHna,
            $aJurnal,
            $aConsumableRepository,
            $aMasterUnitRepository
        );
        $addHeader =  $aConsumableService->getConsumablebyPeriode($request);
        return $addHeader;
    }
}
