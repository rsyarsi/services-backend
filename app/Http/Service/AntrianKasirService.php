<?php

namespace App\Http\Service;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\AutoNumberTrait;
use App\Traits\VerificationTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Traits\ApiExternalConsumeTrait; 
use App\Http\Repository\UserRepositoryImpl; 
use App\Http\Repository\bAntrianKasirRepositoryImpl;
use App\Http\Repository\cMasterDataAntrianRepositoryImpl;

date_default_timezone_set("Asia/Jakarta");
class AntrianKasirService extends Controller
{
    use VerificationTrait;
    use ApiExternalConsumeTrait;
    use AutoNumberTrait;
    private $masterAntrianRepository;
    private $trsAntrianKasirRepository; 
    private $userLoginRepository;
    public function __construct(
        cMasterDataAntrianRepositoryImpl $masterAntrianRepository,
        bAntrianKasirRepositoryImpl $trsAntrianKasirRepository,
        UserRepositoryImpl $userLoginRepository
    )
    {
        $this->masterAntrianRepository = $masterAntrianRepository;
        $this->trsAntrianKasirRepository = $trsAntrianKasirRepository; 
        $this->userLoginRepository = $userLoginRepository; 
    }

    public function CreateAntrian(Request $request)
    {
        if ($request->Barcode == "") {
            return $this->sendError("Silahkan Scan Barcode Anda.", []);
        } 
        if ($request->FloorID == "") {
            return $this->sendError("Silahkan Masukan Lantai Pendaftarn.", []);
        } 
        
        try{

            DB::connection('sqlsrv3')->beginTransaction();
            DB::connection('sqlsrv2')->beginTransaction();

            // cari max antrian
            $datenow = Carbon::now()->toDateString();  
            $datenowFullDate = Carbon::now();  

            //verify kode sudah ada belum di hari itu
            $verify = $this->trsAntrianKasirRepository->VerifyAntrianKasirbyKodeAntrianDateNow($request->Barcode,$datenow);
            if ($verify->count() > 0 ) {
                return $this->sendError("Anda Scan Barcode, Silahkan Menunggu Untuk Dipanggil.", []);
            } 
            
            $autonumber = $this->AntrianKasir($datenow);
            $this->trsAntrianKasirRepository->CreateAntrianKasir($request,$request->Barcode,$datenowFullDate,$autonumber);
          
            DB::connection('sqlsrv3')->commit();
            DB::connection('sqlsrv2')->commit();
            return $this->sendResponse([], "Antrian Kasir Berhasil Di tambahkan. No. Antrian : ".$request->Barcode);   

        }catch (Exception $e) { 
            DB::connection('sqlsrv3')->rollBack();
            DB::connection('sqlsrv2')->rollBack();
            Log::info($e->getMessage()); 
            return $this->sendError($e->getMessage(), []);  
        }
    } 
    public function PanggilAntrian(Request $request)
    {
        if ($request->IDTrsAntrian == "") {
            return $this->sendError("Silahkan Masukan Id Transaksi Antrian Kasir.", []);
        } 
        if ($request->Username == "") {
            return $this->sendError("Silahkan Masukan Username Anda.", []);
        } 
        if ($request->ConterID == "") {
            return $this->sendError("Silahkan Masukan Counter ID.", []);
        } 
        if ($request->StatusAntrian == "") {
            return $this->sendError("Silahkan Masukan Status Antrian.", []);
        }  
        if ( $request->StatusAntrian <> "CALLED" ) {
            return $this->sendError("Status Antrian Invalid. ".  $request->StatusAntrian , []);
        } 
        try{
            DB::connection('sqlsrv3')->beginTransaction();
            DB::connection('sqlsrv2')->beginTransaction();
            // cari max antrian
            $datenow = Carbon::now()->toDateString();  

            $verifyAntrianAmdisionbyID = $this->trsAntrianKasirRepository->getAntrianKasirbyID($request->IDTrsAntrian);
            if ($verifyAntrianAmdisionbyID->count() < 1 ) {
                return $this->sendError("ID Transaksi Antrian Tidak diTemukan.", []);
            } 
            $verifyUsername = $this->userLoginRepository->getLoginSimrswithUserNameOnly($request->Username);
            if ($verifyUsername->count() < 1 ) {
                return $this->sendError("Username tidak ditemukan.", []);
            } 
            $verifyAntrianCounter = $this->masterAntrianRepository->ViewbyIdAntrianCounter($request->ConterID);
            if ($verifyAntrianCounter->count() < 1 ) {
                return $this->sendError("ID Counter tidak ditemukan.", []);
            } 

            $this->trsAntrianKasirRepository->PanggilAntrian($request, $datenow);
          
            DB::connection('sqlsrv3')->commit();
            DB::connection('sqlsrv2')->commit();
            return $this->sendResponse([], "Antrian berhasil di Panggil. ");   
        }catch (Exception $e) { 
            DB::connection('sqlsrv3')->rollBack();
            DB::connection('sqlsrv2')->rollBack();
            Log::info($e->getMessage()); 
            return $this->sendError($e->getMessage(), []);  
        }
    } 
    public function ProccesedAntrian(Request $request)
    {
        if ($request->IDTrsAntrian == "") {
            return $this->sendError("Silahkan Masukan Id Transaksi Antrian Kasir.", []);
        } 
     
        if ($request->Username == "") {
            return $this->sendError("Silahkan Masukan Username Anda.", []);
        } 
        if ($request->ConterID == "") {
            return $this->sendError("Silahkan Masukan Counter ID.", []);
        } 
        if ($request->StatusAntrian == "") {
            return $this->sendError("Silahkan Masukan Status Antrian.", []);
        }  
        if ( $request->StatusAntrian <> "PROCCESSED" ) {
            return $this->sendError("Status Antrian Invalid. ".  $request->StatusAntrian , []);
        } 
        try{
            DB::connection('sqlsrv3')->beginTransaction();
            DB::connection('sqlsrv2')->beginTransaction();
            // cari max antrian
            $datenow = Carbon::now()->toDateString();  

            $verifyAntrianAmdisionbyID = $this->trsAntrianKasirRepository->getAntrianKasirbyID($request->IDTrsAntrian);
            if ($verifyAntrianAmdisionbyID->count() < 1 ) {
                return $this->sendError("ID Transaksi Antrian Tidak diTemukan.", []);
            } 
            $verifyUsername = $this->userLoginRepository->getLoginSimrswithUserNameOnly($request->Username);
            if ($verifyUsername->count() < 1 ) {
                return $this->sendError("Username tidak ditemukan.", []);
            } 
            $verifyAntrianCounter = $this->masterAntrianRepository->ViewbyIdAntrianCounter($request->ConterID);
            if ($verifyAntrianCounter->count() < 1 ) {
                return $this->sendError("ID Counter tidak ditemukan.", []);
            } 

            $this->trsAntrianKasirRepository->ProccesedAntrian($request, $datenow);
          
            DB::connection('sqlsrv3')->commit();
            DB::connection('sqlsrv2')->commit();
            return $this->sendResponse([], "Antrian berhasil di Proses. ");   
        }catch (Exception $e) { 
            DB::connection('sqlsrv3')->rollBack();
            DB::connection('sqlsrv2')->rollBack();
            Log::info($e->getMessage()); 
            return $this->sendError($e->getMessage(), []);  
        }
    } 
    public function HoldAntrian(Request $request)
    {
        if ($request->IDTrsAntrian == "") {
            return $this->sendError("Silahkan Masukan Id Transaksi Antrian Kasir.", []);
        } 
     
        if ($request->Username == "") {
            return $this->sendError("Silahkan Masukan Username Anda.", []);
        } 
        if ($request->ConterID == "") {
            return $this->sendError("Silahkan Masukan Counter ID.", []);
        } 
        if ($request->StatusAntrian == "") {
            return $this->sendError("Silahkan Masukan Status Antrian.", []);
        }  
        if ( $request->StatusAntrian <> "HOLD" ) {
            return $this->sendError("Status Antrian Invalid. ".  $request->StatusAntrian , []);
        } 
        try{
            DB::connection('sqlsrv3')->beginTransaction();
            DB::connection('sqlsrv2')->beginTransaction();
            // cari max antrian
            $datenow = Carbon::now()->toDateString();  

            $verifyAntrianAmdisionbyID = $this->trsAntrianKasirRepository->getAntrianKasirbyID($request->IDTrsAntrian);
            if ($verifyAntrianAmdisionbyID->count() < 1 ) {
                return $this->sendError("ID Transaksi Antrian Tidak diTemukan.", []);
            } 
            $verifyUsername = $this->userLoginRepository->getLoginSimrswithUserNameOnly($request->Username);
            if ($verifyUsername->count() < 1 ) {
                return $this->sendError("Username tidak ditemukan.", []);
            } 
            $verifyAntrianCounter = $this->masterAntrianRepository->ViewbyIdAntrianCounter($request->ConterID);
            if ($verifyAntrianCounter->count() < 1 ) {
                return $this->sendError("ID Counter tidak ditemukan.", []);
            } 

            $this->trsAntrianKasirRepository->HoldAntrian($request, $datenow);
          
            DB::connection('sqlsrv3')->commit();
            DB::connection('sqlsrv2')->commit();
            return $this->sendResponse([], "Antrian berhasil di Hold. ");   
        }catch (Exception $e) { 
            DB::connection('sqlsrv3')->rollBack();
            DB::connection('sqlsrv2')->rollBack();
            Log::info($e->getMessage()); 
            return $this->sendError($e->getMessage(), []);  
        }
    } 
    public function ClosedAntrian(Request $request)
    {
        if ($request->IDTrsAntrian == "") {
            return $this->sendError("Silahkan Masukan Id Transaksi Antrian Kasir.", []);
        } 
     
        if ($request->Username == "") {
            return $this->sendError("Silahkan Masukan Username Anda.", []);
        } 
        if ($request->ConterID == "") {
            return $this->sendError("Silahkan Masukan Counter ID.", []);
        } 
        if ($request->StatusAntrian == "") {
            return $this->sendError("Silahkan Masukan Status Antrian.", []);
        }  
        if ( $request->StatusAntrian <> "CLOSED" ) {
            return $this->sendError("Status Antrian Invalid. ".  $request->StatusAntrian , []);
        } 
        try{
            DB::connection('sqlsrv3')->beginTransaction();
            DB::connection('sqlsrv2')->beginTransaction();
            // cari max antrian
            $datenow = Carbon::now()->toDateString();  

            $verifyAntrianAmdisionbyID = $this->trsAntrianKasirRepository->getAntrianKasirbyID($request->IDTrsAntrian);
            if ($verifyAntrianAmdisionbyID->count() < 1 ) {
                return $this->sendError("ID Transaksi Antrian Tidak diTemukan.", []);
            } 
            $verifyUsername = $this->userLoginRepository->getLoginSimrswithUserNameOnly($request->Username);
            if ($verifyUsername->count() < 1 ) {
                return $this->sendError("Username tidak ditemukan.", []);
            } 
            $verifyAntrianCounter = $this->masterAntrianRepository->ViewbyIdAntrianCounter($request->ConterID);
            if ($verifyAntrianCounter->count() < 1 ) {
                return $this->sendError("ID Counter tidak ditemukan.", []);
            } 

            $this->trsAntrianKasirRepository->ClosedAntrian($request, $datenow);
          
            DB::connection('sqlsrv3')->commit();
            DB::connection('sqlsrv2')->commit();
            return $this->sendResponse([], "Antrian berhasil di Closed. ");   

        }catch (Exception $e) { 
            DB::connection('sqlsrv3')->rollBack();
            DB::connection('sqlsrv2')->rollBack();
            Log::info($e->getMessage()); 
            return $this->sendError($e->getMessage(), []);  
        }
    } 
    public function ViewbyIdTrsAntrianKasir(Request $request){
        try {    
            $response = $this->trsAntrianKasirRepository->ViewbyIdTrsAntrianKasir($request->IDTrsAntrian)->first();
            return $this->sendResponse($response, "Data Antrian Ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function ViewbyDateTrsAntrianKasir(Request $request){
        try {    
            $response = $this->trsAntrianKasirRepository->ViewbyDateTrsAntrianKasir($request);
            return $this->sendResponse($response, "Data Antrian Ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function ViewbyDateTrsJaminanAntrianKasir(Request $request){
        try {    
            $response = $this->trsAntrianKasirRepository->ViewbyDateTrsJaminanAntrianKasir($request);
            return $this->sendResponse($response, "Data Antrian Ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
}