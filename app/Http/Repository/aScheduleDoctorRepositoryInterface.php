<?php
namespace App\Http\Repository;
interface aScheduleDoctorRepositoryInterface
{ 
    public function getScheduleDoctorSenin($request);
    public function getScheduleDoctorSelasa($request);
    public function getScheduleDoctorRabu($request);
    public function getScheduleDoctorKamis($request);
    public function getScheduleDoctorJumat($request);
    public function getScheduleDoctorSabtu($request);
    public function getScheduleDoctorMinggu($request); 
    public function getScheduleDoctorAll();  
    public function getScheduleDoctorbyIdDoctor($id);  

}