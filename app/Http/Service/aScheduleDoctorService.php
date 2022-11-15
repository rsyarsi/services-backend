<?php

namespace App\Http\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Repository\UserRepositoryImpl;
use App\Http\Repository\aUnitRepositoryImpl;
use App\Http\Repository\aDoctorRepositoryImpl;
use App\Http\Repository\aSatuanRepositoryImpl;
use App\Http\Repository\aScheduleDoctorRepositoryImpl;

class aScheduleDoctorService extends Controller
{

    private $Repository;

    public function __construct(aScheduleDoctorRepositoryImpl $Repository)
    {
        $this->Repository = $Repository;
    }

    public function getScheduleDoctorbyUnitDay(Request $request)
    {   
        // $request->validate([
        //     "IdUnit" => "required",
        //     "Day" => "required" 
        // ]);

        // $rules = [
        //     'IdUnit' => 'required',
        //     'Day' => 'required',
        // ];
        // $customMessages = [
        //     'required' => ':attribute Masih Kosong.'
        // ];
        // $this->validate($request, $rules, $customMessages);

        $validatedData = $request->validate([
            'IdUnit' => 'required',
            'Day' => 'required',
        ],
        [
         'IdUnit.required'=> 'Your First Name is Required', // custom message
         'Day.required'=> 'First Name Should be Minimum of 8 Character', // custom message 
        ]
     );

        try {   
            if ($request->Day === "Minggu") {
                $data = $this->Repository->getScheduleDoctorMinggu($request);
            } elseif ($request->Day === "Senin") {
                $data = $this->Repository->getScheduleDoctorSenin($request);
            } elseif ($request->Day === "Selasa") {
                $data = $this->Repository->getScheduleDoctorSelasa($request);
            } elseif ($request->Day === "Rabu") {
                $data = $this->Repository->getScheduleDoctorRabu($request);
            } elseif ($request->Day === "Kamis") {
                $data = $this->Repository->getScheduleDoctorKamis($request);
            } elseif ($request->Day === "Jumat") {
                $data = $this->Repository->getScheduleDoctorJumat($request);
            } elseif ($request->Day === "Sabtu") {
                $data = $this->Repository->getScheduleDoctorSabtu($request);
            }

            $count = $data->count();
            if ($count > 0) { 
                return $this->sendResponse($data, "Data Jadwal Dokter ditemukan.");
            } else {
                return $this->sendError("Data Jadwal Dokter Found.", [], 400);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
 
    public function getScheduleDoctorAll()
    {
        try {   
            $count = $this->Repository->getScheduleDoctorAll()->count();
            if ($count > 0) {
                $data = $this->Repository->getScheduleDoctorAll();
                return $this->sendResponse($data, "Data Unit Poliklinik ditemukan.");
            } else {
                return $this->sendError("Data Unit Poliklinik Not Found.", [], 400);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function getScheduleDoctorbyIdDoctor($request)
    {
        $request->validate([
            "IdUnit" => "required",
            "Day" => "required" ,
            "IdDokter" => "required"
        ]);
        try {   
            if ($request->Day === "Minggu") {
                $data = $this->Repository->getScheduleDoctorMinggu($request);
            } elseif ($request->Day === "Senin") {
                $data = $this->Repository->getScheduleDoctorSenin($request);
            } elseif ($request->Day === "Selasa") {
                $data = $this->Repository->getScheduleDoctorSelasa($request);
            } elseif ($request->Day === "Rabu") {
                $data = $this->Repository->getScheduleDoctorRabu($request);
            } elseif ($request->Day === "Kamis") {
                $data = $this->Repository->getScheduleDoctorKamis($request);
            } elseif ($request->Day === "Jumat") {
                $data = $this->Repository->getScheduleDoctorJumat($request);
            } elseif ($request->Day === "Sabtu") {
                $data = $this->Repository->getScheduleDoctorSabtu($request);
            }

            $count = $data->count();
            if ($count > 0) { 
                return $this->sendResponse($data, "Data Jadwal Dokter ditemukan.");
            } else {
                return $this->sendError("Data Jadwal Dokter Found.", [], 400);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    
}
