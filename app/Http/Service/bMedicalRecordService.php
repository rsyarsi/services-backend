<?php 
 
namespace App\Http\Service;

use Illuminate\Http\Request;
use App\Traits\AutoNumberTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeUnit\Exception;
use App\Http\Repository\UserRepositoryImpl;
use App\Http\Repository\bMedicalRecordRepositoryImpl;

class bMedicalRecordService extends Controller {
    use AutoNumberTrait;
    private $medrecRepository;

    public function __construct(bMedicalRecordRepositoryImpl $medrecRepository)
    {
        $this->medrecRepository = $medrecRepository;
    }

    public function PasienBaru(Request $request){
        if ($request->nomorkartu === "" || $request->nomorkartu === null) {
            $metadata = array(
                'message' => "No. Kartu Belum Diisi.", // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
        }
        if ($request->nik === "" || $request->nik === null) {
            $metadata = array(
                'message' => 'No. NIK Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
             
        }
        if ($request->nomorkk=== "" || $request->nomorkk === null) {
            $metadata = array(
                'message' => 'No. KK Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
             
        }
        if ($request->nama === "" || $request->nama === null) {
            $metadata = array(
                'message' => 'Nama Pasien Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            exit;
        }

        if ($request->jeniskelamin === "" || $request->jeniskelamin === null) {
            $metadata = array(
                'message' => 'Jenis Kelamin Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            exit;
        }
        if ($request->tanggallahir === "" || $request->tanggallahir === null) {
            $metadata = array(
                'message' => 'Jenis Kelamin Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $request->tanggallahir)) {
            $metadata = array(
                'message' => "Format Tanggal Tidak Sesuai, format yang benar adalah yyyy-mm-dd", // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
         
        if ($request->nohp === "" || $request->nohp === null) {
            $metadata = array(
                'message' => 'Jam Praktek Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
             
        }
        if ($request->alamat === "" || $request->alamat === null) {
            $metadata = array(
                'message' => 'Alamat Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
             
        }
        if ($request->kodeprop === "" || $request->kodeprop === null) {
            $metadata = array(
                'message' => 'Kode Prov Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
        if ($request->namaprop === "" || $request->namaprop === null) {
            $metadata = array(
                'message' => 'Nama Prov Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
             
        }
        if ($request->kodedati2 === "" || $request->kodedati2 === null) {
            $metadata = array(
                'message' => 'Kode Dati Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            exit;
        }
        if ($request->namadati2 === "" || $request->namadati2 === null) {
            $metadata = array(
                'message' => 'Nama Dati Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
        if ($request->kodekec === "" || $request->kodekec === null) {
            $metadata = array(
                'message' => 'Kode Kecamatan Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
        if ($request->namakec === "" || $request->namakec === null) {
            $metadata = array(
                'message' => 'Nama Kecamatan Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
           
        }
        if ($request->kodekel === "" || $request->kodekel === null) {
            $metadata = array(
                'message' => 'kode Kelurahan Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
         
        }
        if ($request->namakel === "" || $request->namakel === null) {
            $metadata = array(
                'message' => 'Nama Kelurahan Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
           
        }
        if ($request->rw === "" || $request->rw === null) {
            $metadata = array(
                'message' => 'RT Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            exit;
        }
        if ($request->rt === "" || $request->rt === null) {
            $metadata = array(
                'message' => 'RW Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
        if (!is_numeric($request->nomorkartu) || strlen($request->nomorkartu) <>13) {
            $metadata = array(
                'message' => 'Format Nomor Kartu Tidak Sesuai.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
        if (!is_numeric($request->nik) || strlen($request->nik) <> 16) {
            $metadata = array(
                'message' => 'Format NIK Kartu Tidak Sesuai.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }

        if (date("Y-m-d", strtotime($request->tanggallahir)) > date("Y-m-d")) {
            $metadata = array(
                'message' => 'Format Tanggal Lahir Tidak Sesuai.',
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
           
        }
        
        // create data disini
        if ($this->medrecRepository->getMedrecbyNIK($request->nik)->count() > 0 ) {
            $metadata = array(
                'message' => 'Data Peserta Sudah Pernah Dientrikan.',
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
        }
         
        try {
            // Db Transaction
            DB::beginTransaction();
            $autonumber = $this->MedrecNumber();
            //CONVERT No. Mr
            $idkanan = substr($autonumber, 4); // xx-xx-03 kanan
            $idtengah = substr($autonumber, 2, -2); //
            $idkiri = substr($autonumber, 0, -4);
            $NoMrfix =   $idkiri . '-' . $idtengah . '-' . $idkanan;
            $nourutfixMR = $idkiri . $idtengah . $idkanan;
            $aktif ="1";
            $jnsid="KTP";
            $hidden_tptlahir = "-";
            
            $this->medrecRepository->create($request, $aktif,$jnsid,$hidden_tptlahir,$NoMrfix,$nourutfixMR,$autonumber);
            DB::commit();
            $response = array(
                'norm' => $NoMrfix, 
            );
            $metadata = array(
                'message' => 'Harap datang ke admisi untuk melengkapi data rekam medis',
                'code' => 200,
            );
            return $this->sendResponseNew($response, $metadata);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            $metadata = array(
                    'message' => 'Gagal', // Set array status dengan success     
                    'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
                );
            return  $this->sendErrorTrsNew($e->getMessage(),$metadata);
        }    
    } 
    public function createwalkin(Request $request){
         
        if ($request->nomorkartu === "" || $request->nomorkartu === null) {
            $metadata = array(
                'message' => "No. Kartu Belum Diisi.", // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
        }
        if ($request->nik === "" || $request->nik === null) {
            $metadata = array(
                'message' => 'No. NIK Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
             
        }
        if ($request->nomorkk=== "" || $request->nomorkk === null) {
            $metadata = array(
                'message' => 'No. KK Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
             
        }
        if ($request->nama === "" || $request->nama === null) {
            $metadata = array(
                'message' => 'Nama Pasien Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            exit;
        }

        if ($request->jeniskelamin === "" || $request->jeniskelamin === null) {
            $metadata = array(
                'message' => 'Jenis Kelamin Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            exit;
        }
        if ($request->tanggallahir === "" || $request->tanggallahir === null) {
            $metadata = array(
                'message' => 'Jenis Kelamin Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $request->tanggallahir)) {
            $metadata = array(
                'message' => "Format Tanggal Tidak Sesuai, format yang benar adalah yyyy-mm-dd", // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
         
        if ($request->nohp === "" || $request->nohp === null) {
            $metadata = array(
                'message' => 'Jam Praktek Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
             
        }
        if ($request->alamat === "" || $request->alamat === null) {
            $metadata = array(
                'message' => 'Alamat Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
             
        }
        if ($request->kodeprop === "" || $request->kodeprop === null) {
            $metadata = array(
                'message' => 'Kode Prov Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
        if ($request->namaprop === "" || $request->namaprop === null) {
            $metadata = array(
                'message' => 'Nama Prov Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
             
        }
        if ($request->kodedati2 === "" || $request->kodedati2 === null) {
            $metadata = array(
                'message' => 'Kode Dati Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            exit;
        }
        if ($request->namadati2 === "" || $request->namadati2 === null) {
            $metadata = array(
                'message' => 'Nama Dati Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
        if ($request->kodekec === "" || $request->kodekec === null) {
            $metadata = array(
                'message' => 'Kode Kecamatan Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
        if ($request->namakec === "" || $request->namakec === null) {
            $metadata = array(
                'message' => 'Nama Kecamatan Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
           
        }
        if ($request->kodekel === "" || $request->kodekel === null) {
            $metadata = array(
                'message' => 'kode Kelurahan Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
         
        }
        if ($request->namakel === "" || $request->namakel === null) {
            $metadata = array(
                'message' => 'Nama Kelurahan Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
           
        }
        if ($request->rw === "" || $request->rw === null) {
            $metadata = array(
                'message' => 'RT Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            exit;
        }
        if ($request->rt === "" || $request->rt === null) {
            $metadata = array(
                'message' => 'RW Belum Diisi.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
        if (!is_numeric($request->nomorkartu) || strlen($request->nomorkartu) <>13) {
            $metadata = array(
                'message' => 'Format Nomor Kartu Tidak Sesuai.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }
        if (!is_numeric($request->nik) || strlen($request->nik) <> 16) {
            $metadata = array(
                'message' => 'Format NIK Kartu Tidak Sesuai.', // Set array status dengan success     
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
            
        }

        if (date("Y-m-d", strtotime($request->tanggallahir)) > date("Y-m-d")) {
            $metadata = array(
                'message' => 'Format Tanggal Lahir Tidak Sesuai.',
                'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
            );
            return  $this->sendErrorNew($metadata,null);
           
        }
        
        
         
        try {
            // Db Transaction
            DB::beginTransaction();

            // create data disini
            if ($this->medrecRepository->getMedrecWalkinbyNIK($request->nik)->count() > 0 ) {
                $metadata = array(
                    'message' => 'Data Peserta Sudah Pernah Dientrikan.',
                    'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
                );
                return  $this->sendErrorNew($metadata,null);
            }

            $autonumber = $this->MedrecWalkinNumber();
            //CONVERT No. Mr
            $idkanan = substr($autonumber, 4); // xx-xx-03 kanan
            $idtengah = substr($autonumber, 2, -2); //
            $idkiri = substr($autonumber, 0, -4);
            $NoMrfix =   "W-".$idkiri .  $idtengah . $idkanan;
            $nourutfixMR = $idkiri . $idtengah . $idkanan;
            $aktif ="1";
            $jnsid="KTP";
            $hidden_tptlahir = "-";
            
            $this->medrecRepository->createWalkin($request, $aktif,$jnsid,$hidden_tptlahir,$NoMrfix,$nourutfixMR,$autonumber);
            DB::commit();
            $response = array(
                'norm' => $NoMrfix, 
            );
            $metadata = array(
                'message' => 'Harap datang ke admisi untuk melengkapi data rekam medis',
                'code' => 200,
            );
            return $this->sendResponseNew($response, $metadata);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            $metadata = array(
                    'message' => 'Gagal', // Set array status dengan success     
                    'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
                );
            return  $this->sendErrorTrsNew($e->getMessage(),$metadata);
        }
    } 
    public function nonwalkin($id)
    {
        try {   
            // validator 
            $count = $this->medrecRepository->getMedrecbyNoMR($id)->count();

            if ($count > 0) {
                $data = $this->medrecRepository->getMedrecbyNoMR($id)->first();
                $response = array(
                    'data' => $data,   
                );
                $metadata = array(
                    'message' => 'Data Ditemukan',
                    'code' => 200,
                );
                return $this->sendResponseNew($response, $metadata);
            } else {
                return $this->sendError("Data Not Found.", [], 400);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function walkin($id)
    {
        try {   
            // validator 
            $count = $this->medrecRepository->getMedrecWalkinbyNoMR($id)->count();

            if ($count > 0) {
                $data = $this->medrecRepository->getMedrecWalkinbyNoMR($id)->first();
                $response = array(
                    'data' => $data, 
                );
                $metadata = array(
                    'message' => 'Data Ditemukan',
                    'code' => 200,
                );
                return $this->sendResponseNew($response, $metadata);
            } else {
                return $this->sendError("Data Not Found.", [], 400);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
}
