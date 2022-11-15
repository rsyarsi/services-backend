<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Repository\UserRepositoryImpl;
use App\Http\Controllers\Controller;
use App\Http\Repository\aSatuanRepositoryImpl;

class aSatuanService extends Controller
{

    private $aSatuanRepository;

    public function __construct(aSatuanRepositoryImpl $aSatuanRepository)
    {
        $this->aSatuanRepository = $aSatuanRepository;
    }

    public function addSatuan(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [
            "nama_satuan" => "required",
            "isi" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // create new user 
        if($this->aSatuanRepository->getSatuanbyName($request->nama_satuan)->count() > 0){
            //response
            return response()->json([
                "status" => 0,
                "message" => "Satuan Already Exist"
            ], 500);
        }  
            $createsatuan = $this->aSatuanRepository->addSatuan($request);
            if ($createsatuan) {
                //response
                return response()->json([
                    "status" => 1,
                    "message" => "Satuan Add Successfully"
                ], 200);
            } else {
                //response
                return response()->json([
                    "status" => 0,
                    "message" => "Satuan Add Failed"
                ], 500);
            } 
    }

    public function editSatuan(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [
            "nama_satuan" => "required",
            "isi" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // cek nama udah ada?
        if($this->aSatuanRepository->getSatuanbyNameExceptId($request)->count() > 0){
            return response()->json([
                "status" => 0,
                "message" => "Satuan Name Already Exist."
            ], 500);
        }
        // cek id invalid kah ?
        if ($this->aSatuanRepository->getSatuanbyId($request->ID)->count() < 1) {
            return response()->json([
                "status" => 0,
                "message" => "Satuan ID Invalid."
            ], 500);
        }
            $createsatuan = $this->aSatuanRepository->editSatuan($request);
            if ($createsatuan) {
                //response
                return response()->json([
                    "status" => 1,
                    "message" => "Satuan Edit Successfully"
                ], 200);
            } else {
                //response
                return response()->json([
                    "status" => 0,
                    "message" => "Satuan Edit Failed"
                ], 500);
            }
    }
    public function getSatuanbyId($id)
    {
        // validator 
        $count = $this->aSatuanRepository->getSatuanbyId($id)->count();

        if ($count > 0) {
            $data = $this->aSatuanRepository->getSatuanbyId($id);
            return $this->sendResponse($data, "Data User ditemukan.");
        } else {
            return $this->sendError("Data User Not Found.", [], 400);
        }
    }
    public function getSatuanAll()
    {
        // validator 
        $count = $this->aSatuanRepository->getSatuanAll()->count();

        if ($count > 0) {
            $data = $this->aSatuanRepository->getSatuanAll();
            return $this->sendResponse($data, "Data User ditemukan.");
        } else {
            return $this->sendError("Data User Not Found.", [], 400);
        }
    }
}
