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
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\aTrsLaboratoriumRepositoryImpl;
use Illuminate\Support\Facades\Validator; 
use App\Http\Repository\bVisitRepositoryImpl;
use App\Http\Repository\bTarifRepositoryImpl; 

class bTrsLaboratoriumService extends Controller {
    use AutoNumberTrait;
    private $tarif;  
    private $visitRepository;
    private $trsLaboratorium;
    private $doctorRepository;
    public function __construct(
        bTarifRepositoryImpl $tarif,
        bVisitRepositoryImpl $visitRepository,
        aTrsLaboratoriumRepositoryImpl $trsLaboratorium,
        aDoctorRepositoryImpl $doctorRepository
        )
    {
        $this->tarif = $tarif;   
        $this->visitRepository = $visitRepository;   
        $this->trsLaboratorium = $trsLaboratorium;   
        $this->doctorRepository = $doctorRepository;   
    }
    public function createheader(Request $request){
        $validator = Validator::make($request->all(), [
            "Keterangan_Klinik" => "required",
            "Daignosa" => "required",
            "NoRegistrasi" => "required",
            "dateOrder" => "required" 
        ]);

        try{
            DB::connection('sqlsrv7')->beginTransaction();
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            // DATE FORMAT 
            $datenowlis= date('dmy', strtotime($request->dateOrder)); 
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
            
            // Validasi tanggal order harus sama dengan tanggal Registrasi
            if( date('Y-m-d', strtotime($request->dateOrder)) <> date('Y-m-d', strtotime($datareg->Visit_Date))){
                return  $this->sendError("Tanggal order Harus Sama dengan Tanggal Registrasi.");
            }
        
            $getNotrsLabNext = $this->genNumberOrderLab($datenowlis);
            
            // INSERT HEADER TRS LABORATORIUM
            $this->trsLaboratorium->createHeader($request,$getNotrsLabNext,$datareg,$kelasid);
            $response = array(
                'RecID' => $getNotrsLabNext[0],
                'LabID' => $getNotrsLabNext[1],
                'NoOrderLabLIS' => $getNotrsLabNext[4] 
            ); 
            DB::connection('sqlsrv7')->commit();
            return $this->sendResponse($response ,"Order Laboratorium Berhasil Di Simpan.");  
        }catch (Exception $e) { 
            DB::connection('sqlsrv7')->rollBack(); 
            Log::info($e->getMessage());
            
            return  $this->sendError($e->getMessage());
        }
    } 
    public function createdetil(Request $request){
        $validator = Validator::make($request->all(), [
            "NoTrsOrderLab" => "required",
            "IdTes" => "required",
            "NominalTarif" => "required",
            "IdDokter" => "required",
            "KodeKelompokTes" => "required" 
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            DB::connection('sqlsrv7')->beginTransaction();
          
 
            // Validasi Kode Trs Order Lab
            $validTrsOrder = $this->trsLaboratorium->getTrsLabbyNoOrder($request->NoTrsOrderLab);
            
            if($validTrsOrder->count() < 1){
                return $this->sendError("Data Order Lab Tidak Di temukan.",[]);
            } 
            $dataTrsLab = $validTrsOrder->first();
            
            // Validasi Kode Pemeriksaan Lab
            $validTarifLab = $this->tarif->getTarifLaboratoriumbyID($request->IdTes);
            if($validTarifLab->count() < 1){
                return $this->sendError("Data tarif Lab Tidak Di temukan.",[]);
            } 
            $dataTarifLab = $validTarifLab->first();

            // Validasi Kode Dokter
            $validDokter = $this->doctorRepository->getDoctorbyId($request->IdDokter);
            if($validDokter->count() < 1){
                return $this->sendError("Data Dokter Tidak Di temukan.",[]);
            } 
         
            // validasi jika Kode Pemriksaan Sudah Ada
            $validLabdetil = $this->trsLaboratorium->getTrsLabDetail($request);
            if($validLabdetil->count() > 0){
                return $this->sendError("Kode Pemeriksaan Ini Sudah Ada, cek kembali Orderan anda.",[]);
            } 
             
            // Validasi Jika sudah di Receive
            $validReceived = $this->trsLaboratorium->getTrsLabHasReceived($request);
            if($validReceived->count() > 0){
                return $this->sendError("Kode Pemeriksaan Ini Sudah di Receive, cek kembali Orderan anda.",[]);
            } 
            
            // INSERT DETIL TRS LABORATORIUM
            $this->trsLaboratorium->createDetail($request);
            DB::connection('sqlsrv7')->commit();
            return $this->sendResponse([] ,"Order Laboratorium Detail Berhasil Di Simpan.");  
        }catch (Exception $e) { 
            DB::connection('sqlsrv7')->rollBack(); 
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
    public function sendLis($request)
    {
        $validator = Validator::make($request->all(), [
            "NoTrsOrderLab" => "required",
            "LabID" => "required",
            "Keterangan_Klinik" => "required",
            "Daignosa" => "required",
            "NamaUser" => "required",
            "NoRegistrasi" => "required",
            "dateOrder" => "required"  
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            DB::connection('sqlsrv7')->beginTransaction();
            // validasi jika Kode Pemriksaan Sudah Ada
            $validLabdetil = $this->trsLaboratorium->getTrsLabDetaiAllbyTrs($request);
           
            if($validLabdetil->count() < 1){
                return $this->sendError("Tidak ada Pemeriksaan, cek kembali Orderan anda.",[]);
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

            // INSERT LIS HEADER
            $this->trsLaboratorium->createHeaderLis($request,$datareg,$kelasid);
            
            // INSERT LIS DETIL
            $validLabdetil = $this->trsLaboratorium->getTrsLabDetaiAllbyTrs($request);
            foreach ($validLabdetil as $key ) {
            # code...
                $this->trsLaboratorium->createLisDetil($request,$datareg,$key);
            }
            DB::connection('sqlsrv7')->commit();
            return $this->sendResponse([] ,"Order Laboratorium Berhasil dikirim ke LIS.");  

        }catch (Exception $e) { 
            DB::connection('sqlsrv7')->rollBack(); 
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
    public function viewOrderLabbyTrs($request)
    {
        $validator = Validator::make($request->all(), [
            "NoTrsOrderLab" => "required",
            "LabID" => "required", 
            "NoRegistrasi" => "required", 
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            // validasi jika Kode Pemriksaan Sudah Ada
            $header = $this->trsLaboratorium->getTrsLabbyNoOrder($request->NoTrsOrderLab)->first();
            $Labdetil = $this->trsLaboratorium->getTrsLabDetaiAllbyTrs($request);
            $response = array(
                'header' => $header,
                'detil' => $Labdetil
            ); 
            return $this->sendResponse($response ,"Order Laboratorium Ditemukan.");
        }catch (Exception $e) { 
            
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
    public function viewOrderLabbyMedrec($request)
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
            $header = $this->trsLaboratorium->viewOrderLabbyMedrecPeriode($request);
            return $this->sendResponse($header ,"Order Laboratorium Ditemukan.");  
        }catch (Exception $e) { 
            
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
}