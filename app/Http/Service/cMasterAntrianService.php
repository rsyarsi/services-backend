<?php 
 
namespace App\Http\Service;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Traits\AutoNumberTrait; 
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller; 
use App\Http\Repository\cMasterDataAntrianRepositoryImpl;

class cMasterAntrianService extends Controller {
    use AutoNumberTrait; 
    private $antrianJenisRepo; 
    public function __construct( 
        cMasterDataAntrianRepositoryImpl $antrianJenisRepo
        )
    {
        $this->antrianJenisRepo = $antrianJenisRepo;   
    }
    
    public function CreateAntrianCounter(Request $request){
        // validator 
        if ($request->counterName === "" || $request->counterName === null) {
            return $this->sendError("Nama Counter Masih Kosong.", []);
        }
        if ($request->floorId === "" || $request->floorId === null) {
            return $this->sendError("Lantai Masih Kosong.", []);
        }
        if ($request->jenisAntrian === "" || $request->jenisAntrian === null) {
            return $this->sendError("Jenis Antrian Masih Kosong.", []);
        } 
        if ($request->ipaddress === "" || $request->ipaddress === null) {
            return $this->sendError("IP Address Masih Kosong.", []);
        } 
        if ($request->KodeUnit === "" || $request->KodeUnit === null) {
            return $this->sendError("Kode Unit Masih Kosong.", []);
        } 
        if ($request->jenisAntrian === "7" &&  $request->NamaUnit === "" || $request->NamaUnit === null) {
            return $this->sendError("Nama Unit Masih Kosong.", []);
        } 
        if ($request->jenisAntrian === "7" && $request->Side === "" || $request->Side === null) {
            return $this->sendError("Kode Side Masih Kosong.", []);
        }
        
        try {    
            if($this->antrianJenisRepo->getAntrianJenisbyCode($request->jenisAntrian)->count() < 1){
                return $this->sendError('Data Id Jenis Antrian tidak di temukan !', []);
            }  
                $createsatuan = $this->antrianJenisRepo->addCounterAntrian($request);
                if ($createsatuan) {
                    //response
                    return $this->sendResponse( [],"Counter Antrian berhasil di tambahkan.");  
                } else {
                    //response
                    return $this->sendError('Transaksi Gagal !', []);
                } 
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function UpdateAntrianCounter(Request $request){

        // validator 
        if ($request->counterName === "" || $request->counterName === null) {
            return $this->sendError("Nama Counter Masih Kosong.", []);
        }
        if ($request->floorId === "" || $request->floorId === null) {
            return $this->sendError("Lantai Masih Kosong.", []);
        }
        if ($request->jenisAntrian === "" || $request->jenisAntrian === null) {
            return $this->sendError("Jenis Antrian Masih Kosong.", []);
        } 
        if ($request->idCounter === "" || $request->idCounter === null) {
            return $this->sendError("Id Counter Masih Kosong.", []);
        } 
        if ($request->KodeUnit === "" || $request->KodeUnit === null) {
            return $this->sendError("Kode Unit Masih Kosong.", []);
        } 
        if ($request->jenisAntrian === "7" &&  $request->NamaUnit === "" || $request->NamaUnit === null) {
            return $this->sendError("Nama Unit Masih Kosong.", []);
        } 
        if ($request->jenisAntrian === "7" && $request->Side === "" || $request->Side === null) {
            return $this->sendError("Kode Side Masih Kosong.", []);
        }
        try {    
            if($this->antrianJenisRepo->getAntrianJenisbyCode($request->jenisAntrian)->count() < 1){
                return $this->sendError('Data Id Jenis Antrian tidak di temukan !', []);
            } 

            if($this->antrianJenisRepo->ViewbyIdAntrianCounter($request->idCounter)->count() < 1){
                return $this->sendError('Data Id Counter Antrian tidak di temukan !', []);
            }    

                $update = $this->antrianJenisRepo->updateCounterAntrian($request);
                if ($update) {
                    //response
                    return $this->sendResponse( [],"Counter Antrian berhasil di Update.");  
                } else {
                    //response
                    return $this->sendError('Transaksi Gagal !', []);
                } 
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function ListAllAntrianCounter(){
        try {    
            $response = $this->antrianJenisRepo->ListAllAntrianCounter();
            return $this->sendResponse($response, "Data Counter Antrian Ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function ViewbyIdAntrianCounter($id){
        try {    
            $response = $this->antrianJenisRepo->ViewbyIdAntrianCounter($id);
            return $this->sendResponse($response, "Data Counter Antrian Ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }

    public function ListAllAntrianJenis(){
        try {    
            $response = $this->antrianJenisRepo->ListAllAntrianJenis();
            return $this->sendResponse($response, "Data Jenis Antrian Ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function getAntrianJenisbyCode($id){
        try {    
            $response = $this->antrianJenisRepo->getAntrianJenisbyCode($id);
            return $this->sendResponse($response, "Data Jenis Antrian Ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function ViewbyIpAddress(Request $request){
        try {    
            $response = $this->antrianJenisRepo->ViewbyIpAddress($request->IpAddress);
            if($response->count() < 1){
                return $this->sendError('Counter dengan IP Address ini tidak di temukan !', []);
            } 
            return $this->sendResponse($response, "Data Counter Antrian Ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function ViewbyFloor(Request $request){
        try {    
            $response = $this->antrianJenisRepo->ViewbyFloor($request);
            if($response->count() < 1){
                return $this->sendError('Counter dengan Lantai ini tidak di temukan !', []);
            } 
            return $this->sendResponse($response, "Data Counter Antrian Ditemukan.");
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function Createcomplaint(Request $request){ 
        // validator 
        $Fullname = $request->Fullname;
        $Email = $request->Email;
        $PatientStatus = $request->PatientStatus;
        $Jenis = $request->Jenis;
        $Place = $request->Place;
        $Complain = $request->Complain;
        $NoHandphone = $request->NoHandphone;
        
        if ($Fullname === "" || $Fullname === null) {
            return $this->sendError("Silahkan Masukan Nama Anda.", []);
        }
        if ($Email === "" || $Email === null) {
            return $this->sendError("Silahkan Masukan Email Anda.", []);
        }
        if ($PatientStatus === "" || $PatientStatus === null) {
            return $this->sendError("Silahkan Masukan Hubungan Dengan Pasien.", []);
        } 
        if ($Jenis === "" || $Jenis === null) {
            return $this->sendError("Silahkan Masukan Jenis Komplain.", []);
        } 
        if ($Place === "" || $Place === null) {
            return $this->sendError("Silahkan Masukan Tempat Komplain !", []);
        } 
        if ($Complain === "" || $Complain === null) {
            return $this->sendError("Silahkan Masukan Komplain Anda Secara detail disini !", []);
        } 
        if ($NoHandphone === "" || $NoHandphone === null) {
            return $this->sendError("Silahkan Masukan No. Handphone anda.", []);
        } 
        try {    
                $createsatuan = $this->antrianJenisRepo->addCreatecomplaint($request);
                if ($createsatuan) {
                    //response
                    return $this->sendResponse( [],"Komplain Anda Berhasil di Input. Kami akan melakukan Feedback kembali untuk Anda.");  
                } else {
                    //response
                    return $this->sendError('Transaksi Gagal !', []);
                } 
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }

}