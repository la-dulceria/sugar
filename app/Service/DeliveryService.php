<?php


namespace App\Service;


use App\Delivery;
use App\Repository\DeliveryRepository;
use DateTime;


class DeliveryService
{
    private DeliveryRepository $deliveryRepository;

    /**
     * DeliveryService constructor.
     * @param DeliveryRepository $deliveryRepository
     */
    public function __construct(DeliveryRepository $deliveryRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
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
