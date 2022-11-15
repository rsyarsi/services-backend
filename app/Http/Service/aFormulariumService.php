<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Repository\aFormulariumRepositoryImpl;

class aFormulariumService extends Controller
{

    private $aFormulariumRepository;

    public function __construct(aFormulariumRepositoryImpl $aFormulariumRepository)
    {
        $this->aFormulariumRepository = $aFormulariumRepository;
    }

    public function addFormularium(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [
            "Nama_Formularium" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Create Formularium 
        if ($this->aFormulariumRepository->getFormulariumbyName($request)->count() > 0) {
            //response
            return response()->json([
                "status" => 0,
                "message" => "Formularium Name Already Exist"
            ], 500);
        }
        if ($this->aFormulariumRepository->addFormularium($request)) {
            //response
            return response()->json([
                "status" => 1,
                "message" => "Formularium Add Successfully"
            ], 200);
        } else {
            //response
            return response()->json([
                "status" => 0,
                "message" => "Formularium Add Failed"
            ], 500);
        }
    }

    public function editFormularium(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [
            "ID" => "required",
            "Nama_Formularium" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Create Formularium 
        if ($this->aFormulariumRepository->getFormulariumbyNameExceptId($request)->count() > 0) {
            //response
            return response()->json([
                "status" => 0,
                "message" => "Formularium Name Already Exist"
            ], 500);
        }
        // create new user 
        if ($this->aFormulariumRepository->getFormulariumbyId($request->ID)->count() < 1) {
            //response
            return response()->json([
                "status" => 0,
                "message" => "Formularium Code Not Found"
            ], 500);
        }
        if ($this->aFormulariumRepository->editFormularium($request)) {
            //response
            return response()->json([
                "status" => 1,
                "message" => "Formularium Edit Successfully"
            ], 200);
        } else {
            //response
            return response()->json([
                "status" => 0,
                "message" => "Formularium Edit Failed"
            ], 500);
        }
    }
    public function getFormulariumbyId($id)
    {
        // validator 
        $count = $this->aFormulariumRepository->getFormulariumbyId($id)->count();

        if ($count > 0) {
            $data = $this->aFormulariumRepository->getFormulariumbyId($id);
            return $this->sendResponse($data, "Data Formularium ditemukan.");
        } else {
            return $this->sendError("Data Formularium Found.", [], 400);
        }
    }
    public function getFormulariumAll()
    {
        // validator 
        $count = $this->aFormulariumRepository->getFormulariumAll()->count();

        if ($count > 0) {
            $data = $this->aFormulariumRepository->getFormulariumAll();
            return $this->sendResponse($data, "Data Formularium ditemukan.");
        } else {
            return $this->sendError("Data Formularium Not Found.", [], 400);
        }
    }
}
