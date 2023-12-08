<?php

namespace App\Http\Service;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\AutoNumberTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;  
use App\Http\Repository\aStokRepositoryImpl;

class aStokService extends Controller
{
    private $aStokRepository;
    public function __construct( 
        aStokRepositoryImpl $aStokRepository 
    ) { 
        $this->aStokRepository = $aStokRepository;
    }
    public function getStokBarangbyUnitNameLike(Request $request)
    {
        // validate 
        $request->validate([
            "unit" => "required",
            "name" => "required" 
        ]);
        try {
            $count = $this->aStokRepository->getStokBarangbyUnitNameLike($request);
            if($count->count() > 0){ 
                return $this->sendResponse($count, "Data Product ditemukan.");
            }else{
                return $this->sendError("Data Product Found.", [], 400);
            }
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaction Gagal ditambahkan !', $e->getMessage());
        }
    }
}