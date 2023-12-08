<?php

namespace App\Http\Repository;

interface aBarangRepositoryInterface
{
    public function addBarang($request);
    public function addBarangSupplier($request);
    public function deleteBarangSupplier($request);
    public function editBarang($request);
    public function getBarangbyId($id);
    public function getBarangbySuppliers($id);
    public function getBarangbyIdAndIDSupplier($request); 
    public function getBarangAll();
    public function addBarangFormularium($request);
    public function getBarangbyIdAndIDFormularium($request);
    public function deleteBarangFormularium($request);
    public function getBarangbyFormulariums($id);
    public function getBarangbyNameLike($request);
    public function editHPPBarang($request,$nilaiHppFix);
    
}
