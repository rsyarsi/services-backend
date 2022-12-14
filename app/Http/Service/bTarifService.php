<?php 
 
namespace App\Http\Service;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Traits\AutoNumberTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator; 
use App\Http\Repository\bTarifRepositoryImpl; 

class bTarifService extends Controller {
    use AutoNumberTrait;
    private $tarif;  
    public function __construct(
        bTarifRepositoryImpl $tarif 
        )
    {
        $this->tarif = $tarif;   
    }

    public function getTarifRadiologi(Request $request){
        $data = $this->tarif->getTarifRadiologi($request);
            if ($data->count() > 0) { 
                return $this->sendResponse($data, "Data Tarif ditemukan.");
            } else {
                return $this->sendError("Data Tarif Not Found.", []);
            }
    }
    public function getTarifLaboratorium(Request $request){
        $data = $this->tarif->getTarifLaboratorium($request);
            if ($data->count() > 0) { 
                return $this->sendResponse($data, "Data Tarif ditemukan.");
            } else {
                return $this->sendError("Data Tarif Not Found.", []);
            }
    }
    public function getTarifRajal(Request $request){
        $data = $this->tarif->getTarifRajal($request);
            if ($data->count() > 0) { 
                return $this->sendResponse($data, "Data Tarif ditemukan.");
            } else {
                return $this->sendError("Data Tarif Not Found.", []);
            }
    }
    public function getTarifRanap(Request $request){
        $data = $this->tarif->getTarifRanap($request);
            if ($data->count() > 0) { 
                return $this->sendResponse($data, "Data Tarif ditemukan.");
            } else {
                return $this->sendError("Data Tarif Not Found.", []);
            }
    }
    public function getTarifMCU(Request $request){
        $data = $this->tarif->getTarifMCU($request);
            if ($data->count() > 0) { 
                return $this->sendResponse($data, "Data Tarif ditemukan.");
            } else {
                return $this->sendError("Data Tarif Not Found.", []);
            }
    }
    public function getTarifMCUAll(Request $request){
        $data = $this->tarif->getTarifMCUAll($request);
            if ($data->count() > 0) { 
                return $this->sendResponse($data, "Data Tarif ditemukan.");
            } else {
                return $this->sendError("Data Tarif Not Found.", []);
            }
    }
    // detil
    public function getTarifMcubyName(Request $request){
        $data = $this->tarif->getTarifMcubyName($request);
            if ($data->count() > 0) { 
                return $this->sendResponse($data, "Data Tarif ditemukan.");
            } else {
                return $this->sendError("Data Tarif Not Found.", []);
            }
    }
    public function getTarifRadiologibyID($ID){
        $data = $this->tarif->getTarifRadiologibyID($ID);
            if ($data->count() > 0) { 
                return $this->sendResponse($data->first(), "Data Tarif ditemukan.");
            } else {
                return $this->sendError("Data Tarif Not Found.", []);
            }
    }
    public function getTarifLaboratoriumbyID($ID){
        $data = $this->tarif->getTarifLaboratoriumbyID($ID);
            if ($data->count() > 0) { 
                return $this->sendResponse($data->first(), "Data Tarif ditemukan.");
            } else {
                return $this->sendError("Data Tarif Not Found.", []);
            }
    }
    public function getTarifRajalbyID($ID){
        $data = $this->tarif->getTarifRajalbyID($ID);
            if ($data->count() > 0) { 
                return $this->sendResponse($data->first(), "Data Tarif ditemukan.");
            } else {
                return $this->sendError("Data Tarif Not Found.", []);
            }
    }
    public function getTarifRanapbyID($ID){
        $data = $this->tarif->getTarifRanapbyID($ID);
            if ($data->count() > 0) { 
                return $this->sendResponse($data->first(), "Data Tarif ditemukan.");
            } else {
                return $this->sendError("Data Tarif Not Found.", []);
            }
    }
}