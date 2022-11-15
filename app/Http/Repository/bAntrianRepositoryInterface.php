<?php
namespace App\Http\Repository;
interface bAntrianRepositoryInterface
{ 
    public function getMaxAntrianPoli($tglbookingfix,$NamaSesion,$IdDokter); 
    public function insertAntrian($nobokingreal,$IdDokter,$NamaSesion,$idno_urutantrian,$fixNoAntrian,$tglbookingfix,$Company);
}