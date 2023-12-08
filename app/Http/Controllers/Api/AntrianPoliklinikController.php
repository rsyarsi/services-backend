<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repository\UserRepositoryImpl;
use App\Http\Repository\bVisitRepositoryImpl;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Service\AntrianPoliklinikService;
use App\Http\Repository\bAntrianRepositoryImpl;
use App\Http\Repository\aMasterUnitRepositoryImpl;
use App\Http\Repository\bAppointmentRepositoryImpl;
use App\Http\Repository\bKamarOperasiRepositoryImpl;
use App\Http\Repository\bMedicalRecordRepositoryImpl;
use App\Http\Repository\aScheduleDoctorRepositoryImpl;
use App\Http\Repository\bAntrianFarmasiRepositoryImpl;
use App\Http\Repository\bAntrianPoliklinikRepositoryImpl;

class AntrianPoliklinikController extends Controller
{
    //
    public function ListDataAntrian(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
       $medrecRepository = new bMedicalRecordRepositoryImpl();
       $doctorRepository = new aDoctorRepositoryImpl();
       $unitRepository = new aMasterUnitRepositoryImpl();
       $appointmenRepository = new bAppointmentRepositoryImpl();
       $scheduleRepository = new aScheduleDoctorRepositoryImpl();
       $antrianRepository = new bAntrianRepositoryImpl();
       $visitRepository = new bVisitRepositoryImpl();
       $antrianPoliklinikRepository = new bAntrianPoliklinikRepositoryImpl();
       $userLoginRepository = new UserRepositoryImpl();
       $userService = new AntrianPoliklinikService($userRepository,$medrecRepository,
                       $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                       $antrianRepository,$visitRepository,$antrianPoliklinikRepository,$userLoginRepository);
       $user =  $userService->ListDataAntrian($request);
       return $user;
   }
   public function UpdatePanggil(Request $request){
            $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $antrianPoliklinikRepository = new bAntrianPoliklinikRepositoryImpl();
        $userLoginRepository = new UserRepositoryImpl();
        $userService = new AntrianPoliklinikService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository,$antrianPoliklinikRepository,$userLoginRepository);
        $user =  $userService->UpdatePanggil($request);
        return $user;
    }
   
}
