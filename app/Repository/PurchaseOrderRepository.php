<?php


namespace App\Repository;

use App\Delivery;
use App\PurchaseOrder;

class PurchaseOrderRepository
{
    public function save(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->save();
    }

    public function findByDelivery(Delivery $delivery)
    {
        return PurchaseOrder::where('delivery_id', '=' , $delivery->getId())->get();
    }
}
