<?php 
 
namespace App\Http\Service;

use Illuminate\Http\Request;
use App\Traits\AutoNumberTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Repository\bKamarOperasiRepositoryImpl;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeUnit\Exception;
use App\Http\Repository\UserRepositoryImpl;
use App\Http\Repository\bMedicalRecordRepositoryImpl;

class bKamarOperasiService extends Controller {
    use AutoNumberTrait;
    private $kamaroperasiRepository;

    public function __construct(bKamarOperasiRepositoryImpl $kamaroperasiRepository)
    {
        $this->kamaroperasiRepository = $kamaroperasiRepository;
    }
    public function AntrianOperasiRS(Request $request){
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $request->tanggalawal)) {
            $metadata = array(
                'message' => "Format Tanggal Awal Tidak Sesuai, format yang benar adalah yyyy-mm-dd", // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
        }
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $request->tanggalakhir)) {
            $metadata = array(
                'message' => "Format Tanggal Akhir Tidak Sesuai, format yang benar adalah yyyy-mm-dd", // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
        }
        //cek kelengkapan data
        if (date("Y-m-d", strtotime($request->tanggalakhir)) < date("Y-m-d", strtotime($request->tanggalawal))) {
            $metadata = array(
                'message' => "Tanggal Periode Akhir Lebih Kecil Dari Tanggal Periode Awal.", // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
        }
        try {
            $count = $this->kamaroperasiRepository->AntrianOperasiRS($request)->count();
            if ($count > 0) {
                $data = $this->kamaroperasiRepository->AntrianOperasiRS($request);
                $response = array(
                    'list' => $data,   
                );
                $metadata = array(
                    'message' => 'Ok',
                    'code' => 200,
                );
                return $this->sendResponseNew($response, $metadata);
            } else {
                return $this->sendError("Data Tidak Ditemukan.", [], 201);
            }

        }catch (Exception $e) {
            Log::info($e->getMessage());
            $metadata = array(
                    'message' => 'Process Cancelled.', // Set array status dengan success     
                    'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
                );
            return  $this->sendErrorTrsNew($e->getMessage(),$metadata);
        }    
    }  
    public function AntrianOperasiPasien(Request $request){
        
        try {
            $count = $this->kamaroperasiRepository->AntrianOperasiPasien($request)->count();
            if ($count > 0) {
                $data = $this->kamaroperasiRepository->AntrianOperasiPasien($request);
                $response = array(
                    'list' => $data,   
                );
                $metadata = array(
                    'message' => 'Ok',
                    'code' => 200,
                );
                return $this->sendResponseNew($response, $metadata);
            } else {
                return $this->sendError("Data Tidak Ditemukan.", [], 201);
            }

        }catch (Exception $e) {
            Log::info($e->getMessage());
            $metadata = array(
                    'message' => 'Process Cancelled.', // Set array status dengan success     
                    'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
                );
            return  $this->sendErrorTrsNew($e->getMessage(),$metadata);
        }    
      
    }  

}
