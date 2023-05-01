<?php

namespace App\Http\Service;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Repository\bVisitRepositoryImpl;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\aPabrikRepositoryImpl;
use App\Http\Repository\bAntrianRepositoryImpl;
use App\Http\Repository\aMasterUnitRepositoryImpl;
use App\Http\Repository\bAppointmentRepositoryImpl;
use App\Http\Repository\bKamarOperasiRepositoryImpl;
use App\Http\Repository\bMedicalRecordRepositoryImpl;
use App\Http\Repository\aScheduleDoctorRepositoryImpl;
use App\Http\Repository\bAntrianFarmasiRepositoryImpl;

date_default_timezone_set("Asia/Jakarta");
class AntrianFarmasiService extends Controller
{

    private $kamaroperasiRepository;
    private $medrecRepository;
    private $doctorRepository;
    private $unitRepository;
    private $appointmenRepository;
    private $scheduleRepository;
    private $antrianRepository;
    private $visitRepository;
    private $aAntrianFarmasiRepository;

    public function __construct(
        bKamarOperasiRepositoryImpl $kamaroperasiRepository,
        bMedicalRecordRepositoryImpl $medrecRepository,
        aDoctorRepositoryImpl $doctorRepository,
        aMasterUnitRepositoryImpl $unitRepository,
        bAppointmentRepositoryImpl $appointmenRepository,
        aScheduleDoctorRepositoryImpl $scheduleRepository,
        bAntrianRepositoryImpl $antrianRepository,
        bVisitRepositoryImpl $visitRepository,
        bAntrianFarmasiRepositoryImpl $aAntrianFarmasiRepository
    )
    {
        $this->kamaroperasiRepository = $kamaroperasiRepository;
        $this->medrecRepository = $medrecRepository;
        $this->doctorRepository = $doctorRepository;
        $this->unitRepository = $unitRepository;
        $this->appointmenRepository = $appointmenRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->antrianRepository = $antrianRepository;
        $this->visitRepository = $visitRepository;
        $this->aAntrianFarmasiRepository = $aAntrianFarmasiRepository;
    }

