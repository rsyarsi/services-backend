<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\aOrderMutasiService;
use App\Http\Repository\aStokRepositoryImpl;
use App\Http\Repository\aBarangRepositoryImpl;
use App\Http\Repository\aSupplierRepositoryImpl;
use App\Http\Repository\aMasterUnitRepositoryImpl;
use App\Http\Repository\aMutasiRepositoryImpl;
use App\Http\Repository\aOrderMutasiRepositoryImpl;
use App\Http\Repository\aPurchaseRequisitionRepositoryImpl;
use App\Http\Service\aMutasiService;

class MutasiController extends Controller
{
    //
    public function addMutasi(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseRequestRepository = new aPurchaseRequisitionRepositoryImpl();
        $aStokRepository = new aStokRepositoryImpl();
        $aOrderMutasiRepository = new aOrderMutasiRepositoryImpl();
        $aMutasiRepositorya = new aMutasiRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aMutasiService = new aMutasiService(
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseRequestRepository,
            $aStokRepository,
            $aOrderMutasiRepository, 
            $aMasterUnitRepository,
            $aMutasiRepositorya
        );
        $execute =  $aMutasiService->addMutasi($request);
        return $execute;
    }
    public function addMutasiWithOrderDetail(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseRequestRepository = new aPurchaseRequisitionRepositoryImpl();
        $aStokRepository = new aStokRepositoryImpl();
        $aOrderMutasiRepository = new aOrderMutasiRepositoryImpl();
        $aMutasiRepositorya = new aMutasiRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aMutasiService = new aMutasiService(
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseRequestRepository,
            $aStokRepository,
            $aOrderMutasiRepository,
            $aMasterUnitRepository,
            $aMutasiRepositorya
        );
        $execute =  $aMutasiService->addMutasiWithOrderDetail($request);
        return $execute;
    }
    public function editMutasi(Request $request)
    {
    }
    public function voidMutasi(Request $request)
    {
    }
    public function voidMutasiDetailbyItem(Request $request)
    {
    }
    public function getMutasibyID(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseRequestRepository = new aPurchaseRequisitionRepositoryImpl();
        $aStokRepository = new aStokRepositoryImpl();
        $aOrderMutasiRepository = new aOrderMutasiRepositoryImpl();
        $aMutasiRepositorya = new aMutasiRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aMutasiService = new aMutasiService(
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseRequestRepository,
            $aStokRepository,
            $aOrderMutasiRepository,
            $aMasterUnitRepository,
            $aMutasiRepositorya
        );
        $execute =  $aMutasiService->getMutasibyID($request);
        return $execute;
    }
    public function getMutasiDetailbyID(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseRequestRepository = new aPurchaseRequisitionRepositoryImpl();
        $aStokRepository = new aStokRepositoryImpl();
        $aOrderMutasiRepository = new aOrderMutasiRepositoryImpl();
        $aMutasiRepositorya = new aMutasiRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aMutasiService = new aMutasiService(
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseRequestRepository,
            $aStokRepository,
            $aOrderMutasiRepository,
            $aMasterUnitRepository,
            $aMutasiRepositorya
        );
        $execute =  $aMutasiService->getMutasiDetailbyID($request);
        return $execute;
    }
    public function getMutasibyDateUser(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseRequestRepository = new aPurchaseRequisitionRepositoryImpl();
        $aStokRepository = new aStokRepositoryImpl();
        $aOrderMutasiRepository = new aOrderMutasiRepositoryImpl();
        $aMutasiRepositorya = new aMutasiRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aMutasiService = new aMutasiService(
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseRequestRepository,
            $aStokRepository,
            $aOrderMutasiRepository,
            $aMasterUnitRepository,
            $aMutasiRepositorya
        );
        $execute =  $aMutasiService->getMutasibyDateUser($request);
        return $execute;
    }
    public function getMutasibyPeriode(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl();
        $asupplierRepository = new aSupplierRepositoryImpl();
        $aPurchaseRequestRepository = new aPurchaseRequisitionRepositoryImpl();
        $aStokRepository = new aStokRepositoryImpl();
        $aOrderMutasiRepository = new aOrderMutasiRepositoryImpl();
        $aMutasiRepositorya = new aMutasiRepositoryImpl();
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $aMutasiService = new aMutasiService(
            $aBarangRepository,
            $asupplierRepository,
            $aPurchaseRequestRepository,
            $aStokRepository,
            $aOrderMutasiRepository,
            $aMasterUnitRepository,
            $aMutasiRepositorya
        );
        $execute =  $aMutasiService->getMutasibyPeriode($request);
        return $execute;
    }
}
