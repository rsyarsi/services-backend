<?php
namespace App\Http\Repository;
interface bAntrianAdmissionRepositoryInterface
{ 
    public function CreateAntrianAdmission($request,$noAntrian,$datenow,$autonumber); 
    public function PanggilAntrian($request,$datenow); 

}