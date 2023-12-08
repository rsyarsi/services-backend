<?php
namespace App\Http\Repository;
interface bAntrianKasirRepositoryInterface
{ 
    public function CreateAntrianKasir($request,$noAntrian,$datenow,$autonumber); 
    public function PanggilAntrian($request,$datenow); 

}