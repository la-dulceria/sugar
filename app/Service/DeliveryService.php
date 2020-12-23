<?php


namespace App\Service;


use App\Delivery;
use App\Repository\DeliveryRepository;
use App\Repository\PurchaseOrderRepository;
use DateTime;
use Illuminate\Validation\ValidationException;


class DeliveryService
{
    private DeliveryRepository $deliveryRepository;
    private PurchaseOrderRepository $purchaseOrderRepository;

    public function __construct(DeliveryRepository $deliveryRepository, PurchaseOrderRepository $purchaseOrderRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
        $this->purchaseOrderRepository = $purchaseOrderRepository;
    }

    public function create(string $name, string $date)
    {
        $delivery = new Delivery();
        $delivery->setName($name);
        $delivery->setDate($date);

        $this->deliveryRepository->save($delivery);
    }

    public function delete($id)
    {
        $delivery = $this->deliveryRepository->findOrfail($id);

        $purchaseOrders = $this->purchaseOrderRepository->findByDelivery($delivery);
        if (!empty($purchaseOrders->toArray())) {
            throw ValidationException::withMessages(['delivery' => 'No se puede eliminar porque existen ordenes de compra con el envio']);
        }

        $this->deliveryRepository->delete($delivery);
    }

    public function edit($id, $name, $date)
    {
        $delivery = $this->deliveryRepository->findOrfail($id);

        $delivery->setName($name);
        $delivery->setDate($date);

        $this->deliveryRepository->save($delivery);
    }
}
