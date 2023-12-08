<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\bTrsResepService;
use App\Http\Repository\aHnaRepositoryImpl;
use App\Http\Repository\bVisitRepositoryImpl;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\aTrsResepRepositoryImpl;
//ss
class ResepController extends Controller
{
    public function viewOrderResepbyTrs(Request $request){
      
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsResep = new aTrsResepRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $hnaRepository = new aHnaRepositoryImpl();
        $userService = new bTrsResepService($visitRepository,$trsResep,$doctorRepository,$hnaRepository);
        $user =  $userService->viewOrderResepbyTrs($request);
        return $user; 
    }
    public function viewOrderResepDetail(Request $request){
      
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsResep = new aTrsResepRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $hnaRepository = new aHnaRepositoryImpl();
        $userService = new bTrsResepService($visitRepository,$trsResep,$doctorRepository,$hnaRepository);
        $user =  $userService->viewOrderResepDetail($request);
        return $user; 
    }
}
