<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Repository\aJenisRepositoryImpl;

class aJenisService extends Controller
{

    private $aJenisRepository;

    public function __construct(aJenisRepositoryImpl $aJenisRepository)
    {
        $this->aJenisRepository = $aJenisRepository;
    }

    public function addJenis(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [
            "NamaJenis" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Create Jenis 
        if($this->aJenisRepository->getJenisbyNameExceptId($request)->count() > 0){
            //response
            return response()->json([
                "status" => 0,
                "message" => "Jenis Already Exist"
            ], 500);
        } 
            $createJenis = $this->aJenisRepository->addJenis($request);
            if ($createJenis) {
                //response
                return response()->json([
                    "status" => 1,
                    "message" => "Jenis Add Successfully"
                ], 200);
            } else {
                //response
                return response()->json([
                    "status" => 0,
                    "message" => "Jenis Add Failed"
                ], 500);
            } 
    }

    public function editJenis(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [
            "ID" => "required",
            "NamaJenis" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // create new user 
        if($this->aJenisRepository->getJenisbyId($request->ID)->count() < 1){
            //response
            return response()->json([
                "status" => 0,
                "message" => "Jenis ID Not Found"
            ], 500);
        }
        // Create Jenis 
        if ($this->aJenisRepository->getJenisbyNameExceptIdById($request)->count() > 0) {
            //response
            return response()->json([
                "status" => 0,
                "message" => "Name Jenis Already Exist"
            ], 500);
        } 
            $createJenis = $this->aJenisRepository->editJenis($request);
            if ($createJenis) {
                //response
                return response()->json([
                    "status" => 1,
                    "message" => "Jenis Edit Successfully"
                ], 200);
            } else {
                //response
                return response()->json([
                    "status" => 0,
                    "message" => "Jenis Edit Failed"
                ], 500);
            }
         
    }
    public function getJenisbyId($id)
    {
        // validator 
        $count = $this->aJenisRepository->getJenisbyId($id)->count();

        if ($count > 0) {
            $data = $this->aJenisRepository->getJenisbyId($id);
            return $this->sendResponse($data, "Data Jenis ditemukan.");
        } else {
            return $this->sendError("Data Jenis Found.", [], 400);
        }
    }
    public function getJenisAll()
    {
        // validator 
        $count = $this->aJenisRepository->getJenisAll()->count();

        if ($count > 0) {
            $data = $this->aJenisRepository->getJenisAll();
            return $this->sendResponse($data, "Data Jenis ditemukan.");
        } else {
            return $this->sendError("Data Jenis Not Found.", [], 400);
        }
    }
}
