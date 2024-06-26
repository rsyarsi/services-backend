<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\bTrsRadiologiService;
use App\Http\Repository\bTarifRepositoryImpl;
use App\Http\Repository\bVisitRepositoryImpl;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\aTrsLaboratoriumRepositoryImpl;
use App\Http\Repository\aTrsRadiologiRepositoryImpl;

class RadiologiController extends Controller
{
    //
    public function create(Request $request){
        $tarif = new bTarifRepositoryImpl(); 
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsRadiologi = new aTrsRadiologiRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $userService = new bTrsRadiologiService($tarif,$visitRepository,$trsRadiologi,$doctorRepository);
        $user =  $userService->create($request);
        return $user; 
    }
    public function viewOrderRadbyMedrec(Request $request){
        $tarif = new bTarifRepositoryImpl(); 
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsRadiologi = new aTrsRadiologiRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $userService = new bTrsRadiologiService($tarif,$visitRepository,$trsRadiologi,$doctorRepository);
        $user =  $userService->viewOrderRadbyMedrec($request);
        return $user; 
    }
    public function viewOrderRadbyTrs(Request $request){
        $tarif = new bTarifRepositoryImpl(); 
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsRadiologi = new aTrsRadiologiRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $userService = new bTrsRadiologiService($tarif,$visitRepository,$trsRadiologi,$doctorRepository);
        $user =  $userService->viewOrderRadbyTrs($request);
        return $user; 
    }
    public function viewOrderRadbyMedrecPeriode(Request $request){
        $tarif = new bTarifRepositoryImpl(); 
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsRadiologi = new aTrsRadiologiRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $userService = new bTrsRadiologiService($tarif,$visitRepository,$trsRadiologi,$doctorRepository);
        $user =  $userService->viewOrderRadbyMedrecPeriode($request);
        return $user; 
    }
    public function viewHasilRadiology(Request $request){
        $tarif = new bTarifRepositoryImpl(); 
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsRadiologi = new aTrsRadiologiRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $userService = new bTrsRadiologiService($tarif,$visitRepository,$trsRadiologi,$doctorRepository);
        $user =  $userService->viewHasilRadiology($request);
        return $user; 
    }
    public function viewOrderRadbyNoReg(Request $request){
        $tarif = new bTarifRepositoryImpl(); 
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsRadiologi = new aTrsRadiologiRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $userService = new bTrsRadiologiService($tarif,$visitRepository,$trsRadiologi,$doctorRepository);
        $user =  $userService->viewOrderRadbyNoReg($request);
        return $user; 
    }
}
