<?php 
 
namespace App\Http\Service;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\AutoNumberTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Repository\UserRepositoryImpl;
use App\Http\Repository\bVisitRepositoryImpl;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\bAntrianRepositoryImpl;
use App\Http\Repository\aMasterUnitRepositoryImpl;
use App\Http\Repository\bAppointmentRepositoryImpl;
use App\Http\Repository\bKamarOperasiRepositoryImpl;
use App\Http\Repository\bMedicalRecordRepositoryImpl;
use App\Http\Repository\aScheduleDoctorRepositoryImpl;

class bVisitService extends Controller {
    use AutoNumberTrait;
    private $visitRepository;
    private $kamaroperasiRepository;
    private $medrecRepository;
    private $doctorRepository;
    private $unitRepository;
    private $appointmenRepository;
    private $scheduleRepository;
    private $antrianRepository;

    public function __construct(  bKamarOperasiRepositoryImpl $kamaroperasiRepository,
        bMedicalRecordRepositoryImpl $medrecRepository,
        aDoctorRepositoryImpl $doctorRepository,
        aMasterUnitRepositoryImpl $unitRepository,
        bAppointmentRepositoryImpl $appointmenRepository,
        aScheduleDoctorRepositoryImpl $scheduleRepository,
        bAntrianRepositoryImpl $antrianRepository,
        bVisitRepositoryImpl $visitRepository)
    {
        $this->visitRepository = $visitRepository; 
        $this->kamaroperasiRepository = $kamaroperasiRepository;
        $this->medrecRepository = $medrecRepository;
        $this->doctorRepository = $doctorRepository;
        $this->unitRepository = $unitRepository;
        $this->appointmenRepository = $appointmenRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->antrianRepository = $antrianRepository; 
    }

    public function viewByNoregistrasi(Request $request){
        $data = $this->visitRepository->getRegistrationRajalbyNoreg($request->NoRegistrasi);
        if ($data->count() > 0) { 
            return $this->sendResponse($data, "Data ditemukan.");
        } else {
            return $this->sendError("Data Not Found.", []);
        }
    }

    public function getRegistrationRajalbyMedreActive(Request $request){
        $data = $this->visitRepository->getRegistrationRajalbyMedreActive($request->medrec);
        
        if ($data->count() > 0) { 
            return $this->sendResponse($data, "Data ditemukan.");
        } else {
            return $this->sendError("Data Not Found.", []);
        }
    }
    public function getRegistrationRajalbyMedreHistory(Request $request){
        $data = $this->visitRepository->getRegistrationRajalbyMedreHistory($request);
        
        if ($data->count() > 0) { 
            return $this->sendResponse($data, "Data ditemukan.");
        } else {
            return $this->sendError("Data Not Found.", []);
        }
    }

