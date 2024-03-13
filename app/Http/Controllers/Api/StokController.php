<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repository\aStokRepositoryImpl;
use App\Http\Service\aStokService;

class StokController extends Controller
{
    public function getStokBarangbyUnitNameLike(Request $request)
    {
         
        $aStokRepository = new aStokRepositoryImpl(); 
        $aMutasiService = new aStokService( 
            $aStokRepository 
        );
        $execute =  $aMutasiService->getStokBarangbyUnitNameLike($request);
        return $execute;
    }
    public function getStokBarangbyUnit(Request $request)
    {
         
        $aStokRepository = new aStokRepositoryImpl(); 
        $aMutasiService = new aStokService( 
            $aStokRepository 
        );
        $execute =  $aMutasiService->getStokBarangbyUnit($request);
        return $execute;
    }
    public function getBukuStokBarangbyUnit(Request $request)
    {
         
        $aStokRepository = new aStokRepositoryImpl(); 
        $aMutasiService = new aStokService( 
            $aStokRepository 
        );
        $execute =  $aMutasiService->getBukuStokBarangbyUnit($request);
        return $execute;
    }
    public function getBukuStokBarangBeforebyUnit(Request $request)
    {
         
        $aStokRepository = new aStokRepositoryImpl(); 
        $aMutasiService = new aStokService( 
            $aStokRepository 
        );
        $execute =  $aMutasiService->getBukuStokBarangBeforebyUnit($request);
        return $execute;
    }
}
