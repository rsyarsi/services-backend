<?php

namespace App\Http\Service;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\VerificationTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Traits\ApiExternalConsumeTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Repository\UserRepositoryImpl;
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
use App\Http\Repository\bAntrianPoliklinikRepositoryImpl;

date_default_timezone_set("Asia/Jakarta");
class AntrianPoliklinikService extends Controller
{
    use VerificationTrait;
    use ApiExternalConsumeTrait;
    private $kamaroperasiRepository;
    private $medrecRepository;
    private $doctorRepository;
    private $unitRepository;
    private $appointmenRepository;
    private $scheduleRepository;
    private $antrianRepository;
    private $visitRepository;
    private $antrianPoliklinikRepository;
    private $userLoginRepository;
    public function __construct(
        bKamarOperasiRepositoryImpl $kamaroperasiRepository,
        bMedicalRecordRepositoryImpl $medrecRepository,
        aDoctorRepositoryImpl $doctorRepository,
        aMasterUnitRepositoryImpl $unitRepository,
        bAppointmentRepositoryImpl $appointmenRepository,
        aScheduleDoctorRepositoryImpl $scheduleRepository,
        bAntrianRepositoryImpl $antrianRepository,
        bVisitRepositoryImpl $visitRepository,
        bAntrianPoliklinikRepositoryImpl $antrianPoliklinikRepository,
        UserRepositoryImpl $userLoginRepository
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
        $this->antrianPoliklinikRepository = $antrianPoliklinikRepository;
        $this->userLoginRepository = $userLoginRepository;
    }
    public function ListDataAntrian($request)
    {
            // validate 
            if ($request->tanggalKunjungan == "") {  
                return $this->sendError("Tanggal Kunjungan Silahkan Diisi.", []);
            }
            if ($request->kodeDokter == "") {  
                return $this->sendError("Kode Dokter Silahkan Diisi.", []);
            }
            try {
                $data = $this->antrianPoliklinikRepository->ListDataAntrian($request);
                return $this->sendResponse($data, 'Data Antrian Poliklinik Ditemukan !');
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return $this->sendError('Data Antrian Poliklinik Tidak Ditemukan !', $e->getMessage());
            }
    }
    public function UpdatePanggil($request)
    {
            // validate 
            if ($request->IdAntrian == "") {  
                return $this->sendError("Id Antrian Silahkan Diisi.", []);
            }
            if ($this->antrianPoliklinikRepository->getAntrianPoliklinikbyId($request)->count() < 1) {
                //response 
                return $this->sendError("Antrian Poliklinik Tidak Ditemukan.", []);
            } 
            try { 
                DB::connection('sqlsrv3')->beginTransaction();
                $this->antrianPoliklinikRepository->UpdatePanggil($request);
                $data = $this->antrianPoliklinikRepository->getUpdatedAntrianPoliklinikbyId($request);
                DB::connection('sqlsrv3')->commit();
                return $this->sendResponse($data, 'Antrian Berhasil Di Panggil !');
            } catch (Exception $e) {
                DB::connection('sqlsrv3')->rollBack();
                Log::info($e->getMessage());
                return $this->sendError('Data Antrian Poliklinik Gagal Di Panggil !', $e->getMessage());
            }
    }
}