    public function getRegistrationRajalbyDoctorActive(Request $request){
        $data = $this->visitRepository->getRegistrationRajalbyDoctorActive($request->NamaDokter);
        
        if ($data->count() > 0) { 
            return $this->sendResponse($data, "Data ditemukan.");
        } else {
            return $this->sendError("Data Not Found.", []);
        }
    }
    public function getRegistrationRajalbyDoctorHistory(Request $request){
        $data = $this->visitRepository->getRegistrationRajalbyDoctorHistory($request);
        
        if ($data->count() > 0) { 
            return $this->sendResponse($data, "Data ditemukan.");
        } else {
            return $this->sendError("Data Not Found.", []);
        }
    }
    public function createRegistrasiOnsite(Request $request){
        
        
        try{
            DB::connection('sqlsrv3')->beginTransaction();
            $datenow = Carbon::now()->toDateString();
            // validasi 
            if ($request->NoMR == "") {  
                return $this->sendError("No. Medical Record Kosong.", []);
            }
            if ($request->KodePoli == "") {  
                return $this->sendError("Kode Poliklinik Kosong.", []);
            }
            if ($request->KodeDokter == "") {  
                return $this->sendError("Kode Dokter Kosong.", []);
            }
            if ($request->IdAdmin == "") {  
                return $this->sendError("Kode Administrasi Kosong.", []);
            }
            if ($request->IdCaraMasuk == "") {  
                return $this->sendError("ID Cara Masuk Kosong.", []);
            }
            if ($request->TipeRegistrasi == "") {  
                return $this->sendError("Tipe Registrasi Kosong.", []);
            }
            if ($request->TglRegistrasi == "") {  
                return $this->sendError("Tanggal Kosong.", []);
            }
            if ($request->Company == "") {  
                return $this->sendError("Company Kosong.", []);
            }
            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $request->TglRegistrasi)) {
                $metadata = array(
                    'message' => "Format Tanggal Tidak Sesuai, format yang benar adalah yyyy-mm-dd", // Set array status dengan success     
                    'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
                );
                return  $this->sendErrorNew($metadata,null);
            }
            if (date("Y-m-d",strtotime($request->TglRegistrasi)) <  date("Y-m-d",strtotime($datenow))) {
                $metadata = array(
                    'message' => 'Tanggal Periksa Tidak Berlaku.', // Set array status dengan success     
                    'code' => 201, // Set array nama dengan isi kolom nama pada tabel siswa 
                );
                return  $this->sendErrorNew($metadata,null);
            }
            // Jika pasien bpjs 
            if($request->TipeRegistrasi == "1"){
                //cek data dokter udh maping bpjs belum
                $dataDoctorbpjs = $this->doctorRepository->getDoctorbyIDBPJS($request->KodeDokter);
                if ( $dataDoctorbpjs->count() < 1 ) {
                    return  $this->sendError('Data ID Dokter BPJS Belum di Maping dalam SIMRS.',[]);
                }else{
                    $dtdr = $dataDoctorbpjs->first();
                    $IdDokter = $dtdr->ID;
                    $CodeAntrian = $dtdr->CodeAntrian;
                    $NamaDokter = $dtdr->NamaDokter; 
                }

                //cek Poli nya ada gak
                $dataunitbpjs = $this->unitRepository->getUnitByIdBPJS($request->KodePoli);
                if ( $dataunitbpjs->count() < 1 ) {
                    return  $this->sendError('Data ID Poliklinik BPJS Belum di Maping dalam SIMRS.',[]);
                }else{
                    $dtdr = $dataunitbpjs->first();
                    $IdGrupPerawatan = $dtdr->ID;
                    $NamaGrupPerawatan = $dtdr->NamaUnit; 
                }
            }elseif($request->TipeRegistrasi == "2"){
                    //cek data 
                    $dataDoctorbpjs = $this->doctorRepository->getDoctorbyId($request->KodeDokter);
               
                    if ( $dataDoctorbpjs->count() < 1 ) {
                        return  $this->sendError('Data ID Dokter Tidak ditemukan.',[]);
                    }else{
                        $dtdr = $dataDoctorbpjs->first(); 
                        $IdDokter = $dtdr->ID;
                        $CodeAntrian = $dtdr->CodeAntrian;
                        $NamaDokter = $dtdr->NamaDokter; 
                    }

                    //cek Poli nya ada gak
                    $dataunitbpjs = $this->unitRepository->getUnitById($request->KodePoli);
                    if ( $dataunitbpjs->count() < 1 ) {
                        return  $this->sendError('Data ID Poliklinik Tidak ditemukan.',[]);
                    }else{
                        $dtdr = $dataunitbpjs->first();
                        $IdGrupPerawatan = $dtdr->ID;
                        $NamaGrupPerawatan = $dtdr->NamaUnit; 
                    } 
            }

            //
            $NoMrConvert = str_replace("-", "", $request->NoMR);
                    
                      //get max visit
                    $maxVisit = $this->visitRepository->getMaxnumberVisit();
                    $maxVisit->ID++;
                    
                    $operator = "2852"; 
                    $CaraBayar = $request->CaraBayar;
                    $idCaraMasuk = $request->IdCaraMasuk;
                    $idAdmin = $request->IdAdmin;
                    $TelemedicineIs="0";
                    $Tipe_Registrasi = $request->TipeRegistrasi;

