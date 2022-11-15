<?php

namespace App\Http\Repository;

interface aPurchaseOrderRepositoryInterface
{
    public function addPurchaseOrder($request, $autoNumber);
    public function addPurchaseOrderDetil($key, $kodePo);
    public function editPurchaseOrder($request);
    public function getPurchaseOrderbyID($id);
    public function getPurchaseOrderApprovedbyID($id);
    public function getPurchaseOrderDetailbyID($id);
    public function voidPurchaseOrder($request);
    public function voidPurchaseDetailAllOrder($request);
    public function voidPurchaseOrderDetailbyItem($request);
    public function getPurchaseOrderbyDateUser($request);
    public function getPurchaseOrderbyPeriode($request);
    public function getItemsDouble($request);
    public function getMaxCode($request);
    public function editQtyPurchaseRemain($request, $qtyremainPO, $productcode);
    public function delItemsbyPOnumber($key,$po);
    public function getPurchaseOrderDetailbyIDBrgForDo($request,$key);
}
