<?php

namespace App\Http\Repository;

interface aPurchaseRequisitionRepositoryInterface
{
    public function addPurchaseRequisition($request, $autoNumber);
    public function addPurchaseRequisitionDetil($request);
    public function editPurchaseRequisition($request);
    public function getPurchaseRequisitionbyID($id);
    public function getPurchaseRequisitionApprovedbyID($id);
    public function getPurchaseRequisitionDetailbyID($id); 
    public function voidPurchaseRequisition($request);
    public function voidPurchaseRequisitionDetailbyItem($request);
    public function voidPurchaseRequisitionDetailAll($request);
    public function getPurchaseRequisitionbyDateUser($request);
    public function getPurchaseRequisitionbyPeriode($request);
    public function getPurchaseRequisitionDetailbyIDBarang($request,$key);
    public function getItemsDouble($request); 
    public function getMaxCode($request);
    public function updateQtyRemainPR($request,$key,$qtyRemain);
}
