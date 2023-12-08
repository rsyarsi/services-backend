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
use App\Http\Repository\aHnaRepositoryImpl;
use App\Http\Repository\bVisitRepositoryImpl;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\bTarifRepositoryImpl; 
use App\Http\Repository\aTrsResepRepositoryImpl;

class bTrsResepService extends Controller {
    use AutoNumberTrait; 
    private $visitRepository;
    private $trsResep;
    private $doctorRepository;
    private $aHnaRepository; 

    public function __construct( 
        bVisitRepositoryImpl $visitRepository,
        aTrsResepRepositoryImpl $trsResep,
        aDoctorRepositoryImpl $doctorRepository,
        aHnaRepositoryImpl $aHnaRepository
        )
    {
        $this->visitRepository = $visitRepository;   
        $this->trsResep = $trsResep;   
        $this->doctorRepository = $doctorRepository;   
        $this->aHnaRepository = $aHnaRepository;   
    }

    public function viewOrderResepbyTrs(Request $request){
        try {   
            $datadokter = [];
            $viewResepHeader = $this->trsResep->viewResepHeader($request->IdResep)->first();
            $viewResepDetail = $this->trsResep->viewResepDetail($request->IdResep);
            $response = [
                'DataResep' => $viewResepHeader, 
                'listObat' => $viewResepDetail, 
            ];
            return $this->sendResponse($response, "Data Resep Ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function viewOrderResepDetail(Request $request){
        try {    
            $viewResepDetail = $this->trsResep->viewResepDetail($request->IdResep);
       
            $rows = array();
            foreach ($viewResepDetail as $key2) {
                $hna = $this->aHnaRepository->getHnaHighPeriodik($key2->IdBarang,'2023-11-08');
         
                if($hna->count() < 1 ){
                    $harga = 0;
                }else{
                    $datahna = $hna->first()->first();
                    $hargadasar = $datahna->NominalHna;
                    $hargaprofit = $hargadasar*1.4; 
                    $hargauangr = $hargaprofit*1.1;
                    $harga = $hargauangr+400;
                }
                $pasing['IdBarang'] = $key2->IdBarang;
                $pasing['NamaObat'] = $key2->NamaObat;
                $pasing['Quantity'] = $key2->Quantity;
                $pasing['Signa'] = $key2->Signa; 
                $pasing['Harga'] = $harga;
                $rows[] = $pasing;
            } 
            return $this->sendResponse($rows, "Data Resep Ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
     public function viewOrderReseV2pbyDatePeriode(Request $request) {
        try { 
            $viewResepDetail = $this->trsResep->viewOrderReseV2pbyDatePeriode($request); 
            return $this->sendResponse($viewResepDetail, "Data Resep Ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
     }
    
}