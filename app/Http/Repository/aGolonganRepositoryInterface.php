<?php

namespace App\Http\Repository;

interface aGolonganRepositoryInterface
{
    public function addGolongan($request);
    public function editGolongan($request);
    public function getGolonganbyId($id);
    public function getGolonganbyName($name);
    public function getGolonganAll();
    public function getGolonganbyNameExceptId($request);
}
