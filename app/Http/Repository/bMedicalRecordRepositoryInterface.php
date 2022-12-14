<?php
namespace App\Http\Repository;
interface bMedicalRecordRepositoryInterface
{
    public function create($request, $aktif,$jnsid,$hidden_tptlahir,$NoMrfix,$nourutfixMR,$autonumber); 
    public function createWalkin($request, $aktif,$jnsid,$hidden_tptlahir,$NoMrfix,$nourutfixMR,$autonumber); 
    public function getMedrecbyNIK($nik); 
    public function getMedrecbyNoMR($NoMR); 
    public function getMedrecWalkinbyNoMR($NoMR); 
    public function getMedrecWalkinbyNIK($nik); 
    public function getMedrecNumberMax(); 
    public function getMedrecWalkinNumberMax(); 

}