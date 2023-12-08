<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\aUnitRepositoryImpl;
use App\Http\Service\aUnitService;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function addUnit(Request $request){
        
    }
    public function editUnit(Request $request){
        
    }
    public function getUnitPoliklinik(){
        $aUnitRepository = new aUnitRepositoryImpl();
        $aUnitService = new aUnitService($aUnitRepository);
        $getUnitPoliklinik =  $aUnitService->getUnitPoliklinik();
        return $getUnitPoliklinik;
    } 
    public function getUnitPoliklinikbyId($id){
        $aUnitRepository = new aUnitRepositoryImpl();
        $aUnitService = new aUnitService($aUnitRepository);
        $getUnitPoliklinik =  $aUnitService->getUnitPoliklinikbyId($id);
        return $getUnitPoliklinik;
    }
    public function getUnit(){
        $aUnitRepository = new aUnitRepositoryImpl();
        $aUnitService = new aUnitService($aUnitRepository);
        $getUnitPoliklinik =  $aUnitService->getUnit();
        return $getUnitPoliklinik;
    }
    public function getUnitbyId($id){
        $aUnitRepository = new aUnitRepositoryImpl();
        $aUnitService = new aUnitService($aUnitRepository);
        $getUnitPoliklinik =  $aUnitService->getUnitbyId($id);
        return $getUnitPoliklinik;
    }
}
