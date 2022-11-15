<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\aBarangRepositoryImpl;
use App\Http\Repository\aSupplierRepositoryImpl;
use App\Http\Service\aBarangService;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    //
    public function addBarang(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl();
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aBarangService = new aBarangService($aBarangRepository, $aSupplierRepository);
        $addBarang =  $aBarangService->addBarang($request);
        return $addBarang;
    }
    
    public function editBarang(Request $request)
    {
      $aBarangRepository = new aBarangRepositoryImpl();
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aBarangService = new aBarangService($aBarangRepository, $aSupplierRepository);
        $addBarang =  $aBarangService->editBarang($request);
        return $addBarang;
    }
    public function getBarangAll()
    {
        //
      $aBarangRepository = new aBarangRepositoryImpl();
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aBarangService = new aBarangService($aBarangRepository, $aSupplierRepository);
        $getAllBarang =  $aBarangService->getBarangAll();
        return $getAllBarang;
    }
    public function getBarangbyId($id)
    {
        //
      $aBarangRepository = new aBarangRepositoryImpl();
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aBarangService = new aBarangService($aBarangRepository, $aSupplierRepository);
        $getAllBarang =  $aBarangService->getBarangbyId($id);
        return $getAllBarang;
    }
    public function addBarangSupplier(Request $request)
    {
      $aBarangRepository = new aBarangRepositoryImpl();
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aBarangService = new aBarangService($aBarangRepository, $aSupplierRepository);
        $addBarang =  $aBarangService->addBarangSupplier($request);
        return $addBarang;
    }
    public function deleteBarangSupplier(Request $request)
    {
      $aBarangRepository = new aBarangRepositoryImpl();
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aBarangService = new aBarangService($aBarangRepository, $aSupplierRepository);
        $addBarang =  $aBarangService->deleteBarangSupplier($request);
        return $addBarang;
    }
    public function getBarangbySuppliers($id)
    {
      $aBarangRepository = new aBarangRepositoryImpl();
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aBarangService = new aBarangService($aBarangRepository, $aSupplierRepository);
        $getAllBarang =  $aBarangService->getBarangbySuppliers($id);
        return $getAllBarang;
    }
    public function addBarangFormularium(Request $request)
    {
      $aBarangRepository = new aBarangRepositoryImpl();
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aBarangService = new aBarangService($aBarangRepository, $aSupplierRepository);
        $addBarang =  $aBarangService->addBarangFormularium($request);
        return $addBarang;
    }
    public function deleteBarangFormularium(Request $request)
    {
      $aBarangRepository = new aBarangRepositoryImpl();
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aBarangService = new aBarangService($aBarangRepository, $aSupplierRepository);
        $addBarang =  $aBarangService->deleteBarangFormularium($request);
        return $addBarang;
    }
    public function getBarangbyFormulariums($id)
    {
      $aBarangRepository = new aBarangRepositoryImpl();
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aBarangService = new aBarangService($aBarangRepository, $aSupplierRepository);
        $getAllBarang =  $aBarangService->getBarangbyFormulariums($id);
        return $getAllBarang;
    }
  public function getBarangbyNameLike(Request $request)
  {
    $aBarangRepository = new aBarangRepositoryImpl();
    $aSupplierRepository = new aSupplierRepositoryImpl();
    $aBarangService = new aBarangService($aBarangRepository, $aSupplierRepository);
    $addBarang =  $aBarangService->getBarangbyNameLike($request);
    return $addBarang;
  }
}
