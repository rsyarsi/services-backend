<?php
namespace App\Http\Repository;
interface aDoctorRepositoryInterface
{
    public function addDoctor($request);
    public function editDoctor($request);
    public function getDoctorbyId($id);  
    public function getDoctorbyUnit($id);  
    public function getDoctorbyUnitAll();  
    public function getDoctorbyUnitAllTop();  

}