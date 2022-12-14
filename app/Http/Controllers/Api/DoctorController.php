<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Service\aDoctorService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function getDoctorbyUnit($id){
        $Repository = new aDoctorRepositoryImpl();
        $Service = new aDoctorService($Repository);
        $getDoctorbyUnit =  $Service->getDoctorbyUnit($id);
        return $getDoctorbyUnit;
    }
    public function getDoctorbyId($id){
        $Repository = new aDoctorRepositoryImpl();
        $Service = new aDoctorService($Repository);
        $getDoctorbyUnit =  $Service->getDoctorbyId($id);
        return $getDoctorbyUnit;
    }
    public function getDoctorbyUnitAll(){
        $Repository = new aDoctorRepositoryImpl();
        $Service = new aDoctorService($Repository);
        $getDoctorbyUnit =  $Service->getDoctorbyUnitAll();
        return $getDoctorbyUnit;
    }
    public function getDoctorbyUnitAllTop(){
        $Repository = new aDoctorRepositoryImpl();
        $Service = new aDoctorService($Repository);
        $getDoctorbyUnit =  $Service->getDoctorbyUnitAllTop();
        return $getDoctorbyUnit;
    }
}
