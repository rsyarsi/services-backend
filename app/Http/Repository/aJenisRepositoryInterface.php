<?php

namespace App\Http\Repository;

interface aJenisRepositoryInterface
{
    public function addJenis($request);
    public function editJenis($request);
    public function getJenisbyNameExceptId($request);
    public function getJenisbyNameExceptIdById($request);
    public function getJenisbyId($id);
    public function getJenisAll();
}
