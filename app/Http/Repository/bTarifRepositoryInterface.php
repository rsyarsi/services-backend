<?php
namespace App\Http\Repository;
interface bTarifRepositoryInterface
{
    public function getTarifRadiologi($request); 
    public function getTarifLaboratorium($request); 
    public function getTarifRajal($request); 
    public function getTarifRanap($request); 

    
}