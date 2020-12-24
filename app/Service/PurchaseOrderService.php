<?php

namespace App\Service;

use App\PurchaseOrder;
use App\PurchaseOrderDetail;
use App\Repository\DeliveryRepository;
use App\Repository\ProductRepository;
use App\Repository\PurchaseOrderDetailRepository;
use App\Repository\PurchaseOrderRepository;
use Domain\Entities\User;

class PurchaseOrderService
{
    private ProductRepository $productRepository;
    private DeliveryRepository $deliveryRepository;
    private PurchaseOrderRepository $purchaseOrderRepository;
    private PurchaseOrderDetailRepository $purchaseOrderDetailRepository;

    public function __construct(
        ProductRepository $productRepository,
        DeliveryRepository $deliveryRepository,
        PurchaseOrderRepository $purchaseOrderRepository,
        PurchaseOrderDetailRepository $purchaseOrderDetailRepository
    ) {
        $this->productRepository = $productRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->purchaseOrderRepository = $purchaseOrderRepository;
        $this->purchaseOrderDetailRepository = $purchaseOrderDetailRepository;
    }

    public function create(
        string $direction,
        ?float $finalPrice,
        ?string $observation,
        User $user,
        string $deliveryId,
        array $productIds,
        array $quantities,
        array $prices
    ) {
        $purchaseOrder = new PurchaseOrder();

        $purchaseOrder->setDirection($direction);
        $purchaseOrder->finalPrice = $finalPrice;
        $purchaseOrder->setObservation($observation);
        $purchaseOrder->user_id = $user->id;

        $this->deliveryRepository->findOrfail($deliveryId);
        $purchaseOrder->delivery_id = $deliveryId;

        $this->purchaseOrderRepository->save($purchaseOrder);

        foreach ($productIds as $key => $productId) {
            $purchaseOrderDetail = new PurchaseOrderDetail();

            $this->productRepository->findOrfail($productId);
            $purchaseOrderDetail->product_id = $productId;
            $purchaseOrderDetail->purchase_order_id = $purchaseOrder->id;
            $purchaseOrderDetail->quantity = $quantities[$key];
            $purchaseOrderDetail->unit_price = $prices[$key];

            $this->purchaseOrderDetailRepository->save($purchaseOrderDetail);
        }

        return $purchaseOrder;
    }

    public function delete($id)
    {
        $order = $this->purchaseOrderRepository->findOrfail($id);

        $this->purchaseOrderRepository->delete($order);

    }
}
