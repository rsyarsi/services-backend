<?php

namespace App\Http\Repository;

interface aDeliveryOrderRepositoryInterface
{
    public function addDeliveryOrder($request, $autoNumber);
    public function addDeliveryOrderDetil($key, $kodePo,$nilaiHppFix);
    public function editDeliveryOrder($request);
    public function getDeliveryOrderbyID($id); 
    public function getDeliveryOrderDetailbyID($id);
    public function voidDeliveryOrder($request);
    public function voidDeliveryOrderDetailAllOrder($request);
    public function voidDeliveryOrderDetailbyItem($request);
    public function getDeliveryOrderbyDateUser($request);
    public function getDeliveryOrderbyPeriode($request);
    public function getDeliveryOrderDetailByBarang($ProductCode, $TransactionCode); 
    public function getMaxCode($request);
    public function delItemsbyPOnumber($key, $po);
    public function updateDeliveryOrdeDetails($request, $key,$nilaiHppFix);
}
