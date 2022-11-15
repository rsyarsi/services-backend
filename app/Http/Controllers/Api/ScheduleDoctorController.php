<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\aScheduleDoctorRepositoryImpl;
use App\Http\Service\aScheduleDoctorService;
use Illuminate\Http\Request;

class ScheduleDoctorController extends Controller
{
    public function getScheduleDoctorbyUnitDay(Request $request){
        $Repository = new aScheduleDoctorRepositoryImpl();
        $Service = new aScheduleDoctorService($Repository);
        $getScheduleDoctorbyUnitDay =  $Service->getScheduleDoctorbyUnitDay($request);
        return $getScheduleDoctorbyUnitDay;
    }
    public function getScheduleDoctorAll(){
        $Repository = new aScheduleDoctorRepositoryImpl();
        $Service = new aScheduleDoctorService($Repository);
        $getScheduleDoctorbyUnitDay =  $Service->getScheduleDoctorAll();
        return $getScheduleDoctorbyUnitDay;
    }
    public function getScheduleDoctorbyIdDoctor(Request $request){
        $Repository = new aScheduleDoctorRepositoryImpl();
        $Service = new aScheduleDoctorService($Repository);
        $getScheduleDoctorbyUnitDay =  $Service->getScheduleDoctorbyIdDoctor($request);
        return $getScheduleDoctorbyUnitDay;
    }
}
