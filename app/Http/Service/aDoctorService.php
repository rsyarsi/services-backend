<?php

namespace App\Http\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Repository\aDoctorRepositoryImpl;
use Illuminate\Support\Facades\Validator;
use App\Http\Repository\UserRepositoryImpl;
use App\Http\Repository\aUnitRepositoryImpl;
use App\Http\Repository\aSatuanRepositoryImpl;

class aDoctorService extends Controller
{

    private $Repository;

    public function __construct(aDoctorRepositoryImpl $Repository)
    {
        $this->Repository = $Repository;
    }

    public function addDoctor(Request $request)
    {
        
    }

    public function editDoctor(Request $request)
    {
        
    }
    public function getDoctorbyUnit($id)
    {
        try {   
            $count = $this->Repository->getDoctorbyUnit($id)->count();
            if ($count > 0) {
                $data = $this->Repository->getDoctorbyUnit($id);
                return $this->sendResponse($data, "Data Unit Poliklinik ditemukan.");
            } else {
                return $this->sendError("Data Unit Poliklinik Not Found.", [], 400);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function getDoctorbyUnitAll()
    {
        try {   
            $count = $this->Repository->getDoctorbyUnitAll()->count();
            if ($count > 0) {
                $data = $this->Repository->getDoctorbyUnitAll();
                return $this->sendResponse($data, "Data Unit Poliklinik ditemukan.");
            } else {
                return $this->sendError("Data Unit Poliklinik Not Found.", [], 400);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function getDoctorbyUnitAllTop()
    {
        try {   
            $count = $this->Repository->getDoctorbyUnitAllTop()->count();
            if ($count > 0) {
                $data = $this->Repository->getDoctorbyUnitAllTop();
                return $this->sendResponse($data, "Data Unit Poliklinik ditemukan.");
            } else {
                return $this->sendError("Data Unit Poliklinik Not Found.", [], 400);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function getDoctorbyId($id)
    {
        try {   
            // validator 
            $count = $this->Repository->getDoctorbyId($id)->count();

            if ($count > 0) {
                $data = $this->Repository->getDoctorbyId($id)->first();
                return $this->sendResponse($data, "Data User ditemukan.");
            } else {
                return $this->sendError("Data User Not Found.", [], 400);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    
}
