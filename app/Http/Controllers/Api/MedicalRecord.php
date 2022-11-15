<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\bMedicalRecordRepositoryImpl;
use App\Http\Service\bMedicalRecordService;
use Illuminate\Http\Request;

class MedicalRecord extends Controller
{
    // 
    public function create(Request $request){
        $userRepository = new bMedicalRecordRepositoryImpl();
        $userService = new bMedicalRecordService($userRepository);
        $user =  $userService->create($request);
        return $user;
    }
    public function createwalkin(Request $request){
        $userRepository = new bMedicalRecordRepositoryImpl();
        $userService = new bMedicalRecordService($userRepository);
        $user =  $userService->createwalkin($request);
        return $user;
    }
    public function nonwalkin($id){
        $userRepository = new bMedicalRecordRepositoryImpl();
        $userService = new bMedicalRecordService($userRepository);
        $user =  $userService->nonwalkin($id);
        return $user;
    }
    public function walkin($id){
        $userRepository = new bMedicalRecordRepositoryImpl();
        $userService = new bMedicalRecordService($userRepository);
        $user =  $userService->walkin($id);
        return $user;
    }
}
