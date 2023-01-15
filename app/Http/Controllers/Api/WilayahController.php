<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\aJaminanService;
use App\Http\Repository\aJaminanRepositoryImpl;
use App\Http\Repository\aWilayahRepositoryImpl;
use App\Http\Service\WilayahService;

class WilayahController extends Controller
{
    //
    public function Provinsi(){
        $Repository = new aWilayahRepositoryImpl();
        $Service = new WilayahService($Repository);
        $getDoctorbyUnit =  $Service->Provinsi();
        return $getDoctorbyUnit;
    }
    public function detailProvinsi($provinsiId){
        $Repository = new aWilayahRepositoryImpl();
        $Service = new WilayahService($Repository);
        $getDoctorbyUnit =  $Service->detailProvinsi($provinsiId);
        return $getDoctorbyUnit;
    }
    public function Kabupaten($provinsiId){
        $Repository = new aWilayahRepositoryImpl();
        $Service = new WilayahService($Repository);
        $getDoctorbyUnit =  $Service->Kabupaten($provinsiId);
        return $getDoctorbyUnit;
    }
    public function detailKabupaten($kabupatenId){
        $Repository = new aWilayahRepositoryImpl();
        $Service = new WilayahService($Repository);
        $getDoctorbyUnit =  $Service->detailKabupaten($kabupatenId);
        return $getDoctorbyUnit;
    }
    public function Kecamatan($kabupatenId){
        $Repository = new aWilayahRepositoryImpl();
        $Service = new WilayahService($Repository);
        $getDoctorbyUnit =  $Service->Kecamatan($kabupatenId);
        return $getDoctorbyUnit;
    }
    public function detailKecamatan($kecamatanId){
        $Repository = new aWilayahRepositoryImpl();
        $Service = new WilayahService($Repository);
        $getDoctorbyUnit =  $Service->detailKecamatan($kecamatanId);
        return $getDoctorbyUnit;
    }
    public function Kelurahan($kecamatanId){
        $Repository = new aWilayahRepositoryImpl();
        $Service = new WilayahService($Repository);
        $getDoctorbyUnit =  $Service->Kelurahan($kecamatanId);
        return $getDoctorbyUnit;
    } 
    public function detailKelurahan($kelurahanId){
        $Repository = new aWilayahRepositoryImpl();
        $Service = new WilayahService($Repository);
        $getDoctorbyUnit =  $Service->detailKelurahan($kelurahanId);
        return $getDoctorbyUnit;
    }
}
