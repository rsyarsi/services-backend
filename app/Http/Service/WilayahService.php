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
use App\Http\Repository\aSatuanRepositoryImpl;
use App\Http\Repository\aWilayahRepositoryImpl;

class WilayahService extends Controller
{

    private $aUnitRepository;

    public function __construct(aWilayahRepositoryImpl $aUnitRepository)
    {
        $this->aUnitRepository = $aUnitRepository;
    } 
    public function Provinsi()
    {
        try {   
            $count = $this->aUnitRepository->Provinsi()->count();
            if ($count > 0) {
                $data = $this->aUnitRepository->Provinsi();
                return $this->sendResponse($data, "Data ditemukan.");
            } else {
                return $this->sendError("Data tidak ditemukan.", []);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function detailProvinsi($provinsiId)
    {
        try {   
            // validator 
            $count = $this->aUnitRepository->detailProvinsi($provinsiId)->count();

            if ($count > 0) {
                $data = $this->aUnitRepository->detailProvinsi($provinsiId)->first();
                return $this->sendResponse($data, "Data ditemukan.");
            } else {
                return $this->sendError("Data tidak ditemukan.", []);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function Kabupaten($provinsiId)
    {
        try {   
            // validator 
            $count = $this->aUnitRepository->Kabupaten($provinsiId)->count();

            if ($count > 0) {
                $data = $this->aUnitRepository->Kabupaten($provinsiId);
                return $this->sendResponse($data, "Data ditemukan.");
            } else {
                return $this->sendError("Data tidak ditemukan.", []);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function detailKabupaten($kabupatenId)
    {
        try {   
            // validator 
            $count = $this->aUnitRepository->detailKabupaten($kabupatenId)->count();

            if ($count > 0) {
                $data = $this->aUnitRepository->detailKabupaten($kabupatenId)->first();
                return $this->sendResponse($data, "Data ditemukan.");
            } else {
                return $this->sendError("Data tidak ditemukan.", []);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function Kecamatan($kabupatenId)
    {
        try {   
            // validator 
            $count = $this->aUnitRepository->Kecamatan($kabupatenId)->count();

            if ($count > 0) {
                $data = $this->aUnitRepository->Kecamatan($kabupatenId);
                return $this->sendResponse($data, "Data ditemukan.");
            } else {
                return $this->sendError("Data tidak ditemukan.", []);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function detailKecamatan($kecamatanId)
    {
        try {   
            // validator 
            $count = $this->aUnitRepository->detailKecamatan($kecamatanId)->count();

            if ($count > 0) {
                $data = $this->aUnitRepository->detailKecamatan($kecamatanId)->first();
                return $this->sendResponse($data, "Data ditemukan.");
            } else {
                return $this->sendError("Data tidak ditemukan.", []);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function Kelurahan($kecamatanId)
    {
        try {   
            // validator 
            $count = $this->aUnitRepository->Kelurahan($kecamatanId)->count();

            if ($count > 0) {
                $data = $this->aUnitRepository->Kelurahan($kecamatanId);
                return $this->sendResponse($data, "Data ditemukan.");
            } else {
                return $this->sendError("Data tidak ditemukan.", []);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
    public function detailKelurahan($kelurahanId)
    {
        try {   
            // validator 
            $count = $this->aUnitRepository->detailKelurahan($kelurahanId)->count();

            if ($count > 0) {
                $data = $this->aUnitRepository->detailKelurahan($kelurahanId)->first();
                return $this->sendResponse($data, "Data ditemukan.");
            } else {
                return $this->sendError("Data tidak ditemukan.", []);
            }
        }catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal Di Tampilkan !', $e->getMessage());
        }
    }
}
