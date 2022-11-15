<?php

namespace App\Http\Repository;

interface aMutasiRepositoryInterface
{
    public function addMutasi($request, $autoNumber);
    public function addMutasiDetail($request,$key);
    public function editMutasi($request);
    public function voidMutasi($request);
    public function voidMutasiDetailbyItem($request);
    public function getMutasibyID($id);
    public function getMutasiDetailbyID($request);
    public function getMutasibyDateUser($request);
    public function getMutasibyPeriode($request);
    public function getItemsDouble($request);
    public function getMaxCode($request);
    public function getMutasiDetailbyIDBarang($request, $key);
    public function updateQtyMutasi($request, $key, $qtyRemain); 
}