    public function CreateAntrian(Request $request)
    {
        try{
            
            DB::beginTransaction();
            // validator 
            $validator = Validator::make($request->all(), [ 
                "NoRegistrasi" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 200);
            }

        
            if ($this->aAntrianFarmasiRepository->getAntrianFarmasibyRegistrasi($request)->count()) {
                //response 
                return $this->sendError("Antrian Atas No. Registrasi ini sudah ada.", []);
            } 
            // cari max antrian
            $datenow = Carbon::now()->toDateString();
       
            $maxnumberantrian = $this->aAntrianFarmasiRepository->getMaxAntrian($datenow);
                 if($maxnumberantrian){
                    $idno_urutantrian = $maxnumberantrian->NoAntrianList;
                    $idno_urutantrian++;
                 }else{
                    $idno_urutantrian=1;
                 }
            $registration = $this->visitRepository->getRegistrationRajalbyNoreg($request->NoRegistrasi);
            if ($registration->count() > 0) { 
                $datareg = $registration->first();
                $NoEpisode = $datareg->NoEpisode; 
                $NoRegistrasi = $datareg->NoRegistrasi; 
                $NoMR =  $datareg->NoMR; 
                $NoAntrianPoli = $datareg->NoAntrianAll; 
                $PatientName = $datareg->PatientName;
                $StatusAntrean = 'CREATED';
                $DateCreated = Carbon::now();
                $NoAntrianList = $idno_urutantrian;
                $IDPoliOrder = $datareg->IdUnit;
                $NamaPoliOrder= $datareg->NamaUnit;
                $IDDokter= $datareg->IdDokter;
                $NamaDokter= $datareg->NamaDokter;
            } else {
                return $this->sendError("Data Registrasi tidak di temukan.", []);
            }
                // antrian header
                $this->aAntrianFarmasiRepository->CreateAntrian($NoEpisode,
                                                    $NoRegistrasi,$NoMR,
                                                    $NoAntrianPoli,$NoAntrianList,
                                                    $StatusAntrean,$DateCreated,$PatientName,$request->IdUnitFarmasi
                                                    ,  $IDPoliOrder, $NamaPoliOrder, $IDDokter, $NamaDokter,$request->JenisResep,$request->NoResep);
                
                // antrian history
                $this->aAntrianFarmasiRepository->CreateHistoryAntrian($NoRegistrasi,$StatusAntrean,$DateCreated,$request->NoResep);
            
                DB::commit();
                return $this->sendResponse([], "Antrian Berhasil Di tambahkan.");
                
        }catch (Exception $e) { 
            DB::rollBack();
            Log::info($e->getMessage()); 
            return $this->sendError($e->getMessage(), []);  
        }
    } 
    public function UpdateAntrianFarmasi(Request $request)
    {
        try{
            
            DB::beginTransaction();
            // validator 
            $validator = Validator::make($request->all(), [ 
                "NoRegistrasi" => "required",
                "NoResep" => "required",
                "StatusResep" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 200);
            }
        
            if ($this->aAntrianFarmasiRepository->getAntrianFarmasibyRegistrasi($request)->count() < 1) {
                return $this->sendError("Antrian Atas No. Registrasi ini Tidak ada.", []);
            } 
            if($request->StatusResep == "CLOSED"){
                return $this->sendError("Status Closed Hanya Bisa digunakan Pada Form Penyerahan Resep.", []);
            }
                if($request->StatusResep == "PROCESSED"){
                    $this->aAntrianFarmasiRepository->updateStatusProccess($request->NoRegistrasi,"PROCESSED",Carbon::now(),$request->NoResep);
                    $this->aAntrianFarmasiRepository->CreateHistoryAntrian($request->NoRegistrasi,"PROCESSED",Carbon::now(),$request->NoResep);
                }elseif($request->StatusResep == "FINISHED"){
                    $this->aAntrianFarmasiRepository->updateStatusFinish($request->NoRegistrasi,"FINISHED",Carbon::now(),$request->NoResep);
                    $this->aAntrianFarmasiRepository->CreateHistoryAntrian($request->NoRegistrasi,"FINISHED",Carbon::now(),$request->NoResep);
                }elseif($request->StatusResep == "CLOSED"){
                    $this->aAntrianFarmasiRepository->updateStatusClose($request->NoRegistrasi,"CLOSED",Carbon::now(),$request->NoResep);
                    $this->aAntrianFarmasiRepository->CreateHistoryAntrian($request->NoRegistrasi,"CLOSED",Carbon::now(),$request->NoResep);
                }
                 
                DB::commit();
                return $this->sendResponse([], "Antrian Berhasil Di Update .");
                
        }catch (Exception $e) { 
            DB::rollBack();
            Log::info($e->getMessage()); 
            return $this->sendError($e->getMessage(), []);  
        }
    } 
    public function ListAntrianFarmasi($request)
    {
        // validate 
        $request->validate([
            "StartPeriode" => "required",
            "EndPeriode" => "required",
            "IdUNitFarmasi" => "required"
        ]);

        try {
            // Db Transaction
            DB::beginTransaction();

            $data = $this->aAntrianFarmasiRepository->ListAntrianFarmasi($request);

            DB::commit();
            return $this->sendResponse($data, 'Data Antrian Obat Farmasi Ditemukan !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Antrian Obat Farmasi Tidak Ditemukan !', $e->getMessage());
        }
    }
    public function ListHistoryAntrianFarmasi($request)
    {
        // validate 
        $request->validate([
            "NoRegistrasi" => "required" 
        ]);

        try {
            // Db Transaction
            DB::beginTransaction();

            $data = $this->aAntrianFarmasiRepository->ListHistoryAntrianFarmasi($request);

            DB::commit();
            return $this->sendResponse($data, 'Data History Antrian Obat Farmasi Ditemukan !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data History Antrian Obat Farmasi Tidak Ditemukan !', $e->getMessage());
        }
    }
    public function ListDepoFarmasi()
    {
        try {
            // Db Transaction
            DB::beginTransaction();

            $data = $this->aAntrianFarmasiRepository->ListDepoFarmasi();

            DB::commit();
            return $this->sendResponse($data, 'Data Depo Farmasi Ditemukan !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Depo Farmasi Tidak Ditemukan !', $e->getMessage());
        }
    }
    public function UpdateDataVerifikasiAmbilResep(Request $request)
    {
        // validator 
        $validator = Validator::make($request->all(), [ 
            "NoRegistrasi" => "required",
            "Nama" => "required",
            "NoHandphone" => "required",
            "HubunganDenganPasien" => "required",
            "NoResep" => "required",
            "NoAntrian" => "required",
            "UserCreated" => "required",
            "Keterangan" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 200);
        }

        try{
            DB::beginTransaction(); 
            if ($this->aAntrianFarmasiRepository->getAntrianFarmasibyRegistrasi($request)->count()) {
                //response 
                return $this->sendError("Antrian Atas No. Registrasi ini sudah ada.", []);
            } 
             
                // antrian header
                $this->aAntrianFarmasiRepository->UpdateDataVerifikasiAmbilResep(
                                                $request->NoResep,$request->NoRegistrasi,
                                                $request->NoAntrian,Carbon::now(),
                                                $request->UserCreated,$request->Nama,$request->NoHandphone,
                                                $request->HubunganDenganPasien,$request->Keterangan );
                
                // antrian history
                $this->aAntrianFarmasiRepository->updateStatusClose($request->NoRegistrasi,"CLOSED",Carbon::now(), $request->NoResep);

                DB::commit();
                return $this->sendResponse([], "Resep Obat Pasien Sudah di berikan, Status Resep Closed.");
                
        }catch (Exception $e) { 
            DB::rollBack();
            Log::info($e->getMessage()); 
            return $this->sendError($e->getMessage(), []);  
        }
    } 
}