                    $datenow2 = date('Y-m-d', strtotime($request->TglRegistrasi));
                    $datenowcreate = $datenow2;
                    $datenow = date('dmy', strtotime($request->TglRegistrasi));

                    if($CaraBayar == "1"){ 
                        $kodeRegAwalXX = "RJUM";
                    }elseif($CaraBayar == "2"){ 
                        $kodeRegAwalXX = "RJAS";
                    }elseif($CaraBayar == "5"){ 
                        $kodeRegAwalXX = "RJJP";
                    }
                    if($request->TipeRegistrasi == "1"){ // bpjs
                        $Perusahaan = "315";
                    }else{
                        if($CaraBayar == "1"){
                            $Perusahaan = "315";
                        }else{
                            $Perusahaan = $request->Idjaminan;
                        }
                       
                    }
                    $jamPraktek = "08:00-17:00";
                       // validasi jam praktek
                $datename = date("l", strtotime(trim(strip_tags( $request->TglRegistrasi))));
                if($datename == "Sunday"){
                $jadwal = $this->scheduleRepository->getScheduleDoctorForTRSMinggu($IdDokter,$IdGrupPerawatan,$jamPraktek,$request->TipeRegistrasi);
                } elseif ($datename == "Monday") {
                    $jadwal = $this->scheduleRepository->getScheduleDoctorForTRSSenin($IdDokter,$IdGrupPerawatan,$jamPraktek,$request->TipeRegistrasi);
                } elseif ($datename == "Tuesday") { 
                    $jadwal = $this->scheduleRepository->getScheduleDoctorForTRSSelasa($IdDokter,$IdGrupPerawatan,$jamPraktek,$request->TipeRegistrasi);
                } elseif ($datename == "Wednesday") { 
                    $jadwal = $this->scheduleRepository->getScheduleDoctorForTRSRabu($IdDokter,$IdGrupPerawatan,$jamPraktek,$request->TipeRegistrasi);
                } elseif ($datename == "Thursday") { 
                    $jadwal = $this->scheduleRepository->getScheduleDoctorForTRSKamis($IdDokter,$IdGrupPerawatan,$jamPraktek,$request->TipeRegistrasi);
                } elseif ($datename == "Friday") { 
                    $jadwal = $this->scheduleRepository->getScheduleDoctorForTRSJumat($IdDokter,$IdGrupPerawatan,$jamPraktek,$request->TipeRegistrasi);
                } elseif ($datename == "Saturday") { 
                    $jadwal = $this->scheduleRepository->getScheduleDoctorForTRSSabtu($IdDokter,$IdGrupPerawatan,$jamPraktek,$request->TipeRegistrasi);
                }
                if($jadwal->count() < 1 ){  
                    return  $this->sendError("Jam Praktek Tidak Ditemukan.",[]);
                }else{
                        $single = $jadwal->first(); 
                        $NamaSesion = $single->NamaSesion;
                        $MaxKuota = $single->MaxKuota;
                        $Max_JKN = $single->Max_JKN;
                        $Max_NonJKN = $single->Max_NonJKN;
                        $JamAwal = $single->JamAwal;
                        $JamAkhir = $single->JamAkhir;
                        $ID_JadwalPraktek = $single->ID;
                        $xesti = $request->tanggalperiksa . ' ' . $JamAwal;
                        date_default_timezone_set("Asia/Jakarta");
                        $shift =  $JamAwal.'-'.$JamAkhir;
                        $estimasi2 = strtotime($xesti);
                        $estimasi = $estimasi2*1000;
                }
                
