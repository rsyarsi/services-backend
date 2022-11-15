<?php

namespace App\Http\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Repository\UserRepositoryImpl;
use App\Http\Repository\aUnitRepositoryImpl;
use App\Http\Repository\aSatuanRepositoryImpl;

class aUnitService extends Controller
{

    private $aUnitRepository;

    public function __construct(aUnitRepositoryImpl $aUnitRepository)
    {
        $this->aUnitRepository = $aUnitRepository;
    }

    public function addUnit(Request $request)
    {
        
    }

    public function editUnit(Request $request)
    {
        
    }
    public function getUnitPoliklinik()
    {
        try {   
            $count = $this->aUnitRepository->getUnitPoliklinik()->count();
            if ($count > 0) {
                $data = $this->aUnitRepository->getUnitPoliklinik();
                return $this->sendResponse($data, "Data Unit Poliklinik ditemukan.");
            } else {
                return $this->sendError("Data Unit Poliklinik Not Found.", [], 400);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function getUnitPoliklinikbyId($id)
    {
        try {   
            // validator 
            $count = $this->aUnitRepository->getUnitPoliklinikbyId($id)->count();

            if ($count > 0) {
                $data = $this->aUnitRepository->getUnitPoliklinikbyId($id)->first();
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
