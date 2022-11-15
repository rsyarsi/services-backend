<?php

namespace App\Http\Repository;

interface aSupplierRepositoryInterface
{
    public function addSupplier($request);
    public function editSupplier($request);
    public function getSupplierbyId($id);
    public function getSupplierAll();
}
