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
use App\Http\Repository\bVisitRepositoryImpl;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\bTarifRepositoryImpl; 
use App\Http\Repository\aTrsRadiologiRepositoryImpl;
use App\Http\Repository\aTrsLaboratoriumRepositoryImpl;

class bTrsRadiologiService extends Controller {
    use AutoNumberTrait;
    private $tarif;  
    private $visitRepository;
    private $trsRadiologi;
    private $doctorRepository;
    public function __construct(
        bTarifRepositoryImpl $tarif,
        bVisitRepositoryImpl $visitRepository,
        aTrsRadiologiRepositoryImpl $trsRadiologi,
        aDoctorRepositoryImpl $doctorRepository
        )
    {
        $this->tarif = $tarif;   
        $this->visitRepository = $visitRepository;   
        $this->trsRadiologi = $trsRadiologi;   
        $this->doctorRepository = $doctorRepository;   
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "NoRegistrasi" => "required",
            "dateOrder" => "required",
            "PositionOrder" => "required",
            "Keterangan_Klinik" => "required",
            "Daignosa" => "required", 
            "Kodetarif" => "required" 
        ]);

        try{
            DB::connection('sqlsrv8')->beginTransaction();
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            } 
            // CARI DATA PASIEN 
            if(Str::substr($request->NoRegistrasi, 0,4) == "RJUL"){
                // Jika walkin 
                $kelasid = "3";
             
            }else{
                // jika bukan walkin 
                $kelasid = "3";
               
                $data = $this->visitRepository->getRegistrationRajalbyNoreg($request->NoRegistrasi);
            }
            $datareg = $data->first();
            if($datareg->IdUnit == "1"){
                $PATIENT_LOCATION = "IGD";
            }else{
                $PATIENT_LOCATION = "RWJ";
            }
            $TRIGGER_DTTM = date("YmdHis", strtotime($request->dateOrder)); 
            $DOB = date('Ymd', strtotime($datareg->Date_of_birth));
            // Validasi tanggal order harus sama dengan tanggal Registrasi
            // if( date('Y-m-d', strtotime($request->dateOrder)) <> date('Y-m-d', strtotime($datareg->Visit_Date))){
            //     return  $this->sendError("Tanggal order Harus Sama dengan Tanggal Registrasi.");
            // }
            
            $validTrsTarif = $this->tarif->getTarifRadiologibyID($request->Kodetarif);
            $tarif = $validTrsTarif->first();

            $autoNumber = $this->genNumberOrderRad($TRIGGER_DTTM,$datareg->NoMR);

            // INSERT TRS ORDER RADIOLOGI
            $this->trsRadiologi->create($request,$tarif,$datareg,$kelasid,$autoNumber,$TRIGGER_DTTM,$DOB,$PATIENT_LOCATION);
            $this->trsRadiologi->createMWLWL($request,$tarif,$datareg,$kelasid,$autoNumber,$TRIGGER_DTTM,$DOB,$PATIENT_LOCATION);
            $response = array(
                'Accession_No' => $autoNumber[1],
                'WOID' => $autoNumber[0]
            ); 
            DB::connection('sqlsrv8')->commit();
            return $this->sendResponse($response ,"Order Radiologi Berhasil Di Simpan.");  
        }catch (Exception $e) { 
            DB::connection('sqlsrv8')->rollBack(); 
            Log::info($e->getMessage());
            
            return  $this->sendError($e->getMessage());
        }
    } 
    public function viewOrderRadbyMedrec($request)
    {
        $validator = Validator::make($request->all(), [
            "NoMR" => "required"  
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            // validasi jika Kode Pemriksaan Sudah Ada
            $header = $this->trsRadiologi->viewOrderRadbyMedrec($request);
            return $this->sendResponse($header ,"Order Radiologi Ditemukan.");  
        }catch (Exception $e) { 
            
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
    public function viewOrderRadbyMedrecPeriode($request)
    {
        $validator = Validator::make($request->all(), [
            "NoMR" => "required",
            "tglPeriodeBerobatAwal" => "required", 
            "tglPeriodeBerobatAkhir" => "required", 
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            // validasi jika Kode Pemriksaan Sudah Ada
            $header = $this->trsRadiologi->viewOrderRadbyMedrecPeriode($request);
            return $this->sendResponse($header ,"Order Radiologi Ditemukan.");  
        }catch (Exception $e) { 
            
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
}