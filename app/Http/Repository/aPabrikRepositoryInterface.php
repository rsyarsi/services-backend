<?php

namespace App\Http\Repository;

interface aPabrikRepositoryInterface
{
    public function addPabrik($request);
    public function editPabrik($request);
    public function getPabrikbyName($request);
    public function getPabrikbyNameExceptId($request);
    public function getPabrikbyId($id);
    public function getPabrikAll();
}
