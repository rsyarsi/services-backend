<?php

namespace App\Http\Repository;

interface aSatuanRepositoryInterface
{
    public function addSatuan($request);
    public function editSatuan($request); 
    public function getSatuanbyId($id);
    public function getSatuanbyName($name);
    public function getSatuanbyNameExceptId($request);
    public function getSatuanAll();
}
