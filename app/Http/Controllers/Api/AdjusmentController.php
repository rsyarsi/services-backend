<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repository\aAdjusmentRepositoryImpl;
use App\Http\Repository\aHnaRepositoryImpl;
use App\Http\Repository\aStokRepositoryImpl;
use App\Http\Repository\aBarangRepositoryImpl;
use App\Http\Repository\aMasterUnitRepositoryImpl;
use App\Http\Repository\aDeliveryOrderRepositoryImpl;
use App\Http\Service\aAdjusmentService;

class AdjusmentController extends Controller
{
    public function addAdjusmentHeader(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl(); 
        $aStokRepository = new aStokRepositoryImpl();
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl(); 
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $ahnaRepository =  new aHnaRepositoryImpl(); 
        $returbeliRepository =  new aAdjusmentRepositoryImpl(); 
        $aReturBeliService = new aAdjusmentService(  
            $aBarangRepository, 
            $aStokRepository,
            $aDeliveryOrderRepository,
            $aMasterUnitRepository, 
            $ahnaRepository,
            $returbeliRepository  
        );
        $execute =  $aReturBeliService->addAdjusmentHeader($request);
        return $execute;
    }
    public function addAdjusmentFinish(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl(); 
        $aStokRepository = new aStokRepositoryImpl();
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl(); 
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $ahnaRepository =  new aHnaRepositoryImpl(); 
        $returbeliRepository =  new aAdjusmentRepositoryImpl(); 
        $aReturBeliService = new aAdjusmentService(  
            $aBarangRepository, 
            $aStokRepository,
            $aDeliveryOrderRepository,
            $aMasterUnitRepository, 
            $ahnaRepository,
            $returbeliRepository  
        );
        $execute =  $aReturBeliService->addAdjusmentFinish($request);
        return $execute;
    }
    public function getAdjusmentbyID(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl(); 
        $aStokRepository = new aStokRepositoryImpl();
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl(); 
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $ahnaRepository =  new aHnaRepositoryImpl(); 
        $returbeliRepository =  new aAdjusmentRepositoryImpl(); 
        $aReturBeliService = new aAdjusmentService(  
            $aBarangRepository, 
            $aStokRepository,
            $aDeliveryOrderRepository,
            $aMasterUnitRepository, 
            $ahnaRepository,
            $returbeliRepository  
        );
        $execute =  $aReturBeliService->getAdjusmentbyID($request);
        return $execute;
    }
    public function getAdjusmentDetailbyID(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl(); 
        $aStokRepository = new aStokRepositoryImpl();
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl(); 
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $ahnaRepository =  new aHnaRepositoryImpl(); 
        $returbeliRepository =  new aAdjusmentRepositoryImpl(); 
        $aReturBeliService = new aAdjusmentService(  
            $aBarangRepository, 
            $aStokRepository,
            $aDeliveryOrderRepository,
            $aMasterUnitRepository, 
            $ahnaRepository,
            $returbeliRepository  
        );
        $execute =  $aReturBeliService->getAdjusmentDetailbyID($request);
        return $execute;
    }
    public function getAdjusmentbyDateUser(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl(); 
        $aStokRepository = new aStokRepositoryImpl();
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl(); 
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $ahnaRepository =  new aHnaRepositoryImpl(); 
        $returbeliRepository =  new aAdjusmentRepositoryImpl(); 
        $aReturBeliService = new aAdjusmentService(  
            $aBarangRepository, 
            $aStokRepository,
            $aDeliveryOrderRepository,
            $aMasterUnitRepository, 
            $ahnaRepository,
            $returbeliRepository  
        );
        $execute =  $aReturBeliService->getAdjusmentbyDateUser($request);
        return $execute;
    }
    public function getAdjusmentbyPeriode(Request $request)
    {
        $aBarangRepository = new aBarangRepositoryImpl(); 
        $aStokRepository = new aStokRepositoryImpl();
        $aDeliveryOrderRepository = new aDeliveryOrderRepositoryImpl(); 
        $aMasterUnitRepository = new aMasterUnitRepositoryImpl();
        $ahnaRepository =  new aHnaRepositoryImpl(); 
        $returbeliRepository =  new aAdjusmentRepositoryImpl(); 
        $aReturBeliService = new aAdjusmentService(  
            $aBarangRepository, 
            $aStokRepository,
            $aDeliveryOrderRepository,
            $aMasterUnitRepository, 
            $ahnaRepository,
            $returbeliRepository  
        );
        $execute =  $aReturBeliService->getAdjusmentbyPeriode($request);
        return $execute;
    }
    
}
