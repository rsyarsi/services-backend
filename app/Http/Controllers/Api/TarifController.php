<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\bTarifRepositoryImpl;
use App\Http\Service\bTarifService;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    //
    public function getTarifRadiologi(Request $request){
        $tarif = new bTarifRepositoryImpl(); 
        $userService = new bTarifService($tarif);
        $user =  $userService->getTarifRadiologi($request);
        return $user; 
    }
    public function getTarifLaboratorium(Request $request){
         $tarif = new bTarifRepositoryImpl(); 
        $userService = new bTarifService($tarif);
        $user =  $userService->getTarifLaboratorium($request);
        return $user; 
    }
    public function getTarifRajal(Request $request){
         $tarif = new bTarifRepositoryImpl(); 
        $userService = new bTarifService($tarif);
        $user =  $userService->getTarifRajal($request);
        return $user; 
    }
    public function getTarifRanap(Request $request){
         $tarif = new bTarifRepositoryImpl(); 
        $userService = new bTarifService($tarif);
        $user =  $userService->getTarifRanap($request);
        return $user; 
    }
    public function getTarifMCU(Request $request){
        $tarif = new bTarifRepositoryImpl(); 
       $userService = new bTarifService($tarif);
       $user =  $userService->getTarifMCU($request);
       return $user; 
   }
   public function getTarifMCUAll(Request $request){
    $tarif = new bTarifRepositoryImpl(); 
   $userService = new bTarifService($tarif);
   $user =  $userService->getTarifMCUAll($request);
   return $user; 
}
    //detil tarif
    public function getTarifMcubyName(Request $request){
        $tarif = new bTarifRepositoryImpl(); 
        $userService = new bTarifService($tarif);
        $user =  $userService->getTarifMcubyName($request);
        return $user; 
    }
    public function getTarifRadiologibyID($request){
        $tarif = new bTarifRepositoryImpl(); 
        $userService = new bTarifService($tarif);
        $user =  $userService->getTarifRadiologibyID($request);
        return $user; 
    }
    public function getTarifLaboratoriumbyID($request){
         $tarif = new bTarifRepositoryImpl(); 
        $userService = new bTarifService($tarif);
        $user =  $userService->getTarifLaboratoriumbyID($request);
        return $user; 
    }
    public function getTarifRajalbyID($request){
         $tarif = new bTarifRepositoryImpl(); 
        $userService = new bTarifService($tarif);
        $user =  $userService->getTarifRajalbyID($request);
        return $user; 
    }
    public function getTarifRanapbyID($request){
         $tarif = new bTarifRepositoryImpl(); 
        $userService = new bTarifService($tarif);
        $user =  $userService->getTarifRanapbyID($request);
        return $user; 
    }
}
