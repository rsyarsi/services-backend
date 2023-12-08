<?php

namespace App\Http\Controllers;

use App\Http\Repository\bHasilMCURepositoryImpl;
use Illuminate\Http\Request;
use App\Http\Service\bHasilMCUService;

class HasilMcuController extends Controller
{
    public function uploaPdfRadiologi(Request $request){
        $hasilmcu = new bHasilMCURepositoryImpl();  
        $userService = new bHasilMCUService($hasilmcu);
        $user =  $userService->uploaPdfRadiologi($request);
        return $user; 
    }
    public function uploaPdfLaboratorium(Request $request){
        $hasilmcu = new bHasilMCURepositoryImpl();  
        $userService = new bHasilMCUService($hasilmcu);
        $user =  $userService->uploaPdfLaboratorium($request);
        return $user; 
    }
    public function uploaPdfHasilMCU(Request $request){
        $hasilmcu = new bHasilMCURepositoryImpl();  
        $userService = new bHasilMCUService($hasilmcu);
        $user =  $userService->uploaPdfHasilMCU($request);
        return $user; 
    }
    public function uploaPdfHasilMCUFinish(Request $request){
        $hasilmcu = new bHasilMCURepositoryImpl();  
        $userService = new bHasilMCUService($hasilmcu);
        $user =  $userService->uploaPdfHasilMCUFinish($request);
        return $user; 
    }
    public function hasilMCU(Request $request){
        $hasilmcu = new bHasilMCURepositoryImpl();  
        $userService = new bHasilMCUService($hasilmcu);
        $user =  $userService->hasilMCU($request);
        return $user; 
    }
}
