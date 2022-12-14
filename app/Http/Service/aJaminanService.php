<?php

namespace App\Http\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\aJaminanRepositoryImpl;

class aJaminanService extends Controller
{

    private $Repository;

    public function __construct(aJaminanRepositoryImpl $Repository)
    {
        $this->Repository = $Repository;
    }
 
    public function getJaminanAllAktif($id)
    {
        try {   
                $data = $this->Repository->getJaminanAllAktif($id);
                return $this->sendResponse($data, "Data Jaminan ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
}