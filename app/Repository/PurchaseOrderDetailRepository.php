<?php


namespace App\Repository;


use App\PurchaseOrderDetail;

class PurchaseOrderDetailRepository
{
    public function save(PurchaseOrderDetail $purchaseOrderDetail)
    {
        $purchaseOrderDetail->save();
    }
}
