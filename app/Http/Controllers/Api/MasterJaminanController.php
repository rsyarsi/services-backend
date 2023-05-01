<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\aJaminanService;
use App\Http\Repository\aJaminanRepositoryImpl;

class MasterJaminanController extends Controller
{
    
    public function getJaminanAllAktif($idgroupjaminan){
        $Repository = new aJaminanRepositoryImpl();
        $Service = new aJaminanService($Repository);
        $getDoctorbyUnit =  $Service->getJaminanAllAktif($idgroupjaminan);
        return $getDoctorbyUnit;
    }
    public function getJaminanAllAktifbyId($idgroupjaminan,$idjaminan){
        $Repository = new aJaminanRepositoryImpl();
        $Service = new aJaminanService($Repository);
        $getDoctorbyUnit =  $Service->getJaminanAllAktifbyId($idgroupjaminan,$idjaminan);
        return $getDoctorbyUnit;
    }
}
