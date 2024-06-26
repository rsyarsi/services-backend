<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Repository\aBarangRepositoryImpl;
use App\Http\Repository\aMasterUnitRepositoryImpl;
use App\Http\Repository\aOrderMutasiRepositoryImpl; 
use App\Http\Repository\aPurchaseRequisitionRepositoryImpl;
use App\Http\Repository\aStokRepositoryImpl;
use App\Http\Repository\aHnaRepositoryImpl;
use App\Http\Repository\aSupplierRepositoryImpl;
use Exception;
use App\Traits\AutoNumberTrait;

use Illuminate\Support\Str;

class aOrderMutasiService extends Controller
{
    use AutoNumberTrait;
    private $aBarangRepository;
    private $asupplierRepository;
    private $aPurchaseRequestRepository;
    private $aStokRepository;
    private $aOrderMutasiRepository;
    private $aMasterUnitRepository;
    private $ahnaRepository;

    public function __construct(
        aBarangRepositoryImpl $aBarangRepository,
        aSupplierRepositoryImpl $asupplierRepository,
        aPurchaseRequisitionRepositoryImpl $aPurchaseRequestRepository,
        aStokRepositoryImpl $aStokRepository,
        aOrderMutasiRepositoryImpl $aOrderMutasiRepository,
        aMasterUnitRepositoryImpl $aMasterUnitRepository,
        aHnaRepositoryImpl $ahnaRepository

    ) {
        $this->aBarangRepository = $aBarangRepository;
        $this->asupplierRepository = $asupplierRepository;
        $this->aPurchaseRequestRepository = $aPurchaseRequestRepository;
        $this->aStokRepository = $aStokRepository;
        $this->aOrderMutasiRepository = $aOrderMutasiRepository;
        $this->aMasterUnitRepository = $aMasterUnitRepository;
        $this->ahnaRepository = $ahnaRepository;
    }
    public function addOrderMutasi(Request $request)
    {
        // validate 
        $request->validate([
            "TransactionDate" => "required",
            "UserCreate" => "required",
            "UnitTujuan" => "required",
            "UnitOrder" => "required",
            "Notes" => "required",
            "JenisMutasi" => "required",
            "JenisStok" => "required"
        ]);
        try {
            // Db Transaction
            DB::beginTransaction();

            // cek kode 
            if ($this->aMasterUnitRepository->getUnitById($request->UnitOrder)->count() < 1) {
                return $this->sendError('Kode Unit Order Mutasi tidak ditemukan !', []);
            }
            if ($this->aMasterUnitRepository->getUnitById($request->UnitTujuan)->count() < 1) {
                return $this->sendError('Kode Unit Tujuan Mutasi tidak ditemukan !', []);
            }

            $getmax = $this->aOrderMutasiRepository->getMaxCode($request);
            if ($getmax->count() > 0) {
                foreach ($getmax as $datanumber) {
                    $TransactionCode = $datanumber->TransactionCode;
                }
            } else {
                $TransactionCode = 0;
            }
            $autonumber = $this->OrderMutasiNumber($request, $TransactionCode);

            $this->aOrderMutasiRepository->addOrderMutasi($request, $autonumber);
            DB::commit();
            return $this->sendResponse($autonumber, 'Transaksi Order Mutasi berhasil di buat !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Transaksi tidak dapat di proses !', $e->getMessage());
        }
    }
    public function addOrderMutasiDetail(Request $request)
    {
        try {
            // Db Transaction
            DB::beginTransaction(); 
            $request->validate([
                "TransactionCode" => "required",
                "ProductCode" => "required",
                "ProductName" => "required",
                "Satuan" => "required",
                "Satuan_Konversi" => "required",
                "KonversiQty" => "required",
                "Konversi_QtyTotal" => "required",
                "QtyStok" => "required",
                "QtyOrderMutasi" => "required",
                "QtySisaMutasi" => "required",
                "UserAdd" => "required" 
            ]);

                // cek ada gak datanya
               
                if ($this->aOrderMutasiRepository->getOrderMutasibyID($request->TransactionCode)->count() < 1) {
                    return $this->sendError('No. Transaksi Order Mutasi tidak ditemukan !', []);
                }
                // cek kode barangnya ada ga
                if ($this->aBarangRepository->getBarangbyId($request->ProductCode)->count() < 1) {
                    return $this->sendError('Kode Barang tidak ditemukan !', []);
                }
                // // //cek barang dobel gak 
                if ($this->aOrderMutasiRepository->getItemsDouble($request)->count() > 0) {
                    return $this->sendError('Kode Barang sudah ada sebelumnya, tidak boleh lebih dari 1 !', []);
                }
                // cek sudah di approved belum 
                if ($this->aOrderMutasiRepository->getOrderMutasiApprovedbyID($request->TransactionCode)->count() > 0) {
                    return $this->sendError('Transaksi Order Mutasi sudah di Approve !', []);
                }

                    $getHppBarang = $this->ahnaRepository->getHppAveragebyCode($request->ProductCode)->first()->first();
                    $xhpp = $getHppBarang->NominalHpp;
                    $this->aOrderMutasiRepository->addOrderMutasiDetail($request, $xhpp);
                
            DB::commit();
            return $this->sendResponse([], 'Order Mutasi Detail berhasil di tambahkan !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Transaksi tidak dapat di proses !', $e->getMessage());
        }
    }
    public function editOrderMutasi(Request $request)
    {
        // validate 
        $request->validate([
            "TransasctionCode" => "required",
            "TransactionDate" => "required",
            "UserCreate" => "required",
            "UnitOrder" => "required",
            "UnitTujuan" => "required",
            "TotalQtyOrder" => "required",
            "TotalRow" => "required",
            "JenisMutasi" => "required",
            "JenisStok" => "required", 
            "Notes" => "required"
        ]);
        try {
            // Db Transaction
            DB::beginTransaction();

            // cek ada gak datanya
            if ($this->aOrderMutasiRepository->getOrderMutasibyID($request->TransasctionCode)->count() < 1) {
                return $this->sendError('No. Tranasksi Order Mutasi tidak di Temukan !', []);
            } 
            // cek sudah di approved belum 
            if ($this->aOrderMutasiRepository->getOrderMutasiApprovedbyID($request->TransasctionCode)->count() > 0) {
                return $this->sendError('No. Tranasksi Order Mutasi sudah di Approve !', []);
            }
            if ($request->TotalRow < 1) {
                return $this->sendError('Kode Barang tidak ditemukan, Transaksi tidak dapat di edit !', []);
            }
            if ($request->TotalQtyOrder < 1) {
                return $this->sendError('Kode Barang tidak ada Qty, Transaksi tidak dapat di edit !', []);
            }
            $this->aOrderMutasiRepository->editOrderMutasi($request);

            DB::commit();
            return $this->sendResponse([], 'Transaksi Order Mutasi berhasil di edit !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Transaksi tidak dapat di proses !', $e->getMessage());
        }
    }
    public function voidOrderMutasi(Request $request)
    {
        // validate  
        $request->validate([
            "TransactionCode" => "required",
            "DateVoid" => "required",
            "UserVoid" => "required",
            "Void" => "required",
            "ReasonVoid" => "required"
        ]);

        try {
            // Db Transaction
            DB::beginTransaction();

            // cek ada gak datanya
            // cek ada gak datanya
            if ($this->aOrderMutasiRepository->getOrderMutasibyID($request->TransactionCode)->count() < 1) {
                return $this->sendError('No. Tranasksi Order Mutasi tidak di Temukan !', []);
            }
            // cek sudah di approved belum 
            if ($this->aOrderMutasiRepository->getOrderMutasiApprovedbyID($request->TransactionCode)->count() > 0) {
                return $this->sendError('No. Tranasksi Order Mutasi sudah di Approve !', []);
            }
            $this->aOrderMutasiRepository->voidOrderMutasiDetailAll($request);
            $this->aOrderMutasiRepository->voidOrderMutasi($request);

            DB::commit();
            return $this->sendResponse([], 'Transaksi Order Mutasi berhasil disimpan !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Transaksi tidak dapat di proses !', $e->getMessage());
        }
    }
    public function voidOrderMutasiDetailbyItem(Request $request)
    {
        // validate 
        $request->validate([
            "TransasctionCode" => "required",
            "ProductCode" => "required",
            "DateVoid" => "required",
            "UserVoid" => "required",
            "Void" => "required"
        ]);

        try {
            // Db Transaction
            DB::beginTransaction();

            // cek ada gak datanya
            if ($this->aOrderMutasiRepository->getOrderMutasibyID($request->TransasctionCode)->count() < 1) {
                return $this->sendError('No. Tranasksi Order Mutasi tidak di Temukan !', []);
            }
            // cek sudah di approved belum 
            if ($this->aOrderMutasiRepository->getOrderMutasiApprovedbyID($request->TransasctionCode)->count() > 0) {
                return $this->sendError('No. Tranasksi Order Mutasi sudah di Approve !', []);
            }

            $this->aOrderMutasiRepository->voidOrderMutasiDetailbyItem($request);

            DB::commit();
            return $this->sendResponse([], 'Transaksi Order Mutasi berhasil di hapus per Item !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Transaksi tidak dapat di proses !', $e->getMessage());
        }
    }
    public function getOrderMutasibyID($request)
    {
        // validate 
        $request->validate([
            "TransasctionCode" => "required"
        ]);

        try {
            // cek ada gak datanya
            if ($this->aOrderMutasiRepository->getOrderMutasibyID($request->TransasctionCode)->count() < 1) {
                return $this->sendError('No. Tranasksi Order Mutasi tidak di Temukan !', []);
            }
            $data = $this->aOrderMutasiRepository->getOrderMutasibyID($request->TransasctionCode);
            return $this->sendResponse($data, 'No. Tranasksi Order Mutasi di Temukan !');
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return $this->sendError('Transaksi tidak dapat di proses !', $e->getMessage());
        }
    }
    public function getOrderMutasiDetailbyID($request)
    {
        // validate 
        $request->validate([
            "TransasctionCode" => "required"
        ]);

        try {
            // cek ada gak datanya
            if ($this->aOrderMutasiRepository->getOrderMutasiDetailbyID($request->TransasctionCode)->count() < 1) {
                return $this->sendError('No. Tranasksi Order Mutasi tidak di Temukan !', []);
            }
            $data = $this->aOrderMutasiRepository->getOrderMutasiDetailbyID($request->TransasctionCode);
            return $this->sendResponse($data, 'No. Tranasksi Order Mutasi di Temukan !');
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return $this->sendError('Transaksi tidak dapat di proses !', $e->getMessage());
        }
    }
    public function getOrderMutasiDetailRemainbyID($request)
    {
        // validate 
        $request->validate([
            "TransasctionCode" => "required"
        ]);
        try {
            // cek ada gak datanya
            if ($this->aOrderMutasiRepository->getOrderMutasiDetailbyID($request->TransasctionCode)->count() < 1) {
                return $this->sendError('No. Tranasksi Order Mutasi tidak di Temukan !', []);
            }
            $data = $this->aOrderMutasiRepository->getOrderMutasiDetailbyID($request->TransasctionCode);
            return $this->sendResponse($data, 'No. Tranasksi Order Mutasi di Temukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Transaksi tidak dapat di proses !', $e->getMessage());
        }
    }
    public function getOrderMutasibyDateUser($request)
    {
        // validate 
        $request->validate([
            "UserCreate" => "required"
        ]);
        try { 
            $data = $this->aOrderMutasiRepository->getOrderMutasibyDateUser($request);
            return $this->sendResponse($data, 'No. Tranasksi Order Mutasi di Temukan !');
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return $this->sendError('Transaksi tidak dapat di proses !', $e->getMessage());
        }
    }
    public function getOrderMutasibyPeriode($request)
    {
        // validate 
        $request->validate([
            "StartPeriode" => "required",
            "EndPeriode" => "required",
        ]);
        try {
            $data = $this->aOrderMutasiRepository->getOrderMutasibyPeriode($request);
            return $this->sendResponse($data, 'No. Tranasksi Order Mutasi di Temukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Transaksi tidak dapat di proses !', $e->getMessage());
        }
    }
    public function approval($request)
    {
        // validate 
        $request->validate([
            "DateApprove" => "required",
            "UserApprove" => "required",
            "TransactionCode" => "required",
        ]);

        try {
            // Db Transaction
            DB::beginTransaction();
            $data = $this->aOrderMutasiRepository->approval($request);
            DB::commit();
            return $this->sendResponse($data, 'Order Mutasi Berhasil di Approve !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Transaksi tidak dapat di proses !', $e->getMessage());
        }
    }
}
