<?php
namespace App\Http\Repository;
interface bAssesmentRepositoryInterface
{
    public function CreateAssesmentRajal($NoMR,$NoEpisode,$NoRegistrasi,$Tgl,$NamaPasien,
    $KeluhanPasien, $S_Anamnesa,$S_RPD,
    $O_PemeriksaanFisik, $A_Diagnosa, $P_RencanaTatalaksana,$P_InstruksiNonMedis ,
    $NamaUser,$GroupUser,$SBAR,$Beratbadan,$TinggiBadan,$Suhu,$FrekuensiNafas
    ,$TD_Sistol,$TD_Distol,$FrekuensiNadi,$AlatBantu,$Prothesa,$Cacat); 

    public function getAssesment_Rajal_Dokter($NoRegistrasi);

    public function UpdateAssesmentRajal($ID,$NoMR,$NoEpisode,$NoRegistrasi,$Tgl,$NamaPasien,
    $KeluhanPasien, $S_Anamnesa,$S_RPD,
    $O_PemeriksaanFisik, $A_Diagnosa, $P_RencanaTatalaksana,$P_InstruksiNonMedis ,
    $NamaUser,$GroupUser,$SBAR,$Beratbadan,$TinggiBadan,$Suhu,$FrekuensiNafas
    ,$TD_Sistol,$TD_Distol,$FrekuensiNadi,$AlatBantu,$Prothesa,$Cacat);
    
}