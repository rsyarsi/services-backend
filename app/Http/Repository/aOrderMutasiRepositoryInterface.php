<?php

namespace App\Http\Repository;

interface aOrderMutasiRepositoryInterface
{
    public function addOrderMutasi($request, $autoNumber);
    public function addOrderMutasiDetail($request);
    public function editOrderMutasi($request);
    public function voidOrderMutasi($request);
    public function voidOrderMutasiDetailbyItem($request);
    public function getOrderMutasibyID($id);
    public function getOrderMutasiDetailbyID($request);
    public function getOrderMutasibyDateUser($request);
    public function getOrderMutasibyPeriode($request);
    public function getItemsDouble($request);
    public function getMaxCode($request);
    public function getOrderMutasiDetailbyIDBarang($request, $key);
    public function updateQtyOrderMutasi($request, $key, $qtyRemain); 

    
}
