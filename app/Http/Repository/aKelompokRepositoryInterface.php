<?php

namespace App\Http\Repository;

interface aKelompokRepositoryInterface
{
    public function addKelompok($request);
    public function editKelompok($request);
    public function getKelompokbyNameExceptId($request);
    public function getKelompokbyName($request);
    public function getKelompokbyId($id);
    public function getKelompokAll();
}
