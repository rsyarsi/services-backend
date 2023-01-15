<?php

namespace App\Http\Repository;

interface aTrsLaboratoriumRepositoryInterface
{
    public function createHeader($request,$getNotrsLabNext,$datareg,$kelasid); 
    public function createDetail($key,$RecID,$LabID,$NoOrderLabLIS,$request); 
}