                    // get last registration active
                    $lastreg = $this->visitRepository->getRegistrationActivebyMedrec($request->NoMR);
                    if($lastreg){
                        $NoEpisode = $lastreg->NoEpisode;
                        

                        // Generate No Registrasi terbaru
                        $NoregistrationRajal = $this->genNumberRegistrationRajal($datenowcreate,$kodeRegAwalXX,$datenow,$request->NoMR);
                        $nofixReg = $NoregistrationRajal[1];

                        // cek apakah sudah daftar belum
                        $cekActiverRegistrasi = $this->visitRepository->getActiveRegistrationToday($request->NoMR,$IdGrupPerawatan,
                                                $IdDokter,$NamaSesion,$request->TglRegistrasi);

                        if($cekActiverRegistrasi){ 
                            return $this->sendError("Pasien Sudah mendaftar di Poli dan Dokter yang sama !", []); 
                        } 
                    
                    }else{ // JIKA TIDAK ADA REG AKTIF
                        $NoregistrationRajal = $this->genNumberRegistrationRajal($datenowcreate,$kodeRegAwalXX,$datenow,$request->NoMR);
                        $NoEpisode = $NoregistrationRajal[3];
                        $auto_eps = $NoregistrationRajal[4];
                        $id_eps = $NoregistrationRajal[5];
                        $nofixReg = $NoregistrationRajal[1]; 
                        
                    }

                 
                //get max number antrian  
                $dataAntrian = $this->genNumberAntrianPoliklinik($request->TglRegistrasi,$NamaSesion,$IdDokter,$CodeAntrian);
                $NoAntrianAll = $dataAntrian[1];
                $idno_urutantrian = $dataAntrian[0];

                // cek sisa kuota
                if($request->groupjadwal=="2"){
                    if($idno_urutantrian > $Max_NonJKN){
                        return $this->sendError("Kuota Reservasi Sudah Penuh, Kuota Maksimal ". $Max_NonJKN , []);  
                    }
                }else{
                    if($idno_urutantrian > $Max_NonJKN){
                        return $this->sendError("Kuota Reservasi Sudah Penuh, Kuota Maksimal ". $Max_NonJKN , []);  
                    }
                }

            // INSERT REGISTRATION
            if($CaraBayar == "2"){
                $this->visitRepository->addRegistrationRajalAsuransi($maxVisit->ID,$NoEpisode,$nofixReg,$NamaGrupPerawatan,$request->NoMR,
                $request->CaraBayar,$IdGrupPerawatan,$IdDokter,$idno_urutantrian,$NoAntrianAll,
                $request->Company,$NamaSesion,$TelemedicineIs,$request->TglRegistrasi,
                $request->TglRegistrasi,$operator,$CaraBayar,$Perusahaan,$idCaraMasuk,
                $idAdmin,$Tipe_Registrasi,$ID_JadwalPraktek);
            }else{
                $this->visitRepository->addRegistrationRajal($maxVisit->ID,$NoEpisode,$nofixReg,$NamaGrupPerawatan,$request->NoMR,
                $request->CaraBayar,$IdGrupPerawatan,$IdDokter,$idno_urutantrian,$NoAntrianAll,
                $request->Company,$NamaSesion,$TelemedicineIs,$request->TglRegistrasi,
                $request->TglRegistrasi,$operator,$CaraBayar,$Perusahaan,$idCaraMasuk,
                $idAdmin,$Tipe_Registrasi,$ID_JadwalPraktek);
            }
           

            $response = array(
            'NoEpisode' => $NoEpisode, // Set array status dengan success     
            'NoRegistrasi' => $nofixReg, // Set array status dengan success     
            'NamaGrupPerawatan' => $NamaGrupPerawatan, // Set array status dengan success     
            'NOMR' => $request->NoMR, // Set array status dengan success     
            'Antrian' => $idno_urutantrian, // Set array status dengan success     
            'NoAntrianAll' =>  $NoAntrianAll, // Set array status dengan success     
            );

            DB::connection('sqlsrv3')->commit();
            return $this->sendResponse($response ,"Registrasi Berhasil dibuat. Silahkan menuju Poliklinik MCU untuk melakukan Konfirmasi ke Admin Kami.");  


        }catch (Exception $e) { 
            DB::connection('sqlsrv3')->rollBack();
            Log::info($e->getMessage()); 
            return $this->sendError($e->getMessage(), []); 
        }  
    }
    public function viewByNoBooking(Request $request){
        $data = $this->visitRepository->viewByNoBooking($request->NoBooking);
        if ($data->count() > 0) { 
            return $this->sendResponse($data->first(), "Data ditemukan.");
        } else {
            return $this->sendError("Data Not Found.", [],200);
        }
    }
}