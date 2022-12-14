<?php

namespace App\Http\Repository;

interface aTrsRadiologiRepositoryInterface
{
    public function create($request,$tarif,$datareg,$kelasid,$autoNumber,$TRIGGER_DTTM,$DOB,$PATIENT_LOCATION); 
   
}
