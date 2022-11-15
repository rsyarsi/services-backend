<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Repository\aKelompokRepositoryImpl;

class aKelompokService extends Controller
{

    private $aKelompokRepository;

    public function __construct(aKelompokRepositoryImpl $aKelompokRepository)
    {
        $this->aKelompokRepository = $aKelompokRepository;
    }

    public function addKelompok(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [
            "KelompokCode" => "required",
            "KelompokName" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if($request->KelompokCode <> $request->KelompokName){
            return response()->json([
                "status" => 0,
                "message" => "Kelompok Code <> Kelompok Name"
            ], 500);
        }
        // Create Kelompok 
        if($this->aKelompokRepository->getKelompokbyId($request->KelompokCode)->count() >0){
            return response()->json([
                "status" => 0,
                "message" => "Kelompok Code Already Exist"
            ], 500);
        }
        if ($this->aKelompokRepository->getKelompokbyName($request)->count() > 0) {
            return response()->json([
                "status" => 0,
                "message" => "Kelompok Name Already Exist"
            ], 500);
        }
            $createKelompok = $this->aKelompokRepository->addKelompok($request);
            if ($createKelompok) {
                //response
                return response()->json([
                    "status" => 1,
                    "message" => "Kelompok Add Successfully"
                ], 200);
            } else {
                //response
                return response()->json([
                    "status" => 0,
                    "message" => "Kelompok Add Failed"
                ], 500);
            }
    }

    public function editKelompok(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [
            "KelompokCode" => "required",
            "KelompokName" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if ($request->KelompokCode <> $request->KelompokName) {
            return response()->json([
                "status" => 0,
                "message" => "Kelompok Code <> Kelompok Name, If You Want to User Another Name, Please Add New."
            ], 500);
        }
        // create new user 
        if($this->aKelompokRepository->getKelompokbyId($request->KelompokCode)->count() < 1){
            //response
            return response()->json([
                "status" => 0,
                "message" => "Kelompok Not Found."
            ], 500);
        }
        if ($this->aKelompokRepository->getKelompokbyNameExceptId($request)->count() > 0) {
            //response
            return response()->json([
                "status" => 0,
                "message" => "Kelompok Name Already Exist."
            ], 500);
        } 
            $createKelompok = $this->aKelompokRepository->editKelompok($request);
            if ($createKelompok) {
                //response
                return response()->json([
                    "status" => 1,
                    "message" => "Kelompok Edit Successfully"
                ], 200);
            } else {
                //response
                return response()->json([
                    "status" => 0,
                    "message" => "Kelompok Edit Failed"
                ], 500);
            }
         
    }
    public function getKelompokbyId($id)
    {
        // validator 
        $count = $this->aKelompokRepository->getKelompokbyId($id)->count();

        if ($count > 0) {
            $data = $this->aKelompokRepository->getKelompokbyId($id);
            return $this->sendResponse($data, "Data Kelompok ditemukan.");
        } else {
            return $this->sendError("Data Kelompok Found.", [], 400);
        }
    }
    public function getKelompokAll()
    {
        // validator 
        $count = $this->aKelompokRepository->getKelompokAll()->count();

        if ($count > 0) {
            $data = $this->aKelompokRepository->getKelompokAll();
            return $this->sendResponse($data, "Data Kelompok ditemukan.");
        } else {
            return $this->sendError("Data Kelompok Not Found.", [], 400);
        }
    }
}
