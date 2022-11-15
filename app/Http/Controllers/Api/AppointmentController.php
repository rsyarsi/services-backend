<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\bAppointmentService;
use App\Http\Repository\bVisitRepositoryImpl;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\bAntrianRepositoryImpl;
use App\Http\Service\bAppointmenNonBPJSService;
use App\Http\Repository\aMasterUnitRepositoryImpl;
use App\Http\Repository\bAppointmentRepositoryImpl;
use App\Http\Repository\bKamarOperasiRepositoryImpl;
use App\Http\Repository\bMedicalRecordRepositoryImpl;
use App\Http\Repository\aScheduleDoctorRepositoryImpl;

class AppointmentController extends Controller
{
    //
    public function CreateAppointment(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $userService = new bAppointmenNonBPJSService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository);
        $user =  $userService->CreateAppointment($request);
        return $user;
    }
    public function voidAppoitment(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $userService = new bAppointmenNonBPJSService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository);
        $user =  $userService->voidAppoitment($request);
        return $user;
    }
    public function viewAppointmentbyId(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $userService = new bAppointmenNonBPJSService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository);
        $user =  $userService->viewAppointmentbyId($request);
        return $user;
    }
    public function viewAppointmentbyMedrec(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $userService = new bAppointmenNonBPJSService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository);
        $user =  $userService->viewAppointmentbyMedrec($request);
        return $user;
    }
    public function CheckIn(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $userService = new bAppointmenNonBPJSService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository);
        $user =  $userService->CheckIn($request);
        return $user;
    }
}
