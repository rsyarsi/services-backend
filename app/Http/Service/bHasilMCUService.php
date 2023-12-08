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
use App\Http\Repository\bHasilMCURepositoryImpl;
use Ramsey\Uuid\Uuid;

class bHasilMCUService extends Controller {
    use AutoNumberTrait;
    private $hasilmcu;   
    private $visit;   
    public function __construct(
        bHasilMCURepositoryImpl $hasilmcu ,
        bVisitRepositoryImpl $visit
        )
    {
        $this->hasilmcu = $hasilmcu;    
        $this->visit = $visit;    
    }
    public function hasilMCU($request)
    {
        $validator = Validator::make($request->all(), [
            "NoRegistrasi" => "required"  
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            
            // validasi jika Kode Pemriksaan Sudah Ada
            $dokter = $this->hasilmcu->showKonsulDokterMCU($request->NoRegistrasi);
            $header = $this->hasilmcu->hasilMCU($request->NoRegistrasi);
            $header2 = $this->hasilmcu->hasilMCU2($request->NoRegistrasi);
            $pasien = $this->visit->getRegistrationRajalbyNoreg($request->NoRegistrasi);
            
            $response = [
                'registrasi' => $pasien, 
                'dokter' => $dokter, 
                'reportMCU1' => $header, 
                'reportMCU2' => $header2 , 
            ];
            if($header->count() > 0  ){
                
                return $this->sendResponse($response,"Hasil MCU Ditemukan.");  
            }else{
                return $this->sendError("Hasil MCU Tidak Ditemukan.",[]);
            }
            
        }catch (Exception $e) { 
            
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
       
    public function uploaPdfMedicalCheckupbyKodeJenis(Request $request)
    {
        if ($request->KelompokHasil == "") {  
            return $this->sendError("Masukan ID Kelompok.", []);
        }
        if ($request->Url_Pdf_Local == "") {  
            return $this->sendError("Masukan Url PDF Local.", []);
        }
        if ($request->NoRegistrasi == "") {  
            return $this->sendError("Masukan No. Register.", []);
        }


        try{

            DB::connection('sqlsrv6')->beginTransaction();
            // update batal Labdetails
            $this->hasilmcu->uploaPdfMedicalCheckupbyKodeJenis($request);
            DB::connection('sqlsrv6')->commit();
            return $this->sendResponse([] ,"Pdf Hasil MCU Berhasil di SIMPAN.");  
            
        }catch (Exception $e) { 
            DB::connection('sqlsrv6')->rollBack(); 
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
    public function uploaPdfHasilMCUFinish(Request $request)
    {
        if ($request->NoRegistrasi == "") {  
            return $this->sendError("Masukan No. Registrasi.", []);
        }
        if ($request->Url_Pdf_Local == "") {  
            return $this->sendError("Masukan Url PDF Local.", []);
        }

        try{
            DB::connection('sqlsrv6')->beginTransaction();
            $this->hasilmcu->uploaPdfHasilMCUFinish($request);
            $this->hasilmcu->ResetuploaPdfHasilMCUFinish($request);
            DB::connection('sqlsrv6')->commit();
            return $this->sendResponse([] ,"Pdf Hasil MCU Akhir Berhasil di SIMPAN.");  
            
        }catch (Exception $e) { 
            DB::connection('sqlsrv6')->rollBack(); 
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
    public function listDocumentMCU($request)
    {
        $validator = Validator::make($request->all(), [
            "NoRegistrasi" => "required"  
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            // validasi jika Kode Pemriksaan Sudah Ada
            $header = $this->hasilmcu->listDocumentMCU($request->NoRegistrasi);
            if($header->count() > 0  ){
                
                return $this->sendResponse($header,"Document Report PDF MCU Ditemukan.");  
            }else{
                return $this->sendError("Document Report PDF MCU Tidak Ditemukan.",[]);
            }
            
        }catch (Exception $e) { 
            
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
    public function listReportPDFMCU($request)
    {
        if ($request->tglPeriodeBerobatAwal == "") {  
            return $this->sendError("Masukan Periode Awal.", []);
        }
        if ($request->tglPeriodeBerobatAkhir == "") {  
            return $this->sendError("Masukan Periode Akhir.", []);
        }
        try{
            // validasi jika Kode Pemriksaan Sudah Ada
            $header = $this->hasilmcu->listReportPDFMCU($request);
            if($header->count() > 0  ){
                
                return $this->sendResponse($header,"Document Report PDF MCU Ditemukan.");  
            }else{
                return $this->sendError("Document Report PDF MCU Tidak Ditemukan.",[]);
            }
            
        }catch (Exception $e) { 
            
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
    public function hasilMCUTreadmill($request)
    {
        $validator = Validator::make($request->all(), [
            "NoRegistrasi" => "required"  
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            // validasi jika Kode Pemriksaan Sudah Ada
            $data = $this->hasilmcu->hasilMCUTreadmill($request->NoRegistrasi);
            if($data->count() > 0  ){
                
                return $this->sendResponse($data,"Hasil MCU Treadmill Ditemukan.");  
            }else{
                return $this->sendError("Hasil MCU Treadmill Tidak Ditemukan.",[]);
            }
            
        }catch (Exception $e) { 
            
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
    public function hasilMCUJiwa($request)
    {
        $validator = Validator::make($request->all(), [
            "NoRegistrasi" => "required"  
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            // validasi jika Kode Pemriksaan Sudah Ada
            $data = $this->hasilmcu->hasilMCUJiwa($request->NoRegistrasi);
            if($data->count() > 0  ){
                
                return $this->sendResponse($data,"Hasil MCU Jiwa Ditemukan.");  
            }else{
                return $this->sendError("Hasil MCU Jiwa Tidak Ditemukan.",[]);
            }
            
        }catch (Exception $e) { 
            
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
    public function hasilMCUBebasNarkoba($request)
    {
        $validator = Validator::make($request->all(), [
            "NoRegistrasi" => "required"  
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            // validasi jika Kode Pemriksaan Sudah Ada
            $data = $this->hasilmcu->hasilMCUBebasNarkoba($request->NoRegistrasi);
            if($data->count() > 0  ){
                
                return $this->sendResponse($data,"Hasil MCU Bebas Narkoba Ditemukan.");  
            }else{
                return $this->sendError("Hasil MCU Bebas Narkoba Tidak Ditemukan.",[]);
            }
            
        }catch (Exception $e) { 
            
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
}