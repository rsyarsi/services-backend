<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repository\bVisitRepositoryImpl;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\bAntrianRepositoryImpl;
use App\Http\Repository\aMasterUnitRepositoryImpl;
use App\Http\Repository\bAppointmentRepositoryImpl;
use App\Http\Repository\bKamarOperasiRepositoryImpl;
use App\Http\Repository\bMedicalRecordRepositoryImpl;
use App\Http\Repository\aScheduleDoctorRepositoryImpl;
use App\Http\Repository\bAntrianFarmasiRepositoryImpl;
use App\Http\Service\AntrianFarmasiService;

class AntrianFarmasiController extends Controller
{
    //
    public function CreateAntrianFarmasi(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $antrianFarmasi = new bAntrianFarmasiRepositoryImpl();
        $userService = new AntrianFarmasiService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository,$antrianFarmasi);
        $user =  $userService->CreateAntrian($request);
        return $user;
    }
    public function UpdateAntrianFarmasi(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $antrianFarmasi = new bAntrianFarmasiRepositoryImpl();
        $userService = new AntrianFarmasiService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository,$antrianFarmasi);
        $user =  $userService->UpdateAntrianFarmasi($request);
        return $user;
    }
    public function ListAntrianFarmasi(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $antrianFarmasi = new bAntrianFarmasiRepositoryImpl();
        $userService = new AntrianFarmasiService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository,$antrianFarmasi);
        $user =  $userService->ListAntrianFarmasi($request);
        return $user;
    }
    public function ListHistoryAntrianFarmasi(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $antrianFarmasi = new bAntrianFarmasiRepositoryImpl();
        $userService = new AntrianFarmasiService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository,$antrianFarmasi);
        $user =  $userService->ListHistoryAntrianFarmasi($request);
        return $user;
    }
    public function ListDepoFarmasi(){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $antrianFarmasi = new bAntrianFarmasiRepositoryImpl();
        $userService = new AntrianFarmasiService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository,$antrianFarmasi);
        $user =  $userService->ListDepoFarmasi();
        return $user;
    }
    public function UpdateDataVerifikasiAmbilResep(Request $request){
        $userRepository = new bKamarOperasiRepositoryImpl();
        $medrecRepository = new bMedicalRecordRepositoryImpl();
        $doctorRepository = new aDoctorRepositoryImpl();
        $unitRepository = new aMasterUnitRepositoryImpl();
        $appointmenRepository = new bAppointmentRepositoryImpl();
        $scheduleRepository = new aScheduleDoctorRepositoryImpl();
        $antrianRepository = new bAntrianRepositoryImpl();
        $visitRepository = new bVisitRepositoryImpl();
        $antrianFarmasi = new bAntrianFarmasiRepositoryImpl();
        $userService = new AntrianFarmasiService($userRepository,$medrecRepository,
                        $doctorRepository,$unitRepository, $appointmenRepository,$scheduleRepository,
                        $antrianRepository,$visitRepository,$antrianFarmasi);
        $user =  $userService->UpdateDataVerifikasiAmbilResep($request);
        return $user;
    }
}
