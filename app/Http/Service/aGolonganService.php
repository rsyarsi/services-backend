<?php

namespace App\Http\Service;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Validator; 
use App\Http\Controllers\Controller;
use App\Http\Repository\aGolonganRepositoryImpl;

class aGolonganService extends Controller
{

    private $aGolonganRepository;

    public function __construct(aGolonganRepositoryImpl $aGolonganRepository)
    {
        $this->aGolonganRepository = $aGolonganRepository;
    }

    public function addGolongan(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [ 
            "Golongan" => "required" 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Create Golongan 
        if($this->aGolonganRepository->getGolonganbyName($request->Golongan)->count() > 0 ){
            //response
            return response()->json([
                "status" => 0,
                "message" => "Golongan Name Already Exist"
            ], 500);
        }
                $createGolongan = $this->aGolonganRepository->addGolongan($request);
                if ($createGolongan) {
                    //response
                    return response()->json([
                        "status" => 1,
                        "message" => "Golongan Add Successfully"
                    ], 200);
                } else {
                    //response
                    return response()->json([
                        "status" => 0,
                        "message" => "Golongan Add Failed"
                    ], 500);
                }
    }

    public function editGolongan(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [
            "ID" => "required",
            "Golongan" => "required" 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // GET GOLONGAN BY ID
        if($this->aGolonganRepository->getGolonganbyId($request->ID)->count() < 1){
            //response
            return response()->json([
                "status" => 0,
                "message" => "Golongan ID Not Found."
            ], 500);
        }
        // GET GOLONGAN NAME EXCEPT ID
        if ($this->aGolonganRepository->getGolonganbyNameExceptId($request)->count() > 0) {
            //response
            return response()->json([
                "status" => 0,
                "message" => "Golongan Name Already Exist."
            ], 500);
        }
         
            $createGolongan = $this->aGolonganRepository->editGolongan($request);
            if ($createGolongan) {
                //response
                return response()->json([
                    "status" => 1,
                    "message" => "Golongan Edit Successfully"
                ], 200);
            } else {
                //response
                return response()->json([
                    "status" => 0,
                    "message" => "Golongan Edit Failed"
                ], 500);
            }
       
    }
    public function getGolonganbyId($id)
    {
        // validator 
        $count = $this->aGolonganRepository->getGolonganbyId($id)->count();

        if ($count > 0) {
            $data = $this->aGolonganRepository->getGolonganbyId($id);
            return $this->sendResponse($data, "Data Golongan ditemukan.");
        } else {
            return $this->sendError("Data Golongan Found.", [], 400);
        }
    }
    public function getGolonganAll()
    {
        // validator 
        $count = $this->aGolonganRepository->getGolonganAll()->count();

        if ($count > 0) {
            $data = $this->aGolonganRepository->getGolonganAll();
            return $this->sendResponse($data, "Data Golongan ditemukan.");
        } else {
            return $this->sendError("Data Golongan Not Found.", [], 400);
        }
    }
}
