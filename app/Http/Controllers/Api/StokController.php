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
}
