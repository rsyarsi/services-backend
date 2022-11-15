<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\bAppointmentService;
use App\Http\Service\bKamarOperasiService;
use App\Http\Service\bMedicalRecordService;
use App\Http\Repository\aUnitRepositoryImpl;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\aMasterUnitRepositoryImpl;
use App\Http\Repository\aScheduleDoctorRepositoryImpl;
use App\Http\Repository\bAntrianRepositoryImpl;
use App\Http\Repository\bAppointmentRepositoryImpl;
use App\Http\Repository\bKamarOperasiRepositoryImpl;
use App\Http\Repository\bMedicalRecordRepositoryImpl;
use App\Http\Repository\bVisitRepositoryImpl;

class BPJSKesehatanController extends Controller
{
    //
    public function PasienBaru(Request $request){
        $userRepository = new bMedicalRecordRepositoryImpl();
        $userService = new bMedicalRecordService($userRepository);
        $user =  $userService->PasienBaru($request);
        return $user;
    }
    public function AmbilAntrian(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $userService = new bAppointmentService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository);
        $user =  $userService->AmbilAntrian($request);
        return $user;
    }
    public function SisaStatusAntrian(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $userService = new bAppointmentService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository);
        $user =  $userService->SisaStatusAntrian($request);
        return $user;
    }
    public function StatusAntrian(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $userService = new bAppointmentService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository);
        $user =  $userService->StatusAntrian($request);
        return $user;
    }
    public function BatalAntrian(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $userService = new bAppointmentService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository);
        $user =  $userService->BatalAntrian($request);
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
        $userService = new bAppointmentService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository);
        $user =  $userService->CheckIn($request);
        return $user;
    }
    public function UpdateTaskID(Request $request){
        // $userRepository = new bMedicalRecordRepositoryImpl();
        // $userService = new bAppointmentService($userRepository);
        // $user =  $userService->AmbilAntrian($request);
        // return $user;
    }
    public function ViewBookingbyId(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $userService = new bAppointmentService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository);
        $user =  $userService->ViewBookingbyId($request);
        return $user;
    }
    public function AntrianOperasiRS(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $userService = new bKamarOperasiService($userRepository);
        $user =  $userService->AntrianOperasiRS($request);
        return $user;
    }
    public function AntrianOperasiPasien(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $userService = new bKamarOperasiService($userRepository);
        $user =  $userService->AntrianOperasiPasien($request);
        return $user;
    }
}
