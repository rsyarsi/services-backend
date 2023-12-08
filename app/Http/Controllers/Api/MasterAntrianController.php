<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\cMasterAntrianService; 
use App\Http\Repository\cMasterDataAntrianRepositoryImpl;

class MasterAntrianController extends Controller
{
    //
    public function CreateAntrianCounter(Request $request){
        $antrianJenisRepo = new cMasterDataAntrianRepositoryImpl(); 
        $antrianJenisService = new cMasterAntrianService($antrianJenisRepo);
        $data =  $antrianJenisService->CreateAntrianCounter($request);
        return $data;
    }
    public function Createcomplaint(Request $request){
        $antrianJenisRepo = new cMasterDataAntrianRepositoryImpl(); 
        $antrianJenisService = new cMasterAntrianService($antrianJenisRepo);
        $data =  $antrianJenisService->Createcomplaint($request);
        return $data;
    }
    
    public function UpdateAntrianCounter(Request $request){
        $antrianJenisRepo = new cMasterDataAntrianRepositoryImpl(); 
        $antrianJenisService = new cMasterAntrianService($antrianJenisRepo);
        $data =  $antrianJenisService->UpdateAntrianCounter($request);
        return $data;
    }
    public function ListAllAntrianCounter(){
        $antrianJenisRepo = new cMasterDataAntrianRepositoryImpl(); 
        $antrianJenisService = new cMasterAntrianService($antrianJenisRepo);
        $data =  $antrianJenisService->ListAllAntrianCounter();
        return $data;
    }
    public function ViewbyIdAntrianCounter($id){
        $antrianJenisRepo = new cMasterDataAntrianRepositoryImpl(); 
        $antrianJenisService = new cMasterAntrianService($antrianJenisRepo);
        $data =  $antrianJenisService->ViewbyIdAntrianCounter($id);
        return $data;
    }

    public function ListAllAntrianJenis(){
        $antrianJenisRepo = new cMasterDataAntrianRepositoryImpl(); 
        $antrianJenisService = new cMasterAntrianService($antrianJenisRepo);
        $data =  $antrianJenisService->ListAllAntrianJenis();
        return $data;
    }
    public function ViewbyIdAntrianJenis($id){
        $antrianJenisRepo = new cMasterDataAntrianRepositoryImpl(); 
        $antrianJenisService = new cMasterAntrianService($antrianJenisRepo);
        $data =  $antrianJenisService->getAntrianJenisbyCode($id);
        return $data;
    }
    public function ViewbyIpAddress(Request $request){
        $antrianJenisRepo = new cMasterDataAntrianRepositoryImpl(); 
        $antrianJenisService = new cMasterAntrianService($antrianJenisRepo);
        $data =  $antrianJenisService->ViewbyIpAddress($request);
        return $data;
    }
    public function ViewbyFloor(Request $request){
        $antrianJenisRepo = new cMasterDataAntrianRepositoryImpl(); 
        $antrianJenisService = new cMasterAntrianService($antrianJenisRepo);
        $data =  $antrianJenisService->ViewbyFloor($request);
        return $data;
    }

}
