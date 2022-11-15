<?php

namespace App\Http\Repository;

interface aFakturRepositoryInterface
{
    public function addFaktur($request, $autoNumber);
    public function addFakturDetil($key, $kodePo,$request); 
    public function getFakturbyID($id);
    public function getFakturDetailbyID($id);
    public function voidFaktur($request);
    public function voidFakturDetailAllOrder($request);
    public function voidFakturDetailbyItem($request);
    public function getFakturbyDateUser($request);
    public function getFakturbyPeriode($request);
    public function getFakturDetailByBarang($ProductCode, $TransactionCode);
    public function getMaxCode($request);
    public function delItemsbyPOnumber($key, $po);
    public function updateDeliveryOrdeDetails($request, $key);
}
