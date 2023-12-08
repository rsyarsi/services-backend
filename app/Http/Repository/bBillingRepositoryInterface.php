<?php
namespace App\Http\Repository;
interface bBillingRepositoryInterface
{ 
    public function insertHeader($data,$notrsbilling); 
    public function insertDetail($NO_TRS_BILLING,$TGL_BILLING,$PETUGAS_ENTRY,$NO_MR,
    $NO_EPISODE,$NO_REGISTRASI,$KODE_TARIF,$UNIT,$GROUP_JAMINAN,
    $KODE_JAMINAN,$NAMA_TARIF,$GROUP_TARIF,$KD_KELAS,$QTY,
    $NILAI_TARIF,$SUB_TOTAL,$DISC,$DISC_RP,$SUB_TOTAL_2,$GRANDTOTAL,
    $KODE_REF,$KD_DR,$NM_DR,$GROUP_ENTRI); 
    public function insertDetailPdp($request); 

}