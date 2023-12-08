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

class dHrdTransaksiService extends Controller {
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
}