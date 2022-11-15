<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Repository\aPabrikRepositoryImpl;

class aPabrikService extends Controller
{

    private $aPabrikRepository;

    public function __construct(aPabrikRepositoryImpl $aPabrikRepository)
    {
        $this->aPabrikRepository = $aPabrikRepository;
    }

    public function addPabrik(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [ 
            "Nama" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Create Pabrik 
        if ($this->aPabrikRepository->getPabrikbyName($request)->count()) {
            //response
            return response()->json([
                "status" => 0,
                "message" => "Pabrik Name Already Exist"
            ], 500);
        } 
            $createPabrik = $this->aPabrikRepository->addPabrik($request);
            if ($createPabrik) {
                //response
                return response()->json([
                    "status" => 1,
                    "message" => "Pabrik Add Successfully"
                ], 200);
            } else {
                //response
                return response()->json([
                    "status" => 0,
                    "message" => "Pabrik Add Failed"
                ], 500);
            }
        
    }

    public function editPabrik(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [
            "ID" => "required",
            "Nama" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // create new user 
        if ($this->aPabrikRepository->getPabrikbyNameExceptId($request)->count()) {
            //response
            return response()->json([
                "status" => 0,
                "message" => "Pabrik Name Already Exist"
            ], 500);
        } 
        if ($this->aPabrikRepository->getPabrikbyId($request->ID)->count() < 1) {
            //response
            return response()->json([
                "status" => 0,
                "message" => "Pabrik Code Not Found"
            ], 500);
        }  
            $createPabrik = $this->aPabrikRepository->editPabrik($request);
            if ($createPabrik) {
                //response
                return response()->json([
                    "status" => 1,
                    "message" => "Pabrik Edit Successfully"
                ], 200);
            } else {
                //response
                return response()->json([
                    "status" => 0,
                    "message" => "Pabrik Edit Failed"
                ], 500);
            }
        
    }
    public function getPabrikbyId($id)
    {
        // validator 
        $count = $this->aPabrikRepository->getPabrikbyId($id)->count();

        if ($count > 0) {
            $data = $this->aPabrikRepository->getPabrikbyId($id);
            return $this->sendResponse($data, "Data Pabrik ditemukan.");
        } else {
            return $this->sendError("Data Pabrik Found.", [], 400);
        }
    }
    public function getPabrikAll()
    {
        // validator 
        $count = $this->aPabrikRepository->getPabrikAll()->count();

        if ($count > 0) {
            $data = $this->aPabrikRepository->getPabrikAll();
            return $this->sendResponse($data, "Data Pabrik ditemukan.");
        } else {
            return $this->sendError("Data Pabrik Not Found.", [], 400);
        }
    }
}
