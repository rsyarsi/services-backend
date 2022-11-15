<?php
namespace App\Http\Repository;
interface aUnitRepositoryInterface
{
    public function addUnit($request);
    public function editUnit($request);
    public function getUnitPoliklinikbyId($id);  
    public function getUnitPoliklinik();  

}