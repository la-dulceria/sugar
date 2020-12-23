<?php


namespace App\Service;

use App\PurchaseOrder;
use App\Repository\DeliveryRepository;
use App\Repository\ProductRepository;
use App\Repository\PurchaseOrderRepository;

class PurchaseOrderService
{
    private ProductRepository $productRepository;
    private DeliveryRepository $deliveryRepository;
    private PurchaseOrderRepository $purchaseOrderRepository;


    public function __construct(
        ProductRepository $productRepository,
        DeliveryRepository $deliveryRepository,
        PurchaseOrderRepository $purchaseOrderRepository
    ) {
        $this->productRepository = $productRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->purchaseOrderRepository = $purchaseOrderRepository;
    }


    public function create(string $product_id, string $direction, ?float $finalPrice,
                           ?string $observation, ?string $user, string $delivery_id)
    {
        $purchaseOrder = new PurchaseOrder();

        $this->productRepository->findOrfail($product_id);
        $purchaseOrder->product()->associate($product_id);

        $purchaseOrder->setDirection($direction);
        $purchaseOrder->finalPrice = 1;
        $purchaseOrder->setObservation($observation);
        $purchaseOrder->user = 1;

        $this->deliveryRepository->findOrfail($delivery_id);
        $purchaseOrder->delivery()->associate($delivery_id);

        $this->purchaseOrderRepository->save($purchaseOrder);

    }
}
