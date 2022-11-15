<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\aSupplierRepositoryImpl;
use App\Http\Service\aSupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //
    public function addSupplier(Request $request){
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aSupplierService = new aSupplierService($aSupplierRepository);
        $addSupplier =  $aSupplierService->addSupplier($request);
        return $addSupplier;
    }
    public function editSupplier(Request $request)
    {
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aSupplierService = new aSupplierService($aSupplierRepository);
        $addSupplier =  $aSupplierService->editSupplier($request);
        return $addSupplier;
    }
    public function getSupplierAll()
    {
        //
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aSupplierService = new aSupplierService($aSupplierRepository);
        $getAllSupplier =  $aSupplierService->getSupplierAll();
        return $getAllSupplier;
    }
    public function getSupplierbyId($id)
    {
        //
        $aSupplierRepository = new aSupplierRepositoryImpl();
        $aSupplierService = new aSupplierService($aSupplierRepository);
        $getAllSupplier =  $aSupplierService->getSupplierbyId($id);
        return $getAllSupplier;
    }
}
