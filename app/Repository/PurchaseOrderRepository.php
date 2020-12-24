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

    public function all()
    {
        return PurchaseOrder::all();
    }

    public function findOrfail($id)
    {
        return PurchaseOrder::findOrfail($id);
    }

    public function delete(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
    }
}
