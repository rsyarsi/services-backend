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
            $Labdetil = $this->trsLaboratorium->getTrsLabDetaiAllbyTrs($request->NoTrsOrderLab);
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
    public function createLaboratoriumOrder(Request $request){
        $validator = Validator::make($request->all(), [
            "Keterangan_Klinik" => "required",
            "Daignosa" => "required",
            "NoRegistrasi" => "required",
            "dateOrder" => "required",
            "JenisOrder" => "required",
            "CodeOrder" => "required",
            "IdDokter" => "required",
            "NamaJaminan" => "required",
            "NamaUser" => "required",
            "FlagPA" =>"required"
        ]);
        $dateNow = Carbon::now();
          
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        //validate  // Validasi Kode Dokter
        $validDokter = $this->doctorRepository->getDoctorbyId($request->IdDokter);
        if($validDokter->count() < 1){
            return $this->sendError("Data Dokter Tidak Di temukan.",[]);
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
        if($data->count() > 0){
            $datareg = $data->first();
        }else{
            return  $this->sendError("No. Registrasi Tidak di Temukan.");
        }
      
        
        // validasi jika items kosong
        if(count($request->Items) < 1){
            return  $this->sendError("Item Pemeriksaan Kosong, silahkan Masukan Item Pemeriksaan.");
        }

        // Validasi tanggal order harus sama dengan tanggal Registrasi
        if( date('Y-m-d', strtotime($request->dateOrder)) <> date('Y-m-d', strtotime($datareg->Visit_Date))){
            return  $this->sendError("Tanggal order Harus Sama dengan Tanggal Registrasi.");
        }


        // validasi Kode pemeriksaan jika sudah ada atas no trs
        // foreach ($request->Items as $key) { 
        //     if ($this->trsLaboratorium->getTrsLabDetail($request,$key['KodeKelompokTes'])->count() > 0) {
        //        return $this->sendError("Kode Pemeriksaan Ini Sudah Ada, cek kembali Orderan anda.",[]);
        //     }
        // }

        // validasi tarif pemeriksaan
        foreach ($request->Items as $key) { 
            if ($this->tarif->getTarifLaboratoriumbyID($key['IdTes'])->count() < 1) {
                return $this->sendError('Data tarif Lab Tidak Di temukan.', []);
            }
        }

        try{
            if($request->NoTrsOrderLab == ""){ // Jika input baru
                DB::connection('sqlsrv7')->beginTransaction();
                $getNotrsLabNext = $this->genNumberOrderLab($datenowlis);
                // INSERT HEADER TRS LABORATORIUM
                $this->trsLaboratorium->createHeader($request,$getNotrsLabNext,$datareg,$kelasid);
                $RecID =  $getNotrsLabNext[0];
                $LabID = $getNotrsLabNext[1];
                $NoOrderLabLIS = $getNotrsLabNext[4];
                // INSERT DETAIL TRS LABORATORIUM
                foreach ($request->Items as $key) {
                    # code...
                    // cek kode barangnya ada ga
                    $this->trsLaboratorium->createDetail($key,$RecID,$LabID,$NoOrderLabLIS,$request);
                }
                // // INSERT LIS HEADER
                $this->trsLaboratorium->createHeaderLis($request,$datareg,$kelasid,$NoOrderLabLIS);        
                // // INSERT LIS DETIL
                $validLabdetil = $this->trsLaboratorium->getTrsLabDetaiAllbyTrs($NoOrderLabLIS);
                foreach ($validLabdetil as $key ) {
                # code...
                    $this->trsLaboratorium->createLisDetil($request,$datareg,$key,$NoOrderLabLIS,$dateNow);
                }
            }else{ // jika di edit

                //verifikasi tabel lab detail vs lis detail
                $LabNotReceived = $this->trsLaboratorium->getTrsLabDetailNotReceived($request);
                foreach ($LabNotReceived as $keyNotReceived ) {
                    # code...
                        $data = substr($keyNotReceived->kode_test,0,2);
                        $lisdetil = $this->trsLaboratorium->getTrsOrderLisDetailHasRecived($request,$data);
                        
                        if($lisdetil->count() > 0 ){
                            return $this->sendError('Sudah Ada Receive Sample, Silahkan Buatkan No. Trs Order baru Untuk Menambahkan Pemeriksaan Lainnya !', []);
                        } 
                }

                // INSERT DETAIL TAMBAHAN 
                foreach ($request->Items as $key) {
                    # code...
                    // cek kode test ini sudah ada belum di tabel, jika ada insert
                    $findDetil = $this->trsLaboratorium->getTrsLabDetailbyNoTrsLabIdTest($request,$key['IdTes']);
                    if($findDetil->count() < 1){  // jika tidak ada ya di insert aja
                        // insert tbllabdetial
                        //$this->trsLaboratorium->createDetail($key,'',$request->LabID,$request->NoTrsOrderLab,$request);
                    } 

                    // cek di tabel list detail
                    $findLISDetil = $this->trsLaboratorium->getTrsOrderLisDetailActive($request,$key['KodeKelompokTes']);
                    if($findLISDetil->count() < 1){  // jika tidak ada ya di insert aja
                        // insert tbllabdetial
                        $validLabdetil = $this->trsLaboratorium->getTrsLabDetailbyNoTrsLabIdTest($request,$key['IdTes']);
                        foreach ($validLabdetil as $key ) {
                        # code...
                            
                             $this->trsLaboratorium->createLisDetil($request,$datareg,$key,$request->NoTrsOrderLab,$dateNow);
                        }
                       
                    } 

                }
                // update is taken false lagi
                $this->trsLaboratorium->updateBatalLISOrderisTakenFalse($request);
            }
            
            DB::connection('sqlsrv7')->commit();
            return $this->sendResponse([] ,"Order Laboratorium Detail Berhasil Di Simpan.");  
        }catch (Exception $e) { 
            DB::connection('sqlsrv7')->rollBack(); 
            Log::info($e->getMessage());
            
            return  $this->sendError($e->getMessage());
        }
    } 
    public function deleteOrderLaboratoriumDetail(Request $request)
    {
        if ($request->IdDetail == "") {  
            return $this->sendError("ID Data Detail Kosong.", []);
        }
        if ($request->NoRegistrasi == "") {  
            return $this->sendError("No. Registrasi Kosong.", []);
        }
        if ($request->NoTrsOrderLab == "") {  
            return $this->sendError("No. Transaksi Order Laboratorium Kosong.", []);
        }
        if ($request->NamaUser == "") {  
            return $this->sendError("Nama User Kosong.", []);
        }
        if ($request->Note == "") {  
            return $this->sendError("Alasan Batal harus Diisi.", []);
        }
        $visit = $this->visitRepository->getRegistrationRajalbyNoreg($request->NoRegistrasi);
        if($visit->count() < 1 ){
            return $this->sendError("No. Registrasi Invalid.",[]);
        }  
        //cek apakah id itu ada 
        $datadetail = $this->trsLaboratorium->getTrsLabDetailbyIdDetail($request);
        $cek = $datadetail->first();
        if($datadetail->count() < 1){
            return $this->sendError("Data Order Lab Detail Tidak di Temukan.",[]);
        }  

        //cek sudah di received belum
        if($cek->st_received == "1"){
            return $this->sendError("Sample Sudah di Received. Pemeriksaan Tidak bisa di Batalkan.",[]);
        }

        // cek register sudah di closed belum
        $dataVisit = $visit->first();
        if($dataVisit->StatusID == 4 ){
            return $this->sendError("No. Registrasi Sudah Di Close.",[]);
        } 

        try{

            DB::connection('sqlsrv7')->beginTransaction();
            $edited = Carbon::now() . ' - ' . $request->NamaUser; 

            // update batal Labdetails
            $this->trsLaboratorium->updateBatalLabdetail($request,$edited);

            //update batal LIS Detail
            $this->trsLaboratorium->updateBatalLISDetail($request,$cek->KodeKelompok);

            DB::connection('sqlsrv7')->commit();
            return $this->sendResponse([] ,"Order Laboratorium Detail Berhasil Di Hapus.");  
            
        }catch (Exception $e) { 
            DB::connection('sqlsrv7')->rollBack(); 
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
    public function deleteOrderLaboratorium(Request $request)
    {
        if ($request->NoRegistrasi == "") {  
            return $this->sendError("No. Registrasi Kosong.", []);
        }
        if ($request->NoTrsOrderLab == "") {  
            return $this->sendError("No. Transaksi Order Laboratorium Kosong.", []);
        }
        if ($request->NamaUser == "") {  
            return $this->sendError("Nama User Kosong.", []);
        }
        if ($request->Note == "") {  
            return $this->sendError("Alasan Batal harus Diisi.", []);
        }

        $visit = $this->visitRepository->getRegistrationRajalbyNoreg($request->NoRegistrasi);
        if($visit->count() < 1 ){
            return $this->sendError("No. Registrasi Invalid.",[]);
        }  

        $dataVisit = $visit->first();
        if($dataVisit->StatusID == 4 ){
            return $this->sendError("No. Registrasi Sudah Di Close.",[]);
        } 

        try{

            DB::connection('sqlsrv7')->beginTransaction();
            $edited = Carbon::now() . ' - ' . $request->NamaUser; 

            // update batal Labdetails
            $this->trsLaboratorium->updateBatalLabDetailAll($request,$edited);

            // update batal labheader
            $this->trsLaboratorium->updateBatalLabHeader($request,$edited);

            //update batal LIS Detail
            $this->trsLaboratorium->updateBatalLISOrderDetailAll($request);

            //update batal LIS Header
            $this->trsLaboratorium->updateBatalLISOrderHeader($request);

            DB::connection('sqlsrv7')->commit();
            return $this->sendResponse([] ,"Order Laboratorium Berhasil Di Hapus."); 
            
        }catch (Exception $e) { 
            DB::connection('sqlsrv7')->rollBack(); 
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }

    }
    public function viewHasilLaboratorium($request)
    {
        $validator = Validator::make($request->all(), [
            "NoTrsOrderLab" => "required", 
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            $Labdetil = $this->trsLaboratorium->viewHasilLaboratoriumbyTrs($request->NoTrsOrderLab);
            if($Labdetil->count() > 0){
                return $this->sendResponse($Labdetil,"Hasil Laboratorium Ditemukan.");  
            }else{
                return $this->sendError("Hasil Laboratorium Tidak Ditemukan.",[]);
            } 
        }catch (Exception $e) { 
            
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
    public function viewOrderLabbyNoReg($request)
    {
        $validator = Validator::make($request->all(), [
            "NoRegistrasi" => "required"  
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            // validasi jika Kode Pemriksaan Sudah Ada
            $header = $this->trsLaboratorium->viewOrderLabbyNoReg($request); 

            if($header->count() > 0){
                return $this->sendResponse($header ,"Hasil Laboratorium Ditemukan.");  
            }else{
                return $this->sendError("Hasil Laboratorium Tidak Ditemukan.",[]);
            } 
        }catch (Exception $e) { 
            
            Log::info($e->getMessage());
            return  $this->sendError($e->getMessage());
        }
    }
}