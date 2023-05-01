<?php
namespace App\Http\Repository;
interface bAntrianFarmasiRepositoryInterface
{ 
    public function CreateAntrian($NoEpisode,$NoRegistrasi,$NoMR,$NoAntrianPoli,$NoAntrianList,$StatusAntrean,$DateCreated,
                                $PatientName,$IdUnitFarmasi,$IDPoliOrder, $NamaPoliOrder, $IDDokter, $NamaDokter , $JenisResep,$NoResep); 

}