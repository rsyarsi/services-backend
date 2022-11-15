<?php
namespace App\Http\Repository;
interface bMedicalRecordRepositoryInterface
{ 
    public function create($request, $aktif,$jnsid,$hidden_tptlahir,$NoMrfix,$nourutfixMR,$autonumber); 
    public function createWalkin($request, $aktif,$jnsid,$hidden_tptlahir,$NoMrfix,$nourutfixMR,$autonumber); 

}