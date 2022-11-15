<?php

namespace App\Http\Repository;

use App\Models\gallery;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class aJurnalRepositoryImpl implements aJurnalRepositoryInterface
{
    public function addJurnalHeader($request,$notes)
    {
        return  DB::connection('sqlsrv4')->table("TA_JURNAL_HDR")->insert([
            'FS_KD_JURNAL' => $request->TransactionCode,
            'FD_TGL_JURNAL' => $request->DeliveryOrderDate,
            'FN_DEBET' => $request->GrandtotalDelivery,
            'FN_KREDIT' => $request->GrandtotalDelivery,
            'FN_JURNAL' => $request->GrandtotalDelivery,
            'FS_KD_PETUGAS' => $request->UserCreate, 
            'FS_KET_REFF' => $request->TransactionCode,
            'FS_KET' => $notes,
            'FS_KET2' => '',
            'FS_KET3' => '',
            'FB_SELESAI' => '1'
        ]);
    } 
    public function addJurnalDetailDebetPersediaan($request,$rekPersediaan)
    {
        return  DB::connection('sqlsrv4')->table("TA_JURNAL_DTL")->insert([
            'FS_KD_JURNAL' => $request->TransactionCode,
            'FS_KET_REFF' => 'Persediaan Pembelian Barang '. $request->ProductName.' No. Penerimaan : ' . $request-> TransactionCode . ' Qty : ' . $request->QtyDelivery,
            'FN_DEBET' => $request->Hpp * $request->QtyDelivery,
            'FN_KREDIT' => '0',
            'FB_VOID' => '0',
            'FS_REK' => $rekPersediaan,
            'FS_KD_REFF' => $request->ProductCode,
            'FS_KD_REG' => $request->ProductCode,
            'FS_KD_UNIT' => '',
            'FB_UNIT_USAHA' => '0',
            'FB_LEDGER' => '0',
            'BP_TIPE' => '0',
            'BP_SOURCE_TRS' => '',
            'FS_KD_REF_OUT' => ''
        ]);
    }
    public function addJurnalDetailKreditHutangBarang($request,$rekhutang)
    {
        return  DB::connection('sqlsrv4')->table("TA_JURNAL_DTL")->insert([
            'FS_KD_JURNAL' => $request->TransactionCode,
            'FS_KET_REFF' => 'Hutang Barang Pembelian, No. Penerimaan : ' . $request->TransactionCode,
            'FN_DEBET' => '0',
            'FN_KREDIT' => $request->SubtotalDelivery,
            'FB_VOID' => '0',
            'FS_REK' => $rekhutang,
            'FS_KD_REFF' => $request->TransactionCode,
            'FS_KD_REG' => $request->TransactionCode,
            'FS_KD_UNIT' => '',
            'FB_UNIT_USAHA' => '0',
            'FB_LEDGER' => '0',
            'BP_TIPE' => '0',
            'BP_SOURCE_TRS' => '',
            'FS_KD_REF_OUT' => ''
        ]);
    }
    public function getRekHutangBarang()
    {
        return  DB::connection('sqlsrv4')->table("TZ_Parameter_Keu")
            ->where('parameter', 'rek_hutang_barang') 
            ->get();
    }
    public function getRekDiskonPembelianDetil()
    {
        return  DB::connection('sqlsrv4')->table("TZ_Parameter_Keu")
        ->where('parameter', 'rek_diskon_pembelian_detil')
        ->get();
    }
    public function getRekDiskonPembelianlain()
    {
        return  DB::connection('sqlsrv4')->table("TZ_Parameter_Keu")
        ->where('parameter', 'rek_diskon_pembelian_lain')
        ->get();
    }
    public function getRekBiayaPembelianlain()
    {
        return  DB::connection('sqlsrv4')->table("TZ_Parameter_Keu")
        ->where('parameter', 'rek_biaya_pembelian_lain')
        ->get();
    }
    public function getRekPPNMasukan()
    {
        return  DB::connection('sqlsrv4')->table("TZ_Parameter_Keu")
        ->where('parameter', 'rek_ppn_masukan')
        ->get();
    }
    public function delJurnalHdr($request)
    {
        return  DB::connection('sqlsrv4')->table("TA_JURNAL_HDR")
        ->where('FS_KD_JURNAL', $request->TransactionCode)
        ->delete();
    }
    public function delJurnalDtl($request)
    {
        return  DB::connection('sqlsrv4')->table("TA_JURNAL_DTL")
        ->where('FS_KD_JURNAL', $request->TransactionCode)
        ->delete();
    }
    public function getRekeningPersediaaan($request)
    {
        return  DB::connection('sqlsrv')->table("v_rek_persediaan")
        ->where('ProductCode', $request->ProductCode)
        ->get();
    }
    public function addJurnalHeaderFaktur($request, $notes)
    {
        return  DB::connection('sqlsrv4')->table("TA_JURNAL_HDR")->insert([
            'FS_KD_JURNAL' => $request->TransactionCode,
            'FD_TGL_JURNAL' => $request->TransactionDate,
            'FN_DEBET' => $request->Grandtotal,
            'FN_KREDIT' => $request->Grandtotal,
            'FN_JURNAL' => $request->Grandtotal,
            'FS_KD_PETUGAS' => $request->UserCreate,
            'FS_KET_REFF' => $request->DeliveryCode,
            'FS_KET' => $notes,
            'FS_KET2' => '',
            'FS_KET3' => '',
            'FB_SELESAI' => '1'
        ]);
    }
   
    public function addJurnalDetailKreditHutangFaktur($request, $rekhutang, $nohutang)
    {
        return  DB::connection('sqlsrv4')->table("TA_JURNAL_DTL")->insert([
            'FS_KD_JURNAL' => $request->TransactionCode,
            'FS_KET_REFF' => 'Hutang Faktur Pembelian, No. Faktur : ' . $request->TransactionCode . " No. Delivery Order : " . $request->DeliveryCode,
            'FN_DEBET' => '0',
            'FN_KREDIT' => $request->Grandtotal,
            'FB_VOID' => '0',
            'FS_REK' => $rekhutang,
            'FS_KD_REFF' => $request->DeliveryCode,
            'FS_KD_REG' => $request->DeliveryCode,
            'FS_KD_UNIT' => '',
            'FB_UNIT_USAHA' => '0',
            'FB_LEDGER' => '1',
            'BP_TIPE' => $request->TipeHutang, // Hutang
            'BP_SOURCE_TRS' => $nohutang, //KODE HUTANG
            'FS_KD_REF_OUT' => ''
        ]);
    }
    public function addJurnalDetailDebetHutangBarang($request, $rekhutang, $nohutang)
    {
        return  DB::connection('sqlsrv4')->table("TA_JURNAL_DTL")->insert([
            'FS_KD_JURNAL' => $request->TransactionCode,
            'FS_KET_REFF' => 'Hutang Barang Faktur Pembelian, No. Faktur : ' . $request->TransactionCode . " No. Delivery Order : " . $request->DeliveryCode,
            'FN_DEBET' => $request->Subtotal,
            'FN_KREDIT' => '0',
            'FB_VOID' => '0',
            'FS_REK' => $rekhutang,
            'FS_KD_REFF' => $request->DeliveryCode,
            'FS_KD_REG' => $request->DeliveryCode,
            'FS_KD_UNIT' => '',
            'FB_UNIT_USAHA' => '0',
            'FB_LEDGER' => '1',
            'BP_TIPE' =>  '',
            'BP_SOURCE_TRS' => $nohutang,
            'FS_KD_REF_OUT' => ''
        ]);
    }
    public function addJurnalDetailDebetPPNMasukan($request, $rekhutang, $nohutang)
    {
        return  DB::connection('sqlsrv4')->table("TA_JURNAL_DTL")->insert([
            'FS_KD_JURNAL' => $request->TransactionCode,
            'FS_KET_REFF' => 'PPN Masukan Pembelian, No. Faktur : ' . $request->TransactionCode . " No. Delivery Order : " . $request->DeliveryCode,
            'FN_DEBET' => $request->TotalTax,
            'FN_KREDIT' => '0',
            'FB_VOID' => '0',
            'FS_REK' => $rekhutang,
            'FS_KD_REFF' => $request->DeliveryCode,
            'FS_KD_REG' => $request->DeliveryCode,
            'FS_KD_UNIT' => '',
            'FB_UNIT_USAHA' => '0',
            'FB_LEDGER' => '1',
            'BP_TIPE' =>  '',
            'BP_SOURCE_TRS' => $nohutang,
            'FS_KD_REF_OUT' => ''
        ]);
    }
    public function addJurnalDetailDebetDiskonDetil($request, $rekhutang, $nohutang)
    {
        return  DB::connection('sqlsrv4')->table("TA_JURNAL_DTL")->insert([
            'FS_KD_JURNAL' => $request->TransactionCode,
            'FS_KET_REFF' => 'Diskon Barang Pembelian, No. Faktur : ' . $request->TransactionCode . " No. Delivery Order : " . $request->DeliveryCode,
            'FN_DEBET' => $request->TotalDiskon,
            'FN_KREDIT' => '0',
            'FB_VOID' => '0',
            'FS_REK' => $rekhutang,
            'FS_KD_REFF' => $request->DeliveryCode,
            'FS_KD_REG' => $request->DeliveryCode,
            'FS_KD_UNIT' => '',
            'FB_UNIT_USAHA' => '0',
            'FB_LEDGER' => '1',
            'BP_TIPE' =>  '',
            'BP_SOURCE_TRS' => $nohutang,
            'FS_KD_REF_OUT' => ''
        ]);
    }
    public function addJurnalDetailDebetDiskonPembelianLain($request, $rekhutang, $nohutang)
    {
        return  DB::connection('sqlsrv4')->table("TA_JURNAL_DTL")->insert([
            'FS_KD_JURNAL' => $request->TransactionCode,
            'FS_KET_REFF' => 'Diskon Lain-lain Pembelian, No. Faktur : ' . $request->TransactionCode . " No. Delivery Order : " . $request->DeliveryCode,
            'FN_DEBET' => $request->TotalDiskon,
            'FN_KREDIT' => '0',
            'FB_VOID' => '0',
            'FS_REK' => $rekhutang,
            'FS_KD_REFF' => $request->DeliveryCode,
            'FS_KD_REG' => $request->DeliveryCode,
            'FS_KD_UNIT' => '',
            'FB_UNIT_USAHA' => '0',
            'FB_LEDGER' => '1',
            'BP_TIPE' =>  '',
            'BP_SOURCE_TRS' => $nohutang,
            'FS_KD_REF_OUT' => ''
        ]);
    }
    public function addJurnalDetailDebetBiayaPembelianLain($request, $rekhutang, $nohutang)
    {
        return  DB::connection('sqlsrv4')->table("TA_JURNAL_DTL")->insert([
            'FS_KD_JURNAL' => $request->TransactionCode,
            'FS_KET_REFF' => 'Biaya Lain-lain Pembelian, No. Faktur : ' . $request->TransactionCode . " No. Delivery Order : " . $request->DeliveryCode,
            'FN_DEBET' => $request->TotalDiskon,
            'FN_KREDIT' => '0',
            'FB_VOID' => '0',
            'FS_REK' => $rekhutang,
            'FS_KD_REFF' => $request->DeliveryCode,
            'FS_KD_REG' => $request->DeliveryCode,
            'FS_KD_UNIT' => '',
            'FB_UNIT_USAHA' => '0',
            'FB_LEDGER' => '1',
            'BP_TIPE' =>  '',
            'BP_SOURCE_TRS' => $nohutang,
            'FS_KD_REF_OUT' => ''
        ]);
    }
    public function VoidJurnalHdr($request)
    {
        return DB::connection('sqlsrv4')->table('TA_JURNAL_HDR')
        ->where('FS_KD_JURNAL', $request->TransactionCode)
            ->where('FS_KD_PETUGAS_VOID', "")
            ->update([
                'FD_TGL_VOID' => $request->DateVoid,
                'FS_KD_PETUGAS_VOID' => $request->UserVoid,
                'FS_ALASAN' => $request->ReasonVoid
            ]);
    }
    public function VoidJurnalDtl($request)
    {
        return DB::connection('sqlsrv4')->table('TA_JURNAL_DTL')
        ->where('FS_KD_JURNAL', $request->TransactionCode)
        ->where('FB_VOID', '0')
            ->update([
                'FB_VOID' =>"1",
                'FS_JAM_VOID' => $request->DateVoid,
                'FS_KD_PETUGAS_VOID' => $request->UserVoid,
                'FS_ALASAN' => $request->ReasonVoid
            ]);
    }
}
