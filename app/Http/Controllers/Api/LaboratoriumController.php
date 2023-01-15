<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repository\bTarifRepositoryImpl;
use App\Http\Repository\bVisitRepositoryImpl;
use App\Http\Service\bTrsLaboratoriumService;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\aTrsLaboratoriumRepositoryImpl;

class LaboratoriumController extends Controller
{
    // 
    public function viewOrderLabbyTrs(Request $request){
        $tarif = new bTarifRepositoryImpl(); 
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsLaboratorium = new aTrsLaboratoriumRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $userService = new bTrsLaboratoriumService($tarif,$visitRepository,$trsLaboratorium,$doctorRepository);
        $user =  $userService->viewOrderLabbyTrs($request);
        return $user; 
    }
    public function viewOrderLabbyMedrec(Request $request){
        $tarif = new bTarifRepositoryImpl(); 
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsLaboratorium = new aTrsLaboratoriumRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $userService = new bTrsLaboratoriumService($tarif,$visitRepository,$trsLaboratorium,$doctorRepository);
        $user =  $userService->viewOrderLabbyMedrec($request);
        return $user; 
    }
    public function createLaboratoriumOrder(Request $request){
        $tarif = new bTarifRepositoryImpl(); 
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsLaboratorium = new aTrsLaboratoriumRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $userService = new bTrsLaboratoriumService($tarif,$visitRepository,$trsLaboratorium,$doctorRepository);
        $user =  $userService->createLaboratoriumOrder($request);
        return $user; 
    }
    public function deleteOrderLaboratoriumDetail(Request $request)
    {
        $tarif = new bTarifRepositoryImpl(); 
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsLaboratorium = new aTrsLaboratoriumRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $userService = new bTrsLaboratoriumService($tarif,$visitRepository,$trsLaboratorium,$doctorRepository);
        $user =  $userService->deleteOrderLaboratoriumDetail($request);
        return $user; 
    }
    public function deleteOrderLaboratorium(Request $request)
    {
        $tarif = new bTarifRepositoryImpl(); 
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsLaboratorium = new aTrsLaboratoriumRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $userService = new bTrsLaboratoriumService($tarif,$visitRepository,$trsLaboratorium,$doctorRepository);
        $user =  $userService->deleteOrderLaboratorium($request);
        return $user; 
    }
}
