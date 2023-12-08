<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\bTrsResepService;
use App\Http\Repository\aHnaRepositoryImpl;
use App\Http\Repository\bVisitRepositoryImpl;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\aTrsResepRepositoryImpl;

class ResepV2Controller extends Controller
{
    //
    public function viewOrderResepbyDatePeriode(Request $request){
        $visitRepository = new bVisitRepositoryImpl(); 
        $trsResep = new aTrsResepRepositoryImpl(); 
        $doctorRepository = new aDoctorRepositoryImpl(); 
        $hnaRepository = new aHnaRepositoryImpl();
        $userService = new bTrsResepService($visitRepository,$trsResep,$doctorRepository,$hnaRepository);
        $user =  $userService->viewOrderReseV2pbyDatePeriode($request);
        return $user; 
    }
   
}
