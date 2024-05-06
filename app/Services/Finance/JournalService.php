<?php

namespace App\Services\Finance;

use Error;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JournalService
{
    /**
     * @return mixed
     */
    public function execute()
    {
        $content = null;

        DB::beginTransaction();

        try {

            //

            Log::info("Deleting...");
            DB::connection("service_finance")->unprepared("
                DELETE  Keuangan.DBO.TA_JURNAL_HDR where FS_KD_JURNAL in(
                select NO_TRS_BILLING from Billing_Pasien.dbo.FO_T_BILLING
                where FB_VERIF_JURNAL='0');
                DELETE  Keuangan.DBO.TA_JURNAL_DTL where FS_KD_JURNAL in(
				select NO_TRS_BILLING from Billing_Pasien.dbo.FO_T_BILLING
				where FB_VERIF_JURNAL='0');
            ");
            Log::info("Deleted...");

            //

            Log::info("Preparing flag...");
            DB::connection("service_finance")->unprepared("
                UPDATE Billing_Pasien.dbo.FO_T_BILLING set FB_VERIF_JURNAL='1' where NO_TRS_BILLING in (
                select NO_TRS_BILLING from Billing_Pasien.dbo.FO_T_BILLING
                where FB_VERIF_JURNAL='0');
            ");
            Log::info("Prepared flag...");

            //

            Log::info("Inserting journal header...");
            DB::connection("service_finance")->unprepared("
                INSERT INTO Keuangan.DBO.TA_JURNAL_HDR (FS_KD_JURNAL, FD_TGL_JURNAL,FN_DEBET,FN_KREDIT,FN_JURNAL,FS_KD_PETUGAS,
                FS_KET,FS_KET2,FB_SELESAI)
                SELECT a.NO_TRS_BILLING ,a.TGL_BILLING,A.GRANDTOTAL AS DEBET, A.GRANDTOTAL AS KREDIT, A.GRANDTOTAL AS FN_JURNAL,'0158' AS PETUGAS
                ,D.PatientName  collate Latin1_General_CI_AS +' -  '+replace(CONVERT(VARCHAR(11),a.TGL_BILLING, 111), '/','-') + ' - ' + a.NO_REGISTRASI  AS FS_KET,'' as FS_KET2,'1' FB_SELESAI
                FROM Billing_Pasien.dbo.FO_T_BILLING A 
                INNER JOIN MasterdataSQL.DBO.Admision D ON D.NoMR collate Latin1_General_CI_AS = A.NO_MR collate Latin1_General_CI_AS
                WHERE A.BATAL='0' AND A.FB_VERIF_JURNAL='1'
            ");
            Log::info("Inserted journal header...");

            Log::info("Inserting journal detail...");
            DB::connection("service_finance")->unprepared("
                INSERT INTO Keuangan.DBO.TA_JURNAL_DTL ( 
                FS_KD_JURNAL,FS_KET_REFF,FN_DEBET,FN_KREDIT,FS_REK,FS_KD_REFF,FS_KD_REG,
                FS_KD_UNIT,FB_UNIT_USAHA,BP_SOURCE_TRS,FS_KD_REF_OUT
                )
                SELECT a.NO_TRS_BILLING AS FS_KD_JURNAL,'RAJAL '+B.GROUP_ENTRI+' '+E.NAMA_TIPE_PDP+' '+ c.NAMA_TARIF  AS FS_KET, 
                '0' AS DEBET, c.NILAI_PDP AS KREDIT, C.KD_POSTING AS FS_REK,c.KODE_TARIF as fs_kd_reff, a.NO_REGISTRASI as FS_kd_REG,
                A.UNIT AS FS_KD_UNIT,'1' AS FB_USAHA,B.GROUP_ENTRI AS BP_SOURCE_TRS,B.KODE_REF AS FS_kd_REF_OUT
                FROM Billing_Pasien.dbo.FO_T_BILLING A
                INNER JOIN Billing_Pasien.DBO.FO_T_BILLING_1 B
                ON A.NO_TRS_BILLING   collate Latin1_General_CI_AS =  B.NO_TRS_BILLING   collate Latin1_General_CI_AS
                INNER JOIN Billing_Pasien.DBO.FO_T_BILLING_2 C
                ON C.NO_TRS_BILLING   collate Latin1_General_CI_AS= B.NO_TRS_BILLING   collate Latin1_General_CI_AS
                INNER JOIN MasterdataSQL.DBO.Admision D ON D.NoMR collate Latin1_General_CI_AS = A.NO_MR collate Latin1_General_CI_AS
                AND B.KODE_TARIF = C.KODE_TARIF
                INNER join Keuangan.dbo.BO_M_PDP_TIPE E ON E.KD_TIPE_PDP = C.KODE_KOMPONEN_TARIF
                WHERE A.BATAL='0' AND A.FB_VERIF_JURNAL='1' 
                and b.BATAL='0' and c.BATAL='0'
            ");
            Log::info("Inserted journal detail...");

            Log::info("Inserting journal detail discount...");
            DB::connection("service_finance")->unprepared("
                INSERT INTO Keuangan.DBO.TA_JURNAL_DTL ( 
                FS_KD_JURNAL,FS_KET_REFF,FN_DEBET,FN_KREDIT,FS_REK,FS_KD_REFF,FS_KD_REG,
                FS_KD_UNIT,FB_UNIT_USAHA,BP_SOURCE_TRS,FS_KD_REF_OUT
                )
                SELECT a.NO_TRS_BILLING AS FS_KD_JURNAL,'RAJAL DISKON '+B.GROUP_ENTRI+' '+E.NAMA_TIPE_PDP+' '+ c.NAMA_TARIF  AS FS_KET, 
                 '0' AS DEBET, c.NILAI_PDP AS KREDIT, C.KD_POSTING_DISC AS FS_REK,c.KODE_TARIF as fs_kd_reff, a.NO_REGISTRASI as FS_kd_REG,
                A.UNIT AS FS_KD_UNIT,'1' AS FB_USAHA,B.GROUP_ENTRI AS BP_SOURCE_TRS,B.KODE_REF AS FS_kd_REF_OUT
                FROM Billing_Pasien.dbo.FO_T_BILLING A
                INNER JOIN Billing_Pasien.DBO.FO_T_BILLING_1 B
                ON A.NO_TRS_BILLING   collate Latin1_General_CI_AS =  B.NO_TRS_BILLING   collate Latin1_General_CI_AS
                INNER JOIN Billing_Pasien.DBO.FO_T_BILLING_2 C
                ON C.NO_TRS_BILLING   collate Latin1_General_CI_AS= B.NO_TRS_BILLING   collate Latin1_General_CI_AS
                INNER JOIN MasterdataSQL.DBO.Admision D ON D.NoMR collate Latin1_General_CI_AS = A.NO_MR collate Latin1_General_CI_AS
                AND B.KODE_TARIF = C.KODE_TARIF
                left join Keuangan.dbo.BO_M_PDP_TIPE E ON E.KD_TIPE_PDP = C.KODE_KOMPONEN_TARIF
                WHERE A.BATAL='0' AND A.FB_VERIF_JURNAL='1' 
                and b.BATAL='0' and c.BATAL='0' AND B.DISC_RP<>'0'
            ");
            Log::info("Inserted journal detail discount...");

            Log::info("Inserting journal detail claim...");
            DB::connection("service_finance")->unprepared("
                INSERT INTO Keuangan.DBO.TA_JURNAL_DTL ( 
                FS_KD_JURNAL,FS_KET_REFF,FN_DEBET,FN_KREDIT,FS_REK,FS_KD_REFF,FS_KD_REG,
                FS_KD_UNIT,FB_UNIT_USAHA,BP_SOURCE_TRS,FS_KD_REF_OUT
                )
                SELECT a.NO_TRS_BILLING ,D.PatientName  collate Latin1_General_CI_AS +' - PIUTANG DALAM PERAWATAN - '+replace(CONVERT(VARCHAR(11),a.TGL_BILLING, 111), '/','-') + ' - ' + a.NO_REGISTRASI  AS FS_KET,
                A.SUBTOTAL AS DEBET, '0' AS KREDIT,'15400001' AS rek_ppdp ,'15400001' as fs_kd_reff, a.NO_REGISTRASI as fs_kd_reg,
                a.UNIT as FS_KD_UNIT,'0' AS FB_UNIT_USAHA,'',''
                FROM Billing_Pasien.dbo.FO_T_BILLING A 
                INNER JOIN MasterdataSQL.DBO.Admision D ON D.NoMR collate Latin1_General_CI_AS = A.NO_MR collate Latin1_General_CI_AS
                WHERE A.BATAL='0' AND A.FB_VERIF_JURNAL='1'
            ");
            Log::info("Inserted journal detail claim...");

            //

            Log::info("Clearing...");
            DB::connection("service_finance")->unprepared("
                UPDATE Billing_Pasien.dbo.FO_T_BILLING set FB_VERIF_JURNAL='2' where NO_TRS_BILLING in (
                SELECT NO_TRS_BILLING from Billing_Pasien.dbo.FO_T_BILLING
                where FB_VERIF_JURNAL='1')
            ");
            Log::info("Cleared...");

            //

            DB::commit();

        } catch (QueryException $exception) {

            Log::error($exception->getMessage());

            DB::rollback();
        }

        return $content;
    }
}
